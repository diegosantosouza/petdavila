@extends('admin.master.master')

@section('content')
    <section class="dash_content_app">

        <header class="dash_content_app_header">
            <h2 class="icon-user">Animal : {{ $animal->nome }}</h2>

            <div class="dash_content_app_header_actions">
                <nav class="dash_content_app_breadcrumb">
                    <ul>
                        <li><a href="{{ route('admin') }}">Início</a></li>
                        <li class="separator icon-angle-right icon-notext"></li>
                        <li><a href="{{ route('animais.index') }}">Animais</a></li>
                    </ul>
                </nav>
                <button type="button" id="myModal" class="btn btn-orange icon-file" data-toggle="modal"
                        data-target="#relatoriosModal">Relatório
                </button>
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
            <div class="nav">

                <ul class="nav_tabs">
                    <li class="nav_tabs_item">
                        <a href="#tutor" class="nav_tabs_item_link active">Dados do Animal</a>
                    </li>
                </ul>

                <form class="app_form"
                      enctype="multipart/form-data">

                    <div class="nav_tabs_content">
                        <div id="tutor">
                            <div class="label_g2">
                                <label class="label">
                                    <span class="legend">*Nome:</span>
                                    <input type="text" name="nome" value="{{ $animal->nome }}"/>
                                </label>
                                <label class="label">
                                    <span>Categoria:</span>
                                    <input type="text" name="categoria_id"
                                           value="{{$animal->categoriaAnimal->categoria}}">
                                </label>
                            </div>

                            <div class="label_g2">
                                <label class="label">
                                    <span class="legend">*Raça:</span>
                                    <input type="text" name="raca" placeholder="Raça"
                                           value="{{ $animal->raca }}"/>
                                </label>


                                <div class="card mx-auto">
                                    <img class="dash_sidebar_user_thumb" alt="foto"
                                         src="{{url(asset($animal->url_foto))}}">
                                </div>
                            </div>

                        </div>
                    </div>
                </form>
            </div>
        </div>

        <h2 class="mt-1">Histórico ({{$animal->animalRegistros->count()}})</h2>

        <div class="dash_content_app_box">
            <div class="dash_content_app_box_stage">
                <table id="dataTable" class="nowrap stripe" width="100" style="width: 100% !important;">
                    <thead>
                    <tr>
                        <th>ID</th>
                        <th>Animal</th>
                        <th>Raça</th>
                        <th>Tutor</th>
                        <th>Entrada</th>
                        <th>Saída</th>
                        <th>Day</th>
                        <th>Night</th>
                        <th>Fds</th>
                        <th>Obs.</th>
                    </tr>
                    </thead>
                    <tbody>

                    @foreach($animal->animalRegistros as $registro)
                        <tr>
                            <td>{{$registro->id}}</td>
                            <td>{{$animal->nome}}</a></td>
                            <td>{{$animal->raca}}</td>
                            <td>{{$animal->donosAnimal->nome}}</td>
                            <td>{{$registro->getEntradaDataAttribute()}}</td>
                            <td>{{$registro->getSaidaDataAttribute()}}</td>
                            <td>{{$registro->daycare}}</td>
                            <td>{{$registro->nightcare}}</td>
                            <td>{{$registro->fds}}</td>
                            <td>@if(!empty($registro->observacoes)){{$registro->observacoes}}@endif</td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </section>
    <!-- Relatorios Modal -->
    <div class="modal fade" id="relatoriosModal" tabindex="-1" aria-labelledby="relatoriosModalLabel"
         aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h2 class="modal-title" id="relatoriosModalLabel">Relatórios</h2>
                    <button type="button" class="btn btn-red icon-times icon-notext search_close" data-dismiss="modal"
                            aria-label="Close">
                        <span aria-hidden="true"></span>
                    </button>
                </div>
                <div class="modal-body" align="center">
                    <h4 class="">Período</h4>
                    <form class="app_form" action="{{route('registros.relatoriosTutor')}}" method="post"
                          enctype="multipart/form-data">
                        @csrf
                        <input type="hidden" name="tutor_id" value="{{$animal->donosAnimal->id}}">
                        <input type="hidden" name="animal_id" value="{{$animal->id}}">
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
                </div>
                <div class="modal-footer">

                </div>
            </div>
        </div>
    </div>
@endsection
