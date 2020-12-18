<section>
    <div class="container">
        <div class="row py-5">
            <div class="col-md-4 d-flex align-items-start">
                <img src="{{ asset('front/img/icon-cintas.svg') }}" alt="icono vectorial cintas a medida">
                <div class="ml-3">
                    <p class="font-bold">{{__('Pre-Footer.seccion1-titulo')}}</p>
                    <p class="mt-3">{{__('Pre-Footer.seccion1-text')}}</p>
                </div>
            </div>
            <div class="col-md-4 d-flex align-items-start mt-md-0 mt-3">
                <img src="{{ asset('front/img/icon-productiva.svg') }}" alt="icono vectorial alta capacidad productiva">
                <div class="ml-3">
                    <p class="font-bold">{{__('Pre-Footer.seccion2-titulo')}}</p>
                    <p class="mt-3">{{__('Pre-Footer.seccion2-text')}}</p>
                </div>
            </div>
            <div class="col-md-4 d-flex align-items-start mt-md-0 mt-3">
                <img src="{{ asset('front/img/icon-flexibilidad.svg') }}" alt="icono vectorial flexibilidad total">
                <div class="ml-3">
                    <p class="font-bold">{{__('Pre-Footer.seccion3-titulo')}}</p>
                    <p class="mt-3">{{__('Pre-Footer.seccion3-text')}}</p>
                </div>
            </div>
        </div>
    </div>
</section>

<section>
    <div class="container">
        <div class="row mx-0 align-items-center">
            <img class="mb-1" src="{{ asset('front/img/icon-insta.svg') }}" alt="Icono vectorial instagram">
            <h5 class="ml-3 font-bold color-black">SÍGUENOS EN INSTAGRAM</h5>
            <a class="ml-3" href="#" title="Accede a nuestro instagram">@cinpasa</a>
        </div>
    </div>
</section>

<footer class="mt-3 pt-5">
    <div class="container">
        <div class="row mt-5">
            <div class="col-xl-3 col-sm-4 col-7 ml-sm-0 ml-1">
                <img class="w-100" src="{{ asset('front/img/logo-cinpasa-negative.svg') }}" alt="logotipo cinpasa">
                <p class="mt-4">{{__('Contacta.location')}}</p>
                <p class="mt-4">{{__('Contacta.phone')}}</p>
            </div>
            <div class="col-xl-2 col-md-3 col-sm-4 col-6 offset-xl-1 offset-lg-2 offset-md-1 mt-sm-0 mt-5">
                <p class="font-bold">CONTENIDO</p>
                <div class="d-flex flex-column">
                    @php
                        $fathers = $fathers->sortBy('order');
                    @endphp
                    @foreach ($fathers as $father)
                        <a class=""
                            href="{{LaravelLocalization::getURLFromRouteNameTranslated(App::getLocale(),'routes.products.show', ["productCategory" => $father->slug])}}">{!! $father->name !!}</a>
                    @endforeach
                    <br>
                    <a href="{{LaravelLocalization::getURLFromRouteNameTranslated(App::getLocale(),'routes.lab.index')}}" title="Accede al apartado LAB">LAB</a>
                    <a href="{{LaravelLocalization::getURLFromRouteNameTranslated(App::getLocale(),'routes.applications.index')}}" title="Accede al apartado aplicaciones">{{strtoupper(strtoupper(__('Menu.aplications')))}}</a>
                </div>
            </div>
            <div class="col-xl-2 col-lg-3 col-sm-4 col-6 mt-sm-0 mt-5">
                <p>LEGAL</p>
                <div class="d-flex flex-column">
                    <a href="{{LaravelLocalization::getURLFromRouteNameTranslated(App::getLocale(),'routes.politic_pages.politic_privacy')}}" title="Accede a las políticas de privacidad" class="mt-3">Política de privacidad</a>
                    <a href="{{LaravelLocalization::getURLFromRouteNameTranslated(App::getLocale(),'routes.politic_pages.coockie_privacy')}}" title="Accede a las políticas de cookies">Política de cookies</a>
                    <a href="{{LaravelLocalization::getURLFromRouteNameTranslated(App::getLocale(),'routes.politic_pages.leagal_warning')}}" title="Accede a aviso legal">Aviso legal</a>
                </div>
                <p class="mt-5">SOPORTE</p>
                <div class="d-flex flex-column">
                    <a class="ml-3 {{Str::contains($currentUrl, "contacta") ? "active": ""}}" href="{{LaravelLocalization::getURLFromRouteNameTranslated(App::getLocale(),'routes.contact.index')}}" title="Accede al apartado contacta">{{strtoupper(__('Menu.contact'))}}</a>
                </div>
            </div>
            <div class="col-xl-4 col-md-7 d-flex mt-xl-0 mt-5">
                <hr class="hr-vertical mr-4">
                <div class="form-group w-100">
                    <label for="">SUSCRÍBETE A NUESTRO NEWSLETTER</label>
                    <div class="d-flex">
                        <input type="text" class="form-control background-white" id="" placeholder="Escribe tu e-mail…">
                        <a href="#" title="Suscríbete a nuestro newsletter" class="btn-sub px-3">SUSCRIBIRME</a>
                    </div>
                    <div class="custom-control custom-checkbox mt-3">
                        <input type="checkbox" class="custom-control-input" id="defaultChecked2" checked>
                        <label class="custom-control-label" for="defaultChecked2">He leído y acepto la política de privacidad.</label>
                    </div>
                    <label class="mt-4" for="">SÍGUENOS</label>
                    <div class="d-flex align-items-center mt-3">
                        <a href="#" title="Accede a nuestro facebook"><img src="{{ asset('front/img/icon-facebook.svg') }}" alt="icono facebook"></a>
                        <a href="#" title="Accede a nuestro canal de youtube"><img class="ml-3" src="{{ asset('front/img/icon-youtube.svg') }}" alt="icono youtube"></a>
                        <a href="#" title="Accede a nuestro twitter"><img class="ml-3" src="{{ asset('front/img/icon-twitter.svg') }}" alt="icono twitter"></a>
                        <a href="#" title="Accede a nuestro pinterest"><img class="ml-3" src="{{ asset('front/img/icon-pinterest.svg') }}" alt="icono pinterest"></a>
                        <a href="#" title="Accede a nuestro instagram"><img class="ml-3" src="{{ asset('front/img/icon-instagram.svg') }}" alt="icono instagram"></a>
                    </div>
                </div>
            </div>
        </div>
        <div class="row justify-content-center py-5 mt-5">
            <a href="https://www.studiogenesis.es/" target="_blank" class="before-title-center position-relative" title="Studiogenesis, diseño web y desarrollo"><img class="mt-3" src="{{ asset('front/img/studiogenesis.svg') }}" alt="logotipo studiogenesis"></a>
        </div>
    </div>
    <div class="container-fluid">
        <div class="row justify-content-center py-3 background-negro">
            <p class="color-white text-center">Cintas y Pasamanería S.A. | Todos los derechos reservados 2020</p>
        </div>
    </div>

</footer>
