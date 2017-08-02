<!-- Left side column. contains the logo and sidebar -->
<aside class="main-sidebar">

    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">

        <!-- Sidebar user panel (optional) -->
        @if (! Auth::guest())
            <div class="user-panel">
                <div class="pull-left image">
                    <img src="{{ Gravatar::get($user->email) }}" class="img-circle" alt="User Image" />
                </div>
                <div class="pull-left info">
                    <p>{{ Auth::user()->name }}</p>
                    <!-- Status -->
                    <a href="#"><i class="fa fa-circle text-success"></i> {{ trans('adminlte_lang::message.online') }}</a>
                </div>
            </div>
        @endif

        <!-- Sidebar Menu -->
        <ul class="sidebar-menu">
            <li class="header">{{ trans('adminlte_lang::message.header') }}</li>
            <!-- Optionally, you can add icons to the links -->
            <li class="active"><a href="{{ url('home') }}"><i class='glyphicon glyphicon-home'></i> <span>{{ trans('adminlte_lang::message.home') }}</span></a></li>
            
            @role('admin')
            <li class="treeview">
                <a href="#"><i class='glyphicon glyphicon-th-list'></i> <span>Cadastros</span><i class="fa fa-angle-left pull-right"></i></a>
                <ul class="treeview-menu">
                    <li><a href="{{ url('escolas') }}"><i class='glyphicon glyphicon-education'></i>Escolas</a></li>
                    <li class="treeview">
                        <a href="{{ url('avisospendentes') }}"><i class='glyphicon glyphicon-user'></i><span>Usuários</span><i class="fa fa-angle-left pull-right"></i></a>
                        <ul class="treeview-menu">
                            <li> <a href="{{ url('') }}"><i class='glyphicon glyphicon-user'></i> <span>Operadores</span> </a> </li>
                            <li> <a href="{{ url('') }}"><i class='glyphicon glyphicon-eye-open'></i> <span>Administradores</span> </a></li>
                            <li> <a href="{{ url('escolas') }}"><i class='glyphicon glyphicon-education'></i> <span>Escolas</span></a> </li>
                            <li> <a href="{{ url('') }}"><i class='glyphicon glyphicon-lock'></i> <span>Permissões</span> </a></li>
                        </ul>
                    </li>
                </ul>
            </li>
            <li class="treeview">
                <a href="#"><i class='glyphicon glyphicon-import'></i> <span>Importações</span> <i class="fa fa-angle-left pull-right"></i></a>
                <ul class="treeview-menu">
                    <li><a href="{{url('importacao/azul')}}"><label class="label label-modulo-azul"> <span aria-hidden="true" class="glyphicon glyphicon-envelope"></span></label> Preventiva</a></li>
                    <li><a href="{{url('importacao/verde')}}"><label class="label label-modulo-verde"> <span aria-hidden="true" class="glyphicon glyphicon-earphone"></span></label> Recuperação</a></li>
                    <li><a href="{{url('importacao/amarelo')}}"><label class="label label-modulo-amarelo"> <span aria-hidden="true" class="glyphicon glyphicon-phone-alt"></span></label> Intensivo</a></li>
                    <li><a href="{{url('importacao/vermelho')}}"><label class="label label-modulo-vermelho"> <span aria-hidden="true" class="glyphicon glyphicon-alert"></span></label> Cobrança</a></li>
                </ul>
            </li>
            <li class="treeview">
                <a href="#"><i class='glyphicon glyphicon-th-large'></i> <span>Módulos</span> <i class="fa fa-angle-left pull-right"></i></a>
                <ul class="treeview-menu">
                    <li><a href="{{url('titulos/modulo/azul')}}"><label class="label label-modulo-azul"> <span aria-hidden="true" class="glyphicon glyphicon-envelope"></span></label> Prevenção</a></li>
                    <li><a href="{{url('titulos/modulo/verde')}}"><label class="label label-modulo-verde"> <span aria-hidden="true" class="glyphicon glyphicon-earphone"></span></label> Recuperação</a></li>
                    <li><a href="{{url('titulos/modulo/amarelo')}}"><label class="label label-modulo-amarelo"> <span aria-hidden="true" class="glyphicon glyphicon-phone-alt"></span></label> Intensivo</a></li>
                    <li><a href="{{url('titulos/modulo/vermelho')}}"><label class="label label-modulo-vermelho"> <span aria-hidden="true" class="glyphicon glyphicon-alert"></span></label> Cobrança</a></li>
                    
                </ul>
            </li>
            <li class="treeview">
                <a href="#"><i class='glyphicon glyphicon-comment'></i> <span>Avisos</span><i class="fa fa-angle-left pull-right"></i></a>
                <ul class="treeview-menu">
                    <li><a href="{{ url('avisos') }}">Avisos</a></li>
                    <li><a href="{{ url('avisospendentes') }}">Avisos Pendentes</a></li>
                    <li><a href="{{ url('avisomodelos') }}">Modelos de Avisos</a></li>

                    <li><a href="{{ url('avisos/create') }}">Enviar SMS para um Número</a></li>
                </ul>
            </li>
            @endrole
            <!-- <li>
                <a href="{{ url('titulos') }}"><i class='glyphicon glyphicon-list-alt'></i> <span>Títulos</span></a>
            </li> -->
            @role('admin')
            <li>
                <a href="{{ url('alunos') }}"><i class='glyphicon glyphicon-user'></i> <span>Alunos</span></a>
            </li>
            @endrole
            @role('escola')
            <li>
                <a href="{{ url('alunos/2') }}"><i class='glyphicon glyphicon-user'></i> <span>Alunos</span></a>
            </li>
            @endrole
        </ul><!-- /.sidebar-menu -->
    </section>
    <!-- /.sidebar -->
</aside>
