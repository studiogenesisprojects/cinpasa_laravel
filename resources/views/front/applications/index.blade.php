@extends('front.common.main')
@section('css')
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css" integrity="sha384-GJzZqFGwb1QTTN6wy59ffF1BuGJpLSa9DkKMp0DgiMDm4iYMj70gZWKYbI706tWS" crossorigin="anonymous">
@endsection
@section('content')
@include('front.home.carousel')
@include('front.home.barra-busqueda')
<section id="aplicaciones">
    <div class="container">
        <div class="row mt-4">
            <div class="col-lg-7 col-md-10">
                <h2 class="before-title">Aplicaciones</h2>
                <p class="mt-3">En Cinpasa estamos especializados en diferentes aplicaciones. Según la aplicación y tus necesidades, buscamos una solución.</p>
            </div>
        </div>
        <div class="row mt-5">
            @foreach($applicationCategories as $category)
            <a href="{{LaravelLocalization::getURLFromRouteNameTranslated(App::getLocale(),'routes.applications.show', [
                "applicationCategory" => $category->lang()->slug
            ])}}" class="col-md-4 col-sm-6 col-10 offset-sm-0 offset-1 position-relative">
                <img class="w-100 border-img" src="{{ route('carousel.getImage', str_replace("/",";",$category->list_image)) }}" alt="imagen técnico industrial">
                <div class="card col-8 position-absolute position-center-t75 text-center p-3">
                    <h6>{{$category->name}}</h6>
                </div>
            </a>
            @endforeach
        </div>
    </div>
</section>
@endsection
