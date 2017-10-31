@extends('layouts.master')

@section('navbar')
    @include('layouts.navbar')
@endsection

@section('title', 'SIASS - Registro de Servicio Social')

@section('content')
    <div class="row">
        <div class="col-md-12">
            @include('layouts.errors')

            <?php $sensibilization = old('sensibilization'); ?>

            <h2>Forma de registro de un nuevo Proyecto Social</h2>
            <form action="{{ route('confirm-social-service') }}" method="POST">
                {{ csrf_field() }}
                <div class="col-md-6 col-sm-12">
                    @if($user->isAdmin())
                        <div class="form-group">
                            <label for="nameField">Nombre del Socio Formador</label>
                            <select class="form-control" name="partner_id">
                                @foreach($partners as $partner)
                                    <option value="{{$partner->user->id}}" @if(old('partner_id') == $partner->user->id) selected @endif>{{$partner->partnerName}} - {{$partner->user->id}}</option>
                                @endforeach
                            </select>
                        </div>
                    @endif
                    <div class="form-group">
                        <label for="nameField">Nombre del Proyecto Social</label>
                        <input name="name" type="text" class="form-control" id="nameField" placeholder="Nombre del servicio social" value="{{ old('name') }}" required>
                    </div>
                    <div class="form-group">
                        <label for="descriptionField">Descripción del Proyecto Social</label>
                        <textarea name="description" type="text" class="form-control" id="descriptionField" placeholder="Descripción del servicio social" rows="3" required>{{ old('description') }}</textarea>
                    </div>
                    <div class="form-group">
                        <label for="hoursField">Número de horas totales para acreditar</label>
                        <p><small id="hoursHelp" class="form-text text-muted">Esta es la cantidad de horas que se darán al alumno al completar de manera satisfactoria su servicio social.</small></p>
                        <input name="totalHours" type="number" class="form-control" id="hoursField" value="{{ old('totalHours') }}" placeholder="0" aria-describedby="hoursHelp" required>
                    </div>
                    <div class="form-group">
                        <label for="addressField">Dirección donde se realiza el Proyecto Social</label>
                        <input name="address" type="text" class="form-control"  value="{{ old('address') }}" id="addressField" placeholder="Dirección" required>
                    </div>
                    <div class="form-group">
                        <label for="managerNameField">Nombre del Coordinador del Proyecto</label>
                        <input name="managerName" type="text" class="form-control" value="{{ old('managerName') }}" id="managerNameField" placeholder="Nombre de encargado" required>
                    </div>
                    <div class="form-group">
                        <label for="managerMailField">Correo del encargado del Proyecto Social</label>
                        <input name="managerMail" type="email" class="form-control" value="{{ old('managerMail') }}" id="managerMailField" placeholder="Correo del encargado" required>
                    </div>
                    <div class="form-group">
                        <label for="managerPhoneField">Teléfono del encargado del Proyecto Social</label>
                        <input name="managerPhone" type="text" class="form-control" value="{{ old('managerPhone') }}" id="managerPhoneField" placeholder="Teléfono del encargado" required>
                    </div>
                </div>
                <div class="col-md-6 col-sm-12">
                    <div class="form-group">
                        <label for="capabilityField">Cupo de alumnos para el Proyecto Social</label>
                        <input name="capability" type="number" class="form-control" value="{{ old('capability') }}" id="capabilityField" placeholder="10" required>
                    </div>
                    <div class="form-group">
                        <label for="startDateField">Fecha de inicio del Proyecto Social</label>
                        <p><small id="startdateHelp" class="form-text text-muted">Favor de escribir en el siguiente formato: DD-MM-YYYY</small></p>
                        <input name="startDate" type="date" class="form-control datepicker" value="{{ old('startDate') }}" id="startDateField" placeholder="" aria-describedby="startdateHelp" required>
                    </div>
                    <div class="form-group">
                        <label for="endDateField">Fecha de fin del Proyecto Social</label>
                        <p><small id="enddateHelp" class="form-text text-muted">Favor de escribir en el siguiente formato: DD-MM-YYYY</small></p>
                        <input name="endDate" type="date" class="form-control datepicker" value="{{ old('endDate') }}" id="endDateField" placeholder="" aria-describedby="endateHelp" required>
                    </div>
                    <div class="form-group">
                        <label for="typeField">Causa social del proyecto</label>
                        <select class="form-control" id="typeField" name="type">
                            <option value="Ciencia y Tecnología" @if(old('type') =="Ciencia y Tecnología") selected @endif>Ciencia y Tecnología</option>
                            <option value="Desarrollo Integral" @if(old('type') == "Desarrollo Integral") selected @endif>Desarrollo Integral</option>
                            <option value="Economía y Emprendimiento" @if(old('type') == "Economía y Emprendimiento") selected @endif>Economía y Emprendimiento</option>
                            <option value="Educación" @if(old('type') == "Educación") selected @endif>Educación</option>
                            <option value="Inclusión y Grupos Vulnerables" @if(old('type') == "Inclusión y Grupos Vulnerables") selected @endif>Inclusión y Grupos Vulnerables</option>
                            <option value="Infraestructura" @if(old('type') == "Infraestructura") selected @endif>Infraestructura</option>
                            <option value="Legalidad" @if(old('type') == "Legalidad") selected @endif>Legalidad</option>
                            <option value="Medio Ambiente y Sustentabilidad" @if(old('type') == "Medio Ambiente y Sustentabilidad") selected @endif>Medio Ambiente y Sustentabilidad</option>
                            <option value="Salud y Bienestar" @if(old('type') == "Salud y Bienestar") selected @endif>Salud y Bienestar</option>
                            <option value="Profesionalismo Cívico" @if(old('type') == "Profesionalismo Cívico") selected @endif>Profesionalismo Cívico</option>
                        </select>
                    </div>
                    <fieldset class="form-group">
                        <legend>Competencias de Sensibilización</legend>
                        <div class="form-check form-check-inline">
                            <label class="form-check-label">
                                @if(isset($sensibilization))
                                    <input class="form-check-input" type="checkbox" name="sensibilization[]" {{ in_array('Reconocimiento ético', old('sensibilization')) ? 'checked' : '' }} value="Reconocimiento ético">
                                @else
                                    <input class="form-check-input" type="checkbox" name="sensibilization[]" value="Reconocimiento ético">
                                @endif
                                Reconocimiento ético
                            </label>
                        </div>
                        <div class="form-check form-check-inline">
                            <label class="form-check-label">
                                @if(isset($sensibilization))
                                    <input class="form-check-input" type="checkbox" name="sensibilization[]" {{ in_array('Empatía', old('sensibilization')) ? 'checked' : '' }} value="Empatía">
                                @else
                                    <input class="form-check-input" type="checkbox" name="sensibilization[]" value="Empatía">
                                @endif
                                Empatía
                            </label>
                        </div>
                        <div class="form-check form-check-inline">
                            <label class="form-check-label">
                                @if(isset($sensibilization))
                                    <input class="form-check-input" type="checkbox" name="sensibilization[]" {{ in_array('Juicio moral', old('sensibilization')) ? 'checked' : '' }} value="Juicio moral">
                                @else
                                    <input class="form-check-input" type="checkbox" name="sensibilization[]" value="Juicio moral">
                                @endif
                                Juicio moral
                            </label>
                        </div>
                        <!--legend>Competencias de Comprensión</legend>
                        <legend>Competencias de Acción</legend>
                        <legend>Competencias de Transformación</legend-->
                    </fieldset>
                    <div class="form-group">
                        <label for="periodField">Período del Proyecto Social</label>
                        <select class="form-control" name="period">
                            @foreach($periods as $period)
                                <option value="{{ $period->id }}" {{ old('period') == $period->id ? 'selected' : '' }}>{{ $period->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="campusField">Campus donde se realiza el Proyecto Social</label>
                        <input name="campus" type="text" value="{{ old('campus') }}" class="form-control" id="campusField" placeholder="Monterrey" required>
                    </div>
                </div>
                <div class="form-group">
                    <button type="submit" class="btn btn-primary">Registrar Proyecto Social</button>
                </div>
            </form>
        </div>
    </div>
@endsection