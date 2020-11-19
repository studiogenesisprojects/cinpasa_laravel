@extends('front.common.main')
@section('meta-title', $productCategory->lang(App::getLocale())->seo_title ?? '')
@section('meta-description', $productCategory->lang(App::getLocale())->seo_description ?? "" )
@section('content')
<section>
    <div class="container-fluid">
        <div class="row">
            <div class="col-3 px-5 pb-3 d-lg-block d-none">
                <p class="color-black"><strong>Filtrar productos</strong></p>
            </div>
            <div class="col-9 px-0 pb-3 d-flex align-items-center ml-lg-0 ml-3">
                <a href="productos.php" title="Accede a la sección productos" class="mr-1 color-grey">Productos </a> / <a href="productos.php" title="Accede a la categoría" class="mx-1 color-grey"> Categorías</a>
            </div>
        </div>
        <hr class="vw-100">
        <div class="row">
            <div id="menu_categorias" class="col-lg-3 col-sm-7 col-10 d-lg-block flex-column px-lg-5 mt-5 background-white z-1">
                <p class="color-blue mb-4 d-flex align-items-center ml-lg-0 ml-3 mt-lg-0 mt-5"><img class="mr-3 mb-1 d-lg-inline-block d-none" src="{{ asset('front/img/icon-categorias.svg') }}" alt="icono menu categorías"><strong>CATEGORÍAS</strong></p>

                @foreach ($fathers as $father)
                <div class="d-flex flex-column ml-4">
                    <a href="{{LaravelLocalization::getURLFromRouteNameTranslated(App::getLocale(),'routes.products.show', [
                        "productCategory" => $father,
                        ])}}" title="Accede a la categoría cintas para cortinas" class="py-3 color-black font-bold d-flex align-items-center">
                        <div class="position-relative mr-3 mb-1"><span class="icon-plus icon-plus-1"></span></div>{{$father->name}}
                    </a>
                </div>
                <div class="collapse show" id="{{$father->slug}}">
                    <div class="sub-item">
                        @foreach ($father->childrens as $child)
                        <a class="d-block {{Str::contains(url()->current(), $child->slug) ? "active": ""}}"
                            href="{{LaravelLocalization::getURLFromRouteNameTranslated(App::getLocale(),'routes.products.show', [
                        "productCategory" => $child,
                        ])}}">{{$child->name}}</a>
                        @endforeach
                    </div>
                </div>
                @endforeach

            </div>
            <div class="col-lg-9">
                <div class="row background-blue-light border-card py-2">
                    <div class="col-8 d-flex align-items">
                        <a id="menu_filtrar_productos" href="#" title="Despliega el menú filtrar productos" class="d-flex align-items"><img class="mr-2 d-lg-none d-inline-block" src="img/icon-categorias.svg" alt="icono menu categorías">
                            <p class="color-blue font-bold">{{$productCategory->name}}</p>
                        </a>
                    </div>
                    <div class="col-4 px-0 d-flex justify-content-between">
                        <hr class="hr-vertical background-blue">
                        <select class="form-control p-0 px-4 w-auto mr-5 border-0" id="">
                            <option>Ordenar</option>
                            <option>Ordenar</option>
                            <option>Ordenar</option>
                            <option>Ordenar</option>
                            <option>Ordenar</option>
                        </select>
                    </div>
                </div>
                <div class="row px-3 pt-4 pb-5 border-card-left">
                    <p class="small">Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum. Stet clita kasd gubergren, no sea takimata sanctus est Lorem ipsum dolor sit amet. Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum. Stet clita kasd gubergren, no sea takimata sanctus est Lorem ipsum dolor sit amet. <br>
                        Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor</p>
                </div>
                <div class="row">
                    @foreach($productCategory->childrens as $product)
                    @if($product->active == 1)
                    {{dd($product->primaryImage->path)}}
                        <div class="col-md-4 col-sm-6 p-3 border-card">
                            <div class="position-relative">
                                <a href="{{LaravelLocalization::getURLFromRouteNameTranslated(App::getLocale(),'routes.products.show', [
                                    "productCategory" => $product,
                                    ])}}" title="Accede a la información"><img class="w-100 border-img" src="{{ route('carousel.getImage', str_replace("/",";",$product->primaryImage->path))}}"></a>
                                <div class="position-absolute transform-t-50 d-flex b-0 r-0 mr-3">
                                    <a href="{{LaravelLocalization::getURLFromRouteNameTranslated(App::getLocale(),'routes.products.show', [
                                        "productCategory" => $product,
                                        ])}}" title="Obten información de este artículo"><img class="btn-products p-1 mr-1" src="{{ asset('front/img/icon-info.svg') }}" alt="icono información"></a>
                                    <a href="#" title="Añade a favoritos este artículo"><img class="btn-products p-1" src="{{ asset('front/img/icon-favorito.svg') }}" alt="icono favoritos"></a>
                                </div>
                            </div>
                            <a href="{{LaravelLocalization::getURLFromRouteNameTranslated(App::getLocale(),'routes.products.show', [
                                "productCategory" => $product,
                                ])}}" title="Accede a la información" class="d-flex flex-column">
                                <p class="small color-blue mt-3">{{ $productCategory->name }}</p>
                                <p class="font-bold color-black">{{ $product->name }}</p>
                            </a>
                        </div>
                        @endif
                    @endforeach
                </div>
            </div>
        </div>
        <hr class="hr-blue">
        <div class="row">
            <div class="col-md-9 offset-md-3 px-0 d-flex py-4">
                <hr class="hr-vertical background-blue-light">
                <a class="ml-3" href="#" title="Número de página">1</a>
                <a class="ml-3" href="#" title="Número de página">2</a>
                <a class="ml-3" href="#" title="Número de página">3</a>
                <a class="ml-3" href="#" title="Número de página">...</a>
                <a class="ml-3" href="#" title="Número de página">40</a>
            </div>
        </div>
        <hr class="hr-blue">
        <div class="row">
            <div class="col-md-8 offset-md-3 px-md-0 py-4">
                <p class="color-blue">Más información sobre cortinas</p>
                <p class="small mt-2">Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum. Stet clita kasd gubergren, no sea takimata sanctus est Lorem ipsum dolor sit amet. Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum. Stet clita kasd gubergren, no sea takimata sanctus est Lorem ipsum dolor sit amet. <br>
                    Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor</p>
            </div>
        </div>
        <hr class="hr-blue">
    </div>
</section>
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
