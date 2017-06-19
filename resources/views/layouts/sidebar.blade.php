	

	<aside id="sidebar-left" class="sidebar-left">
    
        <div class="sidebar-header">
            <div class="sidebar-title">
                Navigation
            </div>
            <div class="sidebar-toggle hidden-xs" data-toggle-class="sidebar-left-collapsed" data-target="html" data-fire-event="sidebar-left-toggle">
                <i class="fa fa-bars" aria-label="Toggle sidebar"></i>
            </div>
        </div>
        
        <div class="nano">
            <div class="nano-content">
                <nav id="menu" class="nav-main" role="navigation">
                    <ul class="nav nav-main">
                        <li class="nav-active">
                            <a href="{{url('/')}}">
                                <i class="fa fa-home" aria-hidden="true"></i>
                                <span>Principal
                                   
                                </span>
                            </a>
                        </li>

                        @if (Auth::user()->id_rol == 1)

                         <li class="">
                            <a href="{{url('auditoria/listar')}}">
                                <i class="fa fa-key" aria-hidden="true"></i>
                                <span>Auditoria</span>
                            </a>
                        </li>
                                     
                        @endif

                        @if (Auth::user()->id_rol == 3)

                        <li class="">
                            <a href="{{url('proyecto/listar')}}">
                                <i class="fa fa-cube" aria-hidden="true"></i>
                                <span>Proyectos</span>
                            </a>
                        </li>

                        <li class="">
                            <a href="{{url('institucion/listar')}}">
                                <i class="fa fa-university" aria-hidden="true"></i>
                                <span>Instituciones</span>
                            </a>
                        </li>


                        <li class="">
                            <a href="{{url('departamento/listar')}}">
                                <i class="fa fa-archive" aria-hidden="true"></i>
                                <span>Departamentos</span>
                            </a>
                        </li>

                        <li class="">
                            <a href="{{url('laboratorio/listar')}}">
                                <i class="fa fa-flask" aria-hidden="true"></i>
                                <span>Laboratorios</span>
                            </a>
                        </li>

                        <li class="">
                            <a href="{{url('tecnica-estudio/listar')}}">
                                <i class="fa fa-book" aria-hidden="true"></i>
                                <span>Tecnicas de Estudios</span>
                            </a>
                        </li>

                        <li class="">
                            <a href="{{url('tipo-muestra/listar')}}">
                                <i class="fa fa-pencil-square-o" aria-hidden="true"></i>
                                <span>Tipo de Muestra</span>
                            </a>
                        </li>

                        <li class="nav-parent">
                            <a href="#">
                                <i class="fa fa-group " aria-hidden="true"></i>
                                <span>Personas</span>
                            </a>
                            <ul class="nav nav-children">

                                <li>
                                    <a href="{{url('tutor/listar')}}">
                                        Tutor
                                    </a>
                                </li>
                                <li>
                                    <a href="{{url('estudiante/listar')}}">
                                        Estudiante
                                    </a>
                                </li>

                            </ul>
                        </li>

                        <li class="">
                            <a href="{{url('muestra/listar')}}">
                                <i class="fa fa-picture-o" aria-hidden="true"></i>
                                <span>Muestras</span>
                            </a>
                        </li>
                          
                        @endif

                        @if (Auth::user()->id_rol == 2)

                         <!--<li class="">
                            <a href="{{url('auditoria/listar')}}">
                                <i class="fa fa-book" aria-hidden="true"></i>
                                <span>Auditoria</span>
                            </a>
                        </li>-->

                        <li class="">
                            <a href="{{url('usuario/listar')}}">
                                <i class="fa fa-key" aria-hidden="true"></i>
                                <span>Usuarios</span>
                            </a>
                        </li>
                          
                        @endif

                        @if (Auth::user()->id_rol == 4)

                        <li class="">
                            <a href="{{url('visitante/proyecto/listar')}}">
                                <i class="fa fa-cube" aria-hidden="true"></i>
                                <span>Proyectos</span>
                            </a>
                        </li>

                        <li class="">
                            <a href="{{url('visitante/muestra/listar')}}">
                                <i class="fa fa-picture-o" aria-hidden="true"></i>
                                <span>Muestras</span>
                            </a>
                        </li>

                        @endif
                        

                    </ul>
                </nav>
    
                <hr class="separator" />

            </div>
    
        </div>
    
    </aside>