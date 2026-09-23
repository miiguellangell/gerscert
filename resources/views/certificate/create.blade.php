
@extends('layouts.app')

@section('content')
    <div class="signup-form">
        <form action="{{ route('certificate.store')}}" method="post">

            @csrf
            <h2>Nuevo Certificado</h2>

            <div class="form-group">
                <label for="students_id">Estudiante</label>
                <select class="form-control" name="students_id" id="students_id" required>
                    <option value="">Seleccione un estudiante</option>

                    @foreach ($students as $student)
                    <option value="{{$student->id}}">{{$student->student_name}}</option>

                    @endforeach
                </select>
            </div>

            <div class="form-group">
                <label for="courses_id">Curso</label>
                <select class="form-control" name="courses_id" id="courses_id" required>
                    <option value="">Seleccione un curso</option>

                    @foreach ($courses as $course)
                    <option value="{{$course->id}}">{{$course->course_name}}</option>

                    @endforeach
                </select>
            </div>

            <div class="form-group">
                <label for="datepicker">Fecha de expedición</label>
                <input name="certificate_expedition" data-date-format="yyyy-m-d" id="datepicker" class="form-control" autocomplete="off" required>
            </div>

            <div class="form-group">
                <label for="language_select">Idioma del certificado</label>
                <select class="form-control" name="language" id="language_select">
                    <option value="es" selected>Español</option>
                    <option value="en">English</option>
                </select>
            </div>

            <div class="form-group">
                <label for="background_select">Imagen de fondo</label>
                <select class="form-control" name="background_image" id="background_select">
                    @foreach ($backgrounds as $background)
                        <option value="{{ $background }}" {{ $background === '3100-de-2019.jpg' ? 'selected' : '' }}>
                            {{ ucfirst(pathinfo($background, PATHINFO_FILENAME)) }}
                        </option>
                    @endforeach
                </select>
                
                <!-- Vista previa de la imagen -->
                <div class="mt-3" id="image_preview">
                    <img src="{{ asset('images/3100-de-2019.jpg') }}" alt="Vista previa" style="max-width: 300px; max-height: 200px; border: 1px solid #ddd; border-radius: 4px;">
                </div>
            </div>

            <div class="form-group">
                <button type="submit" class="btn btn-success btn-lg btn-block">Crear</button>
            </div>
        </form>
    </div>

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

        // Actualizar vista previa de imagen
        $('#background_select').on('change', function() {
            var selectedImage = $(this).val();
            var imageUrl = "{{ asset('images') }}" + "/" + selectedImage;
            $('#image_preview img').attr('src', imageUrl);
        });
    </script>

@endsection

