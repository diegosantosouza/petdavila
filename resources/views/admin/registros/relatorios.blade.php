@extends('admin.master.master')

@section('content')
    <section class="dash_content_app">

        <header class="dash_content_app_header">
            <h2 class="icon-search">Relatórios</h2>

            <div class="dash_content_app_header_actions">
                <nav class="dash_content_app_breadcrumb">
                    <ul>
                        <li><a href="{{ route('admin') }}">Início</a></li>
                        <li class="separator icon-angle-right icon-notext"></li>
                        <li><a href="{{ route('registros.relatorios') }}" class="text-orange">Relatórios</a></li>
                    </ul>
                </nav>

            </div>
        </header>

        <div class="dash_content_app_box">
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
            <div class="dash_content_app_box">
                <section class="app_dash_home_stats">
                    <article class="control radius">
                        <h4 class="">Mês</h4>
                        <form class="app_form" action="{{route('registros.gerar')}}" method="post"
                              enctype="multipart/form-data">
                            @csrf
                            <div class="info">

                                <label class="label">
                                    <select name="mes" class="select2">
                                        @for($i=1; $i<=12; $i++)
                                            <option
                                                value="{{$i}}" {{ (old('ordenacao') == $i ? 'selected' : '') }}>{{$i}}
                                            </option>
                                        @endfor
                                    </select>
                                </label>
                            </div>

                            <div class="actions text-center">
                                <button class="icon-cog btn btn-orange" type="submit">Gerar</button>
                            </div>
                        </form>
                    </article>

                    <article class="blog radius">
                        <h4 class="">Ano</h4>
                        <form class="app_form" action="{{route('registros.gerar')}}" method="post"
                              enctype="multipart/form-data">
                            @csrf
                            <div class="info">

                                <label class="label">
                                    <input type="text" name="ano" class=""
                                           value="{{ old('ano') }}"/>
                                </label>
                            </div>

                            <div class="actions text-center">
                                <button class="icon-cog btn btn-orange" type="submit">Gerar</button>
                            </div>
                        </form>
                    </article>

                    <article class="users radius">
                        <h4 class="">Período</h4>
                        <form class="app_form" action="{{route('registros.gerar')}}" method="post"
                              enctype="multipart/form-data">
                            @csrf
                            <div class="label_g2">
                                <label class="label">
                                    <span class="legend">*Início:</span>
                                    <input type="tel" name="data_inicio" class="mask-date" placeholder="00/00/00"
                                           value="{{ old('data_inicio') }}"/>
                                </label>

                                <label class="label">
                                    <span class="legend">*Término:</span>
                                    <input type="tel" name="data_termino" class="mask-date" placeholder="00/00/00"
                                           value="{{ old('data_termino') }}"/>
                                </label>
                            </div>

                            <div class="actions text-center">
                                <button class="icon-cog btn btn-orange" type="submit">Gerar</button>
                            </div>
                        </form>
                    </article>
                </section>
            </div>
        </div>

        @if(!empty($buscas))
            <div class="dash_content_app_box">
                <div class="dash_content_app_box_stage">
                    <h2>Relatório
                        @if(!empty($mes))<h3>{{$mes}}/{{date('Y')}}</h3>
                        @elseif(!empty($ano))<h3>{{$ano}}</h3>
                        @else<h3>{{'('.$inicio . ' - ' . $termino.')'}}</h3>
                        @endif</h2>
                    <h4 class="text-orange">Registros: {{$buscas->count()}}</h4>
                    <table id="dataTable" class="nowrap stripe" width="100" style="width: 100% !important;">
                        <thead>
                        <tr>
                            <th>Registro</th>
                            <th>ID Animal</th>
                            <th>Nome</th>
                            <th>Raça</th>
                            <th>Tutor</th>
                            <th>Entrada</th>
                            <th>Saida</th>
                        </tr>
                        </thead>
                        <tbody>

                        @foreach($buscas as $busca)
                            <tr>
                                <td>{{$busca->id}}</td>
                                <td>{{$busca->registrosAnimal->id}}</td>
                                <td>{{$busca->registrosAnimal->nome}}</td>
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
@endsection

