<div class="modal fade stick-up in" id="buscador-listado-noticias" tabindex="-1" role="dialog" aria-hidden="false" style="display: none;">
    <div class="modal-dialog" style="width: 100%">
        <div class="modal-content">
            <div class="modal-header clearfix float-left">

                <h4><span class="modal-title semi-bold">Buscar Noticias</span></h4>
                {{-- <br>
                <p>Rellena el formulario y realiza la búsqueda</p> --}}
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-sm-12">
                        <h4>Filtrar</h4>
                    </div>
                </div>
                <form id="form-buscador-noticias" method="post">
                    <input type="hidden" name="posicion" value="">
                    <input type="hidden" name="idiomaId" value="">
                    <div class="row">
                        <div class="col-sm-3">
                            <div class="form-group form-group-default required">
                                <label for="">Fecha inicio</label>
                                <input class="form-control fecha_inicio" type="text" name="fecha_inicio_buscador" id="fecha_inicio_buscador"></input>
                            </div>
                        </div>
                        <div class="col-sm-3">
                            <div class="form-group form-group-default required">
                                <label for="">Fecha final</label>
                                <input class="form-control fecha_fin" type="text" name="fecha_fin_buscador" id="fecha_fin_buscador"></input>
                            </div>
                        </div>
                        <div class="col-sm-3">
                            <div class="form-group form-group-default required">
                                <label for="">Titular</label>
                                <input class="form-control" type="text" name="titular_buscador"></input>
                            </div>
                        </div>
                        <div class="col-sm-3">
                            <div class="form-group form-group-default required">
                                <label for="">Idioma</label>
                                <select name="idioma_buscador" id="idioma" class="form-control" data-init-plugin="select2">
                                    <option value="">Seleccione Idioma</option>
                                    @foreach($languages as $idioma)
                                        <option value="{{ $idioma->id }}">{{ $idioma->code }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col-sm-3">
                            <div class="form-group form-group-default required">
                                <label for="">Redactor</label>
                                <select name="redactor_buscador" class="form-control" data-init-plugin="select2">
                                    <option value="">Seleccione Redactor</option>
                                    @foreach($redactores as $redactor)
                                        <option value="{{ $redactor->id }}">{{ $redactor->nombre }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-sm-3">
                            <div class="form-group form-group-default required">
                                <label for="">Categoría</label>
                                <select name="categoria_buscador"  class="form-control" data-init-plugin="select2">
                                    <option value="">Seleccione Categoría</option>
                                    @foreach($categorias as $categoria)
                                        <option value="{{ $categoria->id }}">{{ $categoria->noticiaCategoriaLang(config('app.lang_default'))->nombre }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-sm-3">
                            <div class="form-group form-group-default required">
                                <label for="">Etiqueta</label>
                                <select name="etiqueta_buscador"  class="form-control" data-init-plugin="select2">
                                    <option value="">Seleccione Etiqueta</option>
                                    @foreach($etiquetas as $etiqueta)
                                        <option value="{{ $etiqueta->id }}">{{ $etiqueta->noticiaEtiquetaLang(config('app.lang_default'))->nombre }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        {{ csrf_field() }}
                        <div class="col-sm-3">
                            <button id="enviar-buscador" type="button" class="btn btn-info">Buscar</button>
                        </div>
                    </div>
                </form>
                <div id="add-noticias"></div>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
</div>
