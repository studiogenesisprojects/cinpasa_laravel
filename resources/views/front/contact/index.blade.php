@extends('front.common.main')

@section('content')
@include('front.home.carousel2')
@section('meta-title', __('Contacta.titulo_seo'))
@section('meta-description', __('Contacta.descripcion_seo'))
<section id="aplicaciones">
    <div class="container">
        <form action="{{LaravelLocalization::getURLFromRouteNameTranslated(App::getLocale(), 'routes.contact.store')}}" method="POST">
        @csrf
            <div class="row">
                <div class="col-lg-8 transform-t-5">
                    <div class="card flex-row flex-wrap p-4">
                        <div class="col-12 px-0">
                            <div class="form-group">
                                <input type="text" name="name" class="form-control background-blue-light" id="" placeholder="{{__('Contacta.name')}}">
                            </div>
                        </div>
                        <div class="col-6 pl-0 mt-3">
                            <div class="form-group">
                                <input type="hidden" name="origen" id="origen">
                                <input type="email" name="email" class="form-control background-blue-light" id="" placeholder="{{__('Contacta.email')}}">
                            </div>
                        </div>
                        <div class="col-6 pr-0 mt-3">
                            <div class="form-group">
                                <input type="phone" name="phone" class="form-control background-blue-light" id="" placeholder="{{__('Contacta.phone_form')}}">
                            </div>
                        </div>
                        <div class="col-12 px-0 mt-3">
                            <div class="custom-control custom-radio custom-control-inline">
                                <input type="radio" class="custom-control-input" id="empresa" name="particular">
                                <label class="custom-control-label" for="empresa">{{__('Contacta.empresa')}}</label>
                            </div>

                            <!-- Default inline 2-->
                            <div class="custom-control custom-radio custom-control-inline">
                                <input type="radio" class="custom-control-input" checked id="particular" name="particular">
                                <label class="custom-control-label" for="particular">{{__('Contacta.particular')}}</label>
                            </div>

                            <div class="col-12 px-0 d-none" id="company">
                                <div class="form-group">
                                    <input type="text" name="company" class="form-control background-blue-light" placeholder="{{__('Contacta.company')}}">
                                </div>
                            </div>
                        </div>
                        <div class="col-12 px-0 mt-3">
                            <label for="">{{__('Contacta.interest')}}</label>
                        </div>
                        <div class="col-12 px-0 mt-2">
                            <div class="custom-control custom-radio custom-control-inline">
                                <input type="radio" name="presu" checked class="custom-control-input" id="presu">
                                <label class="custom-control-label" for="presu">{{__('Contacta.recibir_presu')}}</label>
                            </div>

                            <!-- Default inline 2-->
                            <div class="custom-control custom-radio custom-control-inline">
                                <input type="radio" name="presu" class="custom-control-input" id="info">
                                <label class="custom-control-label" for="info">{{__('Contacta.recibir_info')}}</label>
                            </div>
                        </div>
                        <div class="col-12 px-0 mt-3">
                            <label for="">{{__('Contacta.more_info')}} <span class="text-danger">*</span></label>
                        </div>
                        <div class="col-12 px-0 mt-2">
                            <div class="custom-control custom-radio custom-control-inline">
                                <input type="radio" name="second"  class="custom-control-input" id="cantidades">
                                <label class="custom-control-label"  for="cantidades">{{__('Contacta.cantidades')}}</label>
                            </div>
                            <div class="custom-control custom-radio custom-control-inline">
                                <input type="radio" name="second" checked class="custom-control-input" id="medidas">
                                <label class="custom-control-label" checked for="medidas">{{__('Contacta.medidas')}}</label>
                            </div>
                            <div class="custom-control custom-radio custom-control-inline">
                                <input type="radio" name="second" class="custom-control-input" id="comentarios">
                                <label class="custom-control-label" for="comentarios">{{__('Contacta.comentarios')}}</label>
                            </div>
                        </div>
                        <div class="col-12 px-0 mt-2">
                            <div class="form-group">
                                <textarea class="form-control background-blue-light" name="comentaris" id="exampleFormControlTextarea1" rows="3"></textarea>
                            </div>
                        </div>
                        <div class="col-12 px-0 mt-3">
                            <div class="col-12 px-0 mt-3">
                                <label for="">{{__('Contacta.mensaje_ventas')}}</label>
                            </div>
                            <div class="custom-control custom-checkbox mt-3">
                                <input type="checkbox" class="custom-control-input" name="politics" id="defaultChecked2" checked>
                                <label class="custom-control-label" for="defaultChecked2"><a href="{{LaravelLocalization::getURLFromRouteNameTranslated(App::getLocale(),'routes.politic_pages.politic_privacy')}}">{{__('Contacta.privacy')}}</a></label>
                            </div>
                            <br>
                            {!! htmlFormSnippet() !!}
                            <button type="submit" title="Enviar formulario" class="btn btn-primary mt-4">{{__('Contacta.send')}}<img class="ml-4 mb-1" src="{{ asset('front/img/icon-arrow-right.svg') }}" alt="icono flecha derecha">
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
<hr>
<section>
    <div class="container mt-5">
        <div class="row">
            <div class="col-lg-7 col-md-10">
                <h4>{{__('Contacta.find')}}</h4>
                <p class="mt-3">{{__('Contacta.find_text')}}</p>
            </div>
        </div>
    </div>
    <div style="width: 75%;margin: auto;margin-top: 10px;"><iframe width="100%" height="600" frameborder="0" scrolling="no" marginheight="0" marginwidth="0" src="https://maps.google.com/maps?width=100%25&amp;height=600&amp;hl=es&amp;q=Cintas%20y%20Pasamanerias%20SA+(Cintas%20y%20Pasamaneria%20SA)&amp;t=&amp;z=14&amp;ie=UTF8&amp;iwloc=B&amp;output=embed" title="abrir mapa de ubicación"></iframe><a href="https://www.mapsdirections.info/marcar-radio-circulo-mapa/" title="Cinpasa"></a></div>
</section>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script>
    $('#empresa').click(function(){
        $('#company').removeClass('d-none');
    });

    $('#particular').click(function(){
        $('#company').addClass('d-none');
    });

    $(document).ready(function(){
        $('#origen').val(window.location.href.substring(window.location.href.lastIndexOf('/') + 1));
    });

</script>
@endsection
