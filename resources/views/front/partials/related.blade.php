<section class="productos-relacionados">
    <div class="container">
        <hr class="mt-5">
        <div class="row">
            <div class="col-12 mt-5">
                <p class="color-black font-bold">{{__('Productos.producto_mostrar_relacionados')}}</p>
            </div>
            @foreach($relateds as $related)
            @if($related->active == 1)
                <div class="col-lg-3 col-sm-6 mt-4">
                    <div class="border-card h-100 p-3">
                        <div class="position-relative">
                            <a href="{{LaravelLocalization::getURLFromRouteNameTranslated(App::getLocale(), 'routes.products.showProduct', [
                                    "productCategory" => $productCategory,
                                    "product" => $related
                                    ])}}" title="Accede a la información">
                            <img class="w-100 border-img" src="{{ Storage::url($related->getPrimaryImageUrlAttribute()) }}" alt="imagen relacionada">
                            </a>
                            <div class="position-absolute transform-t-50 d-flex b-0 r-0 mr-3">
                                <span id="{{ $related->id }}" class="btn-icon favorit {{ request()->session()->exists('product-'.$related->id)?'active':'' }}"> <i class="far fa-heart" title="{{ __('Favoritos.add') }}"></i></span>
                            </div>
                        </div>
                        <p class="font-bold color-black mt-4">{{$related->name}}</p>
                        <p class="small">{!! strip_tags(Str::words($related->description, 15, '...')) !!}</p>
                    </div>
                </div>
            @endif
            @endforeach
        </div>
    </div>
</section>
