@extends('layouts.master')
{{ Carbon\Carbon::setLocale('mx') }}
@if($user->isAdmin())
    @section('title', 'SIASS - Administrador')
@endif

@if($user->isPartner())
    @section('title', 'SIASS - Socio')
@endif

@if($user->isStudent())
    @section('title', 'SIASS - Alumno')
@endif

@section('navbar')
    @include('layouts.navbar')
@endsection

@section('content')
    <div class="row">
        <div class="col-md-12">
            <h1>{{ $user->role }}</h1>
            <p>Tu perfil de usuario es de tipo {{ $user->role }}</p>

            @if($user->isAdmin())
                <a href="/admin/register-partner" type="button" class="btn btn-default navbar-btn">Registrar un nuevo socio en el sistema</a>
            @endif

            @if($user->isPartner())
                <a href="/partner/register-social-service" type="button" class="btn btn-default navbar-btn">Registrar un nuevo servicio social</a>
                <br>
                <h1>Mis servicios sociales</h1>

                <div class="table-responsive">
                    <table class="table">
                        <tr>
                            <th>Clave de servicio social</th>
                            <th>Nombre de servicio social</th>
                            <th>Total de horas para acreditar</th>
                            <th>Cupo total de estudiantes</th>
                            <th>Cupo actual de estudiantes</th>
                            <th>Fecha de inicio</th>
                            <th>Fecha de terminación</th>
                            <th>Campus</th>
                        </tr>
                        @foreach($user->userInfo->socialServices as $socialService)
                            <tr>
                                <td>{{ $socialService->id }}</td>
                                <td>{{ $socialService->name }}</td>
                                <td>{{ $socialService->totalHours }}</td>
                                <td>{{ $socialService->capability }}</td>
                                <td>{{ $socialService->currentCapability }}</td>
                                <td>{{ Carbon\Carbon::parse($socialService->startDate)->format('d F Y') }}</td>
                                <td>{{ Carbon\Carbon::parse($socialService->endDate)->format('d F Y') }}</td>
                                <td>{{ $socialService->campus }}</td>
                            </tr>
                        @endforeach
                    </table>
                </div>
            @endif

            @if($user->isStudent())
                <div class="container">
                    <div class="row">
                        <div class="col-md-12 ">

                            <h2>Informacion del Alumno</h2>
                            <div class="table-responsive">
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
                </div>
            @endif

            @if (session('register-success'))
                <div class="alert alert-success">
                    {{ session('register-success') }}
                </div>
            @endif

            @if (session('register-fail'))
                <div class="alert alert-danger">
                    {{ session('register-fail') }}
                </div>
            @endif
        </div>
    </div>
@endsection

