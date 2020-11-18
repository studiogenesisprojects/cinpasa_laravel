<div class="well bloque-{{ $idioma }}" data-pos="@if(!empty($orden)){{ $orden }}@else{{ $index }}@endif" data-lang="{{ $idioma }}">
    <input type="hidden" name="bloques[{{ $idioma }}][{{ $index }}][galerias][id]" value="{{ $bloque_id }}">
    <input type="hidden" class="orden" name="bloques[{{ $idioma }}][{{ $index }}][galerias][orden]" value="@if(!empty($orden)){{ $orden }}@else{{ $index }}@endif">
    <div class="row">
        <div class="col-sm-2">
            <h4>Bloque galería</h4>
        </div>
        <div class="col-sm-4">
            <div class="form-group">
                <label for="">CLASE</label>
                <input type="text" class="form-control" name="bloques[{{ $idioma }}][{{ $index }}][galerias][clase]" value="@if(old('bloques.'.$idioma.'.'.$index.'.galerias.clase')){{ old('bloques.'.$idioma.'.'.$index.'.galerias.clase') }}@elseif(!empty($bloque_datos)){{ $bloque_datos->clase }}@else{{ '' }}@endif">
            </div>
        </div>
        <div class="col-sm-4">
            <div class="form-group">
                <label for="">ACTIVO</label>
                <div class="checkbox check-success  ">
                    <input type="hidden" name="bloques[{{ $idioma }}][{{ $index }}][galerias][activo]" value="0">
                    <input type="checkbox"  @if(old('bloques.'.$idioma.'.'.$index.'.galerias.activo') == '1' || (!empty($bloque_datos) && $bloque_datos->activo == '1')){{ 'checked="checked"' }}@endif value="1" id="activo-{{ $idioma }}-{{ $index }}" name="bloques[{{ $idioma }}][{{ $index }}][galerias][activo]">
                    <label for="activo-{{ $idioma }}-{{ $index }}">SI</label>
                </div>
            </div>
        </div>
        <div class="col-sm-2">
            <div class="form-group text-right">
                <p><label>ACCIONES</label></p>
                {{-- <a href="" class="btn btn-info"><i class="fa fa-chevron-up"></i></a>
                <a href="" class="btn btn-info"><i class="fa fa-chevron-down"></i></a>   --}}
                <a href="" class="btn btn-info"><i class="ti-arrows-vertical"></i></a>
                <a href="" data-toggle="modal" data-target="#eliminar-bloque" class="btn btn-danger eliminar-bloque"><i class="ti-trash"></i></a>
            </div>
        </div>
    </div>
    <div class="row m-b-10">
        <div class="col-sm-12">
            <div class="form-group">
                <label for="">SELECCIONAR GALERÍA</label>
                <select name="bloques[{{ $idioma }}][{{ $index }}][galerias][galeria_id]"  class="form-control">
                    @foreach($galerias as $galeria)
                        <option value="{{ $galeria->id }}" @if(old('bloques.'.$idioma.'.'.$index.'.galerias.galeria_id') == $galeria->id || (!empty($bloque_datos) && $bloque_datos->galeria_id == $galeria->id)){{ 'selected' }}@endif>{{ $galeria->titulo }}</option>
                    @endforeach
                </select>
            </div>
        </div>
    </div>
    <div class="row">
        <div class="col-sm-12">
            <div class="form-group">
                <label for="">PIE DE GALERÍA</label>
                <input type="text" class="form-control" name="bloques[{{ $idioma }}][{{ $index }}][galerias][pie_galeria]" value="@if(old('bloques.'.$idioma.'.'.$index.'.galerias.pie_galeria')){{ old('bloques.'.$idioma.'.'.$index.'.galerias.pie_galeria') }}@elseif(!empty($bloque_datos)){{ $bloque_datos->pie_galeria }}@else{{ '' }}@endif">
            </div>
        </div>
    </div>
</div>
