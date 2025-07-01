<!-- START - Mobile Menu -->
<div class="menu-mobile menu-activated-on-click color-scheme-dark">
    <div class="mm-logo-buttons-w">
        <a class="mm-logo" href="{{route('traducciones')}}">
            <img src="{{ asset('front/img/logo-cinpasa-negative.svg') }}"  alt="LIASA">
        </a>
        <div class="mm-buttons">
            <div class="mobile-menu-trigger">
                <div class="os-icon os-icon-hamburger-menu-1"> </div>
            </div>
        </div>
    </div>
    <div class="menu-and-user">
        <div class="logged-user-w">
            <div class="avatar-w">
                <img alt="" src="{{asset('back/images/avatar-user-profile-no-photo.png')}}">
            </div>
            <div class="logged-user-info-w">
                <div class="logged-user-name">{{auth()->user()->name}}</div>
                <div class="logged-user-role">{{auth()->user()->role->name}}</div>
            </div>
        </div>
        <!--------------------
            START - Mobile Menu List
            -------------------->
            <ul class="main-menu">
                <li class="sub-header"><span>Secciones</span></li>

            @if(Auth()->user()->role->canRead(App\Models\Section::find(config('app.enabled_sections.inicio'))))
                <li class="selected has-sub-menu">
                    <a href="#">
                        <div class="icon-w">
                            <div class="ti-home"></div>
                        </div>
                        <span>Inicio</span>
                    </a>
                    <div class="sub-menu-w">
                        <div class="sub-menu-i">
                            <ul class="sub-menu">
                                <li><a href="{{route('homeIndex')}}">Inicio</a></li>
                            </ul>
                        </div>
                    </div>
                </li>
            @endif
            @if(Auth()->user()->role->canRead(App\Models\Section::find(config('app.enabled_sections.escritorio'))))
                <li class="selected has-sub-menu">
                    <a href="#">
                        <div class="icon-w">
                            <div class=" ti-dashboard "></div>
                        </div>
                        <span>Escritorio</span>
                    </a>
                    <div class="sub-menu-w">
                        <div class="sub-menu-i">
                            <ul class="sub-menu">
                                <li><a href="{{route('dashboardIndex')}}">Escritorio</a></li>
                            </ul>
                        </div>
                    </div>
                </li>
            @endif
            @if(Auth()->user()->role->canRead(App\Models\Section::find(config('app.enabled_sections.traducciones'))))

                <li class="selected has-sub-menu">
                    <a href="#">
                        <div class="icon-w">
                            <div class="ti-comments"></div>
                        </div>
                        <span>Traducciones</span>
                    </a>
                    <div class="sub-menu-w">
                        <div class="sub-menu-i">
                            <ul class="sub-menu">
                                <li><a href="{{route('traducciones')}}">Traducciones</a></li>
                            </ul>
                        </div>
                    </div>
                </li>
            @endif

            @if(Auth()->user()->role->canRead(App\Models\Section::find(config('app.enabled_sections.noticias'))))

                <li class="selected has-sub-menu">
                    <a href="javascript:void(0)">
                        <div class="icon-w">
                            <i class="ti-info"></i>
                        </div>
                        <span>Noticias</span>
                    </a>
                    <div class="sub-menu-w">
                        <div class="sub-menu-i">
                            <ul class="sub-menu">
                                <li><a href="{{route('news-index')}}">Listado</a></li>
                                <li><a href="{{route('news-index')}}#/categories">Categorías</a></li>
                                <li><a href="{{route('news-index')}}#/tags">Etiquetas</a></li>
                                <li><a href="{{route('news-index')}}#/writers">Redactores</a></li>
                            </ul>
                        </div>
                    </div>
                </li>
            @endif
            @if(Auth()->user()->role->canRead(App\Models\Section::find(config('app.enabled_sections.carousels'))))

                <li class="selected has-sub-menu">
                    <a href="#">
                        <div class="icon-w">
                            <div class=" ti-layout-slider-alt "></div>
                        </div>
                        <span>Carouseles</span>
                    </a>
                    <div class="sub-menu-w">
                        <div class="sub-menu-i">
                            <ul class="sub-menu">
                                <li><a href="{{route('carousels.index')}}">Carouseles</a></li>
                            </ul>
                        </div>
                    </div>
                </li>
            @endif

            @if(Auth()->user()->role->canRead(App\Models\Section::find(config('app.enabled_sections.aplicaciones'))))
                <li class="selected has-sub-menu">
                    <a href="#">
                        <div class="icon-w">
                            <div class=" ti-envelope "></div>
                        </div>
                        <span>Aplicaciones</span>
                    </a>
                    <div class="sub-menu-w">
                        <div class="sub-menu-i">
                            <ul class="sub-menu">
                                <li><a href="{{route('aplicaciones.index')}}">Listado</a></li>
                                <li><a href="{{route('categorias-aplicaciones.index')}}">Categorías</a></li>
                            </ul>
                        </div>
                    </div>
                </li>
            @endif

            @if(Auth()->user()->role->canRead(App\Models\Section::find(config('app.enabled_sections.productos'))))
                <li class="selected has-sub-menu">
                    <a href="#">
                        <div class="icon-w">
                            <div class=" ti-envelope "></div>
                        </div>
                        <span>Productos</span>
                    </a>
                    <div class="sub-menu-w">
                        <div class="sub-menu-i">
                            <ul class="sub-menu">
                                <li><a href="{{action('Back\Products\CategoryController@index')}}">Categorías</a></li>
                                <li><a href="{{route('labelIndex')}}">Etiquetas</a></li>
                                <li><a href="{{route('typeIndex')}}">Tipos</a></li>
                                <li><a href="{{route('formIndex')}}">Formas</a></li>
                                <li><a href="{{route('braidedIndex')}}">Trenzados</a></li>
                                <li><a href="{{route('colores.index')}}">Colores</a></li>
                                <li><a href="{{route('categorias-colores.index')}}">Muestrario de colores</a></li>
                                <li><a href="{{route('tonalidades-colores.index')}}">Tonalidades de colores</a></li>
                                <li><a href="{{route('referencias.index')}}">Referencias de medida</a></li>
                                <li><a href="{{route('eco.index')}}">Logos Eco</a></li>
                            </ul>
                        </div>
                    </div>
                </li>
            @endif

            @if(Auth()->user()->role->canRead(App\Models\Section::find(config('app.enabled_sections.materiales'))))

                <li class="selected has-sub-menu">
                    <a href="#">
                        <div class="icon-w">
                            <div class=" ti-hummer "></div>
                        </div>
                        <span>Materiales</span>
                    </a>
                    <div class="sub-menu-w">
                        <div class="sub-menu-i">
                            <ul class="sub-menu">
                                <li><a href="{{route('materialIndex')}}">Listado</a></li>
                                <li><a href="{{route('material.categorias.index')}}">Categorías</a></li>
                            </ul>
                        </div>
                    </div>
                </li>
            @endif
            {{-- @if(Auth()->user()->role->canRead(App\Models\Section::find(12)))

                <li class="selected has-sub-menu">
                    <a href="#">
                        <div class="icon-w">
                            <div class=" ti-id-badge"></div>
                        </div>
                        <span>Clientes</span>
                    </a>
                    <div class="sub-menu-w">
                        <div class="sub-menu-i">
                            <ul class="sub-menu">
                                <li><a href="{{route('customers')}}">Clientes</a></li>
                            </ul>
                        </div>
                    </div>
                </li>
            @endif --}}

            @if(Auth()->user()->role->canRead(App\Models\Section::find(config('app.enabled_sections.peticiones'))))

                <li class="selected no-sub-menu">
                    <a href="{{route('peticiones.index')}}">
                        <div class="icon-w">
                            <div class=" ti-info-alt "></div>
                        </div>
                        <span>Peticiones de información</span>
                    </a>
                </li>
            @endif
            @if(Auth()->user()->role->canRead(App\Models\Section::find(config('app.enabled_sections.acabados'))))

                <li class="selected has-sub-menu">
                    <a href="#">
                        <div class="icon-w">
                            <div class=" ti-panel "></div>
                        </div>
                        <span>Acabados</span>
                    </a>
                    <div class="sub-menu-w">
                        <div class="sub-menu-i">
                            <ul class="sub-menu">
                            <li><a href="{{ route('acabados.index') }}">Listado</a></li>
                            <li><a href="{{ route('tamanos.index') }}">Tamaños</a></li>
                            <li><a href={{ route('posiciones.index') }}>Posiciones</a></li>
                            <li><a href="{{ route('colores-acabados.index') }}">Colores</a></li>
                            <li><a href="{{ route('materiales-acabados.index') }}">Materiales</a></li>
                            </ul>
                        </div>
                    </div>
                </li>
            @endif

            @if(Auth()->user()->role->canRead(App\Models\Section::find(config('app.enabled_sections.solicitudes'))))
            <li class="selected">
                <a href="{{route('cvs.index')}}">
                    <div class="icon-w">
                        <i class=" ti-bookmark-alt "></i>
                    </div>
                    <span>CVs recibidos</span>
                </a>
                {{-- <div class="sub-menu-w">
                    <div class="sub-menu-i">
                        <ul class="sub-menu">
                            <li><a href="{{route('cvs.index')}}">CVs recibidos</a></li>
                            <li><a href="{{route('ofertas-trabajo.index')}}">Ofertas</a></li>
                            <li><a href="{{route('inscritos.index')}}">Inscritos</a></li>
                        </ul>
                    </div>
                </div> --}}
            </li>
            @endif

            @if(Auth()->user()->role->canRead(App\Models\Section::find(config('app.enabled_sections.productos'))))
                <li class="selected">
                    <a href="{{route('guide-request.index')}}">
                        <div class="icon-w">
                            <i class="ti-share-alt"></i>
                        </div>
                        <span>Solcitudes de guias</span>
                    </a>
                  
                </li>
            @endif

            @if(Auth()->user()->role->canRead(App\Models\Section::find(config('app.enabled_sections.configuracion'))))
                <li class="selected has-sub-menu">
                    <a href="#">
                        <div class="icon-w">
                            <div class="  ti-settings"></div>
                        </div>
                        <span>Configuración</span>
                    </a>
                    <div class="sub-menu-w">
                        <div class="sub-menu-i">
                            <ul class="sub-menu">
                                <li><a href="{{route('usuarios.index')}}">Usuarios</a></li>
                                <li><a href="{{route('roles.index')}}">Roles</a></li>
                            </ul>
                        </div>
                    </div>
                </li>
            @endif
            </ul>
        </div>
    </div>
    <!-- END - Mobile Menu -->

    <!-- START - Main Menu -->

    <div class="menu-w color-scheme-dark color-style-bright menu-position-side menu-side-left menu-layout-compact sub-menu-style-over sub-menu-color-bright selected-menu-color-light menu-activated-on-hover menu-has-selected-link">
        <div class="logo-w">
            <a class="logo" href="{{route('traducciones')}}">
                <img src="{{ asset('front/img/logo-cinpasa-negative.svg') }}"  alt="LIASA">
            </a>
        </div>
        <h1 class="menu-page-header">Page Header</h1>
        <ul class="main-menu">
            <li class="sub-header"><span>Secciones</span></li>

            @if(Auth()->user()->role->canRead(App\Models\Section::find(config('app.enabled_sections.inicio'))))

            <li class="selected has-sub-menu no-sub-menu">
                <a href="{{route('homeIndex')}}">
                    <div class="icon-w">
                        <div class="ti-home"></div>
                    </div>
                    <span>Inicio</span>
                </a>
            </li>
            @endif
            
            @if(Auth()->user()->role->canRead(App\Models\Section::find(config('app.enabled_sections.escritorio'))))
            <li class="selected has-sub-menu no-sub-menu">
                <a href="{{route('dashboardIndex')}}">
                    <div class="icon-w">
                        <div class=" ti-dashboard "></div>
                    </div>
                    <span>Escritorio</span>
                </a>
            </li>
            @endif

            @if(Auth()->user()->role->canRead(App\Models\Section::find(config('app.enabled_sections.traducciones'))))
            <li class="selected has-sub-menu no-sub-menu">
                <a href="{{route('traducciones')}}">
                    <div class="icon-w">
                        <div class="ti-comments"></div>
                    </div>
                    <span>Traducciones</span>
                </a>
            </li>
            @endif

            @if(Auth()->user()->role->canRead(App\Models\Section::find(config('app.enabled_sections.noticias'))))
            <li class="selected has-sub-menu">
                <a href="javascript:void(0)">
                    <div class="icon-w">
                        <i class="ti-info"></i>
                    </div>
                    <span>Noticias</span>
                </a>
                <div class="sub-menu-w">
                    <div class="sub-menu-i">
                        <ul class="sub-menu">
                            <li><a href="{{route('news-index')}}">Listado</a></li>
                            <li><a href="{{route('news-index')}}#/categories">Categorías</a></li>
                            <li><a href="{{route('news-index')}}#/tags">Etiquetas</a></li>
                            <li><a href="{{route('news-index')}}#/writers">Redactores</a></li>
                        </ul>
                    </div>
                </div>
            </li>
            @endif

            @if(Auth()->user()->role->canRead(App\Models\Section::find(config('app.enabled_sections.carousels'))))
            <li class="selected has-sub-menu no-sub-menu">
                <a href="{{route('carousels.index')}}">
                    <div class="icon-w">
                        <div class=" ti-layout-slider-alt "></div>
                    </div>
                    <span>Carouseles</span>
                </a>
            </li>
            @endif

            @if(Auth()->user()->role->canRead(App\Models\Section::find(config('app.enabled_sections.aplicaciones'))))
            <li class="selected has-sub-menu">
                <a href="#">
                    <div class="icon-w">
                        <div class=" ti-envelope"></div>
                    </div>
                    <span>Aplicaciones</span>
                </a>
                <div class="sub-menu-w">
                    <div class="sub-menu-i">
                        <ul class="sub-menu">
                            <li><a href="{{route('aplicaciones.index')}}">Listado</a></li>
                            <li><a href="{{route('categorias-aplicaciones.index')}}">Categorías</a></li>
                        </ul>
                    </div>
                </div>
            </li>
            @endif

            @if(Auth()->user()->role->canRead(App\Models\Section::find(config('app.enabled_sections.productos'))))
            <li class="selected has-sub-menu">
                <a href="{{route('productos.index')}}">
                    <div class="icon-w">
                        <i class=" ti-envelope "></i>
                    </div>
                    <span>Productos</span>
                </a>
                <div class="sub-menu-w">
                    <div class="sub-menu-i">
                        <ul class="sub-menu">
                            <li><a href="{{action('Back\Products\CategoryController@index')}}">Categorías</a></li>
                            <li><a href="{{route('labelIndex')}}">Etiquetas</a></li>
                            <li><a href="{{route('typeIndex')}}">Tipos</a></li>
                            <li><a href="{{route('formIndex')}}">Formas</a></li>
                            <li><a href="{{route('braidedIndex')}}">Trenzados</a></li>
                            <li><a href="{{route('colores.index')}}">Colores</a></li>
                            <li><a href="{{route('categorias-colores.index')}}">Muestrario de colores</a></li>
                            <li><a href="{{route('tonalidades-colores.index')}}">Tonalidades de colores</a></li>
                            <li><a href="{{route('referencias.index')}}">Referencias de medida</a></li>
                            <li><a href="{{route('eco.index')}}">Logos Eco</a></li>
                        </ul>
                    </div>
                </div>
            </li>
            @endif

            @if(Auth()->user()->role->canRead(App\Models\Section::find(config('app.enabled_sections.materiales'))))
            <li class="selected has-sub-menu">
                <a href="{{route('materialIndex')}}">
                    <div class="icon-w">
                        <div class=" ti-hummer "></div>
                    </div>
                    <span>Materiales</span>
                    <div class="sub-menu-w">
                        <div class="sub-menu-i">
                            <ul class="sub-menu">
                                <li><a href="{{route('materialIndex')}}">Listado</a></li>
                                <li><a href="{{route('material.categorias.index')}}">Categorías</a></li>
                            </ul>
                        </div>
                    </div>
                </a>
            </li>

            @endif

            {{-- @if(Auth()->user()->role->canRead(App\Models\Section::find(12)))

            <li class="selected has-sub-menu no-sub-menu">
                <a href="{{route('customers')}}">
                    <div class="icon-w">
                        <div class="  ti-id-badge  "></div>
                    </div>
                    <span>Clientes</span>
                </a>
            </li>
            @endif --}}

            @if(Auth()->user()->role->canRead(App\Models\Section::find(config('app.enabled_sections.peticiones'))))

            <li class="selected no-sub-menu">
                <a href="{{route('peticiones.index')}}">
                    <div class="icon-w">
                        <div class="  ti-info-alt  "></div>
                    </div>
                    <span>Peticiones de información</span>
                </a>
            </li>
            @endif


            @if(Auth()->user()->role->canRead(App\Models\Section::find(config('app.enabled_sections.acabados'))))
            <li class="selected has-sub-menu">
                <a href="javascript:void(0)">
                    <div class="icon-w">
                        <i class="ti-panel"></i>
                    </div>
                    <span>Acabados</span>
                </a>
                <div class="sub-menu-w">
                    <div class="sub-menu-i">
                        <ul class="sub-menu">
                            <li><a href="{{ route('acabados.index') }}">Listado</a></li>
                            <li><a href="{{ route('tamanos.index') }}">Tamaños</a></li>
                            <li><a href={{ route('posiciones.index') }}>Posiciones</a></li>
                            <li><a href="{{ route('colores-acabados.index') }}">Colores</a></li>
                            <li><a href="{{ route('materiales-acabados.index') }}">Materiales</a></li>
                        </ul>
                    </div>
                </div>
            </li>
            @endif
            @if(Auth()->user()->role->canRead(App\Models\Section::find(config('app.enabled_sections.solicitudes'))))
            <li class="selected">
                <a href="{{route('cvs.index')}}">
                    <div class="icon-w">
                        <i class=" ti-bookmark-alt "></i>
                    </div>
                    <span>CVs recibidos</span>
                </a>
                {{-- <div class="sub-menu-w">
                    <div class="sub-menu-i">
                        <ul class="sub-menu">
                            <li><a href="{{route('cvs.index')}}">CVs recibidos</a></li>
                            <li><a href="{{route('ofertas-trabajo.index')}}">Ofertas</a></li>
                            <li><a href="{{route('inscritos.index')}}">Inscritos</a></li>
                        </ul>
                    </div>
                </div> --}}
            </li>
            @endif

            @if(Auth()->user()->role->canRead(App\Models\Section::find(config('app.enabled_sections.productos'))))
                <li class="selected">
                    <a href="{{route('guide-request.index')}}">
                        <div class="icon-w">
                            <i class="ti-share-alt"></i>
                        </div>
                        <span>Solcitudes de guias</span>
                    </a>
                  
                </li>
            @endif
            
            @if(Auth()->user()->role->canRead(App\Models\Section::find(config('app.enabled_sections.configuracion'))))
            <li class="selected has-sub-menu">
                <a href="javascript:void(0)">
                    <div class="icon-w">
                        <i class=" ti-settings "></i>
                    </div>
                    <span>Configuración</span>
                </a>
                <div class="sub-menu-w">
                    <div class="sub-menu-i">
                        <ul class="sub-menu">
                            <li><a href="{{route('usuarios.index')}}">Usuarios</a></li>
                            <li><a href="{{route('roles.index')}}">Roles</a></li>
                        </ul>
                    </div>
                </div>
            </li>
            @endif
            
        </ul>
    </div>
