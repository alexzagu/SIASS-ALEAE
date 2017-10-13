@extends('layouts.master')

@section('title', 'SIASS - Confirmar Registro de Proyecto')

@include('layouts.navbar')

@section('content')
    <div class="row">
        <div class="col-md-12">
            <h2>Confirmar información para el registro de un nuevo Proyecto Social</h2>
            <form action="{{ route('register-social-service') }}" method="POST">
                {{ csrf_field() }}
                <div class="col-md-6 col-sm-12">
                    @if($user->isAdmin())
                        <div class="form-group">
                            <label for="nameField">Nombre del Socio Formador: {{ $input['partner_id'] }}</label>
                            <input type="hidden" name="partner_id" value="{{ $input['partner_id'] }}">
                        </div>
                    @endif

                    <div class="form-group">
                        <label for="nameField">Nombre del Proyecto Social: {{ $input['name'] }}</label>
                        <input type="hidden" name="name" value="{{ $input['name'] }}">
                    </div>

                    <div class="form-group">
                        <label for="descriptionField">Descripción del Proyecto
                            Social: {{ $input['description'] }}</label>
                        <input type="hidden" name="description" value="{{ $input['description'] }}">
                    </div>

                    <div class="form-group">
                        <label for="hoursField">Número de horas totales para
                            acreditar: {{ $input['totalHours'] }}</label>
                        <input type="hidden" name="totalHours" value="{{ $input['totalHours'] }}">
                    </div>

                    <div class="form-group">
                        <label for="addressField">Dirección donde se realiza el Proyecto
                            Social: {{ $input['address'] }}</label>
                        <input type="hidden" name="address" value="{{ $input['address'] }}">
                    </div>

                    <div class="form-group">
                        <label for="managerNameField">Nombre del Coordinador del
                            Proyecto: {{ $input['managerName'] }}</label>
                        <input type="hidden" name="managerName" value="{{ $input['managerName'] }}">
                    </div>

                    <div class="form-group">
                        <label for="managerMailField">Correo del encargado del Proyecto
                            Social: {{ $input['managerMail'] }}</label>
                        <input type="hidden" name="managerMail" value="{{ $input['managerMail'] }}">
                    </div>

                    <div class="form-group">
                        <label for="managerPhoneField">Teléfono del encargado del Proyecto
                            Social: {{ $input['managerPhone'] }}</label>
                        <input type="hidden" name="managerPhone" value="{{ $input['managerPhone'] }}">
                    </div>
                </div>
                <div class="col-md-6 col-sm-12">
                    <div class="form-group">
                        <label for="capabilityField">Cupo de alumnos para el Proyecto
                            Social: {{ $input['capability'] }}</label>
                        <input type="hidden" name="capability" value="{{ $input['capability'] }}">
                    </div>
                    <div class="form-group">
                        <label for="startDateField">Fecha de inicio del Proyecto
                            Social: {{ $input['startDate'] }}</label>
                        <input type="hidden" name="startDate" value="{{ $input['startDate'] }}">
                    </div>

                    <div class="form-group">
                        <label for="endDateField">Fecha de fin del Proyecto Social: {{ $input['endDate'] }}</label>
                        <input type="hidden" name="endDate" value="{{ $input['endDate'] }}">
                    </div>

                    <div class="form-group">
                        <label for="typeField">Causa social del proyecto: {{ $input['type'] }}</label>
                        <input type="hidden" name="type" value="{{ $input['type'] }}">
                    </div>

                    <div class="form-group">
                        <label>Competencias de Sensibilización</label>
                        <ul>
                            @foreach($input['sensibilization'] as $selected)
                                <li>{{ $selected }}</li>
                                <input type="hidden" name="sensibilization[]" value="{{ $selected }}">
                            @endforeach
                        </ul>
                    </div>

                    <div class="form-group">
                        <label for="periodField">Período del Proyecto Social: {{ $input['period'] }}</label>
                        <input type="hidden" name="period" value="{{ $input['period'] }}">
                    </div>

                    <div class="form-group">
                        <label for="campusField">Campus donde se realiza el Proyecto
                            Social: {{ $input['campus'] }}</label>
                        <input type="hidden" name="campus" value="{{ $input['campus'] }}">
                    </div>
                </div>
                <div class="form-group">
                    <button type="submit" class="btn btn-primary" name="edit" value="edit"><span class="glyphicon glyphicon-edit" aria-hidden="true"></span> Editar información</button>
                    <button type="submit" class="btn btn-primary pull-right">Registrar Proyecto Social</button>
                </div>
            </form>
        </div>
    </div>
@endsection

@include('layouts.footer')