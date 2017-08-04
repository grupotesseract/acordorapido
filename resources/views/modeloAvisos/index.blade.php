@extends('adminlte::layouts.app')

@section('htmlheader_title', 'Visualizar Escolas')

@section('contentheader_title', 'Visualizar Escolas')

@section('main-content')
<a href="{{url('/avisomodelos/create')}}" class="btn btn-default">Incluir</a></td>
<table class="table table-striped table-hovered">
	<thead>
		<tr>
			<th>Escola</th>
			<th>Título</th>
			<th>Módulo</th>
		</tr>
	</thead>
	<tbody>
		@foreach($modeloAvisos as $modeloAviso)
		<tr>
			<td>{{ $modeloAviso->empresa->nome }}</td>
			<td>{{ $modeloAviso->titulo }}</td>
			<td>{{ $modeloAviso->tipo }}</td>
			<td>
				<a class="btn btn-sm btn-default" href="{{ url('/avisomodelos/'.$modeloAviso->id.'/edit') }}"> <span class="glyphicon glyphicon-pencil" aria-hidden="true"></span></a>
				<!-- <a class="btn btn-sm btn-default" href="{{ url('/avisomodelos/'.$modeloAviso->id.'/edit') }}"> <span class="glyphicon glyphicon-remove" aria-hidden="true"></span></a> -->       		


			</td>			
		</tr>
		@endforeach
	</tbody>

</table>

<div class="col-sm-12">
<!-- <a class="btn btn-primary"><span class="glyphicon glyphicon-plus" aria-hidden="true"></span> Adicionar Escola</a>	 -->
</div>
@endsection