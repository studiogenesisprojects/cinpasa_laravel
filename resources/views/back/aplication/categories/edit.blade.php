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
                <form action="{{route('categorias-aplicaciones.update', $applicationCategory->id)}}" enctype="multipart/form-data" method="POST">
                    @csrf
                    @method('PATCH')
                    <div class="row">
                      <div class="col-md-6">
                          <div class="form-group">
                                <label for="">Imagen principal</label>
                                <input type="file" name="image" class="form-control">
                          </div>
                          @if($applicationCategory->image)
                            <img class="w-25" src="{{Storage::url($applicationCategory->image)}}">
                         @endif
                      </div>
                      <div class="col-md-6">
                        <div class="form-group">
                              <label for="">Imagen de listado</label>
                              <input type="file" name="list_image" class="form-control">
                              
                        </div>
                        @if($applicationCategory->list_image)
                            <img class="w-25" src="{{Storage::url($applicationCategory->list_image)}}">
                         @endif
                    </div>
                      <div class="col-sm-12">
                        <div class="os-tabs-w">
                            <div class="os-tabs-controls os-tabs-controls-cliente">
                                <ul class="nav nav-tabs upper">
                                    @foreach($applicationCategory->langCodeIds as $key => $id)
                                    <li class="nav-item">
                                        <a aria-expanded="false" class="nav-link @if($id == 0){{'active'}}@endif" data-toggle="tab" href="#tab_{{$key}}">{{ strtoupper($key) }}</a>
                                    </li>
                                    @endforeach
                                </ul>
                            </div>
                        </div>
                        <div class="tab-content">
                            @foreach($applicationCategory->langCodeIds as $key => $id)
                            <div class="tab-pane @if($loop->first){{ 'active' }}@endif" id="tab_{{$key}}">
                                <input type="hidden" name="applications[{{ $id }}][language_id]" value="{{$id}}">
                                <div class="row">
                                    <div class="col-sm-6">
                                        <div class="form-group @if($errors->has('applications.'.$id.'.name')){{ 'has-error' }}@endif">
                                            <label for="">Nombre</label>
                                            <input id="title" type="text" class="form-control title" value="{{$applicationCategory->lang($key)->name}}" name="applications[{{ $id }}][name]" >
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group @if($errors->has('applications.'.$id.'.slug')){{ 'has-error' }}@endif">
                                            <label for="">Slug</label>
                                            <input id="slug" class="form-control slug" type="text" value="{{$applicationCategory->lang($key)->slug}}" name="applications[{{ $id }}][slug]">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-12">
                                        <div class="form-group @if($errors->has('applications.'.$id.'.lite_description')){{ 'has-error' }}@endif">
                                            <label for="">Etiqueta alt</label>
                                            <input type="text" name="applications[{{ $id }}][alt]" class="form-control" value="{{ $applicationCategory->lang($key)->alt }}">
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-12">
                                        <div class="form-group @if($errors->has('applications.'.$id.'.description')){{ 'has-error' }}@endif">
                                            <label for="">Descripción completa</label>
                                            <textarea class="item form-control"  name="applications[{{ $id }}][description]"  cols="30" rows="8">{{$applicationCategory->lang($key)->description}}</textarea>
                                        </div>
                                    </div>
                                </div>
                                <h5 class="my-3">Meta etiquetas SEO</h5>
                                <div class="row mb-3">
                                    <div class="col-md-12">
                                        <label>Título de SEO</label>
                                        <input class="item form-control" name="applications[{{ $id }}][seo_title]" cols="30" rows="6" value="{{$applicationCategory->lang($key)->seo_title ?? ''}}" />
                                    </div>
                                </div>
                                <div class="row mb-3">
                                    <div class="col-md-12">
                                        <label>Descripción de SEO</label>
                                        <textarea class="item form-control" name="applications[{{ $id }}][seo_description]" cols="30" rows="6">{{$applicationCategory->lang($key)->seo_description ?? ""}}</textarea>
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

