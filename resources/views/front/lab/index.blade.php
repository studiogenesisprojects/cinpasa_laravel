@extends('front.common.main')

@section('content')
@include('front.home.carousel2')
@section('meta-title', __('Lab.titulo_seo'))
@section('meta-description', __('Lab.descripcion_seo'))
<section id="aplicaciones">
    <div class="container">
        <div class="row mt-5">
            <div class="col-lg-7 col-md-10 mt-4">
                <h1 class="before-title">{{__('Lab.titulo')}}</h1>
                <p class="mt-3">{{__('Lab.text')}}</p>
                <p class="mt-3">
                    <a href="https://api.whatsapp.com/send?phone=34621283448&text=Hola,%20me%20gustar%C3%ADa%20recibir%20informaci%C3%B3n" title="{{ __('Comun.whatsapp_project_title') }}">
                        {{ __('Comun.whatsapp_project_title') }}
                        <img class="ml-3" src="{{ asset('front/img/icon-whatsapp.svg') }}" alt="whatsapp">
                    </a>
                </p>
            </div>
        </div>
    </div>
    <div class="container-fluid mt-5">
        <div class="row">
            @foreach($labs as $key => $lab)
            @if($key == 0)
            <div class="col-lg-6 px-0">
                <img class="w-100 border-bottom border-right" src="{{Storage::url($lab->secondary_image)}}" alt="CINTech">
                <div class="position-absolute col-sm-8 z-1 t-0 l-0 p-xs-5">
                    <h2 class="color-white mt-lg-0 mt-md-5">{{ $lab->name }}</h2>
                    <p class="color-white">{{ $lab->lang(App::getLocale()) ? $lab->lang(App::getLocale())->claim : '' }}</p>
                    <a href="{{LaravelLocalization::getURLFromRouteNameTranslated(App::getLocale(),'routes.lab.show_products',
                    ["slug" => $lab->slug
                ])}}" title="saber más sobre CINTech" class="btn btn-secundary mt-sm-4 mt-3 scale-xs-08">{{__('Lab.titulo')}} <img class="ml-4 mb-1" src="{{ asset('front/img/icon-arrow-right.svg') }}" alt="Icono flecha derecha"></a>
                </div>
            </div>
            @elseif($key == 1)
            <div class="col-lg-6 px-0 mt-lg-5">
                <img class="w-100 border-left border-bottom border-top-resp" src="{{Storage::url($lab->secondary_image)}}" alt="CINHome">
                 <div class="position-absolute col-sm-8 z-1 t-0 l-0 p-xs-5">
                    <h2 class="color-white mt-lg-0 mt-md-5">{{ $lab->name }}</h2>
                    <p class="color-white">{{  $lab->lang(App::getLocale()) ? $lab->lang(App::getLocale())->claim : '' }}</p>
                    <a href="{{LaravelLocalization::getURLFromRouteNameTranslated(App::getLocale(),'routes.lab.show_products',
                    ["slug" => $lab->slug
                ])}}" title="saber más sobre CINHome" class="btn btn-secundary mt-sm-4 mt-3 scale-xs-08">{{__('Lab.titulo')}} <img class="ml-4 mb-1" src="{{ asset('front/img/icon-arrow-right.svg') }}" alt="Icono flecha derecha"></a>
                </div>
            </div>
            @elseif($key % 2 == 0)
            <div class="col-lg-6 px-0 mt-lg-n5">
                <img class="w-100 border-bottom border-right" src="{{Storage::url($lab->secondary_image)}}" alt="CINTech">
                <div class="position-absolute col-sm-8 z-1 t-0 l-0 p-xs-5">
                    <h2 class="color-white mt-lg-0 mt-md-5">{{ $lab->name }}</h2>
                    <p class="color-white">{{ $lab->lang(App::getLocale()) ? $lab->lang(App::getLocale())->claim : '' }}</p>
                    <a href="{{LaravelLocalization::getURLFromRouteNameTranslated(App::getLocale(),'routes.lab.show_products',
                    ["slug" => $lab->slug
                ])}}" title="saber más sobre CINTech" class="btn btn-secundary mt-sm-4 mt-3 scale-xs-08">{{__('Lab.titulo')}} <img class="ml-4 mb-1" src="{{ asset('front/img/icon-arrow-right.svg') }}" alt="Icono flecha derecha"></a>
                </div>
            </div>
            @else
            <div class="col-lg-6 px-0 mt-1">
                <img class="w-100 border-left border-bottom border-top-resp" src="{{Storage::url($lab->secondary_image)}}" alt="CINHome">
                 <div class="position-absolute col-sm-8 z-1 t-0 l-0 p-xs-5">
                    <h2 class="color-white mt-lg-0 mt-md-5">{{ $lab->name }}</h2>
                    <p class="color-white">{{ $lab->lang(App::getLocale()) ? $lab->lang(App::getLocale())->claim : '' }}</p>
                    <a href="{{LaravelLocalization::getURLFromRouteNameTranslated(App::getLocale(),'routes.lab.show_products',
                    ["slug" => $lab->slug
                ])}}" title="saber más sobre CINHome" class="btn btn-secundary mt-sm-4 mt-3 scale-xs-08">{{__('Lab.titulo')}} <img class="ml-4 mb-1" src="{{ asset('front/img/icon-arrow-right.svg') }}" alt="Icono flecha derecha"></a>
                </div>
            </div>
            @endif
            @endforeach
        </div>
    </div>
</section>
@endsection
