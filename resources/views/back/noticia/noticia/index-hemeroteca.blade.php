@extends('back.common.main')

@section('css')
<link href="{{ asset('plugins/bootstrap-datepicker/css/datepicker3.css') }}" rel="stylesheet" type="text/css" media="screen">
@endsection

@section('content')
<div class="content-i">
    <div class="content-box">
        <div class="element-wrapper">
            <h6 class="element-header">Listado Noticias ({{ $noticias->count() }})
                <a href="{{ route('hemerotecaUpdate') }}" class="btn btn-primary float-right"><i class="ti-plus"></i> Nueva Noticia</a>
            </h6>
            <div class="element-box element-box-usuarios">
                <div class="row">
                    <div class="col-sm-12">
                        <h4>Filtrar</h4>
                    </div>
                </div>
                <form action="{{ route('hemerotecaIndex') }}" method="post">
                    <div class="row">
                        <div class="col-sm-3">
                            <div class="form-group form-group-default">
                                <label for="titular">Titular</label>
                                <input name="titular" type="text" class="form-control" value="{{ $titular }}">
                            </div>
                        </div>
                        <div class="col-sm-3">
                            <div class="form-group form-group-default">
                                <label for="fecha_inicio">Fecha inicio</label>
                                <input id="fecha_inicio" name="fecha_inicio" type="text" class="form-control" value="@if(!empty($fecha_ini)){{ date('d/m/Y', strtotime($fecha_ini)) }}@endif">
                            </div>
                        </div>
                        <div class="col-sm-3">
                            <div class="form-group form-group-default">
                                <label for="fecha_fin">Fecha final</label>
                                <input id="fecha_fin" name="fecha_fin" type="text" class="form-control" value="@if(!empty($fecha_fin)){{ date('d/m/Y', strtotime($fecha_fin)) }}@endif">
                            </div>
                        </div>
                        <div class="col-sm-3">
                            <div class="form-group form-group-default">
                                <label for="categoria_id">Categoría</label>
                                <select name="categoria_id" id="categoria_id" class="form-control select2" multiple="true">
                                    @foreach($categorias as $categoria)
                                    <option value="{{ $categoria->id }}" @if($categoria_id == $categoria->id || old('categoria_id') == $categoria->id){{ 'selected="selected"' }}@endif>{{ $categoria->noticiaCategoriaLang(config('app.lang_default'))->nombre }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-3">
                            <div class="form-group form-group-default">
                                <label for="etiqueta_id">Etiquetas</label>
                                <select name="etiqueta_id" id="etiqueta_id" class="form-control select2" multiple="true">
                                    @foreach($etiquetas as $etiqueta)
                                    <option value="{{ $etiqueta->id }}" @if($etiqueta_id == $etiqueta->id || old('etiqueta_id') == $etiqueta->id){{ 'selected="selected"' }}@endif>{{ $etiqueta->noticiaEtiquetaLang(config('app.lang_default'))->nombre }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-sm-3">
                            <div class="form-group form-group-default">
                                <label for="redactor_id">Redactor</label>
                                <select name="redactor_id" id="redactor_id" class="form-control select2">
                                    @foreach($redactores as $redactor)
                                    <option value="{{ $redactor->id }}" @if($redactor_id == $redactor->id || old('redactor_id') == $redactor->id){{ 'selected="selected"' }}@endif>{{ $redactor->nombre }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-sm-3">
                            <div class="form-group form-group-default">
                                <label for="idioma_id">Idiomas</label>
                                <select name="idioma_id" id="idioma_id" class="form-control select2" multiple="true">
                                    @foreach($idiomas as $idioma)
                                    <option value="{{ $idioma->id }}" @if($idioma_id == $idioma->id || old('idioma_id') == $idioma->id){{ 'selected="selected"' }}@endif>{{ $idioma->code }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        {{ csrf_field() }}
                        <div class="col-sm-3">
                            <div class="form-group">
                                <button type="submit" class="mt-4-special btn btn-info">Filtrar</button>
                            </div>
                        </div>
                    </div>
                </form>
                <div class="table-responsive">
                    <table width="100%" class="table table-striped table-lightfont table-hover">
                        <thead>
                            <tr role="row">
                                <th>Fecha</th>
                                <th>Titular</th>
                                <th>Categorías</th>
                                <th>Etiquetas</th>
                                <th>Redactor</th>
                                <th>Idiomas</th>
                                <th class="acciones">Acciones</th>
                            </tr>
                        </thead>
                        <tfoot>
                            <tr>
                                <th>Fecha</th>
                                <th>Titular</th>
                                <th>Categorías</th>
                                <th>Etiquetas</th>
                                <th>Redactor</th>
                                <th>Idiomas</th>
                                <th class="acciones">Acciones</th>
                            </tr>
                        </tfoot>
                        <tbody>
                            @foreach($noticias as $noticia)
                            <tr role="row" id="fila_{{ $noticia->id }}">
                                <td class="">{{ date('d/m/Y', strtotime($noticia->fecha_publicacion)) }}</td>
                                <td>
                                    <strong>{{ $noticia->noticiaLang(config('app.lang_default'))->titulo }}</strong>
                                </td>
                                <td>
                                    <small>
                                        @foreach($noticia->noticiaCategorias as $categoria)
                                            {{ $categoria->noticiaCategoriaLang(config('app.lang_default'))->nombre }}
                                            @if (!$loop->last)
                                                {{ ', ' }}
                                            @endif
                                        @endforeach
                                    </small>
                                </td>
                                <td>
                                    <small>
                                        @foreach($noticia->noticiaEtiquetas as $etiqueta)
                                        {{ $etiqueta->noticiaEtiquetaLang(config('app.lang_default'))->nombre }}
                                        @if (!$loop->last)
                                        {{ ', ' }}
                                        @endif
                                        @endforeach
                                    </small>
                                </td>
                                <td>
                                    <small>{{ $noticia->redactor->nombre ?? '' }}</small>
                                </td>
                                <td>
                                    <small>
                                        @foreach($noticia->idiomasNoticia() as $idioma)
                                        {{ $idioma->code }}
                                        @if (!$loop->last)
                                        {{ ', ' }}
                                        @endif
                                        @endforeach
                                    </small>
                                </td>
                                <td class="td-acciones">
                                    <div class="btn-group">
                                        <button aria-expanded="false" aria-haspopup="true" class="btn btn-default dropdown-toggle" data-toggle="dropdown" id="dropdownMenuButton2" type="button"><i class="icon-options-vertical"></i></button>
                                        <div aria-labelledby="dropdownMenuButton2" class="dropdown-menu dropdown-menu-right">
                                            @if(Auth()->user()->role->canWrite(App\Models\Section::find(config('app.enabled_sections.noticias'))))
                                                <a href="{{ action('Back\Noticia\NoticiaController@updateHemeroteca', $noticia->id) }}" class="dropdown-item"><i class="ti-pencil"></i> Editar</a>
                                            @endif
                                            @if(Auth()->user()->role->canDelete(App\Models\Section::find(config('app.enabled_sections.noticias'))))
                                                <a href="" class="dropdown-item delete-register" data-toggle="modal" data-target="#modal-delete" data-url="{{ action('Back\Noticia\NoticiaController@delete', $noticia->id) }}"><i class="ti-trash"></i> Eliminar</a>
                                            @endif
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <div class="row">
                    <div id="pagination">
                        {{ $noticias->links() }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
</div>

@include('back.common.modals.modal-delete')
@include('back.common.modals.modal-error')
@include('back.common.modals.modal-aviso')
@endsection

@section('js')
<script src="{{ asset('plugins/bootstrap-datepicker/js/bootstrap-datepicker.js') }}" type="text/javascript"></script>
<script src="{{ asset('back/js/noticias/noticia-hemeroteca.js') }}"></script>
<script>
    $('.select2').select2()
    $(function() {
        main();
        @if (session('message'))
        mostrarMensajeError('{{ session('message') }}');
        @endif

        @if(session('avisos'))
        mensaje = '';
        @foreach(session('avisos') as $aviso)
        mensaje += '{!! html_entity_decode($aviso) !!}';
        @endforeach
        mostrarMensajeAviso(mensaje);
        @endif
    });
</script>
@endsection
