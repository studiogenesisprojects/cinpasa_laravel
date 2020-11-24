@extends('front.common.main')

@section('content')
<section id="aplicaciones">
    <div class="container">
        <div class="row">
            <div class="col-md-7 offset-xl-1 mt-5">
                <p class="small">06 JULIO, 2020</p>
                <h2 class="mt-5 font-bold before-title">{{$news->lang()->title}}</h2>
                <p class="mt-3">{!! $news->lang()->content !!}</p>
            </div>
            <div class="col-xl-3 col-lg-4 col-md-5 col-sm-10 offset-lg-1 offset-md-0 offset-sm-1 offset-0 mt-5">
                {{-- <div class="card background-blue px-3 py-4">
                    <h5 class="color-white">SUSCRÍBETE A NUESTRO NEWSLETTER</h5>
                    <p class="color-white mt-3 small">Quidem excepturi repellendus adipisci ut maxime blanditiis. Laborum nisi repellendus nemo et. </p>
                    <hr class="w-50 mt-3">
                    <input type="text" class="form-control mt-3 border-0 background-white-opacity" id="" placeholder="Escribe tu e-mail…">
                    <div class="custom-control custom-checkbox mt-3">
                        <input type="checkbox" class="custom-control-input" id="defaultChecked2" checked>
                        <label class="custom-control-label color-white small" for="defaultChecked2">He leído y acepto la política de privacidad.</label>
                    </div>
                    <a href="#" title="Suscríbete a nuestro Newsletter" class="btn btn-primary mt-3">
                        SUSCRIBIRME<img class="ml-4 mb-1" src="img/icon-arrow-right.svg" alt="icono flecha derecha">
                    </a>
                </div> --}}
                <hr class="mt-5">
                <h5 class="color-black font-bold mt-4">CATEGORÍAS</h5>
                @foreach ($news->categories as $cat)
                <a href="{{LaravelLocalization::getURLFromRouteNameTranslated(App::getLocale(), 'routes.news.categories', [
                    "noticiaCategoria" => $cat->lang(app()->getLocale())->slug
                ])}}" title="Accede a la categoría Decoración" class="d-flex justify-content-between align-items-center mt-5">
                    <p class="color-black mb-3">{{$cat->lang(app()->getLocale())->title}}</p>
                    <img src="{{ asset('front/img/arrow-right.svg') }}" alt="icono flecha derecha">
                </a>
                @if(!$loop->last) / @endif
                @endforeach
                <hr class="mt-5">
                <h5 class="color-black font-bold mt-4">TAGS</h5>
                <div class="d-flex flex-row flex-wrap mt-3">
                    @foreach ($news->tags as $tag)
                    <a href="{{LaravelLocalization::getURLFromRouteNameTranslated(App::getLocale(), 'routes.news.tags', [
                        "noticiaEtiqueta" => $tag->lang(App::getLocale())->slug
                    ])}}" class="btn-noticia mt-3 px-3 py-2 ml-1">#{{$tag->lang(App::getLocale())->title}}</a>
                    @endforeach
                </div>
                <hr class="mt-5">
                <h5 class="color-black font-bold mt-4">NOTÍCIAS RELACIONADAS</h5>
                <div class="d-flex flex-row flex-wrap mt-3">
                    @foreach ($news->relatedNews as $related)
                    <a href="{{LaravelLocalization::getURLFromRouteNameTranslated(App::getLocale(), 'routes.news.show', ["news" => $related])}}" class="btn-noticia mt-3 px-3 py-2 ml-1">{{$related->lang(App::getLocale())->title}}</a>
                    @endforeach
                </div>

            </div>
        </div>
    </div>
    <hr class="mt-5">
</section>
@endsection
