<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\certificates;
use App\Models\courses;
use App\Models\students;
use App\Exports\CertificateExport;
use Barryvdh\DomPDF\Facade\Pdf;
use Carbon\Carbon;
use Maatwebsite\Excel\Facades\Excel;
use SimpleSoftwareIO\QrCode\Facades\QrCode;



class CertificateController extends Controller
{
    /**
     * Get available background images from public/images directory
     *
     * @return array
     */
    private function getAvailableBackgrounds()
    {
        $imagesPath = public_path('images');
        $backgrounds = [];
        
        if (is_dir($imagesPath)) {
            $files = scandir($imagesPath);
            $allowedExtensions = ['jpg', 'jpeg', 'png', 'gif', 'webp'];
            
            foreach ($files as $file) {
                if ($file !== '.' && $file !== '..' && $file !== '.DS_Store') {
                    $extension = strtolower(pathinfo($file, PATHINFO_EXTENSION));
                    if (in_array($extension, $allowedExtensions)) {
                        $backgrounds[] = $file;
                    }
                }
            }
        }
        
        // Ensure 3100-de-2019.jpg is always first if it exists
        if (in_array('3100-de-2019.jpg', $backgrounds)) {
            $backgrounds = array_diff($backgrounds, ['3100-de-2019.jpg']);
            array_unshift($backgrounds, '3100-de-2019.jpg');
        }
        
        return $backgrounds;
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $busqueda = $request->get('BusquedaCedula');

        return view('certificate.index', [
            'certificate' => certificates::where('students_id', 'like', "%$busqueda%")->paginate(10)
        ]);
    }

    /**
     * Calculate the expiration (vencimiento) date of a certificate based on
     * its expedition date and the related course's validation period (in years).
     *
     * @param  certificates  $certificate
     * @return \Carbon\Carbon
     */
    private function getVencimiento(certificates $certificate): Carbon
    {
        $years = (int) ($certificate->courses['course_validation'] ?? 0);

        return Carbon::parse($certificate->certificate_expedition)->addYears($years);
    }

    /**
     * Export to Excel all certificates whose expiration date falls within
     * the given date range.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Symfony\Component\HttpFoundation\BinaryFileResponse
     */
    public function exportExcel(Request $request)
    {
        $fields = $request->validate([
            'fecha_desde' => 'required|date',
            'fecha_hasta' => 'required|date|after_or_equal:fecha_desde',
        ]);

        $fechaDesde = Carbon::parse($fields['fecha_desde'])->startOfDay();
        $fechaHasta = Carbon::parse($fields['fecha_hasta'])->endOfDay();

        $certificates = certificates::with(['courses', 'students'])
            ->get()
            ->map(function ($certificate) {
                $certificate->vencimiento = $this->getVencimiento($certificate);
                return $certificate;
            })
            ->filter(function ($certificate) use ($fechaDesde, $fechaHasta) {
                return $certificate->vencimiento->between($fechaDesde, $fechaHasta);
            })
            ->values();

        return Excel::download(
            new CertificateExport($certificates),
            'certificados_' . $fechaDesde->format('Y-m-d') . '_a_' . $fechaHasta->format('Y-m-d') . '.xlsx'
        );
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store()
    {
        $fields = request()->validate([
            'courses_id' => 'required',
            'students_id' => 'required',
            'certificate_expedition' => 'required',
            'background_image' => 'nullable|string',
            'language' => 'required|in:es,en',
        ]);

        // Si no se selecciona imagen, usar 3100-de-2019.jpg como default
        if (empty($fields['background_image'])) {
            $fields['background_image'] = '3100-de-2019.jpg';
        }

        certificates::create($fields);

        return redirect()->route('certificate.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return view('certificate.show', [
            'certificates' => certificates::find($id)
        ]);
    }

    /**
     * Generate and download a PDF of the certificate.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function downloadPDF($id)
    {
        setlocale(LC_TIME, 'spanish');
        $certificates = certificates::find($id);
        $qrCodeSvg = QrCode::format('svg')->size(120)->generate(route('certificate.show', $id));
        $qrCodeBase64 = base64_encode($qrCodeSvg);

        $pdf = Pdf::loadView('certificate.download', compact('certificates', 'qrCodeBase64'))
            ->setPaper('letter', 'landscape');

        return $pdf->download("CertificadoGerscol_$id.pdf");
    }

    /**
     * Display a PDF of the certificate in the browser.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function showPDF($id)
    {
        setlocale(LC_TIME, 'spanish');
        $certificates = certificates::find($id);
        $qrCodeSvg = QrCode::format('svg')->size(120)->generate(route('certificate.show', $id));
        $qrCodeBase64 = base64_encode($qrCodeSvg);

        $pdf = Pdf::loadView('certificate.show', compact('certificates', 'qrCodeBase64'))
            ->setPaper('letter', 'landscape');

        return $pdf->stream("CertificadoGerscol_$id.pdf");
    }

    /**
     * Display the verification PDF of the certificate in the browser.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function showverifyPDF($id)
    {
        setlocale(LC_TIME, 'spanish');
        $certificates = certificates::find($id);
        $qrCodeSvg = QrCode::format('svg')->size(120)->generate(route('certificate.show', $id));
        $qrCodeBase64 = base64_encode($qrCodeSvg);

        $pdf = Pdf::loadView('certificate.showverification', compact('certificates', 'qrCodeBase64'))
            ->setPaper('letter', 'portrait');

        return $pdf->stream("CertificadoGerscol_$id.pdf");
    }

    /**
     * Generate and download the verification PDF of the certificate.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function downloadverifyPDF($id)
    {
        setlocale(LC_TIME, 'spanish');
        $certificates = certificates::find($id);
        $qrCodeSvg = QrCode::format('svg')->size(120)->generate(route('certificate.show', $id));
        $qrCodeBase64 = base64_encode($qrCodeSvg);

        $pdf = Pdf::loadView('certificate.downloadverification', compact('certificates', 'qrCodeBase64'))
            ->setPaper('letter', 'portrait');

        return $pdf->download("CertificadoGerscol_$id.pdf");
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(certificates $certificates)
    {
        $fields = request()->validate([
            'courses_id' => 'required',
            'students_id' => 'required',
            'certificate_expedition' => 'required',
            'background_image' => 'nullable|string',
        ]);

        // Si no se selecciona imagen, usar 3100-de-2019.jpg como default
        if (empty($fields['background_image'])) {
            $fields['background_image'] = '3100-de-2019.jpg';
        }

        $certificates->update($fields);

        return redirect()->route('certificate.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  certificates  $certificate
     * @return \Illuminate\Http\Response
     */
    public function destroy(certificates $certificate)
    {
        $certificate->delete();

        return redirect()->route('certificate.index');
    }

    /**
     * Show the form for creating a new certificate.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $courses = courses::all();
        $students = students::all();
        $backgrounds = $this->getAvailableBackgrounds();

        return view('certificate.create')->with(compact('students', 'courses', 'backgrounds'));
    }

    /**
     * Show the form for editing the specified certificate.
     *
     * @param  certificates  $certificate
     * @return \Illuminate\Http\Response
     */
    public function edit(certificates $certificate)
    {
        $courses = courses::all();
        $students = students::all();
        $backgrounds = $this->getAvailableBackgrounds();

        return view('certificate.edit', [
            'certificate' => $certificate,
            'students' => $students,
            'courses' => $courses,
            'backgrounds' => $backgrounds
        ]);
    }
}
