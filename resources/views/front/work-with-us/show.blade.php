@extends('front.common.main')

@section('content')
<section id="home">
    @if (\Session::has('message'))
    <div class="container">
        <div class="alert alert-success">{!! \Session::get('message') !!}</div>
    </div>
    @endif
    <div class="container">
        <br>
        <div class="row">
            <div class="col-12 my-2">
            </div>
        </div>
        <div class="row">
            <div class="col-lg-6 col-md-7">
                <h1 class="before-title">{{$offer->lang()->name}}</h1>
                {!! $offer->lang()->description !!}
                <hr class="mt-4">
                <div class="row mt-5">
                    <div class="col-6">
                        <p class="small color-blue">{{__('TrabajaConNosotros.ficha-tiempo')}}</p>
                        <p class="color-primary">{!! $offer->lang()->time !!}</p>
                    </div>
                    <div class="col-6">
                        <p class="small color-blue">{{__('TrabajaConNosotros.ficha-salario')}}</p>
                        <p class="color-primary">{!! $offer->lang()->salary !!}</p>
                    </div>
                    <div class="col-6 mt-5">
                        <p class="small color-blue">{{__('TrabajaConNosotros.ficha-duracion')}}</p>
                        <p class="color-primary">{!! $offer->lang()->duration !!}</p>
                    </div>
                    <div class="col-6 mt-5">
                        <p class="small color-blue">{{__('TrabajaConNosotros.ficha-lugar')}}</p>
                        <p class="color-primary">{!! $offer->lang()->location !!}</p>
                    </div>
                </div>
            </div>
            <div class="col-xl-4 col-md-5 offset-xl-2 offset-lg-1 mt-md-0 mt-5">
                <div class="card background-blue-light p-4">
                    <p class="color-black font-bold">{{__('TrabajaConNosotros.ficha-info-adicional')}}</p>
                    <p class="mt-4">
                        {!! $offer->lang()->additional_info !!}
                    </p>
                </div>
            </div>
        </div>
        <div class="row mt-5">
            <div class="col-12 mt-4">
                <hr>
            </div>
            <div class="col-md-9 mt-5">
                <p class="color-black font-bold">{{__('TrabajaConNosotros.ficha-requisitos')}}</p>
                <p class="mt-4"> {!! $offer->lang()->requirements !!}</p>
            </div>
        </div>
    </div>
</section>
@include('front.partials.send-cv')
@endsection

