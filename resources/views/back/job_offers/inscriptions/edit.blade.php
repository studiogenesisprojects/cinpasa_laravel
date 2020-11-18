@extends('back.common.main')

@section('content')

<div class="content-box">
    <div class="element-wrapper" id="app">
        <h6 class="element-header">Editar inscrito
            <a href="{{route('inscritos.index')}}" class="btn btn-white float-right"><i
                class="os-icon os-icon-chevron-left"></i> Volver</a>
            </h6>
            @if($errors->any())
            {{dd($errors)}}
            <div class="alert alert-danger">
                <p>Error al editar</p>
            </div>
            @endif
            <div class="row">
                <div class="col-sm-12">
                    <div class="element-wrapper">
                        <div class="element-box">
                            <form id="formValidate" novalidate="true" method="post" action="{{route('inscritos.update', $inscription->id)}}">
                            {{ csrf_field() }}
                            @method('PUT')
                            <div class="element-info">
                                <div class="element-info-with-icon">
                                    <div class="element-info-icon">
                                        <div class="ti-layout-cta-right"></div>
                                    </div>
                                    <div class="element-info-text">
                                        <h5 class="element-inner-header">Información del inscrito</h5>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label for="">Nombre</label>
                                        <input type="text" name="name" class="form-control" data-error="Introduzca un título" value="{{$inscription->name}}" required>
                                        <div class="help-block form-text with-errors form-control-feedback"></div>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label for="">Email</label>
                                        <input type="text" name="email" class="form-control" data-error="Introduzca un título" value="{{$inscription->email}}" required>
                                        <div class="help-block form-text with-errors form-control-feedback"></div>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label for="">Teléfono</label>
                                        <input type="text" name="phone_number" class="form-control" data-error="Introduzca un título" value="{{$inscription->phone_number}}" required>
                                        <div class="help-block form-text with-errors form-control-feedback"></div>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label for="">Inscrito a la oferta</label>
                                        <input type="text" name="phone_number" class="form-control" data-error="Introduzca un título" value="{{$inscription->job_offer->name}}" required disabled>
                                        <div class="help-block form-text with-errors form-control-feedback"></div>
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <label for="">Fecha de inscripción</label>
                                        <input type="date" name="created_at" class="form-control" data-error="Introduzca un título" value="{{\Carbon\Carbon::parse($inscription->created_at)->format('Y-m-d')}}" required>
                                        <div class="help-block form-text with-errors form-control-feedback"></div>
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <label for="">Navegador</label>
                                        <input type="text" name="phone_number" class="form-control" data-error="Introduzca un título" value="{{$inscription->browser}}" required disabled>
                                        <div class="help-block form-text with-errors form-control-feedback"></div>
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <label for="">IP</label>
                                        <input type="text" name="phone_number" class="form-control" value="{{$inscription->ip}}"  disabled>
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
