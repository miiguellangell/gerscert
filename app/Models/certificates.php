<?php

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class certificates extends Model
{
    public function courses()
    {
        return $this->belongsTo(courses::class);
    }

    public function students()
    {
        return $this->belongsTo(students::class);
    }

    protected $guarded = [];

    /**
     * Expedición + course_validation años. null si el curso no vence (0).
     */
    public function vencimiento(): ?Carbon
    {
        $years = (int) ($this->courses['course_validation'] ?? 0);

        return $years > 0
            ? Carbon::parse($this->certificate_expedition)->addYears($years)
            : null;
    }

    public function isVencido(): bool
    {
        $vence = $this->vencimiento();

        return $vence !== null && $vence->lt(today());
    }

    /**
     * Clave del curso en config('renovacion.cursos'), o null si no hay
     * producto equivalente en la tienda.
     */
    public function renovacionClave(): ?string
    {
        $nombre = strtoupper(Str::ascii((string) ($this->courses['course_name'] ?? '')));

        foreach (config('renovacion.cursos') as $clave => [$patron]) {
            if (preg_match($patron, $nombre)) {
                return $clave;
            }
        }

        return null;
    }

    /**
     * Enlace al producto de Shopify para renovar, con UTM para atribuir la
     * visita a este sitio. Sin producto mapeado, va al catálogo completo.
     */
    public function renovacionUrl(): string
    {
        $clave = $this->renovacionClave();
        $path = $clave
            ? '/products/' . config("renovacion.cursos.$clave")[1]
            : config('renovacion.fallback_path');

        $utm = config('renovacion.utm') + [
            'utm_content' => $clave ? str_replace('_', '-', $clave) : 'sin-producto',
        ];

        return config('renovacion.store_url') . $path . '?' . http_build_query($utm);
    }
}
