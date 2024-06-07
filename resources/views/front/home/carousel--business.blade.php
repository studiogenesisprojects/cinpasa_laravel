@if($carousel_history)
<section id="historia">
    <div class="container mt-5">
        <div class="row">
            <div class="col-md-12 col-sm-10 mt-5">
                <h2 class="before-title">{{__('Empresa.titulo_historia')}}</h2>
                <p class="mt-3">
                    {{__('Empresa.texto_historia')}}
                </p>
            </div>
        </div>
    </div>
    <div id="carousel-historia" class="carousel slide mt-5" data-ride="carousel" data-interval="false">
        <div class="carousel-inner">

            @foreach ($carousel_history->slides as $slide)
            <div class="carousel-item {{$loop->first == 1 ? 'active' : ''}}">
                <div class="row mx-0 position-relative justify-content-center mt-5">
                    <div class="col-lg-6 col-md-6 col-sm-8 col-10 d-flex flex-column justify-content-center order-lg-1 order-2 my-lg-0 my-5">
                        <img class="d-block w-100 img-historia" src="{{ Storage::url($slide->image) }}" alt="primer slide">
                    </div>
                    <div class="col-lg-4 col-10 d-flex flex-column order-lg-2 order-1">
                        <div class="mt-3">
                            <h2 class="font-year color-blue">{{$slide->lang()->title}}</h2>
                            <h3 class="mt-5 before-title">{{$slide->lang()->title_url}}</h3>
                            <p class="mt-3">{{$slide->lang()->text}}</p>
                        </div>
                    </div>
                    <div class="background-grey-light position-absolute background-carousel vw-100 z-n1 position-center-t"></div>
                </div>
            </div>
            @endforeach
        </div>
        <a class="carousel-control-prev" href="#carousel-historia" role="button" data-slide="prev">
            <span class="carousel-control-prev-icon" aria-hidden="true"></span>
            <span class="sr-only">Previous</span>
        </a>
        <a class="carousel-control-next" href="#carousel-historia" role="button" data-slide="next">
            <span class="carousel-control-next-icon" aria-hidden="true"></span>
            <span class="sr-only">Next</span>
        </a>
    </div>
</section>
@endif
