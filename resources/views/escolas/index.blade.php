@extends('adminlte::layouts.app')

@section('htmlheader_title', 'Visualizar Escolas')

@section('contentheader_title', 'Visualizar Escolas')

@section('main-content')
<table class="table table-striped table-hovered">
	<thead>
		<tr>
			<th>Escola</th>
			<th>Cidade</th>
			<th>Estado</th>
			<th>Títulos</th>
			<th></th>
		</tr>
	</thead>
	<tbody>
		@foreach($escolas as $escola)
		<tr>
			<td>{{ ucwords(strtolower($escola->nome)) }}</td>
			<td>{{ ucwords(strtolower($escola->cidade)) }}</td>
			<td>{{ $escola->estado }}</td>
			<td>{{ rand(10,30) }}</td>
			<td><a href="{{ url('escola/'.$escola->id) }}">ver mais...</a></td>
		</tr>
		@endforeach
	</tbody>

</table>

@endsection