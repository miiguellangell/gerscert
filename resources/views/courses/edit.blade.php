@extends('layouts.app')

@section('content')
    <div class="signup-form">
        <form action="{{ route('courses.update', $courses) }}" method="post">
            @csrf @method('PATCH')
            <h2>Crear Nuevo Curso</h2>
            <div class="form-group">
                <input type="text"  class="form-control" name="course_name" value="{{ $courses->course_name}}" >
                {!!$errors->first('course_name', '<small>:message</small><br>' )!!}
            </div>
            <div class="form-group">
                <input type="text" class="form-control" name="course_description" value="{{ $courses->course_description}}" required="required">
                {!!$errors->first('course_description', '<small>:message</small><br>' )!!}
            </div>
            <div  class="form-group">
                <input type="number" min="-0" max="9999" class="form-control" name="course_duration" value="{{ $courses->course_duration}}" required="required">
                {!!$errors->first('course_duration', '<small>:message</small><br>' )!!}
            </div>
            <div  class="form-group">
                <input type="number" min="-0" max="9999" class="form-control" name="course_validation" value="{{ $courses->course_validation}}" required="required">
                {!!$errors->first('course_description', '<small>:message</small><br>' )!!}
            </div>
            <div class="form-group">
                <button type="submit" class="btn btn-success btn-lg btn-block">Modificar</button>
            </div>
        </form>
    </div>
@endsection

