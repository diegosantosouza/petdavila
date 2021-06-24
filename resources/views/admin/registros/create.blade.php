@extends('admin.master.master')

@section('content')
    <div style="flex-basis: 100%;">
        <section class="dash_content_app">

            <header class="dash_content_app_header">
                <h2 class="icon-search">Entrada</h2>

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
                                <a href="#mensalista" id="id_mensal" class="nav_tabs_item_link active click">Animal</a>
                            </li>
                        </ul>

                        <form class="app_form" action="{{ route('registros.store') }}" method="post"
                              enctype="multipart/form-data">
                            @csrf

                            <div class="nav_tabs_content">
                                <div id="mensalista">
                                    <label class="label">
                                        <span class="legend">*ID do Animal:</span>
                                        <input type="text" id="entrada" name="animal_id" placeholder="ID" value=""/>
                                    </label>
                                    <div class="text-right mt-2">
                                        <button class="btn btn-large btn-green icon-check-square-o" type="submit">Entrada
                                        </button>
                                    </div>
                                </div>
                            </div>
                        </form>

                </div>
            </div>

            @if(session()->exists('animal'))
                <div class="dash_content_app_box">
                    <div class="dash_content_app_box_stage">
                        <form class="app_form" enctype="multipart/form-data">
                            <div class="nav_tabs_content">
                                <div class="label_g2">
                                    <label class="label">
                                        <span class="legend">*Nome:</span>
                                        <input type="text" name="nome" value="{{session()->get('animal.nome') }}"/>
                                    </label>

                                    <label class="label">
                                        <span class="legend">Tutor:</span>
                                        <input type="text" name="tutor"
                                               value="{{ session()->get('animal.donosAnimal.nome')}}"/>
                                    </label>
                                </div>
                                <div class="label_g2">
                                    <label class="label">
                                        <span class="legend">*Raça:</span>
                                        <input type="text" name="raca" placeholder="Raça"
                                               value="{{session()->get( 'animal.raca') }}"/>
                                    </label>

                                    <div class="card mx-auto">
                                        <img class="dash_sidebar_user_thumb" alt="foto"
                                             src="{{session()->get('animal.url_foto') }}">
                                    </div>
                                </div>
                            </div>
                        </form>
                    </div>
                </div>
            @endif


            @if(!empty($reg))

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
                                <th>Categoria</th>
                                <th>Day</th>
                                <th>Night</th>
                                <th>Fds</th>
                                <th>Obs.</th>
                            </tr>
                            </thead>
                            <tbody>

                            @foreach($reg as $registro)
                                <tr>
                                    <td>{{$registro->registrosAnimal->id}}</td>
                                    <td>{{$registro->registrosAnimal->nome}}</a></td>
                                    <td>{{$registro->registrosAnimal->raca}}</td>
                                    <td>{{$registro->tutorAnimal->nome}}</td>
                                    <td>{{$registro->getEntradaDataAttribute()}}</td>
                                    <td>{{$registro->getSaidaDataAttribute()}}</td>
                                    <td>@if(!empty($registro->registrosAnimal->categoriaAnimal->categoria)){{$registro->registrosAnimal->categoriaAnimal->categoria}}@endif</td>
                                    <td>{{$registro->daycare}}</td>
                                    <td>{{$registro->nightcare}}</td>
                                    <td>{{$registro->fds}}</td>
                                    <td class="text-right">
                                        <button type="button" id="myModal" class="btn btn-green icon-pencil"
                                                data-toggle="modal" data-target="#editarModal{{$registro->id}}">
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
    @foreach($reg as $registro)
        <!-- Modal -->
        <div class="modal fade" id="editarModal{{$registro->id}}" tabindex="-1" aria-labelledby="editarModalLabel"
             aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h2 class="modal-title" id="editarModalLabel">Observação</h2>
                        <button type="button" class="btn btn-red icon-times icon-notext search_close"
                                data-dismiss="modal"
                                aria-label="Close">
                            <span aria-hidden="true"></span>
                        </button>
                    </div>
                    <div class="modal-body" align="center">
                        <form class="app_form" action="{{ route('registros.update', ['registro'=>$registro->id]) }}"
                              method="post"
                              enctype="multipart/form-data">
                            @csrf
                            @method('PUT')
                            <span>Descrição:</span>
                            <textarea class="mb-1" name="observacoes" placeholder="" rows="4"
                                      value="{{ old('observacoes') }}">{{$registro->observacoes}}</textarea>
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

@section('js')
    <script>
        $(document).ready(function () {
            document.getElementById("entrada").focus();
        });
    </script>

@endsection
