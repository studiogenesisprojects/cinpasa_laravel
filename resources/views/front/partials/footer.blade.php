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

{{-- <section>
    <div class="container">
        <div class="row mx-0 align-items-center">
            <img class="mb-1" src="{{ asset('front/img/icon-insta.svg') }}" alt="Icono vectorial instagram">
            <h5 class="ml-3 font-bold color-black">{{__('Footer.instagram')}}</h5>
            <a class="ml-3" href="#" title="Accede a nuestro instagram">@cinpasa</a>
        </div>
    </div>
</section> --}}

<footer class="mt-3 pt-5">
    <div class="container">
        <div class="row justify-content-center">
            <img class="w-50 justify-content-center" src="{{ asset('front/img/logo-cinpasa-bl.png') }}" alt="logotipo cinpasa">
        </div>
        <div class="row mt-5 mb-5">
            <div class="col-xl-3 col-sm-4 col-7 ml-sm-0 ml-1">
                <p class="font-bold">{{__('Footer.address')}}</p>

                <p class="mt-2">{{__('Footer.cinpasa-oficinas-title')}}</p>
                <p style="font-size:14px">{{__('Contacta.location')}}</p>

                <p class="mt-4">{{__('Footer.cid-camiones-title')}}</p>
                <p style="font-size:14px">{{__('Footer.cid-camiones-address')}}</p>

                <p class="mt-4">
                    {{-- <i class="fa fa-phone pr-2"></i> --}}
                    Tel. {{__('Contacta.phone')}}
                </p>
                
            </div>
            <div class="col-xl-2 col-md-3 col-sm-4 col-6 mt-sm-0 mt-5">
                <p class="font-bold mb-2">{{__('Footer.contenido')}}</p>
                <div class="d-flex flex-column">
                    @php
                        $fathers = $fathers->sortBy('order');
                    @endphp
                    @foreach ($fathers as $father)
                        <a class=""
                            href="{{LaravelLocalization::getURLFromRouteNameTranslated(App::getLocale(),'routes.products.show', ["productCategory" => $father->slug])}}">{!! $father->name !!}</a>
                    @endforeach
                    <br>
                    {{-- <a href="{{LaravelLocalization::getURLFromRouteNameTranslated(App::getLocale(),'routes.applications.index')}}" title="Accede al apartado aplicaciones">{{strtoupper(strtoupper(__('Menu.aplications')))}}</a> --}}
                </div>
            </div>
            <div class="col-xl-2 col-lg-3 col-sm-4 col-6 mt-sm-0 mt-5">
                <p class="mb-2">{{__('Footer.certificates')}}</p>
                <img class="w-100 justify-content-center" src="{{ asset('front/img/certificates.png') }}" alt="logotipo cinpasa">
            </div>
            <div class="col-xl-2 col-lg-3 col-sm-4 col-6 mt-sm-0 mt-5">
                <a href="{{LaravelLocalization::getURLFromRouteNameTranslated(App::getLocale(),'routes.work-with-us.index')}}" title="Accede al apartado Trabaja" class="text-white" style="text-decoration: underline;">{{strtoupper(strtoupper(__('TrabajaConNosotros.titulo-seccion')))}}</a>

                <p class="mt-3">{{__('Footer.legal')}}</p>
                <div class="d-flex flex-column">
                    <a href="{{LaravelLocalization::getURLFromRouteNameTranslated(App::getLocale(),'routes.politic_pages.politic_privacy')}}" title="Accede a las políticas de privacidad" class="mt-3">{{__('Textos_legals.privacy_polity_titulo')}}</a>
                    <a href="{{LaravelLocalization::getURLFromRouteNameTranslated(App::getLocale(),'routes.politic_pages.coockie_privacy')}}" title="Accede a las políticas de cookies">{{__('Textos_legals.cookie_policy_titulo')}}</a>
                    <a href="{{LaravelLocalization::getURLFromRouteNameTranslated(App::getLocale(),'routes.politic_pages.leagal_warning')}}" title="Accede a aviso legal">{{__('Textos_legals.legal_warning_titulo')}}</a>
                </div>
                {{-- <p class="mt-5">{{__('Footer.soporte')}}</p> --}}
            </div>
            <div class="col-xl-3 col-md-6 d-flex mt-xl-0 mt-5 footer-contacta">
                <!-- [BEGIN OF SIGNUP FORM]-->

                <div class="form-group w-100">
                    <p>{{__('Footer.subscribe')}}</p>
                    <p class="text-color-grey">{{__('Footer.descripcion')}}</p>
                    <p class="text-color-grey">{{__('Footer.solicitar_presupuesto')}}</p>
                    <a href="{{ LaravelLocalization::getURLFromRouteNameTranslated(App::getLocale(), 'routes.contact.index') }}" title="{{__('Footer.boton_formulario')}}" class="btn btn-sub px-3">{{__('Footer.boton_formulario')}}</a>
                <br>
                <!-- [END OF SIGNUP FORM] -->

                    {{-- <label class="mt-4" for="">{{__('Footer.seguir')}}</label> --}}                  
                </div>
            </div>
        </div>
        
    </div>
    <div class="container-fluid">
        <div class="row justify-content-center pt-4 pb-2 background-negro">
            <div class="d-flex align-items-center">
                <a href="" title="Accede a nuestro Linkedin"><img class="ml-3 icon-footer" src="{{ asset('front/img/icon-linkedin-rrss.png') }}" alt="icono linkedin"></a>
                <a href="https://www.youtube.com/channel/UCwARth039yQvkPHSULVCWog" title="Accede a nuestro canal de youtube"><img class="ml-3 icon-footer" src="{{ asset('front/img/icon-youtube-rrss.png') }}" alt="icono youtube"></a>
                <a href="https://www.facebook.com/pages/CINPASA/324453140914915" title="Accede a nuestro facebook"><img class="ml-3 icon-footer" src="{{ asset('front/img/icon-facebook-rrss.png') }}" alt="icono facebook"></a>
                <a href="https://www.pinterest.es/cinpasa/" title="Accede a nuestro pinterest"><img class="ml-3 icon-footer" src="{{ asset('front/img/icon-pinterest-rrss.png') }}" alt="icono pinterest"></a>
                <a href="https://twitter.com/CINPASA" title="Accede a nuestro twitter"><img class="ml-3 icon-footer" src="{{ asset('front/img/icon-x-rrss.png') }}" alt="icono twitter"></a>
                {{-- <a href="#" title="Accede a nuestro instagram"><img class="ml-3" src="{{ asset('front/img/icon-instagram.svg') }}" alt="icono instagram"></a> --}}
            </div>
        </div>
    </div>
    <div class="bg-white">
        <div class="container">
            <div class="row pt-3 align-items-end">
                <div class="col-xl-2 col-lg-3 col-md-4 col-sm-6">
                    <img  class="w-100" src="{{ asset('front/img/unio-europea-ng.png') }}" style="border:1px solid black;" alt="icono ue">
                </div>
                <div class="col-xl-10 col-lg-9 col-md-8 col-sm-12 mt-sm-3">
                    <p class="color-black text-left">{{__('Footer.text-fondo-europeo')}}</p>
                </div>
            </div>
            <div class="row py-3 my-2 justify-content-center">
                <a href="https://www.studiogenesis.es/" target="_blank" class="position-relative" title="Studiogenesis, diseño web y desarrollo"><img class="mt-3" src="{{ asset('front/img/studiogenesis-bl.svg') }}" alt="logotipo studiogenesis"></a>
            </div>
        </div>
    </div>
    {{-- <div class="container-fluid">
        <div class="row justify-content-center py-3 background-negro">
            <p class="color-white text-center">Cintas y Pasamanería S.A. | Todos los derechos reservados 2020</p>
        </div>
    </div> --}}

</footer>
