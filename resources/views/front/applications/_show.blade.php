@extends('front.common.main')
@section('css')
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css" integrity="sha384-GJzZqFGwb1QTTN6wy59ffF1BuGJpLSa9DkKMp0DgiMDm4iYMj70gZWKYbI706tWS" crossorigin="anonymous">
@endsection
@section('meta-title', $applicationCategory->lang(App::getLocale())->seo_title ?? $applicationCategory->lang(App::getLocale())->seo_title)
@section('meta-description', $applicationCategory->lang(App::getLocale())->seo_description ?? $applicationCategory->lang(App::getLocale())->seo_description )

@section('content')
<div class="container-fluid px-0">
    <div class="position-relative">
        <div id="carouselExampleIndicators" class="carousel slide" data-ride="carousel" data-interval="false">
            <div class="carousel-inner position-relative">
                <div class="carousel-item position-relative overflow-hidden bg-cover bg-xl active">
                    <img src="{{Storage::url($aplication->primary_image ?? "")}}" style="height: 600px;" class="d-block w-100 w-lg-150 w-sm-200 w-xs-400" alt="primero slide">
                    <div class="position-absolute d-flex justify-content-center align-items-center w-100 h-100 t-0 l-0 z-1">
                        <div class="container">
                            <div class="row">
                                <div class="col-lg-6 col-md-8 col-10 offset-xl-0 offset-1">
                                    <h1 class="before-title" style="color-white;">{{$aplication->name}}</h1>
                                    <p class="color-white">{{$applicationCategory->name}}</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="position-absolute w-100 h-100">
                    <img class="w-100 w-lg-150 w-sm-200 w-xs-400" src="{{ asset('front/img/home-carousel-degraded.png') }}" alt="degradado">
                </div>
            </div>
        </div>
    </div>
</div>
@include('front.home.barra-busqueda')
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
                            <a class="btn-icon" href="{{LaravelLocalization::getURLFromRouteNameTranslated(App::getLocale(), 'routes.products.showProduct', [
                                "productCategory" =>  $product->categories->first() ? $product->categories->first()->lang(App::getLocale()) : "",
                                "product" => $product
                                ])}}" title="Obten información de este artículo"><i class="fas fa-info-circle" title="icono información"></i></a>
                            <span id="{{ $product->id }}" class="btn-icon favorit {{ request()->session()->exists('product-'.$product->id)?'active':'' }}"> <i class="far fa-heart" title="{{ __('Favoritos.add') }}"></i></span>
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
        <br>
        {{$products->links()}}
    </div>
</section>
@endsection
