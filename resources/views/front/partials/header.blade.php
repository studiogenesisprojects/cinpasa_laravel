<header class="position-fixed background-white w-100 z-100">
    <div id="nav-none" class="container-fluid position-relative z-2 px-0 d-md-block d-none">
        <div class="row justify-content-between py-3 px-5 header-social">
            <div class="d-flex align-items-center">
                <p>+34 977 845 668</p>
                <a href="{{LaravelLocalization::getURLFromRouteNameTranslated(App::getLocale(),'routes.contact.index')}}" title="Escribenos a nuestro correo" class="ml-5">ventas@cinpasa.com</a>
            </div>
            <div class="d-flex align-items-center">
                <select class="form-control-search" id="select_language">
                    @foreach(\App\Models\Language::all() as $language)
                        @if($language->code != 'ru')
                            @if(isset(explode("/", url()->current())[3]))
                                @if(explode("/", url()->current())[3] == $language->code)
                                    <option value="{{$language->code}}" data-url="{{LaravelLocalization::getLocalizedURL($language->code)}}" selected>{{strtoupper($language->code)}}</option>
                                @else
                                    <option value="{{$language->code}}" data-url="{{LaravelLocalization::getLocalizedURL($language->code)}}">{{strtoupper($language->code)}}</option>
                                @endif
                            @else
                                <option value="{{$language->code}}" data-url="{{LaravelLocalization::getLocalizedURL($language->code)}}">{{strtoupper($language->code)}}</option>
                            @endif
                        @endif
                    @endforeach
                </select>
                <a href="#" title="Accede a nuestro facebook"><img class="ml-3" src="{{ asset('front/img/icon-facebook.svg') }}" alt="icono facebook"></a>
                <a href="#" title="Accede a nuestro canal de youtube"><img class="ml-3" src="{{ asset('front/img/icon-youtube.svg') }}" alt="icono youtube"></a>
                <a href="#" title="Accede a nuestro twitter"><img class="ml-3" src="{{ asset('front/img/icon-twitter.svg') }}" alt="icono twitter"></a>
                <a href="#" title="Accede a nuestro pinterest"><img class="ml-3" src="{{ asset('front/img/icon-pinterest.svg') }}" alt="icono pinterest"></a>
                <a href="#" title="Accede a nuestro instagram"><img class="ml-3" src="{{ asset('front/img/icon-instagram.svg') }}" alt="icono instagram"></a>
            </div>
        </div>
    </div>
    <hr>
    <div id="nav-sticky" class="container-fluid position-relative z-2 px-0">
        <div class="row justify-content-between align-items-center py-3 px-sm-5 px-4">
            <div class="d-lg-block d-flex justify-content-between w-md-100">
                <a href="{{\LaravelLocalization::localizeURL('/')}}" title="Accede al apartado inicio"><img class="my-3 logo" src="{{ asset('front/img/logo-cinpasa.svg') }}" alt="logotipo Cinpasa"></a>
                <div class="d-flex d-lg-none justify-content-end align-items-center">
                    <div class="position-relative">
                        <a class="icon-fav" href="#" title="Accede a tus productos favoritos"><img class="icon-nav" src="{{ asset('front/img/icon-fav.svg') }}" alt="icono favoritos"></a>
                        <div class="num-fav">4</div>
                    </div>
                    <a class="icon-search" href="#" title="Busca por palabras clave"><img class="icon-nav ml-sm-3 ml-3" src="{{ asset('front/img/icon-search.svg') }}" alt="icono búsqueda"></a>
                    <a id="icon-menu" href="#" title="Busca por palabras clave"><img class="icon-nav ml-sm-3 ml-3" src="{{ asset('front/img/icon-menu.svg') }}" alt="icono búsqueda"></a>
                </div>
                <div id="menu" class="">
                    <a class="ml-sm-5 a-stagger" href="{{LaravelLocalization::getURLFromRouteNameTranslated(App::getLocale(), 'routes.company.index')}}" title="Accede al apartado empresa">{{strtoupper(__('Menu.business'))}}</a>
                    <a id="productos_submenu" class="ml-sm-5 a-stagger" href="#" title="Accede al apartado productos">{{strtoupper(__('Menu.products'))}} <img src="{{ asset('front/img/icon-arrow-down-blue.svg') }}" alt="icono flecha abajo"></a>
                    <div class="flex-column ml-5 my-2 submenu">
                        @php
                           $fathers = $fathers->sortBy('order');
                        @endphp
                        @foreach ($fathers as $father)
                            <a class="ml-sm-5"
                                href="{{LaravelLocalization::getURLFromRouteNameTranslated(App::getLocale(),'routes.products.show', ["productCategory" => $father->slug])}}">{!! $father->name !!}</a>
                        @endforeach
                    </div>
                    <a class="ml-sm-5 a-stagger" href="{{LaravelLocalization::getURLFromRouteNameTranslated(App::getLocale(),'routes.applications.index')}}" title="Accede al apartado aplicaciones">{{strtoupper(strtoupper(__('Menu.aplications')))}}</a>
                    <a class="ml-sm-5 a-stagger" href="{{LaravelLocalization::getURLFromRouteNameTranslated(App::getLocale(),'routes.lab.index')}}" title="Accede al apartado LAB">LAB</a>
                    <a class="ml-sm-5 a-stagger" href="{{LaravelLocalization::getURLFromRouteNameTranslated(App::getLocale(),'routes.news.index')}}" title="Accede al apartado noticias">{{strtoupper(__('Menu.news'))}}</a>
                    @if(1 == 0)
                    <a class="ml-sm-5 a-stagger" href="{{LaravelLocalization::getURLFromRouteNameTranslated(App::getLocale(),'routes.outlet.index')}}" title="Accede al apartado outlet">OUTLET</a>
                    @endif
                    <a class="ml-3 {{Str::contains($currentUrl, "contacta") ? "active": ""}}" href="{{LaravelLocalization::getURLFromRouteNameTranslated(App::getLocale(),'routes.contact.index')}}" title="Accede al apartado contacta">{{strtoupper(__('Menu.contact'))}}</a>
                </div>
            </div>
            <div class="position-relative">
                <div class="justify-content-end mb-4 d-lg-flex d-none">
                    <div class="position-relative">
                        <a id="icon-fav" href="#" title="Accede a tus productos favoritos"><img class="icon-nav" src="{{ asset('front/img/icon-fav.svg') }}" alt="icono favoritos"></a>
                        <div class="num-fav pointer-events-none">4</div>
                    </div>
                    <a id="icon-search" href="#" title="Busca por palabras clave"><img class="icon-nav ml-3" src="{{ asset('front/img/icon-search.svg') }}" alt="icono búsqueda"></a>
                </div>
                <nav id="nav_a" class="justify-content-end mt-4 d-lg-flex d-none">
                    <a class="ml-3 {{Str::contains($currentUrl, "empresa") ? "active": ""}}" href="{{LaravelLocalization::getURLFromRouteNameTranslated(App::getLocale(), 'routes.company.index')}}" title="Accede al apartado empresa">{{strtoupper(__('Menu.business'))}}</a>
                    <a class="ml-3 hover-dropdown {{Str::contains($currentUrl, "productos") ? "active": ""}}" href="javascript:;" title="Accede al apartado productos">{{strtoupper(__('Menu.products'))}}</a>
                    <a class="ml-3 {{Str::contains($currentUrl, "aplicaciones") ? "active": ""}}" href="{{LaravelLocalization::getURLFromRouteNameTranslated(App::getLocale(),'routes.applications.index')}}" title="Accede al apartado aplicaciones">{{strtoupper(strtoupper(__('Menu.aplications')))}}</a>
                    <a class="ml-3 {{Str::contains($currentUrl, "lab") ? "active": ""}}" href="{{LaravelLocalization::getURLFromRouteNameTranslated(App::getLocale(),'routes.lab.index')}}" title="Accede al apartado LAB">LAB</a>
                    <a class="ml-3 {{Str::contains($currentUrl, "noticias") ? "active": ""}}" href="{{LaravelLocalization::getURLFromRouteNameTranslated(App::getLocale(),'routes.news.index')}}" title="Accede al apartado noticias">{{strtoupper(__('Menu.news'))}}</a>
                    @if(1 == 0)
                    <a class="ml-3 {{Str::contains($currentUrl, "outlet") ? "active": ""}}" href="{{LaravelLocalization::getURLFromRouteNameTranslated(App::getLocale(),'routes.outlet.index')}}" title="Accede al apartado outlet">OUTLET</a>
                    @endif
                    <a class="ml-3 {{Str::contains($currentUrl, "contacta") ? "active": ""}}" href="{{LaravelLocalization::getURLFromRouteNameTranslated(App::getLocale(),'routes.contact.index')}}" title="Accede al apartado contacta">{{strtoupper(__('Menu.contact'))}}</a>

                </nav>

                <div id="buscador_modal" class="row position-absolute r-0 t-2 card width-auto vw-lg-40 vw-md-50 vw-sm-60 vw-xs-90 background-blue-light">
                    <section id="close-busqueda" class="vh-100 vw-100 position-fixed t-0 l-0"></section>
                    <div class="col-12 px-4 pt-4 background-white">
                        <p class="font-bold color-blue">Buscador</p>
                    </div>
                    <div class="col-12 px-4 background-white">
                        <div class="row align-items-center justify-content-between">
                            <div class="col-8">
                                <div class="form-group">
                                    <input type="text" class="form-control px-0 w-100" id="" placeholder="Introduce alguna palabra clave…">
                                </div>
                            </div>
                            <div class="col-4">
                                <a href="#" title="Busca por palabra clave" class="btn btn-busqueda">BUSCAR</a>
                            </div>
                        </div>
                        <hr class="w-0 mb-4">
                    </div>
                    <div class="col-12 px-0 px-4 pb-5">
                        <p class="color-blue mt-3">Resultados</p>
                        <div class="row mt-3 align-items-center">
                            <div class="col-3">
                                <a href="#" title="Accede al produto relacionado"><img class="w-100 border-img" src="{{ asset('front/img/favoritos-1.jpg') }}" alt="imagen búsquedas relacionadas"></a>
                            </div>
                            <div class="col-9 px-0"><a href="#" title="Accede al produto relacionado">
                                    <p class="small color-blue">PASAMANERÍA</p>
                                    <p class="small color-black font-bold">Aro embellecedor 42mm</p>
                                </a>
                            </div>
                        </div>
                        <div class="row mt-3 align-items-center">
                            <div class="col-3">
                                <a href="#" title="Accede al produto relacionado"><img class="w-100 border-img" src="{{ asset('front/img/favoritos-1.jpg') }}" alt="imagen búsquedas relacionadas"></a>
                            </div>
                            <div class="col-9 px-0"><a href="#" title="Accede al produto relacionado">
                                    <p class="small color-blue">CORDONES</p>
                                    <p class="small color-black font-bold">Cordón retorcido de papel</p>
                                </a>
                            </div>
                        </div>
                        <div class="row mt-3 align-items-center">
                            <div class="col-3">
                                <a href="#" title="Accede al produto relacionado"><img class="w-100 border-img" src="{{ asset('front/img/favoritos-1.jpg') }}" alt="imagen búsquedas relacionadas"></a>
                            </div>
                            <div class="col-9 px-0"><a href="#" title="Accede al produto relacionado">
                                    <p class="small color-blue">CINTAS</p>
                                    <p class="small color-black font-bold">Bandolera</p>
                                </a>
                            </div>
                        </div>
                    </div>
                    <hr class="background-blue-light">
                    <div class="col-12 px-4 py-3">
                        <a href="#" title="Más resultados de tu búsqueda" class="color-blue small font-bold">Más resultados <img class="ml-2" src="{{ asset('front/img/icon-arrow-right-blue.svg') }}" alt="icono vectorial flecha derecha"></a>
                    </div>
                </div>
                <div id="favorito_modal" class="row position-absolute r-0 t-2 card pt-4 width-auto vw-lg-40 vw-md-50 vw-sm-60 vw-xs-90">
                    <section id="close-favorito" class="vh-100 vw-100 position-fixed t-0 l-0"></section>
                    <div class="col-12 px-4">
                        <p class="font-bold color-black">3 productos</p>
                        <hr class="mt-3">
                        <div class="row align-items-center mt-3">
                            <div class="col-3">
                                <a href="#" title="Accede al producto favorito"><img class="w-100 border-img" src="{{ asset('front/img/favoritos-1.jpg') }}" alt="imagen favoritos"></a>
                            </div>
                            <div class="col-7 px-0">
                                <a href="#" title="Accede al producto favorito">
                                    <p class="small color-blue">PASAMANERÍA</p>
                                    <p class="small color-black font-bold">Aro embellecedor 42mm</p>
                                </a>
                            </div>
                            <a href="#" title="Elimina el producto de tus favoritos" class="col-2 d-flex">
                                <img class="w-50" src="{{ asset('front/img/icon-delete.svg') }}" alt="icono vectorial eliminar">
                            </a>
                        </div>
                        <hr class="mt-3">
                        <div class="row align-items-center mt-3">
                            <div class="col-3">
                                <a href="#" title="Accede al producto favorito"><img class="w-100 border-img" src="{{ asset('front/img/favoritos-1.jpg') }}" alt="imagen favoritos"></a>
                            </div>
                            <div class="col-7 px-0">
                                <a href="#" title="Accede al producto favorito">
                                    <p class="small color-blue">CINTAS</p>
                                    <p class="small color-black font-bold">Bandolera</p>
                                </a>
                            </div>
                            <a href="#" title="Elimina el producto de tus favoritos" class="col-2 d-flex">
                                <img class="w-50" src="{{ asset('front/img/icon-delete.svg') }}" alt="icono vectorial eliminar">
                            </a>
                        </div>
                        <hr class="mt-3">
                        <div class="row align-items-center mt-3">
                            <div class="col-3">
                                <a href="#" title="Accede al producto favorito"><img class="w-100 border-img" src="{{ asset('front/img/favoritos-1.jpg') }}" alt="imagen favoritos"></a>
                            </div>
                            <div class="col-7 px-0">
                                <a href="#" title="Accede al producto favorito">
                                    <p class="small color-blue">CORDONES</p>
                                    <p class="small color-black font-bold">Cordón retorcido de papel</p>
                                </a>
                            </div>

                            <a href="#" title="Elimina el producto de tus favoritos" class="col-2 d-flex">
                                <img class="w-50" src="{{ asset('front/img/icon-delete.svg') }}" alt="icono vectorial eliminar">
                            </a>
                        </div>
                        <a href="favoritos.php" title="Ver todos tus productos favoritos" class="btn btn-fav w-100 my-4 py-2">VER FAVORITOS</a>
                    </div>
                </div>
            </div>
        </div>
        <hr>
        <div class="position-absolute w-100 z-1 justify-content-center background-white py-5 opacity-97 dropdown">
            <div class="container mt-5">
                <div class="row">
                    @php
                        $fathers = $fathers->sortBy('order');
                    @endphp
                    @foreach ($fathers as $father)
                    <div class="col-2 d-flex flex-column">
                        <a class="font-bold"
                            href="{{LaravelLocalization::getURLFromRouteNameTranslated(App::getLocale(),'routes.products.show', ["productCategory" => $father->slug])}}">{!! $father->name !!}</a>
                        @php
                            $childs = $father->childrens;
                            $childs = $childs->sortBy('searcher_order');
                        @endphp
                        @foreach ($childs as $children)
                        <a class="mt-1"
                            href="{{LaravelLocalization::getURLFromRouteNameTranslated(App::getLocale(),'routes.products.show', ["productCategory" =>$children->slug])}}">{!! $children->name !!}</a>
                        @endforeach
                    </div>
                    @endforeach
            </div>
        </div>
    </div>
