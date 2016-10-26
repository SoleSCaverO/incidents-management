@extends('layouts.panel')
@section('title','Incidencias')
@section('view','Gestión de incidencias')

@section('styles')
    <style>
        .area
        {
            resize: none;
        }
        .img
        {
            width:35px;
            height:35px;
        }
    </style>
    <link rel="stylesheet" href="{{asset('assets/css/footable.bootstrap.min.css')}}">
@endsection

@section('content')
    <div class="row">
        <button data-register class="btn btn-success">Nueva incidencia</button>
        <input type="hidden" id="project"  value="{{ $project }}">
    </div>
    <div class="row">
        <div class="table-responsive ">
            <table class="table table-striped mytable">
                <thead>
                <tr>
                    <th>Incidencia</th>
                    <th data-hide="all" data-breakpoints="all" data-title="Resumen"></th>
                    <th>Categoría</th>
                    <th>Estado</th>
                    <th>Fecha</th>
                    <th>Frecuencia</th>
                    <th>Prioridad</th>
                    <th>Encargado</th>
                    <th data-type="html">Archivo</th>
                    <th data-hide="all" data-breakpoints="all" data-title="Visibilidad"></th>
                    <th data-hide="all" data-breakpoints="all" data-title="Plataforma"></th>
                    <th data-hide="all" data-breakpoints="all" data-title="Sistema Operativo"></th>
                    <th data-hide="all" data-breakpoints="all" data-title="Versión de SO"></th>
                    <th data-type="html">Acción</th>
                </tr>
                </thead>
                <tbody>
                @foreach( $incidents as $incident )
                    <tr>
                        <td>{{ $incident->name }}</td>
                        <td>{{ $incident->summary }}</td>
                        <td>{{( $incident->category ==1)?'Software':'Hardware'}}</td>
                        <td>{{ $incident->state->name }}</td>
                        <td>{{ $incident->date }}</td>
                        <td>{{ $incident->frequency->name }}</td>
                        <td>{{ $incident->priority->name }}</td>
                        <td>{{ $incident->user->name }}</td>
                        <td><img src="{{asset('assets/img/incident/'.$incident->file)}}" class="img" title="Click para descargar"   alt="Documento de incidente">
                        <td>{{( $incident->visibility ==1)?'Pública':'Privada'}}</td>
                        <td>{{ $incident->platform }}</td>
                        <td>{{ $incident->os }}</td>
                        <td>{{ $incident->os_version }}</td>
                        <td>
                            <button class="btn btn-primary" data-edit="{{ $incident->id }}"
                                    data-name="{{ $incident->name }}"
                                    data-summary="{{ $incident->name }}"
                                    data-category="{{ $incident->category }}"
                                    data-state="{{ $incident->state_id }}"
                                    data-frequency="{{ $incident->frequency_id }}"
                                    data-priority="{{ $incident->priority_id }}"
                                    data-visibility="{{ $incident->visibility }}"
                                    data-platform="{{ $incident->platform }}"
                                    data-os="{{ $incident->os }}"
                                    data-os_version="{{ $incident->os_version }}">
                                <span class="glyphicon glyphicon-edit color" aria-hidden="true" title="Editar"></span>
                            </button>
                            <button class="btn btn-danger" data-delete="{{ $incident->id }}" data-name="{{ $incident->name }}">
                                <span class="glyphicon glyphicon-trash color" aria-hidden="true" title="Eliminar"> </span>
                            </button>
                            <button class="btn btn-info" data-solve="{{ $incident->id }}" data-name="{{ $incident->name }}">
                                Resolver
                            </button>
                            <button class="btn btn-warning" data-assign="{{ $incident->id }}" data-name="{{ $incident->name }}">
                                Asignar
                            </button>
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>
    </div>
    <div class="row text-center">
        <a href="{{ url('proyecto-incidencias') }}" class="btn btn-danger">
            <span class="glyphicon glyphicon-backward"></span> Volver
         </a>
    </div>
@endsection

