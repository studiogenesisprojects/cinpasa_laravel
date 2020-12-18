<!DOCTYPE html>
<html lang="es">
    @include('front.partials.head')
    <body class="menu-position-side menu-side-left full-screen with-content-panel">
        {{--  --}}
        @include('front.partials.header')
        @if(!isset($more_info_trigger))
            <a href="{{LaravelLocalization::getURLFromRouteNameTranslated(App::getLocale(),'routes.contact.index')}}" title="Accede a la categoría contacta" class="btn-fixed">
                <img class="mr-2" src="{{ asset('front/img/icon-contacta.svg') }}" alt="Icono contacto">¿MÁS INFORMACIÓN?
            </a>
        @else
            <a href="javascript:;" title="Accede a la categoría contacta" id="contact-button" class="btn-fixed">
                <img class="mr-2" src="{{ asset('front/img/icon-contacta.svg') }}" alt="Icono contacto">¿MÁS INFORMACIÓN?
            </a>
        @endif
        @yield('content')
        @include('front.partials.formulario')
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
