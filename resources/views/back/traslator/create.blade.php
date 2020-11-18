@extends('back.common.main')

@section('content')
<div class="content-i">
    <div class="content-box">
        <div class="element-wrapper p-b-1rem">
            <h6 class="element-header">Traducciones
                <a href="{{ action('Back\Traslator\TraslatorController@index') }}" class="btn btn-white float-right"><i class="os-icon os-icon-chevron-left"></i> Volver</a>
            </h6>

            {{-- Error messages --}}
            @if (session('error_message'))
            <div class="alert alert-danger">
                {{ session('error_message') }}
            </div>
            @endif
            @if (session('message'))
            <div class="alert alert-success">
                <ul>
                    @if(is_array(session('message')))
                    @foreach (session('message') as $message)
                    <li>{!! $message !!}</li>
                    @endforeach
                    @else
                    <li>{!! session('message') !!}</li>
                    @endif
                </ul>
            </div>
            @endif
            @if (count($errors) > 0)
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
            @endif
            <div class="row">
                <div class="col-sm-12">
                    <div class="element-wrapper">
                        <div class="element-box">
                            <h4>Nueva traducción</h4>
                            <form action="{{ action('Back\Traslator\TraslatorController@handleUpdateCreate') }}" method="post" accept-charset="utf-8" enctype="multipart/form-data" id="formularioCatalogo">
                                {{ csrf_field() }}
                                <div class="row">
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label for="">Texto Enriquecido</label>
                                            <div class="radio radio-success m-t-0">
                                                <input type="radio" value="1" class="enriquecido" name="enriquecido" id="yes">
                                                <label for="yes">SI</label>
                                                <input type="radio" value="0" class="enriquecido" name="enriquecido" id="no" checked>
                                                <label for="no">NO</label>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label for="">Grupo</label>
                                            <input type="text" class="form-control" name="slug" value="{{$slug}}">
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label for="">Key</label>
                                            <input type="text" class="form-control" name="key">
                                        </div>
                                    </div>
                                </div>
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
                                                        <label for="">Item</label>
                                                        <textarea class="form-control" name="textos[{{ $language->code }}]"></textarea>
                                                    </div>
                                                </div>
                                            </div>
                                            @endforeach
                                        </div> <!-- /tab-content -->
                                    </div> <!-- /panel -->
                                </div>
                                <div id="errores"></div>
                                <hr>
                                <!-- <button type="button" class="btn btn-warning">previsualizar</button> -->
                                <button type="submit" class="btn btn-success" id="guardar">Guardar</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
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
<script type="text/javascript">
    $(document).on('click','#yes', function(e){
        $("textarea").addClass('item');
        CKEDITOR.replaceAll('item');
    });
    $(document).on('click','#no', function(e){
        for(name in CKEDITOR.instances)
        {
            CKEDITOR.instances[name].destroy()
        }
    });
</script>
@endsection
