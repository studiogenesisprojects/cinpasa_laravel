@extends('back.common.main')
@section('css')
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css" integrity="sha384-GJzZqFGwb1QTTN6wy59ffF1BuGJpLSa9DkKMp0DgiMDm4iYMj70gZWKYbI706tWS" crossorigin="anonymous">
@endsection

@section('content')
<div class="content-box">
    <div class="element-wrapper">
        <h6 class="element-header">Nuevo Banner outlet
            <a href="{{route('outlet.index')}}" class="btn btn-white float-right"><i
                class="os-icon os-icon-chevron-left"></i> Volver
            </a>
        </h6>
        @if($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{$error}}</li>
                    @endforeach
                </ul>
            </div>
        @endif
        <div class="row">
            <div class="col-sm-12">
                <div class="element-wrapper">
                    <div class="element-box">
                        <form id="formValidate" method="POST" accept-charset="utf-8" action="{{route('outlet.store')}}" enctype="multipart/form-data">
                        {{ csrf_field() }}
                        <div class="element-info">
                            <div class="element-info-with-icon">
                                <div class="element-info-icon">
                                    <div class="ti-layout-cta-right"></div>
                                </div>
                                <div class="element-info-text">
                                    <h5 class="element-inner-header">Información del Banner</h5>
                                </div>

                            </div>
                            <div class="float-right" style="margin-top: -30px; text-align: end;">
                                <label for="">Activar/Desactivar banner: <input type="checkbox" style="
                                    width: 13px;
                                    height: 13px;
                                    padding: 0;
                                    margin:0;
                                    vertical-align: bottom;
                                    position: relative;
                                    top: -3px;
                                    *
                                    overflow: hidden;
                                " name="active" ></label>
                                <br>
                                <small><i>Desactivar un banner hará que no pueda mostrarse.</i></small>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-sm-4">
                                <div class="form-group">
                                    <label for="">Nombre</label>
                                    <input type="text" name="name" class="form-control" value="" data-error="Introduzca un nombre" required>
                                    <div class="help-block form-text with-errors form-control-feedback"></div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <label for="">Orden</label>
                                <input class="form-control" type="number" name="order" required data-error="Introduzca un orden">
                            </div>
                        </div>
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="os-tabs-w">
                                    <div class="os-tabs-controls os-tabs-controls-cliente">
                                        <ul class="nav nav-tabs upper">
                                            @foreach(LaravelLocalization::getSupportedLocales() as $localeCode => $properties)
                                            <li class="nav-item"><a style="border: unset"  aria-expanded="false" class="nav-link @if($loop->first){{ 'active' }}@endif" data-toggle="tab" href="#tab_{{$localeCode}}">{{ strtoupper($localeCode) }}</a></li>
                                            @endforeach
                                        </ul>
                                    </div>
                                </div>
                                <div class="tab-content">
                                    @foreach(LaravelLocalization::getSupportedLocales() as $localeCode => $properties)
                                    <div class="tab-pane @if($loop->first){{ 'active' }}@endif" id="tab_{{$localeCode}}">
                                        <div class="col-md-6">
                                            <label for="url-{{ $localeCode }}">Enlace</label>
                                            <input class="form-control" type="url" name="url-{{ $localeCode }}" data-error="Introduzca un enlace correcto." placeholder="http://www.google.com" />
                                            <div class="help-block form-text with-errors form-control-feedback"></div>
                                        </div>
                                        <div class="col-md-6" style="max-width: 100%;">
                                            <label for="image-{{ $localeCode }}">
                                                Imagen
                                            </label>
                                            <input type="file" name="image-{{ $localeCode }}" class="form-control" for="image-{{ $localeCode }}" accept="image/*" required data-error="Selecciona una imagen para el banner">
                                        </div>
                                    </div>
                                    @endforeach
                                </div>
                            </div>
                        </div>
                        <div class="form-buttons-w">
                            <button class="btn btn-success" type="submit">Guardar</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection
@section('js')
<script src="{{ asset('back-admin/bowser_components/plugins/ckeditor_4.6.1_full/ckeditor/ckeditor.js') }}"></script>
<script>
    $('.select2').select2();
</script>
@endsection
