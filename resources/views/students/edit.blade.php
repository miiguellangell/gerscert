@extends('layouts.app')

@section('content')
    <div class="signup-form">
        <form action="{{ route('students.update', $students) }}" method="post">
            @csrf @method('PATCH')
            <h2>Editar Estudiante</h2>
                 
            <div class="form-group">
                <label for="typeid">Tipo de documento</label>
                <select class="form-control" name="typeid" id="typeid" required>
                    <option value="">Seleccione un tipo de documento</option>
                    <option value="C.C" {{ $students->typeid == 'C.C' ? 'selected' : '' }}>Cédula de ciudadanía</option>
                    <option value="C.E" {{ $students->typeid == 'C.E' ? 'selected' : '' }}>Cédula de extranjería</option>
                    <option value="T.I" {{ $students->typeid == 'T.I' ? 'selected' : '' }}>Tarjeta de identidad</option>
                    <option value="PAP" {{ $students->typeid == 'PAP' ? 'selected' : '' }}>Pasaporte</option>
                    <option value="PEP" {{ $students->typeid == 'PEP' ? 'selected' : '' }}>Permiso de permanencia</option>
                </select>
            </div>

            <div class="form-group">
                <label for="student_id">Número de documento</label>
                <input type="text" class="form-control" name="student_id" id="student_id" value="{{ $students->id}}" required="required" >
                {!!$errors->first('student_id', '<small>:message</small><br>' )!!}
            </div>

            <div class="form-group">
                <label for="student_name">Nombre del estudiante</label>
                <input type="text" class="form-control" name="student_name" id="student_name" value="{{ $students->student_name}}"  required="required">
                {!!$errors->first('student_name', '<small>:message</small><br>' )!!}
            </div>

            <div class="form-group">
                <label for="student_description">Descripción</label>
                <input type="text" class="form-control" name="student_description" id="student_description" value="{{ $students->student_description}}" required="required">
                {!!$errors->first('student_description', '<small>:message</small><br>' )!!}
            </div>

            <div class="form-group">
                <label for="student_age">Edad</label>
                <input type="number" min="0" max="120" class="form-control" name="student_age" id="student_age" value="{{ $students->student_age}}" required="required">
                {!!$errors->first('student_age', '<small>:message</small><br>' )!!}
            </div>

            <div class="form-group">
                <label for="student_mail">Correo electrónico</label>
                <input type="email" class="form-control" name="student_mail" id="student_mail" value="{{ $students->student_mail}}" required="required">
                {!!$errors->first('student_mail', '<small>:message</small><br>' )!!}
            </div>

            <div class="form-group">
                <button type="submit" class="btn btn-success btn-lg btn-block">Editar</button>
            </div>

        </form>
    </div>
@endsection

