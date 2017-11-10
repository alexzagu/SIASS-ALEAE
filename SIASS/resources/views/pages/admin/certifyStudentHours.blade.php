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
                <div class="form-group">
                    <button type="submit" class="btn btn-primary">Registrar Horas Acreditadas</button>
                </div>
            </form>
        </div>
    </div>
@endsection

@section('custom_js')

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.1.1/jquery.min.js"></script>
    <script type="text/javascript" src="{{ asset('js/adminCertifyHours.js') }}"></script>

@endsection