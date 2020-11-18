@extends('back.common.main')
@section('content')

<div class="content-i">
    <div class="content-box">
        <div class="element-wrapper">
            <h6 class="element-header">Detalles petición
                <a href="{{route('peticiones.index')}}" class="btn btn-white float-right"><i
            class="os-icon os-icon-chevron-left"></i> Volver</a>
            </h6>
            <div class="element-box">

                <h5 class="form-header">Petición {{$petition->fullname}}</h5>
                <hr>
                <div class="row pb-3">
                    <div class="col-md-3">
                        <strong>Estado: </strong>
                    </div>
                    <div class="col-md-6">
                        <span>{{$petition->formattedState()}}</span>
                    </div>
                </div>
                <div class="row pb-3">
                    <div class="col-md-3">
                        <strong>Origen: </strong>
                    </div>
                    <div class="col-md-6">
                        <span>{{$petition->origen}} </span>
                    </div>
                </div>
                <div class="row pb-3">
                    <div class="col-md-3">
                        <strong>Fecha de envio: </strong>
                    </div>
                    <div class="col-md-6">
                        <span>{{$petition->created_at}}</span>
                    </div>
                </div>
                <div class="row pb-3">
                    <div class="col-md-3">
                        <strong>Nombre: </strong>
                    </div>
                    <div class="col-md-6">
                        <span>{{$petition->fullname}}</span>
                    </div>
                </div>
                <div class="row pb-3">
                    <div class="col-md-3">
                        <strong>Empresa: </strong>
                    </div>
                    <div class="col-md-6">
                        <span>{{$petition->company}}</span>
                    </div>
                </div>
                <div class="row pb-3">
                    <div class="col-md-3">
                        <strong>Email: </strong>
                    </div>
                    <div class="col-md-6">
                        <span>{{$petition->email}}</span>
                    </div>
                </div>
                <div class="row pb-3">
                    <div class="col-md-3">
                        <strong>Teléfono: </strong>
                    </div>
                    <div class="col-md-6">
                        <span>{{$petition->phone_number}}</span>
                    </div>
                </div>
                <div class="row pb-3">
                    <div class="col-md-3">
                        <strong>País: </strong>
                    </div>
                    <div class="col-md-6">
                        <span>{{$petition->country}}</span>
                    </div>
                </div>
                <div class="row pb-3">
                    <div class="col-md-3">
                        <strong>Comentario: </strong>
                    </div>
                    <div class="col-md-6">
                        <span>{{$petition->comment}}</span>
                    </div>
                </div>
                <div class="row pb-3">
                    <div class="col-md-3">
                        <strong>Productos: </strong>
                    </div>
                    <div class="col-md-6">
                        @foreach ($petition->products as $product)
                            <div> <a href="{{route('productos.edit', $product->id)}}"> {{$product->liasa_code}} : {{$product->name}}</a> </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

