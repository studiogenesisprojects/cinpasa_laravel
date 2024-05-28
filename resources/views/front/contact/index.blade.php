@extends('front.common.main')

@section('content')
@include('front.home.carousel2')
@section('meta-title', __('Contacta.titulo_seo'))
@section('meta-description', __('Contacta.descripcion_seo'))
<section id="aplicaciones">
    <div class="container">
        <form action="{{ LaravelLocalization::getURLFromRouteNameTranslated(App::getLocale(),"routes.contact.store") }}" method="POST">
            <input type="hidden" name="origen" value="contact" />
        @csrf
            <div class="row">
                <div class="col-lg-8 transform-t-5">
                    <div class="card flex-row flex-wrap p-4">
                        @if (Session::has('message'))
                            <div class="col-12 px-0">
                                <div class="alert alert-danger">{{ Session::get('message') }}</div>
                            </div>
                        @endif

                        @error('g-recaptcha-response')
                            <div class="col-12 px-0">
                                <div class="alert alert-danger">Captcha error</div>
                            </div>
                        @enderror

                        <div class="col-12 px-0">
                            <div class="form-group">
                                <input type="text" id="name" name="name" class="form-control background-blue-light  @error('name') is-invalid @enderror" placeholder="{{__('Contacta.name')}}" required value="{{ old('name') }}">
                                @error('name')<small class="text-danger">{{ $message }}</small>@enderror
                            </div>
                        </div>
                        <div class="col-6 pl-0 mt-3">
                            <div class="form-group">
                                <input type="email" required name="email" class="form-control background-blue-light @error('email') is-invalid @enderror" id="email" placeholder="{{__('Contacta.email')}}">
                                @error('email')<small class="text-danger">{{ $message }}</small>@enderror
                            </div>
                        </div>
                        <div class="col-6 pr-0 mt-3">
                            <div class="form-group">
                                <input type="phone" id="phone" required name="phone" class="form-control background-blue-light @error('phone') is-invalid @enderror" placeholder="{{__('Contacta.phone_form')}}" value="{{ old('phone') }}">
                                @error('phone')<small class="text-danger">{{ $message }}</small>@enderror
                            </div>
                        </div>
                        <div class="col-12 px-0 mt-3">
                            <div class="col-12 px-0" id="company">
                                <div class="form-group">
                                    <input type="text" id="company" name="company" required class="form-control background-blue-light @error('company') is-invalid @enderror" placeholder="{{__('Contacta.empresa')}} *" value="{{ old('company') }}">
                                    @error('company')<small class="text-danger">{{ $message }}</small>@enderror
                                </div>
                            </div>
                        </div>
                        <div class="col-12 px-0 mt-3">
                            <div class="col-12 px-0" id="countryDiv">
                                <div class="form-group">
                                    <input type="text" id="country" name="country" required class="form-control background-blue-light @error('country') is-invalid @enderror" placeholder="{{__('Contacta.pais')}} *" value="{{ old('country') }}">
                                    @error('country')<small class="text-danger">{{ $message }}</small>@enderror
                                </div>
                            </div>
                        </div>
                        <div class="col-12 px-0 mt-3">
                            <label for="">{{__('Contacta.interest')}}</label>
                        </div>
                        <div class="col-12 px-0 mt-2">
                            <div class="custom-control custom-radio custom-control-inline">
                                <input type="radio" name="presu" checked class="custom-control-input" id="presu" value="presupuesto" {{ (old('presu') == 'presupuesto')?'checked':'' }}>
                                <label class="custom-control-label" for="presu">{{__('Contacta.recibir_presu')}}</label>
                            </div>

                            <!-- Default inline 2-->
                            <div class="custom-control custom-radio custom-control-inline">
                                <input type="radio" name="presu" class="custom-control-input" id="info" value="info" {{ (old('presu') == 'info')?'checked':'' }}>
                                <label class="custom-control-label" for="info">{{__('Contacta.recibir_info')}}</label>
                            </div>
                        </div>
                        <div class="col-12 px-0 mt-3">
                            <label for="">{{__('Contacta.more_info')}} <span class="text-danger">*</span></label>
                        </div>
                        <div class="col-12 px-0 mt-2">
                            <div class="custom-control custom-radio custom-control-inline">
                                <input type="radio" name="second"  class="custom-control-input" id="cantidades" value="cantidades" {{ (old('second') == 'cantidades')?'checked':'' }}>
                                <label class="custom-control-label"  for="cantidades">{{__('Contacta.cantidades')}}</label>
                            </div>
                            <div class="custom-control custom-radio custom-control-inline">
                                <input type="radio" name="second" checked class="custom-control-input" id="medidas" value="medidas" {{ (old('second') == 'medidas')?'checked':'' }}>
                                <label class="custom-control-label" checked for="medidas">{{__('Contacta.medidas')}}</label>
                            </div>
                            <div class="custom-control custom-radio custom-control-inline">
                                <input type="radio" name="second" class="custom-control-input" id="comentarios" value="comentarios" {{ (old('second') == 'comentarios')?'checked':'' }}>
                                <label class="custom-control-label" for="comentarios">{{__('Contacta.comentarios')}}</label>
                            </div>
                        </div>
                        <div class="col-12 px-0 mt-2">
                            <div class="form-group">
                                <textarea class="form-control background-blue-light @error('comentaris') is-invalid @enderror" name="comentaris" id="comentaris" rows="3" required>{{ old('comentaris') }}</textarea>
                                @error('comentaris')<small class="text-danger">{{ $message }}</small>@enderror
                            </div>
                        </div>
                        <div class="col-12 px-0 mt-3">
                            <div class="col-12 px-0 mt-3">
                                <b for="">{{__('Contacta.mensaje_ventas')}}</b>
                            </div>
                            <div class="custom-control custom-checkbox mt-3">
                                <input type="checkbox" class="custom-control-input @error('politics') is-invalid @enderror" name="politics" id="politics" required>
                                <label class="custom-control-label" for="politics">{{__('Contacta.privacy')}} <a href="{{LaravelLocalization::getURLFromRouteNameTranslated(App::getLocale(),'routes.politic_pages.politic_privacy')}}" target="_blank">{{__('Contacta.privacy_policy')}}</a>.</label>
                                @error('politics')<small class="text-danger">{{ $message }}</small>@enderror
                            </div>
                            <br>
                            {!! RecaptchaV3::field('register') !!}
                        
                            <button value="register" type="submit" title="{{__('Contacta.send')}}" class="btn btn-primary mt-4">{{__('Contacta.send')}}<img class="ml-4 mb-1" src="{{ asset('front/img/icon-arrow-right.svg') }}" alt="icono flecha derecha">
                            </button>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 offset-lg-1 mt-5">
                    <div class="row flex-lg-column justify-content-between h-100">
                        <div class="col-lg-12 flex-inherit col-6">
                            <h1>{{__('Contacta.titulo')}}</h1>
                            <div class="d-flex mt-4 align-items-start">
                                <img src="{{ asset('front/img/icon-loc.svg') }}" alt="icono localización">
                                <p class="ml-3 color-blue"><small>{{__('Contacta.location')}}</small></p>
                            </div>
                            <div class="d-flex mt-4 align-items-start">
                                <img src="{{ asset('front/img/icon-phone.svg') }}" alt="icono teléfono">
                                <p class="ml-3 color-blue"><small>{{__('Contacta.phone')}}</small></p>
                            </div>
                            
                        </div>
                        <div class="col-lg-12 flex-inherit col-6">
                            <img class="w-100" src="{{ asset('front/img/contacta-1.jpg') }}" alt="imagen mujer sonriendo">
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
</section>
@switch(App::getLocale())
    @case ('ca')
    @case ('es')
<hr>
<section>
    <div class="container mt-5">
        <div class="row">
            <div class="col-lg-12 col-md-10">
                <h4>{{__('Contacta.find')}}</h4>
                <p class="mt-3">{{__('Contacta.find_text')}}</p>
            </div>
        </div>
    </div>
    <div style="width: 75%;margin: auto;margin-top: 10px;"><iframe width="100%" height="600" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" src="https://maps.google.com/maps?width=100%25&amp;height=600&amp;hl=es&amp;q=Cintas%20y%20Pasamanerias%20SA+(Cintas%20y%20Pasamaneria%20SA)&amp;t=&amp;z=14&amp;ie=UTF8&amp;iwloc=B&amp;output=embed" title="abrir mapa de ubicación"></iframe><a href="https://www.mapsdirections.info/marcar-radio-circulo-mapa/" title="Cinpasa"></a></div>
</section>
        @break
    @default
        @break
@endswitch
<script>
    $(document).ready(function(){
        let urlContact = window.location.href.substring(window.location.href.lastIndexOf('/') + 1);\
        $('#origen').val(urlContact);
    });

</script>
@endsection
