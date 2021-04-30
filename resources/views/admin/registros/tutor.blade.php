@extends('admin.master.master')

@section('content')
    <div style="flex-basis: 100%;">
        <section class="dash_content_app">

            <header class="dash_content_app_header">
                <h2 class="icon-search">Tutor: {{$tutor->nome}} <h3>Registros {{'('.$inicio . ' - ' . $termino.')'}}</h3></h2>

                <div class="dash_content_app_header_actions">
                    <nav class="dash_content_app_breadcrumb">
                        <ul>
                            <li><a href="{{ route('admin') }}">Início</a></li>
                            <li class="separator icon-angle-right icon-notext"></li>
                            <li><a href="{{ route('registros.index') }}" class="text-orange">Registros</a></li>
                        </ul>
                    </nav>
                </div>
            </header>

            @if(!empty($buscas))
                <div class="dash_content_app_box">
                    <div class="dash_content_app_box_stage">
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

                        <table id="dataTable" class="nowrap stripe" width="100" style="width: 100% !important;">
                            <thead>
                            <tr>
                                <th>Registro</th>
                                <th>ID Animal</th>
                                <th>Animal</th>
                                <th>Raça</th>
                                <th>Tutor</th>
                                <th>Entrada</th>
                                <th>Saída</th>
                            </tr>
                            </thead>
                            <tbody>

                            @foreach($buscas as $busca)
                                <tr>
                                    <td>{{$busca->id}}</td>
                                    <td>{{$busca->registrosAnimal->id}}</td>
                                    <td>{{$busca->registrosAnimal->nome}}</a></td>
                                    <td>{{$busca->registrosAnimal->raca}}</td>
                                    <td>{{$busca->tutorAnimal->nome}}</td>
                                    <td>{{$busca->getEntradaDataAttribute()}}</td>
                                    <td>{{$busca->getSaidaDataAttribute()}}</td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            @endif
        </section>
    </div>
@endsection
