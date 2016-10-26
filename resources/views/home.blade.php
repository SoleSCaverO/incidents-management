@extends('layouts.panel')
@section('title','Bienvenido')
@section('view','Gestor de incidencias')
@section('styles')
    <style>
        .cascade
        {
            width: 650px;
            height: 400px;
        }
    </style>
@endsection
@section('content')
    <div class="row text-center">
        <div class="col-md-6 col-md-offset-2">
            <img src="{{asset('assets/img/home.png')}}" class="cascade" alt="Cascada de metas - cobit 5">
        </div>
    </div>
@endsection
