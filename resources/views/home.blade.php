@extends('adminlte::layouts.app')

@section('htmlheader_title')
	{{ trans('adminlte_lang::message.home') }}
@endsection


@section('main-content')
	<div class="container-fluid spark-screen">

		<!-- Main content -->
		<section class="content">
			<div class="row">
				<div class="col-md-6">
					<!-- AREA CHART -->
					<div class="box box-primary">
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
								<canvas id="titulosAtivos" style="height:250px"></canvas>
							</div>
						</div>
						<!-- /.box-body -->
					</div>
					<!-- /.box -->

					<!-- DONUT CHART -->
					<div class="box box-danger">
						<div class="box-header with-border">
							<h3 class="box-title">Donut Chart</h3>

							<div class="box-tools pull-right">
								<button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
								</button>
								<button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
							</div>
						</div>
						<div class="box-body">
							<canvas id="pieChart" style="height:250px"></canvas>
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
							<h3 class="box-title">Line Chart</h3>

							<div class="box-tools pull-right">
								<button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
								</button>
								<button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
							</div>
						</div>
						<div class="box-body">
							<div class="chart">
								<canvas id="lineChart" style="height:250px"></canvas>
							</div>
						</div>
						<!-- /.box-body -->
					</div>
					<!-- /.box -->

					<!-- BAR CHART -->
					<div class="box box-success">
						<div class="box-header with-border">
							<h3 class="box-title">Bar Chart</h3>

							<div class="box-tools pull-right">
								<button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
								</button>
								<button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
							</div>
						</div>
						<div class="box-body">
							<div class="chart">
								<canvas id="barChart" style="height:230px"></canvas>
							</div>
						</div>
						<!-- /.box-body -->
					</div>
					<!-- /.box -->

				</div>
				<!-- /.col (RIGHT) -->
			</div>
			<!-- /.row -->

		</section>

		<div class="row">
			<h3>Títulos</h3>
			@foreach ($titulos as $titulo)
				<div class="panel panel-default col-sm-4">
					<div class="panel-heading">
					<h4 class="estado-{{ $titulo->estado }}"> {{ $titulo->titulo }} @if($titulo->estado == "azul")
						<span class="label label-primary"> 
					@elseif($titulo->estado == "verde")
						<span class="label label-success"> 
					@endif
					{{ $titulo->estado }}
					</span></h4>
					</div>

				<div class="panel-body row">
						
					<span class="col-sm-12"><span class="glyphicon glyphicon-user" aria-hidden="true"></span> {{ $titulo->cliente->nome }}</span>	
					<span class="col-sm-12"><span class="glyphicon glyphicon-education" aria-hidden="true"></span> {{ $titulo->empresa->nome }}</span>	
						
					<span class="col-sm-12" title="{{ $titulo->pago ? 'Pagamento efetuado' : 'Pagamento pendente' }}">  @if($titulo->pago)<span class="glyphicon glyphicon-check" aria-hidden="true"></span> @else <span class="glyphicon glyphicon-unchecked" aria-hidden="true"></span> @endif R${{ $titulo->valor }}</span>	
					<span class="col-sm-12"><b>Vencimento:</b> {{ $titulo->vencimento }}</span>	
					<span class="col-sm-12 estado-{{ $titulo->estado }}"></span>
					<a href="/avisos/create" class="btn btn-default"> <span class="glyphicon glyphicon-comment" aria-hidden="true"></span> Enviar SMS</a>
				</div>
				</div>
				@endforeach
				<!-- Default box -->
<!-- 				<div class="box">
					<div class="box-header with-border">
						<h3 class="box-title">Home</h3>

						<div class="box-tools pull-right">
							<button type="button" class="btn btn-box-tool" data-widget="collapse" data-toggle="tooltip" title="Collapse">
								<i class="fa fa-minus"></i></button>
							<button type="button" class="btn btn-box-tool" data-widget="remove" data-toggle="tooltip" title="Remove">
								<i class="fa fa-times"></i></button>
						</div>
					</div>
					<div class="box-body">
						{{ trans('adminlte_lang::message.logged') }}
					</div>
				</div>
 -->				<!-- /.box -->

			</div>
		</div>
	</div>


<script>
  $(function () {
    /* ChartJS
     * -------
     * Here we will create a few charts using ChartJS
     */
    //-------------
    //- LINE CHART -
    //--------------
    var lineChartCanvas = $("#titulosAtivos").get(0).getContext("2d");
    var lineChart = new Chart(lineChartCanvas,
    {
    	type: 'doughnut',
        data: {
            datasets: [{
                data: [
                    23,
                    54,
                    23,
                    10
                ],
                backgroundColor: [
                	'#0055ee',
                	'#22dd22',
                	'#eeff22',
                	'#ff0000',
                ],
                label: 'Títulos ativos'
            }],
            labels: [
                "Azul",
                "Verde",
                "Amarelo",
                "Vermelho",
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
});
</script>
@endsection
