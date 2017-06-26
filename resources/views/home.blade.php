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
				<div class="col-md-12">
					<div class="box box-default">
						<div class="box-header with-border">
							<h3 class="box-title">Títulos separados por módulos</h3>
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
						<!-- /.box-body -->
					</div>
				</div>
					<!-- /.box -->
				<div class="col-md-6">
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
				<div class="col-md-6">
					<!-- LINE CHART -->
					<div class="box box-info">
						<div class="box-header with-border">
							<h3 class="box-title">Últimos Avisos</h3>

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
										<th>Título</th>
										<th>Mensagem</th>
										<th>Destinatário</th>
										<th>Enviado em</th>
									</tr>
								</thead>
								<tbody>
									@foreach($avisos as $aviso)
									<tr>
										<td>{{ $aviso->titulo }}</td>
										<td>{{ $aviso->texto }}</td>
										<td>{{ $aviso->cliente->nome }}</td>
										<td>{{ $aviso->created_at }}</td>
										</tr>
									@endforeach
								</tbody>
							</table>
						</div>
						<!-- /.box-body -->
					</div>
					<!-- /.box -->

					<!-- Títulos totais -->
					<div class="box box-info">
						<div class="box-header with-border">
							<h3 class="box-title">Títulos totais</h3>

							<div class="box-tools pull-right">
								<button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
								</button>
								<button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
							</div>
						</div>
						<div class="box-body">
							<div class="row">
							<div class="chart col-sm-4">
									<canvas id="titulosPagos" style="height:112px"></canvas>
								</div>
							</div>
						</div>
					</div>
					<!-- /.box -->

				</div>

				<div class="col-sm-12">

					<div class="box box-success">
						<div class="box-header with-border">
							<h3 class="box-title">Ultimas atualizações</h3>

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
										<th></th>
									</tr>
								</thead>
								<tbody>
									@foreach ($titulos as $titulo)
									<tr>
										<td>@if($titulo->estado == "azul")
											<span class="label label-primary"> 
												@elseif($titulo->estado == "verde")
												<span class="label label-success"> 
													@endif
													{{ $titulo->estado }}
												</span>
										</td>
										<td>{{ ucwords(strtolower($titulo->titulo)) }}</td>
										<td> {{ $titulo->cliente->nome }}</td>
										<td> {{ $titulo->vencimento }}</td>
										<td> {{ $titulo->valor }}</td>
										<td><a href="{{ url('titulo/'.$titulo->id) }}">ver mais...</a></td>
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
                    34,
                    23,
                    15,
                    40,
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
            }
        }
    });
 
 	var titulosPagosCanvas = $("#titulosPagos").get(0).getContext("2d");
    var titulosPagos = new Chart(titulosPagosCanvas,
    {
    	type: 'pie',
        data: {
            datasets: [{
                data: [
                    10,
                    45,
                ],
                backgroundColor: [
                	'#99ABAA',
                	'#00C0EF',
                ],
            }],
            labels: [
                "Pagos",
                "Ativos",
            ]
        },
        options: {
            responsive: true,
            legend: {
                position: 'none',
            },
            title: {
                display: false,
                text: 'Títulos ativos'
            },
            animation: {
                animateScale: true,
                animateRotate: true
            }
        }
    });

    var titulosTotalCanvas = $("#titulosTotal").get(0).getContext("2d"); 
    var titulosTotal = new Chart(titulosTotalCanvas,
    {
    	type: 'line',
        data: { 
        	labels: ["Janeiro", "Fevereiro", "Março", "Abril", "Maio", "Junho", "Julho"],
        	datasets: [{
        		label: "Módulo Azul",
        		// backgroundColor: '#0275D8',
        		borderColor: '#0275D8',
        		data: [
	        		44,
	        		33,
	        		10,
	        		45,
	        		33,
	        		10,
	        		40
        		]
        	},{
        		label: "Módulo Verde",
        		// backgroundColor: '#0275D8',
        		borderColor: '#5CB85C',
        		data: [
	        		3,
	        		14,
	        		25,
	        		10,
	        		24,
	        		33,
	        		20
        		]
        	},{
        		label: "Módulo Amarelo",
        		// backgroundColor: '#0275D8',
        		borderColor: '#F0BD4E',
        		data: [
	        		0,
	        		0,
	        		0,
	        		0,
	        		1,
	        		2,
	        		6
        		]
        	},
        	]
        },
        options: {
          
        }
    });

});
</script>
@endsection
