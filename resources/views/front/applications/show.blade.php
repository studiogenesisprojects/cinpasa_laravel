@extends('front.common.main')
@section('css')
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css" integrity="sha384-GJzZqFGwb1QTTN6wy59ffF1BuGJpLSa9DkKMp0DgiMDm4iYMj70gZWKYbI706tWS" crossorigin="anonymous">
@endsection
@section('meta-title', $applicationCategory->lang(App::getLocale())->seo_title ?? $applicationCategory->lang(App::getLocale())->seo_title)
@section('meta-description', $applicationCategory->lang(App::getLocale())->seo_description ?? $applicationCategory->lang(App::getLocale())->seo_description )
@section('content')
@include('front.home.carousel2')
@include('front.home.barra-busqueda')
<section id="aplicaciones">
    <div class="container">
        <div class="row mt-4">
            <div class="col-lg-7 col-md-10">
                <h1 class="before-title">{{$applicationCategory->lang()->name}}</h1>
                <p class="mt-3">{!! $applicationCategory->lang()->description !!}</p>
            </div>
        </div>
        <div class="row mt-5">
            @foreach ($applications as $children)
            {{-- @dd($children) --}}
            <a href="{{LaravelLocalization::getURLFromRouteNameTranslated(App::getLocale(),'routes.applications._show', [
                "aplication" => $children,
                "applicationCategory" => $applicationCategory->lang(App::getLocale())->slug
            ])}}" class="col-md-4 col-sm-6 col-10 offset-sm-0 offset-1 position-relative mt-3">
                <img class="w-100 border-img" src="{{Storage::url($children->list_image ?? "")}}" alt="imagen cojines">
                <div class="card col-8 position-absolute position-center-t75 text-center p-3">
                    <h6>{{$children->lang(App::getLocale())->name ?? ""}}</h6>
                </div>
            </a>
            @endforeach
        </div>
    </div>
</section>
@endsection
