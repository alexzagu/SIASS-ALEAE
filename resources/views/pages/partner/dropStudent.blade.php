@extends('layouts.master')

@section('navbar')
    @include('layouts.navbar')
@endsection

@section('title', 'SIASS - Registrar Horas a Alumno')

@section('content')

    <h2>Registrar Horas Acreditadas al Alumno</h2>
    <div class="row">
        <div class="col-md-12">
            <form action="" method="GET" class="form-inline">
                <div class="form-group">
                    <label for="nameField">Nombre del Proyecto</label>
                    <select class="form-control service" name="serviceId" id="serviceId" required>
                        <option value = "">- Select Project -</option>
                        @foreach($services as $service)
                            <option value="{{$service->id}}"
                                    @if(old('service_id') == $service->id)
                                    selected
                                    @endif>
                                {{$service->name}} - {{$service->id}}
                            </option>
                        @endforeach
                    </select>
                </div>
                <button type="submit" class="btn btn-primary">Mostrar alumnos</button>
            </form>
            </br>

            @if(isset($students))
            <table style="width:100%" class="table table-bordered">
                <tr class="bg-primary">
                    <th width="20%">Matricula</th>
                    <th width="70%">Nombre del Alumno</th>
                    <th width="10%">.</th>
                    <tbody id="students-table">
                    @foreach($students as $student)
                    <tr>
                        <td> {{$student->user_id}} </td>
                        <td> {{$student->studentName}} </td>
                        <td>{!!
                        $delete != "" ?
                        '<form method="post" id="deleteForm" action="'.route("delete-student", $student->user_id).'" onclick="confirmSubmit()">'
                                .csrf_field()
                                .method_field('DELETE')
                                .'<button type="submit" id="deleteButton" class="btn btn-danger submitButton">Dar de baja</button>
                        </form>'
                        :
                        '<form method="post" id="deleteForm" action="'.route("restore-student", $student->user_id).'" onclick="confirmSubmit()">'
                                .csrf_field()
                                .'<button type="submit" id="restoreButton" class="btn btn-success submitButton">Dar de alta</button>
                        </form>'
                    !!}
                        </td>
                    </tr>
                    @endforeach
                    </tbody>
                </tr>
            </table>
            @endif
        </div>
    </div>
@endsection

@section('custom_js')
    <script>
        $(function() {
            $("#deleteButton").click(function(){
                return confirm("¿Esta seguro que quiere dar de baja a alumno?");
            });

            $("#restoreButton").click(function(){
                return confirm("¿Esta seguro que quiere activar este alumno?");
            });
        });
    </script>

@endsection
