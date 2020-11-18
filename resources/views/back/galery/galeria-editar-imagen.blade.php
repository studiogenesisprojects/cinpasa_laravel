@extends('back.common.main')

@section('content')
<div class="content-i">
    <div class="content-box">
        <div class="element-wrapper">
            <h6 class="element-header"> Editar Imagen
                <a href="{{ route('updateGalery', $galeria_id) }}" class="btn btn-primary float-right"><i
                    class="os-icon os-icon-chevron-left"></i> Volver
                </a>
            </h6>
                <div class="element-box element-box-usuarios">
                    <div class="row">
                        <div class="col-sm-12">
                            <h4>Editar Imagen</h4>
                        </div>
                    </div>
                    <hr>
                    <form action="{{ route('handleUpdateImage', array($galeria_id, $imagen->id)) }}" method="post" accept-charset="utf-8" enctype="multipart/form-data" id="formularioGaleria">
                        <div class="well">
                            <div class="row">
                                <div class="col-sm-3">
                                    @if($imagen->imagen != '')
                                        <img src="{{ asset('uploads/galerias/'.$imagen->imagen) }}" class="img-fluid" alt="">
                                    @endif
                                </div>
                                <div class="col-sm-9">
                                    <div class="row">
                                        <div class="col-sm-12">
                                            <h4>Añadir imagen</h4>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col-sm-12">
                                            <div class="form-group">
                                                <label for="">Seleccionar imagen</label>
                                                <input type="file" name="img_new" id="img_new">
                                            </div>
                                            <hr>
                                            <h5>Texto imagen</h5>
                                            @foreach($idiomas as $idioma)
                                                <div class="form-group">
                                                    <label for="">{{ strtoupper($idioma->code) }}</label>
                                                    <input type="text" class="form-control" name="textos[{{ $idioma->id }}][texto]" value="@if( old('textos.'.$idioma->id) || !$imagen->imagenesTextoIdioma($idioma->id) ){{ old('textos.'.$idioma->id) }}@else{{ $imagen->imagenesTextoIdioma($idioma->id)->texto }}@endif">
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
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

    @include('back.common.modals.modal-delete')
    @include('back.common.modals.modal-error')
@endsection

@section('js')
    <script src="{{ asset('back/js/galeria/galeria-imagen.js') }}"></script>
    <script>
        $(function() {
            main();
            @if (session('message'))
                mostrarMensajeError('{{ session('message') }}');
            @endif
        });
    </script>
@endsection
