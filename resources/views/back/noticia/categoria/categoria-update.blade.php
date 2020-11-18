@extends('back.common.main')

@section('content')
<div class="content-i">
    <div class="content-box">
        <div class="element-wrapper">
            <h6 class="element-header"> {{$categoria->id ? 'Editar Categoría' : 'Crear Categoría'}}
                <a href="{{ route('categoryNoticiasIndex') }}" class="btn btn-primary float-right"><i
                    class="os-icon os-icon-chevron-left"></i> Volver
                </a>
            </h6>
            <div class="element-box element-box-usuarios">
                <div class="row">
                    <div class="col-sm-12">
                        <h4>{{$categoria->id ? 'Editar Categoría' : 'Crear Categoría'}}</h4>
                    </div>
                </div>
                <hr>
                <form action="{{ action('Back\Noticia\CategoriaController@handleUpdate', $categoria->id) }}" method="post" accept-charset="utf-8">
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
                                <div class="tab-pane @if($key == 0){{ 'active' }}@endif" id="tab_{{ $language->code }}">
                                    <div class="col-sm-12">
                                        <div class="form-group">
                                            <label for="">NOMBRE CATEGORÍA</label>
                                            <input class="form-control" type="text" name="categorias[{{ $language->id }}][nombre]" value="@if(old('categorias.'.$language->id.'.nombre')){{ old('categorias.'.$language->id.'.nombre') }}@else{{ $categoria->noticiaCategoriaLang($language->id)->nombre }}@endif"></input>

                                        </div>
                                        <div class="form-group @if($errors->has('categorias.'.$language->id.'.slug')){{ 'has-error' }}@endif">
                                            <label for="">SLUG (Escribir una url válida)</label>
                                            <input class="form-control" type="text" name="categorias[{{ $language->id }}][slug]" value="@if(old('categorias.'.$language->id.'.slug')){{ old('categorias.'.$language->id.'.slug') }}@else{{ $categoria->noticiaCategoriaLang($language->id)->slug }}@endif" placeholder="Ejemplo: noticia-ejemplo_2"></input>
                                        </div>
                                    </div>
                                </div>
                                @endforeach
                                @if (count($errors) > 0)
                                    <div class="alert alert-danger">
                                        <p>Faltan campos por rellenar o algún campo no cumple las condiciones necesarias</p>
                                    </div>
                                @endif
                            </div> <!-- /tab-content -->
                        </div> <!-- /panel -->
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
@endsection

@section('js')
<script src="{{ asset('back/js/noticias/categoria.js') }}"></script>
<script>
    $(function() {
        main();
        @if (session('message'))
        mostrarMensajeError('{{ session('message') }}');
        @endif
    });
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
</script>
@endsection
