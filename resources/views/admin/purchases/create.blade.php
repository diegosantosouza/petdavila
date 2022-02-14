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
                        <li><a href="{{ route('finance.purchase') }}">Vendas</a></li>
                        <li class="separator icon-angle-right icon-notext"></li>
                        <li><a href="{{ route('purchases.create') }}">Novo Serviço</a></li>
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
                        <a href="#tutor" class="nav_tabs_item_link active">Dados da Venda</a>
                    </li>
                </ul>

                <form class="app_form" action="{{ route('purchases.store') }}" method="post"
                      enctype="multipart/form-data">
                    @csrf
                    <div class="nav_tabs_content">
                        <div id="tutor">

                            <div class="label_g2">
                                <label class="label">
                                    <span class="legend">*Tutor:</span>
                                    <input type="text" class="label" name="tutorSearch" id="tutorSearch" placeholder="Nome do Tutor"/>
                                </label>
                                <input type="hidden" name="tutor_id" id="tutor_id" value="{{ old('tutor_id') }}">

                                <label class="label">
                                    <span class="legend">Pagamento:</span>
                                    <select id="status" name="status">
                                        <option value="notPaid">Nao Pago</option>
                                        <option value="paid">Pago</option>
                                    </select>
                                </label>
                            </div>

                            <div class="label_g4">
                                <label class="label">
                                    <span class="legend">Serviço:</span>
                                    <input type="text" class="label" name="servicesSearch" id="servicesSearch" placeholder="Nome do Serviço"/>
                                </label>
                                <label class="label">
                                    <span class="legend">Preço:</span>
                                    <input type="text"  class="mask-money" name="price" id="price" disabled/>
                                </label>
                                <input type="hidden" name="service_id" id="service_id" value="{{ old('service_id') }}">

                                <label class="label">
                                    <span class="legend">Desconto:</span>
                                    <input type="text" name="discount" class="mask-money" placeholder="Desconto do serviço"
                                           value="{{ old('discount') }}"/>
                                </label>
                                <label class="label">
                                    <span class="legend">Total:</span>
                                    <input type="text" name="discount" class="mask-money" placeholder="Preço final"
                                           value="{{ old('discount') }}" disabled/>
                                </label>
                            </div>

                            <div class="row mx-1">
                                <label class="label">
                                    <span class="legend">Anotaçoes:</span>
                                    <textarea class="label" rows="2" name="notes" >{{ old('notes')}}</textarea>
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

@section('js')
    <script src="{{ url(asset('backend/assets/js/jquery-ui.min.js')) }}"></script>
    <script>
        $(document).ready(function () {
            var _token = $('input[name="_token"]').val();

            $('#tutorSearch').autocomplete({
                minLength: 3,
                delay: 500,
                source: function (request, response) {
                    $.ajax({
                        url: "{{route('tutores.search')}}",
                        type: 'post',
                        dataType: "json",
                        data: {
                            _token: _token,
                            tutorSearch: request.term
                        },
                        success: function (data) {
                            response(data);
                        }
                    });
                },
                select: function (event, ui) {
                    $('#tutor_id').val(ui.item.value);
                    $(this).val(ui.item.label);
                    return false;
                }
            });
            $('#servicesSearch').autocomplete({
                minLength: 3,
                delay: 500,
                source: function (request, response) {
                    $.ajax({
                        url: "{{route('service.search')}}",
                        type: 'post',
                        dataType: "json",
                        data: {
                            _token: _token,
                            servicesSearch: request.term
                        },
                        success: function (data) {
                            response(data);
                        }
                    });
                },
                select: function (event, ui) {
                    $('#service_id').val(ui.item.value);
                    $(this).val(ui.item.label);
                    return false;
                }
            });
        });
    </script>
@endsection
