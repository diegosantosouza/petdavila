@extends('admin.master.master')

@section('content')
    <section class="dash_content_app">

        <header class="dash_content_app_header">
            <h2 class="icon-user">Tutor : {{ $tutore->nome }}</h2>

            <div class="dash_content_app_header_actions">
                <nav class="dash_content_app_breadcrumb">
                    <ul>
                        <li><a href="{{ route('admin') }}">Início</a></li>
                        <li class="separator icon-angle-right icon-notext"></li>
                        <li><a href="{{ route('tutores.index') }}" class="text-orange">Tutor</a></li>
                    </ul>
                </nav>
            </div>
        </header>

        <div class="dash_content_app_box">
            <div class="nav">
                @if($errors->all())
                    @foreach($errors->all() as $error)
                        <div class="message message-orange">
                            <p class="icon-asterisk">{{ $error }}</p>
                        </div>
                    @endforeach
                @endif

                @if(session()->exists('message'))
                    <div class="message message-{{session()->get('color')}}">
                        <p class="icon-asterisk">{{ session()->get('message') }}</p>
                    </div>
                @endif


                <ul class="nav_tabs">
                    <li class="nav_tabs_item">
                        <a href="#financeiro" class="nav_tabs_item_link active">Registro Financeiro</a>
                    </li>

                </ul>

                <form class="app_form" action="" method=""
                      enctype="multipart/form-data">
                    <div class="nav_tabs_content">
                        <div id="financeiro">
                            <div class="text-right mt-2">
                                <h2 class="@if($conta>0)text-green @else text-orange @endif">Crédito: {{$conta}}</h2>
                            </div>

                            <table class="table table-sm table-hover">
                                <thead>
                                <tr>
                                    <th scope="col">Data</th>
                                    <th scope="col">Serviço</th>
                                    <th scope="col">Valor</th>
                                </tr>
                                </thead>
                                <tbody>
                                @if(!empty($tutore))
                                    @foreach($tutore->financeiroDono as $financeiro)
                                        <tr>
                                            <td class="text-center">{{$financeiro->created_at}}</td>
                                            <td class="text-center">{{$financeiro->servico}}</td>
                                            <th class="text-center @if($financeiro->operador == '-') text-orange @else text-green @endif">{{$financeiro->operador . $financeiro->valor}}</th>
                                        </tr>
                                    @endforeach
                                @endif
                                </tbody>
                            </table>
                        </div>
                    </div>
                </form>
            </div>
        </div>
@endsection
