@extends('adminlte::layouts.app')

@section('htmlheader_title')
  {{ trans('adminlte_lang::message.home') }}
@endsection


@section('main-content')
  <table class="table table-striped table-hovered">
  <thead>
    <tr>
      <th>Módulo</th>
      <th>Número</th>
      <th>Cliente</th>
      <th>Vencimento</th>
      <th>Valor</th>
      <th></th>
    </tr>
  </thead>
  <tbody>
    @foreach ($titulos as $titulo)
    <tr>
      <td>{{ $titulo->estado }}</td>
      <td>{{ ucwords(strtolower($titulo->titulo)) }}</td>
      <td> {{ $titulo->cliente->nome }}</td>
      <td> {{ $titulo->vencimento }}</td>
      <td> {{ $titulo->valor }}</td>
      <td><a href="{{ url('titulo/'.$titulo->id) }}">ver mais...</a></td>
    </tr>
    @endforeach
  </tbody>

</table>
  <div class="container-fluid spark-screen">
    <div class="row">
      <h3>Títulos</h3>
      @foreach ($titulos as $titulo)
        <div class="panel panel-default col-sm-4">
          <div class="panel-heading">
          <h4 class="estado-{{ $titulo->estado }}"> {{ $titulo->titulo }} 
          </h4>
          @if($titulo->estado == "azul")
            <span class="label label-primary"> 
          @elseif($titulo->estado == "verde")
            <span class="label label-success"> 
          @endif
          {{ $titulo->estado }}
          </span>
          </div>

        <div class="panel-body row">
            
          <span class="col-sm-12"><span class="glyphicon glyphicon-user" aria-hidden="true"></span> {{ $titulo->cliente->nome }}</span> 
          <span class="col-sm-12"><span class="glyphicon glyphicon-education" aria-hidden="true"></span> {{ $titulo->empresa->nome }}</span>  
            
          <span class="col-sm-12" title="{{ $titulo->pago ? 'Pagamento efetuado' : 'Pagamento pendente' }}">  @if($titulo->pago)<span class="glyphicon glyphicon-check" aria-hidden="true"></span> @else <span class="glyphicon glyphicon-unchecked" aria-hidden="true"></span> @endif R${{ $titulo->valor }}</span>  
          <span class="col-sm-12"><b>Vencimento:</b> {{ $titulo->vencimento }}</span> 
          <span class="col-sm-12 estado-{{ $titulo->estado }}"></span>
          <a href="/avisos/create" class="btn btn-default"> <span class="glyphicon glyphicon-comment" aria-hidden="true"></span> Enviar SMS</a>
        </div>
        </div>
        @endforeach

      </div>
    </div>
  </div>
@endsection
