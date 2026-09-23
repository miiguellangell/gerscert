@extends('layouts.app')

@section('title', 'Certificados')

@section('content')
<div class="container-xl">
    <div class="search-hero">
        <i class="bi bi-patch-check search-hero-icon" aria-hidden="true"></i>
        <h2>Consulta tu certificado</h2>
        <p class="search-hero-subtitle">Ingresa tu número de documento para ver y descargar tus certificados.</p>

        <form method="GET" action="{{ route('front.search') }}" class="search-hero-form">
            <input
                type="text"
                name="Busqueda"
                class="form-control"
                placeholder="Número de documento"
                value="{{ request('Busqueda') }}"
                inputmode="numeric"
                autofocus
                required
            >
            <button type="submit" class="btn btn-verde">
                <i class="bi bi-search" aria-hidden="true"></i> <span>Buscar</span>
            </button>
        </form>
    </div>

    @if($searched)
        @if($certificate->isNotEmpty())
            <div class="search-results">
                @foreach($certificate as $cert)
                <div class="search-result-card">
                    <div class="search-result-icon">
                        <i class="bi bi-file-earmark-text" aria-hidden="true"></i>
                    </div>
                    <div class="search-result-body">
                        <h3>{{ $cert->courses['course_name'] }}</h3>
                        <p class="search-result-name">{{ $cert->students['student_name'] }}</p>
                        <div class="search-result-meta">
                            <span><i class="bi bi-clock-history" aria-hidden="true"></i> {{ $cert->courses['course_duration'] }} horas</span>
                            <span><i class="bi bi-calendar-check" aria-hidden="true"></i> Expedido: {{ date("d-m-Y", strtotime($cert->certificate_expedition)) }}</span>
                            @php $validation = $cert->courses['course_validation']; @endphp
                            @if($validation > 0)
                                <span><i class="bi bi-calendar-x" aria-hidden="true"></i> Vence: {{ date("d-m-Y", strtotime($cert->certificate_expedition . " + $validation year")) }}</span>
                            @endif
                        </div>
                    </div>
                    <a href="{{ route('certificate.show', $cert) }}" class="btn btn-azul" title="Ver certificado">
                        <i class="bi bi-eye" aria-hidden="true"></i> <span>Ver</span>
                    </a>
                </div>
                @endforeach
            </div>
        @else
            <div class="search-empty">
                <i class="bi bi-search" aria-hidden="true"></i>
                <p>No se encontró ningún certificado con el documento "{{ request('Busqueda') }}".</p>
                <p class="search-empty-hint">Verifica que el número esté escrito correctamente.</p>
            </div>
        @endif
    @endif
</div>
@endsection
