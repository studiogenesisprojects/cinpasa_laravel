<hr class="mt-5">
<section>
    <form id="work-with-us-form" action="{{LaravelLocalization::getURLFromRouteNameTranslated(App::getLocale(), 'routes.work-with-us.store')}}" method="post" enctype="multipart/form-data">
    @csrf
        <div class="container mt-5">
        <div class="row">
            <div class="col-md-5 mt-5">
                <div class="row mt-3 flex-wrap justify-content-between h-100">
                    <div class="col-lg-10">
                        <h3 class="before-title">Envíanos tu CV</h3>
                        <p class="mt-3">Queremos conocerte. Envíanos tu CV y explícanos un poco más sobre tí.</p>
                    </div>
                    <div class="col-md-12 col-6 offset-md-0 offset-3 d-md-flex d-none align-items-end">
                        <img class="w-100" src="{{ asset('front/img/curriculum.jpg') }}" alt="imagen mujer señalando">
                    </div>
                </div>
            </div>
            <div class="col-lg-6 col-md-7 offset-lg-1 mt-5">
                <div class="row">
                    <div class="col-12">
                        <div class="form-group">
                            <input type="text" class="form-control background-blue-light" id="" required name="name" placeholder="Nombre *">
                        </div>
                    </div>
                    <div class="col-12 mt-3">
                        <div class="form-group">
                            <input type="text" class="form-control background-blue-light" id="" required name="surname" placeholder="Apellidos *">
                        </div>
                    </div>
                    <div class="col-6 mt-3">
                        <div class="form-group">
                            <input type="email" class="form-control background-blue-light" id="" required name="email" placeholder="E-mail *">
                        </div>
                    </div>
                    <div class="col-6 mt-3">
                        <div class="form-group">
                            <input type="hidden" name="offerId" id="offerId">
                            <input type="phone" class="form-control background-blue-light" id="" required name="tel" placeholder="Teléfono *">
                        </div>
                    </div>
                    <div class="col-12 mt-3">
                        <div class="form-group">
                            <input type="text" class="form-control background-blue-light" id="" placeholder="Interesado en…">
                        </div>
                    </div>
                    <div class="col-12 mt-3">
                        <div class="form-group">
                            <textarea class="form-control background-blue-light" id="exampleFormControlTextarea1" placeholder="Breve presentación" rows="3"></textarea>
                        </div>
                    </div>
                    <div class="col-12 mt-3">
                        <div class="custom-file p-3 d-flex justify-content-between align-items-center">
                            <label class="btn-upload px-3 py-2 mb-0">Seleccionar archivo&hellip; <input type="file" name="file"  required style="display: none;"></label>
                            <a href="#" title="Eliminar archivo"><img src="{{ asset('front/img/icon-delete-small.svg') }}" alt="icono eliminar"></a>
                        </div>
                        <p class="small mt-3 color-grey">Peso máximo 2MB. Archivos en pdf</p>
                    </div>
                    <div class="col-12 mt-3">
                        <div class="custom-control custom-checkbox mt-3">
                            <input type="checkbox" class="custom-control-input" name="politics" required id="defaultChecked2" checked>
                            <label class="custom-control-label" for="defaultChecked2">He leído y acepto la política de privacidad.</label>
                        </div>
                        <button type="submit" title="Envia tu curriculum vitae" class="btn btn-primary mt-4">
                            ENVIAR<img class="ml-4 mb-1" src="{{ asset('front/img/icon-arrow-right.svg') }}" alt="icono flecha derecha">
                        </button>
                    </div>

                    <div class="col-md-12 col-6 offset-md-0 offset-3 d-md-none d-flex align-items-end">
                        <img class="w-100" src="{{ asset('front/img/curriculum.jpg') }}" alt="imagen mujer señalando">
                    </div>
                </div>
            </div>
        </div>
    </form>
    </div>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <script>
        @if($offer)
        $('#offerId').val({{$offer->id}});
        @endif
    </script>
</section>
