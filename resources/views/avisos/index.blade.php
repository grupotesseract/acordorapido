

@extends('adminlte::layouts.app')

@section('htmlheader_title', 'Avisos')

@section('contentheader_title', 'Avisos')

@section('main-content')



{!! Form::open(array('url'=>'envialote/','method'=>'POST','name'=>'avisoform')) !!}


{!! Form::submit('Enviar SMS Marcados', array('class'=>'btn btn-primary btn-md')) !!}
<a href="#" class="btn btn-default">Filtro</a></td>

<a href="#" name="marcartodos" class="btn btn-default">Marcar Todos</a></td>
<input type="button" class="btn btn-primary btn-md" name="Check_All" value="Marcar Todos" onClick="CheckAll(document.avisoform.aviso)">
<!-- <a href="#" class="btn btn-default"> <span class="glyphicon glyphicon-earphone" alt="Efetuar Ligação Telefônica" aria-hidden="true"></span></a> -->

<table class="table table-striped table-hovered">
	<thead>
		<tr>
			<th>Marcar</th>
			<th>Título</th>
			<th>Módulo</th>
			<th>Mensagem</th>
			<th>Destinatário</th>
			<th>Status</th>
			<th>Ações</th>
		</tr>
	</thead>
	<tbody>
		@foreach($avisos as $aviso)
		<tr>
			<td><input type="checkbox" value="{{$aviso->id}}" name="aviso[]"></td>
			<td>{{ $aviso->tituloaviso }}</td>
			<td>{{ ucfirst($aviso->titulo->estado) }}</td>
			<td>{{ $aviso->texto }}</td>
			<td>{{ isset($aviso->cliente->nome)? $aviso->cliente->nome : 'Cliente não cadastrado' }}</td>
			<td>{{ !$aviso->status? 'Não Enviado' : 'Enviado '.$aviso->status.' avisos' }}</td>
			<td><a href="avisos/sms/{{$aviso->id}}" class="btn btn-default"> <span class="glyphicon glyphicon-comment" alt="Enviar SMS" aria-hidden="true"></span></a></td>
			<td>
				<button type="button" data-id="{{$aviso->id}}" class="enviarligacao btn btn-default" data-toggle="modal"><span class="glyphicon glyphicon-earphone" alt="Efetuar Ligação Telefônica" aria-hidden="true"></span></button>
			</td>
		</tr>
		@endforeach
	</tbody>
</table>

{!! Form::close() !!}



<!-- Modal -->
<div id="ligacao" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Efetuar Ligação Telefônica</h4>
      </div>

      {!! Form::open(array('url'=>'salvaligacao/','method'=>'POST')) !!}
      <input type="hidden" name="aviso_id" id="aviso_id" value=""/>
			      
      <div class="modal-body">
        <p>Atenção: não se esqueça de iniciar e pausar o cronômetro para marcar a duração da ligação telefônica</p>
        <div class="input-group">
        	@include ('cronometro')
        </div>
        <div class="input-group">
			<span class="input-group-addon" id="basic-addon1"><i class="glyphicon glyphicon-pencil"></i></span>
			<textarea placeholder="Observações" class="form-control" name="texto" id="texto" rows="3"></textarea>
		</div>   
		<div class="col-xs-12 margin-t-1 text-right">
            <div class="col-xs-offset-3 col-xs-3">
        		{!! Form::submit('Salvar Ligação Telefônica', array('class'=>'btn btn-primary btn-md')) !!}
        	</div>
        </div>
      </div>
      

      {!! Form::close() !!}

      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Fechar</button>
      </div>
    </div>

  </div>
</div>

@endsection

