@extends('adminlte::layouts.app')

@section('htmlheader_title', 'Títulos')

@section('contentheader_title', 'Títulos')

@section('main-content')

<table class="table table-striped table-hovered">
  <thead>
    <tr>
      <th>Módulo</th>
      <th>Número</th>
      <th>Cliente</th>
      <th>Vencimento</th>
      <th>Valor</th>
      <th>Importado em</th>
      <th>Ações</th>
      <th></th>
    </tr>
  </thead>
  <tbody>
    @foreach ($titulos as $titulo)
    <tr>
      <td>{{ $titulo->estado }}</td>
      <td>{{ ucwords(strtolower($titulo->titulo)) }}</td>
      <td> {{ $titulo->cliente->nome }}</td>
      <td> {{ $titulo->created_at->addDays(47)->format('d/m/Y') }}</td>
      <td> {{ $titulo->valor }}</td>
      <td> {{ $titulo->created_at->format('d/m/Y H:i') }}</td>
      <td>  
        <?php $random = rand(0,5) ?>
        @if($random > 0)
        <span class="label label-primary"><span class="glyphicon glyphicon-envelope" aria-hidden="true"></span></span>
        @endif
        @if($random > 1)
        <span class="label label-primary"><span class="glyphicon glyphicon-envelope" aria-hidden="true"></span></span>
        @endif
        @if($random > 2)
        <span class="label label-success"><span class="glyphicon glyphicon-envelope" aria-hidden="true"></span></span>
        @endif
        @if($random > 3)
        <span class="label label-success"><span class="glyphicon glyphicon-earphone" aria-hidden="true"></span></span>
        @endif
      </td>
      <td>
      <a href="/avisos/create" class="btn btn-sm btn-default"> <span class="glyphicon glyphicon-comment" aria-hidden="true"></span> Enviar SMS</a>
      <a class="btn btn-sm btn-default" href="{{ url('titulos/'.$titulo->id) }}"> <span class="glyphicon glyphicon-plus" aria-hidden="true"></span> mais detalhes </a>
      </td>
    </tr>
    @endforeach
  </tbody>

</table>

@endsection
