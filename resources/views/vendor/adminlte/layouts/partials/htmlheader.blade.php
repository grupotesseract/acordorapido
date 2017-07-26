<head>
    <meta charset="UTF-8">
    <title>Acordo Rápido - @yield('htmlheader_title', '') </title>
    <meta content='width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no' name='viewport'>
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <link href="{{ asset('/css/all.css') }}" rel="stylesheet" type="text/css" />

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.6.0/Chart.min.js"></script>
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
    <script src="https://oss.maxcdn.com/html5shiv/3.7.2/html5shiv.min.js"></script>
    <script src="https://oss.maxcdn.com/respond/1.4.2/respond.min.js"></script>
    <![endif]-->

    <script>
        //See https://laracasts.com/discuss/channels/vue/use-trans-in-vuejs
        window.trans = @php
            // copy all translations from /resources/lang/CURRENT_LOCALE/* to global JS variable
            $lang_files = File::files(resource_path() . '/lang/' . App::getLocale());
            $trans = [];
            foreach ($lang_files as $f) {
                $filename = pathinfo($f)['filename'];
                $trans[$filename] = trans($filename);
            }
            $trans['adminlte_lang_message'] = trans('adminlte_lang::message');
            echo json_encode($trans);
        @endphp
    </script>

    <script>
    
        $(document).ready(function(){
           $(".enviarligacao").click(function(){ 
            
             $("#aviso_id").val($(this).data('id'));
             $('#ligacao').modal('show');
           });
        });

        /*function CheckAll(chk)
        {
        for (i = 0; i < chk.length; i++)
            chk[i].checked = true ;
        }*/   

    </script>

    <style>
        .label .glyphicon {
          top: 3px;
      }
    </style>

    <style>        

        .display{
          font-size: 60px;
          padding: 0 !important;
        }
        .display>span{
          font-weight: bold;
        }       
        .well{
          border-radius: 0 !important;
          font-size: 13px !important;
          padding: 0 !important;
        }
        .well_laps{
          padding: 10px !important;
        }

    </style>

    <script>
        $(document).ready(function(){ 

            var vueltas = 0;
            var cron;
            var sv_min = 0;
            var sv_hor = 0;
            var sv_seg = 0;
            var seg = document.getElementById('seg');
            var min = document.getElementById('min');
            var hor = document.getElementById('hor');
            var iniciado = false; //init status of cron

            $("#btn_play").click(function(){
                if(!iniciado){ iniciado = true; start_cron(); }
            });

            function start_cron(){
              cron = setInterval(function(){
                sv_seg++;
                if(sv_seg < 60){
                  if(sv_seg < 10){ seg.innerHTML = "0"+sv_seg; }else{ seg.innerHTML = sv_seg; }
                }else{
                  sv_seg = 0; seg.innerHTML = "00";
                  sv_min++;
                  if(sv_min < 60){
                    if(sv_min < 10){ min.innerHTML = "0"+sv_min; }else{ min.innerHTML = sv_min; }
                  }else{
                    sv_min = 0; min.innerHTML = "00";
                    sv_hor++;
                    if(sv_hor < 10){ hor.innerHTML = "0"+sv_hor; }else{ hor.innerHTML = sv_hor; }
                  }
                }
              }, 1000);
            }

            $("#btn_pause").click(function(){
              clearInterval(cron);
              iniciado = false;
            });

            $("#btn_stop").click(function(){
              sv_min = 0;
              sv_hor = 0;
              sv_seg = 0;
              seg.innerHTML = "00";
              min.innerHTML = "00";
              hor.innerHTML = "00";
              clearInterval(cron);
              iniciado = false;
            });

            $("#btn_lap").click(function(){
              vueltas++;
              consola('<li class="list-group-item"><small>'+vueltas+'</small>     '+hor.innerHTML+":"+min.innerHTML+":"+seg.innerHTML+'</li><input type="hidden" name="tempoligacao" value="'+hor.innerHTML+":"+min.innerHTML+":"+seg.innerHTML+'" />');
            });

            function consola(msg){
              $("#log").prepend(msg);
            }

            $("#btn_clear").click(function(){
              $("#log").html("");
              vueltas = 0;
            });


        });
    </script>
</head>
