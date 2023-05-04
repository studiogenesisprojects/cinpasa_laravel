@extends('front.common.main')
@section('meta-title', isset($productCategory->lang(App::getLocale())->seo_title) ? $productCategory->lang(App::getLocale())->seo_title : '')
@section('meta-description',  isset($productCategory->lang(App::getLocale())->seo_description) ? $productCategory->lang(App::getLocale())->seo_description : '' )
@section('content')
<section>
    @if(isset($isLab))
        @include('front.home.carousel2')
    @else
        <br><br><br>
    @endif

    @include('front.home.barra-busqueda')
    <div class="container-fluid">
        <div class="row">
            <div class="col-3 px-5 pb-3 d-lg-block d-none">
                <p class="color-black"><strong>{{__('Productos.filter')}}</strong></p>
            </div>
        </div>
        <hr class="vw-100">
        <div class="row">
            <div id="menu_categorias" class="col-lg-3 col-sm-7 col-10 d-lg-block flex-column px-lg-5 mt-5 background-white z-1">
                <p class="color-blue mb-4 d-flex align-items-center ml-lg-0 ml-3 mt-lg-0 mt-5"><img class="mr-3 mb-1 d-lg-inline-block d-none" src="{{ asset('front/img/icon-categorias.svg') }}" alt="icono menu categorías"><strong>{{__('Productos.categorias')}}</strong></p>
                @php
                    $fathers = $fathers->sortBy('order');
                @endphp
                @foreach ($fathers as $father)
                @if($father->active == 1)
                <div class="d-flex flex-column ml-4">
                    <a href="{{LaravelLocalization::getURLFromRouteNameTranslated(App::getLocale(),'routes.products.show', [
                        "productCategory" => $father,
                        ])}}" title="Accede a la categoría cintas para cortinas" class="py-3 color-black font-bold d-flex align-items-center">
                        <div class="position-relative mr-3 mb-1"><span class="icon-plus icon-plus-1"></span></div>{{$father->name}}
                    </a>
                </div>
                @php
                    $childs = $father->childrens;
                    $childs = $childs->sortBy('searcher_order');
                @endphp
                <div class="collapse show" id="{{$father->slug}}">
                    <div class="sub-item">
                        @foreach ($childs as $child)
                        <a class="d-block {{Str::contains(url()->current(), $child->slug) ? "active": ""}}"
                            href="{{LaravelLocalization::getURLFromRouteNameTranslated(App::getLocale(),'routes.products.show', [
                        "productCategory" => $child,
                        ])}}">{{$child->name}}</a>
                        @endforeach
                    </div>
                </div>
                @endif
                @endforeach

            </div>
            <div class="col-lg-9">
                <div class="row background-blue-light border-card py-2">
                    <div class="col-8 d-flex align-items">
                        <a id="menu_filtrar_productos" href="#" title="Despliega el menú filtrar productos" class="d-flex align-items"><img class="mr-2 d-lg-none d-inline-block" src="{{ asset('front/img/icon-categorias.svg') }}" alt="icono menu categorías">
                            <p class="color-blue font-bold"><h1 style="font-size: 25px">{{$productCategory->name}}</h1></p>
                        </a>
                    </div>
                    @if(isset($isLab) && !$isLab)
                    <div class="col-4 px-0 d-flex justify-content-between">
                        <hr class="hr-vertical background-blue">
                        <form action="{{LaravelLocalization::getURLFromRouteNameTranslated(App::getLocale(),'routes.products.show', [
                            "productCategory" => $productCategory,
                            ])}}" method="POST" id="filter_form">
                            @csrf
                            <select class="form-control p-0 px-4 w-auto mr-5 border-0" name="filter" id="filter">
                                <option value="2" {{isset($filter) && $filter == 2 ? 'selected' : ''}}>Z-A</option>
                                <option value="1"{{isset($filter) && $filter == 1 ? 'selected' : ''}}>A-Z</option>
                            </select>
                        </form>
                    </div>
                    @endif
                </div>
                @if($productCategory->lang(App::getLocale()))
                <div class="row px-3 pt-4 pb-5 border-card-left">
                    <p class="small">{{$productCategory->lang(App::getLocale())->description}}</p>
                    <p class="mt-5">
                        <a class="dudas-link" href="https://api.whatsapp.com/send?phone=34621283448&locale={{ App::getLocale() }}&text={{ __('Comun.whatsapp_products_message') }} {{$productCategory->name}}" title="{{ __('Comun.whatsapp_doubts_title') }}" hreflang="{{ App::getLocale() }}">
                            <i class="fa fa-whatsapp"></i>{{ __('Comun.whatsapp_doubts_title') }}
                        </a>
                    </p>


                </div>
                @endif
                <div class="row">
                    @foreach($products as $product)
                    @if($product->active == 1)
                        <div class="col-md-4 col-sm-6 p-3 border-card">
                            <div class="position-relative">
                                @if(Storage::url($product->getPrimaryImageUrlAttribute()) != '/storage/')
                                    <a href="{{LaravelLocalization::getURLFromRouteNameTranslated(App::getLocale(), 'routes.products.showProduct', [
                                        "productCategory" => $product->categories[0],
                                        "product" => $product
                                        ])}}" title="Accede a la información"><img class="w-100 border-img" src="{{ Storage::url($product->getPrimaryImageUrlAttribute()) }}"></a>
                                @else
                                    <a href="{{LaravelLocalization::getURLFromRouteNameTranslated(App::getLocale(), 'routes.products.showProduct', [
                                        "productCategory" => $product->categories[0],
                                        "product" => $product
                                        ])}}" title="Accede a la información"><img class="w-100 border-img" src="{{ asset('front/img/no-foto.jpg') }}"></a>
                                @endif

                                <div class="position-absolute transform-t-50 d-flex b-0 r-0 mr-3">
                                    <a href="{{LaravelLocalization::getURLFromRouteNameTranslated(App::getLocale(), 'routes.products.showProduct', [
                                        "productCategory" => $product->categories[0],
                                        "product" => $product
                                        ])}}" title="Obten información de este artículo" class="btn-icon"><i class="fas fa-info-circle" title="icono información"></i></a>
                                    <span id="{{ $product->id }}" class="btn-icon favorit {{ request()->session()->exists('product-'.$product->id)?'active':'' }}"> <i class="far fa-heart" title="{{ __('Favoritos.add') }}"></i></span>
                                </div>
                            </div>
                            <a href="{{LaravelLocalization::getURLFromRouteNameTranslated(App::getLocale(), 'routes.products.showProduct', [
                                "productCategory" => $product->categories[0],
                                "product" => $product
                                ])}}" title="Accede a la información" class="d-flex flex-column">
                                <p class="small color-blue mt-3">{{ $productCategory->name }}</p>
                                <p class="font-bold color-black">{{ $product->name }}</p>
                            </a>
                        </div>
                        @endif
                    @endforeach
                </div>
                @if(isset($products) && method_exists($products, 'links'))
                    {{$products->links()}}
                @endif
            </div>
        </div>

        <hr class="hr-blue">
        <div class="row">
            <div class="col-md-9 offset-md-3 px-0 d-flex py-4">

            </div>
        </div>
        <hr class="hr-blue">
        @if($productCategory->lang(App::getLocale()))
        <div class="row">
            <div class="col-md-8 offset-md-3 px-md-0 py-4">
            <p class="small mt-2">{{$productCategory->lang(App::getLocale())->footer_description}}</p>
            </div>
        </div>
        <hr class="hr-blue">
        @endif
    </div>
