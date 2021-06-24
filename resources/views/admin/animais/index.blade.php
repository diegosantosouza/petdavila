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
                            <li><a href="{{ route('animais.index') }}" class="text-orange">Animais</a></li>
                        </ul>
                    </nav>
                </div>
            </header>

            @if(!empty($animais))

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
                                <th>Raça</th>
                                <th>Tutor</th>
                                <th>Categoria</th>
                                <th></th>
                            </tr>
                            </thead>
                            <tbody>

                            @foreach($animais as $animal)
                                <tr>
                                    <td>{{$animal->id}}</td>
                                    <td>{{$animal->nome}}</a></td>
                                    <td>{{$animal->raca}}</td>
                                    <td>{{$animal->donosAnimal->nome}}</td>
                                    <td>@if(!empty($animal->categoriaAnimal->categoria)){{$animal->categoriaAnimal->categoria}}@endif</td>
                                    <td class="text-right">
                                        <a class="btn btn-blue icon-eye"
                                           href="{{ route('animais.show', ['animai'=>$animal->id]) }}"></a>
                                        <a class="btn btn-green icon-pencil"
                                           href="{{ route('animais.edit', ['animai'=>$animal->id]) }}"></a>
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
@endsection
