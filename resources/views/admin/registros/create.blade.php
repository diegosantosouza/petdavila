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
                    <form class="app_form" action="{{ route('registros.store') }}" method="post"
                          enctype="multipart/form-data">
                        @csrf

                        <div class="nav_tabs_content">
                            <label class="label">
                                <span class="legend">*ID do Animal:</span>
                                <input type="text" id="entrada" name="animal_id" placeholder="ID" value=""/>
                            </label>
                        </div>

                        <div class="text-right mt-2">
                            <button class="btn btn-large btn-green icon-check-square-o" type="submit">Entrada
                            </button>
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
                                        <input type="text" name="tutor" value="{{ session()->get('animal.donosAnimal.nome')}}"/>
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
                                    <td>{{$registro->registrosAnimal->id}}</td>
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

@section('js')
    <script>
        $(document).ready(function () {
            document.getElementById("entrada").focus();
        });
    </script>

@endsection
