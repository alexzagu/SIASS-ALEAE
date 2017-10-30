@extends('layouts.master')

@section('custom_css')
    <link href="{{ asset('css/login.css') }}" rel="stylesheet" type="text/css">
@endsection
@section('title', 'SIASS - Login')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-4 col-md-offset-4">
                <div style="background-color: rgba(0, 0, 0, 0.5);border-radius: 15px;padding-bottom: 23px;">
                    <form action="{{ route('login') }}" method="POST" class="form-signin">
                        {{ csrf_field() }}
                        <h2 class="form-signin-heading">Login with your credentials</h2>
                        <label for="inputUsername" class="sr-only">Username</label>
                        <input type="text" id="inputUsername" name="username" class="form-control" placeholder="Username"
                               required autofocus>
                        <label for="inputPassword" class="sr-only">Password</label>
                        <input type="password" id="inputPassword" name="password" class="form-control" placeholder="Password"
                               required>
                        <button class="btn btn-lg btn-primary btn-block" type="submit">Sign in</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection