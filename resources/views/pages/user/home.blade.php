@extends('layouts.master')

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
                            <h2>Información del Admininstrador</h2>
                            <div class="table-responsive">
                                <table style="width:100%" class="table table-bordered">
                                    <tr>
                                        <th>Nombre</th>
                                        <th>Correo Electronico</th>
                                        <th>Departamento</th>
                                        <th>Teléfono</th>
                                        <th>Extensión</th>
                                    </tr>
                                    <tr>
                                        <td>{{$user->name}}</td>
                                        <td>{{$user->email}}</td>
                                        <td>{{$admin->department}}</td>
                                        <td>{{$admin->phone}}</td>
                                        <td>{{$admin->phoneExtension}}</td>
                                    </tr>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            @endif

            @if($user->isPartner())
                <div class="container">
                    <div class="row">
                        <div class="col-md-12 ">
                            <h2>Mis servicios sociales</h2>
                            <div class="table-responsive">
                                <table style="width:100%" class="table table-bordered">
                                    <tr>
                                        <th>Nombre institución</th>
                                        <th>Clave de servicio social</th>
                                        <th>Nombre del servicio social</th>
                                        <th>Total de horas para acreditar</th>
                                        <th>Cupo total de estudiantes</th>
                                        <th>Cupo actual de estudiantes</th>
                                        <th>Fecha de inicio</th>
                                        <th>Fecha de terminación</th>
                                        <th>Campus</th>
                                    </tr>
                                    @foreach($user->userInfo->socialServices as $socialService)
                                        <tr>
                                            <td>{{ $user->userInfo->partnerName }}</td>
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
                        </div>
                    </div>
                </div>
            @endif

            @if($user->isStudent())
                <div class="container">
                    <div class="row">
                        <div class="col-md-12 ">

                            <div class="table-responsive">
                                <table style="width:100%" class="table table-bordered">
                                    <h2>Historial del Alumno en Servicio Social</h2>
                                    <tr>
                                        <th>Matrícula</th>
                                        <th>Nombre</th>
                                        <th>Carrera</th>
                                        <th>Semestre</th>
                                        <th>Estatus</th>
                                        <th>Servicio Social</th>
                                        <th>Fecha Finiquito</th>
                                    </tr>
                                    <tr>
                                        <td>{{$user->id}}</td>
                                        <td>{{$user->name}}</td>
                                        <td>{{$userInfo->major}}</td>
                                        <td>{{$userInfo->semester}}</td>
                                        <td>{{$userInfo->studentStatus}}</td>
                                        @if($userInfo->isCertified)
                                            <td>Liberado</td>
                                            <td>{{Carbon\Carbon::parse($userInfo->certificationDate)->format('d F Y')}}</td>
                                        @else
                                            <td>No Liberado</td>
                                            <td>-----------</td>
                                        @endif
                                    </tr>
                                </table>
                            </div>

                            <div class="table-responsive">
                                <table style="width:100%" class="table table-bordered">
                                    <h2>Información del Alumno</h2>
                                    <tr class="bg-primary">
                                        <th>Unidades Acreditadas</th>
                                        <th>Correo</th>
                                        <th>Campus</th>
                                        <th>Tel. Primario</th>
                                        <th>Tel. Secundario</th>
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
                                        <td colspan="2">{{$userInfo->totalRegisteredHoursSSC}}</td>
                                    </tr>
                                    <tr>
                                        <th class="bg-info">Horas Acreditadas SSP</th>
                                        <td>{{$userInfo->totalCertifiedHoursSSP}}</td>
                                        <th class="bg-info">Horas por Acreditadar SSP</th>
                                        <td colspan="2">{{$userInfo->totalRegisteredHoursSSP}}</td>
                                    </tr>
                                    <tr>
                                        <th class="bg-info">Total de Horas Acreditadas SS</th>
                                        <td>{{$userInfo->totalCertifiedHoursSS}}</td>
                                        <th class="bg-info">Total de Horas por Acreditadar SS</th>
                                        <td colspan="2">{{$userInfo->totalRegisteredHoursSS}}</td>
                                    </tr>
                                </table>
                            </div>

                            <div class="table-responsive">
                                <table style="width:100%" class="table table-bordered">
                                    <h2>Reporte de Experiencias Ciudadanas (REC)</h2>
                                    <tr class="bg-primary">
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
                                    <h2>Taller de Inducción</h2>
                                    <tr class="bg-primary">
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

                            <div class="table-responsive">
                                <table style="width:100%" class="table table-bordered">
                                    <h2>Proyectos y Actividades de aprendizaje ciudadano</h2>
                                    <tr class="bg-primary">
                                        <th>#</th>
                                        <th>Periodo</th>
                                        <th>Campus</th>
                                        <th>Tipo</th>
                                        <th>Institución/Empresa</th>
                                        <th>Fecha Inicio</th>
                                        <th>Fecha Término</th>
                                        <th>Hrs. Registradas</th>
                                        <th>Hrs. Acreditadas</th>
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
                                            <td>{{ $studentService->registeredHours }}</td>
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
        </div>
    </div>
@endsection

