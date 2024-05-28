@extends('front.common.main')
@section('css')
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css" integrity="sha384-GJzZqFGwb1QTTN6wy59ffF1BuGJpLSa9DkKMp0DgiMDm4iYMj70gZWKYbI706tWS" crossorigin="anonymous">
@endsection
@section('content')
@include('front.home.carousel2')
@include('front.home.barra-busqueda')
@section('meta-title', __('aplications.titulo_seo'))
@section('meta-description', __('aplications.descripcion_seo'))
<section id="aplicaciones">
    <div class="container">
        <div class="row mt-4">
            <div class="col-lg-12 col-md-10">
                <h1 class="before-title">{{__('aplications.titulo')}}</h1>
                <p class="mt-3">{{__('aplications.subtext')}}</p>
            </div>
        </div>
        <div class="row mt-4">
            @foreach($applicationCategories as $category)
            <a href="{{LaravelLocalization::getURLFromRouteNameTranslated(App::getLocale(),'routes.applications.show', [
                "applicationCategory" => $category->application->lang()->slug
            ])}}" class="col-md-4 col-sm-6 col-10 offset-sm-0 offset-1 position-relative mt-3">
                <img class="w-100 border-img" src="{{ Storage::url($category->application->image) }}" alt="imagen técnico industrial">
                @if($loop->last)
                <div class="position-absolute position-center-t40">
                    <img src="{{ asset('front/img/mas-aplicaciones.svg') }}" alt="icono más">
                </div>
                @endif
                <div class="card col-8 position-absolute position-center-t75 text-center p-3">
                    <h3>{{$category->application->lang()->name}}</h3>
                </div>
            </a>
            @endforeach
        </div>
    </div>
</section>
@endsection
