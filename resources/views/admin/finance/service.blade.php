@extends('admin.master.master')

@section('content')
    <section class="dash_content_app">

        <header class="dash_content_app_header">
            <h2 class="icon-archive">Serviços</h2>

            <div class="dash_content_app_header_actions">
                <nav class="dash_content_app_breadcrumb">
                    <ul>
                        <li><a href="{{ route('admin') }}">Início</a></li>
                        <li class="separator icon-angle-right icon-notext"></li>
                        <li><a href="{{ route('finance.index') }}">Financeiro</a></li>
                        <li class="separator icon-angle-right icon-notext"></li>
                        <li><a href="{{ route('finance.service') }}">Serviços</a></li>
                    </ul>
                </nav>

                <a href="{{ route('finance.create') }}" class="btn btn-orange icon-user ml-1">Criar novo</a>
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

            <div id="purchase">
                <table id="dataTable" class="nowrap stripe" width="100" style="width: 100% !important;">
                    <thead>
                    <tr>
                        <th>ID</th>
                        <th>Nome</th>
                        <th>Descrição</th>
                        <th>Recorrência em dias</th>
                        <th>Diárias</th>
                        <th>Preço atual</th>
                        <th>Status</th>
                        @if(\Illuminate\Support\Facades\Auth::user()->admin == 1)
                            <th></th>
                        @endif
                    </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td>ID</td>
                            <td>Nome</td>
                            <td>Descrição</td>
                            <td>Recorrência em dias</td>
                            <td>Diárias</td>
                            <td>Preço atual</td>
                            <td>Status</td>
                                @if(\Illuminate\Support\Facades\Auth::user()->admin == 1)
                                    <td class="text-right">
                                        <a class="btn btn-red icon-trash"></a>
                                        <a class="btn btn-green icon-pencil"></a>
                                        <a class="btn btn-blue icon-search"></a>
                                    </td>
                                @endif
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </section>
    
@endsection
