@extends('layouts.app')

@section('title', 'students')

@section('content')
<div class="container-xl">
    <div class="table-wrapper">
        <div class="table-title">
            <div class="row">
                <div class="col-sm-6">
                    <h2 class="table-head-title">Gestionar <b>Estudiantes</b></h2>
                </div>

                <div class="col-xs-6">
                    <form>
                        <div class="md-form active-pink active-pink-2 mb-3">
                            <input name="BusquedaEstudiante" class="form-search" placeholder="Buscar..." type="search" id="search1" aria-label="Search" mdbInput>
                        </div>
                    </form>
                </div>

                <div class="col-sx-6 text-right">
                    <a href="{{ route('students.index') }}" class="btn btn-azul">
                        <i class="fa fa-refresh" aria-hidden="true"></i> <span>REFRESCAR</span>
                    </a>
                    <a href="{{ route('students.create') }}" class="btn btn-verde">
                        <i class="fa fa-plus-circle" aria-hidden="true"></i> <span>NUEVO ESTUDIANTE</span>
                    </a>
                    <a href="#deleteEmployeeModal" class="btn btn-azul" data-toggle="modal">
                        <i class="fa fa-upload" aria-hidden="true"></i> <span>IMPORTAR</span>
                    </a>
                    <a href="{{ route('students.create') }}" class="btn btn-azul" data-toggle="modal">
                        <i class="fa fa-download" aria-hidden="true"></i> <span>EXPORTAR</span>
                    </a>
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
                            <a class="pencil" href="{{ route('students.edit', $student) }}">
                                <i style="color:#e0cc18;" class="fa fa-pencil" aria-hidden="true"></i>
                            </a>
                            <form method="POST" action="{{ route('students.destroy', $student) }}" style="display:inline;">
                                @csrf @method('DELETE')
                                <button class="butondel">
                                    <i style="color:#b42222;" class="fa fa-trash-o" aria-hidden="true"></i>
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
