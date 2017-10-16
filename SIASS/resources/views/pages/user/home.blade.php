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

            @if($user->isAdmin())
                <div class="container">
                    <div class="row">
                        <div class="col-md-12 ">

                            <h2>Informacion del Admininstrador</h2>
                            <div class="table-responsive">
                                <table style="width:100%" class="table">
                                    <tr>
                                        <th>Nombre</th>
                                        <th>Correo Electronico</th>
                                        <th>Departamento</th>
                                        <th>Teléfono</th>
                                        <th>Extensión</th>
                                    </tr>
                                    <tr>
                                        <th>{{$user->name}}</th>
                                        <th>{{$user->email}}</th>
                                        <th>{{$admin->department}}</th>
                                        <th>{{$admin->phone}}</th>
                                        <th>{{$admin->phoneExtension}}</th>
                                    </tr>
                                </table>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-md-4">
                            <p>
                                <a class="btn btn-primary btn-lg" href="/admin/register-partner" role="button">
                                    Registrar Socio Formador
                                </a>
                            </p>
                            <p>
                                <a class="btn btn-primary btn-lg" href="/admin/register-social-service" role="button">
                                    Registrar un nuevo proyecto social
                                </a>
                            </p>
                        </div>
                    </div>
                </div>
            @endif

            @if($user->isPartner())
                <a href="/partner/register-social-service" type="button" class="btn btn-primary btn-lg">
                    Registrar un nuevo proyecto social
                </a>
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

                            <h2>Historial</h2>

                            <div class="table-responsive">
                                <table style="width:100%" class="table table-bordered">
                                    <tr class="bg-primary">
                                        <th colspan="5">Historial del Alumno en Servicio Social</th>
                                    </tr>
                                    <tr class="bg-info">
                                        <th>Matricula</th>
                                        <th>Nombre</th>
                                        <th>Carrera</th>
                                        <th>Semestre</th>
                                        <th>Estatus</th>
                                    </tr>
                                    <tr>
                                        <td>{{$user->id}}</td>
                                        <td>{{$user->name}}</td>
                                        <td>{{$userInfo->major}}</td>
                                        <td>{{$userInfo->semester}}</td>
                                        <td>{{$userInfo->studentStatus}}</td>
                                    </tr>
                                </table>
                            </div>

                            <div class="table-responsive">
                                <table style="width:100%" class="table table-bordered">
                                    <tr class="bg-primary">
                                        <th colspan="5">Información del Alumno</th>
                                    </tr>
                                    <tr class="bg-info">
                                        <th>Unidades Acreditadas</th>
                                        <th>Correo</th>
                                        <th>Campus</th>
                                        <th>Tel.Primario</th>
                                        <th>Tel.Secundario</th>
                                    </tr>
                                    <tr>
                                        <td>{{$userInfo->certifiedUnits}}</td>
                                        <td>{{$user->email}}</td>
                                        <td>{{$userInfo->campus}}</td>
                                        <td>{{$userInfo->mainPhone}}</td>
                                        <td>{{$userInfo->secondaryPhone}}</td>
                                    </tr>
                                    <tr>
                                        <th class="bg-info">Horas Acreditadas SSC</th>
                                        <td>{{$userInfo->totalCertifiedHoursSSC}}</td>
                                        <th class="bg-info">Horas por Acreditadar SSC</th>
                                        <td colspan="2">{{240 - $userInfo->totalCertifiedHoursSSC}}</td>
                                    </tr>
                                    <tr>
                                        <th class="bg-info">Horas Acreditadas SSP</th>
                                        <td>{{$userInfo->totalCertifiedHoursSSP}}</td>
                                        <th class="bg-info">Horas por Acreditadar SSP</th>
                                        <td colspan="2">{{240 - $userInfo->totalCertifiedHoursSSP}}</td>
                                    </tr>
                                    <tr>
                                        <th class="bg-info">Total Acreditadas SSC</th>
                                        <td>{{$userInfo->totalCertifiedHoursSSC + $userInfo->totalCertifiedHoursSSP}}</td>
                                        <th class="bg-info">Total Acreditadas SSP</th>
                                        <td colspan="2">{{(240 - $userInfo->totalCertifiedHoursSSC) + (240 - $userInfo->totalCertifiedHoursSSP)}}</td>
                                    </tr>
                                </table>
                            </div>

                            <div class="table-responsive">
                                <table style="width:100%" class="table table-bordered">
                                    <tr class="bg-primary">
                                        <th colspan="4">Reporte de Experiencias Ciudadanas (REC)</th>
                                    </tr>
                                    <tr class="bg-info">
                                        <th>Periodo</th>
                                        <th>Fecha de Envío</th>
                                        <th>Fecha de Aplicación</th>
                                        <th>Estatus</th>
                                    </tr>
                                    <tr>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                    </tr>
                                </table>
                            </div>



                            <div class="table-responsive">
                                <table style="width:100%" class="table table-bordered">
                                    <tr class="bg-primary">
                                        <th colspan="6">Taller de Inducción</th>
                                    </tr>
                                    <tr class="bg-info">
                                        <th>Grupo</th>
                                        <th>Periodo</th>
                                        <th>Fecha Taller</th>
                                        <th>Campus</th>
                                        <th>Estatus</th>
                                        <th>Carta</th>
                                    </tr>
                                    <tr>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                        <td></td>
                                    </tr>
                                </table>
                            </div>

                            <h3>Proyectos y Actividades de aprendizaje ciudadano</h3>

                            <div class="table-responsive">
                                <table style="width:100%" class="table table-bordered">
                                    <tr class="bg-primary">
                                        <th>#</th>
                                        <th>Periodo</th>
                                        <th>Campus</th>
                                        <th>Tipo</th>
                                        <th>Institución/Empresa</th>
                                        <th>Fecha Inicio</th>
                                        <th>Fecha Término</th>
                                        <th>Hrs.Registradas</th>
                                        <th>Hrs.Acreditadas</th>
                                        <th>Estatus</th>
                                        <th>Carta Finiquito</th>
                                    </tr>
                                    @foreach($user->userInfo->studentServices as $studentService)
                                        <tr>
                                            <td>{{ $studentService->id }}</td>
                                            <td>{{ $studentService->socialService->period }}</td>
                                            <td>{{ $studentService->socialService->campus }}</td>
                                            <td>{{ $studentService->socialService->type }}</td>
                                            <td>{{ $studentService->socialService->managerName }}</td>
                                            <td>{{ Carbon\Carbon::parse($studentService->socialService->startDate)->format('d F Y') }}</td>
                                            <td>{{ Carbon\Carbon::parse($studentService->socialService->endDate)->format('d F Y') }}</td>
                                            <td>{{ $studentService->socialService->totalHours }}</td>
                                            <td>{{ $studentService->certifiedHours}}</td>
                                            <td>{{ $studentService->status}}</td>
                                            <td>{{ $studentService->dischargeLetter}}</td>
                                        </tr>
                                    @endforeach
                                </table>
                            </div>

                            <div class="table-responsive">
                                <table style="width:100%" class="table">
                                    <tr>
                                        <th>SSC: Servicio Social Ciudadano en Organización</th>
                                        <th>SSP: Servicio Social Profesional</th>
                                        <th>ASS: Servicio Social Ciudadano a través de materias</th>
                                        <th>ACC: Actividad de aprendizaje en materia sin acreditación de horas</th>
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

