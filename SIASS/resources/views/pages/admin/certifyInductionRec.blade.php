@extends('layouts.master')

@section('title', 'SIASS - Acreditar talleres e inducción')

@include('layouts.navbar')

@section('content')
    <div class="col-md-12">
        <form action="" method="GET" class="form-inline">
            <div class="form-group">
                <label for="studentIDField">Matrícula </label>
                <input type="text" name="user_id" class="form-control" required>
            </div>
            <div class="form-group">
                <button type="submit" class="btn btn-primary">Buscar</button>
            </div>
        </form>
    </div>
    @if(isset($student))
        <div class="col-md-12">
            <label>Alumno: {{ $student->user->name }}</label>
            <label>Matricula: {{ $student->user->id }}</label>
            <h3>Información del alumno</h3>
            <table class="table-bordered table">
                <tr>
                    <th>Matricula</th>
                    <th>Nombre</th>
                    <th>Campus</th>
                    <th>Carrera</th>
                    <th>Semestre</th>
                    <th>Estatus Academico</th>
                </tr>
                <tr>
                    <td>{{ $student->user->id }}</td>
                    <td>{{ $student->user->name }}</td>
                    <td>{{ $student-> campus }}</td>
                    <td> {{ $student-> major }}</td>
                    <td> {{ $student-> semester }}</td>
                    <td> {{ $student-> studentStatus }}</td>
                </tr>
            </table>
            <form method="POST" action="{{ route('certify-induction-rec', $student->user_id) }}">
                {{ csrf_field() }}
                {{ method_field('PUT') }}
                <div class="table-responsive">
                    <h3>Taller de inducción a servicio social</h3>
                    <table class="table-bordered table">
                        <tr>
                            <th>Fecha de sesión</th>
                            <th>Fecha de terminación</th>
                            <th>¿Acreditado?</th>
                        </tr>
                        <tr>
                            <td>{{ Carbon\Carbon::parse($student->introductionCouseStart)->format('d F Y') }}</td>
                            <td>{{ Carbon\Carbon::parse($student->introductionCouseEnd)->format('d F Y') }}</td>
                            <td><input type="checkbox" name="introductionCourseCertified" {{ $student->introductionCourseCertified ? 'checked' : '' }}> {{ $student->introductionCourseCertified ? ' Acreditado' :  ' No acreditado' }}</td>
                        </tr>
                    </table>
                    <h3>Reporte de Experiencias Ciudadanas (REC)</h3>
                    <table class="table-bordered table">
                        <tr>
                            <th>Fecha de sesión</th>
                            <th>Fecha de entrega</th>
                            <th>¿Acreditado?</th>
                        </tr>
                        <tr>
                            <td>{{ Carbon\Carbon::parse($student->recCourseStars)->format('d F Y') }}</td>
                            <td>{{ Carbon\Carbon::parse($student->recCourseUpload)->format('d F Y') }}</td>
                            <td><input type="checkbox" name="recCourseCertified" {{ $student->recCourseCertified ? 'checked' : '' }}> {{ $student->introductionCourseCertified ? ' Acreditado' :  ' No acreditado' }}</td>
                        </tr>
                    </table>
                </div>
                <div class="form-group">
                    <button type="submit" class="btn btn-primary">Actualizar información</button>
                </div>
            </form>
        </div>
    @endif
@endsection