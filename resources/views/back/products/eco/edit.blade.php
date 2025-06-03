@extends('back.common.main')
@section('content')
<div class="content-box">
    <div class="element-wrapper" id="app">
        <h6 class="element-header">Logos Eco Friendly
            <a href="{{route('eco.index')}}" class="btn btn-white float-right"><i lass="os-icon os-icon-chevron-left"></i> Volver</a>
        </h6>
        <div class="row">
            <div class="col-sm-12">
                <div class="element-wrapper">
                    <div class="element-box">
                        <form id="formValidate" novalidate="true" method="post"  enctype="multipart/form-data" action="{{route('eco.update', $eco->id)}}">
                            {{ csrf_field() }}
                        @method('patch')
                            
                            <div class="element-info">
                                <div class="element-info-with-icon">
                                    <div class="element-info-icon">
                                        <div class="ti-layout-cta-right"></div>
                                    </div>
                                    <div class="element-info-text">
                                        <h5 class="element-inner-header">Logo Eco Friendly</h5>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="form-group">
                                <label for="">Logo</label>
                                <input type="file" name="image" class="form-control" data-error="Introduzca una imagen">
                                <div class="help-block form-text with-errors form-control-feedback"></div>
                                @if($eco->image)<img src="{{Storage::url(config('app.path_uploads.eco') . "/" . $eco->image)}}" class="rounded mt-3 d-block" alt="{{ $eco->lang()->name }}" style="width: 10%;">@endif
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
                                        @foreach($languages as $key => $idioma)
                                        <div class="tab-pane @if($loop->first){{ 'active' }}@endif" id="tab_{{$idioma->code}}">
                                            <input type="hidden" name="languages[{{ $idioma->id }}][language_id]" value="{{$idioma->id}}">
                                            <h5>{{$idioma->name}}</h5>
                                            <div class="row">
                                                <div class="col-sm-12">
                                                    <div class="form-group">
                                                        <label for="">Nombre</label>
                                                        <input id="name-{{ $key }}" type="text" class="form-control title" name="languages[{{ $idioma->id }}][name]" value="{{$eco->lang($idioma->id)->name ?? '' }}" required>
                                                    </div>
                                                </div>
                                                
                                            </div>
                                        </div>
                                        @endforeach
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
@include('back.common.modals.modal-delete')

@endsection

@section('js')
@endsection
