@extends('admin.master.master')

@section('content')
    <div style="flex-basis: 100%;">
        <section class="dash_content_app">

            <header class="dash_content_app_header">
                <h2 class="icon-search">Filtro</h2>

                <div class="dash_content_app_header_actions">
                    <nav class="dash_content_app_breadcrumb">
                        <ul>
                            <li><a href="{{ route('admin') }}">Início</a></li>
                            <li class="separator icon-angle-right icon-notext"></li>
                            <li><a href="{{ route('tutores.index') }}" class="text-orange">Tutor</a></li>
                        </ul>
                    </nav>

                    <a href="{{ route('tutores.create') }}" class="btn btn-orange icon-user ml-1">Criar novo</a>
                </div>
            </header>

            @if(!empty($donos))

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
                                <th>ID</th>
                                <th>Nome</th>
                                <th>Telefone</th>
                                <th>CPF</th>
                                <th></th>
                            </tr>
                            </thead>
                            <tbody>

                            @foreach($donos as $dono)
                                <tr>
                                    <td>{{$dono->id}}</td>
                                    <td>{{$dono->nome}}</a></td>
                                    <td class="mask-cell">{{$dono->telefone}}</td>
                                    <td class="mask-doc">{{$dono->cpf}}</td>
                                    <td class="text-right">
                                        <a class="btn btn-blue icon-eye"
                                           href="{{ route('tutores.show', ['tutore'=>$dono->id]) }}"></a>
                                        <a class="btn btn-green icon-pencil"
                                           href="{{ route('tutores.edit', ['tutore'=>$dono->id]) }}"></a>
                                        <button type="button" id="myModal" class="btn btn-orange icon-plus"
                                                data-toggle="modal" data-target="#adicionarModal{{$dono->id}}">
                                        </button>
                                    </td>
                                </tr>
                            @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            @endif
        </section>
    </div>
    @foreach($donos as $dono)
        <!-- Modal -->
        <div class="modal fade" id="adicionarModal{{$dono->id}}" tabindex="-1" aria-labelledby="adicionarModalLabel"
             aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h2 class="modal-title" id="adicionarModalLabel">Adicionar Animal</h2>
                        <button type="button" class="btn btn-red icon-times icon-notext search_close"
                                data-dismiss="modal"
                                aria-label="Close">
                            <span aria-hidden="true"></span>
                        </button>
                    </div>
                    <div class="modal-body" align="center">
                        <form class="app_form" action="{{ route('animais.store') }}" method="post"
                              enctype="multipart/form-data">
                            @csrf
                            @method('POST')
                            <input type="hidden" class="mb-1" type="text" name="donos_id" placeholder=""
                                   value="{{$dono->id ?? old('donos_id') }}"/>

                            <span>Nome do Animal:</span>
                            <input class="mb-1" type="text" name="nome" placeholder=""
                                   value="{{ old('nome') }}"/>
                            <span>Raça:</span>
                            <input class="mb-1" type="text" name="raca" placeholder=""
                                   value="{{old('raca') }}"/>
                            <span>Foto</span>
                            <input type="file" name="foto" value="{{ old('foto') }}">
                            <button type="submit" class="mt-1 btn btn-green icon-plus">Salvar</button>
                        </form>
                    </div>
                    <div class="modal-footer">
                    </div>
                </div>
            </div>
        </div>
    @endforeach
@endsection
