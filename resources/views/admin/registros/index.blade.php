@extends('admin.master.master')

@section('content')
    <div style="flex-basis: 100%;">
        <section class="dash_content_app">

            <header class="dash_content_app_header">
                <h2 class="icon-search">Registros <h3>{{date('Y')}}</h3></h2>

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

            @if(!empty($registros))

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
                                <th>Categoria</th>
                                <th>Day</th>
                                <th>Night</th>
                                <th>Fds</th>
                                <th>Obs.</th>
                            </tr>
                            </thead>
                            <tbody>

                            @foreach($registros as $registro)
                                <tr>
                                    <td>{{$registro->id}}</td>
                                    <td>{{$registro->registrosAnimal->id}}</td>
                                    <td>{{$registro->registrosAnimal->nome}}</a></td>
                                    <td>{{$registro->registrosAnimal->raca}}</td>
                                    <td>{{$registro->tutorAnimal->nome}}</td>
                                    <td>{{$registro->getEntradaDataAttribute()}}</td>
                                    <td>{{$registro->getSaidaDataAttribute()}}</td>
                                    <td>{{$registro->animalCategoria->categoria}}</td>
                                    <th>{{$registro->daycare}}</th>
                                    <th>{{$registro->nightcare}}</th>
                                    <th>{{$registro->fds}}</th>
                                    <td>@if(!empty($registro->observacoes)){{$registro->observacoes}}@endif</td>
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
