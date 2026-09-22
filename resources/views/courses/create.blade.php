@extends('layouts.app')

@section('content')
    <div class="signup-form">
        <form action="{{ route('courses.store')}}" method="post">
            @csrf
            <h2>Crear Nuevo Curso</h2>
            <div class="form-group">
                <input type="text" class="form-control" name="course_name" placeholder="Nombre del Curso" >
                {!!$errors->first('course_name', '<small>:message</small><br>' )!!}
            </div>
            <div class="form-group">
                <input type="text" class="form-control" name="course_description" placeholder="Descripcion del curso" required="required">
                {!!$errors->first('course_description', '<small>:message</small><br>' )!!}
            </div>
            <div  class="form-group">
                <input type="number" min="-0" max="9999" class="form-control" name="course_duration" placeholder="Duracion del curso" required="required">
                {!!$errors->first('course_duration', '<small>:message</small><br>' )!!}
            </div>
            <div  class="form-group">
                <input type="number" min="-0" max="9999" class="form-control" name="course_validation" placeholder="Validez del curso" required="required">
                {!!$errors->first('course_validation', '<small>:message</small><br>' )!!}
            </div>
            <div class="form-group">
                <button type="submit" class="btn btn-success btn-lg btn-block">Crear</button>
            </div>
        </form>
    </div>
@endsection

