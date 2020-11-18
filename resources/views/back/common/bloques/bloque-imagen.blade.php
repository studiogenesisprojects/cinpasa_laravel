<div class="well bloque-{{ $idioma }}" data-pos="@if(!empty($orden)){{ $orden }}@else{{ $index }}@endif" data-lang="{{ $idioma }}">
    <input type="hidden" name="bloques[{{ $idioma }}][{{ $index }}][imagenes][id]" value="{{ $bloque_id }}">
    <input type="hidden" class="orden" name="bloques[{{ $idioma }}][{{ $index }}][imagenes][orden]" value="@if(!empty($orden)){{ $orden }}@else{{ $index }}@endif">
    <div class="row">
        <div class="col-sm-2">
            <h4>Bloque imagen</h4>
        </div>
        <div class="col-sm-4">
            <div class="form-group">
                <label for="">CLASE</label>
                <input type="text" class="form-control" name="bloques[{{ $idioma }}][{{ $index }}][imagenes][clase]" value="@if(old('bloques.'.$idioma.'.'.$index.'.imagenes.clase')){{ old('bloques.'.$idioma.'.'.$index.'.imagenes.clase') }}@elseif(!empty($bloque_datos)){{ $bloque_datos->clase }}@else{{ '' }}@endif">
            </div>
        </div>
        <div class="col-sm-4">
            <div class="form-group">
                <label for="">ALT</label>
                <input type="text" class="form-control" name="bloques[{{ $idioma }}][{{ $index }}][imagenes][alt]" value="@if(old('bloques.'.$idioma.'.'.$index.'.imagenes.alt')){{ old('bloques.'.$idioma.'.'.$index.'.imagenes.alt') }}@elseif(!empty($bloque_datos)){{ $bloque_datos->alt }}@else{{ '' }}@endif">
            </div>
        </div>
        <div class="col-sm-2">
            <div class="form-group">
                <label for="">ACTIVO</label>
                <div class="checkbox check-success  ">
                    <input type="hidden" name="bloques[{{ $idioma }}][{{ $index }}][imagenes][activo]" value="0">
                    <input type="checkbox" @if(old('bloques.'.$idioma.'.'.$index.'.imagenes.activo') == '1' || (!empty($bloque_datos) && $bloque_datos->activo == '1')){{ 'checked="checked"' }}@endif value="1" id="activo-{{ $idioma }}-{{ $index }}" name="bloques[{{ $idioma }}][{{ $index }}][imagenes][activo]">
                    <label for="activo-{{ $idioma }}-{{ $index }}">SI</label>
                </div>
            </div>
        </div>
        <div class="col-sm-2">
            <div class="form-group text-right">
                <p><label>ACCIONES</label></p>
                {{-- <a href="" class="btn btn-info"><i class="fa fa-chevron-up"></i></a>
                <a href="" class="btn btn-info"><i class="fa fa-chevron-down"></i></a> --}}
                <a href="" class="btn btn-info"><i class="ti-arrows-vertical"></i></a>
                <a href="" data-toggle="modal" data-target="#eliminar-bloque" class="btn btn-danger eliminar-bloque"><i class="ti-trash"></i></a>
            </div>
        </div>
    </div>
    <div class="row m-b-10">
        <div class="col-sm-12 contenedor-imagen">
            @if(!empty($bloque_datos->imagen))
                <img src="{{ asset('uploads/noticias/noticias/imagenes/'.$bloque_datos->imagen) }}" alt="" class="pull-left m-r-20 img-responsive img-bloque">
            @endif
            <div class="form-group">
                <label for="">IMAGEN</label>
                <input type="file" name="bloques[{{ $idioma }}][{{ $index }}][imagenes][foto]">
                @if(!empty($bloque_datos->imagen))
                    <span class="help-block"><a href="" class="text-danger delete_block_image" data-url="{{ action('Back\Noticia\NoticiaController@deleteBloqueImage', [array_search ('Imagen', config('app.bloques_contenido')), $bloque_datos->id, 'imagen']) }}"><i class="fa fa-trash"></i> Eliminar imagen</a></span>
                @endif
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-12">
            <div class="form-group">
                <label for="">PIE DE FOTO</label>
                <input type="text" class="form-control" name="bloques[{{ $idioma }}][{{ $index }}][imagenes][pie_foto]" value="@if(old('bloques.'.$idioma.'.'.$index.'.imagenes.pie_foto')){{ old('bloques.'.$idioma.'.'.$index.'.imagenes.pie_foto') }}@elseif(!empty($bloque_datos)){{ $bloque_datos->pie_foto }}@else{{ '' }}@endif">
            </div>
        </div>
    </div>
</div>
