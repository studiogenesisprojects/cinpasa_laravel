@extends('front.common.main')

@section('content')
@include('front.home.carousel2')
@section('meta-title', __('Empresa.titulo_seo'))
@section('meta-description', __('Empresa.descripcion_seo'))
<section id="porque">
    <div class="container mt-5">
        <div class="row">
            <div class="col-12 mt-lg-5">
                <h1>{{__('Empresa.titulo')}}</h1>
                <hr class="mt-3">
            </div>
        </div>
        {{-- {{dd(__('Empresa.titulo_seo'))}} --}}
        <div class="row mt-md-5">
            <div class="col-md-1 col-2  mt-md-0 mt-5">
                <img src="{{ asset('front/img/icon-empresa-1.svg') }}" alt="icono referencias">
            </div>
            <div class="col-md-4 col-10 d-flex mt-md-0 mt-5">
                <hr class="hr-vertical background-blue-light">
                <div class="ml-4">
                    <h6>{{__('Empresa.seccion1_titulo')}}</h6>
                    <p class="lineheight-small mt-2"><small>{{__('Empresa.seccion1_texto')}}</small></p>
                </div>
            </div>
            <div class="col-md-1 col-2 offset-md-1 mt-md-0 mt-5">
                <img src="{{ asset('front/img/icon-empresa-2.svg') }}" alt="icono medida">
            </div>
            <div class="col-md-4 col-10 mt-md-0 mt-5 d-flex">
                <hr class="hr-vertical background-blue-light">
                <div class="ml-4">
                    <h6>{{__('Empresa.seccion2_titulo')}}</h6>
                    <p class="lineheight-small mt-2"><small>{{__('Empresa.seccion2_texto')}}</small></p>
                </div>
            </div>
        </div>
        <div class="row mt-md-5 mt-0">
            <div class="col-md-1 col-2 mt-md-0 mt-5">
                <img src="{{ asset('front/img/icon-empresa-3.svg') }}" alt="icono personalizacio">
            </div>
            <div class="col-md-4 col-10 mt-md-0 mt-5 d-flex">
                <hr class="hr-vertical background-blue-light">
                <div class="ml-4">
                    <h6>{{__('Empresa.seccion3_titulo')}}</h6>
                    <p class="lineheight-small mt-2"><small>{{__('Empresa.seccion3_texto')}}</small></p>
                </div>
            </div>
            <div class="col-md-1 col-2 offset-md-1 mt-md-0 mt-5">
                <img src="{{ asset('front/img/icon-empresa-4.svg') }}" alt="icono producción">
            </div>
            <div class="col-md-4 col-10 mt-md-0 mt-5 d-flex">
                <hr class="hr-vertical background-blue-light">
                <div class="ml-4">
                    <h6>{{__('Empresa.seccion4_titulo')}}</h6>
                    <p class="lineheight-small mt-2"><small>{{__('Empresa.seccion4_texto')}}</small></p>
                </div>
            </div>
        </div>
        <div class="row mt-md-5 mt-0">
            <div class="col-md-1 col-2  mt-md-0 mt-5">
                <img src="{{ asset('front/img/icon-empresa-5.svg') }}" alt="icono satisfacción">
            </div>
            <div class="col-md-4 col-10 d-flex mt-md-0 mt-5">
                <hr class="hr-vertical background-blue-light">
                <div class="ml-4">
                    <h6>{{__('Empresa.seccion5_titulo')}}</h6>
                    <p class="lineheight-small mt-2"><small>{{__('Empresa.seccion5_texto')}}</small></p>
                </div>
            </div>
            <div class="col-md-1 col-2 offset-md-1 mt-md-0 mt-5">
                <img src="{{ asset('front/img/icon-empresa-6.svg') }}" alt="icono líderes">
            </div>
            <div class="col-md-4 col-10 mt-md-0 mt-5 d-flex">
                <hr class="hr-vertical background-blue-light">
                <div class="ml-4">
                    <h6>{{__('Empresa.seccion6_titulo')}}</h6>
                    <p class="lineheight-small mt-2"><small>{{__('Empresa.seccion6_texto')}}</small></p>
                </div>
            </div>
        </div>
        <div class="row mt-5">
            <img src="{{ asset('front/img/empresa-1.jpg') }}" alt="imagen youtube" class="w-100 border-img mt-5">
        </div>
    </div>
</section>

<hr class="mt-5">

<section>
    <div class="container mt-5">
        <div class="row">
            <div class="col-md-12">
                <h2 class="mt-5 before-title">{{__('Empresa.titulo_subtitulo1')}}</h2>
                <p class="mt-3 color-blue mb-5">{{__('Empresa.titulo_subtitulo1_texto1')}}<br>
                    <br>{{__('Empresa.titulo_subtitulo1_texto2')}}</p>
            </div>
        </div>
    </div>
</section>

<hr class="mt-5">

<section>
    <div class="container mt-5">
        <div class="row">
            <div class="col-md-12">
                <h2 class="mt-5 before-title">{{__('Empresa.titulo_subtitulo2')}}</h2>
                <p class="mt-3 color-blue mb-5">{{__('Empresa.titulo_subtitulo2_texto1')}}<br>
                    <br>{{__('Empresa.titulo_subtitulo2_texto2')}}</p>
                    <img class="img-fluid" src="{{ asset('front/img/logos-beneficiarios.png') }}" alt="">
            </div>
            
        </div>
    </div>
</section>

<hr class="mt-5">

@include('front.home.carousel--business')

@endsection
