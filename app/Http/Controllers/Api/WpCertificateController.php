<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\certificates;
use App\Models\courses;
use App\Models\students;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

/**
 * Emisión de certificados desde WordPress (botón "Generar certificado" en
 * Tutor LMS → Reportes → Estudiante). Lo llama el mu-plugin
 * gc-certificados.php con el token compartido WP_API_TOKEN.
 */
class WpCertificateController extends Controller
{
    public function store(Request $request)
    {
        $data = $request->validate([
            'cedula' => 'required|digits_between:4,10',
            'typeid' => 'required|in:C.C,C.E,T.I,PEP,PAP',
            'nombre' => 'required|string|max:255',
            'email' => 'required|email',
            'telefono' => 'nullable|string|max:20',
            'wp_course_id' => 'required|integer',
            'fecha' => 'nullable|date',
            'inscrito_desde' => 'nullable|date',
        ]);

        $grupo = courses::where('wp_course_id', $data['wp_course_id'])->pluck('id');

        if ($grupo->isEmpty()) {
            return response()->json([
                'message' => 'Este curso de WordPress no está vinculado a ningún curso de la app de certificados.',
            ], 422);
        }

        $student = students::find($data['cedula']);
        $studentCreated = false;

        if (! $student) {
            $student = students::create([
                'id' => $data['cedula'],
                'typeid' => $data['typeid'],
                'student_name' => $data['nombre'],
                'student_description' => '',
                'student_mail' => $data['email'],
                'student_phone' => $data['telefono'] ?? null,
                'student_age' => 0,
            ]);
            $studentCreated = true;
        }

        // Ya emitido para esta inscripción (doble clic o reintento): devolver
        // el mismo. Una inscripción nueva posterior (renovación) sí genera otro.
        if ($desde = $data['inscrito_desde'] ?? null) {
            $existente = certificates::where('students_id', $student->id)
                ->whereIn('courses_id', $grupo)
                ->where('certificate_expedition', '>=', Carbon::parse($desde)->toDateString())
                ->orderByDesc('certificate_expedition')
                ->first();

            if ($existente) {
                return $this->respuesta($existente, false, $studentCreated);
            }
        }

        $certificate = certificates::create([
            'students_id' => $student->id,
            'courses_id' => $this->cursoPrincipal($grupo),
            'certificate_expedition' => Carbon::parse($data['fecha'] ?? today())->toDateString(),
            'language' => 'es',
            'background_image' => '3100-de-2019.jpg',
        ]);

        return $this->respuesta($certificate, true, $studentCreated);
    }

    /**
     * De los cursos vinculados al mismo curso de WordPress, el que más
     * certificados ha emitido en el último año (el nombre "oficial" vigente).
     */
    private function cursoPrincipal($grupo): int
    {
        $usado = DB::table('certificates')
            ->select('courses_id', DB::raw('COUNT(*) AS c'))
            ->whereIn('courses_id', $grupo)
            ->where('certificate_expedition', '>=', today()->subYear())
            ->groupBy('courses_id')
            ->orderByDesc('c')
            ->orderBy('courses_id')
            ->value('courses_id');

        return $usado ?? $grupo->min();
    }

    private function respuesta(certificates $certificate, bool $created, bool $studentCreated)
    {
        $certificate->load('courses');

        return response()->json([
            'id' => $certificate->id,
            'url' => route('certificate.show', $certificate->id),
            'curso' => $certificate->courses['course_name'] ?? null,
            'expedicion' => Carbon::parse($certificate->certificate_expedition)->toDateString(),
            'created' => $created,
            'student_created' => $studentCreated,
        ], $created ? 201 : 200);
    }
}
