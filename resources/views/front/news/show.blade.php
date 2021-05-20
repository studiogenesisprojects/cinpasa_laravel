@extends('front.common.main')

@section('content')
@section('meta-title', $news->lang()->seo_title)
@section('meta-description', $news->lang()->seo_description)
<section id="home">
    <div class="container">
        <div class="row">
            <div class="col-12 my-5 d-flex align-items-center">
                <a href="{{LaravelLocalization::getURLFromRouteNameTranslated(App::getLocale(),'routes.news.index')}}" title="Acceder al apartado noticias" class="mr-1 color-grey">Noticias</a> / {{$news->lang()->title}}
            </div>
            <div class="col-12 position-relative">
                <img class="w-100 border-img" src="{{ Storage::url('noticias/' . $news->image) }}" alt="imagen mascarilla">
                <div class="position-absolute t-1 r-2 d-flex align-items-center background-white border-radius-200">
                    <img src="{{ asset('front/img/perfil-1.png') }}" alt="imagen perfil">
                </div>
            </div>
        </div>
    </div>
</section>
<section id="aplicaciones">
    <article class="noticia-blog">
    <div class="container">
        <div class="row">

            <div class="col-md-7 offset-xl-1 mt-5">
                <p class="small">{{date('d/m/Y', strtotime($news->created_at))}}</p>
                <h1 class="mt-5 font-bold before-title">{{$news->lang()->title}}</h1>
                <p class="mt-3">{!! $news->lang()->content !!}</p>
            </div>
            <div class="col-xl-3 col-lg-4 col-md-5 col-sm-10 offset-lg-1 offset-md-0 offset-sm-1 offset-0 mt-5">
                <div class="card background-blue px-3 py-4">
                    <h5 class="color-white">{{__('Footer.subscribe')}}</h5>
                    <hr class="w-50 mt-3">
                    <form name="frmjoin" id="frmjoin" method="post" action="https://www.email-index.com/join.php?L=RblSsAJNHjFVyC7639jyAyzg" class="form" > <input value="" id="frm_guardar" name="frm_guardar" type="hidden" />
                        <input maxlength="" data-type="email" value="" id="frm_email" name="frm_email" type="text"  placeholder="Email*" class="form-control mt-3 border-0 background-white-opacity"  />
                        <input type='hidden' name='frm_email_format' id='frm_email_format' value='2'/>
                        <div class="custom-control custom-checkbox mt-3">
                            <input type="checkbox" class="custom-control-input" id="defaultChecked2" checked>
                            <label class="custom-control-label color-white small" for="defaultChecked2">{{__('Contacta.privacy')}}</label>
                        </div>
                        <button type="submit" title="Suscríbete a nuestro Newsletter" class="btn btn-primary mt-3">
                            {{__('Footer.seguir')}}<img class="ml-4 mb-1" src="{{ asset('front/img/icon-arrow-right.svg') }}" alt="icono flecha derecha">
                        </button>
                        <input type="hidden" name="frm_nc" id="frm_nc" value="1" />
                        <script id="embed_jquery" type="text/javascript" src="https://code.jquery.com/jquery-1.11.0.min.js"></script>
                        <script id="embed_script" type="text/javascript"  src="https://d1nn1beycom2nr.cloudfront.net/news/scripts/form.script.js"></script>
                    </form>
                </div>
                @if(sizeof($news->categories) > 0)
                    <hr class="mt-5">
                    <h5 class="color-black font-bold mt-4">{{__('Noticias.categorias')}}</h5>
                    @foreach ($news->categories as $cat)
                    <a href="{{LaravelLocalization::getURLFromRouteNameTranslated(App::getLocale(), 'routes.news.categories', [
                        "newsCategory" => $cat->lang(app()->getLocale())->slug,
                    ])}}" title="Accede a la categoría Decoración" class="d-flex justify-content-between align-items-center mt-2">
                        <p class="color-black mb-3">{{$cat->lang(app()->getLocale())->title}}</p>
                        <img src="{{ asset('front/img/arrow-right.svg') }}" alt="icono flecha derecha">
                    </a>
                    @if(!$loop->last) / @endif
                    @endforeach
                    <hr class="mt-5">
                @endif
                @if(sizeof($news->tags) > 0)
                    <h5 class="color-black font-bold mt-4">{{__('Noticias.tags')}}</h5>
                    <div class="d-flex flex-row flex-wrap mt-3">
                        @foreach ($news->tags as $tag)
                        <a href="{{LaravelLocalization::getURLFromRouteNameTranslated(App::getLocale(), 'routes.news.tags', [
                            "newsTag" => $tag->lang(App::getLocale())->slug,
                        ])}}" class="btn-noticia mt-3 px-3 py-2 ml-1">#{{$tag->lang(App::getLocale())->title}}</a>
                        @endforeach
                    </div>
                    <hr class="mt-5">
                @endif
                @if(sizeof($news->relatedNews) > 0)
                    <h5 class="color-black font-bold mt-4">{{__('Noticias.noticias-relacionadas')}}</h5>
                    <div class="d-flex flex-row flex-wrap mt-3">
                        @foreach ($news->relatedNews as $related)
                        <a href="{{LaravelLocalization::getURLFromRouteNameTranslated(App::getLocale(), 'routes.news.show', ["news" => $related])}}" class="btn-noticia mt-3 px-3 py-2 ml-1">{{$related->lang(App::getLocale())->title}}</a>
                        @endforeach
                    </div>
                @endif
            </div>
        </div>
    </div>
    </article>
    <hr class="mt-5">
</section>
@endsection
