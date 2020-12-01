@extends('back.common.main')
@section('css')
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css" integrity="sha384-GJzZqFGwb1QTTN6wy59ffF1BuGJpLSa9DkKMp0DgiMDm4iYMj70gZWKYbI706tWS" crossorigin="anonymous">
@endsection
@section('content')

<div class="content-box">
    <div class="element-wrapper" id="app">
        <h6 class="element-header">Crear Producto
            <a href="{{route('productos.index')}}" class="btn btn-white float-right"><i
                class="os-icon os-icon-chevron-left"></i> Volver</a>
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
            <div class="row" id="products">
                <div class="col-sm-12">
                    <div class="element-wrapper">
                        <div class="element-box">
                            <form id="formValidate" novalidate="true" method="post" action="{{route('productos.store')}}" enctype="multipart/form-data" >
                            {{ csrf_field() }}
                            <div class="element-info">
                                <div class="element-info-with-icon">
                                    <div class="element-info-icon">
                                        <div class="ti-layout-cta-right"></div>
                                    </div>
                                    <div class="element-info-text">
                                        <h5 class="element-inner-header">Crear nuevo producto</h5>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
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
                                            <input type="hidden" name="productLanguages[{{ $idioma->id }}][language_id]" value="{{$idioma->id}}">
                                            <div class="row">
                                                <div class="col-md-12 pb-3">
                                                    <div class="custom-control custom-switch">
                                                        <input checked type="checkbox" name="productLanguages[{{ $idioma->id }}][active]" class="custom-control-input" id="customSwitch{{ $idioma->id }}">
                                                        <label class="custom-control-label" for="customSwitch{{ $idioma->id }}"> Publicar producto en <strong>{{$idioma->name}}</strong></label>
                                                    </div>
                                                </div>
                                                <div class="col-sm-6">
                                                    <div class="form-group">
                                                        <label for="">Nombre</label>
                                                        <input id="name-{{ $key }}" type="text" class="form-control title" name="productLanguages[{{ $idioma->id }}][name]" required>
                                                    </div>
                                                </div>
                                                <div class="col-sm-6">
                                                    <div class="form-group">
                                                        <label for="">Slug</label>
                                                        <input id="id-{{ $key }}" type="text" class="form-control slug" name="productLanguages[{{ $idioma->id }}][slug]" required>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row pb-3">
                                                <div class="col-md-12">
                                                    <label>Descripción corta</label>
                                                    <textarea class="form-control short_text" name="productLanguages[{{ $idioma->id }}][lite_description]" cols="30" rows="2"></textarea>
                                                </div>
                                            </div>
                                            <div class="row mb-3">
                                                <div class="col-md-12">
                                                    <label>Descripción</label>
                                                    <textarea class="item form-control" name="productLanguages[{{ $idioma->id }}][description]" cols="30" rows="6"></textarea>
                                                </div>
                                            </div>
                                            <h5 class="my-3">Meta etiquetas SEO</h5>
                                            <div class="row mb-3">
                                                <div class="col-md-12">
                                                    <label>Título de SEO</label>
                                                    <input class="item form-control" name="productLanguages[{{ $idioma->id }}][seo_title]" cols="30" rows="6"  />
                                                </div>
                                            </div>
                                            <div class="row mb-3">
                                                <div class="col-md-12">
                                                    <label>Descripción de SEO</label>
                                                    <textarea class="item form-control" name="productLanguages[{{ $idioma->id }}][seo_description]" cols="30" rows="6"></textarea>
                                                </div>
                                            </div>
                                        </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                            <div class="row py-4 border-top">
                                <div class="col-sm-12">
                                    <h5 class="mb-4">Información del producto </h5>
                                </div>
                                <div class="col-md-6">
                                    <label for="">Activo: <input type="checkbox" name="active" checked></label>
                                </div>
                                <div class="col-md-6">
                                    <label for="">Outlet: <input type="checkbox" name="outlet" checked></label>
                                </div>
                                <div class="col-md-6">
                                    <label for="">Orden</label>
                                    <input class="form-control" type="number" name="order">
                                </div>
                            </div>
                            <div class="row pb-3">
                                <div class="col-md-6">
                                    <label>Etiquetas</label>
                                    <select class="select2" name="labels[]" multiple="true" >
                                        @foreach ($tags as $tag)
                                            <option value="{{$tag->id}}">{{$tag->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-6">
                                    <label>Eco Logos</label>
                                    <select class="select2" name="ecos[]" multiple="true" >
                                        @foreach ($ecos as $eco)
                                            <option value="{{$eco->id}}">{{$eco->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-6">
                                    <label>Codigo Cinpasa</label>
                                    <input name="liasa_code" class="form-control" />
                                </div>
                            </div>

                            <h5 class="pt-3">Múltimedia</h5>

                            <div class="row pb-3">
                                <div class="col-sm-6">
                                    <label for="primary_image">
                                        Imagen Principal
                                    </label>
                                    <input type="file" name="primary_image" class="form-control" for="primary_image">
                                </div>

                                <div class="col-sm-6">
                                    <label for="list_image">
                                        Imagen de listado
                                    </label>
                                    <input type="file" name="list_image" class="form-control" for="list_image">
                                </div>
                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <label>Video</label>
                                        <input class="form-control" type="text" name="video">
                                    </div>
                                </div>
                                <div class="col-sm-12">
                                    <product-galery
                                     :languages="{{$languages}}"
                                    ></product-galery>
                                </div>

                            </div>
                            <h5 class="py-3">Características</h5>
                            <div class="row pb-3">
                                {{-- <div class="col-md-6 pb-3">
                                    <label>Forma</label>
                                    <select class="form-control select2" name="form_id" >
                                        @foreach ($shapes as $shape)
                                            <option value="{{$shape->id}}">{{$shape->name}}</option>
                                        @endforeach
                                    </select>
                                </div> --}}
                                {{-- <div class="col-md-6 pb-3">
                                    <label>Trenzado</label>
                                    <select class="form-control select2" name="brided_id" >
                                        @foreach ($braids as $braid)
                                            <option value="{{$braid->id}}">{{$braid->name}}</option>
                                        @endforeach
                                    </select>
                                </div> --}}
                                <div class="col-md-6 pb-3">
                                    <label>Materiales</label>
                                    <select class="form-control select2" name="materials[]" multiple="true">
                                        @foreach ($materials as $material)
                                            <option value="{{$material->id}}">{{$material->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-6 pb-3">
                                    <label>Rapport</label>
                                    <input type="text" class="form-control " name="rapport">
                                </div>
                                <div class="col-md-6 pb-3">
                                    <label>Ancho</label>
                                    <input type="number" class="form-control " name="width">
                                </div>
                                <div class="col-md-6 pb-3">
                                    <label>Nº Bolsillos</label>
                                    <input type="number" class="form-control " name="pockets">
                                </div>
                                <div class="col-md-6 pb-3">
                                    <label>Nº Cordones</label>
                                    <input type="number" class="form-control " name="laces">
                                </div>
                                <div class="col-md-6 pb-3">
                                    <label>Envases</label>
                                    <input type="text" class="form-control " name="packaging">
                                </div>
                                <div class="col-md-6 pb-3">
                                    <label>Bolsas</label>
                                    <input type="text" class="form-control " name="bags">
                                </div>
                                <div class="col-md-6 pb-3">
                                    <label>Largo</label>
                                    <input type="text" class="form-control " name="length">
                                </div>
                                <div class="col-md-6 pb-3">
                                    <label>Cabezal FleCortin</label>
                                    <input type="text" class="form-control " name="flecortin_head">
                                </div>
                                <div class="col-md-6 pb-3">
                                    <label>Ancho FleCortin</label>
                                    <input type="text" class="form-control " name="flecortin_width">
                                </div>
                                <div class="col-md-6 pb-3">
                                    <label>Presentación</label>
                                    <select name="presentation" class="form-control">
                                        <option value="">Elige una presentación</option>
                                        <option value="0">Por unidades</option>
                                        <option value="1">Por lotes</option>
                                    </select>
                                </div>
                                <div class="col-md-6 pb-3">
                                    <label>LAB</label>
                                    <select name="lab_id" class="form-control">
                                        <option value="">Elige un LAB</option>
                                        @foreach($labs as $lab)
                                            <option value="{{$lab->id}}">{{$lab->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-6 pb-3">
                                    <label for="">Referencias</label>
                                    <select name="references[]" class="form-control select2" multiple>
                                        @foreach ($references as $reference)
                                            <option value="{{$reference->id}}">{{$reference->referencia}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-6">
                                    <label>Acabados</label>
                                    <applications :name="'finisheds[]'" :items="{{$finishes}}" ></applications>
                                </div>
                                <div class="col-md-6">
                                    <label>Aplicaciones</label>
                                    <applications :name="'applications[]'" :items="{{$applications}}" ></applications>
                                </div>
                                <div class="col-md-6">
                                    <strong>Muestrarios</strong>
                                    <applications :name="'colors[]'" :items="{{$colors}}" ></applications>
                                </div>
                                <div class="col-md-6">
                                    <label>Categorías</label>
                                    <applications :name="'categories[]'" :items="{{$categories}}"  ></applications>
                                </div>
                                {{-- <div class="col-md-12">
                                    <label>Categorías</label>
                                    <applications :name="'categories[]'" :items="{{$categories}}"  ></applications>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <strong>Muestrarios</strong>
                                    <applications :name="'colors[]'" :items="{{$colors}}" ></applications>
                                </div>
                                --}}
                                <div class="row">



                            </div>


                            <div class="pt-4">
                                <button class="btn btn-primary" type="submit">Guardar</button>
                            </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('js')
    <script>
        $(document).ready( () => {
            CKEDITOR.replaceAll('item');
            $('.select2').select2();
        })
    </script>
@endsection
