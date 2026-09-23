@extends('layouts.app')

@section('content')
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/tom-select@2.3.1/dist/css/tom-select.bootstrap4.min.css">

    <div class="signup-form">
        <form action="{{ route('certificate.update', $certificate) }}" method="post">
            @csrf @method('PATCH')

            @csrf
            <h2>Editar Certificado</h2>

            <div class="form-group">
                <label for="students_id">Estudiante</label>
                <select class="form-control" name="students_id" id="students_id" required>
                    <option value="">Seleccione un estudiante</option>

                    @foreach ($students as $student)
                    <option value="{{$student->id}}" {{ $certificate->students_id == $student->id ? 'selected' : '' }}>{{$student->student_name}}</option>

                    @endforeach
                </select>
            </div>

            <div class="form-group">
                <label for="courses_id">Curso</label>
                <select class="form-control" name="courses_id" id="courses_id" required>
                    <option value="">Seleccione un curso</option>

                    @foreach ($courses as $course)
                    <option value="{{$course->id}}" {{ $certificate->courses_id == $course->id ? 'selected' : '' }}>{{$course->course_name}}</option>

                    @endforeach
                </select>
            </div>

            <div class="form-group">
                <label for="datepicker">Fecha de expedición</label>
                <input name="certificate_expedition" data-date-format="yyyy-m-d" id="datepicker" class="form-control" autocomplete="off" value="{{ $certificate->certificate_expedition }}" required>
            </div>

            <div class="form-group">
                <label for="background_select">Imagen de fondo</label>
                <select class="form-control" name="background_image" id="background_select">
                    @foreach ($backgrounds as $background)
                        <option value="{{ $background }}" {{ ($certificate->background_image ?? '3100-de-2019.jpg') === $background ? 'selected' : '' }}>
                            {{ ucfirst(pathinfo($background, PATHINFO_FILENAME)) }}
                        </option>
                    @endforeach
                </select>
                
                <!-- Vista previa de la imagen -->
                <div class="mt-3" id="image_preview">
                    <img src="{{ asset('images/' . ($certificate->background_image ?? '3100-de-2019.jpg')) }}" alt="Vista previa" style="max-width: 300px; max-height: 200px; border: 1px solid #ddd; border-radius: 4px;">
                </div>
            </div>

            <div class="form-group">
                <button type="submit" class="btn btn-success btn-lg btn-block">Guardar cambios</button>
            </div>
        </form>
    </div>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-datepicker/1.7.1/js/bootstrap-datepicker.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/tom-select@2.3.1/dist/js/tom-select.complete.min.js"></script>

    <script type="text/javascript">
        new TomSelect('#students_id', {
            create: false,
            placeholder: 'Buscar estudiante por nombre...',
            sortField: { field: 'text', direction: 'asc' },
        });
        new TomSelect('#courses_id', {
            create: false,
            placeholder: 'Buscar curso...',
        });

        $('#datepicker').datepicker({
            weekStart: 1,
            daysOfWeekHighlighted: "6,0",
            autoclose: true,
            todayHighlight: true,
        });
        $('#datepicker').datepicker("setDate", new Date("{{ $certificate->certificate_expedition }}"));

        // Actualizar vista previa de imagen
        $('#background_select').on('change', function() {
            var selectedImage = $(this).val();
            var imageUrl = "{{ asset('images') }}" + "/" + selectedImage;
            $('#image_preview img').attr('src', imageUrl);
        });
    </script>

@endsection

