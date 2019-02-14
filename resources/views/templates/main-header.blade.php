
<!-- Begin Main Header -->
        <header class="main-header">
            <nav class="navbar navbar-static-top">
                <div class="container">
                    <div class="navbar-header">
                        <a href="/" class="navbar-brand"><b>A.G.E</b></a>
                        <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar-collapse">
                            <i class="fa fa-bars"></i>
                        </button>
                    </div>

                    <!-- Collect the nav links, forms, and other content for toggling -->
                    <div class="collapse navbar-collapse pull-left" id="navbar-collapse">
                        <ul class="nav navbar-nav">                            
                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-cog" aria-hidden="true"></i> Configuración <span class="caret"></span></a>
                                <ul class="dropdown-menu" role="menu">
                                    <li><a href="{{route('empresa')}}"><i class="fa fa-caret-right text-green" aria-hidden="true"></i> Empresa</a></li>
                                    <li class="divider"></li>
                                    <li><a href="{{route('escuelas')}}"><i class="fa fa-caret-right text-green" aria-hidden="true"></i> Escuelas</a></li>
                                    <li class="divider"></li>
                                    <li><a href="{{route('ciclos')}}"><i class="fa fa-caret-right text-green" aria-hidden="true"></i> Ciclos</a></li>
                                    <li class="divider"></li>
                                    <li><a href="{{route('clasificaciones')}}"><i class="fa fa-caret-right text-green" aria-hidden="true"></i> Clasificación</a></li>
                                    <li class="divider"></li>
                                    <li><a href="{{route('grupos')}}"><i class="fa fa-caret-right text-green" aria-hidden="true"></i> Grupos</a></li>
                                    <li class="divider"></li>
                                    <li><a href="{{route('cuotasdeinscripcion')}}"><i class="fa fa-caret-right text-green" aria-hidden="true"></i> Cuotas de Inscripción</a></li>
                                    <li class="divider"></li>
                                    <li><a href="{{route('cuotasdecolegiatura')}}"><i class="fa fa-caret-right text-green" aria-hidden="true"></i> Cuotas de Colegiatura</a></li>
                                    <li class="divider"></li>
                                </ul>
                            </li>

                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-graduation-cap" aria-hidden="true"></i> Alumnos <span class="caret"></span></a>
                                <ul class="dropdown-menu" role="menu">
                                    <li><a href="{{route('nuevo_alumno_index')}}"><i class="fa fa-caret-right text-orange" aria-hidden="true"></i> Agregar Nuevo Alumno</a></li>
                                    <li class="divider"></li>
                                    <li><a href="{{route('nuevo_tutor_create')}}"><i class="fa fa-caret-right text-orange" aria-hidden="true"></i> Agregar Nuevo Tutor</a></li>
                                    <li class="divider"></li>
                                    <li><a href="{{route('asignar_tutor_elegirtutor')}}"><i class="fa fa-caret-right text-orange" aria-hidden="true"></i> Asignar Tutor - Alumno</a></li>
                                    <li class="divider"></li>
                                    <li><a href="{{route('grupo_alumno_elegiralumno')}}"><i class="fa fa-caret-right text-orange" aria-hidden="true"></i> Asignar Grupo - Alumno</a></li>
                                    <li class="divider"></li>
                                    <li><a href="{{route('grupo_alumno_cambiogrupo')}}"><i class="fa fa-caret-right text-orange" aria-hidden="true"></i> Cambio de Grupo</a></li>
                                    <li class="divider"></li>

                                </ul>
                            </li>

                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-print" aria-hidden="true"></i> Impresiones <span class="caret"></span></a>
                                <ul class="dropdown-menu" role="menu">
                                    <li><a href="{{route('impr_hojainscrip_index')}}"><i class="fa fa-caret-right text-orange" aria-hidden="true"></i> Hoja de Inscripción</a></li>
                                    <li class="divider"></li>
                                    <li><a href="{{route("impr_rec_inscrip_index")}}"><i class="fa fa-caret-right text-orange" aria-hidden="true"></i> Recibo de Inscripción</a></li>
                                    <li><a href="{{route("impr_rec_coleg_index")}}"><i class="fa fa-caret-right text-orange" aria-hidden="true"></i> Recibo de Colegiatura</a></li>
                                    <li><a href="{{route("impr_rec_venta_index")}}"><i class="fa fa-caret-right text-orange" aria-hidden="true"></i> Recibo de Venta</a></li>
                                    <li class="divider"></li>
                                    <li><a href="{{route('reporte_pago_inscrip_index')}}"><i class="fa fa-caret-right text-orange" aria-hidden="true"></i> Reporte de Pagos de Inscripción</a></li>
                                    <li><a href="{{route('reporte_pago_coleg_index')}}"><i class="fa fa-caret-right text-orange" aria-hidden="true"></i> Reporte de Pagos de Colegiatura</a></li>
                                    <li><a href="{{route('reporte_venta_diario')}}"><i class="fa fa-caret-right text-orange" aria-hidden="true"></i> Reporte Venta Libros y Playeras</a></li>
                                    <li class="divider"></li>
                                    <li><a href="{{route('kardex_productos_index')}}"><i class="fa fa-caret-right text-orange" aria-hidden="true"></i> Kardex de Productos</a></li>
                                    <li class="divider"></li>
                                    <li><a href="{{route('impr_lista_asist_index')}}"><i class="fa fa-caret-right text-orange" aria-hidden="true"></i> Listas de Asistencia</a></li>
                                    <li class="divider"></li>
                                    <li><a href="{{route('alumnos_deudores_index')}}"><i class="fa fa-caret-right text-orange" aria-hidden="true"></i> Alumnos Deudores</a></li>
                                </ul>
                            </li>


                            <li>
                                <a href="{{route('pago_colegiatura_index')}}" class="bt btn-primary">
                                    <i class="fa fa-money" aria-hidden="true"></i>&nbsp;
                                    Pago de colegiatura
                                </a>
                            </li>

                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown"> <i class="fa fa-shopping-cart" aria-hidden="true"></i>&nbsp; Ventas <span class="caret"></span></a>
                                <ul class="dropdown-menu" role="menu">
                                    <li><a href="{{route('nueva_venta')}}"><i class="fa fa-caret-right text-orange" aria-hidden="true"></i> Libros y Playeras</a></li>
                                    <li class="divider"></li>
                                    <li><a href="{{route('cancelar_venta_index')}}"><i class="fa fa-caret-right text-orange" aria-hidden="true"></i> Cancelar Recibo de Venta</a></li>
                                    <li class="divider"></li>
                                </ul>
                            </li>

                        </ul>
                        
                    </div>
                    <!-- /.navbar-collapse -->
                    <!-- Navbar Right Menu -->
                    <div class="navbar-custom-menu">
                        <ul class="nav navbar-nav">
                            <li class="dropdown">
                                <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-user-circle-o fa-lg" aria-hidden="true"></i>
                                    &nbsp;&nbsp;{{ Auth::user()->name }} <span class="caret"></span></a>
                                <ul class="dropdown-menu" role="menu">
                                    <li><a href="#"><i class="fa fa-user-o text-red" aria-hidden="true"></i> Mi Cuenta</a></li>
                                    <li class="divider"></li>
                                    <li>
                                        <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                            <i class="fa fa-power-off text-red" aria-hidden="true"></i>
                                            Cerrar Sesión
                                        </a>

                                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                            {{ csrf_field() }}
                                        </form>

                                    </li>
                                    <li class="divider"></li>
                                </ul>
                            </li>
                        </ul>
                    </div>
                    <!-- /.navbar-custom-menu -->
                </div>
                <!-- /.container-fluid -->
            </nav>
        </header>
        <!-- /.End Main Header -->