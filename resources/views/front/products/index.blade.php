@extends('front.common.main')
@section('content')
<section>
    @include('front.home.carousel2')
    @include('front.home.barra-busqueda')
    @section('meta-title', __('Productos.titulo_seo'))
    @section('meta-description', __('Productos.descripcion_seo'))
    <div class="container-fluid">
        <div class="row">
            <div class="col-3 px-5 pb-3 d-lg-block d-none">
                <p class="color-black"><strong>Filtrar productos</strong></p>
            </div>
            <div class="col-9 px-0 pb-3 d-flex align-items-center ml-lg-0 ml-3">
                <a href="javascript:;" title="Accede a la sección productos" class="mr-1 color-grey">Productos </a> / <a href="javascript:;" title="Accede a la categoría" class="mx-1 color-grey"> Categorías</a>
            </div>
        </div>
        <hr class="vw-100">
        <div class="row">
            <div id="menu_categorias" class="col-lg-3 col-sm-7 col-10 d-lg-block flex-column px-lg-5 mt-5 background-white z-1">
                <p class="color-blue mb-4 d-flex align-items-center ml-lg-0 ml-3 mt-lg-0 mt-5"><img class="mr-3 mb-1 d-lg-inline-block d-none" src="{{ asset('front/img/icon-categorias.svg') }}" alt="icono menu categorías"><strong>CATEGORÍAS</strong></p>
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
                @endif
                @endforeach

            </div>
            <div class="col-lg-9">
                <div class="row background-blue-light border-card py-2">
                    <div class="col-8 d-flex align-items">
                        <a id="menu_filtrar_productos" href="#" title="Despliega el menú filtrar productos" class="d-flex align-items"><img class="mr-2 d-lg-none d-inline-block" src="{{ asset('front/img/icon-categorias.svg') }}" alt="icono menu categorías">
                            <p class="color-blue font-bold"></p>
                        </a>
                    </div>
                    {{-- <div class="col-4 px-0 d-flex justify-content-between">
                        <hr class="hr-vertical background-blue">
                        <select class="form-control p-0 px-4 w-auto mr-5 border-0" id="">
                            <option>Z-A</option>
                            <option>A-Z</option>
                        </select>
                    </div> --}}
                </div>
                <div class="row px-3 pt-4 pb-5 border-card-left">

                </div>

            </div>
        </div>
        <hr class="hr-blue">
        <div class="row">
            <div class="col-md-9 offset-md-3 px-0 d-flex py-4">

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
