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
        <div class="row mt-5">
            <div class="col-xl-3 col-sm-4 col-7 ml-sm-0 ml-1">
                <img class="w-100" src="{{ asset('front/img/logo-cinpasa-negative.svg') }}" alt="logotipo cinpasa">
                <p class="mt-4">{{__('Contacta.location')}}</p>
                <p class="mt-4"><i class="fa fa-phone pr-2"></i>{{__('Contacta.phone')}}</p>
                
            </div>
            <div class="col-xl-2 col-md-3 col-sm-4 col-6 offset-xl-1 offset-lg-2 offset-md-1 mt-sm-0 mt-5">
                <p class="font-bold">{{__('Footer.contenido')}}</p>
                <div class="d-flex flex-column">
                    @php
                        $fathers = $fathers->sortBy('order');
                    @endphp
                    @foreach ($fathers as $father)
                        <a class=""
                            href="{{LaravelLocalization::getURLFromRouteNameTranslated(App::getLocale(),'routes.products.show', ["productCategory" => $father->slug])}}">{!! $father->name !!}</a>
                    @endforeach
                    <br>
                    <a href="{{LaravelLocalization::getURLFromRouteNameTranslated(App::getLocale(),'routes.applications.index')}}" title="Accede al apartado aplicaciones">{{strtoupper(strtoupper(__('Menu.aplications')))}}</a>
                    <a href="{{LaravelLocalization::getURLFromRouteNameTranslated(App::getLocale(),'routes.work-with-us.index')}}" title="Accede al apartado Trabaja">{{strtoupper(strtoupper(__('TrabajaConNosotros.titulo-seccion')))}}</a>
                </div>
            </div>
            <div class="col-xl-2 col-lg-3 col-sm-4 col-6 mt-sm-0 mt-5">
                <p>{{__('Footer.legal')}}</p>
                <div class="d-flex flex-column">
                    <a href="{{LaravelLocalization::getURLFromRouteNameTranslated(App::getLocale(),'routes.politic_pages.politic_privacy')}}" title="Accede a las políticas de privacidad" class="mt-3">{{__('Textos_legals.privacy_polity_titulo')}}</a>
                    <a href="{{LaravelLocalization::getURLFromRouteNameTranslated(App::getLocale(),'routes.politic_pages.coockie_privacy')}}" title="Accede a las políticas de cookies">{{__('Textos_legals.cookie_policy_titulo')}}</a>
                    <a href="{{LaravelLocalization::getURLFromRouteNameTranslated(App::getLocale(),'routes.politic_pages.leagal_warning')}}" title="Accede a aviso legal">{{__('Textos_legals.legal_warning_titulo')}}</a>
                </div>
                <p class="mt-5">{{__('Footer.soporte')}}</p>
                <br>
                <div class="d-flex flex-column">
                    <a class="" href="{{LaravelLocalization::getURLFromRouteNameTranslated(App::getLocale(),'routes.contact.index')}}" title="Accede al apartado contacta">{{strtoupper(__('Menu.contact'))}}</a>
                </div>
            </div>
            <div class="col-xl-4 col-md-7 d-flex mt-xl-0 mt-5 footer-contacta">
                <!-- [BEGIN OF SIGNUP FORM]-->
                <hr class="hr-vertical mr-4">
                <div class="form-group w-100">
                    <p>{{__('Footer.subscribe')}}</p>
                    <p class="text-color-grey">{{__('Footer.descripcion')}}</p>
                    <p class="text-color-grey">{{__('Footer.solicitar_presupuesto')}}</p>
                    <a href="{{ LaravelLocalization::getURLFromRouteNameTranslated(App::getLocale(), 'routes.contact.index') }}" title="{{__('Footer.boton_formulario')}}" class="btn btn-sub px-3">{{__('Footer.boton_formulario')}}</a>
                <!-- <form name="frmjoin" id="frmjoin" method="post" action="https://www.email-index.com/join.php?L=RblSsAJNHjFVyC7639jyAyzg" class="form" > <input value="" id="frm_guardar" name="frm_guardar" type="hidden" />
                    <label for="">{{__('Footer.subscribe')}}</label>
                    <div class="form-group w-100">
                        <div class="d-flex">
                            <input maxlength="" data-type="email" value="" id="frm_email" name="frm_email" type="email" required  placeholder="{{__('Contacta.email')}}" class="form-control background-white"  />
                            <button type="submit" title="{{__('Footer.subscribe')}}" class="btn-sub px-3">{{__('Footer.seguir')}}</button>
                        </div>
                    </div>
                    <input type='hidden' name='frm_email_format' id='frm_email_format' value='2'/>
                    <div class="custom-control custom-checkbox mt-3">
                        <input type="checkbox" class="custom-control-input" id="politics" required>
                        <label class="custom-control-label" for="politics"><a href="{{LaravelLocalization::getURLFromRouteNameTranslated(App::getLocale(),'routes.politic_pages.politic_privacy')}}">{{__('Contacta.privacy')}}</a></label>
                    </div>
                    <input type="hidden" name="frm_nc" id="frm_nc" value="1" />
                    <script id="embed_script" type="text/javascript"  src="https://d1nn1beycom2nr.cloudfront.net/news/scripts/form.script.js"></script>
                </form> -->
                <br>
                <!-- [END OF SIGNUP FORM] -->

                    <label class="mt-4" for="">{{__('Footer.seguir')}}</label>
                    <div class="d-flex align-items-center mt-3">
                        <a href="https://www.facebook.com/pages/CINPASA/324453140914915" title="Accede a nuestro facebook"><img src="{{ asset('front/img/icon-facebook.svg') }}" alt="icono facebook"></a>
                        <a href="https://www.youtube.com/channel/UCwARth039yQvkPHSULVCWog" title="Accede a nuestro canal de youtube"><img class="ml-3" src="{{ asset('front/img/icon-youtube.svg') }}" alt="icono youtube"></a>
                        <a href="https://twitter.com/CINPASA" title="Accede a nuestro twitter"><img class="ml-3" src="{{ asset('front/img/icon-twitter.svg') }}" alt="icono twitter"></a>
                        <a href="https://www.pinterest.es/cinpasa/" title="Accede a nuestro pinterest"><img class="ml-3" src="{{ asset('front/img/icon-pinterest.svg') }}" alt="icono pinterest"></a>
                        {{-- <a href="#" title="Accede a nuestro instagram"><img class="ml-3" src="{{ asset('front/img/icon-instagram.svg') }}" alt="icono instagram"></a> --}}
                    </div>
                </div>


            </div>
            <div class="container">
                <div class="row my-5 align-items-end">
                   <div class="mt-md-0 mt-5">
                    <img class="ml-3 mb-1" src="{{ asset('front/img/unio-europea.png') }}" style="border:1px solid #CCCCCC;" alt="icono twitter">
                    </div>
                    <div class="col-md-9 ml-4">
                        <p class="color-white text-left">{{__('Footer.text-fondo-europeo')}}</p>
                    </div>
                </div>
            </div>
        </div>
        <div class="row justify-content-center py-5 mt-2">
            <a href="https://www.studiogenesis.es/" target="_blank" class="before-title-center position-relative" title="Studiogenesis, diseño web y desarrollo"><img class="mt-3" src="{{ asset('front/img/studiogenesis.svg') }}" alt="logotipo studiogenesis"></a>
        </div>
    </div>
    <div class="container-fluid">
        <div class="row justify-content-center py-3 background-negro">
            <p class="color-white text-center">Cintas y Pasamanería S.A. | Todos los derechos reservados 2020</p>
        </div>
    </div>

</footer>
