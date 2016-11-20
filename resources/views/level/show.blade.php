@extends('layouts.panel')
@section('title','Proyectos e incidencias')
@section('view','Gestión de proyectos - Incidencias')

@section('styles')
    <style>
        .color-project{
            color:blue;
        }
        .color-subproject{
            color:blue;
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
                    <th>Estado</th>
                    <th>Visibilidad</th>
                    <th>Acción</th>
                </tr>
                </thead>
                <tbody>
                @foreach ( $project_subprojects as $project_subproject )
                    <tr>
                        @if( count($project_subproject['subprojects'])==0 )
                            <td class="color-project"><b>{{ $project_subproject['project']->name }}</b></td>
                            <td>{{ $project_subproject['project']->state->name }}</td>
                            <td>{{( $project_subproject['project']->visibility ==1)?'Público':'Privado'}}</td>
                            <td>
                                <a class="btn btn-primary" href="{{url('proyecto-niveles-'.$project_subproject['project']->id)}}">Niveles</a>

                            </td>
                    </tr>
                        @else
                            <tr>
                                <td colspan="4" class="color-project"><b>{{ $project_subproject['project']->name }}</b></td>
                            </tr>
                            @foreach( $project_subproject['subprojects'] as $subproject )
                                <tr>
                                    <td><b class="color-subproject">>></b> {{ $subproject->name }}</td>
                                    <td>{{ $subproject->state->name }}</td>
                                    <td>{{( $subproject->visibility ==1)?'Público':'Privado'}}</td>
                                    <td>
                                        <a class="btn btn-primary" href="{{url('proyecto-niveles-'.$subproject->id)}}">Niveles</a>
                                    </td>
                                </tr>
                            @endforeach
                        @endif
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection
