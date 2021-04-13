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
                                    <label for="">Slug</label>
                                    <input type="text" name="slug" class="form-control" value="{{$lab->slug}}" data-error="Introduzca un nombre" required>
                                    <div class="help-block form-text with-errors form-control-feedback"></div>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <label for="">Orden</label>
                                <input class="form-control" value="{{$lab->order}}" type="number" name="order">
                            </div>
                            <div class="col-md-6" style="max-width: 100%;">
                                <label for="primary_image">
                                    Imagen de la Home
                                </label>
                                <input type="file" name="primary_image" class="form-control" for="primary_image">
                            </div>
                            <div class="col-md-6" style="max-width: 100%;">
                                <label for="secondary_image">
                                    Imagen del Lab
                                </label>
                                <input type="file" name="secondary_image" class="form-control" for="secondary_image">
                            </div>
                            <div class="col-md-6 mt-4">
                                <label for="">Activo: <input type="checkbox" name="active" {{$lab->active ? 'checked' : ''}}></label>
                            </div>
                        </div>

                        <div class="col-sm-12">
                            <div class="os-tabs-w">
                                <div class="os-tabs-controls os-tabs-controls-cliente">
                                    <ul class="nav nav-tabs upper">
                                        @foreach($languages as $key => $language)
                                        <li class="nav-item"><a style="border: unset"  aria-expanded="false" class="nav-link @if($key == 0){{'active'}}@endif" data-toggle="tab" href="#tab_{{$language->code}}">{{ strtoupper($language->code) }}</a></li>
                                        @endforeach
                                    </ul>
                                </div>
                            </div>
                            <div class="tab-content">
                                @foreach($languages as $key => $idioma)
                                <div class="tab-pane @if($loop->first){{ 'active' }}@endif" id="tab_{{$idioma->code}}">
                                    <input type="hidden" name="languages[{{ $idioma->id }}][language_id]" value="{{$idioma->id}}">
                                    <div class="row">
                                        <div class="row mb-3">
                                            <div class="col-md-12">
                                                <label>Título de SEO</label>
                                                <textarea class="item form-control" name="languages[{{ $idioma->id }}][seo_title]" value="{{ isset($array_lang[$idioma->id]) ? $array_lang[$idioma->id]['seo_title'] : ''}}" cols="30" rows="6">{{isset($array_lang[$idioma->id]) ?$array_lang[$idioma->id]['seo_title'] : ''}}</textarea>
                                            </div>
                                        </div>
                                        <div class="row ml-2 mb-3">
                                            <div class="col-md-12">
                                                <label>Descripción de SEO</label>
                                                <textarea class="item form-control" name="languages[{{ $idioma->id }}][seo_description]" cols="30" rows="6">{{ isset($array_lang[$idioma->id]) ? $array_lang[$idioma->id]['seo_description'] : ''}}</textarea>
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label for="">Claim</label>
                                                <input type="text" name="languages[{{ $idioma->id }}][claim]" class="form-control" value="{{isset($array_lang[$idioma->id]) ? $array_lang[$idioma->id]['claim'] : ''}}" data-error="Introduzca un nombre" required>
                                                <div class="help-block form-text with-errors form-control-feedback"></div>
                                            </div>
                                        </div>


                                    </div>
                                </div>
                                @endforeach
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
