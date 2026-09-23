@extends('layouts.app')

@section('content')
    <div class="signup-form">
        <form action="{{ route('courses.store')}}" method="post">
            @csrf
            <h2>Crear Nuevo Curso</h2>
            <div class="form-group">
                <label for="course_name">Nombre del curso</label>
                <input type="text" class="form-control" name="course_name" id="course_name" placeholder="Ej: Primeros auxilios" required>
                {!!$errors->first('course_name', '<small>:message</small><br>' )!!}
            </div>
            <div class="form-group">
                <label for="course_description">Descripción</label>
                <input type="text" class="form-control" name="course_description" id="course_description" placeholder="Ej: Curso básico de primeros auxilios" required="required">
                {!!$errors->first('course_description', '<small>:message</small><br>' )!!}
            </div>
            <div class="form-group">
                <label for="course_duration">Duración (horas)</label>
                <input type="number" min="0" max="9999" class="form-control" name="course_duration" id="course_duration" placeholder="Ej: 40" required="required">
                {!!$errors->first('course_duration', '<small>:message</small><br>' )!!}
            </div>
            <div class="form-group">
                <label for="course_validation">Vigencia (años)</label>
                <input type="number" min="0" max="9999" class="form-control" name="course_validation" id="course_validation" placeholder="Ej: 2" required="required">
                {!!$errors->first('course_validation', '<small>:message</small><br>' )!!}
            </div>
            <div class="form-group">
                <button type="submit" class="btn btn-success btn-lg btn-block">Crear</button>
            </div>
        </form>
    </div>
@endsection

