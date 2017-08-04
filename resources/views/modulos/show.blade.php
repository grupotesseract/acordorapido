@extends('adminlte::layouts.app')

@section('htmlheader_title', 'Títulos')

@section('contentheader_title', 'Títulos')

@section('main-content')
<div class="col-xs-2 panel">
    <small>Total Avisos</small>
    <b style="font-size:5em;" class="col-xs-12 text-center">{{ $totalAvisos }}</b>
</div>
<div class="col-xs-2 panel">
    <small>Total SMSs</small>
    <b style="font-size:5em;" class="col-xs-12 text-center">{{ $totalSMSs }}</b>
</div>
<div class="col-xs-2 panel">
    <small>Total Ligações</small>
    <b style="font-size:5em;" class="col-xs-12 text-center">{{ $totalLigacoes }}</b>
</div>
<table class="table table-striped table-hovered">
  <thead>
    <tr>
      <th>Módulo</th>
      <th>Número</th>
      <th>Cliente</th>
      <th>Vencimento</th>
      <th>Valor</th>
      <th>Importado em</th>
      <th>Ações Tomadas</th>
      <th></th>
    </tr>
  </thead>
  <tbody>
    @foreach ($titulos as $titulo)
    <tr>
      <td> <span class="label label-{{ $titulo->estado }}">{{ ucfirst($titulo->estado) }}</span></td>
      <td>{{ ucwords(strtolower($titulo->titulo)) }}</td>
      <td> {{ $titulo->cliente->nome }}</td>
      <td> {{ $titulo->created_at->format('d/m/Y H:i') }}</td>

      <td> {{ $titulo->valor }}</td>
      <td> {{ $titulo->created_at->format('d/m/Y H:i') }}</td>
      <td>  
      @include ('avisos.partials.avisosicones')
      </td>

      <td>
      <!-- <a href="/avisos/create" class="btn btn-sm btn-default"> <span class="glyphicon glyphicon-comment" aria-hidden="true"></span> Enviar SMS</a> -->
      <a class="btn btn-sm btn-default" href="{{ url('titulos/'.$titulo->id) }}"> <span class="glyphicon glyphicon-plus" aria-hidden="true"></span> mais detalhes </a>

      </td>
    </tr>
    @endforeach
  </tbody>

</table>




@endsection
