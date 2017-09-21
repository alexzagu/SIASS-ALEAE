@extends('layouts.master')

@section('navbar')
    @include('layouts.navbar')
@endsection

@section('content')

    <h2>Registro de Socio</h2>
    <form method="POST" action="{{ route('register-partner') }}">
        {{ csrf_field() }}
        <div class="form-group">
            <label for="partnerName">Nombre:</label>
            <input type="text" class="form-control" id="partnerName" name="partnerName">
        </div>

        <div class="form-group">
            <label for="partnerAddress">Dirreción:</label>
            <input type="text" class="form-control" id="partnerAddress" name="partnerAddress">
        </div>

        <div class = "form-group">
            <label for="partnerEmail">Correo electronico</label>
            <input type="text" class="form-control" id="partnerEmail" name="partnerEmail">
        </div>

        <div class="form-group">
            <label for="managerName">Nombre del encargado</label>
            <input type="text" class="form-control" id="managerName" name="managerName">
        </div>

        <div class="form-group">
            <label for="managerMail">Correo del encargado</label>
            <input type="text" class="form-control" id="managerMail" name="managerMail">
        </div>

        <div class="form-group">
            <label for="managerPhone">Teléfono del encargado</label>
            <input type="text" class="form-control" id="managerPhone" name="managerPhone">
        </div>

        <div class="form-group">
            <label for="password">Contraseña</label>
            <input type="password" class="form-control" id="password" name="password">
        </div>

        <div class="form-group">
            <button style="cursor:pointer" type="submit" class="btn btn-primary">Registrar socio</button>
        </div>
    </form>
@endsection