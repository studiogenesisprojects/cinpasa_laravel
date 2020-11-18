@extends('back.common.main')


@section('content')
@if(session('messages'))
<div class="alert alert-success">{{ session('messages') }}</div>
@endif
<div class="content-i" id="app">
    <div class="content-box">
        <div class="element-wrapper">
            <h6 class="element-header">{{$noticia->id ? 'Editar Noticia' : 'Crear Noticia'}}
                <a href="@if(!empty($pantalla_retorno) && $pantalla_retorno == 'hemeroteca'){{ action('Back\Noticia\NoticiaController@indexHemeroteca') }}@else{{ action('Back\Noticia\NoticiaController@indexListado') }}@endif" class="btn btn-primary float-right"><i
                    class="os-icon os-icon-chevron-left"></i> Volver</a>
                </h6>
                <div class="element-box element-box-usuarios">
                    <div class="row">
                        <div class="col-sm-12">
                            <h4>{{$noticia->id ? 'Editar Noticia' : 'Crear Noticia'}}</h4>
                        </div>
                    </div>
                    <form action="@if(!empty($pantalla_retorno) && $pantalla_retorno == 'hemeroteca'){{ action('Back\Noticia\NoticiaController@handleUpdateHemeroteca', $noticia->id) }}@else{{ action('Back\Noticia\NoticiaController@handleUpdateListado', $noticia->id) }}@endif" method="post" accept-charset="utf-8" enctype="multipart/form-data" id="form-actualizar">
                        <div class="row">
                            <div class="col-sm-3">
                                <div class="form-group">
                                    <label for="">FECHA CREACIÓN</label>
                                    <div id="datepicker-component" class="input-group date">
                                        <input type="text" class="form-control" value="@if($noticia->created_at){{ date('d/m/Y H:i:s', strtotime($noticia->created_at)) }}@endif" disabled>
                                    </div>
                                    @if($noticia->updated_at)
                                    <span class="help-block"><small>Última actualización: {{ date('d/m/Y H:i:s', strtotime($noticia->updated_at)) }}</small></span>
                                    @endif
                                </div>
                            </div>
                            <div class="col-sm-3">
                                <div class="form-group">
                                    <label for="">FECHA PUBLICACIÓN</label>
                                    <div id="datepicker-component" class="input-group date">
                                        <input type="text" class="form-control" name="fecha_publicacion" id="fecha_publicacion" value="@if(old('fecha_publicacion') || empty($noticia->fecha_publicacion)){{ old('fecha_publicacion') }}@else{{ date('d/m/Y', strtotime($noticia->fecha_publicacion)) }}@endif">
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-5">
                                <div class="form-group @if($errors->has('redactor_id')){{ 'has-error' }}@endif">
                                    <label for="">REDACTOR</label>
                                    <select name="redactor_id"  class="form-control select2">
                                        @foreach($redactores as $redactor)
                                        <option value="{{ $redactor->id }}"  @if($noticia->redactor_id == $redactor->id || old('redactor_id') == $redactor->id){{ 'selected="selected"' }}@endif>{{ $redactor->nombre }}</option>
                                        @endforeach
                                    </select>
                                </div>
                            </div>
                            <div class="col-sm-1">
                                <div class="form-group">
                                    <label for="">ACTIVA</label>
                                    <div class="checkbox check-success">
                                        <input type="hidden" name="activo" value="0">
                                        <input type="checkbox" @if($noticia->activo || old('activo')){{ 'checked="checked"' }}@endif value="1" id="activo" name="activo">
                                        <label for="activo">SI</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <hr>
                        <div class="row categorias-y-etiquetas">
                            <div class="col-sm-6">
                                <div class="form-group">
                                    <label>CATEGORÍAS</label>
                                    <select name="categorias[]" id="categorias" class="full-width select2" multiple="true" tabindex="-1">
                                        @foreach($categorias as $categoria)
                                        <option value="{{ $categoria->id }}" @if( in_array($categoria->id, $categorias_noticia) || (is_array(old('categorias')) && in_array($categoria->id, old('categorias'))) ){{ 'selected="selected"' }}@endif>{{ $categoria->noticiaCategoriaLang(config('app.lang_default'))->nombre }}</option>
                                        @endforeach
                                    </select>

                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group form-group-default form-group-default-select2">
                                    <label>ETIQUETAS</label>
                                    <select name="etiquetas[]" class="full-width select2" multiple="" tabindex="-1">
                                        @foreach($etiquetas as $etiqueta)
                                        <option value="{{ $etiqueta->id }}" @if( in_array($etiqueta->id, $etiquetas_noticia) || (is_array(old('etiquetas')) && in_array($etiqueta->id, old('etiquetas'))) ){{ 'selected="selected"' }}@endif>{{ $etiqueta->noticiaEtiquetaLang(config('app.lang_default'))->nombre }}</option>
                                        @endforeach
                                    </select>
                                </div>
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
                                    @foreach($languages as $key => $idioma)
                                    <div class="tab-pane @if($loop->first){{ 'active' }}@endif" id="tab_{{$idioma->code}}">
                                        <div class="row">
                                            <div class="col-sm-5">
                                                <div class="form-group @if($errors->has('noticias.'.$idioma->id.'.titulo')){{ 'has-error' }}@endif">
                                                    <label for="">TÍTULO</label>
                                                    <input type="text" id="title" class="form-control title" name="noticias[{{ $idioma->id }}][titulo]" value="@if(old('noticias.'.$idioma->id.'.titulo')){{ old('noticias.'.$idioma->id.'.titulo') }}@else{{ $noticia->noticiaLang($idioma->id)->titulo }}@endif">
                                                </div>
                                            </div>
                                            <div class="col-sm-5">
                                                <div class="form-group @if($errors->has('noticias.'.$idioma->id.'.slug')){{ 'has-error' }}@endif">
                                                    <label for="slug">SLUG</label>
                                                    <input type="text" id="slug" name="noticias[{{ $idioma->id }}][slug]" class="form-control slug" value="@if(old('noticias.'.$idioma->id.'.slug')){{ old('noticias.'.$idioma->id.'.slug') }}@else{{ $noticia->noticiaLang($idioma->id)->slug }}@endif"></input>
                                                </div>
                                            </div>
                                            <div class="col-sm-2">
                                                <div class="form-group @if($errors->has('noticias.'.$idioma->id.'.slug')){{ 'has-error' }}@endif">
                                                    <label for="">ACTIVO</label>
                                                    <select class="form-control" name="noticias[{{ $idioma->id }}][active]" >
                                                        <option value="0">No</option>
                                                        <option {{$noticia->noticiaLang($idioma->id)->active ? 'selected' : ''}} value="1">Sí</option>
                                                    </select>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-sm-12">
                                                <div class="form-group">
                                                    <label for="">SUBTÍTULO</label>
                                                    <textarea  rows="3" class="form-control" name="noticias[{{ $idioma->id }}][subtitulo]">@if(old('noticias.'.$idioma->id.'.subtitulo')){{ old('noticias.'.$idioma->id.'.subtitulo') }}@else{{ $noticia->noticiaLang($idioma->id)->subtitulo }}@endif</textarea>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="row">
                                            <div class="col-sm-12">
                                                <div class="form-group">
                                                    <label for="">TEXTO CORTO <small>Se usa para la visualización del listado de noticias</small></label>
                                                    <textarea rows="3" id="short_text" class="form-control short_text" name="noticias[{{ $idioma->id }}][texto_corto]">@if(old('noticias.'.$idioma->id.'.texto_corto')){{ old('noticias.'.$idioma->id.'.texto_corto') }}@else{{ $noticia->noticiaLang($idioma->id)->texto_corto }}@endif</textarea><small>Caracteres restantes:</small></span><span class="textarea-count"></span>
                                                </div>
                                            </div>
                                        </div>
                                        <hr>
                                        <div class="row">
                                            <div class="col-sm-12">
                                                <div class="form-group">
                                                    <h3>CONTENIDO</h3>
                                                </div>
                                            </div>
                                        </div>
                                        <div id="bloques-{{ $idioma->id }}">
                                        {{-- Aqui metemos los bloques por ajax --}}
                                        {{-- Si falla la validación pintamos los bloques que se habían enviado --}}
                                        @if(!empty(old('bloques.'.$idioma->id)))
                                            @foreach(old('bloques.'.$idioma->id) as $posicion => $infoBloqueSesion)
                                                @if(!empty($infoBloqueSesion['textos']))
                                                    @include('back.common.bloques.bloque-texto', ['idioma' => $idioma->id, 'index' => $posicion, 'bloque_id' => ''])
                                                @elseif(!empty($infoBloqueSesion['imagenes']))
                                                    @include('back.common.bloques.bloque-imagen', ['idioma' => $idioma->id, 'index' => $posicion, 'bloque_id' => ''], ['idioma' => $idioma->id, 'index' => $posicion, 'bloque_id' => ''])
                                                @elseif(!empty($infoBloqueSesion['galerias']))
                                                    @include('back.common.bloques.bloque-galeria', ['idioma' => $idioma->id, 'index' => $posicion, 'bloque_id' => ''])
                                                @elseif(!empty($infoBloqueSesion['videos']))
                                                    @include('back.common.bloques.bloque-video', ['idioma' => $idioma->id, 'index' => $posicion, 'bloque_id' => ''])
                                                @elseif(!empty($infoBloqueSesion['mapas']))
                                                    @include('back.common.bloques.bloque-mapa', ['idioma' => $idioma->id, 'index' => $posicion, 'bloque_id' => ''])
                                                @elseif(!empty($infoBloqueSesion['separadores']))
                                                    @include('back.common.bloques.bloque-separador', ['idioma' => $idioma->id, 'index' => $posicion, 'bloque_id' => ''])
                                                @endif
                                            @endforeach
                                        @else
                                            @foreach($noticia->noticiaBloquesLang( $idioma->id ) as $infobloque)
                                                @if ($infobloque->tipo_bloque == '1')
                                                    @include('back.common.bloques.bloque-texto', ['idioma' => $idioma->id, 'index' => $infobloque->orden, 'bloque_id' => $infobloque->bloque_id, 'bloque_datos' => $infobloque->getInfoBloque($infobloque->bloque_id, $infobloque->tipo_bloque), 'orden' => $infobloque->orden])
                                                @elseif ($infobloque->tipo_bloque == '2')
                                                    @include('back.common.bloques.bloque-imagen', ['idioma' => $idioma->id, 'index' => $infobloque->orden, 'bloque_id' => $infobloque->bloque_id, 'bloque_datos' => $infobloque->getInfoBloque($infobloque->bloque_id, $infobloque->tipo_bloque), 'orden' => $infobloque->orden])
                                                @elseif ($infobloque->tipo_bloque == '3')
                                                    @include('back.common.bloques.bloque-galeria', ['idioma' => $idioma->id, 'index' => $infobloque->orden, 'bloque_id' => $infobloque->bloque_id, 'bloque_datos' => $infobloque->getInfoBloque($infobloque->bloque_id, $infobloque->tipo_bloque), 'orden' => $infobloque->orden])
                                                @elseif ($infobloque->tipo_bloque == '4')
                                                    @include('back.common.bloques.bloque-video', ['idioma' => $idioma->id, 'index' => $infobloque->orden, 'bloque_id' => $infobloque->bloque_id, 'bloque_datos' => $infobloque->getInfoBloque($infobloque->bloque_id, $infobloque->tipo_bloque), 'orden' => $infobloque->orden])
                                                @elseif ($infobloque->tipo_bloque == '5')
                                                    @include('back.common.bloques.bloque-mapa', ['idioma' => $idioma->id, 'index' => $infobloque->orden, 'bloque_id' => $infobloque->bloque_id, 'bloque_datos' => $infobloque->getInfoBloque($infobloque->bloque_id, $infobloque->tipo_bloque), 'orden' => $infobloque->orden])
                                                @elseif ($infobloque->tipo_bloque == '6')
                                                    @include('back.common.bloques.bloque-separador', ['idioma' => $idioma->id, 'index' => $infobloque->orden, 'bloque_id' => $infobloque->bloque_id, 'bloque_datos' => $infobloque->getInfoBloque($infobloque->bloque_id, $infobloque->tipo_bloque), 'orden' => $infobloque->orden])
                                                @endif
                                            @endforeach
                                        @endif
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-12 form-inline">
                                            <div class="form-group">
                                                <select name="" id="anadir-bloque-{{ $idioma->id }}" class="form-control">
                                                    {{-- <option value="">Selecciona un bloque</option> --}}
                                                    @foreach(config('app.bloques_contenido') as $key => $bloque)
                                                    <option value="{{ $key }}">{{ $bloque }}</option>
                                                    @endforeach
                                                </select>
                                            </div>
                                            <div class="form-group">
                                                <button class="btn btn-info add_bloques" type="button" data-idioma="{{ $idioma->id }}" data-url="{{ action('Back\Noticia\NoticiaController@mostrarNuevoBloque') }}">AÑADIR BLOQUE</button>
                                            </div>
                                        </div>
                                    </div>
                                    <hr>
                                    <div class="row">
                                        <div class="col-sm-12">
                                            <h4>Documentos</h4>
                                        </div>
                                    </div>
                                    <div data-bind="foreach: registrosDocumentos_{{ $idioma->id }}">
                                        <div class="row">
                                            <div class="col-sm-11">
                                                <div class="form-group">
                                                    <label for="">AÑADIR DOCUMENTO</label>
                                                    <br>
                                                    <input type="file" data-bind="{attr: {name: 'documentos_{{ $idioma->id }}[]' }}" >
                                                    <input data-bind="{attr: {name: 'nombre_doc_{{ $idioma->id }}[]', value: nombre_doc }}" type="text" class="form-control" placeholder="Nombre del documento a mostrar">
                                                    <input type="hidden" data-bind="{attr: {name: 'identificador_doc_{{ $idioma->id }}[]', value: identificador_doc }}" />
                                                </div>
                                            </div>
                                            <div class="col-sm-1">
                                                <a href="javascript:void(0)" class="btn btn-danger float-right" data-bind="click: $parent.removeDocumento_{{ $idioma->id }}"><span class="ti-trash"></span>Eliminar</a>
                                            </div>
                                        </div>
                                    </div>
                                    <p><a href="javascript:void(0)" data-bind="click: addDocumento_{{ $idioma->id }}, visible: registrosDocumentos_{{ $idioma->id }}().length < 3" class="text-success"><i class="fa fa-plus"></i> Añadir otro documento</a></p>
                                    <hr>
                                </div>
                                @endforeach
                            </div>

                            <div class="row">
                                <div class="col-sm-12">
                                    <h4>Noticias relacionadas</h4>
                                </div>
                            </div>
                            <br>
                            <div class="row">
                                <div class="col-sm-12">
                                    <div class="radio radio-success" id="select-tipo-relacionadas" data-url="{{ action('Back\Noticia\NoticiaController@noticiaRelacionadaMultiidioma') }}">
                                        <input type="radio" value="yes" name="relacionadas_iguales" id="yes">
                                        <label for="yes">Selección igual a todos los idiomas</label>
                                        <input type="radio" checked="checked" value="no" name="relacionadas_iguales" id="no">
                                        <label for="no">Selección diferente en cada idioma</label>
                                    </div>
                                </div>
                            </div>
                            <div id="noticias-relacionadas">
                                {{-- Aqui por ajax se carga un contenido u otro y sustituirá al que hay--}}
                                <div class="os-tabs-w">
                                    <div class="os-tabs-controls os-tabs-controls-cliente">
                                        <ul class="nav nav-tabs upper">
                                            @foreach($languages as $key => $language)
                                            <li class="nav-item"><a aria-expanded="false" class="nav-link @if($key == 0){{'active'}}@endif" data-toggle="tab" href="#relacionada_{{$language->code}}">{{ strtoupper($language->code) }}</a></li>
                                            @endforeach
                                        </ul>
                                    </div>
                                </div>
                                <div class="tab-content">
                                    @foreach($languages as $key => $idioma)
                                    <div class="tab-pane @if($loop->first){{ 'active' }}@endif" id="relacionada_{{$idioma->code}}">
                                        <div id="noticia-relacionada-idiomas{{ $idioma->id }}">
                                            @if($noticia->id && $noticia->noticiasRelacionadas($idioma->id)->count())
                                            @foreach($noticia->noticiasRelacionadas($idioma->id) as $index => $relacionada)
                                            <div class="row relacionadas-{{ $idioma->id }}">
                                                <div class="col-sm-10">
                                                    <div class="form-group form-group-default ">
                                                        <label for="">Noticia</label>
                                                        <select name="noticiasRelacionadas[{{ $idioma->id }}][]" class="form-control" id="select-relacionda{{ $index }}-{{ $idioma->id }}">
                                                            <option value="">Seleccione una noticia</option>
                                                            @foreach($noticias_select as $key => $noticia_sel)
                                                            <option value="{{ $noticia_sel->id }}" @if($noticia_sel->id == $relacionada->noticia_relacionada){{ 'selected="selected"' }}@endif>{{ $noticia_sel->noticiaLang(config('app.lang_default'))->titulo }}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-sm-2">
                                                    <button type="button" data-url="{{ action('Back\Noticia\NoticiaController@noticiaRelacionadaModal') }}" class="btn btn-default busqueda-relacionada" data-pos="{{ $index }}" data-idioma="{{ $idioma->id }}"><i class="fa fa-search"></i></button>
                                                </div>
                                            </div>
                                            @endforeach
                                            @else
                                            <div class="row relacionadas-{{ $idioma->id }}">
                                                <div class="col-sm-10">
                                                    <div class="form-group form-group-default ">
                                                        <label for="">Noticia</label>
                                                        <select name="noticiasRelacionadas[{{ $idioma->id }}][]" class="form-control" id="select-relacionda0-{{ $idioma->id }}">
                                                            <option value="">Seleccione una noticia</option>
                                                            @foreach($noticias_select as $key => $noticia_sel)
                                                            <option value="{{ $noticia_sel->id }}" >{{ $noticia_sel->noticiaLang(config('app.lang_default'))->titulo }}</option>
                                                            @endforeach
                                                        </select>
                                                    </div>
                                                </div>
                                                <div class="col-sm-2">
                                                    <button type="button" data-pos="0" data-idioma="{{ $idioma->id }}" data-url="{{ action('Back\Noticia\NoticiaController@noticiaRelacionadaModal') }}" class="btn btn-default busqueda-relacionada"><i class="fa fa-search"></i></button>
                                                </div>
                                            </div>
                                            @endif
                                        </div>
                                        <p><a href="{{ action('Back\Noticia\NoticiaController@noticiaRelacionada') }}" class="text-success noticias-relacionadas-add" data-lang="{{ $idioma->id }}"><i class="fa fa-plus"></i> Añadir otra noticia relacionada</a></p>
                                    </div>
                                    @endforeach
                                </div>
                            </div>

                            <hr>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-12">
                            <h4>Material multimedia</h4>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-4" id="imagen_noticia">
                            @if(!empty($noticia->imagen_principal))
                            <img src="{{ asset('uploads/noticias/noticias/imagenes/'.$noticia->imagen_principal) }}" alt="" class="img-fluid" >
                            @endif
                        </div>
                        <div class="col-sm-8">
                            <label for="">IMAGEN PRINCIPAL</label>
                            @if (!empty($noticia->imagen_principal))
                            <span class="help-block" id="eliminar_imagen"><a href="" class="btn btn-danger float-right" id="delete_news_image" data-url="{{ action('Back\Noticia\NoticiaController@deleteImage', $noticia->id) }}"><i class="ti-trash"></i> Eliminar imagen</a></span>
                            @endif
                            <div class="form-group">
                                <input type="file" name="foto_noticia">
                            </div>
                        </div>
                    </div>
                    <hr>
                    <input type="hidden" name="actualizar-noticia" value="0" />
                    {{ csrf_field() }}
                    {{-- <button type="button" class="btn btn-warning">previsualizar</button> --}}
                    <button type="button" class="btn btn-info" id="actualizar-new">Actualizar</button>
                    <button type="submit" class="btn btn-success" id="guardar">Guardar</button>
                </form>
            </div>
            @if (count($errors) > 0)
            <p>Compruebe los campos remarcados, mire en todos los idiomas</p>
            @if($errors->has('foto_noticia'))
            <div class="alert alert-danger">
                <ul>
                    <li>{{ $errors->first('foto_noticia') }}</li>
                </ul>
            </div>
            @endif
            @endif
        </div>
    </div>
