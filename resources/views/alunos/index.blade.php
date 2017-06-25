@extends('adminlte::layouts.app')

@section('htmlheader_title', 'Alunos')

@section('contentheader_title', 'Alunos')

@section('main-content')

<table class="table table-striped table-hovered">
	<thead>
		<tr>
			<th>Nome</th>
			<th>Títulos</th>
			<th>Celular</th>
			<th>Telefone</th>
			<th>RG</th>
			<th>Turma</th>
			<th></th>
		</tr>
	</thead>
	<tbody>
		@foreach($alunos as $aluno)
		<tr>
			<td>{{ ucwords(strtolower($aluno->nome)) }}</td>
			<td>{{ rand(2,10) }}</td>
			<td>{{ $aluno->celular }}</td>
			<td>{{ $aluno->telefone }}</td>
			<td>{{ $aluno->rg }}</td>
			<td>{{ $aluno->turma }}</td>
			<td><a href="{{ url('aluno/'.$aluno->id) }}">ver mais...</a></td>
		</tr>
		@endforeach
	</tbody>

</table>

@endsection