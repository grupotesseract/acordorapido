@extends('adminlte::layouts.app')

@section('htmlheader_title', 'Alunos')

@section('contentheader_title', 'Alunos')

@section('main-content')

<div class="row">
<div class="col-sm-12">
<table class="table table-striped table-hovered">
	<thead>
		<tr>
			<th>Nome</th>
			<th>Títulos</th>
			<th>Celular</th>
			<th>Telefone</th>
			<th>RG</th>
			<th>Turma</th>
			<th>Ações</th>
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
			<td>
				<a class="btn btn-sm btn-default" href="{{ url('alunos/'.$aluno->id) }}"> <span class="glyphicon glyphicon-plus" aria-hidden="true"></span> mais detalhes </a>
			</td>
		</tr>
		@endforeach
	</tbody>

</table>

</div>
	<div class="col-sm-12">
		<!-- <a class="btn btn-primary"><span class="glyphicon glyphicon-plus" aria-hidden="true"></span> Adicionar Aluno</a>	 -->
	</div>
</div>

@endsection