@extends('back.common.main')

@section('content')
<div class="content-i">
    <div class="content-box">
        <div class="element-wrapper">
            <h6 class="element-header"> {{$redactor->id ? 'Editar Redactor' : 'Crear Redactor'}}
                <a href="{{ route('redactoresIndex') }}" class="btn btn-primary float-right"><i
                    class="os-icon os-icon-chevron-left"></i> Volver
                </a>
            </h6>
            <div class="element-box element-box-usuarios">
                <div class="row">
                    <div class="col-sm-12">
                        <h4>{{$redactor->id ? 'Editar Redactor' : 'Crear Redactor'}}</h4>
                    </div>
                </div>
                <hr>
                <form action="{{ route('redactoresHandleUpdate', $redactor->id) }}" method="post" accept-charset="utf-8" enctype="multipart/form-data">
                    <div class="row">
                        <div class="col-sm-4">
                            @if (!empty($redactor->imagen))
                                <img src="{{ asset('uploads/noticias/redactores/' . $redactor->imagen) }}" alt="" class="img-fluid">
                            @endif
                        </div>
                        <div class="col-sm-8">
                            <label for="foto_redactor">IMAGEN</label>
                                @if (!empty($redactor->imagen))
                                <a href="{{ action('Back\Noticia\RedactorController@deleteImage', $redactor->id) }}" class="btn btn-danger float-right"><i class="ti-trash"></i> Eliminar imagen</a>
                                @endif
                            <div class="form-group">
                                <input type="file" name="foto_redactor">
                            </div>
                        </div>
                    </div>
                    <hr>
                    <div class="row">
                        <div class="col-sm-6">
                            <div class="form-group @if($errors->has('nombre')){{ 'has-error' }}@endif">
                                <label for="nombre">NOMBRE</label>
                                <input type="text" name="nombre" class="form-control" value="@if(old('nombre')){{ old('nombre') }}@else{{ $redactor->nombre }}@endif"></input>
                            </div>
                        </div>
                        <div class="col-sm-6">
                            <div class="form-group @if($errors->has('email')){{ 'has-error' }}@endif">
                                <label for="email">E-MAIL</label>
                                <input type="email" name="email" class="form-control" value="@if(old('email')){{ old('email') }}@else{{ $redactor->email }}@endif"></input>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-3">
                            <div class="form-group @if($errors->has('facebook')){{ 'has-error' }}@endif">
                                <label for="facebook">FACEBOOK</label>
                                <input type="text" name="facebook" class="form-control" value="@if(old('facebook')){{ old('facebook') }}@else{{ $redactor->facebook }}@endif"></input>
                            </div>
                        </div>
                        <div class="col-sm-3">
                            <div class="form-group @if($errors->has('twitter')){{ 'has-error' }}@endif">
                                <label for="twitter">TWITTER</label>
                                <input type="text" name="twitter" class="form-control" value="@if(old('twitter')){{ old('twitter') }}@else{{ $redactor->twitter }}@endif"></input>
                            </div>
                        </div>
                        <div class="col-sm-3">
                            <div class="form-group @if($errors->has('linkedin')){{ 'has-error' }}@endif">
                                <label for="linkedin">LINKEDIN</label>
                                <input type="text" name="linkedin" class="form-control" value="@if(old('linkedin')){{ old('linkedin') }}@else{{ $redactor->linkedin }}@endif"></input>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-12">
                            <div class="form-group @if($errors->has('slug')){{ 'has-error' }}@endif">
                                <label for="slug">SLUG</label>
                                <input type="text" name="slug" class="form-control" value="@if(old('slug')){{ old('slug') }}@else{{ $redactor->slug }}@endif"></input>
                            </div>
                        </div>
                    </div>
                    <hr>
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
                                        <div class="form-group @if($errors->has('redactores.'.$language->id.'.biografia')){{ 'has-error' }}@endif">
                                            <label for="">BIOGRAFÍA</label>
                                            <textarea name="redactores[{{ $language->id }}][biografia]" id="biografia-{{ $language->id }}" rows="10" class="form-control">@if(old('redactores.'.$language->id.'.biografia')){{ old('redactores.'.$language->id.'.biografia') }}@else{{ $redactor->noticiaRedactorLang($language->id)->biografia }}@endif</textarea>
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
                    <div class="panel-group visible-xs" id="rjNX9-accordion">
                        <hr>
                        {{ csrf_field() }}
                        <button type="submit" class="btn btn-success">guardar</button>
                    </div>
                </div>
            </form>
        </div>
    </div>
</div>
</div>

@include('back.common.modals.modal-error')
@endsection

@section('js')
<script src="{{ asset('back/js/noticias/redactor.js') }}"></script>
<script>
    $(function() {
        main();
        @if (session('message'))
        mostrarMensajeError('{{ session('message') }}');
        @endif
    });
</script>
@endsection
