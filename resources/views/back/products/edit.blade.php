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
                                                            @if(isset($product->categories[0]))
                                                            <a href="{{LaravelLocalization::getURLFromRouteNameTranslated($idioma->code, 'routes.products.showProduct', [
                                                                "productCategory" => $product->categories[0],
                                                                "product" => $product
                                                                ])}}" target="_blank" id="preview" class="input-group-text"><i class="ti-eye"></i></a>
                                                            @endif
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
                                    <label for="" id="outlet" >Outlet: <input type="checkbox" name="outlet" {{ !$product->outlet ? "": "checked" }}></label>
                                </div>
                                <div class="col-md-6">
                                    <label for="">Orden</label>
                                    <input class="form-control" type="number" name="order" value="{{$product->order}}">
                                </div>
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
                                    <label>Codigo Cinpasa</label>
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
                                        <small>*El formato de vídeo tiene que ser este: si el link que queremos introducir es este: https://youtu.be/T0OwfFHzNnA, se tendría que introducir la última parte, quedando así: T0OwfFHzNnA</small>
                                        <br>
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
                                <div class="table-responsive">
                                    <table id="caracteritics_table" width="100%" height="150px" class="table table-striped table-lightfont table-hover">
                                        <thead>
                                            <tr>
                                                <th>Referencia</th>
                                                <th>Ancho</th>
                                                <th>Bolsas</th>
                                                <th>Cordones</th>
                                                <th>Rapport</th>
                                                <th>Diámetro</th>
                                                <th>Largo</th>
                                                <th>Ancho/Diámetro</th>
                                                <th>Observaciones</th>
                                                <th>Orden</th>
                                                <th>Descuento</th>
                                                <th class="td-acciones">Acciones</th>
                                            </tr>
                                        </thead>
                                        <tbody id="caracteristics_body">
                                            @foreach($caracteristics as $key => $caracteristic)
                                            <div id="bloc_1">
                                                <tr id="row_{{$key}}">
                                                <td>
                                                    <input type="text" class="form-control" value="{{$caracteristic->references}}" name="references2[]">
                                                </td>
                                                <td>
                                                    <input type="number" class="form-control " value="{{$caracteristic->width}}" name="width[]">
                                                </td>
                                                <td>
                                                    <input type="number" class="form-control " value="{{$caracteristic->bags}}" name="bags[]">
                                                </td>
                                                <td>
                                                    <input type="number" class="form-control " value="{{$caracteristic->laces}}" name="laces[]">
                                                </td>
                                                <td>
                                                    <input type="text" class="form-control " value="{{$caracteristic->rapport}}" name="rapport[]">
                                                </td>
                                                <td>
                                                    <input type="text" class="form-control " value="{{$caracteristic->diameter}}" name="diameter[]">
                                                </td>
                                                <td>
                                                    <input type="text" class="form-control " value="{{$caracteristic->length}}" name="length[]">
                                                </td>
                                                <td>
                                                    <input type="text" class="form-control " value="{{$caracteristic->width_diameter}}" name="width_diameter[]">
                                                </td>
                                                <td>
                                                    <input type="text" class="form-control " value="{{$caracteristic->observations}}" name="observations[]">
                                                </td>
                                                <td>
                                                    <input type="number" class="form-control " value="{{$caracteristic->order}}" name="order_car[]">
                                                </td>
                                                <td>
                                                    <input type="number" class="form-control discount" value="{{$caracteristic->discount}}" name="discount[]">
                                                </td>
                                                <td class="acciones">
                                                    <div class="btn-group">
                                                        <button aria-expanded="false" aria-haspopup="true" class="btn btn-default dropdown-toggle" data-toggle="dropdown" id="dropdownMenuButton2" type="button"><i class="icon-options-vertical"></i></button>
                                                        <div aria-labelledby="dropdownMenuButton2" class="dropdown-menu dropdown-menu-right">
                                                            <a href="javascript:;" onClick="addValues()" class="dropdown-item addRow"><i class="ti-pencil"></i> Afegir</a>
                                                            <a href="javascript:;" onClick="deleteRow({{$key}})" class="dropdown-item deleteRow"><i class="ti-trash"></i> Eliminar</a>
                                                            <a href="javascript:;" onClick="duplicateRow({{$key}})" class="dropdown-item duplicateRow"><i class="ti-layers-alt"></i> Duplicar</a>
                                                        </div>
                                                    </div>
                                                </td>
                                                </tr>
                                            </div>
                                            @endforeach
                                        </tbody>
                                    </table>
                                </div>
                                <br>
                                <div class="col-md-12 pb-3 mt-3">
                                    <a onClick="addValues()" class="btn btn-primary"><i class="fas fa-plus"></i></a>
                                </div>
                                <br>
                                <div class="col-md-6 pb-3 mt-2">
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
                                <div class="col-md-6 pb-3 mt-2">
                                    <label>Cabezal FleCortin</label>
                                    <input type="text" class="form-control " value="@if(isset($caracteristics[0])){{ $caracteristics[0]->flecortin_head }}@endif " name="flecortin_head">
                                </div>
                                <div class="col-md-6 pb-3">
                                    <label>Ancho FleCortin</label>
                                    <input type="text" class="form-control " value="@if(isset($caracteristics[0])){{ $caracteristics[0]->flecortin_head }}@endif " name="flecortin_width">
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
                                    <select name="labs[]" class="form-control select2" multiple="multiple">
                                        <option value="">Elige un LAB</option>
                                        @foreach($labs as $lab)
                                        @if(in_array($lab->id,$selected_labs->toArray()))
                                            <option value="{{$lab->id}}" selected>{{$lab->name}}</option>
                                        @else
                                            <option value="{{$lab->id}}">{{$lab->name}}</option>
                                        @endif
                                        @endforeach
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
        var counter = {{sizeof($caracteristics)}};

        $(document).ready( () => {
            CKEDITOR.replaceAll('item');
            $('.select2').select2();
        });

        function addValues(){
            $('#caracteristics_body').append(`
            <tr id="row_`+counter+`">
                <td>
                    <input type="text" class="form-control " name="references2[]">
                </td>
                <td>
                    <input type="number" class="form-control " name="width[]">
                </td>
                <td>
                    <input type="number" class="form-control " name="bags[]">
                </td>
                <td>
                    <input type="number" class="form-control " name="laces[]">
                </td>
                <td>
                    <input type="text" class="form-control " name="rapport[]">
                </td>
                <td>
                    <input type="text" class="form-control " name="diameter[]">
                </td>
                <td>
                    <input type="text" class="form-control " name="length[]">
                </td>
                <td>
                    <input type="text" class="form-control " name="width_diameter[]">
                </td>
                <td>
                    <input type="text" class="form-control " name="observations[]">
                </td>
                <td>
                    <input type="number" class="form-control " name="order_car[]">
                </td>
                <td>
                    <input type="number" class="form-control discount " name="discount[]">
                </td>
                <td class="acciones">
                    <div class="btn-group">
                        <button aria-expanded="false" aria-haspopup="true" class="btn btn-default dropdown-toggle" data-toggle="dropdown" id="dropdownMenuButton2" type="button"><i class="icon-options-vertical"></i></button>
                        <div aria-labelledby="dropdownMenuButton2" class="dropdown-menu dropdown-menu-right">
                            <a href="javascript:;" onClick="addValues()" class="dropdown-item addRow"><i class="ti-pencil"></i> Afegir</a>
                            <a href="javascript:;" onClick="deleteRow(`+counter+`)" class="dropdown-item deleteRow"><i class="ti-trash"></i> Eliminar</a>
                            <a href="javascript:;" onClick="duplicateRow(`+counter+`)" class="dropdown-item duplicateRow"><i class="ti-layers-alt"></i> Duplicar</a>
                        </div>
                    </div>
                </td>
            </tr>
            `);

            counter++;
        }

        function duplicateRow(num){
            $('.dropdown-toggle').dropdown('toggle');
            //Get the clone of the row
            var clone = $('#row_' + num).clone();
            //change the id to the correct id
            clone.attr("id","row_" + counter);
            //change the functions too
            clone.find("[onClick^='deleteRow']").attr("onClick","deleteRow("+counter+")");
            clone.find("[onClick^='duplicateRow']").attr("onClick","duplicateRow("+counter+")");

            $('#caracteristics_body').append(clone);
            counter++;
        }

        function deleteRow(num){
            $('#row_' + num).remove();
        }

        if($("input[name=outlet]").is(':checked')) {
            $(".discount").prop("disabled",false);
        } else {
            $(".discount").prop("disabled",true);
        }

        $('#outlet').change(function(){
            if($("input[name=outlet]").is(':checked')){
                $(".discount").prop("disabled",false);
            } else {
                $(".discount").prop("disabled",true);
            }
        });
    </script>
@endsection
