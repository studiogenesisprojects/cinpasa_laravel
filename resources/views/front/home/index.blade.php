@extends('front.common.main')

@section('content')
    <a href="{{LaravelLocalization::getURLFromRouteNameTranslated(App::getLocale(),'routes.contact.index')}}" title="Accede a la categoría contacta" class="btn-fixed">
        <img class="mr-2" src="{{ asset('front/img/icon-contacta.svg') }}" alt="Icono contacto">¿MÁS INFORMACIÓN?
    </a>
    <section id="home">
            @include('front.home.carousel')
            @include('front.home.barra-busqueda')
        </div>
    </section>
    <section id="categorias">
        <div class="container-fluid">
            <div class="row justify-content-center mt-5">
                <h2 class="before-title-center">{{__('Inicio.seccion1_titulo')}}</h2>
            </div>
            <div class="row mt-5">
                @include('front.home.categories')
            </div>
            <div class="row justify-content-center">
                <a href="{{LaravelLocalization::getURLFromRouteNameTranslated(App::getLocale(),'routes.products.index')}}" title="Acceder a todas las categorías" class="btn btn-primary my-5 after-title-center position-relative">
                    {{__('Inicio.seccion1_boton_2')}} <img class="ml-4 mb-1" src="{{ asset('front/img/icon-arrow-right.svg') }}" alt="icono flecha derecha">
                </a>
            </div>
        </div>
    </section>

    <section>
        <div class="container">
            <div class="row my-5 align-items-end">
               <div class="col-lg-5 col-md-6 col-10 offset-md-0 offset-1 order-md-1 order-2 mt-md-0 mt-5">
                    <img class="w-100" src="{{ asset('front/img/sobrenosotros.jpg') }}" alt="imagen sobre nosotros">
                </div>
                <div class="col-md-6 offset-lg-1">
                    <h3>{{__('Inicio.seccion2_titulo')}}</h3>
                    <hr class="my-3">
                    <p>{{__('Inicio.seccion2_texto')}}</p>
                    <a href="{{LaravelLocalization::getURLFromRouteNameTranslated(App::getLocale(),'routes.products.index')}}" title="Acceder a todas las categorías" class="btn btn-primary mt-4">
                        {{__('Inicio.seccion2_boton')}} <img class="ml-4 mb-1" src="{{ asset('front/img/icon-arrow-right.svg') }}" alt="icono flecha derecha">
                    </a>
                </div>
            </div>
        </div>
    </section>

    <section id="CIN">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-sm-10 col-12">
                    <h2 class="mt-5 before-title-center text-center">{{__('Inicio.seccion3_titulo')}}</h2>
                    <p class="text-center mt-3">{{__('Inicio.seccion3_subtitulo')}}</p>
                </div>
            </div>
        @include('front.home.cin-lines')
        </div>
    </section>

    <section class="background-grey-light">
        <div class="container">
            <div class="row">
                <div class="col-lg-6 col-md-10 mt-5">
                    <h3>{{__('Inicio.seccion4_titulo')}}</h3>
                    <a href="{{LaravelLocalization::getURLFromRouteNameTranslated(App::getLocale(),'routes.news.index')}}" class="btn btn-primary mt-4">
                        {{__('Inicio.seccion4_boton')}} <img class="ml-4 mb-1" src="{{ asset('front/img/icon-arrow-right.svg') }}" alt="icono flecha derecha">
                    </a>
                </div>
            </div>
            <div class="row mt-5">
                @include('front.home.actualidad')
            </div>
        </div>
    </section>
@endsection
