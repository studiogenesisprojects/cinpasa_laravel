@extends('back.common.main')

@section('content')
<div class="content-box">
    <div class="element-wrapper" id="app">
        <h6 class="element-header">Categoría
            <a href="{{route('categorias.index')}}" class="btn btn-white float-right"><i
                class="os-icon os-icon-chevron-left"></i> Volver</a>
            </h6>
            <div class="row">
                <div class="col-sm-12">
                    <div class="element-wrapper">
                        <div class="element-box">
                            <form id="formValidate" novalidate="true" method="POST"
                            action="{{route('categorias.store')}}" enctype="multipart/form-data">
                            {{ csrf_field() }}
                            <div class="element-info">
                                <div class="element-info-with-icon">
                                    <div class="element-info-icon">
                                        <div class="ti-layout-cta-right"></div>
                                    </div>
                                    <div class="element-info-text">
                                        <h5 class="element-inner-header">Información de la categoría</h5>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <label for="">Orden en buscador</label>
                                        <input class="form-control" type="number" name="searcher_order" >
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="row">
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label for="">Categoría padre (opcional)</label>
                                                <select class="select2" name="sup_product_category" required>
                                                    <option value="">Selecciona una categoría padre</option>
                                                    @foreach ($categories as $category)
                                                    <option value="{{$category->id}}">{{$category->name}}</option>
                                                    @endforeach
                                                </select>
                                                <div class="help-block form-text with-errors form-control-feedback"></div>
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <div class="form-group">
                                                <label for="">Imagen</label>
                                                <input class="form-control" type="file" name="image">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-sm-12">
                                    <div class="os-tabs-w">
                                        <div class="os-tabs-controls os-tabs-controls-cliente">
                                            <ul class="nav nav-tabs upper">
                                                @foreach(\App\Models\Language::all() as $key => $language)
                                                <li class="nav-item"><a aria-expanded="false" class="nav-link @if($key == 0){{'active'}}@endif" data-toggle="tab" href="#tab_{{$language->code}}">{{ strtoupper($language->code) }}</a></li>
                                                @endforeach
                                            </ul>
                                        </div>
                                    </div>
                                    <div class="tab-content">
                                        @foreach(\App\Models\Language::all() as $idioma)
                                        <div class="tab-pane @if($loop->first){{ 'active' }}@endif" id="tab_{{$idioma->code}}">
                                            <input type="hidden" name="productCategoryLanguages[{{ $idioma->id }}][language_id]" value="{{$idioma->id}}">
                                            <h5>{{$idioma->name}}</h5>
                                            <div class="row">
                                                <div class="col-sm-6">
                                                    <div class="form-group">
                                                        <label for="">Nombre</label>
                                                        <input id="name" type="text" class="form-control title" name="productCategoryLanguages[{{ $idioma->id }}][name]" required>
                                                    </div>
                                                </div>
                                                <div class="col-sm-6">
                                                    <div class="form-group">
                                                        <label for="">Slug</label>
                                                        <input id="name" type="text" pattern="[a-zA-Z0-9!@#$%^*_|]{6,25}" class="form-control slug" name="productCategoryLanguages[{{ $idioma->id }}][slug]" required>
                                                    </div>
                                                </div>
                                                <div class="col-sm-12">
                                                    <div class="form-group">
                                                        <label for="">Descripción</label>
                                                        <textarea id="description" type="text" class="form-control" name="productCategoryLanguages[{{ $idioma->id }}][description]" rows="6"></textarea>
                                                    </div>
                                                </div>
                                                <div class="col-sm-12">
                                                    <div class="form-group">
                                                        <label for="">Descripción inferior</label>
                                                        <textarea id="footer_description" type="text" class="form-control" name="productCategoryLanguages[{{ $idioma->id }}][footer_description]" rows="6"></textarea>
                                                    </div>
                                                </div>
                                                <div class="col-md-12">
                                                    <h5 class="my-3">Meta etiquetas SEO</h5>
                                                    <div class="row mb-3">
                                                        <div class="col-md-12">
                                                            <label>Título de SEO</label>
                                                            <input class="item form-control" name="productCategoryLanguages[{{ $idioma->id }}][seo_title]" cols="30" rows="6"  />
                                                        </div>
                                                    </div>
                                                    <div class="row mb-3">
                                                        <div class="col-md-12">
                                                            <label>Descripción de SEO</label>
                                                            <textarea class="item form-control" name="productCategoryLanguages[{{ $idioma->id }}][seo_description]" cols="30" rows="6"></textarea>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        @endforeach
                                        </div>
                                    </div>
                                </div>


                                {{-- Error messages --}}
                                    @if ($errors->any())
                                        <div class="alert alert-danger" role="alert">
                                            <ul>
                                                @foreach ($errors->all() as $error)
                                                    <li>{{ $error }}</li>
                                                @endforeach
                                            </ul>
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
        $(document).ready(function() {
            $('.select2').select2()

            $('.title').each( (i, v) => {
                $(v).keyup( e => {
                    var val = e.currentTarget.value
                    var slug = $(e.currentTarget).parent().parent().parent().find('.slug');

                    $(slug).val(val.toLowerCase().split(' ').join('-'));
                })
            });
        });
    </script>
    @endsection
