@extends('adminlte::layouts.app')

@section('htmlheader_title', 'Avisos')

@section('contentheader_title', 'Avisos')

@section('main-content')

<table class="table table-striped table-hovered">
	<thead>
		<tr>
			<th>Título</th>
			<th>Mensagem</th>
			<th>Destinatário</th>
			<th>status</th>
		</tr>
	</thead>
	<tbody>
		@foreach($avisos as $aviso)
		<tr>
			<td>{{ $aviso->titulo }}</td>
			<td>{{ $aviso->texto }}</td>
			<td>{{ isset($aviso->cliente->nome)? $aviso->cliente->nome : 'Cliente não cadastrado' }}</td>
			<td>{{ !$aviso->status? 'Agendado para Envio' : 'Enviado' }}</td>
		</tr>
		@endforeach
	</tbody>
</table>

@endsection