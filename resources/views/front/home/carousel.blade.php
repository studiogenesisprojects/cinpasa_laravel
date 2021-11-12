@if($carousel)
<div class="container-fluid px-0">
    <div class="position-relative">
        <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel" data-interval="false">
            <div class="carousel-inner position-relative">
            @foreach ($carousel->slides as $key => $slide)
                <div class="carousel-item position-relative overflow-hidden bg-cover bg-xl {{$loop->first == 1 ? 'active' : ''}}">
                    <img src="{{ Storage::url($slide->image) }}" class="d-block w-100 w-lg-150 w-sm-200 w-xs-400" alt="primero slide">
                    <div class="position-absolute d-flex justify-content-center align-items-center w-100 h-100 t-0 l-0 z-1">
                        <div class="container">
                            <div class="row">
                                <div class="col-lg-6 col-md-8 col-10 offset-xl-0 offset-1">
                                    @if($key == 0)
                                    <h1 class="before-title" style="color: white;">{{$slide->lang()->title}}</h1>
                                    @else
                                    <h2 class="before-title" style="color: white;">{{$slide->lang()->title}}</h2>
                                    @endif
                                    <p class="color-white">{{$slide->lang()->text}}</p>
                                    @if($key == 0)
                                    <a href="{{LaravelLocalization::getURLFromRouteNameTranslated(App::getLocale(),'routes.products.show', [
                                        "productCategory" => $homeApps[0],
                                    ])}}" title="saber más sobre líderes en fabricación de cintas y cintas para cortinas" class="btn btn-secundary mt-3">SABER MÁS <img class="ml-4 mb-1" src="{{ asset('front/img/icon-arrow-right.svg') }}" alt="Icono flecha derecha"></a>
                                    @elseif($key == 1)
                                    <a href="{{LaravelLocalization::getURLFromRouteNameTranslated(App::getLocale(),'routes.applications.show', [
                                        "applicationCategory" => 'tecnico-industrial'
                                    ])}}" title="saber más sobre líderes en fabricación de cintas y cintas para cortinas" class="btn btn-secundary mt-3">SABER MÁS <img class="ml-4 mb-1" src="{{ asset('front/img/icon-arrow-right.svg') }}" alt="Icono flecha derecha"></a>
                                    @elseif($key == 2)
                                    <a href="{{LaravelLocalization::getURLFromRouteNameTranslated(App::getLocale(),'routes.lab.index')}}" title="saber más sobre líderes en fabricación de cintas y cintas para cortinas" class="btn btn-secundary mt-3">SABER MÁS <img class="ml-4 mb-1" src="{{ asset('front/img/icon-arrow-right.svg') }}" alt="Icono flecha derecha"></a>
                                    @endif
                                    @if (count($carousel->slides) > 1)
                                    <ol class="carousel-indicators mb-5">
                                        @foreach ($carousel->slides as $key => $slide)
                                        <li data-target="#carouselSlider" data-slide-to="{{$key}}" class="{{$loop->first == 1 ? 'active' : ''}} "></li>
                                        @endforeach
                                    </ol>
                                    @endif
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endforeach
                <div class="position-absolute w-100 h-100">
                    <img class="w-100 w-lg-150 w-sm-200 w-xs-400" src="{{ asset('front/img/home-carousel-degraded.png') }}" alt="degradado">
                </div>
            </div>

        </div>
        @if (count($carousel->slides) > 1)
        <a class="carousel-control-prev" href="#carouselExampleIndicators" role="button" data-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="sr-only">Previous</span>
        </a>

        <a class="carousel-control-next" href="#carouselExampleIndicators" role="button" data-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="sr-only">Next</span>
        </a>
        @endif


    </div>
</div>
@endif