@section('modals')
    <div id="modalRegister" class="modal fade in">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h4 class="modal-title">Registrar incidencia</h4>
                </div>

                <form id="formRegister" action="{{ url('incidencias/registrar') }}" class="form-horizontal form-label-left"  method="POST" enctype="multipart/form-data">
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
                            <label class="control-label col-md-3" for="summary">Resumen<span class="required">*</span></label>
                            <div class="col-md-8">
                                <textarea id="summary" name="summary" required="required" class="form-control inside area"></textarea>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="control-label col-md-3" for="category">Categoría</label>
                            <div class="col-md-3">
                                <input type="radio" name="category" value="1" checked>Software
                            </div>
                            <div class="col-md-3">
                                <input type="radio" name="category" value="2">Hardware
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="control-label col-md-3" for="state">Estado</label>
                            <div class="col-md-6">
                                <select name="state" id="state" class="form-control">

                                </select>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="control-label col-md-3" for="frecuency">Frecuencia</label>
                            <div class="col-md-6">
                                <select name="frequency" id="frequency" class="form-control">

                                </select>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="control-label col-md-3" for="priority">Prioridad</label>
                            <div class="col-md-6">
                                <select name="priority" id="priority" class="form-control">

                                </select>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="control-label col-md-3" for="file">Archivo</label>
                            <div class="col-md-8">
                                <input type="file" name="file" class="form-control inside" accept="image/*,application/pdf, application/vnd.openxmlformats-officedocument.wordprocessingml.document,application/msword">
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="control-label col-md-3" for="visibility">Visibilidad</label>
                            <div class="col-md-3">
                                <input type="radio" name="visibility" value="1" checked>Pública
                            </div>
                            <div class="col-md-3">
                                <input type="radio" name="visibility" value="2">Privada
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="control-label col-md-3" for="name">Perfil</label>
                            <div class="col-md-8">
                                <input id="platform" name="platform" placeholder="Plataforma" class="form-control inside">
                                <input id="os" name="os" placeholder="Sistema operativo" class="form-control inside">
                                <input id="os_version" name="os_version" placeholder="Versión de SO" class="form-control inside">
                            </div>
                        </div>

                        <div class="modal-footer">
                            <div class="text-center">
                                <button class="btn btn-danger" data-dismiss="modal"><span class="glyphicon glyphicon-remove"></span> Cancelar</button>
                                <button class="btn btn-primary"><span class="glyphicon glyphicon-ok-circle" aria-hidden="true"></span> Registrar incidencia</button>
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
                    <h4 class="modal-title">Editar incidencia</h4>
                </div>

                <form id="formEdit" action="{{ url('incidencias/editar') }}" class="form-horizontal form-label-left"  method="POST" enctype="multipart/form-data">
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
                            <label class="control-label col-md-3" for="summary">Resumen<span class="required">*</span></label>
                            <div class="col-md-8">
                                <textarea id="summary" name="summary" required="required" class="form-control inside area"></textarea>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="control-label col-md-3" for="category">Categoría</label>
                            <div name="categories">

                            </div>
                        </div>

                        <div class="form-group">
                            <label class="control-label col-md-3" for="state">Estado</label>
                            <div class="col-md-6">
                                <select name="state" id="state" class="form-control">

                                </select>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="control-label col-md-3" for="frecuency">Frecuencia</label>
                            <div class="col-md-6">
                                <select name="frequency" id="frequency" class="form-control">

                                </select>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="control-label col-md-3" for="priority">Prioridad</label>
                            <div class="col-md-6">
                                <select name="priority" id="priority" class="form-control">

                                </select>
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="control-label col-md-3" for="file">Archivo</label>
                            <div class="col-md-8">
                                <input type="file" name="file" class="form-control inside" accept="image/*,application/pdf, application/vnd.openxmlformats-officedocument.wordprocessingml.document,application/msword">
                            </div>
                        </div>

                        <div class="form-group">
                            <label class="control-label col-md-3" for="visibility">Visibilidad</label>
                            <div name="visibilities">

                            </div>
                        </div>

                        <div class="form-group">
                            <label class="control-label col-md-3" for="name">Perfil</label>
                            <div class="col-md-8">
                                <input id="platform" name="platform" placeholder="Plataforma" class="form-control inside">
                                <input id="os" name="os" placeholder="Sistema operativo" class="form-control inside">
                                <input id="os_version" name="os_version" placeholder="Versión de SO" class="form-control inside">
                            </div>
                        </div>


                        <div class="modal-footer">
                            <div class="text-center">
                                <button class="btn btn-danger" data-dismiss="modal"><span class="glyphicon glyphicon-remove"></span> Cancelar</button>
                                <button class="btn btn-primary"><span class="glyphicon glyphicon-ok-circle" aria-hidden="true"></span> Guardar incidencia</button>
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
                    <h4 class="modal-title">Eliminar incidencia</h4>
                </div>
                <form id="formDelete" action="{{ url('incidencias/eliminar') }}" method="POST">
                    <div class="modal-body">

                        <input type="hidden" name="_token" value="{{ csrf_token() }}" />
                        <input type="hidden" name="id" />
                        <div class="form-group">
                            <label for="name">¿Desea eliminar la siguiente incidencia?</label>
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
    <script src="{{ asset('assets/js/footable.min.js') }}"></script>
    <script src="{{ asset('assets/js/incident/index.js')  }}"></script>
@endsection