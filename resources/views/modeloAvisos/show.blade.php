@extends('adminlte::layouts.app')

@section('htmlheader_title', 'Escolas')

@section('contentheader_title', 'Escolas')

@section('main-content')

<div class="container">
    <div class="row">
      <div class="col-xs-12">
      </div>
    </div>
    <div class="row">
      <div class="col-xs-12">
        <h4>Escola: {{ $escola->nome }}</h4>
      </div>
    </div>

    <div class="row">
      @if($escola->user)
      <div class="col-xs-12 col-lg-3">
        <b>E-mail para contato:</b>
        <span>{{ $escola->user->email }}</span>
      </div> 
      @endif

      <div class="col-xs-12 col-lg-3">
        <b>Cidade:</b>
        <span>{{ $escola->cidade }}</span>
      </div> 
      <div class="col-xs-12 col-lg-3">
        <b>Estado:</b>
        <span>{{ $escola->estado }}</span>
      </div> 
    </div>

    @role('admin')
    <div class="row">
    <a href="{{ url('escolas/'.$escola->id.'/edit') }}" class="btn btn-primary">Editar informações</a>
    </div>
    @endrole
</div>

@endsection