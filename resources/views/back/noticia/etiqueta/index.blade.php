@extends('back.common.main')

@section('content')

<div class="content-i">
    <div class="content-box">
        <div class="element-wrapper">
            <h6 class="element-header">Etiquetas ({{ $etiquetas->count() }})
                <a href="{{ route('etiquetaUpdate') }}" class="btn btn-primary float-right"><i class="ti-plus"></i> Nueva Etiqueta</a>
            </h6>
            <div class="element-box element-box-usuarios">
                <div class="row">
                    <div class="col-sm-12">
                        <h4>Filtrar</h4>
                    </div>
                </div>
                <form action="{{ route('etiquetaIndex') }}" method="post">
                    <div class="row">
                        <div class="col-sm-3">
                            <div class="form-group form-group-default">
                                <label for="nombre">Palabra</label>
                                <input name="nombre" type="text" class="form-control" value="{{ $nombre }}">
                            </div>
                        </div>
                        <div class="col-sm-3">
                            <div class="form-group form-group-default">
                                <label for="slug">Slug</label>
                                <input name="slug" type="text" class="form-control" value="{{ $slug }}">
                            </div>
                        </div>
                        {{ csrf_field() }}
                        <div class="col-sm-3">
                            <div class="form-group">
                                <button type="submit" class="btn btn-info">Filtrar</button>
                            </div>
                        </div>
                    </div>
                </form>
                <hr>

                <div class="table-responsive">
                    <table width="100%" class="table table-striped table-lightfont table-hover">
                        <thead>
                            <tr>
                                <th>Nombre</th>
                                <th>Slug</th>
                                <th>Noticias</th>
                                <th class="acciones">Acciones</th>
                            </tr>
                        </thead>
                        <tfoot>
                            <tr>
                                <th>Nombre</th>
                                <th>Slug</th>
                                <th>Noticias</th>
                                <th class="acciones">Acciones</th>
                            </tr>
                        </tfoot>
                        <tbody>
                            @foreach($etiquetas as $etiqueta)
                            <tr role="row">
                                <tr role="row">
                                    <td>{{ $etiqueta->noticiaEtiquetaLang(config('app.lang_default'))->nombre }}</td>
                                    <td>{{ $etiqueta->noticiaEtiquetaLang(config('app.lang_default'))->slug }}</td>
                                    <td>{{ count($etiqueta->etiquetaNoticias ) }}</td>
                                    <td class="td-acciones">
                                        <div class="btn-group">
                                            <button aria-expanded="false" aria-haspopup="true" class="btn btn-default dropdown-toggle" data-toggle="dropdown" id="dropdownMenuButton2" type="button"><i class="icon-options-vertical"></i></button>
                                            <div aria-labelledby="dropdownMenuButton2" class="dropdown-menu dropdown-menu-right">
                                                <a href="{{ route('etiquetaUpdate', $etiqueta->id)}}" class="dropdown-item"><i class="ti-pencil"></i> Editar</a>
                                                <a href="" class="dropdown-item delete-register" data-toggle="modal" data-target="#modal-delete" data-url="{{ route('etiquetaDelete', $etiqueta->id) }}"><i class="ti-trash"></i> Eliminar</a>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                                @endforeach
                            </tbody>
                        </table>
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
    <script src="{{ asset('back/js/noticias/etiqueta.js') }}"></script>
    <script>
    $('.delete-register').click(function(e) {
        url = $(this).data('url');
        $('#delete_link').attr('href', url);
    });
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
            @if(session('errores'))
            mensajeSweetAlert('{{ implode('<br>', session('errores')) }}');
            @endif
        });
    </script>
    @endsection