</div>

@include('back.common.modals.modal-delete-bloque')
@include('back.common.modals.modal-error')
@include('back.common.modals.modal-aviso')
@include('back.noticia.noticia.modal-buscador')

@endsection

@section('js')
<script src="{{ asset('plugins/jquery-ui-1.12.1.custom/jquery-ui.js') }}" type="text/javascript"></script>
<script src="{{ asset('plugins/bootstrap-datepicker/js/bootstrap-datepicker.js') }}" type="text/javascript"></script>
<script src="{{ asset('plugins/ckeditor_4.6.1_full/ckeditor/ckeditor.js') }}"></script>
<script src="{{ asset('plugins/knockout-3.3.0.js') }}"></script>

<script src="{{ asset('back/js/noticias/noticia.js') }}"></script>
<script src="{{asset('plugins/character-countdown/src/plugins/characterCountdown.js')}}"></script>
<script>
    $(document).ready(function() {

        $('.short_text').each( (i, v) => {
            $(v).characterCountdown({
                countdownTarget: '.textarea-count',
                maxChars:160
            });
        });

        $('.select2').select2()

        if ('{{!$noticia->id}}') {
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
        CKEDITOR.replaceAll('bloque-texto');
    })

    });

    var idiomas_js = new Array();
    var documentos = new Array();
    @foreach($languages as $key => $idioma)
    idiomas_js[{{ $key }}] = {{ $idioma->id }};
    @endforeach

    //Si la noticia es nueva, el id no existe y le pasamos un 0 en vez (lo usamos para algunas de las funciones de js y en estas además preguntamos que si es undefined lo ponemos a 0)
        @if(!empty($noticia->id))
            main({{ $noticia->id }}, idiomas_js);
        @else
            main(0, idiomas_js);
        @endif

        @if (session('message'))
            mostrarMensajeError('{{ session('message') }}');
        @endif

        // console.log(session('avisos'));
        @if(session('avisos'))

            mensaje = '';

            @if(is_array(session('avisos')))
                @foreach(session('avisos') as $aviso)
                    mensaje += '{!! html_entity_decode($aviso) !!}';
                @endforeach
            @else
                mensaje += '{!! html_entity_decode(session("avisos")) !!}'
            @endif
                mostrarMensajeAviso(mensaje);
        @endif
    </script>
    {{-- Documentos --}}
    <script>
        function AppViewModel() {
            var self = this;
            @foreach($languages as $idioma)
                self.registrosDocumentos_{{ $idioma->id }} = ko.observableArray([
                @if(isset($documentos[ $idioma->id ]) && count($documentos[ $idioma->id ]))
                    @foreach ($documentos[ $idioma->id ] as $documento)
                    {
                        nombre_doc: '{{ $documento['nombre_doc'] }}',
                        identificador_doc: '{{ $documento['identificador_doc'] }}',
                    },
                    @endforeach
                @endif
            ]);

                self.removeDocumento_{{ $idioma->id }} = function(documento) {
                    self.registrosDocumentos_{{ $idioma->id }}.remove(documento);
                }

                self.addDocumento_{{ $idioma->id }} = function() {
                    var documento = {};
                    documento['nombre_doc'] = '';
                    documento['identificador_doc'] = '';
                    self.registrosDocumentos_{{ $idioma->id }}.push(documento);
                }
            @endforeach
        }

        ko.applyBindings(new AppViewModel());
    </script>
    {{-- <script>
        function startMap() {
            @foreach($languages as $key => $idioma)
            @foreach($noticia->noticiaBloquesLangMap( $idioma->id ) as $infobloque)
            @php
            $bloque_datos = $infobloque->getInfoBloque($infobloque->bloque_id, $infobloque->tipo_bloque);
            @endphp
            // Validamos que contenga coordenadas
            if('{{ $bloque_datos->latitud }}' != 0 && '{{ $bloque_datos->longitud }}' != 0 && '{{ $bloque_datos->latitud }}' != null && '{{ $bloque_datos->longitud }}' != null) {
                initMap('{{ $idioma->id }}', '{{ $infobloque->orden }}', '{{ $bloque_datos->latitud }}', '{{ $bloque_datos->longitud }}');
            } else {
                initMap('{{ $idioma->id }}', '{{ $infobloque->orden }}', 0, 0);
            }
            @endforeach
            @endforeach
        }
    </script> --}}
    {{-- <script src="https://maps.googleapis.com/maps/api/js?key={{ config('app.google-api-key') }}&libraries=places&callback=startMap"
    async defer></script> --}}
    @endsection
