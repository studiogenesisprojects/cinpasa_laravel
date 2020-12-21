@extends('front.common.main')

@section('content')
@include('front.home.carousel2')
<a href="contacta.php" title="Accede a la categoría contacta" class="btn-fixed">
    <img class="mr-2" src="{{ asset('front/img/icon-contacta.svg') }}" alt="Icono contacto">¿MÁS INFORMACIÓN?
</a>
<section id="aplicaciones">
    <div class="container">
        <div class="row mt-5">
            <div class="col-lg-7 col-md-10 mt-4">
                <h2 class="before-title">{{__('Lab.titulo')}}</h2>
                <p class="mt-3">{{__('Lab.text')}}</p>
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
                    <p class="color-white">{{ $lab->description }}</p>
                    <a href="{{LaravelLocalization::getURLFromRouteNameTranslated(App::getLocale(),'routes.lab.show_products',
                    ["slug" => $lab->slug
                ])}}" title="saber más sobre CINTech" class="btn btn-secundary mt-sm-4 mt-3 scale-xs-08">MÁS INFORMACIÓN <img class="ml-4 mb-1" src="{{ asset('front/img/icon-arrow-right.svg') }}" alt="Icono flecha derecha"></a>
                </div>
            </div>
            @elseif($key == 1)
            <div class="col-lg-6 px-0 mt-lg-5">
                <img class="w-100 border-left border-bottom border-top-resp" src="{{Storage::url($lab->secondary_image)}}" alt="CINHome">
                 <div class="position-absolute col-sm-8 z-1 t-0 l-0 p-xs-5">
                    <h2 class="color-white mt-lg-0 mt-md-5">{{ $lab->name }}</h2>
                    <p class="color-white">{{ $lab->description }}</p>
                    <a href="{{LaravelLocalization::getURLFromRouteNameTranslated(App::getLocale(),'routes.lab.show_products',
                    ["lab" => $lab
                ])}}" title="saber más sobre CINHome" class="btn btn-secundary mt-sm-4 mt-3 scale-xs-08">MÁS INFORMACIÓN <img class="ml-4 mb-1" src="{{ asset('front/img/icon-arrow-right.svg') }}" alt="Icono flecha derecha"></a>
                </div>
            </div>
            @elseif($key % 2 == 0)
            <div class="col-lg-6 px-0 mt-lg-n5">
                <img class="w-100 border-bottom border-right" src="{{Storage::url($lab->secondary_image)}}" alt="CINTech">
                <div class="position-absolute col-sm-8 z-1 t-0 l-0 p-xs-5">
                    <h2 class="color-white mt-lg-0 mt-md-5">{{ $lab->name }}</h2>
                    <p class="color-white">{{ $lab->description }}</p>
                    <a href="{{LaravelLocalization::getURLFromRouteNameTranslated(App::getLocale(),'routes.lab.show_products',
                    ["lab" => $lab
                ])}}" title="saber más sobre CINTech" class="btn btn-secundary mt-sm-4 mt-3 scale-xs-08">MÁS INFORMACIÓN <img class="ml-4 mb-1" src="{{ asset('front/img/icon-arrow-right.svg') }}" alt="Icono flecha derecha"></a>
                </div>
            </div>
            @else
            <div class="col-lg-6 px-0 mt-1">
                <img class="w-100 border-left border-bottom border-top-resp" src="{{Storage::url($lab->secondary_image)}}" alt="CINHome">
                 <div class="position-absolute col-sm-8 z-1 t-0 l-0 p-xs-5">
                    <h2 class="color-white mt-lg-0 mt-md-5">{{ $lab->name }}</h2>
                    <p class="color-white">{{ $lab->description }}</p>
                    <a href="{{LaravelLocalization::getURLFromRouteNameTranslated(App::getLocale(),'routes.lab.show_products',
                    ["lab" => $lab
                ])}}" title="saber más sobre CINHome" class="btn btn-secundary mt-sm-4 mt-3 scale-xs-08">MÁS INFORMACIÓN <img class="ml-4 mb-1" src="{{ asset('front/img/icon-arrow-right.svg') }}" alt="Icono flecha derecha"></a>
                </div>
            </div>
            @endif
            @endforeach
        </div>
    </div>
</section>
@endsection
