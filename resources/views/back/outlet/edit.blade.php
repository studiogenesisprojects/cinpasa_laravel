@extends('back.common.main')
@section('content')
<div class="content-box">
    <div class="element-wrapper">
        <h6 class="element-header">Editar Banner outlet
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
                                <small><i>Desactivar un banner hará que no pueda mostrarse.</i></small>
                            </div>
                        </div>

                        <div class="row">
                            <div class="col-sm-4">
                                <div class="form-group">
                                    <label for="">Nombre</label>
                                    <input type="hidden" value="{{$banner->id}}">
                                    <input type="text" name="name" class="form-control" value="{{$banner->name}}" value="" data-error="Introduzca un nombre" required  class="@error('name') is-invalid @enderror">
                                    <div class="help-block form-text with-errors form-control-feedback"></div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <label for="">Orden</label>
                                <input class="form-control" type="number" name="order" required data-error="Introduzca un orden" value="{{ $banner->order }}" />
                                <div class="help-block form-text with-errors form-control-feedback"></div>
                            </div>
                            <div class="col-sm-4">
                                <label for="product_id">Producto a enlazar</label>
                                <select id="product_id" name="product_id" class="form-control select2" required data-error="Introduzca un producto a enlazar">
                                    <option value="">Selecciona un producto de la lista</option>
                                    @foreach($products as $product)
                                        <option value="{{$product->id}}" {{ ($banner->product_id == $product->id)?'selected':'' }}>{{$product->name}}</option>
                                    @endforeach
                                </select>
                                <div class="help-block form-text with-errors form-control-feedback"></div>
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
                                        <div class="col-md-12" style="max-width: 100%;">
                                            <label for="image-{{ $localeCode }}">
                                                Imagen
                                            </label>
                                            <input type="file" name="image-{{ $localeCode }}" class="form-control" for="image-{{ $localeCode }}" accept="image/*">
                                            @if(!empty($banner->getTranslation('image', $localeCode)))
                                            <img src="{{ Storage::url($banner->getTranslation('image', $localeCode)) }}" alt="{{$banner->name}}" />
                                            @endif
                                            <div class="help-block form-text with-errors form-control-feedback"></div>
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

@endsection
