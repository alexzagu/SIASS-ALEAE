<nav class="navbar navbar-inverse navbar-fixed-top">
    <div class="container-fluid">
        <div class="navbar-header">
            <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <a class="navbar-brand" href="#">ITESM SIASS</a>
        </div>
        <div id="navbar" class="collapse navbar-collapse">
            <ul class="nav navbar-nav">
                <li class="active"><a href="/">Home</a></li>
                @if(auth()->user()->isAdmin())
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="true">Socio Formador<span class="caret"></span></a>
                        <ul class="dropdown-menu">
                            <li><a href="/admin/register-partner">Registrar</a></li>
                            <li><a href="/admin/modify-partner">Modificar</a></li>
                            <li><a href="/admin/unsubscribe-partner">Dar de baja/Dar de alta</a></li>
                        </ul>
                    </li>
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="true">Estudiante<span class="caret"></span></a>
                        <ul class="dropdown-menu">
                            <li><a href="/admin/student-info">Ver información de estudiante</a></li>
                            <li><a href="/admin/register-student-to-social-service">Registrar a servicio social</a></li>
                            <li><a href="/admin/certify-induction-rec">Acreditar taller de inducción o de REC</a></li>
                            <li><a href="/admin/certify-student-hours">Acreditar horas a alumno</a></li>
                            <li><a href="/admin/upload-discharge-letter">Registrar carta liberación</a></li>
                        </ul>
                    </li>
                    <li class="dropdown">
                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="true">Proyecto Social<span class="caret"></span></a>
                        <ul class="dropdown-menu">
                            <li><a href="/admin/register-social-service">Registrar un nuevo proyecto social</a></li>
                        </ul>
                    </li>
                @endif
                @if(auth()->user()->isPartner())
                    <li class="active"><a href="/partner/register-social-service">Registrar un nuevo proyecto social</a></li>
                    <li class="active"><a href="/partner/register-student-to-social-service">Registrar estudiante a servicio social</a></li>
                    <li class="active"><a href="/partner/certify-student-hours">Acreditar horas a alumno</a></li>
                    <li class="active"><a href="/partner/drop-student">Dar de baja alumno</a></li>
                @endif
                <!--li class="dropdown">
                    <a href="#" class="dropdown-toggle" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">@if(auth()->user()){{ auth()->user()->name }}@else Usuario @endif<span class="caret"></span></a>
                    <ul class="dropdown-menu">
                        @if (auth()->user())
                            <li>
                                <form method="POST" action="{{ route('logout') }}" class=""><div class="form-group">{{ csrf_field() }}<button type="submit" class="form-control">Logout</button></div></form>
                            </li>
                        @else
                            <li><a href="/login" type="button" class="btn btn-default navbar-btn">Login</a></li>
                        @endif
                    </ul>
                </li-->
                <li><a href="/admin/reports">Reportes</a></li>
            </ul>
            @if (auth()->user())
                <form method="POST" action="{{ route('logout') }}" class="navbar-form navbar-right">
                    {{ csrf_field() }}
                    <button type="submit" class="btn btn-success">Logout</button>
                </form>
            @else
                <p class="navbar-text navbar-right"><a href="/login" type="button" class="btn btn-default navbar-btn nav">Login</a></p>
            @endif
        </div><!--/.nav-collapse -->
    </div>
</nav>