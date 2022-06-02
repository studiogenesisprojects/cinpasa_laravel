<!DOCTYPE html>
<html lang="{{App::getLocale()}}">
    <!--<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>-->
    <script src="{{ asset('front/js/jquery.min.js') }}"></script>
    <!-- <script src="https://kit.fontawesome.com/62992c8b48.js" crossorigin="anonymous"></script> -->
    <script src="{{ asset('front/js/62992c8b48.js') }}"></script>
    @include('front.partials.head')

    <body class="menu-position-side menu-side-left full-screen with-content-panel">
        <div id="api-chat-bot"></div>

        <!-- Google Tag Manager (noscript) -->
        <noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-5R5VDBD"
        height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
        <!-- End Google Tag Manager (noscript) -->
        {!! EuCookieConsent::getPopup() !!}
        @include('front.partials.header')
        @if(!isset($no_contact))
            <a href="#info-request" title="{!!  strip_tags(__('Lab.more-info')) !!}" id="contact-button" class="btn-fixed btn-more-info">
                <img class="" src="{{ asset('front/img/envelope-open.svg') }}" alt="envelope">{{-- {!! __('Lab.more-info') !!} --}}
            </a>
        @endif
        @yield('content')

        @if(!isset($no_contact))
            @include('front.partials.formulario')
        @endif

        @if (empty($no_distribute))
            @include('front.partials.distribuir')
        @endif
        @include('front.partials.footer')
        @include('front.partials.js')
        @stack('js')

        <script>
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });

            $('.favorit').on('click', function(){
                $.ajax({
                    method: "POST",
                    url: '{{ route('fav') }}',
                    data: {
                        "value": $(this).attr('id').replace('btn-', '')
                    },
                    dataType: "json",
                    success : function(data){
                        $('.num-fav').html(data.count);
                        $('#favorites_count').html(data.count);
                        if(data.action) {
                            $('#'+data.product.id).addClass('active');
                            $('#btn-'+data.product.id).html('<i class="far fa-trash-alt mr-3"></i>{{ __('Productos.producto_mostrar_no_favorito') }}');

                        } else {
                            $('#'+data.product.id).removeClass('active');
                            $('#btn-'+data.product.id).html('<i class="far fa-heart mr-3"></i>{{ __('Productos.producto_mostrar_favoritos') }}');
                            $('#product-'+data.product.id).hide();
                        }
                    },
                    error : function(xhr, status){
                        console.log(xhr,status);
                    }
                });
            });

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
        <script>
        (function(d, s, t, id) {
            var js, fjs = d.getElementsByTagName(s)[0];
            if (d.getElementById(id)) return;
            js = d.createElement(s);
            js.id = t;
            js.src = "https://manager.citra.es/Widget/widget-archivos/widget-chat/widget.frame.js?version=3.2.0.7&var1=" + id;
            js.defer = true;
            fjs.parentNode.insertBefore(js, fjs);
        }(document, 'script', 'id-chat-widget',  '79715152772769a4c588c943a7e49cad'));
        </script>
    </body>
</html>
