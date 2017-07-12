@extends('adminlte::layouts.app')

@section('htmlheader_title', 'Avisos')

@section('contentheader_title', 'Avisos')

@section('main-content')

<a href="#" class="btn btn-default">Filtro</a></td>

<a href="#" class="btn btn-default">Marcar Todos</a></td>

<a href="#" class="btn btn-default"> <span class="glyphicon glyphicon-comment" alt="Enviar SMS" aria-hidden="true"></span></a></td>
<a href="#" class="btn btn-default"> <span class="glyphicon glyphicon-earphone" alt="Efetuar Ligação Telefônica" aria-hidden="true"></span></a>

<table class="table table-striped table-hovered">
	<thead>
		<tr>
			<th>Marcar</th>
			<th>Título</th>
			<th>Módulo</th>
			<th>Mensagem</th>
			<th>Destinatário</th>
			<th>Status</th>
			<th>Ações</th>
		</tr>
	</thead>
	<tbody>
		@foreach($avisos as $aviso)
		<tr>
			<td><input type="checkbox" name="avisomarcado[{{$aviso->id}}]"></td>
			<td>{{ $aviso->tituloaviso }}</td>
			<td>{{ ucfirst($aviso->titulo->estado) }}</td>
			<td>{{ $aviso->texto }}</td>
			<td>{{ isset($aviso->cliente->nome)? $aviso->cliente->nome : 'Cliente não cadastrado' }}</td>
			<td>{{ !$aviso->status? 'Agendado para Envio' : 'Enviado '.$aviso->status.' avisos' }}</td>
			<td><a href="avisos/sms/{{$aviso->id}}" class="btn btn-default"> <span class="glyphicon glyphicon-comment" alt="Enviar SMS" aria-hidden="true"></span></a></td>
			<td><a href="avisos/sms/{{$aviso->id}}" class="btn btn-default"> <span class="glyphicon glyphicon-earphone" alt="Efetuar Ligação Telefônica" aria-hidden="true"></span></a></td>

		</tr>
		@endforeach
	</tbody>
</table>

@endsection