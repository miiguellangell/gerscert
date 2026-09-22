@extends('layouts.app')

@section('title', 'Courses')

@section('content')
<div class="container-xl">
	<div class="table-wrapper">
		<div class="table-title">
			<div class="row">
				<div class="col-sm-6">
						<h2 class="table-head-title">Gestionar <b>Cursos</b></h2>
					</div>

                    <div class="col-xs-6">
                        <form>
                            <div class="md-form active-pink active-pink-2 mb-3">
                                <input name="Busqueda" class="form-search" placeholder="Buscar..." type="search" id="search1" aria-label="Search" mdbInput>
                            </div>
                        </form>
					</div>

					<div class="col-xs-6">
                        <a href="{{ route('courses.index') }}" class="btn btn-azul">
                            <i class="fa fa-refresh" aria-hidden="true"></i> 
                            <span>REFRESCAR</span>
                        </a>
						<a href="{{ route('courses.create') }}" class="btn btn-verde">
                            <i class="fa fa-plus-circle" aria-hidden="true"></i> 
                            <span>NUEVO CURSO</span>
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
						<th>Nombre del Curso</th>
						<th>Descripción del Curso</th>
                        <th>Duración del Curso</th>
						<th>Vigencia del Curso</th>
						<th>Acciones</th>
					</tr>
				</thead>
                @foreach($courses as $course)
				<tbody>
					<tr>
						<td>
							<span class="custom-checkbox">
								<input type="checkbox" id="checkbox2" name="options[]" value="1">
								<label for="checkbox2"></label>
							</span>
						</td>
						<td>{{ $course->course_name }}</td>
						<td>{{ $course->course_description }}</td>
						<td>{{ $course->course_duration }} Horas</td>
                        <td>{{ $course->course_validation }} Años</td>
						<td>
                            <a class="pencil" href="{{ route('courses.edit', $course) }}">
                                <i style="color:#e0cc18;" class="fa fa-pencil" aria-hidden="true"></i>
                            </a>
                            <form method="POST" action="{{ route('courses.destroy', $course) }}" style="display:inline;">
                                @csrf 
                                @method('DELETE')
                                <button class="butondel">
                                    <i style="color:#b42222;" class="fa fa-trash-o" aria-hidden="true"></i>
                                </button>
                            </form>
						</td>
					</tr>
				</tbody>
                @endforeach
			</table>
			</div>

			<div class="pagination-wrapper">
				{{ $courses->links("pagination::bootstrap-4") }}
			</div>
	</div>
</div>
@endsection
