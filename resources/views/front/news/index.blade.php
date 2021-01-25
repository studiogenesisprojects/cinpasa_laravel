@extends('front.common.main')
@section('meta-title', __('Noticias.meta-title'))
@section('meta-description', __('Noticias.meta-description'))
@section('content')
@include('front.home.carousel2')
<section class="slider">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div id="searcher-menu">
                    @include('front.home.barra-busqueda')
                </div>
            </div>
        </div>
    </div>
</section>
<section id="aplicaciones">
    <div class="container">
        <div class="row mt-5">
            <div class="col-lg-7 col-md-10">
                <h2 class="before-title">{{__('Noticias.seccion1_titulo')}}</h2>
                <p class="mt-3">{{__('Noticias.seccion1_texto')}}</p>
            </div>
        </div>
        <div class="row mt-5">
            @foreach($news as $new)
            <div class="col-xl-4 col-md-6">
                <div class="row mx-0 flex-column align-items-center hover-noticia">
                    <div class="position-relative w-100">
                        @if(Storage::exists('noticias/' . $new->image))
                            <img class="w-100 border-img hover-shadow" src="{{ Storage::url('noticias/' . $new->image) }}" alt="imagen noticia artículo">
                        @else
                            <img class="w-100 border-img hover-shadow" src="{{ asset('front/img/no-foto.jpg') }}" alt="imagen noticia artículo">
                        @endif
                        <div class="position-absolute t-1 l-1 d-flex align-items-center background-white perfil-container">
                            <img src="{{ asset('front/img/perfil-1.png') }}" alt="imagen perfil">
                        </div>
                    </div>
                    <div class="col-12 transform-t-20 cursor-pointer">
                        <a href="{{LaravelLocalization::getURLFromRouteNameTranslated(App::getLocale(), 'routes.news.show', ["news" => $new->lang()->slug])}}" title="Accede al artículo" class="card h-100 d-block p-4 hover-shadow">
                            <p class="small">{{date('d/m/Y', strtotime($new->created_at))}}</p>
                            <h4 class="mt-2">{{$new->lang()->title}}</h4>
                            <p class="mt-3 lineheight-small"><small>{{ strip_tags(substr($new->lang()->content, 0, 120)) . '...'}}</small></p>
                            <p class="btn mt-4 p-0 font-bold">{{__('Noticias.noticias_boton')}}<img class="ml-2" src="{{ asset('front/img/icon-arrow-right-black.svg') }}" alt="icono flecha derecha"></p>
                            <div class="tag-noticia t-0 r-1 transform-t-n50">Home</div>
                        </a>
                    </div>
                </div>
            </div>
            @endforeach
            {{$news->links()}}
        </div>
    </div>
</section>
@endsection
