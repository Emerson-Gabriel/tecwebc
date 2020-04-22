<?php
setlocale(LC_TIME, 'pt_BR', 'pt_BR.utf-8', 'pt_BR.utf-8', 'portuguese');
date_default_timezone_set('America/Sao_Paulo');
?>
<!doctype html>
<html lang="{{ app()->getLocale() }}">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <title>Sistema TCC</title>
        <meta name="description" content="Sufee Admin - HTML5 Admin Template">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <!------------------------>
        <!-- | Begin CSS | -->
        <link rel="apple-touch-icon" href="{{ asset('img/icon-logo.png') }}">
        <link rel="shortcut icon" href="{{ asset('img/icon-logo.png') }}">
        <link rel="stylesheet" href="{{ asset('assets/css/normalize.css') }}">
        <link rel="stylesheet" href="{{ asset('assets/css/chosen.min.css') }}">
        <link rel="stylesheet" href="{{ asset('assets/css/bootstrap.min.css') }}">
        <link rel="stylesheet" href="{{ asset('assets/css/font-awesome.min.css') }}">
        <link rel="stylesheet" href="{{ asset('assets/css/themify-icons.css') }}">
        <link rel="stylesheet" href="{{ asset('assets/css/flag-icon.min.css') }}">
        <link rel="stylesheet" href="{{ asset('assets/css/cs-skin-elastic.css') }}">
        <link rel="stylesheet" href="{{ asset('assets/scss/style.css') }}">
        <link rel="stylesheet" href="{{ asset('assets/css/lib/vector-map/jqvmap.min.css') }}">
        <link rel="stylesheet" href="{{ asset('css/materialdesignicons.min.css') }}">
        <link rel="stylesheet" href="{{ asset('assets/css/jquery.dataTables.min.css') }}">
        <link rel="stylesheet" href="{{ asset('css/style.css') }}">
        <link href='https://fonts.googleapis.com/css?family=Open+Sans:400,600,700,800' rel='stylesheet' type='text/css'>
        <!-- | End CSS | -->
        <!-- | Begin JS  |-->
        <script src="{{ asset('assets/js/vendor/jquery-2.1.4.min.js') }}"></script>
        <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.3/umd/popper.min.js"></script>
        <script src="{{ asset('assets/js/plugins.js') }}"></script>
        <script src="{{ asset('assets/js/main.js') }}"></script>
        <script src="{{ asset('assets/js/lib/vector-map/jquery.vmap.js') }}"></script>
        <script src="{{ asset('assets/js/lib/vector-map/jquery.vmap.min.js') }}"></script>
        <script src="{{ asset('assets/js/lib/vector-map/jquery.vmap.sampledata.js') }}"></script>
        <script src="{{ asset('assets/js/lib/vector-map/country/jquery.vmap.world.js') }}"></script>
        <script src="{{ asset('js/popper.min.js') }}"></script>
        <script src="{{ asset('js/jquery.min.js') }}"></script>
        <script src="{{ asset('js/jquery.maskedinput.js') }}"></script>
        <script src="{{ asset('js/jquery.validate.min.js') }}"></script>
        <script src="{{ asset('js/chosen.jquery.min.js') }}"></script>
        <!--<script src="{{ asset('js/jquery.dataTables.min.js') }}"></script>-->
        <!-- | End JS | -->
        <!------------------------>
        <script>
        $(function () {
            $(window).load(function () {
                $('#loader').fadeOut('fast');
            });
        });
        </script>
    </head>
    <body>
        <!-- | Begin Loader | -->
        <div id="loader" class=" text-center">
            <img alt="loader" src="{{ asset('img/loader.svg') }}" class="img-responsive">
        </div>
        <!-- | End Loader | -->
        <!-- | Begin Lateral Bar | -->
        <aside id="left-panel" class="left-panel">
            <nav class="navbar navbar-expand-sm navbar-default">
                <div class="navbar-header">
                    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#main-menu" aria-controls="main-menu" aria-expanded="false" aria-label="Toggle navigation">
                        <i class="fa fa-bars"></i>
                    </button>
                    <a class="navbar-brand logo_top" href="./">
                        <img src="{{ asset('img/logo.png') }}" alt="Logo">
                    </a>
                    <a class="navbar-brand hidden" href="/index">
                        <h5 class="text_white">E</h5>
                        <!--<img src="images/logo2.png" alt="Logo">-->
                    </a>
                </div>
                <div id="main-menu" class="main-menu collapse navbar-collapse">
                    <ul class="nav navbar-nav">
                        @guest
                        <li>
                            <a href="{{ route('login') }}" class="animate">
                                <span class="desc animate"> Login </span>
                                <span class="mdi mdi-18px mdi-account"></span>
                            </a>
                        </li>
                        <!--                        <li>
                                                    <a href="{{ route('register') }}" class="animate">
                                                        <span class="desc animate"> Registrar </span>
                                                        <span class="mdi mdi-18px mdi-account-multiple"></span>
                                                    </a>
                                                </li>-->
                        @else
                        <li class="active">
                            <a href="/"> <i class="menu-icon fa fa-dashboard"></i>Início</a>
                        </li>
                        <h3 class="menu-title"></h3>
                        <li class="menu-item-has-children dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> 
                                <i class="menu-icon fa fa-plus-square-o"></i>Cadastros
                            </a>
                            <ul class="sub-menu children dropdown-menu">
                                <li><i class="menu-icon fa fa-user"></i><a href="/aluno/listar">Alunos</a></li>
                                <li><i class="menu-icon fa fa-bookmark-o"></i><a href="/area-de-interesse/listar">Área de Interesse</a></li>
                                <li><i class="menu-icon fa fa-briefcase"></i><a href="/cargo/listar">Cargo</a></li>
                                <li><i class="menu-icon fa fa-gears"></i><a href="/chefia/listar">Chefia</a></li>
                                <li><i class="menu-icon fa fa-gavel"></i><a href="/conceito/listar">Conceito</a></li>
                                <li><i class="menu-icon fa fa-archive"></i><a href="/curso/listar">Curso</a></li>
                                <!--<li><i class="menu-icon fa fa-paste "></i><a href="/gerar-relatorios/listar">Gerar Relatórios</a></li>-->
                                <li><i class="menu-icon fa fa-map-marker"></i><a href="/local/listar">Local</a></li>
                                <li><i class="menu-icon fa fa-smile-o"></i><a href="/professor/listar">Professores</a></li>
                                <li><i class="menu-icon fa fa-ticket"></i><a href="/tipo-de-trabalho/listar">Tipo de Trabalho</a></li>
                            </ul>
                        </li>
                        <h3 class="menu-title"></h3>
                        <li class="menu-item-has-children dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="menu-icon fa fa-tasks"></i>Formalização</a>
                            <ul class="sub-menu children dropdown-menu">
                                <li><i class="menu-icon fa fa-tasks"></i><a href="/formalizacao">Cadastrar</a></li>
                                <li><i class="menu-icon fa fa-list"></i><a href="/formalizacao/listar">Listar</a></li>
                            </ul>
                        </li>
                        <hr/>
                        <h3 class="menu-title"></h3>
                        <li class="menu-item-has-children dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="menu-icon fa fa-tasks"></i>Marcação</a>
                            <ul class="sub-menu children dropdown-menu">
                                <li><i class="menu-icon fa fa-tasks"></i><a href="/marcacao">Cadastrar</a></li>
                                <li><i class="menu-icon fa fa-list"></i><a href="/marcacao/listar">Listar</a></li>
                            </ul>
                        </li>
                        <hr/>
                        <h3 class="menu-title"></h3>
                        <li class="menu-item-has-children dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"> <i class="menu-icon fa fa-tasks"></i>Finalização</a>
                            <ul class="sub-menu children dropdown-menu">
                                <li><i class="menu-icon fa fa-tasks"></i><a href="/finalizacao">Cadastrar</a></li>
                                <li><i class="menu-icon fa fa-list"></i><a href="/finalizacao/listar">Listar</a></li>
                            </ul>
                        </li>
                        <hr/>
                        <li>
                            <a onclick="event.preventDefault(); document.getElementById('logout-form').submit();" href="{{ route('logout') }}">
                                <span class="desc animate"> Sair </span>
                                <span class="mdi mdi-18px mdi-logout-variant "></span>
                            </a>
                        </li>
                        <form id="logout" method="POST" action="/logout">
                            @csrf
                        </form>
                        @endguest
                    </ul>
                </div>
            </nav>
        </aside>
        <!-- | End Lateral Bar | -->
        <!-- Right Panel -->
        <div id="right-panel" class="right-panel">
            <!-- Header-->
            <header id="header" class="header">
                <div class="header-menu">

                    <div class="col-sm-7">
                        <a id="menuToggle" class="menutoggle pull-left"><i class="fa fa fa-tasks"></i></a>
                        <div class="header-left">
                            <button class="search-trigger"><i class="fa fa-search"></i></button>
                            <div class="form-inline">
                                <form class="search-form">
                                    <input class="form-control mr-sm-2" type="text" placeholder="Pesquisar ..." aria-label="Pesquisar">
                                    <button class="search-close" type="submit"><i class="fa fa-close"></i></button>
                                </form>
                            </div>

                            <div class="dropdown for-notification"  style="display: none;">
                                <button class="btn btn-secondary dropdown-toggle" type="button" id="notification" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <i class="fa fa-bell"></i>
                                    <span class="count bg-danger">5</span>
                                </button>
                                <div class="dropdown-menu" aria-labelledby="notification"  style="display: none;">
                                    <p class="red">Você possui 3 notificações.</p>
                                    <a class="dropdown-item media bg-flat-color-1" href="#">
                                        <i class="fa fa-check"></i>
                                        <p class="text-white">Novos dados encontrados.</p>
                                    </a>
                                    <a class="dropdown-item media bg-flat-color-4" href="#">
                                        <i class="fa fa-info"></i>
                                        <p class="text-white">Relatórios concluidos.</p>
                                    </a>
                                    <a class="dropdown-item media bg-flat-color-5" href="#">
                                        <i class="fa fa-warning"></i>
                                        <p class="text-white">Processo de finalização executado.</p>
                                    </a>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-sm-5">
                        <div class="user-area dropdown float-right">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <img class="user-avatar rounded-circle" src="{{ asset('img/avatar/user.png') }}" alt="">
                            </a>
                            @guest

                            @else
                            <span id="name_user">
                                {{ Auth::user()->name }}
                            </span>
                            @endguest
                            <div class="user-menu dropdown-menu">
                                @guest
                                <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>

                                <a class="nav-link" href="{{ route('register') }}">{{ __('Registrar') }}</a>
                                @else
                                <a class="nav-link" href="#"><i class="fa fa- user"></i>Meus Dados</a>

                                <a class="nav-link" href="#" style="display: none;"><i class="fa fa- user"></i>Notificações <span class="count">13</span></a>

                                <a class="nav-link" href="#"><i class="fa fa -cog"></i>Configurações</a>

                                <a class="nav-link" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                    {{ __('Sair') }}
                                </a>
                                <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                    @csrf
                                </form>
                                @endguest
                            </div>
                        </div>
                    </div>
                </div>
            </header>
            <!-- Header-->

            <div class="breadcrumbs">
                <div class="col-sm-4">
                    <div class="page-header float-left">
                        <div class="page-title">
                            <h1>TECWEBC</h1>
                        </div>
                    </div>
                </div>
                <div class="col-sm-8">
                    <div class="page-header float-right">
                        <div class="page-title">
                            <ol class="breadcrumb text-right">
                                <li class="active"><a><?= date("d/m/Y | H:i") ?></a></li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>

            <div class="content mt-3">

                @guest
                <div class="sufee-alert alert with-close alert-dark alert-dismissible fade show">
                    <span class="badge badge-pill badge-dark">Atenção</span>
                    Você ainda não realizou o login ao sistema. Realize o <a href="/login" class="bold alert-link">login.</a>
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                </div>
                @else
                @yield("conteudo")
                @endguest    


                <!--                <div class="col-sm-12">
                                    <div class="alert  alert-success alert-dismissible fade show" role="alert">
                                        <span class="badge badge-pill badge-success">Parabéns</span> Login realizado com sucesso!
                                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                                            <span aria-hidden="true">&times;</span>
                                        </button>
                                    </div>
                                </div>-->

                <div class="col-sm-12 ">
                    <!--<div class="alert  alert-danger alert-dismissible fade show" role="alert">-->
                    <div class="alert  alert-danger alert-dismissible fade hide" role="alert">
                        <span class="badge badge-pill badge-danger">Erro</span> Foram localizados alguns erros!
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                        @if ($errors->any())
                        <div>
                            <strong>Erro!</strong> Existem campos obrigatorios:
                            <ul>
                                @foreach ($errors->all() as $erro)
                                <li>{{$erro}}</li>
                                @endforeach
                            </ul>
                        </div>
                        @endif
                    </div>
                </div>
            </div>

        </div> 

    </body>
</html>