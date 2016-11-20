@extends('layouts.panel')
@section('title','Ordenamiento de niveles')
@section('view','Gestión de proyectos - orden de niveles')

@section('styles')
    <style>
        .button
        {
            margin: 4px;
            white-space: normal;
            width: 100%;
        }
    </style>
@endsection

@section('content')
    <div class="row">
        <div class="col-md-6">
            <div class="panel panel-danger">
                <div class="panel-heading text-center"><b>Niveles sin ordenar</b></div>
                <div class="panel-body disorder">
                    <button class="btn btn-primary button" data-disorder>Adminitración de redes</button>
                    <button class="btn btn-primary button" data-disorder>Desarrollo</button>
                    <button class="btn btn-primary button" data-disorder>Voy a aescribir un texto grande para que se muetre el botón con multtilíneas XD</button>
                </div>
                <div class="panel-footer">Click en botón para pasar al panel de niveles ordenados</div>
            </div>
        </div>
        <div class="col-md-6">
            <div class="panel panel-info">
                <div class="panel-heading text-center"><b>Niveles ordenados</b></div>
                <div class="panel-body order">

                </div>
                <div class="panel-footer">Click en botón para pasar al panel de niveles sin ordenar</div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-md-12 text-center">
            <button class="btn btn-success">Guardar niveles ordenados</button>
        </div>
    </div>
@endsection

@section('scripts')
    <script src="{{ asset('assets/js/level/order.js') }}"></script>
@endsection