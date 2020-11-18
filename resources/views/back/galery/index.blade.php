@extends('back.common.main')

@section('css')
<link href="{{ asset('plugins/bootstrap-datepicker/css/datepicker3.css') }}" rel="stylesheet" type="text/css" media="screen">
@endsection

@section('content')
@if(session('messages'))
    <div class="alert alert-success">{{ session('messages') }}</div>
@endif
<div class="content-i">
    <div class="content-box">
        <div class="element-wrapper">
            <h6 class="element-header">Galerias ({{ $galerias->count() }})
                <a href="{{ route('updateGalery') }}" class="btn btn-primary float-right"><i class="ti-plus"></i> Nuevo</a>
            </h6>
            <div class="element-box element-box-usuarios">
                <div class="row">
                    <div class="col-sm-12">
                        <h4>Filtrar</h4>
                    </div>
                </div>
                <form action="{{ action('Back\Galery\GaleryController@index') }}" method="post">
                    <div class="row">
                        <div class="col-sm-3">
                            <div class="form-group form-group-default">
                                <label for="titulo">Título</label>
                                <input name="titulo" type="text" class="form-control" value="{{ $titulo }}">
                            </div>
                        </div>
                        <div class="col-sm-3">
                            <div class="form-group form-group-default">
                                <label for="fecha_filtro">Fecha</label>
                                <input id="fecha_filtro" name="fecha_filtro" type="text" class="form-control" value="@if(!empty($fecha)){{ date('d/m/Y', strtotime($fecha)) }}@endif">
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
                                <th>Fecha</th>
                                <th>Nombre</th>
                                <th>Noticias</th>
                                <th>Nº de fotos</th>
                                <th class="acciones">Acciones</th>
                            </tr>
                        </thead>
                        <tfoot>
                            <tr>
                                <th>Fecha</th>
                                <th>Nombre</th>
                                <th>Noticias</th>
                                <th>Nº de fotos</th>
                                <th class="acciones">Acciones</th>
                            </tr>
                        </tfoot>
                        <tbody>
                            @foreach($galerias as $galeria)
                            <tr role="row">
                                <td class="">{{ date('d/m/Y', strtotime($galeria->fecha)) }}</td>
                                <td>
                                    <strong>{{ $galeria->titulo }}</strong>
                                </td>
                                <td><a href="{{asset('')}}" class="label label-info">{{ $galeria->galeriaNoticias() }} noticias</a></td>
                                <td>{{$galeria->imagenesGaleria->count()}}</td>
                                <td class="td-acciones">
                                    <div class="btn-group">
                                        <button aria-expanded="false" aria-haspopup="true" class="btn btn-default dropdown-toggle" data-toggle="dropdown" id="dropdownMenuButton2" type="button"><i class="icon-options-vertical"></i></button>
                                        <div aria-labelledby="dropdownMenuButton2" class="dropdown-menu dropdown-menu-right">
                                            <a href="{{ route('updateGalery', $galeria->id)}}" class="dropdown-item"><i class="ti-pencil"></i> Editar</a>
                                            <a href="" class="dropdown-item delete-register" data-toggle="modal" data-target="#modal-delete" data-url="{{ route('deleteGalery', $galeria->id) }}"><i class="ti-trash"></i> Eliminar</a>

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
@endsection

@section('js')
<script src="{{ asset('plugins/bootstrap-datepicker/js/bootstrap-datepicker.js') }}" type="text/javascript"></script>
<script src="{{ asset('back/js/galeria/galeria-listado.js') }}"></script>
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
            mensajeSweetAlert('{!! implode('<br>', session('errores')) !!}');
        @endif
    });
</script>
@endsection
