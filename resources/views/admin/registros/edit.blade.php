@extends('admin.master.master')

@section('content')
    <div style="flex-basis: 100%;">
        <section class="dash_content_app">

            <header class="dash_content_app_header">
                <h2 class="icon-cog">Editar</h2>

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
                            <a href="#registro" id="registro" class="nav_tabs_item_link active click">Registro</a>
                        </li>
                    </ul>

                    <form class="app_form" action="{{ route('registros.update', ['registro'=>$registro->id]) }}"
                          method="post"
                          enctype="multipart/form-data">
                        @csrf
                        @method('PUT')

                        <div class="nav_tabs_content">
                            <div id="edit_registro">
                                <div class="label_g2">
                                    <label class="label">
                                        <span class="legend">*Id do Registro:</span>
                                        <input type="text" name="id" value="{{$registro->id}}"/>
                                    </label>

                                    <label class="label">
                                        <span class="legend">Animal:</span>
                                        <input type="text" name="animal"
                                               value="{{$registro->registrosAnimal->nome}}"/>
                                    </label>
                                </div>
                                <div class="label_g2">

                                    <label class="label">
                                        <span class="legend">Entrada:</span>
                                        <input type="datetime-local" name="entrada" class=""
                                               placeholder="dd/mm/yyyy HH:mm"
                                               value="{{date('Y-m-d\TH:i:s', strtotime($registro->entrada))}}"/>
                                    </label>

                                    <label class="label">
                                        <span class="legend">Saida:</span>
                                        <input type="datetime-local" name="saida" class=""
                                               placeholder="dd/mm/yyyy HH:mm"
                                               @if(!empty($registro->saida))
                                                value="{{date('Y-m-d\TH:i:s', strtotime($registro->saida))}}"/>
                                               @endif
                                    </label>
                                </div>

                                <div class="label_g2">
                                    <label class="label">
                                        <span class="legend">Observações:</span>
                                        <input type="tel" name="observacoes" class=""
                                               value="{{$registro->observacoes}}"/>
                                    </label>
                                </div>
                            </div>
                        </div>
                        <div class="text-right mt-2">
                            <button class="btn btn-large btn-green icon-check-square-o" type="submit">Salvar Alterações
                            </button>
                        </div>
                    </form>
                </div>
            </div>
        </section>
    </div>
@endsection

