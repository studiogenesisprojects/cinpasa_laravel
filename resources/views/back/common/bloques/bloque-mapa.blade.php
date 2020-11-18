<div class="well bloque-{{ $idioma }}" data-pos="@if(!empty($orden)){{ $orden }}@else{{ $index }}@endif" data-lang="{{ $idioma }}">
    <input type="hidden" name="bloques[{{ $idioma }}][{{ $index }}][mapas][id]" value="{{ $bloque_id }}">
    <input type="hidden" class="orden" name="bloques[{{ $idioma }}][{{ $index }}][mapas][orden]" value="@if(!empty($orden)){{ $orden }}@else{{ $index }}@endif">
    <div class="row">
        <div class="col-sm-2">
            <h4>Bloque mapa</h4>
        </div>
        <div class="col-sm-4">
            <div class="form-group">
                <label for="">CLASE</label>
                <input type="text" class="form-control" name="bloques[{{ $idioma }}][{{ $index }}][mapas][clase]" value="@if(old('bloques.'.$idioma.'.'.$index.'.mapas.clase')){{ old('bloques.'.$idioma.'.'.$index.'.mapas.clase') }}@elseif(!empty($bloque_datos)){{ $bloque_datos->clase }}@else{{ '' }}@endif">
            </div>
        </div>
        <div class="col-sm-4">
            <div class="form-group">
                <label for="">ACTIVO</label>
                <div class="checkbox check-success  ">
                    <input type="hidden" name="bloques[{{ $idioma }}][{{ $index }}][mapas][activo]" value="0">
                    <input type="checkbox" @if(old('bloques.'.$idioma.'.'.$index.'.mapas.activo') == '1' || (!empty($bloque_datos) && $bloque_datos->activo == '1')){{ 'checked="checked"' }}@endif value="1" id="activo-{{ $idioma }}-{{ $index }}" name="bloques[{{ $idioma }}][{{ $index }}][mapas][activo]">
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
        <div class="col-sm-4">
            <div class='embed-container'>
                <div class="mapa-bloque" id="map-canvas-{{ $idioma }}-{{ $index }}">
                    {{-- Mapa del bloque --}}
                </div>
            </div>
        </div>
        <div class="col-sm-8">
            <div class="row">
                <div class="col-sm-8">
                    <div class="form-group">
                        <label for="">BUSCA POR DIRECCIÓN</label>
                        <input type="text" id="direccion-{{ $idioma }}-{{ $index }}" class="form-control" name="bloques[{{ $idioma }}][{{ $index }}][mapas][direccion]" placeholder="Introduce una dirección..." value="@if(old('bloques.'.$idioma.'.'.$index.'.mapas.direccion')){{ old('bloques.'.$idioma.'.'.$index.'.mapas.direccion') }}@elseif(!empty($bloque_datos)){{ $bloque_datos->direccion }}@else{{ '' }}@endif">
                    </div>
                </div>
                <div class="col-sm-4">
                    <div class="form-group">
                        <label for="">CIUDAD</label>
                        <input type="text" id="ciudad-{{ $idioma }}-{{ $index }}" class="form-control" name="bloques[{{ $idioma }}][{{ $index }}][mapas][ciudad]" value="@if(old('bloques.'.$idioma.'.'.$index.'.mapas.ciudad')){{ old('bloques.'.$idioma.'.'.$index.'.mapas.ciudad') }}@elseif(!empty($bloque_datos)){{ $bloque_datos->ciudad }}@else{{ '' }}@endif" >
                    </div>
                </div>
            </div>
            <div class="row">
                <div id="type-selector-{{ $idioma }}-{{ $index }}" class="controls" style=" display : none">
                    <input type="radio" name="type" id="changetype-address-{{ $idioma }}-{{ $index }}" checked="checked">
                </div>
            </div>
            <div class="row">
                <div class="col-sm-5">
                    <div class="form-group">
                        <label for="">LATITUD</label>
                        <input type="text" id="latitud-{{ $idioma }}-{{ $index }}" class="form-control" name="bloques[{{ $idioma }}][{{ $index }}][mapas][latitud]" value="@if(old('bloques.'.$idioma.'.'.$index.'.mapas.latitud')){{ old('bloques.'.$idioma.'.'.$index.'.mapas.latitud') }}@elseif(!empty($bloque_datos)){{ $bloque_datos->latitud }}@else{{ '0' }}@endif">
                    </div>
                </div>
                <div class="col-sm-5">
                    <div class="form-group">
                        <label for="">LONGITUD</label>
                        <input type="text" id="longitud-{{ $idioma }}-{{ $index }}" class="form-control" name="bloques[{{ $idioma }}][{{ $index }}][mapas][longitud]" value="@if(old('bloques.'.$idioma.'.'.$index.'.mapas.longitud')){{ old('bloques.'.$idioma.'.'.$index.'.mapas.longitud') }}@elseif(!empty($bloque_datos)){{ $bloque_datos->longitud }}@else{{ '0' }}@endif">
                    </div>
                </div>
                <div class="col-sm-2">
                    <div class="form-group">
                        <label for="">COORDENADAS</label>
                        <button type="button" id="buscar-coordenadas-{{ $idioma }}-{{ $index }}" class="btn btn-info">Buscar</button>
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-6 contenedor-imagen">
                    @if(!empty($bloque_datos->imagen_puntero))
                        <img src="{{ asset('uploads/noticias/noticias/imagenes/'.$bloque_datos->imagen_puntero) }}" alt="" class="pull-left m-r-20 img-responsive img-bloque">
                    @endif
                    <div class="form-group">
                        <label for="">IMAGEN PUNTERO</label>
                        <input type="file" name="bloques[{{ $idioma }}][{{ $index }}][mapas][puntero]">
                        @if(!empty($bloque_datos->imagen_puntero))
                            <span class="help-block"><a href="" class="text-danger delete_block_image" data-url="{{ action('Back\Noticia\NoticiaController@deleteBloqueImage', [array_search ('Mapa', config('app.bloques_contenido')), $bloque_datos->id, 'imagen_puntero']) }}"><i class="fa fa-trash"></i> Eliminar imagen</a></span>
                        @endif
                    </div>
                </div>
                <div class="col-sm-6">
                    <div class="form-group">
                        <label for="">TEXTO PUNTERO</label>
                        <textarea name="bloques[{{ $idioma }}][{{ $index }}][mapas][texto_puntero]"  rows="2" class="form-control" >@if(old('bloques.'.$idioma.'.'.$index.'.mapas.texto_puntero')){{ old('bloques.'.$idioma.'.'.$index.'.mapas.texto_puntero') }}@elseif(!empty($bloque_datos)){{ $bloque_datos->texto_puntero }}@else{{ '' }}@endif</textarea>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-12">
            <div class="form-group">
                <label for="">PIE DE MAPA</label>
                <input type="text" class="form-control" name="bloques[{{ $idioma }}][{{ $index }}][mapas][pie_mapa]" value="@if(old('bloques.'.$idioma.'.'.$index.'.mapas.pie_mapa')){{ old('bloques.'.$idioma.'.'.$index.'.mapas.pie_mapa') }}@elseif(!empty($bloque_datos)){{ $bloque_datos->pie_mapa }}@else{{ '' }}@endif">
            </div>
        </div>
    </div>
</div>
