@extends('back.common.main')
@section('content')
<div class="content-box">
    <div class="element-wrapper">
        <h6 class="element-header">Editar Banner outlet
            <a href="{{route('outlet.index')}}" class="btn btn-white float-right"><i
                class="os-icon os-icon-chevron-left"></i> Volver
            </a>
        </h6>
        <div class="row">
            <div class="col-sm-12">
                <div class="element-wrapper">
                    <div class="element-box">
                        <form id="formValidate" method="POST" accept-charset="utf-8" action="{{route('outlet.update', $banner->id)}}" enctype="multipart/form-data">
                        {{ csrf_field() }}
                        {{ method_field('PUT') }}
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
                                <label for="">Activar banner: <input type="checkbox" style="
                                    width: 13px;
                                    height: 13px;
                                    padding: 0;
                                    margin:0;
                                    vertical-align: bottom;
                                    position: relative;
                                    top: -3px;
                                    *
                                    overflow: hidden;
                                " name="active" {{$banner->active == 1 ? 'checked' : ''}}></label>
                                <br>
                                <small><i>Los banners se eligen de forma aleatoria. Desactivar un banner hará que no pueda mostrarse.</i></small>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="">Nombre</label>
                                    <input type="hidden" value="{{$banner->id}}">
                                    <input type="text" name="name" class="form-control" value="{{$banner->name}}" value="" data-error="Introduzca un nombre" required>
                                    <div class="help-block form-text with-errors form-control-feedback"></div>
                                </div>
                            </div>
                            <div class="col-md-6" style="max-width: 100%;">
                                <label for="image">
                                    Imagen
                                </label>
                                <input type="file" name="image" class="form-control" for="image">
                                <img src="{{ Storage::url($banner->image) }}" alt="{{$banner->name}}">
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

@endsection
