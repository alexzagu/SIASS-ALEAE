@extends('layouts.master')

@section('custom_css')
    <link href="{{ asset('css/login.css') }}" rel="stylesheet" type="text/css">
    <link rel="stylesheet" type="text/css" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.7/css/bootstrap.min.css">
@endsection
@section('title', 'SIASS - Login')

@section('content')
    <div class="container">
        <div class="row">
            <div class="col-md-4 col-md-offset-4">
                <div class="loginFormContainer">
                    <form action="{{ route('login') }}" method="POST" class="form-signin">
                        {{ csrf_field() }}
                        <h2 class="form-signin-heading">Login with your credentials</h2>
                        <div class="form-group">
                            <input type="text" id="inputUsername" name="username" class="form-control" placeholder="Username"
                                   required autofocus>
                        </div>
                        <div class="form-group">
                            <input type="password" id="inputPassword" name="password" class="form-control" placeholder="Password"
                                   required data-toggle="password">
                        </div>
                        <button class="btn btn-lg btn-primary btn-block" type="submit">Sign in</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection

@section('custom_js')
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-show-password/1.0.3/bootstrap-show-password.min.js"></script>
@endsection