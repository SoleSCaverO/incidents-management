@extends('layouts.app')
@section('page','Cambio de contraseña')
@section('title','Cambiar contraseña')

@section('content')
    <form class="form-horizontal" role="form" method="POST" action="{{ url('/password/email') }}">
        {{ csrf_field() }}
        <input id="email" type="email" class="form-control" placeholder="E-mail" name="email" value="{{ old('email') }}">
        @if ($errors->has('email'))
            <span class="help-block">
                <strong>{{ $errors->first('email') }}</strong>
            </span>
        @endif

        <div class="form-group text-center">
            <button type="submit" class="btn btn-primary">
                <i class="fa fa-btn fa-envelope"></i> Enviar link de cambio de contraseña
            </button>
        </div>
        <div class="form-group text-center">
            <a href="{{url('login')}}" data-toggle="tab">Volver</a>
        </div>
    </form>
@endsection
