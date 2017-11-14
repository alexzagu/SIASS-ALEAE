@extends('layouts.master')

@section('navbar')
    @include('layouts.navbar')
@endsection

@section('title', 'SIASS - Modificar Información de Socio Formador')


@section('content')
    <div class="col-md-12" id="searchField">
        <form action="" method="GET" class="form-inline">
            <div class="form-group">
                <label for="partnerIDField">Clave de Socio </label>
                <input type="text" name="user_id" class="form-control" required>
            </div>
            <div class="form-group">
                <button type="submit" class="btn btn-primary">Buscar</button>
            </div>
        </form>
    </div>


    @if(isset($partner))
        <table class="table-bordered table">
            <tr>
                <th>Clave de Socio Formador</th>
                <th>Nombre de la Asociación</th>
                <th>Dirección de la Asociación</th>
                <th>Correo de la Asociación</th>
                <th>Nombre del Encargado</th>
                <th>Correo del Encargado</th>
                <th>Teléfono del Encargado</th>
                <th>Modificar estatus</th>
            </tr>
            <tr>
                <td>{{ $partner->user_id }}</td>
                <td>{{$partner->partnerName}}</td>
                <td>{{$partner->partnerAddress}}</td>
                <td>{{$partner->partnerEmail}}</td>
                <td>{{$partner->managerName}}</td>
                <td>{{$partner->managerMail}}</td>
                <td>{{$partner->managerPhone}}</td>
                <td>{!!
                        $partner->deleted_at == "" ?
                        '<form method="post" id="deleteForm" action="'.route("delete-partner", $partner->user_id).'" onclick="confirmSubmit()">'
                                .csrf_field()
                                .method_field('DELETE')
                                .'<button type="submit" id="deleteButton" class="btn btn-danger submitButton">Dar de baja</button>
                        </form>'
                        :
                        '<form method="post" id="deleteForm" action="'.route("restore-partner", $partner->user_id).'" onclick="confirmSubmit()">'
                                .csrf_field()
                                .'<button type="submit" id="restoreButton" class="btn btn-success submitButton">Dar de alta</button>
                        </form>'
                    !!}
                </td>
            </tr>
        </table>
    @endif
@endsection

@section('custom_js')
    <script>
        $(function() {
            $("#deleteButton").click(function(){
                return confirm("¿Esta seguro que quiere dar de baja a este socio formador?");
            });

            $("#restoreButton").click(function(){
                return confirm("¿Esta seguro que quiere activar este socio formador?");
            });
        });
    </script>
@endsection


