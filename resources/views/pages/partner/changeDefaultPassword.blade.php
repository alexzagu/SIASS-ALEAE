@extends('layouts.master')

@section('navbar')
    @include('layouts.navbar')
@endsection

@section('custom_css')
    <link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
@endsection

@section('title', 'SIASS - Cambiar contraseña default')

@section('content')

    <div class="row">
        <div class="col-md-12">
            <h2>Cambio de Contraseña Default</h2>
            <form action="{{ route('partner-changes-default-password') }}" method="POST">
                {{ csrf_field() }}
                <div class="form-group">
                    <label for="newPasswordField">Nueva Contraseña</label>
                    <input name="newPassword" type="password" class="form-control" id="newPasswordField" placeholder="Contraseña.1234" required data-toggle="password" required autofocus>
                    <small id="newPasswordHelp" class="form-text text-muted">
                        La contraseña debe de tener un mínimo de 8 caracteres y debe incluir al menos una letra mayúscula, una letra minúscula, un dígito y un caracter especial de los siguientes(_.,!#$%)
                    </small>
                </div>
                <div class="form-group">
                    <label for="newPasswordConfirmField">Confirmar Nueva Contraseña</label>
                    <input name="newPasswordConfirm" type="password" class="form-control" id="newPasswordConfirmField" placeholder="Contraseña.1234" required data-toggle = 'password'>
                    <small id="newPasswordConfirmHelp" class="form-text text-muted"></small>
                </div>
                <div class="form-group">
                    <button type="submit" class="btn btn-primary">Cambiar contraseña</button>
                </div>
            </form>
        </div>
    </div>

@endsection

@section('custom_js')
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-show-password/1.0.3/bootstrap-show-password.min.js"></script>
@endsection
