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

    </body>
</html>
