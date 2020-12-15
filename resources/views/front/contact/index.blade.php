@extends('front.common.main')

@section('content')
@include('front.home.carousel')
<section id="aplicaciones">
    <div class="container">
        <form>
            <div class="row">
                <div class="col-lg-8 transform-t-5">
                    <div class="card flex-row flex-wrap p-4">
                        <div class="col-12 px-0">
                            <div class="form-group">
                                <input type="text" class="form-control background-blue-light" id="" placeholder="{{__('Contacta.name')}}">
                            </div>
                        </div>
                        <div class="col-6 pl-0 mt-3">
                            <div class="form-group">
                                <input type="email" class="form-control background-blue-light" id="" placeholder="{{__('Contacta.email')}}">
                            </div>
                        </div>
                        <div class="col-6 pr-0 mt-3">
                            <div class="form-group">
                                <input type="phone" class="form-control background-blue-light" id="" placeholder="{{__('Contacta.phone_form')}} *">
                            </div>
                        </div>
                        <div class="col-12 px-0 mt-3">
                            <div class="custom-control custom-radio custom-control-inline">
                                <input type="radio" class="custom-control-input" id="defaultInline1" name="inlineDefaultRadiosExample">
                                <label class="custom-control-label" for="defaultInline1">{{__('Contacta.particular')}}</label>
                            </div>

                            <!-- Default inline 2-->
                            <div class="custom-control custom-radio custom-control-inline">
                                <input type="radio" class="custom-control-input" id="defaultInline2" name="inlineDefaultRadiosExample">
                                <label class="custom-control-label" for="defaultInline2">{{__('Contacta.empresa')}}</label>
                            </div>
                        </div>
                        <div class="col-12 px-0 mt-3">
                            <label for="">{{__('Contacta.interest')}}</label>
                        </div>
                        <div class="col-12 px-0 mt-2">
                            <div class="custom-control custom-radio custom-control-inline">
                                <input type="radio" class="custom-control-input" id="defaultInline1" name="inlineDefaultRadiosExample">
                                <label class="custom-control-label" for="defaultInline1">{{__('Contacta.recibir_presu')}}</label>
                            </div>

                            <!-- Default inline 2-->
                            <div class="custom-control custom-radio custom-control-inline">
                                <input type="radio" class="custom-control-input" id="defaultInline2" name="inlineDefaultRadiosExample">
                                <label class="custom-control-label" for="defaultInline2">{{__('Contacta.more_info')}}</label>
                            </div>
                        </div>
                        <div class="col-12 px-0 mt-3">
                            <label for="">Información adicional necesaria</label>
                        </div>
                        <div class="col-12 px-0 mt-2">
                            <div class="custom-control custom-radio custom-control-inline">
                                <input type="radio" class="custom-control-input" id="defaultInline1" name="inlineDefaultRadiosExample">
                                <label class="custom-control-label" for="defaultInline1">{{__('Contacta.cantidades')}}</label>
                            </div>
                            <div class="custom-control custom-radio custom-control-inline">
                                <input type="radio" class="custom-control-input" id="defaultInline2" name="inlineDefaultRadiosExample">
                                <label class="custom-control-label" for="defaultInline2">{{__('Contacta.medidas')}}</label>
                            </div>
                            <div class="custom-control custom-radio custom-control-inline">
                                <input type="radio" class="custom-control-input" id="defaultInline2" name="inlineDefaultRadiosExample">
                                <label class="custom-control-label" for="defaultInline2">{{__('Contacta.comentarios')}}</label>
                            </div>
                        </div>
                        <div class="col-12 px-0 mt-2">
                            <div class="form-group">
                                <textarea class="form-control background-blue-light" id="exampleFormControlTextarea1" rows="3"></textarea>
                            </div>
                        </div>
                        <div class="col-12 px-0 mt-3">
                            <div class="custom-control custom-checkbox mt-3">
                                <input type="checkbox" class="custom-control-input" id="defaultChecked2" checked>
                                <label class="custom-control-label" for="defaultChecked2">{{__('Contacta.privacy')}}</label>
                            </div>
                            <a href="#" title="Enviar formulario" class="btn btn-primary mt-4">{{__('Contacta.send')}}<img class="ml-4 mb-1" src="{{ asset('front/img/icon-arrow-right.svg') }}" alt="icono flecha derecha">
                            </a>
                        </div>
                    </div>
                </div>
                <div class="col-lg-3 offset-lg-1 mt-5">
                    <div class="row flex-lg-column justify-content-between h-100">
                        <div class="col-lg-12 flex-inherit col-6">
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
        <div class="row">
            <div class="col-12 my-5">
                <div class="mapa"></div>
            </div>
        </div>
    </div>
</section>
@endsection
