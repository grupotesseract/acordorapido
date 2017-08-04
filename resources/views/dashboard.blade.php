@extends('adminlte::layouts.app')

@section('htmlheader_title')
        {{ trans('adminlte_lang::message.home') }}
@endsection


@section('main-content')
    <div class="container-fluid spark-screen">

        <!-- Main content -->
        <section class="content">
            <div class="row">
            <!-- MÓDULOS -->
               <div class="col-md-5">
                    <!-- AREA CHART -->
                    <div class="box box-default">
                        <div class="box-header with-border">
                            <h3 class="box-title">Títulos ativos</h3>

                            <div class="box-tools pull-right">
                                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                                </button>
                                <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                            </div>
                        </div>
                            <div class="box-body">
                                <div class="chart">
                                    <canvas id="titulosAtivos" style="height:350px"></canvas>
                                </div>
                            </div>
                            <!-- /.box-body -->
                    </div>
                        <!-- /.box -->

                </div>
                <!-- /.col (LEFT) -->
                <div class="col-md-7">
                    <!-- LINE CHART -->
                    <div class="box box-info">
                        <div class="box-header with-border">
                            <h3 class="box-title">Últimas Importações</h3>

                            <div class="box-tools pull-right">
                                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                                </button>
                                <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                            </div>
                        </div>
                        <div class="box-body">
                            <table class="table table-striped table-hovered">
                                <thead>
                                    <tr>
                                        <th>Data</th>
                                        <th>Módulo</th>
                                        <th>Escola</th>
                                        <th>Títulos</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @forelse($importacoes as $importacao)
                                    <tr>
                                        <td>{{ $importacao->created_at }}</td>
                                        <td><a href="{{ url('titulos/modulo/'.$importacao->modulo)}}" class="label label-{{ $importacao->modulo }}">{{ ucfirst($importacao->modulo) }}</a></td>
                                        <td>{{ $importacao->empresa->nome }}</td>
                                        <td><a href="{{ url('importacao/'.$importacao->id.'/titulos') }}">{{ $importacao->titulos->count() }} Títulos</a></td>
                                    </tr>
                                    @empty
                                    @endforelse
                                </tbody>
                            </table>
                        </div>
                        <!-- /.box-body -->
                    </div>
                        <!-- /.box -->
                </div>

                {{-- desativado momentaneamente
                <div class="col-sm-12">
                    <div class="box-header with-border">
                        <h3 class="box-title">Títulos por módulos</h3>
                        <div class="box-tools pull-right">
                          <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                          </button>
                          <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                        </div>
                      </div>
                      <div class="box-body">
                        <div class="row">
                          <div class="col-sm-12">
                            <div class="chart">
                              <canvas id="titulosTotal" style="height:150px"></canvas>
                            </div>
                          </div>
                        </div>
                      </div>
                </div> --}}
                <div class="col-sm-12">

                    <div class="box box-success">
                        <div class="box-header with-border">
                            <h3 class="box-title">Ultimos Títulos Importados</h3>

                            <div class="box-tools pull-right">
                                <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
                                </button>
                                <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
                            </div>
                        </div>
                            <div class="box-body">
                                    <table class="table table-striped table-hovered">
                                            <thead>
<tr>
<th>Módulo</th>
<th>Número</th>
<th>Cliente</th>
<th>Vencimento</th>
<th>Valor</th>
<th>Importado em</th>
<th>Ações Tomadas</th>
<th></th>
</tr>
                                            </thead>
                                            <tbody>
@foreach ($titulos as $titulo)
<tr>
<td><a href="{{ url('titulos/modulo/'.$titulo->estado)}}" class="label label-{{ $titulo->estado }}">{{ ucfirst($titulo->estado) }}</a></td>
<td>{{ ucwords(strtolower($titulo->titulo)) }}</td>
<td> {{ $titulo->cliente->nome }}</td>
<td> {{ $titulo->created_at->format('d/m/Y H:i') }}</td>

<td> {{ $titulo->valor }}</td>
<td> {{ $titulo->created_at->format('d/m/Y H:i') }}</td>
<td>  

@foreach ($titulo->avisos as $aviso)
@if (isset($aviso))
@forelse  ($aviso->avisosenviados->where('tipodeaviso', 0) as $avisoenviado)            
<span class="label label-{{ $aviso->estado }}"><span class="glyphicon glyphicon-envelope" aria-hidden="true"></span></span>
@empty
@endforelse
@endif


@endforeach


</td>
<td>
<!-- <a href="/avisos/create" class="btn btn-sm btn-default"> <span class="glyphicon glyphicon-comment" aria-hidden="true"></span> Enviar SMS</a> -->
<a class="btn btn-sm btn-default" href="{{ url('titulos/'.$titulo->id) }}"> <span class="glyphicon glyphicon-plus" aria-hidden="true"></span> mais detalhes </a>

</td>
</tr>
@endforeach
                                            </tbody>
                                    </table>
                            </div>
                            <!-- /.box-body -->
                    </div>
                </div>
                    <!-- /.col (RIGHT) -->
            </div>
                <!-- /.row -->
        </section>
    </div>


<script>
$(function () {
    var titulosAtivosCanvas = $("#titulosAtivos").get(0).getContext("2d");
    var titulosAtivos = new Chart(titulosAtivosCanvas,
    {
        type: 'doughnut',
        data: {
            datasets: [{
                data: [
                    {{ $totalVerdes }},
                    {{ $totalAmarelos }},
                    {{ $totalVermelhos }},
                    {{ $totalAzuis }},
                ],
                backgroundColor: [
                    '#5CB85C',
                    '#F0BD4E',
                    '#D9534F',
                    '#0275D8',
                ],
                label: 'Títulos ativos'
            }],
            labels: [
                "Verde",
                "Amarelo",
                "Vermelho",
                "Azul",
            ]
        },
        options: {
            responsive: true,
            legend: {
                position: 'right',
            },
            title: {
                display: false,
                text: 'Títulos ativos'
            },
            animation: {
                animateScale: true,
                animateRotate: true
            },
            onClick: function(e,a) { 
                var activePoints = titulosAtivos.getElementsAtEvent(e);
                if(activePoints.length > 0)
                {
                    var clickedElementindex = activePoints[0]["_index"];
                    switch(clickedElementindex) {
                    case 0:
                        console.log("verde");
                        window.location.href = "/titulos/modulo/verde";
                        break;
                    case 1:
                        console.log("amarelo");
                        window.location.href = "/titulos/modulo/amarelo";
                        break;
                    case 2:
                        console.log("vermelho");
                        window.location.href = "/titulos/modulo/vermelho";
                        break;
                    case 3:
                        console.log("azul");
                        window.location.href = "/titulos/modulo/azul";
                        break;
                    } 
                }
            }
        }
    });
});
</script>
@endsection
