@extends('layouts.app')

@section('content')
    <div class="signup-form">
        <form action="{{ route('certificate.update', $certificate) }}" method="post">
            @csrf @method('PATCH')

            @csrf
            <h2>Nuevo Certificado</h2>

            <div class="form-group">
                <label >Seleccione Un Estudiante</label>
                <select class="selectpicker" data-live-search="true" name="students_id" id="">
                    <option value="">Estudiantes</option>

                    @foreach ($students as $student)
                    <option value="{{$student->id}}" {{ $certificate->students_id == $student->id ? 'selected' : '' }}>{{$student->student_name}}</option>

                    @endforeach
                </select>
            </div>

            <div class="form-group">
                <label >Seleccione Un curso</label>
                <select class="selectpicker" data-live-search="true" name="courses_id" id="">
                    <option value="">Cursos</option>

                    @foreach ($courses as $course)
                    <option value="{{$course->id}}" {{ $certificate->courses_id == $course->id ? 'selected' : '' }}>{{$course->course_name}}</option>

                    @endforeach
                </select>
            </div>

            <div  class="form-group">
                <label >Seleccione Una fecha de Expedicion</label>
               <div class="row" >
                    <div class="col">
                        <input name="certificate_expedition" data-date-format="yyyy-m-d" id="datepicker" value="{{ $certificate->certificate_expedition }}">
                    </div>
                </div>
            </div>

            <div class="form-group">
                <label>Seleccione la imagen de fondo del certificado</label>
                <select class="selectpicker" name="background_image" id="background_select">
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
        $('#datepicker').datepicker("setDate", new Date("{{ $certificate->certificate_expedition }}"));

        // Actualizar vista previa de imagen
        $('#background_select').on('change', function() {
            var selectedImage = $(this).val();
            var imageUrl = "{{ asset('images') }}" + "/" + selectedImage;
            $('#image_preview img').attr('src', imageUrl);
        });
    </script>

@endsection

