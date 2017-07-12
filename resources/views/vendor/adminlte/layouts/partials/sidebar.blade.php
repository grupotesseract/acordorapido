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
                <a href="#"><i class='glyphicon glyphicon-comment'></i> <span>Avisos</span><i class="fa fa-angle-left pull-right"></i></a>
                <ul class="treeview-menu">
                    <li><a href="{{ url('avisos') }}">Avisos</a></li>
                    <li><a href="{{ url('avisospendentes') }}">Avisos Pendentes</a></li>
                    <li><a href="{{ url('avisomodelos') }}">Modelos de Avisos</a></li>

                    <li><a href="{{ url('avisos/create') }}">Enviar SMS para um Número</a></li>
                </ul>
            </li>
            <li class="treeview">
                <a href="#"><i class='glyphicon glyphicon-import'></i> <span>Importações</span> <i class="fa fa-angle-left pull-right"></i></a>
                <ul class="treeview-menu">
                    <li><a href="{{url('importacao/azul')}}">Módulo Azul</a></li>
                    <li><a href="{{url('importacao/verde')}}">Importação dos Pagantes</a></li>
                    <li><a href="{{url('importacao/amarelo')}}">Módulo Amarelo</a></li>
                    <li><a href="{{url('importacao/vermelho')}}">Módulo Vermelho</a></li>
                    
                </ul>
            </li>
            @endrole
            <li>
                <a href="{{ url('titulos') }}"><i class='glyphicon glyphicon-list-alt'></i> <span>Títulos</span></a>
            </li>
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
            @role('admin')
            <li>
                <a href="{{ url('escolas') }}"><i class='glyphicon glyphicon-education'></i> <span>Escolas</span></a>
            </li>
<!--             <li class="treeview">
                <a href="#"><i class='glyphicon glyphicon-stats'></i> <span>Relatórios</span> <i class="fa fa-angle-left pull-right"></i></a>
                <ul class="treeview-menu">
                    <li><a href="#">por Alunos</a></li>
                    <li><a href="#">por Empresas</a></li>
                </ul>
            </li>
 -->            
            @endrole
        </ul><!-- /.sidebar-menu -->
    </section>
    <!-- /.sidebar -->
</aside>
