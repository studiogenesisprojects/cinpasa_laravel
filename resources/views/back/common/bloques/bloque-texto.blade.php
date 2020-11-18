<div class="well bloque-{{ $idioma }}" data-pos="@if(!empty($orden)){{ $orden }}@else{{ $index }}@endif" data-lang="{{ $idioma }}">
    <input type="hidden" name="bloques[{{ $idioma }}][{{ $index }}][textos][id]" value="{{ $bloque_id }}">
    <input type="hidden" class="orden" name="bloques[{{ $idioma }}][{{ $index }}][textos][orden]" value="@if(!empty($orden)){{ $orden }}@else{{ $index }}@endif">
    <div class="row">
        <div class="col-sm-10">
            <h4>Bloque texto</h4>
        </div>
            <div class="col-sm-2">
            <div class="form-group text-right">
                <p><label>ACCIONES</label></p>
                {{-- <a href="" class="btn btn-info"><i class="fa fa-chevron-up"></i></a>
                <a href="" class="btn btn-info"><i class="fa fa-chevron-down"></i></a> --}}
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-4">
            <div class="form-group">
                <label for="">CLASE</label>
                <input type="text" class="form-control" name="bloques[{{ $idioma }}][{{ $index }}][textos][clase]" value="@if(old('bloques.'.$idioma.'.'.$index.'.textos.clase')){{ old('bloques.'.$idioma.'.'.$index.'.textos.clase') }}@elseif(!empty($bloque_datos)){{ $bloque_datos->clase }}@else{{ '' }}@endif">
            </div>
        </div>
        <div class="col-sm-6">
            <div class="form-group">
                <label for="">ACTIVO</label>
                <div class="checkbox check-success  ">
                    <input type="hidden" name="bloques[{{ $idioma }}][{{ $index }}][textos][activo]" value="0">
                    <input type="checkbox" @if(old('bloques.'.$idioma.'.'.$index.'.textos.activo') == '1' || (!empty($bloque_datos) && $bloque_datos->activo == '1')){{ 'checked="checked"' }}@endif value="1" id="activo-{{ $idioma }}-{{ $index }}" name="bloques[{{ $idioma }}][{{ $index }}][textos][activo]">
                    <label for="activo-{{ $idioma }}-{{ $index }}">SI</label>
                </div>
            </div>
        </div>
        <div class="col-sm-2">
            <div class="form-group text-right mt-4">
                <a href="" class="btn btn-info"><i class="ti-arrows-vertical"></i></a>
                <a href="" data-toggle="modal" data-target="#eliminar-bloque" class="btn btn-danger eliminar-bloque"><i class="ti-trash"></i></a>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-12">
            <div class="form-group">
                <label for="">TEXTO</label>
                <textarea name="bloques[{{ $idioma }}][{{ $index }}][textos][texto]" id="bloques-{{ $idioma }}-{{ $index }}-textos-texto" cols="30" rows="20" class="form-control bloque-texto">@if(old('bloques.'.$idioma.'.'.$index.'.textos.texto')){{ old('bloques.'.$idioma.'.'.$index.'.textos.texto') }}@elseif(!empty($bloque_datos)){{ $bloque_datos->texto }}@else{{ '' }}@endif</textarea>
            </div>
        </div>
    </div>
</div>
