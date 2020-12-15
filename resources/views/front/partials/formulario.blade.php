<section>
    <div class="container mt-5">
        <form>
            <div class="row">
                <div class="col-lg-5 col-md-6 mt-5">
                    <h3 class="before-title">{{__('ContactaFooter.titulo')}}</h3>
                    <div class="row mt-3">
                        <div class="col-xl-10">
                            <p>{{__('ContactaFooter.subtext')}}</p>
                            <div class="row flex-row flex-md-column">
                                <div class="col-md-12 col-sm-6 col-10">
                                    <div class="d-flex mt-4 align-items-start">
                                        <img src="img/icon-loc.svg" alt="">
                                        <p class="ml-3 color-blue small">{{__('Contacta.location')}}</p>
                                    </div>
                                </div>
                                <div class="col-md-12 col-sm-6">
                                    <div class="d-flex mt-4 align-items-start">
                                        <img src="img/icon-phone.svg" alt="">
                                        <p class="ml-3 color-blue small">{{__('Contacta.phone')}}</p>
                                    </div>
                                </div>
                            </div>
                            <p class="mt-5 font-bold color-black">{{__('ContactaFooter.come')}}</p>
                            <img src="img/map-form.jpg" alt="" class="mt-4 w-100">
                        </div>
                    </div>
                </div>
                <div class="col-md-6 offset-lg-1 mt-5">
                    <div class="row">
                        <div class="col-12">
                            <div class="form-group">
                                <input type="text" class="form-control background-blue-light" id="" placeholder="{{__('Contacta.name')}}">
                            </div>
                        </div>
                        <div class="col-6 mt-3">
                            <div class="form-group">
                                <input type="email" class="form-control background-blue-light" id="" placeholder="{{__('Contacta.email')}}">
                            </div>
                        </div>
                        <div class="col-6 mt-3">
                            <div class="form-group">
                                <input type="phone" class="form-control background-blue-light" id="" placeholder="{{__('Contacta.phone_form')}}">
                            </div>
                        </div>
                        <div class="col-12 mt-3">
                            <div class="custom-control custom-radio custom-control-inline">
                                <input type="radio" class="custom-control-input" id="Particular" name="inlineDefaultRadiosExample">
                                <label class="custom-control-label" for="Particular">{{__('Contacta.particular')}}</label>
                            </div>

                            <!-- Default inline 2-->
                            <div class="custom-control custom-radio custom-control-inline">
                                <input type="radio" class="custom-control-input" id="Empresa" name="inlineDefaultRadiosExample">
                                <label class="custom-control-label" for="Empresa">{{__('Contacta.empresa')}}</label>
                            </div>
                        </div>
                        <div class="col-12 mt-3">
                            <label for="">{{__('Contacta.interest')}}</label>
                        </div>
                        <div class="col-12 mt-2">
                            <div class="custom-control custom-radio custom-control-inline">
                                <input type="radio" class="custom-control-input" id="Recibir" name="inlineDefaultRadiosExample">
                                <label class="custom-control-label" for="Recibir">{{__('Contacta.recibir_presu')}}</label>
                            </div>

                            <!-- Default inline 2-->
                            <div class="custom-control custom-radio custom-control-inline">
                                <input type="radio" class="custom-control-input" id="Solicitar" name="inlineDefaultRadiosExample">
                                <label class="custom-control-label" for="Solicitar">{{__('Contacta.recibir_info')}}</label>
                            </div>
                        </div>
                        <div class="col-12 mt-3">
                            <label for="">{{__('Contacta.more_info')}}</label>
                        </div>
                        <div class="col-12 mt-2">
                            <div class="custom-control custom-checkbox">
                                <input type="checkbox" class="custom-control-input" id="Cantidades" checked>
                                <label class="custom-control-label" for="Cantidades">{{__('Contacta.cantidades')}}</label>
                            </div>
                        </div>
                        <div class="col-12 mt-2">
                            <div class="form-group">
                                <textarea class="form-control background-blue-light" id="exampleFormControlTextarea1" rows="3"></textarea>
                            </div>
                        </div>
                        <div class="col-12">
                            <div class="custom-control custom-checkbox mt-3">
                                <input type="checkbox" class="custom-control-input" id="Medidas" checked>
                                <label class="custom-control-label" for="Medidas">{{__('Contacta.medidas')}}</label>
                            </div>
                            <div class="custom-control custom-checkbox mt-3">
                                <input type="checkbox" class="custom-control-input" id="Comentarios" checked>
                                <label class="custom-control-label" for="Comentarios">{{__('Contacta.comentarios')}}</label>
                            </div>
                        </div>
                        <div class="col-12 mt-3">
                            <div class="form-group">
                                <textarea class="form-control background-blue-light" id="exampleFormControlTextarea1" rows="3"></textarea>
                            </div>
                        </div>
                        <div class="col-12 mt-3">
                            <div class="custom-control custom-checkbox mt-3">
                                <input type="checkbox" class="custom-control-input" id="privacidad" checked>
                                <label class="custom-control-label" for="privacidad">{{__('Contacta.privacy')}}</label>
                            </div>
                            <a href="contacta_ok.php" title="" class="btn btn-primary mt-4">
                                {{__('Contacta.send')}}<img class="ml-4 mb-1" src="img/icon-arrow-right.svg" alt="">
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
</section>
