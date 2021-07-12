 <aside class="left-sidebar">
            <!-- Sidebar scroll-->
            <div class="scroll-sidebar">
                @if (1 > 2)
                <!-- User Profile-->
                <div class="user-profile">
                    <div class="user-pro-body">
                        <div>
                            <img src="../assets/images/users/2.jpg" alt="user-img" class="img-circle">
                        </div>
                        <div class="dropdown">
                            <a href="javascript:void(0)" class="u-dropdown link hide-menu" data-toggle="dropdown" role="button" aria-haspopup="true" aria-expanded="false">{{ Auth::user()->name }} {{ Auth::user()->lastname }}
                                <span>{{ Auth::user()->nombre }}</span> <span> {{ Auth::user()->apellido }} </span> <span class="fa fa-caret-down"></span>
                            </a>
                            <div class="dropdown-menu animated flipInY">
                                <!-- text-->
                                <a href="{{ route('perfil') }}"" class="dropdown-item"><i class="ti-user"></i><span class="hide-menu"> Perfil</span></a>
                                <!-- text-->
                                <div class="dropdown-divider"></div>
                                <!-- text-->
                                <a href="{{ route('logout') }}" class="dropdown-item"><i class="fa fa-power-off"></i> Logout</a>
                                <!-- text-->
                            </div>
                        </div>
                    </div>
                </div>
                @endif
                <!-- Sidebar navigation-->
                <nav class="sidebar-nav">
                    <ul id="sidebarnav">
                        <li class="nav-small-cap">--- OPCIONES</li>
                        @if(Auth::user()->role->name == 'admin')
                            <li> <a class="has-arrow waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false"><i class="ti-settings"></i><span class="hide-menu">Configurar</span></a>
                                <ul aria-expanded="false" class="collapse">
                                    <li><a href="{{ route('pnf') }}">PNF</a></li>
                                    <li><a href="{{ route('disciplinas') }}">Disciplinas</a></li>
                                    <li><a href="{{ route('categorias') }}">Categorías</a></li>
                                    <li><a href="{{ route('usuarios') }}">Usuarios</a></li>
                                </ul>
                            </li>
                        @endif
                        
                        <li> <a class="waves-effect waves-dark" href="{{ route('atletas') }}"><i class="ti-basketball"></i><span class="hide-menu">Atletas</span></a>
                        </li>
                        
                        <li> <a class="waves-effect waves-dark" href="{{ route('perfil') }}"><i class="ti-user"></i><span class="hide-menu">Perfil</span></a>
                        </li>

                        @if(Auth::user()->role->name == 'admin')
                        <li> <a class="waves-effect waves-dark" href="{{ route('eventos') }}"><i class="ti-calendar"></i><span class="hide-menu">Eventos</span></a>
                        </li>
                        
                        <li> <a class="has-arrow waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false"><i class="icon-speedometer"></i><span class="hide-menu">Constancia</span></a>
                            <ul aria-expanded="false" class="collapse">
                                <li><a href="{{ route('constancia.acreditacion') }}">Acreditación</a></li>
                                <li><a href="{{ route('constancia.participacion') }}">Participación</a></li>
                            </ul>
                        </li>

                        <li> <a class="waves-effect waves-dark" href="{{ route('bitacoras') }}"><i class="ti-book"></i><span class="hide-menu">Bitacora</span></a>
                        </li>
                        @endif

                        <li class="nav-small-cap">--- AYUDA</li>
                        @if(Auth::user()->role->name == 'admin')
                            <li> <a class="has-arrow waves-effect waves-dark" href="javascript:void(0)" aria-expanded="false"><i class="ti-book"></i><span class="hide-menu">Documentación</span></a>
                                <ul aria-expanded="false" class="collapse">
                                    <li><a href="/manual-usuario">Manual de Usuario</a></li>
                                    {{-- <li><a href="#">Manual de sistema</a></li> --}}
                                </ul>
                            </li>
                        @endif

                        <li> <a class="waves-effect waves-dark" href="{{ route('logout') }}" aria-expanded="false"><i class="fa fa-circle-o text-danger"></i><span class="hide-menu">Salir</span></a></li>
                    </ul>
                </nav>
                <!-- End Sidebar navigation -->
            </div>
            <!-- End Sidebar scroll-->
        </aside>