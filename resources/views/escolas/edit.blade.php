@extends('adminlte::layouts.app')

@section('htmlheader_title', 'Escolas')

@section('contentheader_title', 'Escolas')

@section('main-content')

    <div class="row">
      <div class="col-xs-12">
        <h4>Escola: {{ $escola->nome }}</h4>
      </div>
    </div>
    <div class="row">
      <div class="col-xs-12 col-md-6 col-lg-4">
        <b>Nome:</b>
        <input class="form-control" type="text" value="{{ $escola->nome }}"/>
      </div> 
      <div class="col-xs-12 col-md-6 col-lg-4">
        <b>Cidade:</b>
        <input class="form-control" type="text" value="{{ $escola->cidade }}"/>
      </div> 
      <div class="col-xs-12 col-md-6 col-lg-4">
        <b>Estado:</b>
        <input class="form-control" type="text" value="{{ $escola->estado }}"/>
      </div> 
    </div>
    <div class="row">
      <div class="col-xs-12 col-lg-12">
        <br>
        <button class="btn btn-primary">Editar informações</button>
      </div>
    </div>

@endsection