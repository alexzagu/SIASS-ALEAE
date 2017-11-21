@extends('layouts.master')

@section('navbar')
    @include('layouts.navbar')
@endsection

@section('title', 'SIASS - Modificar Información de Socio Formador')

@section('custom_css')
    <link rel="stylesheet" type="text/css" href="{{ asset('css/updatePartner.css') }}">
@endsection


@section('content')
    <div class="col-md-12" id="searchField">
        <form action="" method="GET" class="form-inline">
            <div class="form-group">
                <label for="studentIDField">Clave de Socio </label>
                <input type="text" name="user_id" class="form-control" required>
            </div>
            <div class="form-group">
                <button type="submit" class="btn btn-primary">Buscar</button>
            </div>
        </form>
    </div>
    @if(isset($partner))
        <div class="col-md-12" id="partnerInfo">
            <label>Clave de Socio Formador: {{ $partner->user_id }}</label>
            <form method="POST" action="{{ route('modify-partner', $partner->user_id) }}">
                {{ csrf_field()}}
                {{ method_field('PUT')}}
                <div class="table-responsive">
                    <table class="table-bordered table">
                        <tr>
                            <th>Nombre de la Asociación</th>
                            <th>Dirección de la Asociación</th>
                            <th>Correo de la Asociación</th>
                            <th>Nombre del Encargado</th>
                            <th>Teléfono del Encargado</th>
                            <th>Correo del Encargado</th>
                        </tr>
                        <tr>
                            <td><input type="text" name="partnerName" value="{{$partner->partnerName}}"></td>
                            <td><input type="text" name="partnerAddress" value="{{$partner->partnerAddress}}"></td>
                            <td><input type="email" name="partnerEmail" value="{{$partner->partnerEmail}}"></td>
                            <td><input type="text" name="managerName" value="{{$partner->managerName}}"></td>
                            <td><input type="email" name="managerMail" value="{{$partner->managerMail}}"></td>
                            <td><input type="text" name="managerPhone" value="{{$partner->managerPhone}}"></td>
                        </tr>
                    </table>
                </div>
                <div class="form-group">
                    <button type="submit" class="btn btn-primary">Actualizar información</button>
                </div>
            </form>
        </div>
    @endif
@endsection
