@inject('request', 'Illuminate\Http\Request')
<!-- Left side column. contains the sidebar -->
<aside class="main-sidebar" style="background:#B4045F;">
    <!-- sidebar: style can be found in sidebar.less -->
    <section class="sidebar">
        <ul class="sidebar-menu">

            <li class="{{ $request->segment(1) == 'home' ? 'active' : '' }}">
                <a href="{{ url('/') }}">
                    <i class="fa fa-wrench"></i>
                    <span class="title">@lang('global.app_dashboard')</span>
                </a>
            </li>
            
            @can('users_manage')
             <li class="treeview">
                <a href="#">
                    <i class="fa fa-archive"></i>
                    <span class="title">@lang('global.archivos.title')</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">

                    <li class="{{ $request->segment(2) == 'clientes' ? 'active active-sub' : '' }}">
                        <a href="{{ route('admin.clientes.index') }}">
                            <i class="fa fa-briefcase"></i>
                            <span class="title">
                                Clientes
                            </span>
                        </a>
                    </li>
               
                </ul>

                 <ul class="treeview-menu">

                    <li class="{{ $request->segment(2) == 'eventos' ? 'active active-sub' : '' }}">
                        <a href="{{ route('admin.eventos.index') }}">
                            <i class="fa fa-briefcase"></i>
                            <span class="title">
                                Eventos
                            </span>
                        </a>
                    </li>
               
                </ul>
            </li>


                <li class="treeview">
                <a href="#">
                    <i class="fa fa-archive"></i>
                    <span class="title"> Clientes Para Llamar</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">

                    <li class="{{ $request->segment(2) == 'llamados' ? 'active active-sub' : '' }}">
                        <a href="{{ route('admin.clientes.index1') }}">
                            <i class="fa fa-briefcase"></i>
                            <span class="title">
                                Listado de Clientes
                            </span>
                        </a>
                    </li>
               
                </ul>

                 <ul class="treeview-menu">

                    <li class="{{ $request->segment(2) == 'llamados' ? 'active active-sub' : '' }}">
                        <a href="{{ route('admin.llamados.index1') }}">
                            <i class="fa fa-briefcase"></i>
                            <span class="title">
                                Listado a Llamar
                            </span>
                        </a>
                    </li>
               
                </ul>
                <ul class="treeview-menu">

                    <li class="{{ $request->segment(2) == 'llamados' ? 'active active-sub' : '' }}">
                        <a href="{{ route('admin.llamados.index') }}">
                            <i class="fa fa-briefcase"></i>
                            <span class="title">
                                Clientes Llamados
                            </span>
                        </a>
                    </li>
               
                </ul>

            </li>


                <li class="treeview">
                <a href="#">
                    <i class="fa fa-archive"></i>
                    <span class="title"> Clientes Para Confirmar</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">

                    <li class="{{ $request->segment(2) == 'confirmar' ? 'active active-sub' : '' }}">
                        <a href="{{ route('admin.confirmar.index') }}">
                            <i class="fa fa-briefcase"></i>
                            <span class="title">
                                Listado
                            </span>
                        </a>
                    </li>
               
                </ul>

            </li>


                <li class="treeview">
                <a href="#">
                    <i class="fa fa-archive"></i>
                    <span class="title"> Clientes Confirmados</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">

                    <li class="{{ $request->segment(2) == 'confirmar' ? 'active active-sub' : '' }}">
                        <a href="{{ route('admin.confirmar.index1') }}">
                            <i class="fa fa-briefcase"></i>
                            <span class="title">
                                Listado
                            </span>
                        </a>
                    </li>
               
                </ul>

            </li>

               <li class="treeview">
                <a href="#">
                    <i class="fa fa-archive"></i>
                    <span class="title"> Listado de Asistencia</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">

                    <li class="{{ $request->segment(2) == 'asistencia' ? 'active active-sub' : '' }}">
                        <a href="{{ route('admin.asistencia.index') }}">
                            <i class="fa fa-briefcase"></i>
                            <span class="title">
                                Registrar
                            </span>
                        </a>
                    </li>
               
                </ul>

            </li>


                <li class="treeview">
                <a href="#">
                    <i class="fa fa-archive"></i>
                    <span class="title"> Registrar Pagos</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">

                    <li class="{{ $request->segment(2) == 'pagos' ? 'active active-sub' : '' }}">
                        <a href="{{ route('admin.pagos.index') }}">
                            <i class="fa fa-briefcase"></i>
                            <span class="title">
                                Listado
                            </span>
                        </a>
                    </li>
               
                </ul>

            </li>

              <li class="treeview">
                <a href="#">
                    <i class="fa fa-archive"></i>
                    <span class="title"> Reportes</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>

                  <ul class="treeview-menu">

                    <li class="{{ $request->segment(2) == 'reportes' ? 'active active-sub' : '' }}">
                        <a href="{{ route('index.llamadas') }}">
                            <i class="fa fa-briefcase"></i>
                            <span class="title">
                                Mensual de Llamadas
                            </span>
                        </a>
                    </li>
               
                </ul>
                <ul class="treeview-menu">

                    <li class="{{ $request->segment(2) == 'pagos' ? 'active active-sub' : '' }}">
                        <a href="{{ route('index.ingresos') }}">
                            <i class="fa fa-briefcase"></i>
                            <span class="title">
                                Mensual de Ingresos
                            </span>
                        </a>
                    </li>
               
                </ul>

                  <ul class="treeview-menu">

                    <li class="{{ $request->segment(2) == 'pagos' ? 'active active-sub' : '' }}">
                        <a href="{{ route('index.asistentes') }}">
                            <i class="fa fa-briefcase"></i>
                            <span class="title">
                                Mensual de Asistentes
                            </span>
                        </a>
                    </li>
               
                </ul>

            </li>

   
            
            @endcan

            @can('users_admin')
             <li class="treeview">
                <a href="#">
                    <i class="fa fa-archive"></i>
                    <span class="title">@lang('global.archivos.title')</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">

                    <li class="{{ $request->segment(2) == 'clientes' ? 'active active-sub' : '' }}">
                        <a href="{{ route('admin.clientes.index') }}">
                            <i class="fa fa-briefcase"></i>
                            <span class="title">
                                Clientes
                            </span>
                        </a>
                    </li>
               
                </ul>

                 <ul class="treeview-menu">

                    <li class="{{ $request->segment(2) == 'eventos' ? 'active active-sub' : '' }}">
                        <a href="{{ route('admin.eventos.index') }}">
                            <i class="fa fa-briefcase"></i>
                            <span class="title">
                                Eventos
                            </span>
                        </a>
                    </li>
               
                </ul>
            </li>


                <li class="treeview">
                <a href="#">
                    <i class="fa fa-archive"></i>
                    <span class="title"> Clientes Para Llamar</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">

                    <li class="{{ $request->segment(2) == 'llamados' ? 'active active-sub' : '' }}">
                        <a href="{{ route('admin.clientes.index1') }}">
                            <i class="fa fa-briefcase"></i>
                            <span class="title">
                                Listado de Clientes
                            </span>
                        </a>
                    </li>
               
                </ul>

                 <ul class="treeview-menu">

                    <li class="{{ $request->segment(2) == 'llamados' ? 'active active-sub' : '' }}">
                        <a href="{{ route('admin.llamados.index1') }}">
                            <i class="fa fa-briefcase"></i>
                            <span class="title">
                                Listado a Llamar
                            </span>
                        </a>
                    </li>
               
                </ul>
                <ul class="treeview-menu">

                    <li class="{{ $request->segment(2) == 'llamados' ? 'active active-sub' : '' }}">
                        <a href="{{ route('admin.llamados.index') }}">
                            <i class="fa fa-briefcase"></i>
                            <span class="title">
                                Clientes Llamados
                            </span>
                        </a>
                    </li>
               
                </ul>

            </li>


                <li class="treeview">
                <a href="#">
                    <i class="fa fa-archive"></i>
                    <span class="title"> Clientes Para Confirmar</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">

                    <li class="{{ $request->segment(2) == 'confirmar' ? 'active active-sub' : '' }}">
                        <a href="{{ route('admin.confirmar.index') }}">
                            <i class="fa fa-briefcase"></i>
                            <span class="title">
                                Listado
                            </span>
                        </a>
                    </li>
               
                </ul>

            </li>


                <li class="treeview">
                <a href="#">
                    <i class="fa fa-archive"></i>
                    <span class="title"> Clientes Confirmados</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">

                    <li class="{{ $request->segment(2) == 'confirmar' ? 'active active-sub' : '' }}">
                        <a href="{{ route('admin.confirmar.index1') }}">
                            <i class="fa fa-briefcase"></i>
                            <span class="title">
                                Listado
                            </span>
                        </a>
                    </li>
               
                </ul>

            </li>

               <li class="treeview">
                <a href="#">
                    <i class="fa fa-archive"></i>
                    <span class="title"> Listado de Asistencia</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">

                    <li class="{{ $request->segment(2) == 'asistencia' ? 'active active-sub' : '' }}">
                        <a href="{{ route('admin.asistencia.index') }}">
                            <i class="fa fa-briefcase"></i>
                            <span class="title">
                                Registrar
                            </span>
                        </a>
                    </li>
               
                </ul>

            </li>


                <li class="treeview">
                <a href="#">
                    <i class="fa fa-archive"></i>
                    <span class="title"> Registrar Pagos</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">

                    <li class="{{ $request->segment(2) == 'pagos' ? 'active active-sub' : '' }}">
                        <a href="{{ route('admin.pagos.index') }}">
                            <i class="fa fa-briefcase"></i>
                            <span class="title">
                                Listado
                            </span>
                        </a>
                    </li>
               
                </ul>

            </li>

              <li class="treeview">
                <a href="#">
                    <i class="fa fa-archive"></i>
                    <span class="title"> Reportes</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>

                  <ul class="treeview-menu">

                    <li class="{{ $request->segment(2) == 'reportes' ? 'active active-sub' : '' }}">
                        <a href="{{ route('index.llamadas') }}">
                            <i class="fa fa-briefcase"></i>
                            <span class="title">
                                Mensual de Llamadas
                            </span>
                        </a>
                    </li>
               
                </ul>
                <ul class="treeview-menu">

                    <li class="{{ $request->segment(2) == 'pagos' ? 'active active-sub' : '' }}">
                        <a href="{{ route('index.ingresos') }}">
                            <i class="fa fa-briefcase"></i>
                            <span class="title">
                                Mensual de Ingresos
                            </span>
                        </a>
                    </li>
               
                </ul>

                  <ul class="treeview-menu">

                    <li class="{{ $request->segment(2) == 'pagos' ? 'active active-sub' : '' }}">
                        <a href="{{ route('index.asistentes') }}">
                            <i class="fa fa-briefcase"></i>
                            <span class="title">
                                Mensual de Asistentes
                            </span>
                        </a>
                    </li>
               
                </ul>

            </li>

            <li class="treeview">
                <a href="#">
                    <i class="fa fa-users"></i>
                    <span class="title">@lang('global.user-management.title')</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">

                    <li class="{{ $request->segment(2) == 'abilities' ? 'active active-sub' : '' }}">
                        <a href="{{ route('admin.abilities.index') }}">
                            <i class="fa fa-briefcase"></i>
                            <span class="title">
                                @lang('global.abilities.title')
                            </span>
                        </a>
                    </li>
                    <li class="{{ $request->segment(2) == 'roles' ? 'active active-sub' : '' }}">
                        <a href="{{ route('admin.roles.index') }}">
                            <i class="fa fa-briefcase"></i>
                            <span class="title">
                                @lang('global.roles.title')
                            </span>
                        </a>
                    </li>
                    <li class="{{ $request->segment(2) == 'users' ? 'active active-sub' : '' }}">
                        <a href="{{ route('admin.users.index') }}">
                            <i class="fa fa-user"></i>
                            <span class="title">
                                @lang('global.users.title')
                            </span>
                        </a>
                    </li>
               
                </ul>
            </li>

            @endcan

              @can('users_soloclientes')
             <li class="treeview">
                <a href="#">
                    <i class="fa fa-archive"></i>
                    <span class="title">@lang('global.archivos.title')</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">

                    <li class="{{ $request->segment(2) == 'clientes' ? 'active active-sub' : '' }}">
                        <a href="{{ route('admin.clientes.index') }}">
                            <i class="fa fa-briefcase"></i>
                            <span class="title">
                                Clientes
                            </span>
                        </a>
                    </li>
               
                </ul>

            </li>


                <li class="treeview">
                <a href="#">
                    <i class="fa fa-archive"></i>
                    <span class="title"> Clientes Para Llamar</span>
                    <span class="pull-right-container">
                        <i class="fa fa-angle-left pull-right"></i>
                    </span>
                </a>
                <ul class="treeview-menu">

                    <li class="{{ $request->segment(2) == 'llamados' ? 'active active-sub' : '' }}">
                        <a href="{{ route('admin.clientes.index1') }}">
                            <i class="fa fa-briefcase"></i>
                            <span class="title">
                                Listado de Clientes
                            </span>
                        </a>
                    </li>
               
                </ul>

            </li>


              
            </li>

            @endcan


           

            <li class="{{ $request->segment(1) == 'change_password' ? 'active' : '' }}">
                <a href="{{ route('auth.change_password') }}">
                    <i class="fa fa-key"></i>
                    <span class="title">Modificar Contraseña</span>
                </a>
            </li>

            <li>
                <a href="#logout" onclick="$('#logout').submit();">
                    <i class="fa fa-arrow-left"></i>
                    <span class="title">@lang('global.app_logout')</span>
                </a>
            </li>
        </ul>
    </section>
</aside>
{!! Form::open(['route' => 'auth.logout', 'style' => 'display:none;', 'id' => 'logout']) !!}
<button type="submit">@lang('global.logout')</button>
{!! Form::close() !!}
