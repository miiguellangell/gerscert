@extends('layouts.app')

@section('content')
    <div class="signup-form">
        <form action="{{ route('students.store')}}" method="post">
            @csrf
            <h2>Nuevo Estudiante</h2>
            
            <div class="form-group">
            <select class="selectpicker" data-live-search="true" name="typeid" id="">
                    <option value="">Seleccione un tipo de documento de estudiante</option>
                    <option value="C.C">Cedula de ciudadania</option>
                    <option value="C.E">Cedula de extrajeria</option>
                    <option value="T.I">Tarjeta de identidad</option>
                    <option value="PAP">Pasaporte</option>
                    <option value="PEP">Permiso de permanencia</option>
                </select>
             </div>
             
            <div class="form-group">
                <input type="number" class="form-control" name="id" placeholder="Documento del estudiante" >
                {!!$errors->first('student_id', '<small>:message</small><br>' )!!}
            </div>

            <div class="form-group">
                <input type="text" class="form-control" name="student_name" placeholder="Nombre del estudiante" >
                {!!$errors->first('student_name', '<small>:message</small><br>' )!!}
            </div>
            <div class="form-group">
                <input type="text" class="form-control" name="student_description" placeholder="Descripcion del estudiante" required="required">
                {!!$errors->first('student_description', '<small>:message</small><br>' )!!}
            </div>
            <div  class="form-group">
                <input type="number" min="-0" max="120" class="form-control" name="student_age" placeholder="Edad del estudiante" required="required">
                {!!$errors->first('student_duration', '<small>:message</small><br>' )!!}
            </div>
            <div  class="form-group">
                <input type="email"  class="form-control" name="student_mail" placeholder="Correo del estudiante" required="required">
                {!!$errors->first('student_validation', '<small>:message</small><br>' )!!}
            </div>
            <div class="form-group">
                <button type="submit" class="btn btn-success btn-lg btn-block">Crear</button>
            </div>
        </form>
    </div>
@endsection

