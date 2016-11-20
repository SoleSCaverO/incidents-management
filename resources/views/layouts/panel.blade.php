<!doctype html>
<html>

<head>
    <title>Gestor de incidencias | @yield('title')</title>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="Free Admin Template Based On Twitter Bootstrap 3.x">
    <meta name="author" content="">
    <meta name="msapplication-TileColor" content="#5bc0de" />
    <meta name="msapplication-TileImage" content="assets/img/metis-tile.png" />

    <link rel="stylesheet" href="{{asset('assets/lib/bootstrap/css/bootstrap.css')}}">
    <link href="//maxcdn.bootstrapcdn.com/font-awesome/4.2.0/css/font-awesome.min.css" rel="stylesheet">
    <link rel="stylesheet" href="{{asset('assets/css/main.css')}}">
    <link rel="stylesheet" href="{{asset('assets/lib/metismenu/metisMenu.css')}}">
    <link rel="stylesheet" href="{{asset('assets/lib/animate.css/animate.css')}}">
    <link rel="stylesheet" href="{{asset('assets/css/style-switcher.css')}}">
    <link rel="stylesheet/less" type="text/css" href="{{asset('assets/less/theme.less')}}">
    <script src="{{asset('assets/less/less.js')}}"></script>
    <style>
        .unique
        {
            width: 20px;
            height: 20px;
        }
    </style>
    @yield('styles')
</head>

<body>
<div class="bg-dark dk" id="wrap">
    <div id="top">
        <nav class="navbar navbar-inverse navbar-static-top">
            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-ex1-collapse">
                <span class="sr-only">Toggle navigation</span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
                <span class="icon-bar"></span>
            </button>
            <div class="collapse navbar-collapse navbar-ex1-collapse">

                <!-- .nav -->
                <ul class="nav navbar-nav">
                    <li><a href="">Gerencia de Sistemas</a></li>
                    @if(Auth::user()->role_id == 2 )
                        <li class='dropdown '>
                            <a href="" class="dropdown-toggle" data-toggle="dropdown">
                                Gestionar de usuarios <i class="fa fa-caret-square-o-down"></i>
                            </a>
                            <ul class="dropdown-menu">
                                <li><a href="">Niveles</a></li>
                                <li><a href="">Roles</a></li>
                            </ul>
                        </li>
                    @endif
                </ul>
                <ul class="nav navbar-nav pull-right">
                    <li class="">
                        <a href="javascript:;" class="user-profile dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                            <img class="unique" src="{{ asset('assets/img/user.png') }}" alt=""> {{ Auth::user()->name }}
                            <span class=" fa fa-angle-down"></span>
                        </a>
                        <ul class="dropdown-menu dropdown-usermenu pull-right">
                            <li><a href="{{ url('/logout') }}"><i class="fa fa-sign-out pull-right"></i> Salir</a></li>
                        </ul>
                    </li>
                </ul>
            </div>
        </nav>

        <header class="head">
            <div class="search-bar">
                <form class="main-search">
                    <div class="input-group">
                        <input type="text" class="form-control" value="Visitante">
                    </div>
                </form>
            </div>

            <div class="main-bar">
                <h3>@yield('view')</h3>
            </div>
        </header>
    </div>

    <div id="left">
        <div class="media user-media bg-dark dker">
            <div class="user-media-toggleHover">
                <span class="fa fa-user"></span>
            </div>
            <div class="user-wrapper bg-dark">
                <a class="user-link" href="">
                    <img class="media-object img-thumbnail user-img" alt="User Picture" src="{{asset('assets/img/user.png')}}">
                </a>

                <div class="media-body">
                    <h5>{{ Auth::user()->name }}</h5>
                    <ul class="list-unstyled user-info">
                        <li><a href="">{{ (Auth::user()->role_id==1)?"Usuario":"Administador" }}</a></li>
                        <li>En línea <br>
                            <small><i class="fa fa-calendar"></i> {{  Carbon\Carbon::now('America/Lima')  }}</small>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
        <ul id="menu" class="bg-blue dker">
            <li class="nav-divider"></li>
            <li class="nav-divider"></li>
            <li class="nav-header">Menú</li>
            <li class="nav-divider"></li>
            <li class="nav-divider"></li>
            <li>
                <a href="{{url('proyectos')}}">
                    <i class="fa fa-bullseye"></i><span class="link-title"> Gestionar proyectos</span>
                </a>
            </li>
            <li>
                <a href="{{url('proyecto-niveles')}}">
                    <i class="fa fa-exchange"></i><span class="link-title"> Gestionar Niveles</span>
                </a>
            </li>
            <li>
                <a href="{{url('seguimiento-incidencias')}}">
                    <i class="fa fa-list-alt"></i><span class="link-title"> Seguimiento de incidencias</span>
                </a>
            </li>
            <li>
                <a href="{{url('reporte-incidencias-baja')}}">
                    <i class="fa fa-line-chart"></i><span class="link-title"> Incidencias dadas de baja</span>
                </a>
            </li>
            <li>
                <a href="{{url('reporte-incidencias-solucionadas')}}">
                    <i class="fa fa-area-chart"></i><span class="link-title"> Incidencias solucionadas</span>
                </a>
            </li>
            <li class="nav-divider"></li>
            <li class="nav-divider"></li>
            <li class="nav-divider"></li>
            <li class="nav-divider"></li>
        </ul>
    </div>

    <div id="content">
        <div class="outer">
            <div class="inner bg-light lter">
                <div class="col-lg-12">
                    <br>
                    @yield('content')
                </div>
            </div>
        </div>
    </div>

</div>

<footer class="Footer bg-dark dker">
    <p>Gerencia de Sistemas - Gestor de incidencias 2016  by Soles Cavero, Edilberto</p>
</footer>

@yield('modals')

<script src="{{asset('assets/lib/jquery/jquery.js')}}"></script>
<script src="{{asset('assets/lib/bootstrap/js/bootstrap.js')}}"></script>
<script src="{{asset('assets/js/notify.min.js')}}"></script>
<script src="{{asset('assets/lib/metismenu/metisMenu.js')}}"></script>
<script src="{{asset('assets/lib/screenfull/screenfull.js')}}"></script>
<script src="{{asset('assets/js/core.js')}}"></script>
<script src="{{asset('assets/js/app.js')}}"></script>
<script src="{{asset('assets/js/style-switcher.js')}}"></script>
<script src="{{asset('assets/js/message.js')}}"></script>

@yield('scripts')

</body>

</html>
