@extends('front.common.main')
@section('content')
<section id="home">
    <div class="container">
        <div class="row mt-5">
            <div class="col-lg-7 col-md-10">
                <h1 class="before-title mt-5">{{__('Favoritos.titulo')}}</h1>
                <p class="mt-3">{{__('Favoritos.subtitulo')}}</p>
            </div>
        </div>
        <div class="row mt-5">
            <div class="col-lg-8">
                <p class="color-black font-bold mt-2">{{__('Menu.products')}}</p>
                @foreach($products as $product)
                    <div class="card flex-row justify-content-between align-items-center {{!$loop->first ? 'mt-2' : ''}} p-2 {{$product->id}}">
                        <div class="d-flex align-items-center w-100">
                            <div class="col-3 px-0">
                                <a href="{{LaravelLocalization::getURLFromRouteNameTranslated(App::getLocale(), 'routes.products.showProduct', [
                                            "productCategory" => $product->categories[0],
                                            "product" => $product
                                        ])}}" title="Accede al producto favorito"><img class="w-100 border-img" src="{{Storage::url($product->getPrimaryImageUrlAttribute())}}" alt="icono favorito"></a>
                            </div>
                            <div class="col-9">
                                <a href="{{LaravelLocalization::getURLFromRouteNameTranslated(App::getLocale(), 'routes.products.showProduct', [
                                            "productCategory" => $product->categories[0],
                                            "product" => $product
                                        ])}}" title="Accede al producto favorito">
                                    <p class="small color-blue">{{$product->categories[0]->name}}</p>
                                    <p class="font-bold color-black">{{$product->name}}</p>
                                </a>
                            </div>
                        </div>
                        <div class="d-flex align-items-center">
                            <hr class="hr-vertical">
                            <a href="javascript:;" onClick="setFavorite({{$product->id}})" title="Elimina el producto de tus favoritos" class="col-2 d-flex"><img class="p-4" src="{{ asset('front/img/icon-delete.svg') }}" alt="icono eliminar"></a>
                        </div>
                    </div>
                @endforeach
                <p class="color-black font-bold mt-2">{{__('Favoritos.categorias')}}</p>
                @foreach($categories as $product)
                    <div class="card flex-row justify-content-between align-items-center {{!$loop->first ? 'mt-2' : ''}} p-2 {{$product->id}}">
                        <div class="d-flex align-items-center w-100">
                            <div class="col-3 px-0">
                                <a href="{{LaravelLocalization::getURLFromRouteNameTranslated(App::getLocale(), 'routes.products.show', ["productCategory" => $product])}}" title="Accede al producto favorito"><img class="w-100 border-img" src="{{Storage::url($product->image)}}" alt="icono favorito"></a>
                            </div>
                            <div class="col-9">
                                <a href="{{LaravelLocalization::getURLFromRouteNameTranslated(App::getLocale(), 'routes.products.show', ["productCategory" => $product])}}" title="Accede al producto favorito">
                                    <p class="font-bold color-black">{{$product->name}}</p>
                                </a>
                            </div>
                        </div>
                        <div class="d-flex align-items-center">
                            <hr class="hr-vertical">
                            <a href="javascript:;" onClick="setFavorite({{$product->id}})" title="Elimina el producto de tus favoritos" class="col-2 d-flex"><img class="p-4" src="{{ asset('front/img/icon-delete.svg') }}" alt="icono eliminar"></a>
                        </div>
                    </div>
                @endforeach
            </div>
            <div class="col-xl-3 col-lg-4 offset-xl-1 mt-lg-0 mt-4">
                <div class="card py-3 background-grey-light">
                    <div class="col-12">
                        <img src="{{ asset('front/img/icon-big-contacta.svg') }}" alt="icono vectorial contacta">
                        <p class="color-black font-bold mt-2">{{strtoupper(__('Menu.products'))}}</p>
                        <p class="small">{{$favorites->count()}} {{strtolower(__('Menu.products'))}}</p>
                        <hr class="my-2">
                        <p class="small color-black">{{__('Favoritos.texto-enviar')}}</p>
                        <a href="javascript:;" title="Contacta con nosotros para resolver tus dudas" id="contact-favs" class="btn btn-fav w-100 mt-3">{{__('Favoritos.pedir-info')}}</a>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>

<script>
    $("#contact-favs").click(function() {
        $([document.documentElement, document.body]).animate({
            scrollTop: $("#contact-form-products").offset().top
        }, 2000);

        products = '{{json_encode($products)}}';

        $('#comentarios-text').toggleClass('d-none');
        $('#comentarios').prop('checked', true);

        $('#comentarios-text-new').val('{{nl2br($text)}}');
    });
</script>

@endsection
