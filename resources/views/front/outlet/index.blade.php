@extends('front.common.main')

@section('content')
@include('front.home.carousel2')
<section id="aplicaciones">
    <div class="container">
        <div class="row">
            <div class="col-12 mt-5">
                <h2 class="mt-5 font-bold before-title">Productos</h2>
                <p class="mt-3">Últimos stocks, no pierdas la oportunidad.</p>
                {{-- <form>
                    <div class="row">
                        <div class="col-md-6 mt-3">
                            <p class="small">Filtra por categoría de producto</p>
                            <div class="form-group mt-2 background-blue-light">
                                <select class="form-control" id="exampleFormControlSelect1">
                                    <option>Todas las categorías</option>
                                    <option>2</option>
                                    <option>3</option>
                                    <option>4</option>
                                    <option>5</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6 mt-3">
                            <p class="small">Ordena por:</p>
                            <div class="form-group mt-2 background-blue-light">
                                <select class="form-control" id="exampleFormControlSelect1">
                                    <option>El más reciente</option>
                                    <option>2</option>
                                    <option>3</option>
                                    <option>4</option>
                                    <option>5</option>
                                </select>
                            </div>
                        </div>
                    </div>
                </form> --}}
            </div>
        </div>
        <div class="row mt-5">
            <div class="col-12 mb-4">
                <h5 class="color-primary">Mostrando {{sizeof($higherDiscount) + sizeof($bottomOnes)}} productos</h5>
            </div>
            @if(isset($higherDiscount[0]))
                <div class="col-lg-6">
                    <div class="border-card p-3 h-100">
                        <div class="position-relative">
                            <div id="carouselExampleControls" class="carousel slide" data-ride="carousel" data-interval="false">
                                <a href="#" title="Accede al artículo">
                                    <div class="carousel-inner border-img">
                                        @if($higherDiscount[0]->galeries->first())
                                            @foreach ($higherDiscount[0]->galeries->first()->images as $image)
                                                <div class="carousel-item {{($loop->first) ? 'active' : ''}}">
                                                    <img class="w-100" src="@if(!empty($image->path)){{Storage::url($image->path)}}@else{{Storage::url('/img/nofoto.png')}}@endif" alt="@empty($image->alt) {{ $higherDiscount[0]->lang()->name }} @else {{  $image->alt}} @endempty" class="box-product__carousel">
                                                </div>
                                            @endforeach
                                        @endif
                                    </div>
                                </a>
                                <a class="carousel-control-prev" href="#carouselExampleControls" role="button" data-slide="prev">
                                    <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                                    <span class="sr-only">Previous</span>
                                </a>
                                <a class="carousel-control-next" href="#carouselExampleControls" role="button" data-slide="next">
                                    <span class="carousel-control-next-icon" aria-hidden="true"></span>
                                    <span class="sr-only">Next</span>
                                </a>
                            </div>
                            <div class="position-absolute transform-t-50 d-flex b-0 r-0 mr-3 scale-16">
                                <p class="btn-yellow mr-1">-{{$higherDiscount[0]->discount}}%</p>
                                <a href="#" title="Comparte el artículo"><img class="btn-products p-1 mr-1" src="{{ asset('front/img/icon-share.svg') }}" alt="icono compartir"></a>
                                <a href="#" title="Añade a favoritos el artículo"><img class="btn-products p-1" src="{{ asset('front/img/icon-favorito.svg') }}" alt="icono favorito"></a>
                            </div>
                        </div>
                        <a href="#" title="Accede al artículo">
                            <p class="small color-blue mt-3">{{$higherDiscount[0]->categories[0]->lang()->name}}</p>
                            <p class="font-bold color-black">{{$higherDiscount[0]->lang()->name}}</p>
                        </a>
                    </div>
                </div>
            @endif
            <div class="col-lg-6 mt-lg-0 mt-4">
                <div class="row">
                    <div class="col-sm-6">
                        <div class="border-card p-3">
                            <div class="position-relative">
                                <a href="#" title="Accede al artículo"><img class="w-100 border-img" src="{{ asset('front/img/outlet-2.jpg') }}" alt="imagen outlet"></a>
                                <div class="position-absolute transform-t-50 d-flex b-0 r-0 mr-3">
                                    <p class="btn-yellow mr-1">-10%</p>
                                    <a href="#" title="Comparte el artículo"><img class="btn-products p-1 mr-1" src="{{ asset('front/img/icon-share.svg') }}" alt="icono compartir"></a>
                                    <a href="#" title="Añade a favoritos el artículo"><img class="btn-products p-1" src="{{ asset('front/img/icon-favorito.svg') }}" alt="icono favorito"></a>
                                </div>
                            </div>
                            <a href="#" title="Accede al artículo">
                                <p class="small color-blue mt-4">CINTAS DE CORTINA</p>
                                <p class="font-bold color-black">Cordón lavado</p>
                            </a>
                        </div>
                    </div>
                    <div class="col-sm-6 mt-sm-0 mt-4">
                        <div class="border-card p-3">
                            <div class="position-relative">
                                <a href="#" title="Accede al artículo"><img class="w-100 border-img" src="{{ asset('front/img/outlet-3.jpg') }}" alt="imagen outlet"></a>
                                <div class="position-absolute transform-t-50 d-flex b-0 r-0 mr-3">
                                    <p class="btn-yellow mr-1">-5%</p>
                                    <a href="#" title="Comparte el artículo"><img class="btn-products p-1 mr-1" src="{{ asset('front/img/icon-share.svg') }}" alt="icono compartir"></a>
                                    <a href="#" title="Añade a favoritos el artículo"><img class="btn-products p-1" src="{{ asset('front/img/icon-favorito.svg') }}" alt="icono favorito"></a>
                                </div>
                            </div>
                            <a href="#" title="Accede al artículo">
                                <p class="small color-blue mt-4">CINTAS DE CORTINA</p>
                                <p class="font-bold color-black">Cordón impermeable</p>
                            </a>
                        </div>
                    </div>
                    <div class="col-sm-6 mt-4">
                        <div class="border-card p-3">
                            <div class="position-relative">
                                <a href="#" title="Accede al artículo"><img class="w-100 border-img" src="{{ asset('front/img/outlet-4.jpg') }}" alt="imagen outlet"></a>
                                <div class="position-absolute transform-t-50 d-flex b-0 r-0 mr-3">
                                    <p class="btn-yellow mr-1">-10%</p>
                                    <a href="#" title="Comparte el artículo"><img class="btn-products p-1 mr-1" src="{{ asset('front/img/icon-share.svg') }}" alt="icono compartir"></a>
                                    <a href="#" title="Añade a favoritos el artículo"><img class="btn-products p-1" src="{{ asset('front/img/icon-favorito.svg') }}" alt="icono favorito"></a>
                                </div>
                            </div>
                            <a href="#" title="Accede al artículo">
                                <p class="small color-blue mt-4">CINTAS DE CORTINA</p>
                                <p class="font-bold color-black">Cordón lavado</p>
                            </a>
                        </div>
                    </div>
                    <div class="col-sm-6 mt-4">
                        <div class="border-card p-3">
                            <div class="position-relative">
                                <a href="#" title="Accede al artículo"><img class="w-100 border-img" src="{{ asset('front/img/outlet-5.jpg') }}" alt="imagen outlet"></a>
                                <div class="position-absolute transform-t-50 d-flex b-0 r-0 mr-3">
                                    <p class="btn-yellow mr-1">-5%</p>
                                    <a href="#" title="Comparte el artículo"><img class="btn-products p-1 mr-1" src="{{ asset('front/img/icon-share.svg') }}" alt="icono compartir"></a>
                                    <a href="#" title="Añade a favoritos el artículo"><img class="btn-products p-1" src="{{ asset('front/img/icon-favorito.svg') }}" alt="icono favorito"></a>
                                </div>
                            </div>
                            <a href="#" title="Accede al artículo">
                                <p class="small color-blue mt-4">CINTAS DE CORTINA</p>
                                <p class="font-bold color-black">Cordón impermeable</p>
                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <img src="{{ asset('front/img/outlet-banner.png') }}" alt="imagen banner" class="w-100 border-img mt-5">
        <div class="row mt-5">
            {{-- @foreach($productCategory as $product)
            <div class="col-lg-3 col-md-4 col-sm-6 mt-4">
                <div class="border-card p-3">
                    <div class="position-relative">
                        <a href="{{LaravelLocalization::getURLFromRouteNameTranslated(App::getLocale(), 'routes.products.showProduct', [
                            "productCategory" => $product->categories[0],
                            "product" => $product
                            ])}}" title="Accede al artículo"><img class="w-100 border-img" src="{{ Storage::url($product->image) }}" alt="imagen outlet"></a>
                        <div class="position-absolute transform-t-50 d-flex b-0 r-0 mr-3">
                            <p class="btn-pink mr-1">-{{$product->discount}}%</p>
                            <a href="javascript:;" title="Comparte el artículo"><img class="btn-products p-1 mr-1" src="{{ asset('front/img/icon-share.svg') }}" alt="icono compartir"></a>
                            <a href="javascript:;" title="Añade a favoritos el artículo"><img class="btn-products p-1" src="{{ asset('front/img/icon-favorito.svg') }}" alt="icono favorito"></a>
                        </div>
                    </div>
                    <a href="{{LaravelLocalization::getURLFromRouteNameTranslated(App::getLocale(), 'routes.products.showProduct', [
                        "productCategory" => $product->categories[0],
                        "product" => $product
                        ])}}" title="Accede al artículo">
                        <p class="small color-blue mt-4">{{$product->categories[0]->lang()->name}}</p>
                        <p class="font-bold color-black">{{$product->lang()->name}}</p>
                    </a>
                </div>
            </div>
            @endforeach --}}
        </div>
    </div>
</section>
@endsection
