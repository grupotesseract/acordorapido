@extends('adminlte::layouts.app')

@section('htmlheader_title', 'Títulos')

@section('contentheader_title', 'Títulos')

@section('main-content')
<div class="box box-default">
  <div class="box-header with-border">
    <h3 class="box-title">Títulos por módulos</h3>
    <div class="box-tools pull-right">
      <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i>
      </button>
      <button type="button" class="btn btn-box-tool" data-widget="remove"><i class="fa fa-times"></i></button>
    </div>
  </div>
  <div class="box-body">
    <div class="row">
      <div class="col-sm-12">
        <div class="chart">
          <canvas id="titulosTotal" style="height:150px"></canvas>
        </div>
      </div>
    </div>
  </div>
  <!-- /.box-body -->
</div>

<table class="table table-striped table-hovered">
  <thead>
    <tr>
      <th>Módulo</th>
      <th>Número</th>
      <th>Cliente</th>
      <th>Vencimento</th>
      <th>Valor</th>
      <th>Importado em</th>
      <th>Ações</th>
      <th></th>
    </tr>
  </thead>
  <tbody>
    @foreach ($titulos as $titulo)
    <tr>
      <td>{{ $titulo->estado }}</td>
      <td>{{ ucwords(strtolower($titulo->titulo)) }}</td>
      <td> {{ $titulo->cliente->nome }}</td>
      <td> {{ $titulo->created_at->format('d/m/Y H:i') }}</td>

      <td> {{ $titulo->valor }}</td>
      <td> {{ $titulo->created_at->format('d/m/Y H:i') }}</td>
      <td>  

        @foreach ($titulo->avisos as $aviso)
        @if (isset($aviso))
        <?php 
        switch ($aviso->estado) {
          case 'azul':
          $bootStrapClass = 'primary';
          break;
          case 'verde':
          $bootStrapClass = 'success';
          break;
          case 'amarelo':
          $bootStrapClass = 'warning';
          break;
          case 'vermelho':
          $bootStrapClass = 'danger';
          break;
        }    
        ?>
        <span class="label label-{{ $bootStrapClass }}"><span class="glyphicon glyphicon-envelope" aria-hidden="true"></span></span>
        @endif
        
        @endforeach


      </td>
      <td>
        <a href="/avisos/create" class="btn btn-sm btn-default"> <span class="glyphicon glyphicon-comment" aria-hidden="true"></span> Enviar SMS</a>
        <a class="btn btn-sm btn-default" href="{{ url('titulos/'.$titulo->id) }}"> <span class="glyphicon glyphicon-plus" aria-hidden="true"></span> mais detalhes </a>
      </td>
    </tr>
    @endforeach
  </tbody>

</table>



<script>
  $(function () {
 
    var titulosTotalCanvas = $("#titulosTotal").get(0).getContext("2d"); 
    var titulosTotal = new Chart(titulosTotalCanvas,
    {
      type: 'line',
        data: { 
          labels: ["Janeiro", "Fevereiro", "Março", "Abril", "Maio", "Junho", "Julho"],
          datasets: [{
            label: "Módulo Azul",
            // backgroundColor: '#0275D8',
            borderColor: '#0275D8',
            data: [
              44,
              33,
              10,
              45,
              33,
              10,
              40
            ]
          },{
            label: "Módulo Verde",
            // backgroundColor: '#0275D8',
            borderColor: '#5CB85C',
            data: [
              3,
              14,
              25,
              10,
              24,
              33,
              20
            ]
          },{
            label: "Módulo Amarelo",
            // backgroundColor: '#0275D8',
            borderColor: '#F0BD4E',
            data: [
              0,
              0,
              0,
              0,
              1,
              2,
              6
            ]
          },
          ]
        },
        options: {
          
        }
    });

});
</script>

@endsection
