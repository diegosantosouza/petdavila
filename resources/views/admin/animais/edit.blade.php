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

                <ul class="nav_tabs">
                    <li class="nav_tabs_item">
                        <a href="#tutor" class="nav_tabs_item_link active">Dados do Tutor</a>
                    </li>
                </ul>

                <form class="app_form" action="{{ route('animais.update', ['animai'=> $animal->id]) }}" method="post"
                      enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="nav_tabs_content">
                        <div id="tutor">
                            <div class="label_g2">
                                <label class="label">
                                    <span class="legend">*Nome:</span>
                                    <input type="text" name="nome" value="{{ old('nome') ?? $animal->nome }}"/>
                                </label>

                                <label class="label">
                                    <span>Categoria:</span>
                                    <select name="categoria_id" class="select2">
                                        @foreach($categorias as $categoria)
                                            @if(empty($animal->categoriaAnimal->id))
                                                <option
                                                    value="{{$categoria->id}}" {{ (old('categoria_id') == $categoria->id ? 'selected' :  '') }}>
                                                    {{$categoria->categoria}}
                                                </option>
                                            @else
                                            <option
                                                value="{{$categoria->id}}" {{ (old('categoria_id') == $categoria->id ? 'selected' : ($animal->categoriaAnimal->id == $categoria->id ? 'selected' : '')) }}>
                                                {{$categoria->categoria}}
                                            </option>
                                            @endif
                                        @endforeach
                                    </select>
                                </label>
                            </div>

                            <div class="label_g2">
                                <label class="label">
                                    <span class="legend">*Raça:</span>
                                    <input type="text" name="raca" placeholder="Raça"
                                           value="{{ old('raca') ?? $animal->raca }}"/>
                                </label>

                                <div class="card mx-auto">
                                    <img class="dash_sidebar_user_thumb" alt="foto"
                                         src="{{url(asset($animal->url_foto))}}">
                                    <div class="card-body">
                                        <label class="label">
                                            <span class="legend">Foto</span>
                                            <input type="file" name="foto"
                                                   value="{{ old('foto') ?? $animal->foto }}">
                                        </label>
                                    </div>
                                </div>
                            </div>

                        </div>
                    </div>

                    <div class="text-right mt-2">
                        <button class="btn btn-large btn-green icon-check-square-o" type="submit">Salvar Alterações
                        </button>
                        <button type="button" id="myModal" class="btn btn-large btn-red icon-trash"
                                data-toggle="modal"
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
                    <form action="{{route('animais.destroy', ['animai'=>$animal->id])}}" method="post" class="">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-red icon-trash">Deletar</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
@endsection
