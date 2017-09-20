@extends('layouts.master')

@if($user->role == 'administrator')
    @section('title', 'SIASS - Admin')
@endif

@if($user->role == 'partner')
    @section('title', 'SIASS - Socio')
@endif

@if($user->role == 'student')
    @section('title', 'SIASS - Alumno')
@endif

@section('navbar')
    @include('layouts.navbar')
@endsection

@section('content')
    <div class="row">
        <div class="col-md-12">
            <p>Tu perfil de usuario es de tipo: {{ $user->role }}</p>
        </div>
    </div>
@endsection

