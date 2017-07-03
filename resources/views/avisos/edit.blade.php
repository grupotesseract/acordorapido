@extends('adminlte::layouts.app')

@section('htmlheader_title', 'Enviar SMS')

@section('contentheader_title', 'Enviar SMS')

@section('main-content')
  <div class="container">
    <div class="row">
      <div class="col-xs-12">
      </div>
    </div>
    <div class="row">
      <div class="col-xs-12 margin-t-0-5 margin-b-0-5">
        <h4>Digite abaixo a sua mensagem</h4>
      </div>
      <div class="col-xs-6">
        {!! Form::open(array('url'=>'sms','method'=>'POST', 'files'=>true)) !!}
          <div class="control-group">
            <div class="controls">
              
              @if(session('message'))
                <div class="alert alert-success alert-dismissible">
                    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">×</button>
                    <h4><i class="icon fa fa-check"></i> Sucesso!</h4>
                    <em>{!! session('message') !!}</em>
                </div>
              @endif

              <p class="errors">
                {!!$errors->first('excel')!!}
              </p>

              <div class="input-group">
                <span class="input-group-addon" id="basic-addon1"><i class="glyphicon glyphicon-phone"></i></span>
                <input name="to" id="to" type="text" class="form-control" placeholder="Telefone do Destinatário" aria-describedby="basic-addon1">
              </div>

              <div class="input-group">
                <span class="input-group-addon" id="basic-addon1"><i class="glyphicon glyphicon-pencil"></i></span>
                <textarea placeholder="Digite aqui a sua mensagem" class="form-control" name="msg" id="msg" rows="3"></textarea>
              </div>                         

                            
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

