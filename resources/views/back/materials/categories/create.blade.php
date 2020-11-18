@extends('back.common.main')
@section('content')

<div class="content-box">
    <div class="element-wrapper">
        <h6 class="element-header">Nueva Categoría de materiales
            <a href="{{action('Back\Materials\MaterialCategoryController@index')}}" class="btn btn-white float-right"><i
                class="os-icon os-icon-chevron-left"></i> Volver
            </a>
        </h6>
        <div class="row">
            <div class="col-sm-12">
                <div class="element-wrapper">
                    <div class="element-box">
                        <form id="formValidate" method="POST" accept-charset="utf-8"
                        action="{{action('Back\Materials\MaterialCategoryController@store')}}">
                        {{ csrf_field() }}
                        <div class="element-info">
                            <div class="element-info-with-icon">
                                <div class="element-info-icon">
                                    <div class="ti-layout-cta-right"></div>
                                </div>
                                <div class="element-info-text">
                                    <h5 class="element-inner-header">Información del Material</h5>
                                </div>
                            </div>
                        </div>
                        
                        <div class="row" id="app">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="">Materiales</label>
                                    <applications :items="{{ $materials }}" :name="'materials[]'" ></applications>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label for="">Orden del material</label>
                                    <input type="number" name="order" class="form-control" value="{{$category->order}}" data-error="Introduzca un numero">
                                    <div class="help-block form-text with-errors form-control-feedback"></div>
                                </div>
                            </div>
                        </div>
                        
                        <div class="row">
                            <div class="col-sm-12">
                                <div class="os-tabs-w">
                                    <div class="os-tabs-controls os-tabs-controls-cliente">
                                        <ul class="nav nav-tabs upper">
                                            @foreach($category->langCodeIds as $language => $key)
                                            <li class="nav-item"><a aria-expanded="false" class="nav-link @if($key == 1){{'active'}}@endif" data-toggle="tab" href="#tab_{{$language}}">{{ strtoupper($language) }}</a></li>
                                            @endforeach
                                        </ul>
                                    </div>
                                </div>
                                <div class="tab-content">
                                    @foreach($category->langCodeIds as $language => $key)
                                    <div class="tab-pane @if($key == 1){{ 'active' }}@endif" id="tab_{{ $language }}">
                                        <input type="hidden" name="materialsLangs[{{ $key }}][language_id]" value="{{$key}}">
                                        <div class="row">
                                            <div class="col-sm-6">
                                                <div class="form-group">
                                                    <label for="">Nombre del material</label>
                                                    <input type="text" name="materialsLangs[{{ $key }}][name]" class="form-control title" value="{{$category->lang($key)->name ?? ""}}" data-error="Introduzca un nombre" required>
                                                    <div class="help-block form-text with-errors form-control-feedback"></div>
                                                </div>
                                            </div>
                                            <div class="col-sm-6">
                                                <div class="form-group">
                                                    <label for="">Slug del material</label>
                                                    <input type="text" name="materialsLangs[{{ $key }}][slug]" class="form-control slug" value="{{$category->lang($key)->slug ?? ""}}" data-error="Introduzca un slug" required>
                                                    <div class="help-block form-text text-secondary form-control-feedback">El slug tiene que ser unico</div>
                                                </div>
                                            </div>
                                            <div class="col-sm-12">
                                                <div class="form-group">
                                                    <label for="">Descripción del material</label>
                                                    <textarea type="text" name="materialsLangs[{{ $key }}][description]" class="item form-control" data-error="Introduzca una descripción">{{$category->lang($key)->description ?? ""}}</textarea>
                                                    <div class="help-block form-text with-errors form-control-feedback"></div>
                                                </div>
                                            </div>
                                        </div>
                                        <h5 class="my-3">Meta etiquetas SEO</h5>
                                        <div class="row mb-3">
                                            <div class="col-md-12">
                                                <label>Título de SEO</label>
                                                <input class="item form-control" name="materialsLangs[{{ $key }}][seo_title]" cols="30" rows="6" value="{{$category->lang($key)->seo_title ?? ''}}" />
                                            </div>
                                        </div>
                                        <div class="row mb-3">
                                            <div class="col-md-12">
                                                <label>Descripción de SEO</label>
                                                <textarea class="item form-control" name="materialsLangs[{{ $key }}][seo_description]" cols="30" rows="6">{{$category->lang($key)->seo_description ?? ""}}</textarea>
                                            </div>
                                        </div>
                                    </div>
                                    @endforeach
                                </div> <!-- /tab-content -->
                            </div> <!-- /panel -->
                        </div>
                        {{-- Error messages --}}
                        @if ($errors->any())
                        <div class="alert alert-danger" role="alert">
                            @foreach ($errors->all() as $error)
                            <p>{{ $error }}</p>
                            @endforeach
                        </div>
                        @elseif (session('error_message'))
                        <div class="alert alert-danger" role="alert">
                            {{ session('error_message') }}
                        </div>
                        @elseif (session('message'))
                        
                        <div class="alert alert-success" role="alert">
                            {{ session('message') }}
                        </div>
                        @endif
                        {{-- End error messages --}}
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
    if ('{{!$category->id}}') {
        $('.title').each( (i, v) => {
            $(v).keyup( e => {
                var val = e.currentTarget.value
                var slug = $(e.currentTarget).parent().parent().parent().find('.slug');
                
                $(slug).val(val.toLowerCase().split(' ').join('-'));
            })
        });
    }

    $(document).ready(() => {
        $('.select2').select2()
        CKEDITOR.replaceAll('item');
    })
    
</script>
@endsection
