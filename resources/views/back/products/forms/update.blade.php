@extends('back.common.main')

@section('content')
<div class="content-box">
    <div class="element-wrapper" id="app">
        <h6 class="element-header">Forma
            <a href="{{route('formIndex')}}" class="btn btn-white float-right"><i
                class="os-icon os-icon-chevron-left"></i> Volver</a>
            </h6>
            <div class="row">
                <div class="col-sm-12">
                    <div class="element-wrapper">
                        <div class="element-box">
                            <form id="formValidate" novalidate="true" method="post"
                            action="{{route('formHandleUpdate', $form->id)}}">
                            {{ csrf_field() }}
                            <div class="element-info">
                                <div class="element-info-with-icon">
                                    <div class="element-info-icon">
                                        <div class="ti-layout-cta-right"></div>
                                    </div>
                                    <div class="element-info-text">
                                        <h5 class="element-inner-header">Información de la forma</h5>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group">
                                        <label for="">Orden en buscador</label>
                                        <input type="number" name="searcher_order" value="{{$form->searcher_order ?? ''}}">
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label for="">Tipo de forma</label>
                                        <select class="form-control" name="type" >
                                            <option value="0">Plano</option>
                                            <option {{$form->id && $form->type ? 'selected' : ''}} value="1">Redondo</option>
                                        </select>
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
                                            <div class="row">
                                                <div class="col-sm-12">
                                                    <div class="form-group">
                                                        <label for="">Nombre de la forma</label>
                                                        <input type="text" name="name[]" class="form-control" value="{{$form->id ? $form->lang($language->id)->name : ''}}" data-error="Introduzca un nombre" required>
                                                        <div class="help-block form-text with-errors form-control-feedback"></div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        @endforeach
                                    </div> <!-- /tab-content -->
                                </div> <!-- /panel -->
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

