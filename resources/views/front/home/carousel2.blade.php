@if($carousel)
<div class="container-fluid px-0">
    <div class="position-relative">
        <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel" data-interval="false">
            <div class="carousel-inner position-relative">
            @foreach ($carousel->slides as $slide)
                <div class="carousel-item position-relative overflow-hidden bg-cover bg-xl {{$loop->first == 1 ? 'active' : ''}}" style="background-image: url('{{Storage::url('app/'. $slide->image)}}');">
                    <img src="{{ route('carousel.getImage', str_replace("/",";",$slide->image)) }}" class="d-block w-100 w-lg-150 w-sm-200 w-xs-400" alt="primero slide">
                    <div class="position-absolute d-flex justify-content-center align-items-center w-100 h-100 t-0 l-0 z-1">
                        <div class="container">
                            <div class="row">
                                <div class="col-lg-6 col-md-8 col-10 offset-xl-0 offset-1">
                                    <h1 class="before-title">{{$slide->lang()->title}}</h1>
                                    <p class="color-white">{{$slide->lang()->text}}</p>
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
