@extends('admin.master.master')

@section('content')
    <section class="dash_content_app">

        <header class="dash_content_app_header">
            <h2 class="icon-user">Finance</h2>

            <div class="dash_content_app_header_actions">
                <nav class="dash_content_app_breadcrumb">
                    <ul>
                        <li><a href="{{ route('admin') }}">Início</a></li>
                        <li class="separator icon-angle-right icon-notext"></li>
                        <li><a href="{{ route('finance.index') }}">Finance</a></li>
                    </ul>
                </nav>
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
            <div class="nav">

                <ul class="nav_tabs">
                    <li class="nav_tabs_item">
                        <a href="#purchase" class="nav_tabs_item_link active">Compras</a>
                    </li>
                </ul>

                <div class="nav_tabs_content">
                    <div id="purchase">
                        <table id="dataTable" class="nowrap stripe" width="100" style="width: 100% !important;">
                            <thead>
                            <tr>
                                <th>ID</th>
                                <th>Animal</th>
                                <th>Raça</th>
                                <th>Tutor</th>
                                <th>Entrada</th>
                                <th>Saída</th>
                                <th>Day</th>
                                <th>Night</th>
                                <th>Fds</th>
                                <th>Obs.</th>
                                @if(\Illuminate\Support\Facades\Auth::user()->admin == 1)
                                    <th></th>
                                @endif
                            </tr>
                            </thead>
                            <tbody>

                                <tr>
                                    <td>table</td>
                                </tr>

                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </section>
    
@endsection
