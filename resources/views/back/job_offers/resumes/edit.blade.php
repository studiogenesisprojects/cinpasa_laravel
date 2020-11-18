@extends('back.common.main')

@section('content')

<div class="content-box">
    <div class="element-wrapper" id="app">
        <h6 class="element-header">Editar CV
            <a href="{{route('cvs.index')}}" class="btn btn-white float-right"><i
                class="os-icon os-icon-chevron-left"></i> Volver</a>
            </h6>
            @if($errors->any())
            {{dd($errors)}}
            <div class="alert alert-danger">
                <p>No se ha podido Editar el CV</p>
            </div>
            @endif
            <div class="row">
                <div class="col-sm-12">
                    <div class="element-wrapper">
                        <div class="element-box">
                            <form id="formValidate" novalidate="true" method="post" action="{{route('cvs.update', $resume->id)}}">
                            {{ csrf_field() }}
                            @method('PUT')
                            <div class="element-info">
                                <div class="element-info-with-icon">
                                    <div class="element-info-icon">
                                        <div class="ti-layout-cta-right"></div>
                                    </div>
                                    <div class="element-info-text">
                                        <h5 class="element-inner-header">Información de la oferta </h5>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <label for="">Nombre</label>
                                        <input type="text" name="name" class="form-control" data-error="Introduzca un título" value="{{$resume->name}}" required>
                                        <div class="help-block form-text with-errors form-control-feedback"></div>
                                    </div>
                                </div>
                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <label for="">Fecha de recepción</label>
                                        <input type="date" name="created_at" class="form-control" data-error="Introduzca un título" value="{{\Carbon\Carbon::parse($resume->created_at)->format('Y-m-d')}}" required>
                                        <div class="help-block form-text with-errors form-control-feedback"></div>
                                    </div>
                                </div>
                            </div>

                        </div>
                        <div class="form-buttons-w">
                            <button class="btn btn-success" type="submit">Actualizar</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
