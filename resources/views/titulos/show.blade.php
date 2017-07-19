@extends('adminlte::layouts.app')

@section('htmlheader_title', 'Detalhes do Título')

@section('contentheader_title', 'Detalhes do Título')

@section('main-content')

<div class="container-fluid spark-screen">
  <div class="row">
    <div class="col-sm-6">
      <div class="panel panel-default">
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

          <span class="col-sm-12" title="{{ $titulo->pago ? 'Pagamento efetuado' : 'Pagamento pendente' }}">  
            @if($titulo->pago)<span class="glyphicon glyphicon-check" aria-hidden="true"></span> 
            @else <span class="glyphicon glyphicon-unchecked" aria-hidden="true"></span> 
            @endif R${{ $titulo->valor }}
          </span>  
          <span class="col-sm-12"><b>Vencimento:</b> {{ $titulo->vencimento }}</span> 
          <span class="col-sm-12 estado-{{ $titulo->estado }}"></span>
          <!-- <a href="/avisos/create" class="btn btn-default"> <span class="glyphicon glyphicon-comment" aria-hidden="true"></span> Enviar SMS</a> -->
        </div>
      </div>
    </div>
  </div>
<a class="btn btn-default" href="{{ url('titulos') }}"> <span class="glyphicon glyphicon-chevron-left" aria-hidden="true"></span> Títulos</a>
</div>
@endsection
