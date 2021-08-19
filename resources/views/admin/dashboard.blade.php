@extends('admin.master.master')

@section('content')
    <div style="flex-basis: 100%;">
        <section class="dash_content_app">
            <header class="dash_content_app_header">
                <h2 class="icon-tachometer">Dashboard</h2>
            </header>
            <div class="dash_content_app_box">
                <section class="app_dash_home_stats">
                    <article class="control radius">
                        <h4 class="icon-home">Agora</h4>
                        <h1 class="text-center mt-2 mb-2">{{$agora}}</h1>
                    </article>

                    <article class="blog radius">
                        <h4 class="icon-history">Hoje</h4>
                        <h1 class="text-center mt-2 mb-2">{{$hoje}}</h1>
                    </article>

                    <article class="users radius">
                        <h4 class="icon-calendar">Este mês</h4>
                        <h1 class="text-center mt-2 mb-2">{{$mes}}</h1>
                    </article>

                    <article class="users radius mt-1">
                        <h4 class="">Registros</h4>
                        <canvas id="bar-chart"
                                style="min-height: 250px; height: 250px; max-height: 250px; max-width: 100%;"></canvas>
                    </article>

                </section>
            </div>
        </section>

        <section class="dash_content_app" style="margin-top: 40px;">
            <header class="dash_content_app_header">
                <h2 class="icon-bell-o">Últimas entradas</h2>
            </header>
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
    <script src="{{ url('backend/assets/js/chart/chart.min.js')}}"></script>
    <script>
        $('document').ready(function () {
            var _token = $('input[name="_token"]').val();

            $.ajax({
                url: "{{route('admin.chartmeses')}}",
                type: 'get',
                dataType: "json",
                data: {
                    _token: _token,
                },
                success: function (data) {
                    var animal_id = [];
                    var animal_mes = [];
                    var animal_unico = [];
                    var animal_frequencia = [];
                    var mes = [];
                    for (var i = 0; i < data.length; i++) {
                        var dt = new Date(data[i].entrada);
                        var dt1 = `${dt.getFullYear()}` + "/" + `${dt.getMonth() + 1}`;

                        if ($.inArray(data[i].animal_id, animal_id) == -1) {
                            animal_id.push(data[i].animal_id);
                        }
                        animal_mes.push(dt1)

                        if ($.inArray(dt1, mes) == -1) {
                            mes.push(dt1)
                        }
                    }

                    function contagemAnimal(mes) {
                        var cont = [];
                        for (var i = 0; i < data.length; i++) {
                            var dt = new Date(data[i].entrada);
                            var dt1 = `${dt.getFullYear()}` + "/" + `${dt.getMonth() + 1}`;
                            if (dt1 === mes) {
                                if ($.inArray(data[i].animal_id, cont) == -1) {
                                    cont.push(data[i].animal_id)
                                }
                            }
                        }
                        animal_unico.push(cont.length)
                    }

                    mes.forEach(contagemAnimal)

                    const countOccurrences = (arr, val) => arr.reduce((a, v) => (v === val ? a + 1 : a), 0);

                    for (var i = 0; i < mes.length; i++) {
                        animal_frequencia.push(countOccurrences(animal_mes, mes[i]));
                    }

                    grafico(mes, animal_mes, animal_id, animal_frequencia, animal_unico)
                }
            });

            function grafico(mes, animal_mes, animal_id, animal_frequencia, animal_unico) {
                // Bar chart

                new Chart(document.getElementById("bar-chart"), {
                    type: 'bar',
                    data: {
                        labels: mes,
                        datasets: [
                            {
                                label: "Entradas",
                                backgroundColor: ["#3e95cd"],
                                data: animal_frequencia
                            },
                            {
                                label: "Animais",
                                backgroundColor: ['#f56954'],
                                data: animal_unico
                            }
                        ]
                    },
                    options: {
                        legend: {display: false},
                        title: {
                            display: true,
                            text: 'Predicted world population (millions) in 2050'
                        }
                    }
                });
            }
        })
    </script>
@endsection
