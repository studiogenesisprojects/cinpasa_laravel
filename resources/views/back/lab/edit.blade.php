@extends('back.common.main')
@section('content')

<div class="content-box">
    <div class="element-wrapper">
        <h6 class="element-header">Editar Categoría de LAB
            <a href="{{route('lab')}}" class="btn btn-white float-right"><i
                class="os-icon os-icon-chevron-left"></i> Volver
            </a>
        </h6>
        <div class="row">
            <div class="col-sm-12">
                <div class="element-wrapper">
                    <div class="element-box">
                        <form id="formValidate" method="POST" accept-charset="utf-8" action="{{route('lab.update', $lab->id)}}" enctype="multipart/form-data">
                        {{ csrf_field() }}
                        <div class="element-info">
                            <div class="element-info-with-icon">
                                <div class="element-info-icon">
                                    <div class="ti-layout-cta-right"></div>
                                </div>
                                <div class="element-info-text">
                                    <h5 class="element-inner-header">Información de LAB</h5>
                                </div>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <input type="hidden" name="id" value="{{$lab->id}}">
                                    <label for="">Nombre</label>
                                    <input type="text" name="name" class="form-control" value="{{$lab->name}}" data-error="Introduzca un nombre" required>
                                    <div class="help-block form-text with-errors form-control-feedback"></div>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="">Descripción</label>
                                    <input type="text" name="description" class="form-control" value="{{$lab->description}}" data-error="Introduzca un nombre" required>
                                    <div class="help-block form-text with-errors form-control-feedback"></div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <label for="">Orden</label>
                                <input class="form-control" value="{{$lab->order}}" type="number" name="order">
                            </div>
                            <div class="col-md-6" style="max-width: 100%;">
                                <label for="primary_image">
                                    Imagen
                                </label>
                                <input type="file" name="primary_image" class="form-control" for="primary_image">
                            </div>
                            <div class="col-md-6">
                                <label for="">Activo: <input type="checkbox" name="active" {{$lab->active ? 'checked' : ''}}></label>
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
