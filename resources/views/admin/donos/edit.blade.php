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
                        <a href="#tutor" class="nav_tabs_item_link active">Dados do Tutor</a>
                    </li>
                    <li class="nav_tabs_item">
                        <a href="#financeiro" class="nav_tabs_item_link">Financeiro</a>
                    </li>
                </ul>

                <form class="app_form" action="{{ route('tutores.update', ['tutore'=> $tutore->id]) }}" method="post"
                      enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="nav_tabs_content">
                        <div id="tutor">

                            <label class="label">
                                <span class="legend">*Nome:</span>
                                <input type="text" name="nome" value="{{ old('nome') ?? $tutore->nome }}"/>
                            </label>


                            <div class="label_g2">
                                <label class="label">
                                    <span class="legend">*Celular:</span>
                                    <input type="tel" name="telefone" class="mask-cell"
                                           placeholder="Número do Telefone com DDD"
                                           value="{{ old('telefone') ?? $tutore->telefone }}"/>
                                </label>

                                <label class="label">
                                    <span class="legend">*CPF:</span>
                                    <input type="tel" class="mask-doc" name="cpf"
                                           value="{{ old('cpf') ?? $tutore->cpf }}"/>
                                </label>
                            </div>

                        </div>

                        <div id="financeiro" class="d-none">
                            <div class="text-center mb-1">
                                <button type="button" id="myModalAdicionar"
                                        class="btn btn-large btn-orange icon-plus-circle" data-toggle="modal"
                                        data-target="#adicionar">Novo Registro
                                </button>
                                <a href="{{route('financeiro.show',['id'=>$tutore->id])}}">
                                    <button type="button" id="historico"
                                            class="btn btn-large btn-blue icon-eye">Histórico
                                    </button>
                                </a>

                            </div>

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
                                @if(!empty($registros))
                                    @foreach($registros as $financeiro)
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

                    <div class="text-right mt-2">
                        <button class="btn btn-large btn-green icon-check-square-o" type="submit">Salvar Alterações
                        </button>
                        <button type="button" id="myModal" class="btn btn-large btn-red icon-trash" data-toggle="modal"
                                data-target="#deleteModal">Deletar
                        </button>
                    </div>
                </form>
            </div>
        </div>
    </section>
    <!-- Modal -->
    <div class="modal fade" id="deleteModal" tabindex="-1" aria-labelledby="deleteModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h2 class="modal-title" id="deleteModalLabel">Deletar</h2>
                    <button type="button" class="btn btn-red icon-times icon-notext search_close" data-dismiss="modal"
                            aria-label="Close">
                        <span aria-hidden="true"></span>
                    </button>
                </div>
                <div class="modal-body">
                    <p class="text-center">Tem certeza que deseja excluir?</p>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-yellow" data-dismiss="modal">Cancelar</button>
                    <form action="{{route('tutores.destroy', ['tutore'=>$tutore->id])}}" method="post" class="">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-red icon-trash">Deletar</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <!-- Modal Adicionar -->
    <div class="modal fade" id="adicionar" tabindex="-1" aria-labelledby="adicionarLabel"
         aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h2 class="modal-title" id="adicionarLabel">Adicionar/Subtrair</h2>
                    <button type="button" class="btn btn-red icon-times icon-notext search_close"
                            data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true"></span>
                    </button>
                </div>
                <div class="modal-body" align="center">
                    <form class="app_form" action="{{ route('financeiro.store') }}" method="post"
                          enctype="multipart/form-data">
                        @csrf
                        @method('POST')
                        <input type="hidden" class="mb-1" type="text" name="donos_id" placeholder=""
                               value="{{$tutore->id}}"/>
                        <span>Serviço:</span>

                        <input class="mb-1" type="text" name="servico" placeholder="descrição"
                               value="{{ old('servico') }}"/>

                        <div class="label_g2">
                            <label class="label">
                                <span class="legend">Operação:</span>
                                <select name="operador" class="select2">
                                    <option value="+">Adicionar</option>
                                    <option value="-">Subtrair</option>
                                </select>
                            </label>

                            <label class="label">
                                <span class="legend">Valor:</span>
                                <input type="tel" class="mask-money" name="valor"
                                       value="{{ old('valor') }}"/>
                            </label>
                        </div>
                        <button type="submit" class="mt-1 btn btn-green icon-plus">Salvar</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
