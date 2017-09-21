@extends('layouts.master')

@section('navbar')
    @include('layouts.navbar')
@endsection

@section('title', 'SIASS - Registro de Servicio Social')

@section('content')
    <div class="row">
        <div class="col-md-12">
            <form action="{{ route('register-social-service') }}" method="POST">
                {{ csrf_field() }}
                <div class="form-group">
                    <label for="nameField">Nombre del servicio Social</label>
                    <input name="name" type="text" class="form-control" id="nameField" placeholder="Nombre del servicio social">
                </div>
                <div class="form-group">
                    <label for="descriptionField">Descripción del servicio Social</label>
                    <textarea name="description" type="text" class="form-control" id="descriptionField" placeholder="Descripción del servicio social" rows="3" ></textarea>
                </div>
                <div class="form-group">
                    <label for="hoursField">Número de horas totales para acreditar</label>
                    <input name="totalHours" type="number" class="form-control" id="hoursField" placeholder="0" aria-describedby="hoursHelp">
                    <small id="hoursHelp" class="form-text text-muted">Esta es la cantidad de horas que se dará al alumno al completar de manera satisfactoria su servicio social.</small>
                </div>
                <div class="form-group">
                    <label for="addressField">Dirección donde se realiza el servicio social</label>
                    <input name="address" type="text" class="form-control" id="addressField" placeholder="Dirección">
                </div>
                <div class="form-group">
                    <label for="managerNameField">Nombre del encargado del servicio social</label>
                    <input name="managerName" type="text" class="form-control" id="managerNameField" placeholder="Nombre de encargado">
                </div>
                <div class="form-group">
                    <label for="managerMailField">Correo del ecargado del servicio social</label>
                    <input name="managerMail" type="email" class="form-control" id="managerMailField" placeholder="Correo del encargado">
                </div>
                <div class="form-group">
                    <label for="managerPhoneField">Teléfono del encargado del servicio social</label>
                    <input name="managerPhone" type="text" class="form-control" id="managerPhoneField" placeholder="Teléfono del encargado">
                </div>
                <div class="form-group">
                    <label for="capabilityField">Cupo de alumnos para el servicio social</label>
                    <input name="capability" type="number" class="form-control" id="capabilityField" placeholder="10">
                </div>
                <div class="form-group">
                    <label for="startDateField">Fecha de inicio del servicio social</label>
                    <input name="startDate" type="date" class="form-control" id="startDateField" placeholder="" aria-describedby="startdateHelp">
                    <small id="startdateHelp" class="form-text text-muted">Favor de escribir en el siguiente formato: YYYY-MM-DD</small>
                </div>
                <div class="form-group">
                    <label for="endDateField">Fecha de fin del servicio social</label>
                    <input name="endDate" type="date" class="form-control" id="endDateField" placeholder="" aria-describedby="endateHelp">
                    <small id="enddateHelp" class="form-text text-muted">Esta es la cantidad de horas que se dará al alumno al completar de manera satisfactoria su servicio social.</small>
                </div>
                <div class="form-group">
                    <label for="typeField">Categoría del servicio</label>
                    <select class="form-control" id="typeField" name="type">
                        <option value="Ciencia y Tecnología">Ciencia y Tecnología</option>
                        <option value="Desarrollo Integral">Desarrollo Integral</option>
                        <option value="Economía y Emprendimiento">Economía y Emprendimiento</option>
                        <option value="Educación">Educación</option>
                        <option value="Inclusión y Grupos Vulnerables">Inclusión y Grupos Vulnerables</option>
                        <option value="Infraestructura">Infraestructura</option>
                        <option value="Legalidad">Legalidad</option>
                        <option value="Medio Ambiente y Sustentabilidad">Medio Ambiente y Sustentabilidad</option>
                        <option value="Salud y Bienestar">Salud y Bienestar</option>
                        <option value="Profesionalismo Cívico">Profesionalismo Cívico</option>
                    </select>
                </div>
                <div class="form-group">
                    <label for="periodField">Periodo de servicio social</label>
                    <input name="period" type="text" class="form-control" id="periodField" placeholder="201711">
                </div>
                <div class="form-group">
                    <label for="campusField">Campus donde se realiza el servicio social</label>
                    <input name="campus" type="text" class="form-control" id="campusField" placeholder="Monterrey">
                </div>
                <div class="form-group">
                    <button type="submit" class="btn btn-primary">Registrar Servicio</button>
                </div>
            </form>
        </div>
    </div>
@endsection