</section>
<script>
    $('#filter').change(function(){
        $('#filter_form').submit();
    });
</script>
@endsection

@push('js')
<script>
    let bool_filtrar_productos = true;
    let tl_filtrar_productoso = gsap.timeline({
            paused: true
        })
        .set("#menu_categorias", {
            display: "block"
        })
        .to("#menu_categorias", {
            duration: 0.6,
            x: 0,
            ease: "power2.in"
        });


    $("#menu_filtrar_productos").click(function() {
        event.preventDefault();

        if (bool_filtrar_productos == true) {
            tl_filtrar_productoso.play();
            bool_filtrar_productos = false;
        } else {
            tl_filtrar_productoso.reverse();
            bool_filtrar_productos = true;
        }
    });


    $(".btn-show").each(function() {
        let submenu = $(this).find('.opacity-0');
        let img_rotate = $(this).find('img.mr-3');
        $(this).click(function() {
            event.preventDefault();

            var value = this.value;
            if (value == "Hide") {
                this.value = "Show";
                $(submenu).hide();
                gsap.to(img_rotate, {
                    rotate: "0deg",
                    duration: .3
                })
                gsap.to(submenu, {
                    opacity: 0,
                    duration: .5
                })
            } else {
                this.value = "Hide";
                $(submenu).show();
                gsap.to(img_rotate, {
                    rotate: "180deg",
                    duration: .3
                })
                gsap.to(submenu, {
                    opacity: 1,
                    duration: .5
                })
            }
        });
    });

    document.addEventListener("DOMContentLoaded", function(event) {
        let controller = new ScrollMagic.Controller();

        var tl_productos = gsap.timeline()
            .from("#productos", {
                duration: 0.5,
                y: "100px",
                opacity: 0
            })

        let escena_productos = new ScrollMagic.Scene({
                triggerElement: "body",
                triggerHook: 1,
                reverse: false
            })
            .setTween(tl_productos)
            .addTo(controller);
    });

</script>
@endpush
