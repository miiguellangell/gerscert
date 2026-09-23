@extends('layouts.app')

@section('title', 'students')

@section('content')
<div class="container-xl">
    <div class="table-wrapper">
        <div class="table-title">
            <div class="row">
                <div class="col-sm-4">
                    <h2 class="table-head-title">Gestionar <b>Estudiantes</b></h2>
                </div>

                <div class="col-sm-8">
                    <form method="GET" action="{{ route('students.index') }}">
                        <div class="form-row">
                            <div class="col">
                                <input name="BusquedaEstudiante" class="form-control search-input-wide" placeholder="Buscar por cédula o nombre..." type="search" id="search1" aria-label="Search" value="{{ request('BusquedaEstudiante') }}">
                            </div>
                            <div class="col-auto">
                                <button type="submit" class="btn btn-verde"><i class="bi bi-search"></i></button>
                            </div>
                            <div class="col-auto">
                                <a href="{{ route('students.index') }}" class="btn btn-azul">
                                    <i class="bi bi-arrow-clockwise" aria-hidden="true"></i> <span>REFRESCAR</span>
                                </a>
                            </div>
                            <div class="col-auto">
                                <a href="{{ route('students.create') }}" class="btn btn-verde">
                                    <i class="bi bi-plus-circle" aria-hidden="true"></i> <span>NUEVO ESTUDIANTE</span>
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
                        <th>Tipo de Documento</th>
                        <th>Documento de estudiante</th>
                        <th>Nombre del estudiante</th>
                        <th>Descripcion del estudiante</th>
                        <th>Edad del estudiante</th>
                        <th>Correo del estudiante</th>
                        <th>Acciones</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($students as $student)
                    <tr>
                        <td>
                            <span class="custom-checkbox">
                                <input type="checkbox" id="checkbox2" name="options[]" value="1">
                                <label for="checkbox2"></label>
                            </span>
                        </td>
                        <td>{{ $student->typeid }}</td>
                        <td>{{ $student->id }}</td>
                        <td>{{ $student->student_name }}</td>
                        <td>{{ $student->student_description }}</td>
                        <td>{{ $student->student_age }} Años</td>
                        <td>{{ $student->student_mail }}</td>
                        <td>
                            <a class="pencil" href="{{ route('students.edit', $student) }}" title="Editar">
                                <i class="bi bi-pencil-square" aria-hidden="true"></i>
                            </a>
                            <form method="POST" action="{{ route('students.destroy', $student) }}" style="display:inline;">
                                @csrf @method('DELETE')
                                <button class="butondel" title="Eliminar">
                                    <i class="bi bi-trash" aria-hidden="true"></i>
                                </button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <div class="pagination-wrapper">
            {{ $students->links('pagination::bootstrap-4') }}
        </div>
    </div>
</div>
@endsection
