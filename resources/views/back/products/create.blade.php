@extends('back.common.main')
@section('css')
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css" integrity="sha384-GJzZqFGwb1QTTN6wy59ffF1BuGJpLSa9DkKMp0DgiMDm4iYMj70gZWKYbI706tWS" crossorigin="anonymous">
<style>
.select2-dropdown.select2-dropdown--below {
    min-width: 120px;
}
</style>
@endsection
@section('content')

<div class="content-box">
    <div class="element-wrapper" id="app">
        <h6 class="element-header">Crear Producto {{ (!empty($outlet))?'Outlet':'' }}
            <a href="{{  (!empty($outlet))?route('outlet.index'):route('productos.index') }}" class="btn btn-white float-right"><i
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
                            @if(!empty($outlet))
                                <input type="hidden" name="outlet" value="true" />
                            @else
                                <input type="hidden" name="outlet" value="false" />
                            @endif
                            <div class="element-info">
                                <div class="element-info-with-icon">
                                    <div class="element-info-icon">
                                        <div class="ti-layout-cta-right"></div>
                                    </div>
                                    <div class="element-info-text">
                                        <h5 class="element-inner-header">Crear nuevo producto  {{ (!empty($outlet))?'Outlet':'' }}</h5>
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
                                                        <input checked type="checkbox" id="productLanguages[{{ $idioma->id }}][active]" name="productLanguages[{{ $idioma->id }}][active]" class="custom-control-input" id="customSwitch{{ $idioma->id }}">
                                                        <label class="custom-control-label" for="productLanguages[{{ $idioma->id }}][active]"> Publicar producto en <strong>{{$idioma->name}}</strong></label>
                                                    </div>
                                                </div>
                                                <div class="col-sm-6">
                                                    <div class="form-group">
                                                        <label for="">Nombre</label>
                                                        <input id="name-{{ $key }}" type="text" class="form-control title" name="productLanguages[{{ $idioma->id }}][name]" value="{{ old('productLanguages.'.$idioma->id.'.name') }}" required>
                                                    </div>
                                                </div>
                                                <div class="col-sm-6">
                                                    <div class="form-group">
                                                        <label for="">Slug</label>
                                                        <input id="id-{{ $key }}" type="text" class="form-control slug" name="productLanguages[{{ $idioma->id }}][slug]" value="{{ old('productLanguages.'.$idioma->id.'.slug') }}" required>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row pb-3">
                                                <div class="col-md-12">
                                                    <label>Descripción corta</label>
                                                    <textarea class="form-control short_text" name="productLanguages[{{ $idioma->id }}][lite_description]" cols="30" rows="2">
                                                        {{ old('productLanguages.'. $idioma->id .'.lite_description') }}
                                                    </textarea>
                                                </div>
                                            </div>
                                            <div class="row mb-3">
                                                <div class="col-md-12">
                                                    <label>Descripción</label>
                                                    <textarea class="item form-control" name="productLanguages[{{ $idioma->id }}][description]" cols="30" rows="6">
                                                        {{ old('productLanguages.'.$idioma->id.'.description') }}
                                                    </textarea>
                                                </div>
                                            </div>
                                            <h5 class="my-3">Meta etiquetas SEO</h5>
                                            <div class="row mb-3">
                                                <div class="col-md-12">
                                                    <label>Título de SEO</label>
                                                    <input class="item form-control" name="productLanguages[{{ $idioma->id }}][seo_title]" value="{{ old('productLanguages.'.$idioma->id.'.seo_title') }}"  />
                                                </div>
                                            </div>
                                            <div class="row mb-3">
                                                <div class="col-md-12">
                                                    <label>Descripción de SEO</label>
                                                    <textarea class="item form-control" name="productLanguages[{{ $idioma->id }}][seo_description]" cols="30" rows="6">
                                                        {{ old('productLanguages.'.$idioma->id.'.seo_description') }}
                                                    </textarea>
                                                </div>
                                            </div>
                                        </div>
                                        @endforeach
                                    </div>
                                </div>
                            </div>
                            <div class="row py-4 border-top">
                                <div class="col-sm-12">
                                    <h5 class="mb-4">Información del producto {{ (!empty($outlet))?'Outlet':'' }}</h5>
                                </div>
                                <div class="col-md-6">
                                    <label for="">Activo: <input type="checkbox" name="active" {{ empty(old('active'))?'checked':old('active')?'checked':''}}></label>
                                </div>
                                <div class="col-md-6">
                                    <label for="">Orden</label>
                                    <input class="form-control" type="number" name="order" value="{{ old('order') }}">
                                </div>
                                <div class="col-md-6">
                                    <label>Etiquetas</label>
                                    <select class="select2" name="tags[]" multiple="multiple" >
                                        @foreach ($tags as $tag)
                                            <option value="{{$tag->id}}" {{old('tags') != null && in_array($tag->id, old('tags')) ?'selected':''}} >{{$tag->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-6">
                                    <label>Eco Logos</label>
                                    <select name="ecos[]" class="form-control select2" multiple="multiple" >
                                        @foreach ($ecos as $eco)
                                        <option value="{{$eco->id}}" {{old('ecos') != null && in_array($eco->id, old('ecos')) ?'selected':''}}>{{$eco->name}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-6">
                                    <label>Codigo Cinpasa</label>
                                    <input name="liasa_code" class="form-control" value="{{ old('liasa_code') }}" />
                                </div>
                            </div>

                            <h5 class="pt-3">Múltimedia</h5>

                            <div class="row pb-3">
                                <div class="col-sm-6">
                                    <label for="primary_image">
                                        Imagen Principal
                                    </label>
                                    <input type="file" name="primary_image" class="form-control" for="primary_image" accept="image/png, image/jpeg">
                                </div>

                                <div class="col-sm-6">
                                    <label for="list_image">
                                        Imagen de listado
                                    </label>
                                    <input type="file" name="list_image" class="form-control" for="list_image" accept="image/png, image/jpeg">
                                </div>
                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <small>*El formato de vídeo tiene que ser este: si el link que queremos introducir es este: https://youtu.be/T0OwfFHzNnA, se tendría que introducir la última parte, quedando así: T0OwfFHzNnA</small>
                                        <br>
                                        <label>Video</label>
                                        <input class="form-control" type="text" name="video" value="{{ old('video') }}">
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
                                <div class="table-responsive">
                                    <table id="caracteritics_table" width="100%" height="150px" class="table table-striped table-lightfont table-hover">
                                        <thead>
                                            <tr>
                                                <th>Referencia</th>
                                                <th>Material</th>
                                                <th>Ancho</th>
                                                <th>Bolsas</th>
                                                <th>Cordones</th>
                                                <th>Rapport</th>
                                                <th>Diámetro</th>
                                                <th>Largo</th>
                                                <th>Ancho/Diámetro</th>
                                                <th>Observaciones</th>
                                                <th>Orden</th>
                                                @if(!empty($outlet))
                                                <th>Descuento</th>
                                                <th>Stock disponible</th>
                                                @endif
                                                <th class="td-acciones">Acciones</th>
                                            </tr>
                                        </thead>
                                        <tbody id="caracteristics_body">
                                            <div id="bloc_1">
                                                <tr id="row_0">
                                                <td>
                                                    <input type="text" class="form-control " name="references2[]" value="{{ old('references2.0') }}" />
                                                </td>
                                                <td>
                                                    <select class="form-control select2" name="material_id[]">
                                                        <option value=""></option>
                                                        @foreach ($materials as $material)
                                                            <option value="{{ $material->id }}" @if (old('material_id.0') == $material->id) selected @endif>
                                                                {{ $material->name }}
                                                            </option>
                                                        @endforeach
                                                    </select>
                                                </td>
                                                <td>
                                                    <input type="number" class="form-control " name="width[]" value="{{ old('width.0') }}" />
                                                </td>
                                                <td>
                                                    <input type="number" class="form-control " name="bags[]" value="{{ old('bags.0') }}" />
                                                </td>
                                                <td>
                                                    <input type="number" class="form-control " name="laces[]" value="{{ old('laces.0') }}" />
                                                </td>
                                                <td>
                                                    <input type="text" class="form-control " name="rapport[]" value="{{ old('rapport.0') }}" />
                                                </td>
                                                <td>
                                                    <input type="text" class="form-control " name="diameter[]" value="{{ old('diameter.0') }}" />
                                                </td>
                                                <td>
                                                    <input type="text" class="form-control " name="length[]" value="{{ old('length.0') }}" />
                                                </td>
                                                <td>
                                                    <input type="text" class="form-control " name="width_diameter[]" value="{{ old('width_diameter.0') }}" />
                                                </td>
                                                <td>
                                                    <input type="text" class="form-control " name="observations[]" value="{{ old('observations.0') }}" />
                                                </td>
                                                <td>
                                                    <input type="number" class="form-control " name="order_car[]" value="{{ old('order_car.0') }}" />
                                                </td>
                                                @if(!empty($outlet))
                                                <td>
                                                    <input type="number" class="form-control" name="discount[]" value="{{ old('discount.0') }}" />
                                                </td>
                                                <td>
                                                    <input type="number" class="form-control" name="stock[]" value="{{ old('stock.0') }}" />
                                                </td>
                                                @endif
                                                <td class="acciones">
                                                    <div class="btn-group">
                                                        <button aria-expanded="false" aria-haspopup="true" class="btn btn-default dropdown-toggle" data-toggle="dropdown" id="dropdownMenuButton2" type="button"><i class="icon-options-vertical"></i></button>
                                                        <div aria-labelledby="dropdownMenuButton2" class="dropdown-menu dropdown-menu-right">
                                                            <a href="javascript:;" onClick="addValues()" class="dropdown-item addRow"><i class="ti-pencil"></i> Afegir</a>
                                                            <a href="javascript:;" onClick="deleteRow(0)" class="dropdown-item deleteRow"><i class="ti-trash"></i> Eliminar</a>
                                                            <a href="javascript:;" onClick="duplicateRow(0)" class="dropdown-item duplicateRow"><i class="ti-layers-alt"></i> Duplicar</a>
                                                        </div>
                                                    </div>
                                                </td>
                                                </tr>
                                            </div>
                                        </tbody>
                                    </table>
                                </div>
                                <br>
                                <div class="col-md-12 pb-3 mt-3">
                                    <a onClick="addValues()" class="btn btn-primary"><i class="fas fa-plus"></i></a>
                                </div>
                                <br>

                                <div class="col-md-6 pb-3 mt-3">
                                    <label>Cabezal FleCortin</label>
                                    <input type="text" class="form-control " name="flecortin_head" value="{{ old('flecortin_head') }}" />
                                </div>
                                <div class="col-md-6 pb-3 mt-3">
                                    <label>Ancho FleCortin</label>
                                    <input type="text" class="form-control " name="flecortin_width" value="{{ old('flecortin_width') }}" />
                                </div>
                                <div class="col-md-6 pb-3">
                                    <label>Presentación</label>
                                    <select name="presentation" class="form-control">
                                        <option value="">Elige una presentación</option>
                                        <option value="0">Por unidades</option>
                                        <option value="1">Por lotes</option>
                                    </select>
                                </div>
                                <div class="col-md-6">
                                    <label for="">Referencias</label>
                                    <select name="references[]" class="form-control select2" multiple="multiple" >
                                        @foreach ($references as $reference)
                                            <option value="{{$reference->id}}" {{old('references') != null && in_array($reference->id, old('references')) ?'selected':''}}>{{$reference->referencia}}</option>
                                        @endforeach
                                    </select>
                                </div>
                                <div class="col-md-6">
                                    <label>Categorías</label>
                                    <applications :name="'categories[]'" :items="{{$categories}}" :sitems="{{$categories->whereIn('id', old('categories'))}}" ></applications>
                                </div>
                                <div class="col-md-6">
                                    <label>Muestrarios</label>
                                    <applications :name="'colors[]'" :items="{{$colors}}" :sitems="{{$colors->whereIn('id', old('colors'))}}"></applications>
                                </div>
                                <div class="col-md-6">
                                    <label>Acabados</label>
                                    <applications :name="'finisheds[]'" :items="{{$finishes}}" :sitems="{{$finishes->whereIn('id', old('finisheds'))}}"></applications>
                                </div>
                                <div class="col-md-6">
                                    <label>Aplicaciones</label>
                                    <applications :name="'applications[]'" :items="{{$applications}}" :sitems="{{$applications->whereIn('id', old('applications'))}}"></applications>
                                </div>



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

        var counter = 1;

        $(document).ready( () => {
            CKEDITOR.replaceAll('item');
            $('.select2').select2();
        });

        function addValues(){
            @if(!empty($outlet))
            var outlet = '<td><input type="number" class="form-control" name="discount[]"></td><td><input type="number" class="form-control" name="stock[]"></td>';
            @else
            var outlet = '';
            @endif

            $('#caracteristics_body').append(`
            <tr id="row_`+counter+`">
                <td>
                    <input type="text" class="form-control " name="references2[]">
                </td>
                <td>
                    <select class="form-control select2 select2-counter-${counter}" name="material_id[]">
                        <option value=""></option>
                        @foreach ($materials as $material)
                            <option value="{{ $material->id }}">
                                {{ $material->name }}
                            </option>
                        @endforeach
                    </select>
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
                </td>`+outlet+`
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
            $(`.select2-counter-${counter}`).select2();
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
    </script>
@endsection
