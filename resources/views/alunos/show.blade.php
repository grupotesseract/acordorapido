@extends('adminlte::layouts.app')

@section('htmlheader_title', 'Alunos')

@section('contentheader_title', 'Alunos')

@section('main-content')

<div class="container">
    <div class="row">
      <div class="col-xs-12">
      </div>
    </div>
    <div class="row">
      <div class="col-xs-12 margin-t-0-5 margin-b-0-5">
        <h4>Sobre {{ explode(' ',$aluno->nome)[0] }}</h4>
      </div>
    </div>
    <div class="row">
      <div class="col-xs-12 col-lg-2 text-right">
        <b>Nome completo:</b>
      </div> 
      <div class="col-xs-12 col-lg-10">
        <span>{{ $aluno->nome }}</span>
      </div> 
    </div>
    @if($aluno->celular)
    <div class="row">
      <div class="col-xs-12 col-lg-2 text-right">
        <b>Celular:</b>
      </div> 
      <div class="col-xs-12 col-lg-10">
        <span>{{ $aluno->celular }}</span>
      </div> 
    </div>
    @endif
    @if($aluno->celular2)
    <div class="row">
      <div class="col-xs-12 col-lg-2 text-right">
        <b>Celular 2:</b>
      </div> 
      <div class="col-xs-12 col-lg-10">
        <span>{{ $aluno->celular2 }}</span>
      </div> 
    </div>
    @endif
    @if($aluno->telefone)
    <div class="row">
      <div class="col-xs-12 col-lg-2 text-right">
        <b>Telefone:</b>
      </div> 
      <div class="col-xs-12 col-lg-10">
        <span>{{ $aluno->telefone }}</span>
      </div> 
    </div>
    @endif
    @if($aluno->telefone2)
    <div class="row">
      <div class="col-xs-12 col-lg-2 text-right">
        <b>Telefone 2:</b>
      </div> 
      <div class="col-xs-12 col-lg-10">
        <span>{{ $aluno->telefone2 }}</span>
      </div> 
    </div>
    @endif
    <div class="row">
      <div class="col-xs-12 col-lg-2 text-right">
        <b>Email:</b>
      </div> 
      <div class="col-xs-12 col-lg-10">
        <span>{{ $aluno->user->email }}</span>
      </div> 
    </div>
    @if($aluno->turma)
    <div class="row">
      <div class="col-xs-12 col-lg-2 text-right">
        <b>Turma:</b>
      </div> 
      <div class="col-xs-12 col-lg-10">
        <span>{{ $aluno->turma }}</span>
      </div> 
    </div>
    @endif
    @if($aluno->periodo)
    <div class="row">
      <div class="col-xs-12 col-lg-2 text-right">
        <b>Período:</b>
      </div> 
      <div class="col-xs-12 col-lg-10">
        <span>{{ $aluno->periodo }}</span>
      </div> 
    </div>
    @endif
    @if($aluno->responsavel)
    <div class="row">
      <div class="col-xs-12 col-lg-2 text-right">
        <b>Responsável:</b>
      </div> 
      <div class="col-xs-12 col-lg-10">
        <span>{{ $aluno->responsavel }}</span>
      </div> 
    </div>
    @endif
    @if($aluno->rg)
    <div class="row">
      <div class="col-xs-12 col-lg-2 text-right">
        <b>RG:</b>
      </div> 
      <div class="col-xs-12 col-lg-10">
        <span>{{ $aluno->rg }}</span>
      </div> 
    </div>
    @endif
    @role('admin')
    <div class="row">
    <a href="{{ url('alunos/'.$aluno->id.'/edit') }}" class="btn btn-primary">Editar informações</a>
    </div>
    @endrole
</div>

@endsection