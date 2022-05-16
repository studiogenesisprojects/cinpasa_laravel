@extends('front.common.main')

@section('content')
@include('front.home.carousel2')
@section('meta-title', __('Distribuir.titulo_seo'))
@section('meta-description', __('Distribuir.descripcion_seo'))
<section>
    <div class="container">
        <div class="row mt-5">
            <div class="col-lg-7 col-md-10 mt-5">
                <h1 class="before-title">{{__('Distribuir.titulo_pag')}}</h1>
                <p class="mt-3">{{__('Distribuir.text1_pag')}}</p>
            </div>
        </div>
    </div>
</section>

<section>
    <div class="container mt-5">
        <form id="contact" method="POST" action="{{ LaravelLocalization::getURLFromRouteNameTranslated(App::getLocale(),"routes.contact.store") }}">
            @csrf
            <input type="hidden" name="distribute" value="true">
            <div class="row">
                <div class="col-lg-5 col-md-6 mt-5">
                    <h2 class="before-title">{{__('Distribuir.titulo_form')}}</h2>
                    <div class="row mt-3">
                        <div class="col-xl-10">
                            <p>{{__('Distribuir.subtitulo_form')}}</p>
                            <div class="row flex-row flex-md-column">
                                @switch(App::getLocale())
                                    @case ('ca')
                                    @case ('es')
                                        <div class="col-md-12 col-sm-6 col-10">
                                            <div class="d-flex mt-4 align-items-start">
                                                <img src="{{ asset('front/img/icon-loc.svg') }}" alt="">
                                                <p class="ml-3 color-blue small">Raval de Sant Rafael, 21 E-43470 La Selva del Camp (Tarragona) Spain</p>
                                            </div>
                                        </div>
                                        @break
                                    @default
                                        @break
                                @endswitch
                                <div class="col-md-12 col-sm-6">
                                    <div class="d-flex mt-4 align-items-start">
                                        <img src="{{ asset('front/img/icon-phone.svg') }}" alt="">
                                        <p class="ml-3 color-blue small">{{__('Contacta.phone')}}</p>
                                    </div>
                                </div>
                            </div>
                            @switch(App::getLocale())
                                @case ('ca')
                                @case ('es')
                                    <p class="mt-5 font-bold color-black">{{__('ContactaFooter.come')}}</p>
                                    <div style="width: 100%;margin: auto;margin-top: 10px;"><iframe width="100%" height="400" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" src="https://maps.google.com/maps?width=100%25&amp;height=600&amp;hl=es&amp;q=Cintas%20y%20Pasamanerias%20SA+(Cintas%20y%20Pasamaneria%20SA)&amp;t=&amp;z=14&amp;ie=UTF8&amp;iwloc=B&amp;output=embed" title="abrir mapa de ubicación"></iframe><a href="https://www.mapsdirections.info/marcar-radio-circulo-mapa/" title="Cinpasa"></a></div>
                                    @break
                                @default
                                    @break
                            @endswitch
                        </div>
                    </div>
                </div>
                <div class="col-md-6 offset-lg-1 mt-5">
                    <div class="row">
                        <div class="col-12">
                            <div class="form-group">
                                <input type="text" required class="form-control background-blue-light @error('company') is-invalid @enderror" id="company" name="company" placeholder="{{__('Contacta.empresa')}} *" value="{{ old('company') }}">
                                @error('company')<small class="text-danger">{{ $message }}</small>@enderror
                            </div>
                        </div>
                        <div class="col-12 mt-3">
                            <div class="form-group">
                                <input type="text" required class="form-control background-blue-light @error('activity') is-invalid @enderror" name="activity" id="activity" placeholder="{{__('Distribuir.actividad_form')}}" value="{{ old('activity') }}">
                                @error('activity')<small class="text-danger">{{ $message }}</small>@enderror
                            </div>
                        </div>
                        <div class="col-12 mt-3">
                            <div class="form-group">
                                <input type="hidden" name="origen" id="origen">
                                <input type="text" class="form-control background-blue-light @error('name') is-invalid @enderror" required name="name" id="name" placeholder="{{__('Contacta.name')}}" value="{{ old('name') }}">
                                @error('name')<small class="text-danger">{{ $message }}</small>@enderror
                            </div>
                        </div>
                        @switch(App::getLocale())
                            @case ('ca')
                            @case ('es')
                                <div class="col-12 mt-3">
                                    <div class="form-group">
                                        <input type="email" class="form-control background-blue-light @error('email') is-invalid @enderror" name="email" id="email" required placeholder="{{__('Contacta.email')}}" value="{{ old('email') }}">
                                        @error('email')<small class="text-danger">{{ $message }}</small>@enderror
                                    </div>
                                </div>
                                @break
                            @default
                                @break
                        @endswitch
                        <div class="col-12 mt-3">
                            <div class="form-group">
                                <input type="phone" class="form-control background-blue-light @error('phone') is-invalid @enderror" required id="phone" name="phone" placeholder="{{__('Contacta.phone2')}} *" value="{{ old('phone') }}">
                                @error('phone')<small class="text-danger">{{ $message }}</small>@enderror
                            </div>
                        </div>
                        <div class="col-12 mt-3">
                            <div class="form-group">
                                <input type="url" class="form-control background-blue-light @error('web') is-invalid @enderror"" id="web" name="web" placeholder="{{__('Distribuir.web_form')}}" value="{{ old('web') }}">
                                @error('web')<small class="text-danger">{{ $message }}</small>@enderror
                            </div>
                        </div>
                        <div class="col-12 mt-3">
                            <br>
                            <div class="custom-control custom-checkbox mt-3">
                                <input type="checkbox" class="custom-control-input" name="politics" required id="politics">
                                <label class="custom-control-label" for="politics">{{__('Contacta.privacy')}}</label>
                                @error('politics')<small class="text-danger">{{ $message }}</small>@enderror
                            </div>
                            {!! RecaptchaV3::field('submit') !!}
                            <button type="submit" class="btn btn-primary mt-4" id="send">
                                {{__('Contacta.send')}}<img class="ml-4 mb-1" src="{{ asset('front/img/icon-arrow-right.svg') }}" alt="{{__('Contacta.send')}}">
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
