
@foreach ($homeApps as $key => $homeApp)
@if($key != 7)
    <a href="{{LaravelLocalization::getURLFromRouteNameTranslated(App::getLocale(),'routes.products.show', [
                "productCategory" => $homeApp,
            ])}}" class="col-lg-3 col-md-4 col-sm-6 position-relative mt-3">
        <img class="w-100 border-img" src="{{ Storage::url($homeApp->image) }}" alt="categoria cintas de cortina">
        <div class="card col-8 position-absolute position-center-t75 text-center p-3">
            <small>{{__('Inicio.seccion1_boton')}}</small>
            <h6>{{$homeApp->getNameAttribute()}}</h6>
        </div>
    </a>
@else
    <a href="{{LaravelLocalization::getURLFromRouteNameTranslated(App::getLocale(),'routes.applications.show', [
                "applicationCategory" => $homeApp->lang()->slug
            ])}}" class="col-lg-3 col-md-4 col-sm-6 position-relative mt-3">
        <img class="w-100 border-img" src="{{ Storage::url($homeApp->list_image) }}" alt="categoria cintas de cortina">
        <div class="card col-8 position-absolute position-center-t75 text-center p-3">
            <small>{{__('Inicio.seccion1_boton')}}</small>
            <h6>{{$homeApp->getNameAttribute()}}</h6>
        </div>
    </a>
@endif
@endforeach
