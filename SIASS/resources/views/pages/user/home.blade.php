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
            <h1>{{ $user->role }}</h1>
            <p>Tu perfil de usuario es de tipo {{ $user->role }}</p>
        </div>
    </div>
@endsection

