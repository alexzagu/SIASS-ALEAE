@extends('layouts.master')

@section('title', 'SIASS - Alumno')

@section('navbar')
    @include('layouts.navbar')
@endsection

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-12 ">

                <h2>Informacion del Alumno</h2>

                <table style="width:100%" class="table">
                    <tr>
                        <th>Nombre</th>
                        <th>Correo Electronico</th>
                        <th>Carrera</th>
                        <th>Plan de Estudios</th>
                        <th>Campus</th>
                        <th>Estatus</th>
                        <th>Unidades Acreditadas</th>
                    </tr>
                    <tr>
                        <th>{{$user->name}}</th>
                        <th>{{$user->email}}</th>
                        <th>{{$student->major}}</th>
                        <th>{{$student->studyPlan}}</th>
                        <th>{{$student->campus}}</th>
                        <th>{{$student->studentStatus}}</th>
                        <th>{{$student->certifiedUnits}}</th>
                    </tr>
                </table>

                <h2>Servicio Social Ciudadano</h2>

                <table style="width:100%" class="table">
                    <tr>
                        <th>Total horas certificadas</th>
                        <th>Total horas registradas</th>
                    </tr>
                    <tr>
                        <th>{{$student->totalCertifiedHoursSSC}}</th>
                        <th>{{$student->totalRegisteredHoursSSC}}</th>
                    </tr>
                </table>

                <h2>Servicio Social Profesional</h2>

                <table style="width:100%" class="table">
                    <tr>
                        <th>Total horas certificadas</th>
                        <th>Total horas registradas</th>
                    </tr>
                    <tr>
                        <th>{{$student->totalCertifiedHoursSSP}}</th>
                        <th>{{$student->totalRegisteredHoursSSP}}</th>
                    </tr>
                </table>
            </div>
        </div>
    </div>
@endsection

