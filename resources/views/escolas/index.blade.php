@extends('adminlte::layouts.app')

@section('htmlheader_title', 'Visualizar Escolas')

@section('contentheader_title', 'Visualizar Escolas')

@section('main-content')
<a href="{{url('/escolas/create')}}" class="btn btn-default">Incluir</a></td>

<table class="table table-striped table-hovered">
	<thead>
		<tr>
			<th>Escola</th>
			<th>Cidade</th>
			<th>Estado</th>
			<th>Títulos</th>
			<th>Ações</th>
		</tr>
	</thead>
	<tbody>
		@foreach($escolas as $escola)
		<tr>
			<td>{{ $escola->nome }}</td>
			<td>{{ ucwords(strtolower($escola->cidade)) }}</td>
			<td>{{ $escola->estado }}</td>
			<td>{{ rand(10,30) }}</td>
			<td>
				<a class="btn btn-sm btn-default" href="{{ url('escolas/'.$escola->id) }}"> <span class="glyphicon glyphicon-plus" aria-hidden="true"></span> mais detalhes </a>
				<a class="btn btn-sm btn-default" href="{{ url('/escolas/'.$escola->id.'/edit') }}"> <span class="glyphicon glyphicon-pencil" aria-hidden="true"></span></a>
			</td>
			</td>
		</tr>
		@endforeach
	</tbody>

</table>

<div class="col-sm-12">
<!-- <a class="btn btn-primary"><span class="glyphicon glyphicon-plus" aria-hidden="true"></span> Adicionar Escola</a>	 -->
</div>
@endsection