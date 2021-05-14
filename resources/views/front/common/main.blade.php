<!DOCTYPE html>
<html lang="{{App::getLocale()}}">
    <!--<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>-->
    <script src="{{ asset('front/js/jquery.min.js') }}"></script>
    <!-- <script src="https://kit.fontawesome.com/62992c8b48.js" crossorigin="anonymous"></script> -->
    <script src="{{ asset('front/js/62992c8b48.js') }}"></script>
    @include('front.partials.head')

    <body class="menu-position-side menu-side-left full-screen with-content-panel">
        <!-- Google Tag Manager (noscript) -->
        <noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-5R5VDBD"
        height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
        <!-- End Google Tag Manager (noscript) -->
        {!! EuCookieConsent::getPopup() !!}
        @include('front.partials.header')
        @if(!isset($more_info_trigger))
            <a href="{{LaravelLocalization::getURLFromRouteNameTranslated(App::getLocale(),'routes.contact.index')}}" title="Accede a la categoría contacta" class="btn-fixed">
                <img class="mr-2" src="{{ asset('front/img/icon-contacta.svg') }}" alt="Icono contacto">¿{{__('Lab.more-info')}}?
            </a>
        @else
            <a href="javascript:;" title="Accede a la categoría contacta" id="contact-button" class="btn-fixed">
                <img class="mr-2" src="{{ asset('front/img/icon-contacta.svg') }}" alt="Icono contacto">¿{{__('Lab.more-info')}}?
            </a>
        @endif
        @yield('content')

        @if(!isset($no_contact))
        @include('front.partials.formulario')
        @endif
        @include('front.partials.distribuir')
        @include('front.partials.footer')
        @include('front.partials.js')
        @stack('js')

        <script>

            $('#select_language').change(function(){
                var language = $('#select_language').val();
                var url = $(this).find(':selected').data('url');

                window.location.href = url;
            });

            $("#contact-button").click(function() {
                $([document.documentElement, document.body]).animate({
                    scrollTop: $("#contact-form-products").offset().top
                }, 2000);
            });
        </script>
    </body>
</html>
