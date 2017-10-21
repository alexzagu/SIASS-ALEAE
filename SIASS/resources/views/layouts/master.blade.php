<!doctype html>
{{ Carbon\Carbon::setLocale('mx') }}
<html lang="{{ app()->getLocale() }}">
    <head>
        @include('layouts.head')
        <title>@yield('title')</title>
    </head>
    <body>
        @yield('navbar')

        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    @if (session('success'))
                        <div class="alert alert-success">
                            {{ session('success') }}
                        </div>
                    @endif

                    @if (session('fail'))
                        <div class="alert alert-danger">
                            {{ session('fail') }}
                        </div>
                    @endif
                </div>
            </div>
            @yield('content')
        </div>

        @include('layouts.footer')
        <script type="text/javascript" src="{{ asset('js/app.js') }}"></script>
        @yield('custom_js')
    </body>
</html>