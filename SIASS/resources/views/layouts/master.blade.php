<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        @include('layouts.head')
        <title>@yield('title')</title>
    </head>
    <body>
        @include('layouts.navbar')

        <div class="container">
            @yield('content')
        </div>

        @include('layouts.footer')
    </body>
</html>