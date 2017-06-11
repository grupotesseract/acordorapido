@extends('adminlte::layouts.app')

@section('htmlheader_title', 'Importação XLS')

@section('contentheader_title', 'Importar Planilha Captura das Vendas')

@section('main-content')
  <div class="container">
    <div class="row">
      <div class="col-xs-12">
      </div>
    </div>
    <div class="row">
      <div class="col-xs-12 margin-t-0-5 margin-b-0-5">
        <h4>Escolha abaixo a planilha a ser importada</h4>
      </div>
      <div class="col-xs-12">
        {!! Form::open(array('url'=>'importacao/upload','method'=>'POST', 'files'=>true)) !!}
          <div class="control-group">
            <div class="controls">
              {!! Form::file('excel', ['required', 'class' => 'form-file']) !!}
              <p class="errors">
              {!!$errors->first('excel')!!}
              </p>
            </div>
          </div>
          <div class="col-xs-12 margin-t-1 text-right">
            <div class="col-xs-offset-3 col-xs-3">
              {!! Form::submit('Enviar', array('class'=>'btn btn-primary btn-md')) !!}
            </div>
          </div>
        {!! Form::close() !!}
      </div>
    </div>
  </div>
@endsection

