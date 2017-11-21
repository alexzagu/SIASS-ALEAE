@extends('layouts.master')
@section('title', 'SIASS - Ver información de alumno')

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
                                <td>{{$student->major}}</td>
                                <td>{{$student->semester}}</td>
                                <td>{{$student->studentStatus}}</td>
                                @if($student->isCertified)
                                    <td>Liberado</td>
                                    <td>{{Carbon\Carbon::parse($student->certificationDate)->format('d F Y')}}</td>
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
                                <td>{{$student->certifiedUnits}}</td>
                                <td>{{$user->email}}</td>
                                <td>{{$student->campus}}</td>
                                <td>{{$student->mainPhone}}</td>
                                <td>{{$student->secondaryPhone}}</td>
                            </tr>
                            <tr>
                                <th class="bg-info">Horas Acreditadas SSC</th>
                                <td>{{$student->totalCertifiedHoursSSC}}</td>
                                <th class="bg-info">Horas por Acreditadar SSC</th>
                                <td colspan="2">{{$student->totalRegisteredHoursSSC}}</td>
                            </tr>
                            <tr>
                                <th class="bg-info">Horas Acreditadas SSP</th>
                                <td>{{$student->totalCertifiedHoursSSP}}</td>
                                <th class="bg-info">Horas por Acreditadar SSP</th>
                                <td colspan="2">{{$student->totalRegisteredHoursSSP}}</td>
                            </tr>
                            <tr>
                                <th class="bg-info">Total Acreditadas SS</th>
                                <td>{{$totalCertifiedHoursSS}}</td>
                                <th class="bg-info">Total por Acreditadas SS</th>
                                <td colspan="2">{{$totalRegisteredHoursSS}}</td>
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
@endsection
