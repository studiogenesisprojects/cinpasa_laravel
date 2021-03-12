@extends('front.common.main')

@section('content')
@include('front.home.carousel2')
<section>
    <div class="container">
        <div class="row mt-5">
            <div class="col-lg-7 col-md-10 mt-5">
                <h2 class="before-title">{{__('Distribuir.titulo_pag')}}</h2>
                <p class="mt-3">{{__('Distribuir.text1_pag')}}</p>
            </div>
        </div>
    </div>
</section>

<section>
    <div class="container mt-5">
        <form action="{{LaravelLocalization::getURLFromRouteNameTranslated(App::getLocale(), 'routes.contact.store')}}" method="POST">
            @csrf
            <div class="row">
                <div class="col-lg-5 col-md-6 mt-5">
                    <h1 class="before-title">{{__('Distribuir.titulo_form')}}</h1>
                    <div class="row mt-3">
                        <div class="col-xl-10">
                            <p>{{__('Distribuir.subtitulo_form')}}</p>
                            <div class="row flex-row flex-md-column">
                                <div class="col-md-12 col-sm-6 col-10">
                                    <div class="d-flex mt-4 align-items-start">
                                        <img src="{{ asset('front/img/icon-loc.svg') }}" alt="">
                                        <p class="ml-3 color-blue small">Raval de Sant Rafael, 21 E-43470 La Selva del Camp (Tarragona) Spain</p>
                                    </div>
                                </div>
                                <div class="col-md-12 col-sm-6">
                                    <div class="d-flex mt-4 align-items-start">
                                        <img src="{{ asset('front/img/icon-phone.svg') }}" alt="">
                                        <p class="ml-3 color-blue small">{{__('Contacta.phone')}}</p>
                                    </div>
                                </div>
                            </div>
                            <p class="mt-5 font-bold color-black">{{__('ContactaFooter.come')}}</p>
                            <div style="width: 100%;margin: auto;margin-top: 10px;"><iframe width="100%" height="400" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" src="https://maps.google.com/maps?width=100%25&amp;height=600&amp;hl=es&amp;q=Cintas%20y%20Pasamanerias%20SA+(Cintas%20y%20Pasamaneria%20SA)&amp;t=&amp;z=14&amp;ie=UTF8&amp;iwloc=B&amp;output=embed"></iframe><a href="https://www.mapsdirections.info/marcar-radio-circulo-mapa/"></a></div>
                        </div>
                    </div>
                </div>
                <div class="col-md-6 offset-lg-1 mt-5">
                    <div class="row">
                        <div class="col-12">
                            <div class="form-group">
                                <input type="text" class="form-control background-blue-light" id="" placeholder="{{__('Contacta.empresa')}}">
                            </div>
                        </div>
                        <div class="col-12 mt-3">
                            <div class="form-group">
                                <input type="text" class="form-control background-blue-light" name="activity" id="" placeholder="{{__('Distribuir.actividad_form')}}">
                            </div>
                        </div>
                        <div class="col-12 mt-3">
                            <div class="form-group">
                                <input type="hidden" name="origen" id="origen">
                                <input type="text" class="form-control background-blue-light" name="name" id="" placeholder="{{__('Contacta.name')}}">
                            </div>
                        </div>
                        <div class="col-12 mt-3">
                            <div class="form-group">
                                <input type="text" class="form-control background-blue-light" name="email" id="" placeholder="E-mail *">
                            </div>
                        </div>
                        <div class="col-12 mt-3">
                            <div class="form-group">
                                <input type="text" class="form-control background-blue-light" id="" name="phone" placeholder="{{__('Contacta.phone2')}}">
                            </div>
                        </div>
                        <div class="col-12 mt-3">
                            <div class="form-group">
                                <input type="text" class="form-control background-blue-light" id="" name="web" placeholder="{{__('Distribuir.web_form')}}">
                            </div>
                        </div>
                        <div class="col-12 mt-3">
                            <br>
                            {!! htmlFormSnippet() !!}
                            <div class="custom-control custom-checkbox mt-3">
                                <input type="checkbox" class="custom-control-input" name="politics" required id="politics">
                                <label class="custom-control-label" for="politics">{{__('Contacta.privacy')}}</label>
                            </div>
                            <button type="submit" title="" class="btn btn-primary mt-4">
                                {{__('Contacta.send')}}<img class="ml-4 mb-1" src="{{ asset('front/img/icon-arrow-right.svg') }}" alt="">
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
</section>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script>

    $(document).ready(function(){
        var origen = window.location.href.substring(window.location.href.lastIndexOf('/') + 1);
        if(origen == '') {
            origen = 'Home';
        }
        $('#origen').val(origen);
    });

</script>
@endsection
