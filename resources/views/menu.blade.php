    <header class="main-header">
        <nav class="navbar navbar-static-top">
            <div class="container">
                <div class="navbar-header">
                    <a href="#" class="navbar-brand"><b>A.G.E</b></a>
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
                                <li><a href="{{route('organizacion')}}"><i class="fa fa-caret-right text-green" aria-hidden="true"></i> Organización</a></li>
                                <li><a href="#"><i class="fa fa-caret-right text-green" aria-hidden="true"></i> Niveles</a></li>
                                <li><a href="#"><i class="fa fa-caret-right text-green" aria-hidden="true"></i> Escuelas</a></li>
                                <li><a href="#"><i class="fa fa-caret-right text-green" aria-hidden="true"></i> Ciclos</a></li>
                                <li><a href="#"><i class="fa fa-caret-right text-green" aria-hidden="true"></i> Clasificación</a></li>
                                <li><a href="#"><i class="fa fa-caret-right text-green" aria-hidden="true"></i> Grupos</a></li>
                                <li class="divider"></li>
                            </ul>
                        </li>

                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-graduation-cap" aria-hidden="true"></i> Alumnos <span class="caret"></span></a>
                            <ul class="dropdown-menu" role="menu">
                                <li><a href="#"><i class="fa fa-caret-right text-orange" aria-hidden="true"></i> Nueva Inscripción</a></li>
                                <li><a href="#"><i class="fa fa-caret-right text-orange" aria-hidden="true"></i> Re-Inscripcion</a></li>
                                <li><a href="#"><i class="fa fa-caret-right text-orange" aria-hidden="true"></i> Datos del Alumno</a></li>
                                <li><a href="#"><i class="fa fa-caret-right text-orange" aria-hidden="true"></i> Asignación de Grupo</a></li>
                                <li><a href="#"><i class="fa fa-caret-right text-orange" aria-hidden="true"></i> Cambio de Grupo</a></li>
                                <li><a href="#"><i class="fa fa-caret-right text-orange" aria-hidden="true"></i> Baja de Alumno</a></li>
                                <li><a href="#"><i class="fa fa-caret-right text-orange" aria-hidden="true"></i> Recuperar Alumno</a></li>
                                <li class="divider"></li>

                            </ul>
                        </li>

                        <li class="dropdown">
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-money" aria-hidden="true"></i> Pagos <span class="caret"></span></a>
                            <ul class="dropdown-menu" role="menu">
                                <li><a href="#"><i class="fa fa-caret-right text-red" aria-hidden="true"></i> Pago de Inscripción</a></li>
                                <li><a href="#"><i class="fa fa-caret-right text-red" aria-hidden="true"></i> Pago de colegiatura</a></li>
                                <li class="divider"></li>
                            </ul>
                        </li>

                    </ul>
                </div>
                <!-- /.navbar-collapse -->
                <!-- Navbar Right Menu -->
                <div class="navbar-custom-menu">
                    <ul class="nav navbar-nav">

                        <!-- User Account Menu -->
                        <li class="dropdown user user-menu">
                            <!-- Menu Toggle Button -->
                            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
                                <!-- The user image in the navbar-->
                                <img src="{{asset('adminlte/img/user2-160x160.jpg')}}" class="user-image" alt="User Image">
                                <!-- hidden-xs hides the username on small devices so only the image appears. -->
                                <span class="hidden-xs">Alexander Pierce</span>
                            </a>
                            <ul class="dropdown-menu">
                                <!-- The user image in the menu -->
                                <li class="user-header">
                                    <img src="{{asset('adminlte/img/user2-160x160.jpg')}}" class="img-circle" alt="User Image">

                                    <p>
                                        Alexander Pierce - Web Developer
                                        <small>Member since Nov. 2012</small>
                                    </p>
                                </li>
                                <!-- Menu Body -->
                                <li class="user-body">
                                    <div class="row">
                                        <div class="col-xs-4 text-center">
                                            <a href="#">Followers</a>
                                        </div>
                                        <div class="col-xs-4 text-center">
                                            <a href="#">Sales</a>
                                        </div>
                                        <div class="col-xs-4 text-center">
                                            <a href="#">Friends</a>
                                        </div>
                                    </div>
                                    <!-- /.row -->
                                </li>
                                <!-- Menu Footer-->
                                <li class="user-footer">
                                    <div class="pull-left">
                                        <a href="#" class="btn btn-default btn-flat">Profile</a>
                                    </div>
                                    <div class="pull-right">
                                        <a href="#" class="btn btn-default btn-flat">Sign out</a>
                                    </div>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </div>
                <!-- /.navbar-custom-menu -->
            </div>
            <!-- /.container-fluid -->
        </nav>
    </header>