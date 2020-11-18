@extends('back.common.main')

@section('content')

<div class="content-box" id="finishes">
    <div class="element-wrapper" id="app">
        <h6 class="element-header">Acabados
            <a href="{{route('acabados.index')}}" class="btn btn-white float-right"><i
                class="os-icon os-icon-chevron-left"></i> Volver</a>
            </h6>
            <div class="row">
                <div class="col-sm-12">
                    <div class="element-wrapper">
                        <div class="element-box">
                            <form id="formValidate" novalidate="true" method="post"
                            action="{{route('acabados.store')}}" enctype="multipart/form-data">
                            {{ csrf_field() }}
                            <div class="element-info">
                                <div class="element-info-with-icon">
                                    <div class="element-info-icon">
                                        <div class="ti-layout-cta-right"></div>
                                    </div>
                                    <div class="element-info-text">
                                        <h5 class="element-inner-header">Información del acabado</h5>
                                    </div>
                                </div>
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
                            <div class="row ">
                                <div class="col-sm-2">
                                    <div class="form-group">
                                        <label for="">Activo: </label>
                                        <select name="active" class="form-control">
                                            <option value="1">Si</option>
                                            <option value="0">No</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-sm-2">
                                    <div class="form-group">
                                        <label for="">Orden: </label>
                                        <input type="number" name="order" value="" class="form-control">
                                    </div>
                                </div>
                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <label for="">Imagen primaria</label>
                                        <input type="file" name="primary_image" class="form-control">
                                    </div>
                                    <img  class="w-50" src="" alt="">
                                </div>
                                <div class="col-sm-4">
                                    <div class="form-group">
                                        <label for="">Imagen secundaria</label>
                                        <input type="file" name="secondary_image" class="form-control">
                                    </div>
                                    <img class="w-50"  src="" alt="">

                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="os-tabs-w">
                                        <div class="os-tabs-controls os-tabs-controls-cliente">
                                            <ul class="nav nav-tabs upper">
                                                @foreach($languages as $key => $language)
                                                <li class="nav-item"><a aria-expanded="false" class="nav-link @if($key == 0){{'active'}}@endif" data-toggle="tab" href="#tab_{{$language->code}}">{{ strtoupper($language->code) }}</a></li>
                                                @endforeach
                                            </ul>
                                        </div>
                                    </div>
                                    <div class="tab-content">
                                        @foreach($languages as $key => $language)
                                        <input type="hidden" name="finishedLangs[{{ $language->id }}][language_id]" value="{{ $language->id  }}">
                                        <div class="tab-pane @if($key == 0){{ 'active' }}@endif" id="tab_{{ $language->code }}">
                                            <div class="row">
                                                <div class="col-sm-6">
                                                    <div class="form-group">
                                                        <label for="">Nombre del acabado</label>
                                                        <input type="text" name="finishedLangs[{{ $language->id }}][name]" class="form-control" value=""  data-error="Introduzca un nombre" required>
                                                        <div class="help-block form-text with-errors form-control-feedback"></div>
                                                    </div>
                                                </div>
                                                <div class="col-sm-6">
                                                    <div class="form-group">
                                                        <label for="">Subtítulo</label>
                                                        <input type="text" name="finishedLangs[{{ $language->id }}][subtitle]" class="form-control" data-error="Introduzca un subtítulo">
                                                        <div class="help-block form-text with-errors form-control-feedback"></div>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="row">
                                                <div class="col-sm-6">
                                                    <label for="">Etiqueta ALT</label>
                                                    <input type="text" name="finishedLangs[{{ $language->id }}][alt]" class="form-control" >                                                
                                                </div>
                                                <div class="col-sm-6">
                                                    <div class="form-group">
                                                        <label for="">Slug</label>
                                                        <input type="text" name="finishedLangs[{{ $language->id }}][slug]" class="form-control"  data-error="Introduzca un slug" >
                                                        <div class="help-block form-text with-primary form-control-feedback">Este campo tiene que ser diferente siempre</div>
                                                    </div>
                                                </div>
                                                <div class="col-sm-12">
                                                    <div class="form-group">
                                                        <label for="">Descripción corta</label>
                                                        <textarea type="text"  name="finishedLangs[{{ $language->id }}][lite_description]" class="form-control short_text" data-error="Introduzca una descripción"></textarea>
                                                        <span class="help-block"><small>Caracteres restantes:</small></span><span class="textarea-count"></span>
                                                    </div>
                                                </div>
                                                <div class="col-sm-12">
                                                    <fieldset class="form-group">
                                                        <legend><span>Descripción larga</span></legend>
                                                        <div class="form-group">
                                                            <textarea name="finishedLangs[{{ $language->id }}][large_description]" class="item form-control" rows="8" ></textarea>
                                                        </div>
                                                    </fieldset>
                                                </div>
                                                <div class="col-sm-12">
                                                    <fieldset class="form-group">
                                                        <legend><span>Observaciones</span></legend>
                                                        <div class="form-group">
                                                            <textarea name="finishedLangs[{{ $language->id }}][observations]" class="form-control" rows="8"></textarea>
                                                        </div>
                                                    </fieldset>
                                                </div>
                                                <div class="col-md-12">
                                                    <h5 class="my-3">Meta etiquetas SEO</h5>
                                                </div>
                                                <div class="col-md-12">
                                                    <label>Título de SEO</label>
                                                    <input class="item form-control" name="finishedLangs[{{ $language->id }}][seo_title]" cols="30" rows="6" />
                                                </div>
                                                <div class="col-md-12 mb-3">
                                                    <label>Descripción de SEO</label>
                                                    <textarea class="item form-control" name="finishedLangs[{{ $language->id }}][seo_description]" cols="30" rows="6"></textarea>
                                                </div>
                                            </div>
                                        </div>
                                        @endforeach
                                    </div> <!-- /tab-content -->
                                </div> <!-- /panel -->
                            </div>
                            <div class="row">
                                <div class="col-sm-12">
                                    <h4>Características</h4>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label for="">Colores</label>
                                        <select class="select2" name="colors[]" multiple >
                                            @foreach ($colors as $color)
                                            <option value="{{$color->id}}" >{{$color->lang()->name}}</option>
                                            @endforeach
                                        </select>
                                        <div class="help-block form-text with-errors form-control-feedback"></div>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label for="">Tamaños</label>
                                        <select class="select2" name="sizes[]" multiple>
                                            @foreach ($sizes as $size)
                                            <option value="{{$size->id}}" >{{$size->lang()->name}}</option>
                                            @endforeach
                                        </select>
                                        <div class="help-block form-text with-errors form-control-feedback"></div>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label for="">Posición</label>
                                        <select class="select2" name="positions[]" multiple>
                                            @foreach ($positions as $position)
                                            <option value="{{$position->id}}" >{{$position->lang()->name}}</option>
                                            @endforeach
                                        </select>
                                        <div class="help-block form-text with-errors form-control-feedback"></div>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label for="">Material</label>
                                        <select class="select2" name="materials[]" multiple>
                                            @foreach ($materials as $material)
                                            <option value="{{$material->id}}" >{{$material->lang()->name}}</option>
                                            @endforeach
                                        </select>
                                        <div class="help-block form-text with-errors form-control-feedback"></div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-12">
                                    <h4>Aplicaciones</h4>
                                </div>
                            </div>
                            
                            <applications :items="{{$applications}}" :name="'applications[]'" ></applications>

                            <h5 class="mt-5">Galería multimedia</h5>

                            <div class="row">
                                <div class="col-12">
                                    <div class="form-group">
                                        <label for="video">Video</label>
                                        <input type="text" name="video" class="form-control"  placeholder="código de video">
                                    </div>
                                </div>
                            </div>
                            
                            <galery  :languages="{{$languages}}"></galery>
                            
                            <div class="form-buttons-w">
                                <button class="btn btn-success" type="submit">Guardar</button>
                            </div>
                        </form>
                    </div>
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
    })
</script>    
@endsection
