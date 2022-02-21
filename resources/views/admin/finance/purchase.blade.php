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
                        <th>desconto</th>
                        <th>total</th>
                        <th>Status</th>
                        @if(\Illuminate\Support\Facades\Auth::user()->admin == 1)
                            <th></th>
                        @endif
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($purchases as $purchase)
                        <tr>
                            <td>{{$purchase->id}}</td>
                            <td>{{$purchase->created_at}}</td>
                            <td>{{$purchase->servicePurchase->name}}</td>
                            <td>{{$purchase->tutor->nome}}</td>
                            <td class="mask-money">{{$purchase->pricePurchase->last()->value}}</td>
                            <td class="mask-money">{{$purchase->discount}}</td>
                            <td>{{$purchase->pricePurchase->last()->value - $purchase->discount}}</td>
                            <td>{{$purchase->status == 'paid' ? 'Pago' : 'Pendente'}}</td>
{{--                            @if(\Illuminate\Support\Facades\Auth::user()->admin == 1)--}}
                                <td class="d-flex">
                                    <form action="{{ route('purchases.destroy', ['purchase'=>$purchase->id]) }}"
                                          method="post" class="confirm">
                                        @csrf
                                        @method('DELETE')
                                        <button type="submit" class="btn btn-red icon-trash"></button>
                                    </form>
                                    <a class="btn btn-green icon-pencil"
                                       href="{{ route('purchases.edit', ['purchase'=>$purchase->id]) }}"></a>
                                </td>
{{--                            @endif--}}
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </section>

@endsection
@section('js')
    <script>
        $(document).ready(function () {
            $('.confirm').on('submit', function () {
                var $this = $(this);
                swal({
                    title: "Tem certeza?",
                    text: "Uma vez excluído, você não poderá recuperar este registro!",
                    icon: "warning",
                    buttons: true,
                    dangerMode: true,
                })
                    .then((willDelete) => {
                        if (willDelete) {
                            $this.off('submit').submit();
                        }
                    });
                return false;
            });
        });
    </script>
@endsection
