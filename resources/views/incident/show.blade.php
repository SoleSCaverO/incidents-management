@extends('layouts.panel')
@section('title','Proyectos e incidencias')
@section('view','Gestión de proyectos - Incidencias')

@section('styles')
    <style>
        .color-project{
            color:blue;
        }
        .color-subproject{
            color:turquoise;
        }
    </style>
@endsection

@section('content')
    <div class="row">
        <div class="table-responsive ">
            <table class="table table-striped">
                <thead>
                <tr>
                    <th>Proyecto</th>
                    <th>Nivel de servicio</th>
                    <th>Estado</th>
                    <th>Visibilidad</th>
                    <th>Acción</th>
                </tr>
                </thead>
                <tbody>
                @foreach ( $project_subprojects as $project_subproject )
                    <tr>
                        <td class="color-project">{{ $project_subproject['project']->name }}</td>
                        <td>{{ $project_subproject['project']->level->name }}</td>
                        <td>{{ $project_subproject['project']->state->name }}</td>
                        <td>{{( $project_subproject['project']->visibility ==1)?'Público':'Privado'}}</td>
                        <td>
                            <a class="btn btn-danger" href="{{url('incidencias/'.$project_subproject['project']->id)}}">Incidencias</a>
                        </td>
                    </tr>
                    @foreach( $project_subproject['subprojects'] as $subproject )
                        <tr>
                            <td><b class="color-subproject">>></b> {{ $subproject->name }}</td>
                            <td>{{ $subproject->level->name }}</td>
                            <td>{{ $subproject->state->name }}</td>
                            <td>{{( $subproject->visibility ==1)?'Público':'Privado'}}</td>
                            <td>
                                <a class="btn btn-danger" href="{{url('incidencias/'.$subproject->id)}}">Incidencias</a>
                            </td>
                        </tr>
                    @endforeach
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
