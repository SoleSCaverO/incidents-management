@extends('layouts.app')
@section('page','Ingresar')
@section('title','Ingresar')

@section('content')
    <form class="form-horizontal" role="form" method="POST" action="{{ url('/login') }}">
                {{ csrf_field() }}
                <input id="email" type="email" class="form-control top" placeholder="E-mail" name="email" value="{{ old('email') }}" required>
                <input id="password" type="password" placeholder="Contraseña" class="form-control bottom" name="password" required>
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

                <div class="form-group">
                    <div class="col-md-6">
                        <div class="checkbox">
                            <label>
                                <input type="checkbox" name="remember"> Rercordar sesión
                            </label>
                        </div>
                    </div>
                </div>
                <div class="form-group">
                    <div class="col-md-6 col-md-offset-3">
                        <button type="submit" class="btn btn-primary">
                            <i class="fa fa-btn fa-sign-in"></i> Ingresar
                        </button>
                    </div>
                </div>
            </form>
    <div class="form-group text-center">
        <a href="{{url('register')}}" data-toggle="tab">Registrarse</a>
        <a class="btn btn-link" href="{{ url('/password/reset') }}">Olvidó su contraseña?</a>
    </div>
@endsection


