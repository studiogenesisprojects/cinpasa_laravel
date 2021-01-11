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
                <h5 class="color-primary">Mostrando {{sizeof($featureds) + sizeof($bottomOnes)}} productos</h5>
            </div>
            @if(isset($featureds[0]->product))
                <div class="col-lg-6">
                    <div class="border-card p-3 h-100">
                        <div class="position-relative">
                            <div id="carouselExampleControls" class="carousel slide" data-ride="carousel" data-interval="false">
                                <a href="{{LaravelLocalization::getURLFromRouteNameTranslated(App::getLocale(), 'routes.outlet.show', [
                                    "product" => $featureds[0]->product
                                    ])}}" title="Accede al artículo">
                                    <div class="carousel-inner border-img">
                                        @if($featureds[0]->product->galeries->first())
                                            @foreach ($featureds[0]->product->galeries->first()->images as $image)
                                                <div class="carousel-item {{($loop->first) ? 'active' : ''}}">
                                                    <img class="w-100" src="@if(!empty($image->path)){{Storage::url($image->path)}}@else{{Storage::url('/img/nofoto.png')}}@endif" alt="@empty($image->alt) {{ $featureds[0]->product->lang()->name }} @else {{  $image->alt}} @endempty" class="box-product__carousel">
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
                                <p class="btn-yellow mr-1">-{{$featureds[0]->product->higherDiscount->discount}}%</p>
                                <a href="#" title="Comparte el artículo"><img class="btn-products p-1 mr-1" src="{{ asset('front/img/icon-share.svg') }}" alt="icono compartir"></a>
                                <a href="javascript:;" onClick="setFavorite({{$featureds[0]->product->id}})" title="Añade a favoritos el artículo"><img class="btn-products" style="{{request()->session()->exists('product-' . $featureds[0]->product->id) ? 'padding: .45rem' : 'padding: .25rem'}}" id="{{$featureds[0]->product->id}}" src="{{request()->session()->exists('product-' . $featureds[0]->product->id) ? asset('front/img/fav-active.svg') : asset('front/img/icon-favorito.svg') }}" alt="icono favorito"></a>
                            </div>
                        </div>
                        <a href="{{LaravelLocalization::getURLFromRouteNameTranslated(App::getLocale(), 'routes.outlet.show', [
                            "product" => $featureds[0]->product
                            ])}}" title="Accede al artículo">
                            <p class="small color-blue mt-3">{{$featureds[0]->product->categories[0]->lang()->name}}</p>
                            <p class="font-bold color-black">{{$featureds[0]->product->lang()->name}}</p>
                        </a>
                    </div>
                </div>
            @endif
            <div class="col-lg-6 mt-lg-0 mt-4">
                <div class="row">
                    @for($i = 1; $i < 5; $i++)
                        @if(isset($featureds[$i]->product))
                            <div class="col-sm-6 {{$i % 2 != 0 ? 'mt-sm-0 mt-4' : ''}}">
                                <div class="border-card p-3">
                                    <div class="position-relative">
                                        <a href="{{LaravelLocalization::getURLFromRouteNameTranslated(App::getLocale(), 'routes.outlet.show', [
                                            "product" => $featureds[$i]->product
                                            ])}}" title="Accede al artículo"><img class="w-100 border-img" src="{{ Storage::url($featureds[$i]->product->getPrimaryImageUrlAttribute()) }}" alt="imagen outlet"></a>
                                        <div class="position-absolute transform-t-50 d-flex b-0 r-0 mr-3">
                                            <p class="btn-yellow mr-1">-{{$featureds[$i]->product->higherDiscount->discount}}%</p>
                                            <a href="#" title="Comparte el artículo"><img class="btn-products p-1 mr-1" src="{{ asset('front/img/icon-share.svg') }}" alt="icono compartir"></a>
                                            <a href="javascript:;" onClick="setFavorite({{$featureds[$i]->product->id}})" title="Añade a favoritos el artículo"><img class="btn-products" style="{{request()->session()->exists('product-' . $featureds[$i]->product->id) ? 'padding: .45rem' : 'padding: .25rem'}}" id="{{$featureds[$i]->product->id}}" src="{{request()->session()->exists('product-' . $featureds[$i]->product->id) ? asset('front/img/fav-active.svg') : asset('front/img/icon-favorito.svg') }}" alt="icono favorito"></a>
                                        </div>
                                    </div>
                                    <a href="{{LaravelLocalization::getURLFromRouteNameTranslated(App::getLocale(), 'routes.outlet.show', [
                                        "product" => $featureds[$i]->product
                                        ])}}" title="Accede al artículo">
                                        <p class="small color-blue mt-3">{{$featureds[$i]->product->categories[0]->lang()->name}}</p>
                                    <p class="font-bold color-black">{{$featureds[$i]->product->lang()->name}}</p>
                                    </a>
                                </div>
                            </div>
                        @endif
                    @endfor
                </div>
            </div>
        </div>
        @if(isset($banner))
        <img src="{{ Storage::url($banner->image) }}" alt="imagen banner" class="w-100 border-img mt-5">
        @endif
        <div class="row mt-5">
            @foreach($bottomOnes as $category)
                @foreach($category as $product)
                <div class="col-lg-3 col-md-4 col-sm-6 mt-4">
                    <div class="border-card p-3">
                        <div class="position-relative">
                            <a href="{{LaravelLocalization::getURLFromRouteNameTranslated(App::getLocale(), 'routes.outlet.show', [
                                "product" => $product
                                ])}}" title="Accede al artículo"><img class="w-100 border-img" src="{{ Storage::url($product->getPrimaryImageUrlAttribute()) }}" alt="imagen outlet"></a>
                            <div class="position-absolute transform-t-50 d-flex b-0 r-0 mr-3">
                                <p class="btn-pink mr-1">-{{$product->higherDiscount->discount}}%</p>
                                <a href="javascript:;" title="Comparte el artículo"><img class="btn-products p-1 mr-1" src="{{ asset('front/img/icon-share.svg') }}" alt="icono compartir"></a>
                                <a href="javascript:;" onClick="setFavorite({{$product->id}})" title="Añade a favoritos el artículo"><img class="btn-products" id="{{$product->id}}" style="{{request()->session()->exists('product-' . $product->id) ? 'padding: .45rem' : 'padding: .25rem'}}" src="{{request()->session()->exists('product-' . $product->id) ? asset('front/img/fav-active.svg') : asset('front/img/icon-favorito.svg') }}" alt="icono favorito"></a>
                            </div>
                        </div>
                        <a href="{{LaravelLocalization::getURLFromRouteNameTranslated(App::getLocale(), 'routes.outlet.show', [
                            "product" => $product
                            ])}}" title="Accede al artículo">
                            <p class="small color-blue mt-4">{{$product->categories[0]->lang()->name}}</p>
                            <p class="font-bold color-black">{{$product->lang()->name}}</p>
                        </a>
                    </div>
                </div>
                @endforeach
            @endforeach
        </div>
    </div>
</section>
@endsection
