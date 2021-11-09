@extends('front.common.main')

@section('content')
@include('front.home.carousel2')
@section('meta-title', __('Outlet.titulo_seo'))
@section('meta-description', __('Outlet.descripcion_seo'))
<section id="aplicaciones">
    <div class="container">
        <div class="row">
            <div class="col-12 mt-5">
                <h1 class="mt-5 font-bold before-title">{{__('Menu.products')}}</h1>
                <p class="mt-3">{{__('Outlet.stocks')}}</p>
            </div>
        </div>
        <div id="banners" class="carousel slide" data-ride="carousel">
            <div class="carousel-inner">
                @foreach ($banners as $banner)
                <div class="carousel-item {{ $loop->first?'active':'' }}" data-interval="10000">
                    @if(!empty($banner->url))
                    <a href="{{ $banner->url }}" title="{{ $banner->name }}">
                        <img src="{{ Storage::url($banner->image) }}" class="w-100" alt="{{ $banner->name }}" />
                    </a>
                    @else
                    <img src="{{ Storage::url($banner->image) }}" class="w-100" alt="{{ $banner->name }}" />
                    @endif
                </div>
                @endforeach
            </div>
          </div>
        <div class="row mt-5">
            <div class="col-12 mb-4">
                <h5 class="color-primary">{{__('Outlet.texto_productos')}} {{sizeof($categoriesOutlet)}} {{__('Menu.products')}}</h5>
            </div>

        <div class="row mt-5">
            @foreach($categoriesOutlet as $category)
                @foreach($category as $product)
                <div class="col-lg-3 col-md-4 col-sm-6 mt-4">
                    <div class="border-card p-3">
                        <div class="position-relative">
                            <a href="{{LaravelLocalization::getURLFromRouteNameTranslated(App::getLocale(), 'routes.outlet.show', [
                                "product" => $product
                                ])}}" title="{{$product->lang()->name}}"><img class="w-100 border-img" src="{{ Storage::url($product->getPrimaryImageUrlAttribute()) }}" alt="{{$product->lang()->name}}"></a>
                            <div class="position-absolute transform-t-50 d-flex b-0 r-0 mr-3">
                                <p class="btn-pink mr-1">-{{$product->higherDiscount->discount}}%</p>
                                <a href="javascript:;" title="Comparte el artículo"><img class="btn-products p-1 mr-1" src="{{ asset('front/img/icon-share.svg') }}" alt="icono compartir"></a>
                                <a href="javascript:;" onClick="setFavorite({{$product->id}})" title="Añade a favoritos el artículo"><img class="btn-products" id="{{$product->id}}" style="{{request()->session()->exists('product-' . $product->id) ? 'padding: .45rem' : 'padding: .25rem'}}" src="{{request()->session()->exists('product-' . $product->id) ? asset('front/img/fav-active.svg') : asset('front/img/icon-favorito.svg') }}" alt="icono favorito"></a>
                            </div>
                        </div>
                        <a href="{{LaravelLocalization::getURLFromRouteNameTranslated(App::getLocale(), 'routes.outlet.show', [
                            "product" => $product
                            ])}}" title="{{$product->lang()->name}}">
                            <p class="small color-blue mt-4">{{$product->categories[0]->lang()->name}}</p>
                            <p class="font-bold color-black">{{$product->lang()->name}}</p>
                            @if($product->caracteristics->min('stock') > 0)
                            <p class="small color-blue mt-4">{{$product->caracteristics->min('stock') }} u.</p>
                            @endif
                        </a>
                    </div>
                </div>
                @endforeach
            @endforeach
        </div>
    </div>
</section>
@endsection
