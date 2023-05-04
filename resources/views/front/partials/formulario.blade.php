<section id="info-request">
    <div class="container mt-5" id="contact-form-products">
        <form action="{{LaravelLocalization::getURLFromRouteNameTranslated(App::getLocale(), 'routes.contact.store')}}" method="POST">
            @csrf
            <input type="hidden" name="origen" id="origen">
            @if(isset($favorite_info))
                @foreach ($products as $product)
                <input type="hidden" name="productsIds[]" value="{{ $product->id }}">
                @endforeach
            @endif
            <div class="row">
                <div class="col-lg-5 col-md-6 mt-5">
                    <h3 class="before-title">{{__('ContactaFooter.titulo')}}</h3>
                    <div class="row mt-3">
                        <div class="col-xl-10">
                            @if((empty($products)) && (!empty($product)) && (!empty($product->galeries)) && (!empty($product->galeries->first()->images)))
                            <input type="hidden" name="productsIds[]" value="{{ $product->id }}">
                            <div class="row flex-row flex-md-column">
                                <div class="col-md-12 col-sm-6 col-10">
                                    <img class="w-100 border-img" src="{{ Storage::url($product->galeries->first()->images->first()->path) }}" alt="{{ $product->name }}">
                                    <p class="font-bold color-black mt-4">{{$product->name}}</p>
                                    <p class="small">{!! $product->description !!}</p>
                                </div>
                            </div>
                            @else
                            <p>{{__('ContactaFooter.subtext')}}</p>
                            <div class="row flex-row flex-md-column">
                                @switch(App::getLocale())
                                    @case ('ca')
                                    @case ('es')
                                        <div class="col-md-12 col-sm-6 col-10">
                                            <div class="d-flex mt-4 align-items-start">
                                                <img src="{{ asset('front/img/icon-loc.svg') }}" alt="icono localización">
                                                <p class="ml-3 color-blue small">{{__('Contacta.location')}}</p>
                                            </div>
                                        </div>
                                        @break
                                    @default
                                        @break
                                @endswitch
                                <div class="col-md-12 col-sm-6">
                                    <div class="d-flex mt-4 align-items-start">
                                        <img src="{{ asset('front/img/icon-phone.svg') }}" alt="icono teléfono">
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
                            @endif
                        </div>
                    </div>
                </div>
                <div class="col-md-6 offset-lg-1 mt-5">
                    <div class="row">
                        <div class="col-12">
                            <div class="form-group">
                                <label for="name" class="label_out">{{__('Contacta.name')}}</label>
                                <input type="text" class="form-control background-blue-light  @error('name') is-invalid @enderror" required name="name" id="name" placeholder="{{__('Contacta.name')}}" value="{{ old('name') }}">
                                @error('name')<small class="text-danger">{{ $message }}</small>@enderror
                            </div>
                        </div>
                        @switch(App::getLocale())
                            @case ('ca')
                            @case ('es')
                                <div class="col-6 mt-3">
                                    <div class="form-group">
                                        <label for="email" class="label_out">{{__('Contacta.email')}}</label>
                                        <input type="email" class="form-control background-blue-light @error('email') is-invalid @enderror" required name="email" id="email" placeholder="{{__('Contacta.email')}}">
                                        @error('email')<small class="text-danger">{{ $message }}</small>@enderror
                                    </div>
                                </div>
                                @break
                            @default
                                @break
                        @endswitch
                        <div class="col-6 mt-3">
                            <div class="form-group">
                                <label for="phone" class="label_out">{{__('Contacta.phone_form')}}</label>
                                <input type="phone" required class="form-control background-blue-light @error('phone') is-invalid @enderror" name="phone" id="phone" placeholder="{{__('Contacta.phone_form')}}" value="{{ old('phone') }}">
                                @error('phone')<small class="text-danger">{{ $message }}</small>@enderror
                            </div>
                        </div>
                        <div class="col-12 mt-3">
                            <div class="col-12 px-0">
                                <div class="form-group">
                                    <input type="text" id="company" name="company" required class="form-control background-blue-light @error('company') is-invalid @enderror" placeholder="{{__('Contacta.empresa')}} *" value="{{ old('company') }}">
                                    @error('company')<small class="text-danger">{{ $message }}</small>@enderror
                                </div>
                            </div>
                        </div>
                        <div class="col-12 mt-3">
                            <div class="col-12 px-0">
                                <div class="form-group">
                                    <input type="text" id="country" name="country" required class="form-control background-blue-light @error('country') is-invalid @enderror" placeholder="{{__('Contacta.pais')}} *" value="{{ old('country') }}">
                                    @error('country')<small class="text-danger">{{ $message }}</small>@enderror
                                </div>
                            </div>
                        </div>
                        <div class="col-12 mt-3">
                            <label for="">{{__('Contacta.interest')}}</label>
                        </div>
                        <div class="col-12 mt-2">
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
                        <div class="col-12 mt-3">
                            <label for="">{{__('Contacta.more_info')}}<span class="text-danger">*</span></label>
                        </div>
                        <div class="col-12 mt-2">
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
                        <div class="col-12 mt-3">
                            <div class="form-group">
                                <textarea class="form-control background-blue-light @error('comentaris') is-invalid @enderror" name="comentaris" id="comentaris" rows="3" required>{{ old('comentaris') }}</textarea>
                                @error('comentaris')<small class="text-danger">{{ $message }}</small>@enderror
                            </div>
                        </div>
                        <div class="col-12 mt-3">
                            <br>
                            <div class="col-12 px-0 mt-3">
                                <b for="">{{ __('Contacta.mensaje_ventas') }}</b>
                            </div>
                            <div class="custom-control custom-checkbox mt-3">
                                <input type="checkbox" name="politics" class="custom-control-input @error('politics') is-invalid @enderror" id="privacidad" required>
                                <label class="custom-control-label" for="privacidad"><a href="{{LaravelLocalization::getURLFromRouteNameTranslated(App::getLocale(),'routes.politic_pages.politic_privacy')}}">{{__('Contacta.privacy')}}</a></label>
                                @error('politics')<small class="text-danger">{{ $message }}</small>@enderror
                            </div>
                            {!! RecaptchaV3::field('submit') !!}
                            <button type="submit" title="{{__('Contacta.send')}}" class="btn btn-primary mt-4">{{__('Contacta.send')}}<img class="ml-4 mb-1" src="{{ asset('front/img/icon-arrow-right.svg') }}" alt="icono flecha derecha">
                            </button>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>
</section>
<script>
    $(document).ready(function(){
        var origen = window.location.href.substring(window.location.href.lastIndexOf('/') + 1);
        if(origen == '') {
            origen = 'Home';
        }
        $('#origen').val(origen);
    });

</script>
