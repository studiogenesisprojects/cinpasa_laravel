@extends('back.common.main')
@section('css')
    <link rel="stylesheet" type="text/css" href="{{asset('plugins/colpick-master/css/colpick.css')}}">

@endsection
@section('content')
<div class="content-box">
    <div class="element-wrapper" id="app">
        <h6 class="element-header">Color
            <a href="{{route('colorIndex')}}" class="btn btn-white float-right"><i
                class="os-icon os-icon-chevron-left"></i> Volver</a>
            </h6>
            <div class="row">
                <div class="col-sm-12">
                    <div class="element-wrapper">
                        <div class="element-box">
                            <form id="formValidate" novalidate="true" method="post"
                            action="{{route('colorHandleUpdate', $color->id)}}">
                            {{ csrf_field() }}
                            <input id="rgb_color" name="rgb_color" type="hidden" value="">
                            <input id="hex_color" name="hex_color" type="hidden" value="">
                            <div class="element-info">
                                <div class="element-info-with-icon">
                                    <div class="element-info-icon">
                                        <div class="ti-layout-cta-right"></div>
                                    </div>
                                    <div class="element-info-text">
                                        <h5 class="element-inner-header">Información del color</h5>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-11">
                                    <div class="form-group">
                                        <label for="">Nombre del color</label>
                                        <input type="text" name="name" class="form-control" value="{{$color->name}}" data-error="Introduzca un nombre" required>
                                        <div class="help-block form-text with-errors form-control-feedback"></div>
                                    </div>
                                </div>
                                <div class="col-sm-1">
                                    <div class="form-group">
                                        <label for="">Activo</label><br>
                                        <input type="checkbox" name="active" {{$color->active ? 'checked' : ''}} value="1">
                                    </div>
                                </div>
                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <label for="">Pantone del color</label>
                                        <input type="text" name="pantone" class="form-control" value="{{$color->pantone}}" data-error="Introduzca un pantone" required>
                                        <div class="help-block form-text with-errors form-control-feedback"></div>
                                    </div>
                                </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-7">
                                        <label for="">Selecciona los materiales</label>
                                        <div class="row">
                                            @foreach ($materials as $material)
                                                <div class="col-sm-1">
                                                    <label for="">{{$material->name}}:</label><br>
                                                    <input type="checkbox" name="materials[]" value="{{$material->id}}"
                                                    @if($material->hasColor($material->id)) checked @endif>
                                                </div>
                                            @endforeach
                                        </div>
                                    </div>
                                    <div class="col-sm-4">
                                        <div class="row">
                                            <div class="col-sm-12">
                                                <label for="">Selecciona el color del material</label>
                                                <div id="example-flat"></div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            {{-- Error messages --}}
                                @if ($errors->any())
                                    <div class="alert alert-danger" role="alert">
                                        <ul>
                                            @foreach ($errors->all() as $error)
                                                <li>{{ $error }}</li>
                                            @endforeach
                                        </ul>
                                    </div>
                                @elseif (session('error_message'))
                                    <div class="alert alert-danger" role="alert">
                                        {{ session('error_message') }}
                                    </div>
                                @elseif (session('message'))

                                    <div class="alert alert-success" role="alert">
                                        {{ session('message') }}
                                    </div>
                                @endif
                            {{-- End error messages --}}
                            <div class="form-buttons-w">
                                <button class="btn btn-success" type="submit">Guardar</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection

@section('js')
    <script type="text/javascript" src="{{asset('plugins/colpick-master/js/colpick.js')}}"></script>
    <script>
    $('#example-flat').colpick({
        color:'{{$color->hex_color}}',
        flat:true,
        rgb:'',
        hex:'',
        layout:'full',
        onChange:function(hsb,rgb,hex){
            rgb = $.colpick.hsbToRgb(hsb)
            hex = $.colpick.hsbToHex(hsb)
            $('#rgb_color').val("R:" + rgb.r + " G:" + rgb.g + " B:" + rgb.b)
            $('#hex_color').val(hex)
            // console.log($('#rgb_color').val());
            // console.log($('#hex_color').val());
        },
        onSubmit:function(hsb,rgb,hex){
            rgb = $.colpick.hsbToRgb(hsb)
            hex = $.colpick.hsbToHex(hsb)
            $('#rgb_color').val("R:" + rgb.r + " G:" + rgb.g + " B:" + rgb.b)
            $('#hex_color').val(hex)
            // console.log($('#rgb_color').val());
            // console.log($('#hex_color').val());
        },
        onBeforeShow:function(hsb,rgb,hex){
            console.log("go");

            rgb = $.colpick.hsbToRgb(hsb)
            hex = $.colpick.hsbToHex(hsb)
            $('#rgb_color').val("R:" + rgb.r + " G:" + rgb.g + " B:" + rgb.b)
            $('#hex_color').val(hex)
            // console.log($('#rgb_color').val());
            // console.log($('#hex_color').val());
        },
    });

    </script>
@endsection
