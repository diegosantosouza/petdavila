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
                        <li><a href="{{ route('service.index') }}">Serviços</a></li>
                    </ul>
                </nav>

                <a href="{{ route('service.create') }}" class="btn btn-orange icon-user ml-1">Criar novo</a>
            </div>
        </header>

        @if(isset($services) && !empty($services))
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

                <div id="service">
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
                        @foreach($services as $service)
                            <tr>
                                <td>{{$service->id}}</td>
                                <td>{{$service->name}}</td>
                                <td>{{$service->description}}</td>
                                <td>{{$service->renew}}</td>
                                <td>{{$service->credit_days}}</td>
                                <td>{{$service->value}}</td>
                                <td>{{$service->status}}</td>
                                @if(\Illuminate\Support\Facades\Auth::user()->admin == 1)
                                    <td class="d-flex">
                                        <form action="{{ route('service.destroy', ['service'=>$service->id]) }}"
                                              method="post" class="">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="btn btn-red icon-trash"></button>
                                        </form>
                                        <a class="btn btn-green icon-pencil"
                                           href="{{ route('service.edit', ['service'=>$service->id]) }}"></a>
                                        <a class="btn btn-blue icon-search"></a>
                                    </td>
                                @endif
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        @endif
    </section>

@endsection
