@extends('layouts.master')

@section('title', 'SIASS - Reportes')

@section('navbar')
    @include('layouts.navbar')
@endsection

@section('content')
    <div class="row">
        <div class="col-md-12">
            <form id="searchForm" method="GET">
                {{ csrf_field() }}
                <div class="form-group form-inline">
                    <select class="form-control" name="category" id="category">
                        <option selected disabled>Buscar por...</option>
                        <option value="student">Alumno</option>
                        <option value="partner">Socio formador</option>
                        <option value="social_service">Proyecto social</option>
                    </select>
                    <button class="btn btn-default form-control">Buscar</button>
                </div>
                <div class="form-group" id="filters">
                </div>
            </form>
        </div>
    </div>
    @if(isset($results))

        @switch($category)
            @case('student')
            <div class="row">
                <legend>Resultados</legend>
                <div class="panel panel-default">
                    <table class="table">
                        @foreach($results as $result)
                            <tr>
                                <td>{{ $result->user_id }}</td>
                            </tr>
                        @endforeach
                    </table>
                </div>
            </div>
            @break

            @case('partner')
            <div class="row">
                <legend>Resultados</legend>
                <div class="panel panel-default">
                    <table class="table">
                        @foreach($results as $result)
                            <tr>
                                <td>{{ $result->user_id }}</td>
                            </tr>
                        @endforeach
                    </table>
                </div>
            </div>
            @break

            @case('social_service')
            <div class="row">
                <legend>Resultados</legend>
                <div class="panel panel-default">
                    <table class="table">
                        @foreach($results as $result)
                            <tr>
                                <td>{{ $result->user_id }}</td>
                            </tr>
                        @endforeach
                    </table>
                </div>
            </div>
            @break

        @endswitch
        {{-- $results->links() --}}
    @endif
@endsection

@section('custom_js')
    <script type="text/javascript" src="{{ asset('js/reportForm.js') }}"></script>
@endsection
