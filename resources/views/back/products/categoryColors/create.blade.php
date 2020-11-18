@extends('back.common.main')
@section('css')
<link rel="stylesheet" type="text/css" href="{{asset('plugins/colpick-master/css/colpick.css')}}">

@endsection
@section('content')
<div class="content-box">
    <div class="element-wrapper" id="app">
        <h6 class="element-header">Muestrario de colores
            <a href="{{route('categorias-colores.index')}}" class="btn btn-white float-right"><i lass="os-icon os-icon-chevron-left"></i> Volver</a>
        </h6>
        <div class="row">
            <div class="col-sm-12">
                <div class="element-wrapper">
                    <div class="element-box">
                        <form id="formValidate" novalidate="true" method="post" action="{{route('categorias-colores.store')}}">
                            {{ csrf_field() }}

                            <div class="element-info">
                                <div class="element-info-with-icon">
                                    <div class="element-info-icon">
                                        <div class="ti-layout-cta-right"></div>
                                    </div>
                                    <div class="element-info-text">
                                        <h5 class="element-inner-header">Muestrario de color</h5>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-3">
                                    <label class="" for=""> Activo: </label>
                                    <input class="" name="active" type="checkbox" value="1" id="defaultCheck1">
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-4">
                                    <div class="form-group">
                                        <label for="">Orden:</label>
                                        <input type="number" name="order" class="form-control">
                                    </div>
                                </div>
                                <div class="col-sm-12">
                                    <div class="os-tabs-w">
                                        <div class="os-tabs-controls os-tabs-controls-cliente">
                                            <ul class="nav nav-tabs upper">
                                                @foreach(App\Models\Language::all() as $key => $language)
                                                <li class="nav-item"><a aria-expanded="false" class="nav-link @if($key == 0){{'active'}}@endif" data-toggle="tab" href="#tab_{{$language->code}}">{{ strtoupper($language->code) }}</a></li>
                                                @endforeach
                                            </ul>
                                        </div>
                                    </div>
                                    <div class="tab-content">
                                        @foreach(App\Models\Language::all() as $idioma)
                                        <div class="tab-pane @if($loop->first){{ 'active' }}@endif" id="tab_{{$idioma->code}}">
                                            <input type="hidden" name="colorLanguages[{{ $idioma->id }}][language_id]" value="{{$idioma->id}}">
                                            <h5>{{$idioma->name}}</h5>
                                            <div class="row">
                                                <div class="col-sm-6">
                                                    <div class="form-group">
                                                        <label for="">Nombre</label>
                                                        <input type="text" class="form-control title" name="colorLanguages[{{ $idioma->id }}][name]" >
                                                    </div>
                                                </div>
                                                <div class="col-sm-6">
                                                    <div class="form-group">
                                                        <label for="">Slug</label>
                                                        <input type="text" class="form-control slug" name="colorLanguages[{{ $idioma->id }}][slug]" >
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row mb-3">
                                                <div class="col-md-12">
                                                    <label>Descripción</label>
                                                    <textarea class="form-control item" name="colorLanguages[{{ $idioma->id }}][description]" cols="30" rows="6"></textarea>
                                                </div>
                                            </div>
                                            <h5 class="my-3">Meta etiquetas SEO</h5>
                                            <div class="row mb-3">
                                                <div class="col-md-12">
                                                    <label>Título de SEO</label>
                                                    <input class="item form-control" name="colorLanguages[{{ $language->id }}][seo_title]" cols="30" rows="6" />
                                                </div>
                                            </div>
                                            <div class="row mb-3">
                                                <div class="col-md-12">
                                                    <label>Descripción de SEO</label>
                                                    <textarea class="item form-control" name="colorLanguages[{{ $language->id }}][seo_description]" cols="30" rows="6"></textarea>
                                                </div>
                                            </div>
                                        </div>
                                        @endforeach
                                    </div>
                                </div>
                                <div class="col-12">
                                    <applications :name="'colors[]'" :items="{{$colors}}"></applications>
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
    $(document).ready( () => {
        CKEDITOR.replaceAll('item');
        $('.select2').select2();
    })
</script>
@endsection
