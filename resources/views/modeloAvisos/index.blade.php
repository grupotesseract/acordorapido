@extends('adminlte::layouts.app')

@section('htmlheader_title', 'Visualizar Escolas')

@section('contentheader_title', 'Visualizar Escolas')

@section('main-content')
<table class="table table-striped table-hovered">
	<thead>
		<tr>
			<th>Escola</th>
			<th>Título</th>
		</tr>
	</thead>
	<tbody>
		@foreach($modeloAvisos as $modeloAviso)
		<tr>
			<td>{{ $modeloAviso->escola->nome }}</td>
			<td>{{ $modeloAviso->titulo }}</td>
			<td>
				<a class="btn btn-sm btn-default" href="{{ url('escolas/'.$escola->id) }}"> <span class="glyphicon glyphicon-plus" aria-hidden="true"></span> mais detalhes </a>
			</td>
		</tr>
		@endforeach
	</tbody>

</table>

<div class="col-sm-12">
<!-- <a class="btn btn-primary"><span class="glyphicon glyphicon-plus" aria-hidden="true"></span> Adicionar Escola</a>	 -->
</div>
@endsection