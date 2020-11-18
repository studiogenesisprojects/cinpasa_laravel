@extends('back.common.main')

@section('content')
<div class="content-box">
    <div class="element-wrapper" id="app">
        <h6 class="element-header">Aplicaciones
            <a href="{{route('categorias-aplicaciones.index')}}" class="btn btn-white float-right"><i
                class="os-icon os-icon-chevron-left"></i> Volver</a>
            </h6>
            <div class="element-box element-box-usuarios">
                <div class="row mb-4">
                    <div class="col-sm-12">
                        <h4>Editar aplicación</h4>
                    </div>
                    @if ($errors->any())
                    <ul class="list">
                        @foreach ($errors->all() as $error)
                        <li class="text-danger">{{$error}}</li>
                        @endforeach
                    </ul>
                    @endif
                </div>
                <form action="{{route('categorias-aplicaciones.store')}}" enctype="multipart/form-data" method="POST">
                    @csrf
                    <div class="row">
                      <div class="col-md-6">
                          <div class="form-group">
                                <label for="">Imagen principal</label>
                                <input type="file" name="image" class="form-control">
                          </div>
                      </div>
                      <div class="col-md-6">
                        <div class="form-group">
                              <label for="">Imagen de listado</label>
                              <input type="file" name="list_image" class="form-control">
                              
                        </div>
                    </div>
                      <div class="col-sm-12">
                        <div class="os-tabs-w">
                            <div class="os-tabs-controls os-tabs-controls-cliente">
                                <ul class="nav nav-tabs upper">
                                    @foreach($languages as $key => $language)
                                    <li class="nav-item">
                                        <a aria-expanded="false" class="nav-link @if($key == 0){{'active'}}@endif" data-toggle="tab" href="#tab_{{$language->code}}">{{ strtoupper($language->code) }}</a>
                                    </li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                        <div class="tab-content">
                            @foreach($languages as $key => $idioma)
                            <div class="tab-pane @if($loop->first){{ 'active' }}@endif" id="tab_{{$idioma->code}}">
                                <input type="hidden" name="applications[{{ $idioma->id }}][language_id]" value="{{$idioma->id}}">
                                <h5>{{$idioma->name}}</h5>
                                <div class="row">
                                    <div class="col-sm-6">
                                        <div class="form-group @if($errors->has('applications.'.$idioma->id.'.name')){{ 'has-error' }}@endif">
                                            <label for="">Nombre</label>
                                            <input id="title" type="text" class="form-control title" name="applications[{{ $idioma->id }}][name]" >
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group @if($errors->has('applications.'.$idioma->id.'.slug')){{ 'has-error' }}@endif">
                                            <label for="">Slug</label>
                                            <input id="slug" class="form-control slug" type="text" name="applications[{{ $idioma->id }}][slug]">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-12">
                                        <div class="form-group @if($errors->has('applications.'.$idioma->id.'.lite_description')){{ 'has-error' }}@endif">
                                            <label for="">Etiqueta alt</label>
                                            <input type="text" name="applications[{{ $idioma->id }}][alt]" class="form-control">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-12">
                                        <div class="form-group @if($errors->has('applications.'.$idioma->id.'.description')){{ 'has-error' }}@endif">
                                            <label for="">Descripción completa</label>
                                            <textarea class="item form-control"  name="applications[{{ $idioma->id }}][description]"  cols="30" rows="8"></textarea>
                                        </div>
                                    </div>
                                </div>
                                <h5 class="my-3">Meta etiquetas SEO</h5>
                                <div class="row mb-3">
                                    <div class="col-md-12">
                                        <label>Título de SEO</label>
                                        <input class="item form-control" name="applications[{{ $idioma->id }}][seo_title]"  />
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col-md-12">
                                        <label>Descripción de SEO</label>
                                        <textarea class="item form-control" name="applications[{{ $idioma->id }}][seo_description]" cols="30" rows="6"></textarea>
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
        $('.title').each( (i, v) => {
            $(v).keyup( e => {
                var val = e.currentTarget.value
                var slug = $(e.currentTarget).parent().parent().parent().find('.slug');

                $(slug).val(val.toLowerCase().split(' ').join('-'));
            })
        });

        $(document).ready( () => {
            CKEDITOR.replaceAll('item');
        })

    </script>
@endsection

