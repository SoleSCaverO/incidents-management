@extends('layouts.app')
@section('page','Cambio de contraseña')
@section('title','Cambiar contraseña')

@section('content')
    <form class="form-horizontal" role="form" method="POST" action="{{ url('/password/reset') }}">
        {{ csrf_field() }}

        <input type="hidden" name="token" value="{{ $token }}">
        <input id="email" type="email" class="form-control" placeholder="E-mail" name="email" value="{{ $email or old('email') }}">

        @if ($errors->has('email'))
            <span class="help-block">
                <strong>{{ $errors->first('email') }}</strong>
            </span>
        @endif

        <input id="password" type="password" placeholder="Contraseña" class="form-control" name="password">
        @if ($errors->has('password'))
            <span class="help-block">
                <strong>{{ $errors->first('password') }}</strong>
            </span>
        @endif

        <input id="password-confirm" type="password" placeholder="Confirmar contraseña" class="form-control" name="password_confirmation">
        @if ($errors->has('password_confirmation'))
            <span class="help-block">
                <strong>{{ $errors->first('password_confirmation') }}</strong>
            </span>
        @endif

        <div class="form-group text-center">
            <button type="submit" class="btn btn-primary">
                <i class="fa fa-btn fa-refresh"></i> Cambiar contraseña
            </button>
        </div>
    </form>
@endsection