@extends('layouts.master')

@section('title', 'SIASS - Admin')

@section('navbar')
    @include('layouts.navbar')
@endsection

@section('content')
    <div class="row">
        <div class="col-md-12">
            <h1>Administrador</h1>
            <p>Tu perfil de usuario es de tipo administrador</p>
            <p>Departamento: {{ $userInfo->department }}</p>
        </div>
    </div>
@endsection

