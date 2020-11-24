@extends('front.common.main')
@section('meta-title', __('Noticias.meta-title'))
@section('meta-description', __('Noticias.meta-description'))
@section('content')
<section class="slider">
    <div class="container">
        <div class="row">
            <div class="col-12">
                <div id="searcher-menu">
                    {{-- @include('front.common.partials.searcher') --}}
                </div>
            </div>
        </div>
    </div>
</section>
<section class="topicality bg-light py-5">
    <div class="container" id="app">
        <div class="row">
            <div class="col-md-10 col-12">
                <h3 class="title-xl">{{__('Noticias.seccion1_titulo')}}</h3>
                <p class="text text-default">{{__('Noticias.seccion1_texto')}}</p>
            </div>
        </div>

        <div class="row mt-5">
            @include('front.home.actualidad')
        </div>
    </div>
</section>
@endsection
