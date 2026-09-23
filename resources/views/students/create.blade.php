@extends('layouts.app')

@section('content')
    <div class="signup-form">
        <form action="{{ route('students.store')}}" method="post">
            @csrf
            <h2>Nuevo Estudiante</h2>
            
            <div class="form-group">
                <label for="typeid">Tipo de documento</label>
                <select class="form-control" name="typeid" id="typeid" required>
                    <option value="">Seleccione un tipo de documento</option>
                    <option value="C.C">Cédula de ciudadanía</option>
                    <option value="C.E">Cédula de extranjería</option>
                    <option value="T.I">Tarjeta de identidad</option>
                    <option value="PAP">Pasaporte</option>
                    <option value="PEP">Permiso de permanencia</option>
                </select>
            </div>

            <div class="form-group">
                <label for="id">Número de documento</label>
                <input type="number" class="form-control" name="id" id="id" placeholder="Ej: 1045762323" required>
                {!!$errors->first('student_id', '<small>:message</small><br>' )!!}
            </div>

            <div class="form-group">
                <label for="student_name">Nombre del estudiante</label>
                <input type="text" class="form-control" name="student_name" id="student_name" placeholder="Ej: Juan Pérez" required>
                {!!$errors->first('student_name', '<small>:message</small><br>' )!!}
            </div>
            <div class="form-group">
                <label for="student_description">Descripción</label>
                <input type="text" class="form-control" name="student_description" id="student_description" placeholder="Ej: Estudiante regular" required="required">
                {!!$errors->first('student_description', '<small>:message</small><br>' )!!}
            </div>
            <div class="form-group">
                <label for="student_age">Edad</label>
                <input type="number" min="0" max="120" class="form-control" name="student_age" id="student_age" placeholder="Ej: 29" required="required">
                {!!$errors->first('student_duration', '<small>:message</small><br>' )!!}
            </div>
            <div class="form-group">
                <label for="student_mail">Correo electrónico</label>
                <input type="email" class="form-control" name="student_mail" id="student_mail" placeholder="Ej: correo@ejemplo.com" required="required">
                {!!$errors->first('student_validation', '<small>:message</small><br>' )!!}
            </div>
            <div class="form-group">
                <label for="student_phone">Número de teléfono</label>
                <input type="tel" class="form-control" name="student_phone" id="student_phone" placeholder="Ej: 3001234567" required>
                {!!$errors->first('student_phone', '<small>:message</small><br>' )!!}
            </div>
            <div class="form-group">
                <button type="submit" class="btn btn-success btn-lg btn-block">Crear</button>
            </div>
        </form>
    </div>
@endsection

