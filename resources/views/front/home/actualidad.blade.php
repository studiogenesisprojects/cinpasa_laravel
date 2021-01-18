@foreach($featuredNews as $news)
<div class="col-md-4">
    <div class="row mx-0 flex-column align-items-center">
        <img class="w-100 border-img" src="{{ Storage::url($news->news->image) }}" alt="imagen noticia actualidad">
        <div class="col-sm-11 transform-t-20">
            <div class="card d-block p-4">
                <p class="small">{{\Carbon\Carbon::parse($news->news->created_at)->format('d/m/Y')}}</p>
                <h4 class="mt-2 color-black">{{$news->news->lang()->title}}</h4>
                <p class="mt-3">{{$news->news->lang()->description}}</p>
                <a href="{{LaravelLocalization::getURLFromRouteNameTranslated(App::getLocale(), 'routes.news.show', [
                    "news" => $news->news
                    ])}}" title="Leer más sobre la noticia" class="btn btn-primary mt-4">
                    LEER MÁS<img class="ml-4 mb-1" src="{{ asset('front/img/icon-arrow-right.svg') }}" alt="icono flecha derecha">
                </a>
            </div>
        </div>
    </div>
</div>
@endforeach
