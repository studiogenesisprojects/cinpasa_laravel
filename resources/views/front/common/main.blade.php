<!DOCTYPE html>
<html lang="es">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/vue/1.0.26/vue.min.js"></script>
    @include('front.partials.head')
    <body class="menu-position-side menu-side-left full-screen with-content-panel">
        <!-- Google Tag Manager (noscript) -->
        <noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-5R5VDBD"
        height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
        <!-- End Google Tag Manager (noscript) -->

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

            // $('.num-fav').html(6);

            // console.log({{Cookie::get('favorites')}});
            // $.ajaxSetup({
            //     headers: {
            //         'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            //     }
            // });

            // $.ajax({
            //     method: "POST",
            //     url: '{{ route('front.getFavorites') }}',
            //     data: {'values':'{{Cookie::get('favorites')}}', "_token": "{{ csrf_token() }}"},
            //     success : function(data){
            //         document.write(data);
            //     },
            //     error : function(xhr, status){
            //         console.log(xhr,status);
            //     }
            // });
        </script>
    </body>
</html>
