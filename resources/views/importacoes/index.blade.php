@extends('adminlte::layouts.app')

@section('htmlheader_title', 'Importações')

@section('contentheader_title', 'Importações')


@section('main-content')

  <table class="table table-striped table-hovered">
  <thead>
    <tr>
      <th>Módulo</th>
      <th>Data</th>
      <th>Títulos</th>
      <th>Operador</th>
      <th></th>
    </tr>
  </thead>
  <tbody>
    @foreach ($importacoes as $importacao)
    <tr>
      <td>{{ $importacao->modulo }}</td>
      <td>{{ $importacao->created_at }}</td>
      <td>{{ $importacao->titulosCount }}</td>
      <td> {{ $importacao->user->name }}</td>
      <td>
        <a class="btn btn-sm btn-default" href="{{ url('titulo/'.$titulo->id) }}"> <span class="glyphicon glyphicon-plus" aria-hidden="true"></span> mais detalhes </a>
      </td>
    </tr>
    @endforeach
  </tbody>

</table>
@endsection
