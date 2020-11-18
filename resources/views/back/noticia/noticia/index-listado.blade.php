@extends('back.common.main')

@section('css')
<link href="{{ asset('plugins/bootstrap-datepicker/css/datepicker3.css') }}" rel="stylesheet" type="text/css" media="screen">
@endsection

@section('content')
<div class="content-i">
    <div class="content-box">
        <div class="element-wrapper">
            <h6 class="element-header">Listado Noticias ({{ $noticias->count() }})
                <a href="{{ action('Back\Noticia\NoticiaController@updateListado') }}" class="btn btn-primary float-right"><i class="ti-plus"></i> Nueva Noticia</a>
            </h6>
            <div class="element-box element-box-usuarios">
                <div class="row">
                    <div class="col-sm-12">
                        <h4>Listado</h4>
                    </div>
                </div>
                <hr>
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
                                            <a href="{{ action('Back\Noticia\NoticiaController@updateHemeroteca', $noticia->id) }}" class="dropdown-item"><i class="ti-pencil"></i> Editar</a>
                                            <a href="" class="dropdown-item delete-register" data-toggle="modal" data-target="#modal-delete" data-url="{{ action('Back\Noticia\NoticiaController@delete', $noticia->id) }}"><i class="ti-trash"></i> Eliminar</a>
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
