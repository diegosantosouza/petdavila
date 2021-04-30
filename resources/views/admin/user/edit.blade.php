@extends('admin.master.master')

@section('content')
<section class="dash_content_app">

    <header class="dash_content_app_header">
        <h2 class="icon-user">{{ $user->name }}</h2>

        <div class="dash_content_app_header_actions">
            <nav class="dash_content_app_breadcrumb">
                <ul>
                    <li><a href="{{ route('admin') }}">Dashboard</a></li>
                    <li class="separator icon-angle-right icon-notext"></li>
                    <li><a href="{{ route('users.edit', ['user'=> $user->id]) }}">User</a></li>

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
                    <a href="#user" class="nav_tabs_item_link active">Dados do Usuário</a>
                </li>

            </ul>

            <form class="app_form" action="{{ route('users.update', ['user'=> $user->id]) }}" method="post" enctype="multipart/form-data">
                @csrf
                @method('PUT')
                <div class="nav_tabs_content">
                    <div id="user">

                        <label class="label">
                            <span class="legend">*Nome:</span>
                            <input type="text" name="name" value="{{ old('name') ?? $user->name }}" />
                        </label>



                        <div class="label_g2">
                            <label class="label">
                                <span class="legend">*Crmv:</span>
                                <input type="text" name="crmv" value="{{ old('crmv') ?? $user->crmv }}" />
                            </label>

                            <label class="label">
                                <span class="legend">*E-mail:</span>
                                <input type="email" name="email" value="{{ old('email') ?? $user->email }}" />
                            </label>
                        </div>

                        <div class="label_g2">
                            <label class="label">
                                <span class="legend">*Foto:</span>
                                <input type="file" name="foto" value="{{ old('foto') ?? $user->foto }}" />
                            </label>


                        </div>

                    </div>
                </div>

                <div class="text-right mt-2">
                    <button class="btn btn-large btn-green icon-check-square-o" type="submit">Editar</button>
                </div>

            </form>
        </div>
    </div>
</section>
@endsection
