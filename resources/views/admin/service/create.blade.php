@extends('admin.master.master')

@section('content')
    <section class="dash_content_app">

        <header class="dash_content_app_header">
            <h2 class="icon-user-plus">Novo Serviço</h2>

            <div class="dash_content_app_header_actions">
                <nav class="dash_content_app_breadcrumb">
                    <ul>
                        <li><a href="{{ route('admin') }}">Início</a></li>
                        <li class="separator icon-angle-right icon-notext"></li>
                        <li><a href="{{ route('finance.index') }}">Financeiro</a></li>
                        <li class="separator icon-angle-right icon-notext"></li>
                        <li><a href="{{ route('service.index') }}">Serviços</a></li>
                        <li class="separator icon-angle-right icon-notext"></li>
                        <li><a href="{{ route('service.create') }}">Novo Serviço</a></li>
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
                        <a href="#tutor" class="nav_tabs_item_link active">Dados do Serviço</a>
                    </li>
                </ul>

                <form class="app_form" action="{{ route('service.store') }}" method="post"
                      enctype="multipart/form-data">
                    @csrf

                    <div class="nav_tabs_content">
                        <div id="tutor">

                            <div class="label_g2">
                                <label class="label">
                                    <span class="legend">*Nome:</span>
                                    <input type="text" name="name" placeholder="Nome do serviço"
                                           value="{{ old('name')  }}"/>
                                </label>

                                <label class="label">
                                    <span class="legend">Status:</span>
                                    <select id="status" name="status">
                                        <option value="active" selected >Ativo</option>
                                        <option value="inactive">Inativo</option>
                                        <option value="expired">Expirado</option>
                                    </select>
                                </label>
                            </div>

                            <div class="label_g2">
                                <label class="label">
                                    <span class="legend">Descrição:</span>
                                    <input type="text" name="description" placeholder="Descrição do serviço"
                                           value="{{ old('description')  }}"/>
                                </label>

                                <label class="label">
                                    <span class="legend">*Preço:</span>
                                    <input type="number" min="0.00" max="10000.00" step="0.01" name="price" placeholder="Preço do serviço"
                                           value="{{ old('price')  }}"/>
                                </label>
                            </div>
                        
                            <div class="label_g2">
                                <label class="label">
                                    <span class="legend">Recorrência:</span>
                                    <input type="number" placeholder=0 class="mask-doc" name="renew" placeholder="Repete em quantos dias"
                                           value="{{ old('renew') }}"/>
                                </label>

                                <label class="label">
                                    <span class="legend">Crédito em diárias:</span>
                                    <input type="number" class="mask-doc" name="credit_days" placeholder="Número de diárias"
                                           value="{{ old('credit_days') }}"/>
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
@endsection
