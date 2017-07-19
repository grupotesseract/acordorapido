@extends('adminlte::layouts.app')

@section('htmlheader_title', 'Títulos')

@section('contentheader_title', $escola->nome.': '.count($titulos).' títulos importados em '.$importacao->created_at->format('d/m/Y H:i') )

@section('main-content')
<table class="table table-striped table-hovered">
  <thead>
    <tr>
      <th>Módulo</th>
      <th>Número</th>
      <th>Cliente</th>
      <th>Vencimento</th>
      <th>Valor</th>
      <th>Importado em</th>
      <th>Ações Tomadas</th>
      <th></th>
    </tr>
  </thead>
  <tbody>
    @foreach ($titulos as $titulo)
    <tr>
      <td>{{ ucfirst($titulo->estado) }}</td>
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
            @forelse  ($aviso->avisosenviados->where('tipodeaviso', 0) as $avisoenviado)            
              <span class="label label-{{ $bootStrapClass }}"><span class="glyphicon glyphicon-envelope" aria-hidden="true"></span></span>
            @empty
            @endforelse
          @endif

        
        @endforeach


      </td>
      <td>
      <!-- <a href="/avisos/create" class="btn btn-sm btn-default"> <span class="glyphicon glyphicon-comment" aria-hidden="true"></span> Enviar SMS</a> -->
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