</header>

<section id="header" class="background-white w-100 z-100 opacity-0">
    <div class="h-68 d-md-block d-none"></div>
    <hr>
    <div id="nav-sticky" class="container-fluid position-relative z-2 px-0">
        <div class="row justify-content-between align-items-center py-3 px-5 ">
            <div>
                <a href="{{\LaravelLocalization::localizeURL('/')}}" title="Accede al apartado inicio"><img class="my-3 logo" src="{{ asset('front/img/logo-cinpasa.svg') }}" alt="logotipo Cinpasa"></a>
            </div>
            <div class="position-relative d-lg-block d-none">
                <div class="d-flex justify-content-end mb-4">
                    <div class="position-relative">
                        <a id="icon-fav" href="#" title="Accede a tus productos favoritos"><img class="icon-nav" src="{{ asset('front/img/icon-fav.svg') }}" alt="icono favoritos"></a>
                        <div class="num-fav">4</div>
                    </div>
                    <a id="icon-search" href="#" title="Busca por palabras clave"><img class="icon-nav ml-3" src="{{ asset('front/img/icon-search.svg') }}" alt="icono búsqueda"></a>
                </div>
                <nav class="d-flex justify-content-end mt-4">
                    <a class="ml-3" href="{{LaravelLocalization::getURLFromRouteNameTranslated(App::getLocale(), 'routes.company.index')}}" title="Accede al apartado empresa">{{strtoupper(__('Menu.business'))}}</a>
                    <a class="ml-3 hover-dropdown" href="javascript:;" title="Accede al apartado productos">{{strtoupper(__('Menu.products'))}}</a>
                    <a class="ml-3" href="{{LaravelLocalization::getURLFromRouteNameTranslated(App::getLocale(),'routes.applications.index')}}" title="Accede al apartado aplicaciones">{{strtoupper(__('Menu.aplications'))}}</a>
                    <a class="ml-3" href="{{LaravelLocalization::getURLFromRouteNameTranslated(App::getLocale(),'routes.lab.index')}}" title="Accede al apartado LAB">LAB</a>
                    <a class="ml-3" href="{{LaravelLocalization::getURLFromRouteNameTranslated(App::getLocale(),'routes.news.index')}}" title="Accede al apartado noticias">{{strtoupper(__('Menu.news'))}}</a>
                    @if(1 == 0)
                    <a class="ml-3" href="{{LaravelLocalization::getURLFromRouteNameTranslated(App::getLocale(),'routes.outlet.index')}}" title="Accede al apartado outlet">OUTLET</a>
                    @endif
                    <a class="ml-3 {{Str::contains($currentUrl, "contacta") ? "active": ""}}" href="{{LaravelLocalization::getURLFromRouteNameTranslated(App::getLocale(),'routes.contact.index')}}" title="Accede al apartado contacta">{{strtoupper(__('Menu.contact'))}}</a>

                </nav>
            </div>
        </div>
    </div>
</section>
