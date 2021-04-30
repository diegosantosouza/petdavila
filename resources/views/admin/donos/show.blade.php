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
                        <li><a href="{{ route('tutores.index') }}">Tutor</a></li>
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
                        <a href="#tutor" class="nav_tabs_item_link active">Dados do Tutor</a>
                    </li>
                </ul>

                <form class="app_form" action="{{ route('tutores.edit', ['tutore'=> $tutore->id]) }}" method="post"
                      enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="nav_tabs_content">
                        <div id="tutor">

                            <label class="label">
                                <span class="legend">*Nome:</span>
                                <input type="text" name="nome" value="{{ $tutore->nome }}"/>
                            </label>


                            <div class="label_g2">
                                <label class="label">
                                    <span class="legend">*Celular:</span>
                                    <input type="tel" name="telefone" class="mask-cell"
                                           placeholder="Número do Telefone com DDD"
                                           value="{{ $tutore->telefone }}"/>
                                </label>

                                <label class="label">
                                    <span class="legend">*CPF:</span>
                                    <input type="tel" class="mask-doc" name="cpf"
                                           value="{{ $tutore->cpf }}"/>
                                </label>
                            </div>

                        </div>
                    </div>
                </form>
            </div>
        </div>

        <h2 class="mt-1">Animais</h2>

        <div class="dash_content_app_box">
            <div class="nav">
                <form class="app_form" enctype="multipart/form-data">
                    <div class="nav_tabs_content">
                        <div>

                            @if(!empty($tutore->animaisDono))
                                @foreach($tutore->animaisDono as $animal)
                                    <div class="realty_list">
                                        <div class="realty_list_item mb-1">

                                            <div class="realty_list_item_actions_stats">
                                                <img src="{{url(asset($animal->url_foto))}}">
                                            </div>

                                            <div class="realty_list_item_content">
                                                <h4>#{{$animal->nome}}</h4>

                                                <div class="realty_list_item_card">
                                                    <div class="realty_list_item_card_image">
                                                        <span class="icon-users"></span>
                                                    </div>
                                                    <div class="realty_list_item_card_content">
                                                        <span
                                                            class="realty_list_item_description_title">Raça:</span>
                                                        <span
                                                            class="realty_list_item_description_content">{{$animal->raca}}</span>
                                                    </div>
                                                </div>

                                                {{--                                                <div class="realty_list_item_card">--}}
                                                {{--                                                    <div class="realty_list_item_card_image">--}}
                                                {{--                                                        <span class="icon-file"></span>--}}
                                                {{--                                                    </div>--}}
                                                {{--                                                    <div class="realty_list_item_card_content">--}}
                                                {{--                                                        <span class="realty_list_item_description_title">:</span>--}}
                                                {{--                                                        <span class="realty_list_item_description_content"> </span>--}}
                                                {{--                                                    </div>--}}
                                                {{--                                                </div>--}}

                                                {{--                                                <div class="realty_list_item_card">--}}
                                                {{--                                                    <div class="realty_list_item_card_image">--}}
                                                {{--                                                        <span class="icon-phone"></span>--}}
                                                {{--                                                    </div>--}}
                                                {{--                                                    <div class="realty_list_item_card_content">--}}
                                                {{--                                                        <span class="realty_list_item_description_title">:</span>--}}
                                                {{--                                                        <span class="realty_list_item_description_content"></span>--}}
                                                {{--                                                    </div>--}}
                                                {{--                                                </div>--}}

                                                <div class="realty_list_item_card">
                                                    <div class="realty_list_item_card_image">
                                                        <span class="icon-calendar"></span>
                                                    </div>
                                                    <div class="realty_list_item_card_content">
                                                        <a href="{{ route('animais.show', ['animai'=>$animal->id]) }}"
                                                           class="btn btn-large btn-orange">Histórico</a>
                                                    </div>
                                                </div>

                                            </div>
                                        </div>
                                    </div>
                                @endforeach
                            @else
                                <div class="no-content">Não foram encontrados registros!</div>
                            @endif

                        </div>
                    </div>
                </form>
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
                        <input type="hidden" name="tutor_id" value="{{$tutore->id}}">
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
