@extends('layouts.app')

@section('title','Error 403')

@section('content')

<div class="d-flex flex-column align-items-center justify-content-center text-center" style="min-height: 60vh;">
    <h1 style="font-size: 4rem; margin-bottom: 0.5rem;">403</h1>
    <p class="text-muted mb-4">{{ $exception->getMessage() ?: 'No tienes permiso para acceder a esta sección.' }}</p>
    <a href="/" class="btn btn-azul">Volver al inicio</a>
</div>
