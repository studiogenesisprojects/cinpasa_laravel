@extends('back.common.main')

@section('content')

<div class="content-box">
    <div class="element-wrapper" id="app">
        <h6 class="element-header">Customer
            <a href="{{route('ofertas-trabajo.index')}}" class="btn btn-white float-right"><i
                class="os-icon os-icon-chevron-left"></i> Volver</a>
            </h6>
            @if($errors->any())
            {{dd($errors)}}
            <div class="alert alert-danger">
                <p>No se ha podido crear la oferta</p>
                <p>Asegúrate de introducir los campos obligatorios</p>
            </div>
            @endif
            <div class="row">
                <div class="col-sm-12">
                    <div class="element-wrapper">
                        <div class="element-box">
                            <form id="formValidate" novalidate="true" method="post" action="{{route('ofertas-trabajo.update', $offer->id)}}">
                                {{ csrf_field() }}
                                @method('PUT')
                                <div class="element-info">
                                    <div class="element-info-with-icon">
                                        <div class="element-info-icon">
                                            <div class="ti-layout-cta-right"></div>
                                        </div>
                                        <div class="element-info-text">
                                            <h5 class="element-inner-header">Información de la oferta </h5>
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
                                                <input type="hidden" name="jobOfferLangs[{{ $language->id }}][language_id]" value="{{$language->id}}">
                                                <div class="row">
                                                    <div class="col-sm-6">
                                                        <div class="form-group">
                                                            <label for="">Título de la oferta</label>
                                                            <input type="text" name="jobOfferLangs[{{ $language->id }}][name]" value="{{$offer->lang($language->id)->name ??""}}" class="form-control" data-error="Introduzca un título">
                                                            <div class="help-block form-text with-errors form-control-feedback"></div>
                                                        </div>
                                                    </div>

                                                    <div class="col-sm-6">
                                                        <div class="form-group">
                                                            <label for="">Slug de la oferta</label>
                                                            <input type="text" name="jobOfferLangs[{{ $language->id }}][slug]" value="{{$offer->lang($language->id)->slug ??""}}" class="form-control" data-error="Introduzca un slug">
                                                            <div class="help-block form-text with-errors form-control-feedback"></div>
                                                        </div>
                                                    </div>

                                                    <div class="col-sm-6">
                                                        <div class="form-group">
                                                            <label for="">Descripción</label>
                                                            <textarea name="jobOfferLangs[{{ $language->id }}][description]" class="item form-control" data-error="Introduzca una descripción">{{$offer->lang($language->id)->description ??""}}</textarea>
                                                            <div class="help-block form-text with-errors form-control-feedback"></div>
                                                        </div>
                                                    </div>

                                                    <div class="col-sm-6">
                                                        <div class="form-group">
                                                            <label for="">Información adicional</label>
                                                            <textarea name="jobOfferLangs[{{ $language->id }}][additional_info]" class="item form-control" >{{$offer->lang($language->id)->additional_info ??""}}</textarea>
                                                            <div class="help-block form-text with-errors form-control-feedback"></div>
                                                        </div>
                                                    </div>

                                                    <div class="col-sm-6">
                                                        <div class="form-group">
                                                            <label for="">Tiempo</label>
                                                            <input type="text" name="jobOfferLangs[{{ $language->id }}][time]" value="{{$offer->lang($language->id)->time ??""}}"  class="form-control" data-error="Introduzca el tiempo">
                                                            <div class="help-block form-text with-errors form-control-feedback"></div>
                                                        </div>
                                                    </div>

                                                    <div class="col-sm-6">
                                                        <div class="form-group">
                                                            <label for="">Duración</label>
                                                            <input type="text" name="jobOfferLangs[{{ $language->id }}][duration]" value="{{$offer->lang($language->id)->duration ??""}}" class="form-control" data-error="Introduzca la duración del contrato">
                                                            <div class="help-block form-text with-errors form-control-feedback"></div>
                                                        </div>
                                                    </div>

                                                    <div class="col-sm-6">
                                                        <div class="form-group">
                                                            <label for="">Salario</label>
                                                            <input type="text" name="jobOfferLangs[{{ $language->id }}][salary]" value="{{$offer->lang($language->id)->salary ?? ""}}" class="form-control" data-error="Introduzca un salario" >
                                                            <div class="help-block form-text with-errors form-control-feedback"></div>
                                                        </div>
                                                    </div>

                                                    <div class="col-sm-6">
                                                        <div class="form-group">
                                                            <label for="">Lugar</label>
                                                            <input type="text"  name="jobOfferLangs[{{ $language->id }}][location]" value="{{$offer->lang($language->id)->location ??""}}" class="form-control" data-error="Introduzca el lugar">
                                                            <div class="help-block form-text with-errors form-control-feedback"></div>
                                                        </div>
                                                    </div>

                                                    <div class="col-sm-12">
                                                        <div class="form-group">
                                                            <label for="">Requisitos</label>
                                                            <textarea type="text" name="jobOfferLangs[{{ $language->id }}][requirements]" class="item form-control" data-error="Introduzca los requisitos">{{$offer->lang($language->id)->requirements ??""}}</textarea>
                                                            <div class="help-block form-text with-errors form-control-feedback"></div>
                                                        </div>
                                                    </div>
                                                </div>
                                            </div>
                                            @endforeach
                                        </div> <!-- /tab-content -->
                                    </div> <!-- /panel -->
                                </div>

                                <div class="row form-buttons-w">
                                    <div class="col-sm-12">
                                        <h4>Duración de la oferta</h4>
                                    </div>
                                </div>

                                <div class="row">
                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label for="">Fecha de publicación</label>
                                            <input type="date" name="publication_date" value="{{$offer->publication_date}}" class="form-control" data-error="Introduzca la fecha de publicación"></textarea>
                                            <div class="help-block form-text with-errors form-control-feedback"></div>
                                        </div>
                                    </div>

                                    <div class="col-sm-6">
                                        <div class="form-group">
                                            <label for="">Fecha finalización</label>
                                            <input type="date" name="end_date" class="form-control" value="{{$offer->end_date}}" data-error="Introduzca fecha de finalización"></textarea>
                                            <div class="help-block form-text with-errors form-control-feedback"></div>
                                        </div>
                                    </div>
                                </div>
                                <div class="form-buttons-w">
                                    <button class="btn btn-success" type="submit">Guardar</button>
                                </div>
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
        $('.select2').select2()
        CKEDITOR.replaceAll('item');
    })
</script>
@endsection
