<section>
    <div class="container mt-5" id="contact-form-products">
        <form action="{{LaravelLocalization::getURLFromRouteNameTranslated(App::getLocale(), 'routes.contact.store')}}" method="POST">
            @csrf
            <div class="row">
                <div class="col-lg-5 col-md-6 mt-5">
                    <h3 class="before-title">{{__('ContactaFooter.titulo')}}</h3>
                    <div class="row mt-3">
                        <div class="col-xl-10">
                            <p>{{__('ContactaFooter.subtext')}}</p>
                            <div class="row flex-row flex-md-column">
                                <div class="col-md-12 col-sm-6 col-10">
                                    <div class="d-flex mt-4 align-items-start">
                                        <img src="{{ asset('front/img/icon-loc.svg') }}" alt="icono localización">
                                        <p class="ml-3 color-blue small">{{__('Contacta.location')}}</p>
                                    </div>
                                </div>
                                <div class="col-md-12 col-sm-6">
                                    <div class="d-flex mt-4 align-items-start">
                                        <img src="{{ asset('front/img/icon-phone.svg') }}" alt="icono teléfono">
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
                                <input type="text" class="form-control background-blue-light" name="name" id="" placeholder="{{__('Contacta.name')}}">
                            </div>
                        </div>
                        <div class="col-6 mt-3">
                            <div class="form-group">
                                <input type="hidden" name="origen" id="origen">
                                <input type="email" class="form-control background-blue-light" name="email" id="" placeholder="{{__('Contacta.email')}}">
                            </div>
                        </div>
                        <div class="col-6 mt-3">
                            <div class="form-group">
                                <input type="phone" class="form-control background-blue-light" name="phone" id="" placeholder="{{__('Contacta.phone_form')}}">
                            </div>
                        </div>
                        <div class="col-12 mt-3">
                            <div class="custom-control custom-radio custom-control-inline">
                                <input type="radio" class="custom-control-input" id="particular" name="inlineDefaultRadiosExample" checked>
                                <label class="custom-control-label" for="particular">{{__('Contacta.particular')}}</label>
                            </div>

                            <!-- Default inline 2-->
                            <div class="custom-control custom-radio custom-control-inline">
                                <input type="radio" class="custom-control-input" id="empresa" name="inlineDefaultRadiosExample">
                                <label class="custom-control-label" for="empresa">{{__('Contacta.empresa')}}</label>
                            </div>

                            <div class="col-12 px-0 d-none" id="company">
                                <div class="form-group">
                                    <input type="text" name="company" class="form-control background-blue-light" placeholder="{{__('Contacta.company')}}">
                                </div>
                            </div>
                        </div>
                        <div class="col-12 mt-3">
                            <label for="">{{__('Contacta.interest')}}</label>
                        </div>
                        <div class="col-12 mt-2">
                            <div class="custom-control custom-radio custom-control-inline">
                                <input type="radio" class="custom-control-input" id="Recibir" name="inlineDefaultRadiosExample2" checked>
                                <label class="custom-control-label" for="Recibir">{{__('Contacta.recibir_presu')}}</label>
                            </div>

                            <!-- Default inline 2-->
                            <div class="custom-control custom-radio custom-control-inline">
                                <input type="radio" class="custom-control-input" id="Solicitar" name="inlineDefaultRadiosExample2">
                                <label class="custom-control-label" for="Solicitar">{{__('Contacta.recibir_info')}}</label>
                            </div>
                        </div>
                        <div class="col-12 mt-3">
                            <label for="">{{__('Contacta.more_info')}}</label>
                        </div>
                        <div class="col-12 mt-2">
                            <div class="custom-control custom-checkbox">
                                <input type="checkbox" class="custom-control-input" id="cantidades">
                                <label class="custom-control-label" for="cantidades">{{__('Contacta.cantidades')}}</label>
                            </div>
                        </div>
                        <div class="col-12 mt-3 d-none" id="cantidades-text">
                            <div class="form-group">
                                <textarea class="form-control background-blue-light" name="cantidades" rows="3"></textarea>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="custom-control custom-checkbox mt-3">
                                <input type="checkbox" class="custom-control-input" id="medidas">
                                <label class="custom-control-label" for="medidas">{{__('Contacta.medidas')}}</label>
                            </div>
                            <div class="col-12 mt-3 d-none" id="medidas-text">
                                <div class="form-group">
                                    <textarea class="form-control background-blue-light" name="medidas" rows="3"></textarea>
                                </div>
                            </div>
                            <div class="custom-control custom-checkbox mt-3">
                                <input type="checkbox" class="custom-control-input" id="comentarios">
                                <label class="custom-control-label" for="comentarios">{{__('Contacta.comentarios')}}</label>
                            </div>
                        </div>
                        <div class="col-12 mt-3 d-none" id="comentarios-text">
                            <div class="form-group">
                                <textarea class="form-control background-blue-light" name="comentarios" rows="3"></textarea>
                            </div>
                        </div>
                        <div class="col-12 mt-3">
                            <br>
                            {!! htmlFormSnippet() !!}
                            <div class="custom-control custom-checkbox mt-3">
                                <input type="checkbox" name="politics" class="custom-control-input" id="privacidad">
                                <label class="custom-control-label" for="privacidad">{{__('Contacta.privacy')}}</label>
                            </div>
                            <button type="submit" title="Enviar formulario" class="btn btn-primary mt-4">{{__('Contacta.send')}}<img class="ml-4 mb-1" src="{{ asset('front/img/icon-arrow-right.svg') }}" alt="icono flecha derecha">
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
    $('#empresa').click(function(){
        $('#company').removeClass('d-none');
    });

    $('#cantidades').click(function(){
        if($( "#cantidades-text" ).hasClass("d-none")){
            $('#cantidades-text').removeClass('d-none');
        } else {
            $('#cantidades-text').addClass('d-none');
        }
    });

    $('#medidas').click(function(){
        if($( "#medidas-text" ).hasClass("d-none")){
            $('#medidas-text').removeClass('d-none');
        } else {
            $('#medidas-text').addClass('d-none');
        }
    });

    $('#comentarios').click(function(){
        if($( "#comentarios-text" ).hasClass("d-none")){
            $('#comentarios-text').removeClass('d-none');
        } else {
            $('#comentarios-text').addClass('d-none');
        }
    });

    $('#particular').click(function(){
        $('#company').addClass('d-none');
    });

    $(document).ready(function(){
        var origen = window.location.href.substring(window.location.href.lastIndexOf('/') + 1);
        if(origen == '') {
            origen = 'Home';
        }
        $('#origen').val(origen);
    });

</script>
