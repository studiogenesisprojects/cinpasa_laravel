@extends('back.common.main')
@section('css')
<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.2.1/css/bootstrap.min.css" integrity="sha384-GJzZqFGwb1QTTN6wy59ffF1BuGJpLSa9DkKMp0DgiMDm4iYMj70gZWKYbI706tWS" crossorigin="anonymous">
@endsection
@section('content')
<div class="content-box">
    <div class="element-wrapper" id="app">
        <h6 class="element-header">Aplicaciones
            <a href="{{route('aplicaciones.index')}}" class="btn btn-white float-right">
                <i class="os-icon os-icon-chevron-left"></i>
                Volver
            </a>
        </h6>
        <div class="element-box element-box-usuarios">
            <div class="row mb-4">
                <div class="col-sm-12">
                    <h4>Crear Aplicación</h4>
                </div>
                @if ($errors->any())
                <ul class="list">
                    @foreach ($errors->all() as $error)
                    <li class="text-danger">{{$error}}</li>
                    @endforeach
                </ul>
                @endif
            </div>
            <form action="{{route('aplicaciones.store')}}" enctype="multipart/form-data" method="POST">
                @csrf
                <div class="row">

                    <div class="col-sm-6">
                        <div class="form-group">
                            <label for="">Orden</label>
                            <input type="number" name="order" class="form-control">
                        </div>
                    </div>
                    <div class="col-sm-6">
                        <div class="form-group">
                            <label for="">Aplicación padre</label>
                            <select class="select2" multiple name="applicationCategories[]" class="form-control">
                                @foreach ($applicationCategories as $ac)
                                <option  value="{{$ac->id}}">{{$ac->lang()->name}}</option>
                                @endforeach
                            </select>
                        </div>
                    </div>

                    <div class="col-sm-6">
                        <div class="form-group">
                            <label class="btn p-0 m-0">
                                Imágen principal
                            </label>
                            <input type="file" name="section_image" class="form-control">
                        </div>
                    </div>

                    <div class="col-sm-6">
                        <div class="form-group">
                            <label class="btn p-0 m-0">
                                Imágen listado
                            </label>
                            <input type="file" name="list_image" class="form-control">
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
                                    <div class="col-md-12 pb-3">
                                        <div class="custom-control custom-switch">
                                            <input type="checkbox" name="languages[{{ $idioma->id }}][active]" class="custom-control-input" id="customSwitch{{ $idioma->id }}">
                                            <label  class="custom-control-label" for="customSwitch{{ $idioma->id }}"> Publicar aplicación en <strong>{{$idioma->name}}</strong></label>
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group @if($errors->has('languages.'.$idioma->id.'.name')){{ 'has-error' }}@endif">
                                            <label for="">Nombre</label>
                                            <input  type="text" class="form-control title" name="languages[{{ $idioma->id }}][name]">
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group @if($errors->has('languages.'.$idioma->id.'.slug')){{ 'has-error' }}@endif">
                                            <label for="">Slug</label>
                                            <input type="text" class="form-control slug" name="languages[{{ $idioma->id }}][slug]">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-6">
                                        <div class="form-group @if($errors->has('languages.'.$idioma->id.'.subtitle')){{ 'has-error' }}@endif">
                                            <label for="">Subtítulo</label>
                                            <input type="text" class="form-control" name="languages[{{ $idioma->id }}][subtitle]">
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label for="">Etiqueta Alt </label>
                                            <input type="text" class="form-control" name="languages[{{ $idioma->id }}][image_alt]">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-12">
                                        <div class="form-group @if($errors->has('languages.'.$idioma->id.'.lite_description')){{ 'has-error' }}@endif">
                                            <label for="">Descripción corta</label>
                                            <textarea class="form-control short_text" name="languages[{{ $idioma->id }}][lite_description]"  cols="30" rows="2"></textarea>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-12">
                                        <div class="form-group @if($errors->has('languages.'.$idioma->id.'.description')){{ 'has-error' }}@endif">
                                            <label for="">Descripción completa</label>
                                            <textarea class="item form-control" name="languages[{{ $idioma->id }}][description]"  cols="30" rows="8"></textarea>
                                        </div>
                                    </div>
                                </div>
                                <h5 class="my-3">Meta etiquetas SEO</h5>
                                <div class="row mb-3">
                                    <div class="col-md-12">
                                        <label>Título de SEO</label>
                                        <input class="item form-control" name="languages[{{ $idioma->id }}][seo_title]" cols="30" rows="6"  />
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col-md-12">
                                        <label>Descripción de SEO</label>
                                        <textarea class="item form-control" name="languages[{{ $idioma->id }}][seo_description]" cols="30" rows="6"></textarea>
                                    </div>
                                </div>
                            </div>
                            @endforeach
                        </div>
                        <div>
                            <button class="btn btn-primary" type="submit">Guardar</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
</div>
@endsection
@section('js')
    <script>
        $(document).ready( () => {
            $('.select2').select2();
            CKEDITOR.replaceAll('item');
        })
    </script>
@endsection