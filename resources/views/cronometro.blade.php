@section('main-content')

    
        <div class="well">
          <div class=" display text-center">
            <span id="hor">00</span>:<span id="min">00</span>:<span id="seg">00</span>
          </div>
        </div>
     
        <div class="btn-group btn-group-justified" role="group" aria-label="Justified button group">
          <a  id="btn_play" type="button" class="btn btn-default">
            <span class="glyphicon glyphicon-play" aria-hidden="true"></span>
          </a>
          <a  id="btn_pause" type="button" class="btn btn-default">
            <span class="glyphicon glyphicon-pause" aria-hidden="true"></span>
          </a>
          <a  id="btn_stop" type="button" class="btn btn-default">
            <span class="glyphicon glyphicon-stop" aria-hidden="true"></span>
          </a>
          <a  id="btn_lap" type="button" class="btn btn-default">
            <span class="glyphicon glyphicon-time" aria-hidden="true"></span>
          </a>
        </div>
     
        <br>
        <div class="well well_laps">
          Vueltas:
          <div class="pull-right">
            <a href="javascript:" id="btn_clear"><span class="glyphicon glyphicon-trash"></span> Clear</a>
          </div>
          <hr>
          <div id="log" class="log">
            <ul class="list-group"></ul>
          </div>
        </div>
@endsection
