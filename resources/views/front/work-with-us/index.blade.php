@extends('front.common.main')

@section('content')
@include('front.home.carousel2')
@section('meta-title', "{{__('TrabajaConNosotros.titulo_seo')}}")
@section('meta-description', "{{__('TrabajaConNosotros.descripcion_seo')}}")
<section id="aplicaciones">
    <div class="container">
        <div class="row mt-5 justify-content-center">
            <div class="col-lg-7 mt-5">
                <h2 class="before-title-center text-center">{{__('TrabajaConNosotros.titulo')}}</h2>
                <p class="mt-3 text-center">{{__('TrabajaConNosotros.subtitulo')}}</p>
            </div>
        </div>
        <div class="row mt-5">
            <div class="col-lg-3 col-sm-6 mt-5 text-center">
                <img src="{{ asset('front/img/icon-electromecanico.svg') }}" alt="icono vectorial electromecánico">
                <h5 class="color-blue mt-3">{{__('TrabajaConNosotros.categoria1')}}</h5>
                <p class="small mt-sm-4 mt-2">{{__('TrabajaConNosotros.categoria1-text')}}</p>
            </div>
            <div class="col-lg-3 col-sm-6 mt-5 text-center">
                <img src="{{ asset('front/img/icon-operario.svg') }}" alt="icono vectorial oportunidades para crecer">
                <h5 class="color-blue mt-3">{{__('TrabajaConNosotros.categoria2')}}</h5>
                <p class="small mt-sm-4 mt-2">{{__('TrabajaConNosotros.categoria2-text')}}</p>
            </div>
            <div class="col-lg-3 col-sm-6 mt-5 text-center">
                <img src="{{ asset('front/img/icon-marketing.sv') }}g" alt="icono vectorial oportunidades para crecer">
                <h5 class="color-blue mt-3">{{__('TrabajaConNosotros.categoria3')}}</h5>
                <p class="small mt-sm-4 mt-2">{{__('TrabajaConNosotros.categoria3-text')}}</p>
            </div>
            <div class="col-lg-3 col-sm-6 mt-5 text-center">
                <img src="{{ asset('front/img/icon-compras.svg') }}" alt="icono vectorial oportunidades para crecer">
                <h5 class="color-blue mt-3">{{__('TrabajaConNosotros.categoria4')}}</h5>
                <p class="small mt-sm-4 mt-2">{{__('TrabajaConNosotros.categoria4-text')}}</p>
            </div>
        </div>
    </div>
</section>

<section id="porque">
    <div class="container mt-5">
        <div class="row">
            <div class="col-12 mt-5">
                <h3 class="before-title">{{__('TrabajaConNosotros.mision')}}</h3>
            </div>
            <div class="col-lg-5 col-md-6 pr-lg-0 pr-3 mt-5">
                <img class="w-100 border-img" src="{{ asset('front/img/mision-1.jpg') }}" alt="">
                <p class="mt-3"><strong>{{__('TrabajaConNosotros.mision1-strong')}}</strong> {{__('TrabajaConNosotros.mision1-text')}}</p>
            </div>
            <div class="col-lg-5 col-md-6 offset-lg-1 pr-lg-0 pr-3 mt-5">
                <img class="w-100 border-img" src="{{ asset('front/img/mision-2.jpg') }}" alt="">
                <p class="mt-3"><strong>{{__('TrabajaConNosotros.mision2-strong')}}</strong> {{__('TrabajaConNosotros.mision2-text')}}</p>
            </div>
        </div>
    </div>
</section>

<section>
    <div class="container mt-5">
        <div class="row">
            <div class="col-12 mt-5">
                <h3 class="before-title">{{__('TrabajaConNosotros.equipo')}}</h3>
            </div>
        </div>
    </div>
    <div class="container-fluid mt-5 px-0 text-center">
        <div class="row mx-auto my-auto">
            <div id="myCarousel" class="carousel slide w-100" data-ride="carousel" data-interval="false">
                <div class="carousel-inner-multi w-100" role="listbox">
                    <div class="carousel-item carousel-item-multi active">
                        <div class="col-lg-4 col-md-6 px-0">
                            <img class="w-100" src="{{ asset('front/img/trabaja-carousel-1.jpg') }}" alt="">
                        </div>
                    </div>
                    <div class="carousel-item carousel-item-multi">
                        <div class="col-lg-4 col-md-6 px-0">
                            <img class="w-100" src="{{ asset('front/img/trabaja-carousel-2.jpg') }}" alt="">
                        </div>
                    </div>
                    <div class="carousel-item carousel-item-multi">
                        <div class="col-lg-4 col-md-6 px-0">
                            <img class="w-100" src="{{ asset('front/img/trabaja-carousel-3.jpg') }}" alt="">
                        </div>
                    </div>
                    <div class="carousel-item carousel-item-multi">
                        <div class="col-lg-4 col-md-6 px-0">
                            <img class="w-100" src="{{ asset('front/img/trabaja-carousel-4.jpg') }}" alt="">
                        </div>
                    </div>
                </div>
                <a class="carousel-control-prev w-auto" href="#myCarousel" role="button" data-slide="prev">
                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                    <span class="sr-only">Previous</span>
                </a>
                <a class="carousel-control-next w-auto" href="#myCarousel" role="button" data-slide="next">
                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                    <span class="sr-only">Next</span>
                </a>
            </div>
        </div>
    </div>
</section>
@include('front.partials.send-cv')
@endsection
