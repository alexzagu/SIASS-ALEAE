@extends('layouts.master')

@section('navbar')
    @include('layouts.navbar')
@endsection

@section('title', 'SIASS - Certify Student Hours')

@section('content')

    <h2>Registrar Horas Acreditadas al Alumno</h2>
    <div class="row">
        <div class="col-md-12">
            <form action="{{ route('admin-certifies-student-hours') }}" method="POST">
                {{ csrf_field() }}
                @if($user->isAdmin())
                    <div class="form-group">
                        <label for="nameField">Nombre del Socio Formador</label>
                        <select class="form-control partner" name="partnerId" id="partnerId" required>
                            <option value = "">- Select partner -</option>
                            @foreach($partners as $partner)
                                <option value="{{$partner->user->id}}"
                                        @if(old('partner_id') == $partner->user->id)
                                        selected
                                        @endif>
                                    {{$partner->partnerName}} - {{$partner->user->id}}
                                </option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="nameField">Nombre del Proyecto</label>
                        <select class="form-control service" name="socialServiceId" id="socialServiceId" required>

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
        $(document).on('change', '.partner', function(){
            //console.log("Partner Change")

            var partner_id = $(this).val();
            //console.log(id)
            var div = $(this).parent().parent();
            var op = " ";
            div.find('.student').html("");
            div.find('.student').append(op);
            $.ajax({
                type: 'get',
                url: 'filter-social-services',
                data: {'id':partner_id},
                success:function (data) {
                    //console.log('success');
                    //console.log(data);
                    //console.log(data.length)
                    if(data.length <= 0) {
                        op += '<option value="">No Services Registered</option>'
                    }else{
                        op += '<option value ="" selected disabled>- Select Service -</option>';
                        for(var i=0; i < data.length; i++){
                            op += '<option value="' + data[i].id+'">'+data[i].name + ' - ' + data[i].id+'</option>'
                        }
                    }
                    div.find('.service').html("");
                    div.find('.service').append(op);
                },
                error:function () {

                }
            });
        });
        $(document).on('change', '.service', function() {
            var service_id = $(this).val();
            //console.log(id)
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