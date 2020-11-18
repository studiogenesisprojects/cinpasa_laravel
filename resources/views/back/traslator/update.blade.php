@extends('back.common.main')

@section('content')
<div class="content-i">
    <div class="content-box">
        <div class="element-wrapper p-b-1rem">
            <h6 class="element-header">Traducciones {{ $slug }}

                <a href="{{ action('Back\Traslator\TraslatorController@index') }}"
                class="btn btn-white float-right ml-3"><i class="os-icon os-icon-chevron-left"></i> Volver</a>
                <a href="{{ action('Back\Traslator\TraslatorController@newTranslate', $slug) }}"
                class="btn btn-primary float-right ml-10"><i class="fa fa-plus"></i> Nuevo Campo</a>
            </h6>

            <form action="{{ action('Back\Traslator\TraslatorController@handleTraducciones', $slug) }}" method="post" accept-charset="utf-8" enctype="multipart/form-data" id="formularioCatalogo">
            @csrf
            <div class="row sm-flex-column-reverse">
                <div class="col-lg-12 col-md-12 col-12">
                    <div class="element-box">
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
                                        @foreach($line as $index=>$linea)
                                        <div class="col-sm-12" id="{{$linea->key}}">
                                            <div class="form-group">
                                                <label for="">{{ $linea->key }}</label>

                                                    @if(!empty($linea->text[$language->code]))
                                                        @if(preg_match('/^<([a-z]+)([^<]+)*(?:>(.*)<\/\1>|\s+\/>)$/', $linea->text[$language->code]))
                                                            <textarea class="form-control item" name="textos[{{ $linea->key }}][{{ $language->code }}]">{!! $linea->text[$language->code] !!}</textarea>
                                                        @else
                                                        <input type="text" class="form-control"
                                                            name="textos[{{ $linea->key }}][{{ $language->code }}]"
                                                            value="{{ $linea->text[$language->code] }}">
                                                        @endif
                                                    @else
                                                        @if(!empty($languages[$key-1]) && preg_match('/^<([a-z]+)([^<]+)*(?:>(.*)<\/\1>|\s+\/>)$/', $linea->text[$languages[$key-1]->code]))
                                                            <textarea class="form-control item" name="textos[{{ $linea->key }}][{{ $language->code }}]"></textarea>
                                                        @else
                                                            <input type="text" class="form-control" name="textos[{{ $linea->key }}][{{ $language->code }}]" value="">
                                                        @endif
                                                    @endif
                                                </div>
                                            </div>
                                            @endforeach
                                        </div>
                                        @endforeach
                                    </div> <!-- /tab-content -->
                                </div> <!-- /panel -->
                            </div>
                        </div>
                    </div>
                </div>
                <hr>
                <button type="submit" class="btn btn-success" id="guardar">Guardar</button>
            </form>
        </div>
    </div>
</div>

@endsection
@section('js')
<script src="{{ asset('back-admin/bowser_components/plugins/ckeditor_4.6.1_full/ckeditor/ckeditor.js') }}"></script>
<script>
   $(document).ready(() => {
        CKEDITOR.replaceAll('item');
    })
</script>
@endsection
