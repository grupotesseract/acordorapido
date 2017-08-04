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
    
    @forelse  ($aviso->avisosenviados->where('tipodeaviso', 1) as $avisoenviado)            
      <span class="label label-{{ $bootStrapClass }}"><span class="glyphicon glyphicon-earphone" aria-hidden="true"></span></span>
    @empty
    @endforelse
  @endif        
@endforeach