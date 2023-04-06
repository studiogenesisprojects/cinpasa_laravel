@extends('front.common.main')

@section('content')
@include('front.home.carousel2')
<section id="aplicaciones">
    <div class="container">
            <div class="row">
                <div class="col-lg-8 transform-t-5">
                    <div class="card flex-row flex-wrap p-4">
                        <div class="col-10">
                            <h4 class="mt-4 color-black">{{__('Contacta.titulo_ok')}}</h4>
                            <p class="mt-3">{{__('Contacta.text_ok')}}</p>
                            <hr class="mt-4">
                        </div>
                        <div class="col-12">
                            <h5 class="mt-5 color-black font-bold">{{__('Contacta.resume_ok')}}</h5>
                        </div>
                        <div class="col-5">
                            <p class="small mt-4">{{__('Contacta.name')}}</p>
                            <p>{{$petition->fullname}}</p>
                        </div>
                        <div class="col-7 d-flex mt-4">
                            <hr class="hr-vertical mr-4 background-grey-light">
                            <div>
                                <p class="small">{{__('Contacta.email')}}</p>
                                <p>{{$petition->email}}</p>
                            </div>
                        </div>
                        <div class="col-5">
                            <p class="small mt-4">{{__('Contacta.phone2')}}</p>
                            <p>{{$petition->phone_number}}</p>
                        </div>
                        <div class="col-7 d-flex mt-4">
                            <hr class="hr-vertical mr-4 background-grey-light">
                            <div>
                                <p class="small">{{__('Contacta.interest')}}</p>
                                @if($request->presu == 'info')
                                <p>{{__('Contacta.recibir_info')}}</p>
                                @endif
                                @if($request->distribute == 'true')
                                <p>{{__('Distribuir.distribute')}}</p>
                                @endif
                                @if($request->presu == 'presupuesto')
                                <p>{{__('Contacta.recibir_presu')}}</p>
                                @endif
                            </div>
                        </div>
                        @if($petition->company)
                        <div class="col-5">
                            <p class="small mt-4">{{__('Contacta.empresa')}}</p>
                            <p>{{$petition->company}}</p>
                        </div>
                        @endif
                        <div class="col-7 d-flex mt-4">
                            <hr class="hr-vertical mr-4 background-grey-light">
                            <div>
                                <p class="small">{{__('Contacta.pais')}}</p>
                                <p>{{$petition->country}}</p>
                            </div>
                        </div>

                        <div class="col-12 mt-4">
                            <hr>
                            <p class="mt-3">{{__('Contacta.more_info')}}</p>
                            <p class="mt-2">{{$petition->comment}}</p>
                        </div>
                    </div>
                </div>
                <div class="col-3 offset-1 d-lg-flex d-none flex-column justify-content-end">
                    <img class="w-100" src="{{ asset('front/img/contacta-1.jpg') }}" alt="imagen mujer sonriendo">
                </div>
                @if(count($petition->petitionProducts) > 0)
                <div class="col-12 mt-4">
                    <div class="row">
                    @foreach($petition->petitionProducts as $pp)
                        @php $product = app\Models\Product::find($pp->product_id) @endphp
                            <div class="col-3 mt-4">
                                <div class="border-card h-100 p-3">
                                    <div class="position-relative">
                                        <img class="w-100 border-img" src="{{ Storage::url($product->getPrimaryImageUrlAttribute()) }}" alt="{{ $product->name }}">
                                    </div>
                                    <p class="font-bold color-black mt-4">{{ $product->name }}</p>
                                    <p class="small">{!! $product->description !!}</p>
                                </div>
                            </div>
                    @endforeach
                    </div>
                </div>
                @endif
            </div>
    </div>
</section>
@endsection
