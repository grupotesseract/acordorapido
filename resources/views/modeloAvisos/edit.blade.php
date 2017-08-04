@extends('adminlte::layouts.app')

@section('htmlheader_title', 'Escolas')

@section('contentheader_title', 'Escolas')

@section('main-content')

    <div class="row">
      <div class="col-xs-12">
        <h4>{{ isset($modeloAviso)? $modeloAviso->nome : 'Inclusão Novo Modelo de Mensagem' }}</h4>
      </div>
    </div>
    <div class="col-sm-6">
      @if(isset($modeloAviso))
        {!! Form::open(array('url'=>'/avisomodelos/'.$modeloAviso->id,'method'=>'PATCH')) !!} 
      @else
        {!! Form::open(array('url'=>'/avisomodelos','method'=>'POST')) !!} 
      @endif             
      
        <div class="form-group">
          <label for="sel1">Escolha a escola:</label>
          <select class="form-control" name="empresa_id" id="escola">
            @forelse($escolas as $escola)
              <option value="{{$escola->id}}">{{$escola->nome}}</option>
            @empty 
              <p>Sem escolas cadastradas</p>
            @endforelse
          </select>
        </div>

        <div class="form-group">
          <label for="sel1">Escolha a qual módulo a mensagem será enviada</label>
          <select class="form-control" name="tipo" id="escola">
              <option value="Nenhum">Nenhum</option>              
              <option value="Azul">Azul</option>
              <option value="Verde">Verde</option>
              <option value="Amarelo">Amarelo</option>
              <option value="Vermelho">Vermelho</option>
          </select>
        </div>

        <div class="form-group">
          <b>Título:</b>
          <input class="form-control" type="text" name="titulo" value="{{ isset($modeloAviso)? $modeloAviso->titulo : '' }}"/>
        </div> 

        <div class="form-group">
          <b>Texto:</b>          
          <textarea placeholder="Digite aqui a sua mensagem" class="form-control" name="mensagem" id="texto" rows="3">{{ isset($modeloAviso)? $modeloAviso->mensagem : '' }}</textarea>
        </div> 
        
        <div class="row">
          <div class="col-xs-12 col-lg-12">
            {!! Form::submit('Salvar', array('class'=>'btn btn-primary btn-md')) !!}
          </div>          
        </div>  
        {!! Form::close() !!}

        @if(isset($modeloAviso))        
          <div class="row">
            <div class="col-xs-12 col-lg-12">
              {!! Form::open(array('url'=>'/avisomodelos/'.$modeloAviso-> id,'method'=>'DELETE')) !!} 
                {!! Form::submit('Excluir', array('class'=>'btn btn-primary btn-md')) !!}
              {!! Form::close() !!}  
            </div>
          </div>
        @endif

        
    </div>    







@endsection