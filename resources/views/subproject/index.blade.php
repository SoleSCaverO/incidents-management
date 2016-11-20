@extends('layouts.panel')
@section('title','Subproyectos')
@section('view','Gestión de subproyectos')

@section('styles')
    <style>
        .area
        {
            resize: none;
        }
    </style>
@endsection

@section('content')
    <div class="row">
        <button data-register class="btn btn-success">Nuevo subproyecto</button>
        <input type="hidden" id="project" value="{{ $project }}">
    </div>
    <div class="row">
        <div class="table-responsive ">
            <table class="table table-striped">
                <thead>
                <tr>
                    <th>Subproyecto</th>
                    <th>Estado</th>
                    <th>Visibilidad</th>
                    <th>Descripción</th>
                    <th>Acción</th>
                </tr>
                </thead>
                <tbody>
                @foreach( $subprojects as $subproject )
                    <tr>
                        <td>{{ $subproject->name }}</td>
                        <td>{{ $subproject->state->name }}</td>
                        <td>{{( $subproject->visibility ==1)?'Público':'Privado'}}</td>
                        <td>{{ $subproject->description }}</td>
                        <td>
                            <button class="btn btn-primary" data-edit="{{ $subproject->id }}"
                                    data-name="{{ $subproject->name }}"
                                    data-state="{{ $subproject->state_id }}"
                                    data-visibility="{{ $subproject->visibility }}"
                                    data-description="{{ $subproject->description }}"> Editar
                            </button>
                            <button class="btn btn-danger" data-delete="{{ $subproject->id }}" data-name="{{ $subproject->name }}">
                                Eliminar
                            </button>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
    <div class="row text-center">
        <a href="{{url('proyectos')}}" class="btn btn-danger"><span class="glyphicon glyphicon-backward"></span> Volver</a>
    </div>
@endsection

@section('modals')
    <div id="modalRegister" class="modal fade in">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Registrar subproyecto</h4>
                </div>

                <form id="formRegister" action="{{ url('subproyectos/registrar') }}" class="form-horizontal form-label-left"  method="POST" enctype="multipart/form-data">
                    <div class="modal-body">
                        <input type="hidden" name="_token" value="{{ csrf_token() }}" />
                        <input type="hidden" id="project" name="project">

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
                                <button class="btn btn-primary"><span class="glyphicon glyphicon-ok-circle" aria-hidden="true"></span> Registrar subproyecto</button>
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
                    <h4 class="modal-title">Editar subproyecto</h4>
                </div>

                <form id="formEdit" action="{{ url('subproyectos/editar') }}" class="form-horizontal form-label-left"  method="POST" enctype="multipart/form-data">
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
                                <button class="btn btn-primary"><span class="glyphicon glyphicon-ok-circle" aria-hidden="true"></span> Guardar subproyecto</button>
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
                    <h4 class="modal-title">Eliminar subproyecto</h4>
                </div>
                <form id="formDelete" action="{{ url('subproyectos/eliminar') }}" method="POST">
                    <div class="modal-body">

                        <input type="hidden" name="_token" value="{{ csrf_token() }}" />
                        <input type="hidden" name="id" />

                        <div class="form-group">
                            <label for="name">¿Desea eliminar el siguiente subproyecto?</label>
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
    <script src="{{ asset('assets/js/subproject/index.js')  }}"></script>
@endsection