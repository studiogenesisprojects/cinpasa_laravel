<div class="modal fade" id="modal-color" tabindex="-1" role="dialog" aria-labelledby="modal-colorLabel"
    aria-hidden="true">
    <div class="modal-dialog modal-dialog-centered modal-lg " role="document">
        <div class="modal-content">
            <div class="modal-body bg-light">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>

                <div class="row mx-0">
                    <div class="d-sm-flex d-none">
                        <div class="color-modal border-img" id="color-modal-color"></div>
                        <div class="ml-sm-4 d-flex flex-column justify-content-between">
                            <div>
                                <p class="font-bold"><strong id="color-modal-name"></strong></p>
                                <p class="text-muted text-sm">PANTONE <span id="color-modal-pantone"></span></p>
                                <small class="text-muted text-sm" id="color-modal-description"></small>
                            </div>

                            <a id="searchLink" href="#" title="Ver productos con el mismo color" class="font-semibold">Ver productos con el mismo color <img class="ml-3" src="{{ asset('front/img/icon-arrow-right-blue.svg') }}" alt="icono flecha derecha"></a>
                        </div>
                    </div>
                    <div class="d-sm-none d-block">
                        <div class="ml-sm-4 d-flex flex-row justify-content-between">
                            <div class="color-modal border-img" id="color-modal-color"></div>
                            <div class="ml-3">
                                <p class="font-bold"><strong id="color-modal-name"></strong></p>
                                <p class="text-muted text-sm">PANTONE <span id="color-modal-pantone">0000</span></p>
                                <small class="text-muted text-sm" id="color-modal-description"></small>
                            </div>
                        </div>
                        <a href="#" title="Ver productos con el mismo color" class="font-semibold float-right">Ver productos con el <br> mismo color <img class="ml-3" src="{{ asset('front/img/icon-arrow-right-blue.svg') }}" alt="icono flecha derecha"></a>
                    </div>
                </div>
                <div class="row">
                    <div class="col-12">
                        <hr class="mt-4">
                        <p class="mt-4 color-blue">Productos que podemos fabricar con este color</p>
                    </div>
                </div>
                <div class="row" id="color-modal-products">

                </div>

                <div class="row" id="color-modal-button-products">
                </div>
            </div>
        </div>
    </div>
</div>


