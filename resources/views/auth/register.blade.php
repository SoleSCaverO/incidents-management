@extends('layouts.app')
@section('page','Registro')
@section('title','Registrarse')

@section('content')
    <form class="form-horizontal" role="form" method="POST" action="{{ url('/register') }}">
                    {{ csrf_field() }}

                    <input id="name" type="text" class="form-control top" placeholder="Usuario" name="name" value="{{ old('name') }}">
                    <input id="email" type="email" class="form-control bottom" placeholder="E-mail" name="email" value="{{ old('email') }}">
                    <input id="password" type="password" class="form-control top" placeholder="Contraseña"  name="password">
                    <input id="password-confirm" type="password" class="form-control bottom" placeholder="Confirmar contraseña" name="password_confirmation">
                    @if ($errors->has('name'))
                        <span class="help-block">
                            <strong>{{ $errors->first('name') }}</strong>
                        </span>
                    @endif

                    @if ($errors->has('email'))
                        <span class="help-block">
                            <strong>{{ $errors->first('email') }}</strong>
                        </span>
                    @endif

                    @if ($errors->has('password'))
                        <span class="help-block">
                            <strong>{{ $errors->first('password') }}</strong>
                        </span>
                    @endif

                    @if ($errors->has('password_confirmation'))
                        <span class="help-block">
                            <strong>{{ $errors->first('password_confirmation') }}</strong>
                        </span>
                    @endif

                    <div class="form-group">
                        <div class="col-md-6 col-md-offset-3">
                            <button type="submit" class="btn btn-primary">
                                <i class="fa fa-btn fa-user"></i> Registrarse
                            </button>
                        </div>
                    </div>
                    <div class="form-group text-center">
                        <a href="{{url('login')}}" data-toggle="tab">Ingresar</a>
                    </div>
                </form>
@endsection