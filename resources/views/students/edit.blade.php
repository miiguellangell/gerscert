@extends('layouts.app')

@section('content')
    <div class="signup-form">
        <form action="{{ route('students.update', $students) }}" method="post">
            @csrf @method('PATCH')
            <h2>Editar Estudiante</h2>
                 
            <div class="form-group">
            <select class="selectpicker" data-live-search="true" name="typeid" id="">
                    <option value="">Seleccione un tipo de documento</option>
                    <option value="C.C">Cedula de ciudadania</option>
                    <option value="C.E">Cedula de extrajeria</option>
                    <option value="T.I">Tarjeta de identidad</option>
                    <option value="PAP">Pasaporte</option>
                    <option value="PEP">Permiso de permanencia</option>
                </select>
             </div>
             
            <div class="form-group">
                <input type="text"  class="form-control" name="student_id" value="{{ $students->id}}" required="required" >
                {!!$errors->first('student_id', '<small>:message</small><br>' )!!}
            </div>

            <div class="form-group">
                <input type="text"  class="form-control" name="student_name" value="{{ $students->student_name}}"  required="required">
                {!!$errors->first('student_name', '<small>:message</small><br>' )!!}
            </div>

            <div class="form-group">
                <input type="text" class="form-control" name="student_description" value="{{ $students->student_description}}" required="required">
                {!!$errors->first('student_description', '<small>:message</small><br>' )!!}
            </div>

            <div  class="form-group">
                <input type="number" min="-0" max="120" class="form-control" name="student_age" value="{{ $students->student_age}}" required="required">
                {!!$errors->first('student_age', '<small>:message</small><br>' )!!}
            </div>

            <div  class="form-group">
                <input type="email" class="form-control" name="student_mail" value="{{ $students->student_mail}}" required="required">
                {!!$errors->first('student_mail', '<small>:message</small><br>' )!!}
            </div>

            <div class="form-group">
                <button type="submit" class="btn btn-success btn-lg btn-block">Editar</button>
            </div>

        </form>
    </div>
@endsection

