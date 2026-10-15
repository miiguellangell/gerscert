@extends('layouts.app')

@section('content')
    <div class="signup-form">
        <form action="{{ route('courses.update', $courses) }}" method="post">
            @csrf @method('PATCH')
            <h2>Editar Curso</h2>
            <div class="form-group">
                <label for="course_name">Nombre del curso</label>
                <input type="text" class="form-control" name="course_name" id="course_name" value="{{ $courses->course_name}}" required>
                {!!$errors->first('course_name', '<small>:message</small><br>' )!!}
            </div>
            <div class="form-group">
                <label for="course_description">Descripción</label>
                <input type="text" class="form-control" name="course_description" id="course_description" value="{{ $courses->course_description}}" required="required">
                {!!$errors->first('course_description', '<small>:message</small><br>' )!!}
            </div>
            <div class="form-group">
                <label for="course_duration">Duración (horas)</label>
                <input type="number" min="0" max="9999" class="form-control" name="course_duration" id="course_duration" value="{{ $courses->course_duration}}" required="required">
                {!!$errors->first('course_duration', '<small>:message</small><br>' )!!}
            </div>
            <div class="form-group">
                <label for="course_validation">Vigencia (años)</label>
                <input type="number" min="0" max="9999" class="form-control" name="course_validation" id="course_validation" value="{{ $courses->course_validation}}" required="required">
                {!!$errors->first('course_validation', '<small>:message</small><br>' )!!}
            </div>
            <div class="form-group">
                <label for="wp_course_id">ID del curso en WordPress</label>
                <input type="number" min="1" class="form-control" name="wp_course_id" id="wp_course_id" value="{{ $courses->wp_course_id }}">
                <small class="form-text text-muted">ID del curso de Tutor LMS en gerscol.com. Vacío si el curso no existe allá.</small>
                {!!$errors->first('wp_course_id', '<small>:message</small><br>' )!!}
            </div>
            <div class="form-group">
                <button type="submit" class="btn btn-success btn-lg btn-block">Modificar</button>
            </div>
        </form>
    </div>
@endsection

