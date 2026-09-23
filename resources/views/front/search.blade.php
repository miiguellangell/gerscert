@extends('layouts.app')

@section('title', 'Certificados')

@section('content')
<div class="container-xl">
    <div class="table-wrapper">
        <div class="table-title">
            <div class="row">
                <div class="col-sm-4">
                    <h2 class="table-head-title">Buscar <b>Certificados</b></h2>
                </div>

                <div class="col-sm-8">
                    <form method="GET" action="{{ route('front.search') }}">
                        <div class="form-row">
                            <div class="col">
                                <input name="Busqueda" class="form-control search-input-wide" placeholder="Buscar por cédula o nombre..." type="search" id="search1" aria-label="Search" value="{{ request('Busqueda') }}">
                            </div>
                            <div class="col-auto">
                                <button type="submit" class="btn btn-verde"><i class="bi bi-search"></i></button>
                            </div>
                            <div class="col-auto">
                                <a href="{{ route('front.search') }}" class="btn btn-azul">
                                    <i class="bi bi-arrow-clockwise" aria-hidden="true"></i>
                                    <span>REFRESCAR</span>
                                </a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>

            <div class="table-scroll">
            <table id="tableData" class="table table-striped table-hover">
                <thead>
                    <tr>
                        <th>
                            <span class="custom-checkbox">
                                <input type="checkbox" id="selectAll">
                                <label for="selectAll"></label>
                            </span>
                        </th>
                        <th>Cédula de estudiante</th>
                        <th>Nombre de estudiante</th>
                        <th>Curso</th>
                        <th>Horas del curso</th>
                        <th>Expedición</th>
                        <th>Vencimiento</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse($certificate as $cert)
                    <tr>
                        <td>
                            <span class="custom-checkbox">
                                <input type="checkbox" id="checkbox{{ $loop->index }}" name="options[]" value="{{ $cert->id }}">
                                <label for="checkbox{{ $loop->index }}"></label>
                            </span>
                        </td>
                        <td>{{ $cert->students['id'] }}</td>
                        <td>{{ $cert->students['student_name'] }}</td>
                        <td>{{ $cert->courses['course_name'] }}</td>
                        <td>{{ $cert->courses['course_duration'] }}</td>
                        <td>{{ date("d-m-Y", strtotime($cert->certificate_expedition)) }}</td>
                        @php
                        $validation = $cert->courses['course_validation'];
                        @endphp
                        <td>{{ date("d-m-Y", strtotime($cert->certificate_expedition . " + $validation year")) }}</td>
                        <td>
                            <a class="pencil icon-view" href="{{ route('certificate.show', $cert) }}" title="Ver certificado">
                                <i class="bi bi-eye" aria-hidden="true"></i>
                            </a>
                        </td>
                    </tr>
                    @empty
                    @include('partials.empty-state', [
                        'colspan' => 8,
                        'icon' => request()->filled('Busqueda') ? 'bi-search' : 'bi-file-earmark-text',
                        'message' => request()->filled('Busqueda')
                            ? 'No se encontraron certificados que coincidan con "'.request('Busqueda').'".'
                            : 'Aún no hay certificados disponibles.',
                        'clearUrl' => request()->filled('Busqueda') ? route('front.search') : null,
                    ])
                    @endforelse
                </tbody>
            </table>
            </div>

                 <!-- Validación de paginación -->
                 @if ($certificate->hasPages())
                <div class="pagination-wrapper d-flex justify-content-center">
                    {{ $certificate->links("pagination::bootstrap-4") }}
                </div>
            @endif
    </div>
</div>
@endsection
