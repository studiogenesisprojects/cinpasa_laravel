
<header class="position-fixed background-white w-100 z-100">
    <div id="nav-none" class="container-fluid position-relative z-2 px-0 d-md-block d-none">
        <div class="row justify-content-between py-3 px-5 header-social">
            <div class="d-flex align-items-center">
                <a href="{{LaravelLocalization::getURLFromRouteNameTranslated(App::getLocale(),'routes.contact.index')}}" title="Escribenos a nuestro correo" class="mr-3"><i class="fa fa-envelope-o"></i> Contacta</a>
                
                <p><i class="fa fa-phone"></i>
                    +34 977 845 668</p>

            </div>
            <div class="d-flex align-items-center">
                <select class="form-control-search" id="select_language">
                    @foreach(\App\Models\Language::all() as $language)
                        @if(isset(explode("/", url()->current())[3]))
                            @if(explode("/", url()->current())[3] == $language->code)
                                <option value="{{$language->code}}" data-url="{{LaravelLocalization::getLocalizedURL($language->code)}}" selected>{{strtoupper($language->code)}}</option>
                            @else
                                <option value="{{$language->code}}" data-url="{{LaravelLocalization::getLocalizedURL($language->code)}}">{{strtoupper($language->code)}}</option>
                            @endif
                        @else
                            <option value="{{$language->code}}" data-url="{{LaravelLocalization::getLocalizedURL($language->code)}}">{{strtoupper($language->code)}}</option>
                        @endif
                    @endforeach
                </select>
                <a href="https://www.facebook.com/pages/CINPASA/324453140914915" title="Accede a nuestro facebook"><img class="ml-3" src="{{ asset('front/img/icon-facebook.svg') }}" alt="icono facebook"></a>
                <a href="https://www.youtube.com/channel/UCwARth039yQvkPHSULVCWog" title="Accede a nuestro canal de youtube"><img class="ml-3" src="{{ asset('front/img/icon-youtube.svg') }}" alt="icono youtube"></a>
                <a href="https://twitter.com/CINPASA" title="Accede a nuestro twitter"><img class="ml-3" src="{{ asset('front/img/icon-twitter.svg') }}" alt="icono twitter"></a>
                <a href="https://www.pinterest.es/cinpasa/" title="Accede a nuestro pinterest"><img class="ml-3" src="{{ asset('front/img/icon-pinterest.svg') }}" alt="icono pinterest"></a>
                {{-- <a href="#" title="Accede a nuestro instagram"><img class="ml-3" src="{{ asset('front/img/icon-instagram.svg') }}" alt="icono instagram"></a> --}}
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
                        <a class="icon-fav" href="#" title="Accede a tus productos favoritos"><img class="icon-nav" src="{{ asset('front/img/icon-fav.svg') }}" alt="{{ __('Favoritos.icon') }}"></a>
                        <div class="num-fav">{{$favorites->count()}}</div>
                    </div>
                    <a class="icon-search" href="#" title="Busca por palabras clave"><img class="icon-nav ml-sm-3 ml-3" src="{{ asset('front/img/icon-search.svg') }}" alt="icono búsqueda"></a>
                    <a id="icon-menu" href="#" title="Busca por palabras clave"><img class="icon-nav ml-sm-3 ml-3" src="{{ asset('front/img/icon-menu.svg') }}" alt="icono búsqueda"></a>
                </div>
                <div id="menu" class="">
                    <a class="ml-sm-5 a-stagger" href="{{LaravelLocalization::getURLFromRouteNameTranslated(App::getLocale(), 'routes.company.index')}}" title="Accede al apartado empresa">{{strtoupper(__('Menu.business'))}}</a>
                    <a id="productos_submenu" class="ml-sm-5 a-stagger" href="#" title="Accede al apartado productos">{{strtoupper(__('Menu.products'))}} <img src="{{ asset('front/img/icon-arrow-down-blue.svg') }}" alt="icono flecha abajo"></a>
                    <div class="flex-column ml-3 my-2 submenu">
                        @php
                           $fathers = $fathers->sortBy('order');
                        @endphp
                        @foreach ($fathers as $father)
                        @if($father->active == 1)
                            <div class="d-flex flex-column">
                                <a class="font-bold"
                                    href="{{LaravelLocalization::getURLFromRouteNameTranslated(App::getLocale(),'routes.products.show', ["productCategory" => $father->slug])}}">{!! $father->name !!}</a>
                                @php
                                    $childs = $father->childrens;
                                    $childs = $childs->sortBy('searcher_order');
                                @endphp
                                @foreach ($childs as $children)
                                <a class="ml-3 mt-1 font-light"
                                    href="{{LaravelLocalization::getURLFromRouteNameTranslated(App::getLocale(),'routes.products.show', ["productCategory" =>$children->slug])}}">{!! $children->name !!}</a>
                                @endforeach
                            </div>
                        @endif
                        @endforeach
                    </div>
                    <a class="ml-sm-5 a-stagger" href="{{LaravelLocalization::getURLFromRouteNameTranslated(App::getLocale(),'routes.applications.index')}}" title="Accede al apartado aplicaciones">{{strtoupper(strtoupper(__('Menu.aplications')))}}</a>
                    @if(1 == 0)
                    <a class="ml-sm-5 a-stagger" href="{{LaravelLocalization::getURLFromRouteNameTranslated(App::getLocale(),'routes.news.index')}}" title="Accede al apartado noticias">{{strtoupper(__('Menu.news'))}}</a>
                    @endif
                    <a class="ml-sm-5 a-stagger {{Str::contains($currentUrl, "contacta") ? "active": ""}}" href="{{LaravelLocalization::getURLFromRouteNameTranslated(App::getLocale(),'routes.contact.index')}}" title="Accede al apartado contacta">{{strtoupper(__('Menu.contact'))}}</a>

                </div>
            </div>
            <div class="position-relative">
                <div class="justify-content-end mb-4 d-lg-flex d-none">
                    <div class="position-relative">
                        <a id="icon-fav" href="#" title="Accede a tus productos favoritos"><img class="icon-nav" src="{{ asset('front/img/icon-fav.svg') }}" alt="icono favoritos"></a>
                        <div class="num-fav pointer-events-none">{{$favorites->count()}}</div>
                    </div>
                    <a id="icon-search" href="#" title="Busca por palabras clave"><img class="icon-nav ml-3" src="{{ asset('front/img/icon-search.svg') }}" alt="icono búsqueda"></a>
                </div>
                <nav id="nav_a" class="justify-content-end mt-4 d-lg-flex d-none">
                    <a class="ml-3 {{Str::contains($currentUrl, "empresa") ? "active": ""}}" href="{{LaravelLocalization::getURLFromRouteNameTranslated(App::getLocale(), 'routes.company.index')}}" title="Accede al apartado empresa">{{strtoupper(__('Menu.business'))}}</a>
                    <a class="ml-3 hover-dropdown {{Str::contains($currentUrl, "productos") ? "active": ""}}" href="{{LaravelLocalization::getURLFromRouteNameTranslated(App::getLocale(), 'routes.products.index')}}" title="Accede al apartado productos">{{strtoupper(__('Menu.products'))}}</a>
                    <a class="ml-3 {{Str::contains($currentUrl, "aplicaciones") ? "active": ""}}" href="{{LaravelLocalization::getURLFromRouteNameTranslated(App::getLocale(),'routes.applications.index')}}" title="Accede al apartado aplicaciones">{{strtoupper(strtoupper(__('Menu.aplications')))}}</a>
                    {{-- @if(1 == 0) --}}
                    <a class="ml-3 {{Str::contains($currentUrl, "noticias") ? "active": ""}}" href="{{LaravelLocalization::getURLFromRouteNameTranslated(App::getLocale(),'routes.news.index')}}" title="Accede al apartado noticias">{{strtoupper(__('Menu.news'))}}</a>
                    {{-- @endif --}}
                    <a class="ml-3 {{Str::contains($currentUrl, "contacta") ? "active": ""}}" href="{{LaravelLocalization::getURLFromRouteNameTranslated(App::getLocale(),'routes.contact.index')}}" title="Accede al apartado contacta">{{strtoupper(__('Menu.contact'))}}</a>

                </nav>

                <div id="buscador_modal" class="row position-absolute r-0 t-2 card width-auto vw-lg-40 vw-md-50 vw-sm-60 vw-xs-90 background-blue-light">
                    <section id="close-busqueda" class="vh-100 vw-100 position-fixed t-0 l-0"></section>
                    <div class="col-12 px-4 pt-4 background-white">
                        <p class="font-bold color-blue">Buscador</p>
                    </div>
                    <form action="{{route('searcher')}}" method="GET">
                        @csrf
                        <div class="col-12 px-4 background-white">
                            <div class="row align-items-center justify-content-between">
                                <div class="col-8">
                                    <div class="form-group">
                                        <input type="text" class="form-control px-0 w-100" name="name" id="" placeholder="Introduce alguna palabra clave…">
                                    </div>
                                </div>
                                <div class="col-4">
                                    <button type="submit" title="Busca por palabra clave" class="btn btn-busqueda">BUSCAR</button>
                                </div>
                            </div>
                            <hr class="w-0 mb-4">
                        </div>
                    </form>
                </div>
                <div id="favorito_modal" class="row position-absolute r-0 t-2 card pt-4 width-auto vw-lg-40 vw-md-50 vw-sm-60 vw-xs-90">
                    <section id="close-favorito" class="vh-100 vw-100 position-fixed t-0 l-0"></section>
                    <div class="col-12 px-4">
                        <p class="font-bold color-black"><strong id="favorites_count">{{$favorites->count()}}</strong> {{__('Menu.products')}}<a href="{{LaravelLocalization::getURLFromRouteNameTranslated(App::getLocale(),'routes.favorites.index')}}" title="Ver todos tus productos favoritos" class="btn btn-fav w-100 my-4 py-2">VER FAVORITOS</a></p>
                        <div id="favorites_place"></div>
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
                    @if($father->active == 1)
                    <div class=" {{!$loop->first ? 'ml-3' : ''}} d-flex flex-column">
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
                    @endif
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
                        <a href="#" title="Accede a tus productos favoritos"><img class="icon-nav" src="{{ asset('front/img/icon-fav.svg') }}" alt="{{ __('Favoritos.icon') }}"></a>
                        <div id="header-fav-count" class="num-fav">4</div>
                    </div>
                    <a id="icon-search" href="#" title="Busca por palabras clave"><img class="icon-nav ml-3" src="{{ asset('front/img/icon-search.svg') }}" alt="icono búsqueda"></a>
                </div>
                <nav class="d-flex justify-content-end mt-4">
                    <a class="ml-3" href="{{LaravelLocalization::getURLFromRouteNameTranslated(App::getLocale(), 'routes.company.index')}}" title="Accede al apartado empresa">{{strtoupper(__('Menu.business'))}}</a>
                    <a class="ml-3 hover-dropdown" href="javascript:;" title="Accede al apartado productos">{{strtoupper(__('Menu.products'))}}</a>
                    <a class="ml-3" href="{{LaravelLocalization::getURLFromRouteNameTranslated(App::getLocale(),'routes.applications.index')}}" title="Accede al apartado aplicaciones">{{strtoupper(__('Menu.aplications'))}}</a>
                    @if(1 == 0)
                    <a class="ml-3" href="{{LaravelLocalization::getURLFromRouteNameTranslated(App::getLocale(),'routes.news.index')}}" title="Accede al apartado noticias">{{strtoupper(__('Menu.news'))}}</a>
                    @endif
                    <a class="ml-3 {{Str::contains($currentUrl, "contacta") ? "active": ""}}" href="{{LaravelLocalization::getURLFromRouteNameTranslated(App::getLocale(),'routes.contact.index')}}" title="Accede al apartado contacta">{{strtoupper(__('Menu.contact'))}}</a>

                </nav>
            </div>
        </div>
    </div>
</section>
