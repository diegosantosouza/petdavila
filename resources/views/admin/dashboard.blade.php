@extends('admin.master.master')

@section('content')
    <div style="flex-basis: 100%;">
        <section class="dash_content_app">
            <header class="dash_content_app_header">
                <h2 class="icon-tachometer">Dashboard</h2>
            </header>
            <div class="dash_content_app_box">
                <section class="app_dash_home_stats">
                    <article class="control radius">
                        <h4 class="icon-home">Agora</h4>
                        <h1 class="text-center mt-2 mb-2">{{$agora}}</h1>
                    </article>

                    <article class="blog radius">
                        <h4 class="icon-history">Hoje</h4>
                        <h1 class="text-center mt-2 mb-2">{{$hoje}}</h1>
                    </article>

                    <article class="users radius">
                        <h4 class="icon-calendar">Este mês</h4>
                        <h1 class="text-center mt-2 mb-2">{{$mes}}</h1>
                    </article>
                </section>
            </div>
        </section>

        <section class="dash_content_app" style="margin-top: 40px;">
            <header class="dash_content_app_header">
                <h2 class="icon-bell-o">Últimas entradas</h2>
            </header>
            @if(!empty($registros))

                <div class="dash_content_app_box">
                    <div class="dash_content_app_box_stage">
                        <table id="dataTable" class="nowrap stripe" width="100"
                               style="width: 100% !important;">
                            <thead>
                            <tr>
                                <th>ID</th>
                                <th>Animal</th>
                                <th>Raça</th>
                                <th>Tutor</th>
                                <th>Entrada</th>
                                <th>Saída</th>
                            </tr>
                            </thead>
                            <tbody>

                            @foreach($registros as $registro)
                                <tr>
                                    <td>{{$registro->id}}</td>
                                    <td>{{$registro->registrosAnimal->nome}}</a></td>
                                    <td>{{$registro->registrosAnimal->raca}}</td>
                                    <td>{{$registro->tutorAnimal->nome}}</td>
                                    <td>{{$registro->getEntradaDataAttribute()}}</td>
                                    <td>{{$registro->getSaidaDataAttribute()}}</td>
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
