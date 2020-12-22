@extends('front.common.main')

@section('content')
@include('front.home.carousel2')
<section id="aplicaciones">
    <div class="container">
        <div class="row mt-5">
            <div class="col-lg-7 mt-5">
                <h2 class="before-title">{{__('TrabajaConNosotros.titulo')}}</h2>
                <p class="mt-3">{{__('TrabajaConNosotros.subtitulo')}}</p>
            </div>
        </div>
        <div class="row mt-5">
            <div class="col-lg-4 mt-5">
                <h3>{{__('TrabajaConNosotros.titulo-categorias')}}</h3>
                <hr class="mt-4">
                <p class="mt-4">
                    {{__('TrabajaConNosotros.texto-categorias')}}
                </p>
            </div>
            <div class="col-lg-8 mt-5">
                <div class="row">
                    <div class="col-lg-4 col-md-6 offset-lg-2">
                        <img src="{{ asset('front/img/icon-trabaja-1.svg') }}" alt="icono vectorial oportunidades para crecer">
                        <h5 class="color-blue">{{__('TrabajaConNosotros.categoria1')}}</h5>
                        <p class="small mt-3">{{__('TrabajaConNosotros.categoria1-text')}}</p>
                    </div>
                    <div class="col-lg-4 col-md-6 offset-lg-2 mt-md-0 mt-4">
                        <img src="{{ asset('front/img/icon-trabaja-2.svg') }}" alt="icono vectorial tecnología">
                        <h5 class="color-blue">{{__('TrabajaConNosotros.categoria2')}}</h5>
                        <p class="small mt-3">{{__('TrabajaConNosotros.categoria2-text')}}</p>
                    </div>
                    <div class="col-lg-4 col-md-6 offset-lg-2 mt-4">
                        <img src="{{ asset('front/img/icon-trabaja-3.svg') }}" alt="icono vectorial aprendizaje">
                        <h5 class="color-blue">{{__('TrabajaConNosotros.categoria3')}}</h5>
                        <p class="small mt-3">{{__('TrabajaConNosotros.categoria3-text')}}</p>
                    </div>
                    <div class="col-lg-4 col-md-6 offset-lg-2 mt-4">
                        <img src="{{ asset('front/img/icon-trabaja-4.svg') }}" alt="icono vectorial comunicación">
                        <h5 class="color-blue">{{__('TrabajaConNosotros.categoria4')}}</h5>
                        <p class="small mt-3">{{__('TrabajaConNosotros.categoria4-text')}}</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<section>
    <div class="container mt-5">
        <div class="row">
            <div class="col-12 mt-5">
                <h3 class="before-title">{{__('TrabajaConNosotros.ofertas')}}</h3>
            </div>
            @foreach($offers as $offer)
                <div class="col-lg-3 col-sm-6 mt-4">
                    <div class="card p-3">
                        <p class="small color-blue">{{$offer->publication_date}}</p>
                        <p class="color-black font-bold">{{$offer->lang()->name}}</p>
                        <p class="small mt-2">{!!$offer->lang()->additional_info!!}</p>
                        <a href="{{LaravelLocalization::getURLFromRouteNameTranslated(App::getLocale(), 'routes.work-with-us.show', ['jobOffer' => $offer])}}" title="Ver oferta de gestor de proyectos" class="color-black font-bold mt-2">{{__('TrabajaConNosotros.ver-oferta')}} <img class="ml-2" src="{{ asset('front/img/icon-arrow-right-black.svg') }}" alt="icono flecha derecha"></a>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</section>
@endsection
