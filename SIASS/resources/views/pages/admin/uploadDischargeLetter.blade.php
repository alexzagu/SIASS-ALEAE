@extends('layouts.master')

@section('title', 'SIASS - Registrar carta finiquito')

@include('layouts.navbar')

@section('content')
    <div class="col-md-12">
        <form action="" method="GET" class="form-inline">
            <div class="form-group">
                <label for="studentIDField">Matricula </label>
                <input type="text" name="student_id" class="form-control" required>
            </div>
            <div class="form-group">
                <button type="submit" class="btn btn-primary">Buscar</button>
            </div>
        </form>
    </div>

    @if(isset($student))
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
                <td>{{ $student-> major }}</td>
                <td>{{ $student-> semester }}</td>
                <td>{{ $student-> studentStatus }}</td>
            </tr>
        </table>
        <h3>Proyectos sociales en los que esta registrado</h3>
        <table class="table-bordered table">
            <tr>
                <th>Clave del proyecto</th>
                <th>Nombre del proyecto</th>
                <th>Socio formador del proyecto</th>
                <th>Carta finiquito</th>
                <th>Eliminar carta</th>
                <th></th>
            </tr>
            @foreach($student_services as $student_service)
                <tr>
                    <td>{{ $student_service->socialService->id }}</td>
                    <td>{{ $student_service->socialService->name }}</td>
                    <td>{{ $student_service->socialService->partner->partnerName }}</td>
                    <td class="text-center">
                        {!!
                            $student_service->dischargeLetter != "" ?
                            '<a type="button" class="btn btn-success" href="'."/letter/download/".$student_service->dischargeLetter.'">Descargar</a>'
                            :
                            '<form class="form" method="POST" id="uploadForm" action="'.route("upload-discharge-letter").'" enctype="multipart/form-data" onclick="confirmSubmit()">'
                                .csrf_field().
                                '<input type="hidden" name="student_service_id" value="'.$student_service->id.'">
                                <div class="form-group">
                                    <label for="file" class="control-label">Carta finiquito</label>
                                    <input name="file" type="file" class="form-control">
                                </div>
                                <button type="submit" id="uploadButton" class="btn btn-primary">Guardar carta</button>
                            </form>'
                    !!}
                    </td>
                    <td class="text-center">
                        {!!
                            $student_service->dischargeLetter != "" ?
                            '<form method="post" id="deleteForm" action="'.route("delete-letter", $student_service->dischargeLetter).'" onclick="confirmSubmit()">'
                                .csrf_field()
                                .method_field('DELETE')
                                .'<button type="submit" id="deleteButton" class="btn btn-danger submitButton">Borrar carta</button>
                            </form>'
                            :
                            'No se ha registrado ninguna carta finiquito para este proyecto social.'
                         !!}
                    </td>
                    <td class="text-center"><button type="button" class="btn btn-info btn-lg" data-toggle="modal" data-target="#{{ $student_service->socialService->id }}">Más información</button></td>
                </tr>
                <div class="modal fade" id="{{ $student_service->socialService->id }}" role="dialog">
                    <div class="modal-dialog">

                        <!-- Modal content-->
                        <div class="modal-content">
                            <div class="modal-header">
                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                <h4 class="modal-title">{{ $student_service->socialService->name }}</h4>
                            </div>
                            <div class="modal-body">
                                <p><strong>Clave del proyecto:</strong> {{ $student_service->socialService->id }}</p>
                                <p><strong>Socio formador:</strong> {{ $student_service->socialService->partner->partnerName }}</p>
                                <p><strong>Nombre del proyecto:</strong> {{ $student_service->socialService->name }}</p>
                                <p><strong>Descripción del proyecto:</strong> {{ $student_service->socialService->description }}</p>
                                <p><strong>Horas posibles para acreditar:</strong> {{ $student_service->socialService->totalHours }}</p>
                                <p><strong>Dirección:</strong> {{ $student_service->socialService->address }}</p>
                                <p><strong>Coordinador del proyecto:</strong> {{ $student_service->socialService->managerName }}</p>
                                <p><strong>Correo del coordinador:</strong> {{ $student_service->socialService->managerMail }}</p>
                                <p><strong>Teléfono del coordinador:</strong> {{ $student_service->socialService->managerPhone }}</p>
                                <p><strong>Cupo total:</strong> {{ $student_service->socialService->capability }}</p>
                                <p><strong>Cupo actual:</strong> {{ $student_service->socialService->currentCapability }}</p>
                                <p><strong>Fecha de inicio:</strong> {{ $student_service->socialService->startDate }}</p>
                                <p><strong>Fecha de terminación:</strong> {{ $student_service->socialService->endDate }}</p>
                                <p><strong>Causa social:</strong> {{ $student_service->socialService->type }}</p>
                                <p><strong>Periodo:</strong> {{ $student_service->socialService->period }}</p>
                                <p><strong>Campus:</strong> {{ $student_service->socialService->campus }}</p>
                            </div>
                            <div class="modal-footer">
                                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                            </div>
                        </div>

                    </div>
                </div>
            @endforeach
        </table>
    @endif
    <!--div class="col-md-8 col-md-offset-2">
        <div class="panel panel-default">
            <div class="panel-heading">Register</div>

            <div class="panel-body">
                <form class="form-horizontal" method="POST" action="" enctype="multipart/form-data">
                    <input type="hidden" name="student_service_id" value="">
                    <div class="form-group">
                        <label for="file" class="col-md-4 control-label">Carta finiquito</label>
                        <div class="col-md-6">
                            <input name="file" type="file" class="form-control">
                        </div>
                    </div>
                    <button type="submit" class="btn btn-primary">Guardar carta</button>
                </form>
            </div>
        </div>
    </div-->
@endsection

@section('custom_js')
    <script>
        $(function() {
            $("#deleteButton").click(function(){
                return confirm("¿Esta seguro que quiere borrar esta carta?");
            });

            $("#uploadButton").click(function(){
                return confirm("¿Esta seguro que quiere guardar esta carta?");
            });
        });
    </script>
@endsection