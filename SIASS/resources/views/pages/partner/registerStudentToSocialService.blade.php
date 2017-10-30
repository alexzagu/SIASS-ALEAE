@extends('layouts.master')

@section('navbar')
    @include('layouts.navbar')
@endsection

@section('title', 'SIASS - Registro de Estudiante a Servicio Social')

@section('content')
    <div class="row">
        <div class="col-md-12">
            <form action="{{ route('partner-registers-student-service') }}" method="POST">
                {{ csrf_field() }}
                <div class="form-group">
                    <label for="studentIDField">Matrícula del Alumno</label>
                    <input name="studentId" type="text" class="form-control" id="studentIDField" placeholder="Matrícula del Alumno">
                    <small id="studentIDHelp" class="form-text text-muted">Favor de escribir en el siguiente formato: A0XXXXXXX</small>
                </div>
                <div class="form-group">
                    <label for="socialServiceIDField">Identificador del Servicio Social</label>
                    <input name="socialServiceID" type="text" class="form-control" id="socialServiceIDField" placeholder="Identificador del Servicio Social">
                </div>
                <div class="form-group">
                    <button type="submit" class="btn btn-primary">Registrar Estudiante</button>
                </div>
            </form>
        </div>
    </div>
@endsection