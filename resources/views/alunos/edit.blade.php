@extends('adminlte::layouts.app')

@section('htmlheader_title', 'Alunos')

@section('contentheader_title', 'Alunos')

@section('main-content')

    <div class="row">
      <div class="col-xs-12">
      </div>
    </div>
    <div class="row">
      <div class="col-xs-12">
        <h4>Sobre {{ explode(' ',$aluno->nome)[0] }}</h4>
      </div>
    </div>
    <div class="row">
      <div class="col-xs-12 col-md-6 col-lg-4">
        <b>Nome completo:</b>
        <input class="form-control" type="text" value="{{ $aluno->nome }}"/>
      </div> 
      <div class="col-xs-12 col-md-6 col-lg-4">
        <b>Celular:</b>
        <input class="form-control" type="text" value="{{ $aluno->celular }}"/>
      </div> 
      <div class="col-xs-12 col-md-6 col-lg-4">
        <b>Celular 2:</b>
        <input class="form-control" type="text" value="{{ $aluno->celular2 }}"/>
      </div> 
      <div class="col-xs-12 col-md-6 col-lg-4">
        <b>Email:</b>
        <input class="form-control" type="text" value="{{ $aluno->user->email }}"/>
      </div> 
      <div class="col-xs-12 col-md-6 col-lg-4">
        <b>Telefone:</b>
        <input class="form-control" type="text" value="{{ $aluno->telefone }}"/>
      </div> 
      <div class="col-xs-12 col-md-6 col-lg-4">
        <b>Telefone 2:</b>
        <input class="form-control" type="text" value="{{ $aluno->telefone2 }}"/>
      </div> 
    </div>
    <div class="row">
      <div class="col-xs-12 col-md-6 col-lg-4">
        <b>Turma:</b>
        <input class="form-control" type="text" value="{{ $aluno->turma }}"/>
      </div> 
      <div class="col-xs-12 col-md-6 col-lg-4">
        <b>Período:</b>
        <input class="form-control" type="text" value="{{ $aluno->periodo }}"/>
      </div> 
      <div class="col-xs-12 col-md-6 col-lg-4">
        <b>Responsável:</b>
        <input class="form-control" type="text" value="{{ $aluno->responsavel }}"/>
      </div> 
      <div class="col-xs-12 col-md-6 col-lg-4">
        <b>RG:</b>
        <input class="form-control" type="text" value="{{ $aluno->rg }}"/>
      </div> 
    </div>
    <div class="row">
      <div class="col-xs-12 col-lg-12">
        <br>
        <button class="btn btn-primary">Editar informações</button>
      </div>
    </div>

@endsection