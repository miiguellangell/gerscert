@extends('layouts.app')

@section('title', 'certificate')

@section('content')
<div class="container-xl">
	<div class="table-wrapper">
		<div class="table-title">
			<div class="row">
				<div class="col-sm-6">
						<h2 class="table-head-title">Buscar <b>Certificados</b></h2>
					</div>

                    <div class="col-xs-6">
                        <form>
                            <div class="md-form active-pink active-pink-2 mb-3">
                              <input name="Busqueda" class="form-search" placeholder="Buscar..." type="search" id="search1" aria-label="Search" mdbInput>
                            </div>
                        </form>
					</div>

					<div class="col-sx-6">
                        <!-- Search form -->
                        <a href="{{ route('Front.search2')}}" class="btn btn-azul" ><i class="fa fa-refresh" aria-hidden="true"></i> <span>REFESCAR</span></a>
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
                        <th>Cedula de estudiante</th>
						<th>Nombre de estudiante</th>
						<th>Curso</th>
                        <th>Horas del curso</th>
                        <th>Expedicion</th>
                        <th>Vencimiento</th>
						<th>Acciones</th>
					</tr>
				</thead>
                @foreach($certificate as $certificate)
				<tbody>
					<tr>

						<td>
							<span class="custom-checkbox">
								<input type="checkbox" id="checkbox2" name="options[]" value="1">
								<label for="checkbox2"></label>
							</span>
						</td>
                        <td>{{ $certificate->students['id']}}</td>
						<td>{{ $certificate->students['student_name']}}</td>
						<td>{{ $certificate->courses['course_name']}}</td>
                        <td>{{ $certificate->courses['course_duration']}}</td>
                        <td>{{ date("d-m-Y",strtotime($certificate->certificate_expedition))}}</td>
                        @php
                        $validation=$certificate->courses['course_validation']
                        @endphp
                        <td>{{date("d-m-Y",strtotime($certificate->certificate_expedition."+ $validation year"))}}</td>
						<td>


                            <a class="pencil" href="{{route('certificate.downloadverification',$certificate)}}"><i  style="color:#58bb15;" class="fa fa-file-o" aria-hidden="true"></i></a>
                            <a class="pencil" href="{{route('certificate.downloadverification',$certificate)}}"><i  style="color:#58bb15;" class="fa fa-file-o" aria-hidden="true"></i></a>
						</td>
					</tr>
				   </tbody>
                   @endforeach
                   {{-- {{ $certificate->links("pagination::bootstrap-4") }} --}}
			</table>
			</div>

	</div>
</div>

@endsection

