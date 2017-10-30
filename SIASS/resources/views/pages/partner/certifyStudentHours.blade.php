@extends('layouts.master')

@section('navbar')
    @include('layouts.navbar')
@endsection

@section('title', 'SIASS - Certify Student Hours')

@section('content')

    <h2>Registrar Horas Acreditadas al Alumno</h2>
    <div class="row">
        <div class="col-md-12">
            <form action="{{ route('partner-certifies-student-hours') }}" method="POST">
                {{ csrf_field() }}
                @if($user->isPartner())
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
                    <div class="form-group">
                        <label for="nameField">Nombre del Alumno</label>
                        <select class="form-control student" name="studentId" id="studentId" required>

                        </select>
                    </div>
                    <div class="form-group">
                        <label for="hoursField">Número de horas a acreditar</label>
                        <input name="certifiedHours" type="number" class="form-control" id="certifiedHours" value="{{ old('totalHours') }}" placeholder="0"  required>
                    </div>
                @endif
                <div class="form-group">
                    <button type="submit" class="btn btn-primary">Registrar Horas Acreditadas</button>
                </div>
            </form>
        </div>
    </div>
@endsection

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>

<script type="text/javascript">
    $(document).ready(function(){
        $(document).on('change', '.service', function() {
            var service_id = $(this).val();
            var div = $(this).parent().parent();
            var op = " ";
            console.log(service_id);
            $.ajax({
                type: 'get',
                url: 'filter-students',
                data: {'id':service_id},
                success:function (data) {
                    console.log('success');
                    console.log(data);
                    console.log(data.length)
                    if(data.length <= 0) {
                        op += '<option value="none">No Students Registered</option>'
                    }else{
                        op += '<option value ="select" selected disabled>- Select Student -</option>';
                        for(var i=0; i < data.length; i++){
                            op += '<option value="' + data[i].id+'">'+data[i].studentName + ' - ' + data[i].id+'</option>'
                        }
                    }
                    div.find('.student').html("");
                    div.find('.student').append(op);
                },
                error:function () {

                }
            });
        });
    });

</script>