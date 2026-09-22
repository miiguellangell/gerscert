@extends('layouts.app')

@section('title', 'Gestionar Certificados')

@section('content')

<div class="container-xl">
    <div class="table-wrapper">
        <div class="table-title">
            <div class="row">
                <div class="col-sm-4">
                        <h2 class="table-head-title">Gestionar <b>Certificados</b></h2>
                    </div>

                    <!-- Formulario de búsqueda -->
                    <div class="col-sm-8">
                        <form method="GET" action="{{ route('certificate.index') }}">
                            <div class="form-row">
                                <div class="col">
                                    <input name="BusquedaFecha" data-date-format="yyyy-mm-dd" id="datepicker" class="form-control" placeholder="Fecha">
                                </div>
                                <div class="col">
                                    <input name="BusquedaCedula" class="form-control" placeholder="Buscar por cédula" type="search" id="search1">
                                </div>
                                <div class="col-auto">
                                    <button type="submit" class="btn btn-verde"><i class="fa fa-search"></i></button>
                                </div>
                                <div class="col-auto">
                                    <a href="{{ route('certificate.index') }}" class="btn btn-azul">
                                        <i class="fa fa-refresh" aria-hidden="true"></i> <span>REFRESCAR</span>
                                    </a>
                                </div>
                                <div class="col-auto">
                                    <button type="button" class="btn btn-verde" data-toggle="modal" data-target="#exportExcelModal">
                                        <i class="fa fa-file-excel-o" aria-hidden="true"></i> <span>EXPORTAR EXCEL</span>
                                    </button>
                                </div>
                                <div class="col-auto">
                                    <a href="{{ route('certificate.create') }}" class="btn btn-verde">
                                        <i class="fa fa-plus-circle" aria-hidden="true"></i> <span>NUEVO CERTIFICADO</span>
                                    </a>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <!-- Modal de exportación a Excel por rango de fecha de vencimiento -->
            <div class="modal fade" id="exportExcelModal" tabindex="-1" role="dialog" aria-labelledby="exportExcelModalLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                    <div class="modal-content">
                        <form method="GET" action="{{ route('certificate.ExportExcel') }}">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exportExcelModalLabel">Exportar certificados a Excel</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>
                            <div class="modal-body">
                                <p>Selecciona el rango de fechas de <strong>vencimiento</strong> de certificado a exportar.</p>
                                <div class="form-group">
                                    <label for="fecha_desde">Desde</label>
                                    <input type="text" name="fecha_desde" id="fecha_desde" data-date-format="yyyy-mm-dd" class="form-control" placeholder="Fecha desde" required autocomplete="off">
                                </div>
                                <div class="form-group">
                                    <label for="fecha_hasta">Hasta</label>
                                    <input type="text" name="fecha_hasta" id="fecha_hasta" data-date-format="yyyy-mm-dd" class="form-control" placeholder="Fecha hasta" required autocomplete="off">
                                </div>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Cancelar</button>
                                <button type="submit" class="btn btn-verde">
                                    <i class="fa fa-download" aria-hidden="true"></i> Descargar Excel
                                </button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>

            <!-- Tabla de certificados -->
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
                    @foreach($certificate as $cert)
                    <tr>
                        <td>
                            <span class="custom-checkbox">
                                <input type="checkbox" id="checkbox2" name="options[]" value="1">
                                <label for="checkbox2"></label>
                            </span>
                        </td>
                        <td>{{ $cert->students['id'] }}</td>
                        <td>{{ $cert->students['student_name'] }}</td>
                        <td>{{ $cert->courses['course_name'] }}</td>
                        <td>{{ $cert->courses['course_duration'] }}</td>
                        <td>{{ date('d-m-Y', strtotime($cert->certificate_expedition)) }}</td>
                        <td>{{ date('d-m-Y', strtotime($cert->certificate_expedition . ' + ' . $cert->courses['course_validation'] . ' years')) }}</td>
                        <td>
                            <a href="{{ route('certificate.show', $cert) }}" class="pencil"><i style="color:#58bb15;" class="fa fa-file-o" aria-hidden="true"></i></a>
                            <form method="POST" action="{{ route('certificate.destroy', $cert) }}" style="display:inline;">
                                @csrf
                                @method('DELETE')
                                <button class="butondel" onclick="return confirm('¿Estás seguro de eliminar este certificado?')">
                                    <i style="color:#b42222;" class="fa fa-trash-o" aria-hidden="true"></i>
                                </button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
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

<!-- Scripts de JavaScript -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.7.1/js/bootstrap-datepicker.min.js"></script>

<script type="text/javascript">
    $('#datepicker').datepicker({
        weekStart: 1,
        daysOfWeekHighlighted: "6,0",
        autoclose: true,
        todayHighlight: true,
    });
    $('#datepicker').datepicker("setDate", new Date());

    $('#fecha_desde, #fecha_hasta').datepicker({
        format: 'yyyy-mm-dd',
        weekStart: 1,
        daysOfWeekHighlighted: "6,0",
        autoclose: true,
        todayHighlight: true,
    });
</script>

@endsection
