<div class="row mx-0 my-5">
@foreach($labs as $lab)
<div class="col-lg-4 col-sm-6 px-0 border-card">
    <a href="{{LaravelLocalization::getURLFromRouteNameTranslated(App::getLocale(),'routes.lab.show_products',
        ["slug" => $lab->slug
        ])}}" class="small color-black">
    <img class="w-100" src="{{ Storage::url($lab->image) }} alt="{{$lab->name}}">
    <div class="d-flex justify-content-between align-items-center py-4 px-3">
        <p class="font-bold color-black">{{$lab->name}}</p>
        <a href="{{LaravelLocalization::getURLFromRouteNameTranslated(App::getLocale(),'routes.lab.show_products',
        ["slug" => $lab->slug
        ])}}" class="small color-black">{{__('Inicio.ver-productos')}}<img class="ml-3" src="{{ asset('front/img/icon-arrow-right-black.svg') }}" alt="icono flecha derecha"></a>
    </div>
</a>
</div>
@endforeach
</div>
