<table class="table table-striped table-hovered">
	<thead>
		<tr>
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
			<td>{{ $aviso->tituloaviso }}</td>
			<td><label class="label label-{{ $aviso->titulo->estado }}">{{ ucfirst($aviso->titulo->estado) }}</label></td>


			<td>{{ $aviso->texto }}</td>
			<td>{{ isset($aviso->cliente->nome)? ucwords(strtolower($aviso->cliente->nome)) : 'Cliente não cadastrado' }}</td>
			<td>{{ !$aviso->status? 'Não Enviado' : 'Enviado '.$aviso->status.' avisos' }}</td>
			<td><a href="avisos/sms/{{$aviso->id}}" class="btn btn-default"> <span class="glyphicon glyphicon-comment" alt="Enviar SMS" aria-hidden="true"></span></a></td>
			<td><a href="avisos/sms/{{$aviso->id}}" class="btn btn-default"> <span class="glyphicon glyphicon-earphone" alt="Efetuar Ligação Telefônica" aria-hidden="true"></span></a></td>

		</tr>
		@endforeach
	</tbody>
</table>


