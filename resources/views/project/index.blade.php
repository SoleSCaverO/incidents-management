@extends('layouts.panel')
@section('title','Proyectos')
@section('view','Gestión de proyectos')

@section('styles')
    <style>
        .area
        {
            resize: none;
        }
        .color
        {
            color:blue;
        }
    </style>
@endsection

@section('content')
    <div class="row">
        <button data-register class="btn btn-success">Nuevo proyecto</button>
    </div>
    <div class="row">
        <div class="table-responsive ">
            <table class="table table-striped">
                <thead>
                <tr>
                    <th>Proyecto</th>
                    <th>Estado</th>
                    <th>Visibilidad</th>
                    <th>Descripción</th>
                    <th>Acción</th>
                </tr>
                </thead>
                <tbody>
                @foreach( $projects as $project )
                    <tr>
                        <td>{{ $project[0]->name }}</td>
                        <td>{{ $project[0]->state->name }}</td>
                        <td>{{( $project[0]->visibility ==1)?'Público':'Privado'}}</td>
                        <td>{{ $project[0]->description }}</td>
                        <td>
                            <button class="btn btn-primary" data-edit="{{ $project[0]->id }}"
                                    data-name="{{ $project[0]->name }}"
                                    data-state="{{ $project[0]->state_id }}"
                                    data-visibility="{{ $project[0]->visibility }}"
                                    data-description="{{ $project[0]->description }}"> Editar
                            </button>
                            <button class="btn btn-danger" data-delete="{{ $project[0]->id }}" data-name="{{ $project[0]->name }}">
                                Eliminar
                            </button>
                            <a class="btn btn-warning" href="{{url('subproyectos-'.$project[0]->id)}}">Subproyectos ({{ $project[1] }})</a>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
@endsection

@section('modals')
    <div id="modalRegister" class="modal fade in">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Registrar proyecto</h4>
                </div>

                <form id="formRegister" action="{{ url('proyectos/registrar') }}" class="form-horizontal form-label-left"  method="POST" enctype="multipart/form-data">
                    <div class="modal-body">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}" />

                        <div class="form-group">
                            <label class="control-label col-md-3" for="name">Nombre<span class="required">*</span></label>
                            <div class="col-md-8">
                                <input id="name" name="name" required="required" class="form-control inside">
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="control-label col-md-3" for="name">Estado</label>
                            <div class="col-md-6">
                                <select name="state" id="state" class="form-control">

                                </select>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="control-label col-md-3" for="name">Visibilidad</label>
                            <div class="col-md-3">
                                <input type="radio" name="visibility" value="1" checked>Público
                            </div>
                            <div class="col-md-3">
                                <input type="radio" name="visibility" value="2">Privado
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="control-label col-md-3" for="name">Descripción</label>
                            <div class="col-md-8">
                                <textarea name="description" id="description"  class="form-control area inside"></textarea>
                            </div>
                        </div>

                        <div class="modal-footer">
                            <div class="text-center">
                                <button class="btn btn-danger" data-dismiss="modal"><span class="glyphicon glyphicon-remove"></span> Cancelar</button>
                                <button class="btn btn-primary"><span class="glyphicon glyphicon-ok-circle" aria-hidden="true"></span> Registrar proyecto</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div id="modalEdit" class="modal fade in">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Editar proyecto</h4>
                </div>

                <form id="formEdit" action="{{ url('proyectos/editar') }}" class="form-horizontal form-label-left"  method="POST" enctype="multipart/form-data">
                    <div class="modal-body">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}" />
                        <input type="hidden" name="id" />

                        <div class="form-group">
                            <label class="control-label col-md-3" for="name">Nombre<span class="required">*</span></label>
                            <div class="col-md-8">
                                <input id="name" name="name" required="required" class="form-control inside">
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="control-label col-md-3" for="name">Estado</label>
                            <div class="col-md-6">
                                <select name="state" id="state" class="form-control">

                                </select>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="control-label col-md-3" for="name">Visibilidad</label>
                            <div name="visibilities">

                            </div>
                        </div>

                        <div class="form-group">
                            <label class="control-label col-md-3" for="name">Descripción</label>
                            <div class="col-md-8">
                                <textarea name="description" id="description"  class="form-control area inside"></textarea>
                            </div>
                        </div>

                        <div class="modal-footer">
                            <div class="text-center">
                                <button class="btn btn-danger" data-dismiss="modal"><span class="glyphicon glyphicon-remove"></span> Cancelar</button>
                                <button class="btn btn-primary"><span class="glyphicon glyphicon-ok-circle" aria-hidden="true"></span> Guardar proyecto</button>
                            </div>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <div id="modalDelete" class="modal fade in">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Eliminar proyecto</h4>
                </div>
                <form id="formDelete" action="{{ url('proyectos/eliminar') }}" method="POST">
                    <div class="modal-body">

                        <input type="hidden" name="_token" value="{{ csrf_token() }}" />
                        <input type="hidden" name="id" />
                        <div class="form-group">
                            <label for="name">¿Desea eliminar el siguiente proyecto?</label>
                            <input  readonly class="form-control area" name="name"/>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <div class="text-center">
                            <button class="btn btn-danger" data-dismiss="modal"><span class="glyphicon glyphicon-remove"></span> Cancelar</button>
                            <button class="btn btn-primary"><span class="glyphicon glyphicon-ok-circle" aria-hidden="true"></span> Aceptar</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
@endsection

@section('scripts')
    <script src="{{ asset('assets/js/project/index.js')  }}"></script>
@endsection