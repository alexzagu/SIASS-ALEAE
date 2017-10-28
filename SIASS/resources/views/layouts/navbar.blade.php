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
                <li><a href="#about">About</a></li>
                <li><a href="#contact">Contact</a></li>
                <li class="dropdown">
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
                </li>
            </ul>
        </div><!--/.nav-collapse -->
    </div>
</nav>