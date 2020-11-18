@extends('back.common.main')

@section('css')
<link href="{{ asset('plugins/bootstrap-datepicker/css/datepicker3.css') }}" rel="stylesheet" type="text/css" media="screen">
@endsection

@section('content')


<div class="content-i">
    <div class="content-box">
        <div class="element-wrapper">
            <h6 class="element-header"> {{$galeria->id ? 'Editar Galeria' : 'Crear Galeria'}}
                <a href="{{ route('galery') }}" class="btn btn-primary float-right"><i
                    class="os-icon os-icon-chevron-left"></i> Volver
                </a>
            </h6>
                <div class="element-box element-box-usuarios">
                    <div class="row">
                        <div class="col-sm-12">
                            <h4>{{$galeria->id ? 'Editar Galeria' : 'Crear Galeria'}}</h4>
                        </div>
                    </div>
                    <hr>
                    <form action="{{ route('handleUpdateGalery', $galeria->id) }}" method="post" accept-charset="utf-8" enctype="multipart/form-data">
                        <div class="row">
                            <div class="col-sm-4">
                                <div class="form-group @if($errors->has('fecha')){{ 'has-error' }}@endif">
                                    <label for="">FECHA</label>
                                    <div id="datepicker-component" class="input-group date">
                                        <input type="text" class="form-control" name="fecha" id="fecha" value="@if(old('fecha') || empty($galeria->fecha)){{ old('fecha') }}@else{{ date('d/m/Y', strtotime($galeria->fecha)) }}@endif">
                                    </div>
                                </div>
                            </div>
                            <div class="col-sm-6">
                                <div class="form-group @if($errors->has('titulo')){{ 'has-error' }}@endif">
                                    <label for="">TÍTULO</label>
                                    <input type="text" class="form-control" name="titulo" id="titulo" value="@if(old('titulo')){{ old('titulo') }}@else{{ $galeria->titulo }}@endif">
                                </div>
                            </div>
                            <div class="col-sm-2">
                                <div class="form-group">
                                    <label for="">ACTIVA</label>
                                    <div class="checkbox check-success  ">
                                        <input type="hidden" name="activo" value="0">
                                        <input type="checkbox" @if($galeria->activo || old('activo')){{ 'checked="checked"' }}@endif value="1" name="activo" id="activo">
                                        <label for="activo">SI</label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <hr>

                        @foreach($galeria->imagenesGaleria as $imagen)
                        <div class="row">
                            <div class="col-sm-3">
                                @if($imagen->imagen != '')
                                <img src="{{ asset('uploads/galerias/'.$imagen->imagen) }}" class="img-fluid" alt="">
                                @endif
                            </div>

                            <div class="col-sm-9 text-right">
                                <a href="{{ route('editImage', array($galeria->id, $imagen->id)) }}" class="btn btn-success" title="editar registro"><i class="ti-pencil"></i></a>
                                    <a href="" class="btn btn-danger delete-register" data-toggle="modal" data-target="#modal-delete" title="eliminar registro" data-url="{{ route('deleteGaleryImage', array($galeria->id, $imagen->id)) }}"><i class="ti-trash"></i></a>
                                @if($imagen->orden != $galeria->imagenesGaleria->min('orden'))
                                    <a href="{{ route('aumentarPosicion', array($galeria->id, $imagen->id)) }}" class="btn btn-default"><i class="fa fa-chevron-up"></i></a>
                                @endif
                                @if($imagen->orden != $galeria->imagenesGaleria->max('orden'))
                                    <a href="{{ route('disminuirPosicion', array($galeria->id, $imagen->id)) }}" class="btn btn-default"><i class="fa fa-chevron-down"></i></a>
                                @endif
                            </div>
                        </div>
                        <hr>
                        @endforeach

                        <div class="well">

                            <div class="row" data-bind="foreach: registrosImagenes">

                                <div class="col-sm-11">
                                    <h5>Nueva imagen</h5>
                                    <div class="form-group">
                                        <label for="">Seleccionar imagen</label>
                                        <input type="file" data-bind="{attr: {name: 'imagenes[]' }}" ><br>
                                        <small class="text-danger">Las imágenes deben tener un tamaño máximo de 2Mb y tener una de las siguientes extensiones (jpeg,png,jpg,gif) </small>
                                    </div>
                                </div>
                                <div class="col-sm-1">
                                    <a href="javascript:void(0)" class="btn btn-danger float-right" data-bind="click: $parent.removeImagen"><span class="ti-trash"></span>Eliminar</a>
                                </div>
                                <hr>
                                <div class="col-sm-12">
                                    <h5>Texto imagen</h5>
                                    @foreach($idiomas as $idioma)
                                    <div class="form-group">
                                        <label for="">{{ strtoupper($idioma->code) }}</label>
                                        <input type="text" class="form-control" data-bind="{attr: {name: 'textos[{{ $idioma->id }}][]' }}">
                                    </div>
                                    @endforeach
                                </div>

                                <hr>
                            </div>
                            <div class="form-group">
                                <button type="button" class="btn btn-info" data-bind="click: addImagen, visible: registrosImagenes().length < 5">Añadir imagen</button>
                            </div>
                        </div>
                        <hr>
                        {{ csrf_field() }}
                        <button type="submit" class="btn btn-success">Guardar</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@include('back.common.modals.modal-delete')
@include('back.common.modals.modal-error')
@endsection

@section('js')
<script src="{{ asset('plugins/bootstrap-datepicker/js/bootstrap-datepicker.js') }}" type="text/javascript"></script>
<script src="{{ asset('plugins/knockout-3.3.0.js') }}"></script>
<script src="{{ asset('back/js/galeria/galeria.js') }}"></script>
<script>
    $('.delete-register').click(function(e) {
        var url = $(this).data('url');
        $('#delete_link').attr('href', url);
    });

    var idiomas_js = new Array();
    @foreach($idiomas as $key => $idioma)
    idiomas_js[{{ $key }}] = {{ $idioma->id }};
    @endforeach

    main(idiomas_js);

    @if (session('message'))
    mostrarMensajeError('{{ session('message') }}');
    @endif
</script>
@endsection
