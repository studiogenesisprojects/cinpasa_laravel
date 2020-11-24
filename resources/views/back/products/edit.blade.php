@extends('back.common.main')
@section('css')
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css" integrity="sha384-GJzZqFGwb1QTTN6wy59ffF1BuGJpLSa9DkKMp0DgiMDm4iYMj70gZWKYbI706tWS" crossorigin="anonymous">
@endsection
@section('content')

<div class="content-box">
    <div class="element-wrapper" id="app">
        <h6 class="element-header">Editar Producto
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
                            <form id="formValidate" novalidate="true" method="post" action="{{route('productos.update', $product->id)}}" enctype="multipart/form-data" >
                            {{ csrf_field() }}
                            @method('PATCH')
                            <div class="element-info">
                                <div class="element-info-with-icon">
                                    <div class="element-info-icon">
                                        <div class="ti-layout-cta-right"></div>
                                    </div>
                                    <div class="element-info-text">
                                        <h5 class="element-inner-header">Editar {{ $product->lang()->name ?? "" }}</h5>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="os-tabs-w">
                                        <div class="os-tabs-controls os-tabs-controls-cliente">
                                            <ul class="nav nav-tabs upper">
                                                @foreach($languages as $key => $language)
                                                <li class="nav-item">
                                                    <a style="border: unset" aria-expanded="false" class="nav-link @if($key == 0){{'active'}}@endif" data-toggle="tab" href="#tab_{{$language->code}}">{{ strtoupper($language->code) }}</a></li>
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
                                                        <input @if($product->lang($idioma->id)->active) checked @endif type="checkbox" name="productLanguages[{{ $idioma->id }}][active]" class="custom-control-input" id="customSwitch{{ $idioma->id }}">
                                                        <label  class="custom-control-label" for="customSwitch{{ $idioma->id }}"> Publicar producto en <strong>{{$idioma->name}}</strong></label>
                                                    </div>
                                                </div>
                                                <div class="col-sm-6">
                                                    <div class="form-group">
                                                        <label for="">Nombre</label>
                                                    <input type="text" class="form-control title" value="{{$product->lang($idioma->id)->name ?? ""}}"
                                                         name="productLanguages[{{ $idioma->id }}][name]">
                                                    </div>
                                                </div>
                                                <div class="col-sm-6">
                                                    <label for="">Slug</label>
                                                    <div class="input-group">
                                                        <input type="text" class="form-control slug" value="{{$product->lang($idioma->id)->slug ?? ""}}"
                                                        name="productLanguages[{{ $idioma->id }}][slug]">
                                                        <div class="input-group-append">
                                                            <a href="{{LaravelLocalization::getURLFromRouteNameTranslated($idioma->code, 'routes.products.showProduct', [
                                                                "productCategory" => $product->categories[0],
                                                                "product" => $product
                                                                ])}}" target="_blank" id="preview" class="input-group-text"><i class="ti-eye"></i></a>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row pb-3">
                                                <div class="col-md-12">
                                                    <label>Descripción corta</label>
                                                    <textarea class="form-control short_text" name="productLanguages[{{ $idioma->id }}][lite_description]" cols="30" rows="2">
                                                        {{$product->lang($idioma->id)->lite_description ?? ""}}</textarea>
                                                </div>
                                            </div>
                                            <div class="row mb-3">
                                                <div class="col-md-12">
                                                    <label>Descripción</label>
                                                    <textarea class="item form-control" name="productLanguages[{{ $idioma->id }}][description]" cols="30" rows="6">
                                                        {{$product->lang($idioma->id)->description ?? ""}}</textarea>
                                                </div>
                                                <div class="col-md-12 pt-3">
                                                    @if ($product->primaryImage )
                                                        <div class="form-group">
                                                            <label for="">Etiqueta ALT de la imagen principal</label>
                                                            <input type="text" class="form-control" value="@if($product->primaryImage->lang($idioma->id)){{$product->primaryImage->lang($idioma->id)->alt}}@endif"
                                                            name="productLanguages[{{ $idioma->id }}][alt]">
                                                        </div>
                                                    @endif
                                                </div>
                                            </div>
                                            <div class="py-3"></div>
                                            <h5 class="my-3">Meta etiquetas SEO</h5>
                                            <div class="row mb-3">
                                                <div class="col-md-12">
                                                    <label>Título de SEO</label>
                                                    <input class="item form-control" name="productLanguages[{{ $idioma->id }}][seo_title]" cols="30" rows="6" value="{{$product->lang($idioma->id)->seo_title ?? ''}}" />
                                                </div>
                                            </div>
                                            <div class="row mb-3">
                                                <div class="col-md-12">
                                                    <label>Descripción de SEO</label>
                                                    <textarea class="item form-control" name="productLanguages[{{ $idioma->id }}][seo_description]" cols="30" rows="6">{{$product->lang($idioma->id)->seo_description ?? ""}}</textarea>
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
                                <div class="col-md-6 mb-3">
                                    <label for="">Activo: <input type="checkbox" name="active" {{ !$product->active ? "": "checked" }}></label>
                                </div>

                                <div class="col-md-6">
                                    <label for="">Orden</label>
                                    <input class="form-control" type="number" name="order" value="{{$product->order}}">
                                </div>
                            </div>
                            <div class="row pb-3">
                                <div class="col-md-6">
                                    <label>Etiquetas</label>
                                    <select class="select2" name="labels[]" multiple="true" >
                                        @foreach ($tags as $tag)
                                            <option value="{{$tag->id}}"
                                                {{ !$product->labels->contains($tag) ? "" : "selected" }}
                                                >{{$tag->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-6">
                                    <label>Eco Logos</label>
                                    <select class="select2" name="ecos[]" multiple="true" >
                                        @foreach ($ecos as $eco)
                                            <option value="{{$eco->id}}"
                                                {{ !$product->ecoLogos->contains($eco) ? "" : "selected" }}
                                                >{{$eco->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-6">
                                    <label>Codigo liasa</label>
                                    <input name="liasa_code" class="form-control"
                                    value="{{$product->liasa_code}}" />
                                </div>
                            </div>

                            <h5 class="pt-3">Múltimedia</h5>

                            <div class="row pb-3">
                                <div class="col-sm-6">
                                    <label for="primary_image">
                                        Imagen Principal
                                    </label>
                                    <input type="file" name="primary_image" class="form-control">
                                    <div class="py-2">
                                        @if ($product->primaryImage)
                                        <img class="w-50" src="{{Storage::url($product->primaryImage->path)}}" alt="">
                                        @endif
                                    </div>
                                </div>

                                <div class="col-sm-6">
                                    <label for="list_image">
                                        Imagen de listado
                                    </label>
                                    <input type="file" name="list_image" class="form-control" for="list_image">
                                    @if ($product->list_image)
                                        <img src="{{Storage::url($product->list_image)}}" alt="">
                                        @endif
                                </div>
                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <label>Video</label>
                                        <input class="form-control" type="text" name="video" value="{{$product->video}}">
                                    </div>
                                </div>
                                <div class="col-sm-12">
                                    <product-galery
                                    :product="{{$product->id}}"
                                    :galery="{{$product->galeries()->with(['images', 'images.languages'])->first() ?? 'null'}}" :languages="{{$languages}}"
                                    ></product-galery>
                                </div>

                            </div>
                            <h5 class="py-3">Características</h5>
                            <div class="row pb-3">
                                {{-- <div class="col-md-6 pb-3">
                                    <label>Forma</label>
                                    <select class="form-control select2" name="form_id" >
                                        @foreach ($shapes as $shape)
                                            <option value="{{$shape->id}}"
                                                {{ $shape->id == $product->form_id ? "selected" : '' }}
                                                >{{$shape->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-6 pb-3">
                                    <label>Trenzado</label>
                                    <select class="form-control select2" name="brided_id" >
                                        @foreach ($braids as $braid)
                                            <option value="{{$braid->id}}"
                                                {{ $braid->id == $product->brided_id ? "selected" : '' }}
                                                >{{$braid->name}}</option>
                                        @endforeach
                                    </select>
                                </div> --}}
                                <div class="col-md-6 pb-3">
                                    <label>Materiales</label>
                                    <select class="form-control select2" name="materials[]" multiple="true">
                                        @foreach ($materials as $material)
                                            <option value="{{$material->id}}"
                                                @if ($product->materials)
                                                {{ $product->materials->contains($material) ? "selected" : "" }}
                                                @endif
                                                >{{$material->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-6 pb-3">
                                    <label>Rapport</label>
                                    <input type="text" class="form-control " value="{{ $caracteristics->rapport }}" name="rapport">
                                </div>
                                <div class="col-md-6 pb-3">
                                    <label>Ancho</label>
                                    <input type="number" class="form-control " value="{{ $caracteristics->width }}" name="width">
                                </div>
                                <div class="col-md-6 pb-3">
                                    <label>Nº Bolsillos</label>
                                    <input type="number" class="form-control " value="{{ $caracteristics->pockets }}" name="pockets">
                                </div>
                                <div class="col-md-6 pb-3">
                                    <label>Nº Cordones</label>
                                    <input type="number" class="form-control " value="{{ $caracteristics->laces }}" name="laces">
                                </div>
                                <div class="col-md-6 pb-3">
                                    <label>Envases</label>
                                    <input type="text" class="form-control " value="{{ $caracteristics->packaging }}" name="packaging">
                                </div>
                                <div class="col-md-6 pb-3">
                                    <label>Bolsas</label>
                                    <input type="text" class="form-control " value="{{ $caracteristics->bags }}" name="bags">
                                </div>
                                <div class="col-md-6 pb-3">
                                    <label>Largo</label>
                                    <input type="text" class="form-control " value="{{ $caracteristics->length }}" name="length">
                                </div>
                                <div class="col-md-6 pb-3">
                                    <label>Cabezal FleCortin</label>
                                    <input type="text" class="form-control " value="{{ $caracteristics->flecortin_head }}" name="flecortin_head">
                                </div>
                                <div class="col-md-6 pb-3">
                                    <label>Ancho FleCortin</label>
                                    <input type="text" class="form-control " value="{{ $caracteristics->flecortin_width }}" name="flecortin_width">
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
                                    <label for="">Referencias</label>
                                    <select name="references[]" class="form-control select2" multiple >
                                        @foreach ($references as $reference)
                                            <option value="{{$reference->id}}"
                                                @if ($product->references)
                                                {{ $product->references->contains($reference) ? "selected" : "" }}
                                                @endif
                                                >{{$reference->referencia}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-6">
                                    <label>Categorías</label>
                                    <applications :name="'categories[]'" :items="{{$categories}}" :sitems="{{$product->categories->sortBy('pivot.order')}}" ></applications>
                                </div>
                                <div class="col-md-6">
                                    <strong>Muestrarios</strong>
                                    <applications :name="'colors[]'" :items="{{$colors}}" :sitems="{{$product->categoryColors->sortBy('pivot.order')}}" ></applications>
                                </div>
                            </div>

                            <div class="row">
                                <div class="col-md-6">
                                    <strong>Acabados</strong>
                                    <applications :name="'finisheds[]'" :items="{{$finishes}}" :sitems="{{$product->finisheds}}" ></applications>
                                </div>
                                <div class="col-md-6">
                                    <strong>Aplicaciones</strong>
                                    <applications :name="'applications[]'" :items="{{$applications}}" :sitems="{{$product->applications->sortBy('pivot.order')}}" ></applications>
                                </div>
                                {{-- <div class="col-md-6">
                                    <strong>Relacionados</strong>
                                    <applications :name="'relateds[]'" :items="{{$relateds}}" :sitems="{{$product->relateds->sortBy('pivot.order')}}" ></applications>
                                </div> --}}
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
