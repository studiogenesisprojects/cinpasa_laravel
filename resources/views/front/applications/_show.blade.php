@extends('front.common.main')
@section('css')
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css" integrity="sha384-GJzZqFGwb1QTTN6wy59ffF1BuGJpLSa9DkKMp0DgiMDm4iYMj70gZWKYbI706tWS" crossorigin="anonymous">
@endsection
@section('content')
<br><br><br>
{{-- @include('front.home.barra-busqueda') --}}
<section class="products">
    <div class="container">
        <div class="row">
            <div class="col-md-8 col-12">
                <h3 class="title-md mt-5">{{$aplication->lang(App::getLocale())->name ?? ""}}</h3>
                <br>
                <h2 class="title-xl">{{$aplication->lang(App::getLocale())->subtitle ?? ""}}</h2>
                <p class="text text-default">{!! $aplication->lang(App::getLocale())->description??"" !!}</p>
            </div>
        </div>
        <div class="row">
            @foreach($products as $product)
            @if($product->active == 1)
                <div class="col-md-4 col-sm-6 p-3 border-card">
                    <div class="position-relative">
                        <a href="{{LaravelLocalization::getURLFromRouteNameTranslated(App::getLocale(), 'routes.products.showProduct', [
                            "productCategory" => $product->categories->first() ? $product->categories->first()->lang(App::getLocale()) : "",
                            "product" => $product
                            ])}}" title="Accede a la información"><img class="w-100 border-img" src="{{ Storage::url($product->getPrimaryImageUrlAttribute()) }}"></a>
                        <div class="position-absolute transform-t-50 d-flex b-0 r-0 mr-3">
                            <a href="{{LaravelLocalization::getURLFromRouteNameTranslated(App::getLocale(), 'routes.products.showProduct', [
                                "productCategory" =>  $product->categories->first() ? $product->categories->first()->lang(App::getLocale()) : "",
                                "product" => $product
                                ])}}" title="Obten información de este artículo"><img class="btn-products p-1 mr-1" src="{{ asset('front/img/icon-info.svg') }}" alt="icono información"></a>
                            <a href="#" title="Añade a favoritos este artículo"><img class="btn-products p-1" src="{{ asset('front/img/icon-favorito.svg') }}" alt="icono favoritos"></a>
                        </div>
                    </div>
                    <a href="{{LaravelLocalization::getURLFromRouteNameTranslated(App::getLocale(), 'routes.products.showProduct', [
                        "productCategory" => $product->categories->first() ? $product->categories->first()->lang(App::getLocale()) : "",
                        "product" => $product
                        ])}}" title="Accede a la información" class="d-flex flex-column">
                        <p class="small color-blue mt-3">{{ $aplication->lang(App::getLocale())->name }}</p>
                        <p class="font-bold color-black">{{ $product->name }}</p>
                    </a>
                </div>
                @endif
            @endforeach
        </div>
    </div>
</section>
@endsection
