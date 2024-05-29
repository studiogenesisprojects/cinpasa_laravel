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
            <div class="col-lg-12 col-md-10">
                <h1 class="before-title">{{__('Noticias.seccion1_titulo')}}</h1>
                <p class="mt-3">{{__('Noticias.seccion1_texto')}}</p>
            </div>
        </div>
        <div class="row my-5">
            @foreach($news as $new)
            <div class="col-xl-4 col-md-6 py-4">
                
                    <div class="position-relative w-100">
						@if(Storage::exists('public/noticias/' . $new->image))
							<figure class="control_noticia" style="background-image:url('{{ Storage::url('noticias/' . $new->image) }}')"></figure>
						@else
							<figure class="control_noticia" style="background-image:url('{{ asset('front/img/no-foto.jpg') }}')"></figure>
						@endif
                    </div>
					<a href="{{LaravelLocalization::getURLFromRouteNameTranslated(App::getLocale(), 'routes.news.show', ["news" => $new->lang()->slug])}}" title="Accede al artículo" class="card d-block p-4 hover-shadow control_card">
						<p class="small">{{date('d/m/Y', strtotime($new->created_at))}}</p>
						<h4 class="mt-2">{{$new->lang()->title}}</h4>
						<p class="mt-3 lineheight-small"><small>{{ strip_tags(substr($new->lang()->content, 0, 120)) . '...'}}</small></p>
						<p class="btn mt-4 p-0 font-bold">{{__('Noticias.noticias_boton')}}<img class="ml-2" src="{{ asset('front/img/icon-arrow-right-black.svg') }}" alt="icono flecha derecha"></p>
					</a>
            </div>
            @endforeach
        </div>
        {{$news->links()}}
    </div>
</section>
@endsection
