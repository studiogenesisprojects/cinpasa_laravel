<!DOCTYPE html>
<html lang="es">
    @include('front.partials.head')
    <body class="menu-position-side menu-side-left full-screen with-content-panel">
        {{--  --}}
        @include('front.partials.header')
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
        </script>
    </body>
</html>
