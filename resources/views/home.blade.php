@extends('adminlte::layouts.app')

@section('htmlheader_title')
	{{ trans('adminlte_lang::message.home') }}
@endsection


@section('main-content')
	<div class="container-fluid spark-screen">
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
@endsection
