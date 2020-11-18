@foreach ($homeApps as $homeApp)
<a href="@if($homeApp->aplication_type === 'App\Models\Aplication')
    {{LaravelLocalization::getURLFromRouteNameTranslated(App::getLocale(),'routes.applications._show', [
        "applicationCategory" => $homeApp->applicationable->applicationCategories->first(),
        "aplication" => $homeApp->applicationable
        ])}}
    @else
    {{LaravelLocalization::getURLFromRouteNameTranslated(App::getLocale(),'routes.applications.show', [
        "applicationCategory" => $homeApp->applicationable,
        ])}}
    @endif" class="col-lg-3 col-md-4 col-sm-6 position-relative">
    <img class="w-100 border-img" src="{{ route('carousel.getImage', str_replace("/",";",$homeApp->applicationable->list_image)) }}" alt="categoria cintas de cortina">
    <div class="card col-8 position-absolute position-center-t75 text-center p-3">
        <small>{{__('Inicio.seccion1_boton')}}</small>
        <h6>{{$homeApp->applicationable->name}}</h6>
    </div>
</a>
@endforeach
