@extends('back.common.main')
@section('content')

<div class="content-i">
    <div class="content-box">
        <div class="element-wrapper">
            <h6 class="element-header">Color de acabados
                    <a href="{{route('colores-acabados.index')}}" class="btn btn-white float-right"><i
                    class="os-icon os-icon-chevron-left"></i> Volver</a>
            </h6>
        <div class="element-wrapper">
            <div class="element-box">
                <h5 class="form-header">Editar color</h5>
                <hr>
                <form action="{{ route('colores-acabados.update', $color->id) }}" method="POST">
                    @csrf
                    @method('PATCH')
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
                                    <input type="hidden" name="languages[{{ $language->id }}][language_id]" value="{{$language->id}}">
                                    <div class="row">
                                        <div class="col-sm-12">
                                            <div class="form-group">
                                                <label for="">Nombre del color</label>
                                                <input value="{{ $color->lang($language->id)->name }}" type="text" name="colores[{{ $language->id }}][name]" class="form-control" data-error="Introduzca un nombre" required>
                                                <div class="help-block form-text with-errors form-control-feedback"></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                @endforeach
                            </div> <!-- /tab-content -->
                        </div>
                        <div class="col-12">
                            <button type="submit" class="btn btn-primary">Actualizar</button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
