@extends('adminlte::layouts.app')

@section('htmlheader_title', 'Escolas')

@section('contentheader_title', 'Escolas')

@section('main-content')


    <div class="row">
      <div class="col-xs-12">
        <h4>{{ isset($escola)? 'Escola '.$escola->nome : 'Incluir Escola' }}</h4>
      </div>
    </div>
    <div class="col-sm-6">    

      @if(isset($escola))
        {!! Form::open(array('url'=>'/escolas/'.$escola->id,'method'=>'PATCH')) !!} 

      @else
        {!! Form::open(array('url'=>'/escolas','method'=>'POST')) !!} 
      @endif 

      <div class="form-group">
        <b>Nome:</b>
        <input class="form-control" name="nome" type="text" value="{{ isset($escola)? $escola->nome : '' }}"/>
      </div> 

      <div class="form-group">
        <b>Cidade:</b>
        <input class="form-control" name="cidade" type="text" value="{{ isset($escola)? $escola->cidade : ''}}"/>
      </div> 
      
      <div class="form-group">
        <b>Estado:</b>
        <input class="form-control" name="estado" type="text" value="{{ isset($escola)? $escola->estado : '' }}"/>
      </div> 

    <div class="row">
      <div class="col-xs-12 col-lg-12">
        <br>
        <button class="btn btn-primary">Salvar</button>
      </div>
    </div>
      {!! Form::close() !!}
    </div>



@endsection