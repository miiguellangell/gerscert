@extends('layouts.app')

@section('title', 'Certificado vencido')

@section('content')
<div class="container-xl">
    <div class="search-hero">
        <i class="bi bi-exclamation-octagon search-hero-icon vencido-hero-icon" aria-hidden="true"></i>
        <h2>Este certificado se encuentra vencido</h2>
        <p class="search-hero-subtitle">No es válido como soporte de capacitación. Renueva tu curso para obtener uno vigente.</p>
    </div>

    <div class="search-results">
        <div class="search-result-card is-vencido">
            <div class="search-result-icon">
                <i class="bi bi-exclamation-triangle" aria-hidden="true"></i>
            </div>
            <div class="search-result-body">
                <span class="search-result-badge">Vencido</span>
                <h3>{{ $certificate->courses['course_name'] }}</h3>
                <p class="search-result-name">{{ $certificate->students['student_name'] }}</p>
                <p class="search-result-aviso">
                    Este certificado venció el <strong>{{ $certificate->vencimiento()->format('d-m-Y') }}</strong> y ya no es válido como soporte de capacitación.
                    Renueva tu curso en Gerscol para obtener un certificado vigente.
                </p>
            </div>
            <a href="{{ $certificate->renovacionUrl() }}" class="btn btn-verde" target="_blank" rel="noopener" title="Renovar en la tienda Gerscol">
                <i class="bi bi-arrow-repeat" aria-hidden="true"></i> <span>Renovar</span>
            </a>
        </div>
    </div>
</div>
@endsection
