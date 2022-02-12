@extends('admin.master.master')

@section('content')
    <section class="dash_content_app">

        <header class="dash_content_app_header">
            <h2 class="icon-credit-card">Vendas</h2>

            <div class="dash_content_app_header_actions">
                <nav class="dash_content_app_breadcrumb">
                    <ul>
                        <li><a href="{{ route('admin') }}">Início</a></li>
                        <li class="separator icon-angle-right icon-notext"></li>
                        <li><a href="{{ route('finance.index') }}">Financeiro</a></li>
                        <li class="separator icon-angle-right icon-notext"></li>
                        <li><a href="{{ route('finance.purchase') }}">Vendas</a></li>
                    </ul>
                </nav>
                <a href="{{ route('purchases.create') }}" class="btn btn-orange icon-user ml-1">Criar novo</a>
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
                        <th>Data</th>
                        <th>Serviço</th>
                        <th>Tutor</th>
                        <th>Valor</th>
                        <th>Status</th>
                        @if(\Illuminate\Support\Facades\Auth::user()->admin == 1)
                            <th></th>
                        @endif
                    </tr>
                    </thead>
                    <tbody>

                        <tr>
                            <td>ID</td>
                            <td>Data</td>
                            <td>Serviço</td>
                            <td>Tutor</td>
                            <td>Valor</td>
                            <td>Status</td>
                            @if(\Illuminate\Support\Facades\Auth::user()->admin == 1)
                                <td class="text-right">
                                    <a class="btn btn-red icon-trash"></a>
                                    <a class="btn btn-green icon-pencil"></a>
                                </td>
                            @endif
                        </tr>

                    </tbody>
                </table>
            </div>
        </div>
    </section>

@endsection
