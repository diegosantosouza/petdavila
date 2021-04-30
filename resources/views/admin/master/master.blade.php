<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width,initial-scale=1,maximum-scale=1,user-scalable=0">

    <link rel="stylesheet" href="{{ url(mix('backend/assets/css/reset.css')) }}"/>
    <link rel="stylesheet" href="{{ url(mix('backend/assets/css/libs.css')) }}">
    <link rel="stylesheet" href="{{ url(mix('backend/assets/css/boot.css')) }}"/>
    <link rel="stylesheet" href="{{ url(mix('backend/assets/css/style.css')) }}"/>

    @hasSection('css')
        @yield('css')
    @endif

    <link rel="icon" type="image/png" href="{{ url(asset('backend/assets/images/favicon.png')) }}"/>

    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>Pet da Vila</title>
</head>
<body>

<div class="ajax_load">
    <div class="ajax_load_box">
        <div class="ajax_load_box_circle"></div>
        <p class="ajax_load_box_title">Aguarde, carregando...</p>
    </div>
</div>

<div class="ajax_response"></div>

@php
    if(\Illuminate\Support\Facades\File::exists(public_path() . '/storage/' . \Illuminate\Support\Facades\Auth::user()->foto )){
        $foto = \Illuminate\Support\Facades\Auth::user()->url_foto;

    } else {
        $foto = url(asset('backend/assets/images/avatar.jpg'));
    }
@endphp

<div class="dash">
    <aside class="dash_sidebar">
        <article class="dash_sidebar_user">
            <img class="dash_sidebar_user_thumb" src="{{ $foto }}" alt="" title=""/>

            <h1 class="dash_sidebar_user_name">
                <a href="#">{{ \Illuminate\Support\Facades\Auth::user()->name }}</a>
            </h1>


        </article>

        <ul class="dash_sidebar_nav">
            <li class="dash_sidebar_nav_item {{ isActive('admin')}} ">
                <a class="icon-tachometer" href="{{ route('admin') }}">Dashboard</a>

            <li class="dash_sidebar_nav_item {{ isActive('tutores')}}">
                <a class="icon-user " href="{{ route('tutores.index') }}">Tutor</a>
                <ul class="dash_sidebar_nav_submenu">
                    <li class=""><a href="{{ route('tutores.index') }}">Ver Todos</a></li>

                    <li class=""><a href="{{ route('tutores.create') }}">Criar Novo</a></li>

                </ul>
            </li>

            <li class="dash_sidebar_nav_item {{ isActive('animais')}}">
                <a class="icon-users " href="{{ route('animais.index') }}">Animais</a>
                <ul class="dash_sidebar_nav_submenu">
                    <li class=""><a href="{{ route('animais.index') }}">Ver Todos</a></li>
                </ul>
            </li>

            <li class="dash_sidebar_nav_item {{ isActive('registros')}}">
                <a class="icon-book" href="{{ route('registros.index') }}">Registro</a>
                <ul class="dash_sidebar_nav_submenu">
                    <li class=""><a href="{{ route('registros.index') }}">Ver Todos</a></li>

                    <li class=""><a href="{{ route('registros.create') }}">Entrada</a></li>

                    <li class=""><a href="{{ route('registros.relatorios') }}">Relatórios</a></li>
                </ul>
            </li>

            <li class="dash_sidebar_nav_item"><a class="icon-reply" href="{{ route('admin.logout') }}">Sair</a></li>


        </ul>

    </aside>

    <section class="dash_content">

        <div class="dash_userbar">
            <div class="dash_userbar_box">
                <div class="dash_userbar_box_content">
                    <span class="icon-align-justify icon-notext mobile_menu transition btn btn-green"></span>
                    <h1 class="transition">
                        <i class="icon-desktop text-orange"></i><a href="{{ route('admin') }}">Pet da
                            <b>Vila</b></a>
                    </h1>
                    <div class="dash_userbar_box_bar no_mobile">
                        <a class="text-red icon-sign-out" href="{{ route('admin.logout') }}">Sair</a>
                    </div>
                </div>
            </div>
        </div>

        <div class="dash_content_box">
            @yield('content')
        </div>
    </section>
</div>


<script src="{{ url(mix('backend/assets/js/jquery.js')) }}"></script>
<script src="{{ url(asset('backend/assets/js/tinymce/tinymce.min.js')) }}"></script>
<script src="{{ url(mix('backend/assets/js/libs.js')) }}"></script>
<script src="{{ url(mix('backend/assets/js/scripts.js')) }}"></script>
<script src="{{ url('backend/assets/bootstrap/js/bootstrap.bundle.js')}}"></script>
<script src="{{ url('backend/assets/bootstrap/js/bootstrap.js')}}"></script>


@hasSection('js')
    @yield('js')
@endif

</body>
</html>
