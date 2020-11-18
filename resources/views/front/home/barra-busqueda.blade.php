<div class="row justify-content-center d-sm-flex d-none">
    <div class="col-11">
        <div class="overflow-hidden position-relative search-bar row flex-column transform-t-n50px z-1">
            <div class="d-flex form-group">
                <input type="search" class="form-control form-control-border-bottom" placeholder="Nombre del producto…">
                <select class="form-control form-control-border-bottom" id="FormControlAncho">
                    <option>Ancho</option>
                    <option>Ancho</option>
                    <option>Ancho</option>
                    <option>Ancho</option>
                    <option>Ancho</option>
                </select>
                <select class="form-control form-control-border-bottom" id="FormControlTipo">
                    <option>Tipo</option>
                    <option>Tipo</option>
                    <option>Tipo</option>
                    <option>Tipo</option>
                    <option>Tipo</option>
                </select>
                <select class="form-control form-control-border-bottom" id="FormControlMaterial">
                    <option>Material</option>
                    <option>Material</option>
                    <option>Material</option>
                    <option>Material</option>
                    <option>Material</option>
                </select>
                <a href="#" title="Filtrar segun categorías" class="form-control m-1 form-control-search-icon">
                    <img src="{{ asset('front/img/icon-search-bar.svg') }}" alt="icono buscar">
                </a>
            </div>
            <div id="buscador_avanzado" class="form-group">
                <select class="form-control d-sm-block d-none form-control-border-bottom" id="FormControlAncho">
                    <option>Nº Bolsas</option>
                    <option>Nº Bolsas</option>
                    <option>Nº Bolsas</option>
                    <option>Nº Bolsas</option>
                    <option>Nº Bolsas</option>
                </select>
                <select class="form-control form-control-border-bottom" id="FormControlAncho">
                    <option>Ratio</option>
                    <option>Ratio</option>
                    <option>Ratio</option>
                    <option>Ratio</option>
                    <option>Ratio</option>
                </select>
                <select class="form-control form-control-border-bottom" id="FormControlTipo">
                    <option>Nº Cordones</option>
                    <option>Nº Cordones</option>
                    <option>Nº Cordones</option>
                    <option>Nº Cordones</option>
                    <option>Nº Cordones</option>
                </select>
                <select class="form-control form-control-border-bottom" id="FormControlMaterial">
                    <option>Color</option>
                    <option>Color</option>
                    <option>Color</option>
                    <option>Color</option>
                    <option>Color</option>
                </select>
                <a href="#" title="Filtrar segun categorías" class="form-control m-1 form-control-search-icon opacity-0 pointer-events-none">
                    <img src="{{ asset('front/img/icon-search-bar.svg') }}" alt="icono buscar">
                </a>
            </div>
            <div class="d-flex form-control">
                <a id="btn_buscador_avanzado" href="#" title="Abrir buscador avanzado" class="underline">Abrir buscador avanzado</a>
            </div>
        </div>
    </div>
</div>



<div class="row justify-content-center d-sm-none d-flex">
    <div class="col-11">
        <div class="overflow-hidden position-relative search-bar row flex-column transform-t-n50px z-1">
            <div class="d-flex form-group">
                <input type="search" class="form-control form-control-border-bottom" placeholder="Nombre del producto…">
                <a href="#" title="Filtrar segun categorías" class="form-control m-1 form-control-search-icon">
                    <img src="{{ asset('front/img/icon-search-bar.svg') }}" alt="icono buscar">
                </a>
            </div>
            <div id="buscador_avanzado_mobile" class="flex-column">
                <div class="d-flex form-group">
                    <select class="form-control form-control-border-bottom" id="FormControlAncho">
                        <option>Ancho</option>
                        <option>Ancho</option>
                        <option>Ancho</option>
                        <option>Ancho</option>
                        <option>Ancho</option>
                    </select>
                    <select class="form-control form-control-border-bottom" id="FormControlTipo">
                        <option>Tipo</option>
                        <option>Tipo</option>
                        <option>Tipo</option>
                        <option>Tipo</option>
                        <option>Tipo</option>
                    </select>

                    <a href="#" title="Filtrar segun categorías" class="form-control m-1 form-control-search-icon opacity-0 pointer-events-none">
                        <img src="{{ asset('front/img/icon-search-bar.svg') }}" alt="icono buscar">
                    </a>
                </div>
                <div class="d-flex form-group">
                    <select class="form-control form-control-border-bottom" id="FormControlMaterial">
                        <option>Material</option>
                        <option>Material</option>
                        <option>Material</option>
                        <option>Material</option>
                        <option>Material</option>
                    </select>
                    <select class="form-control form-control-border-bottom" id="FormControlTipo">
                        <option>Nº Bolsas</option>
                        <option>Nº Bolsas</option>
                        <option>Nº Bolsas</option>
                        <option>Nº Bolsas</option>
                        <option>Nº Bolsas</option>
                    </select>

                    <a href="#" title="Filtrar segun categorías" class="form-control m-1 form-control-search-icon opacity-0 pointer-events-none">
                        <img src="{{ asset('front/img/icon-search-bar.svg') }}" alt="icono buscar">
                    </a>
                </div>
                <div class="d-flex form-group">
                    <select class="form-control form-control-border-bottom" id="FormControlMaterial">
                        <option>Ratio</option>
                        <option>Ratio</option>
                        <option>Ratio</option>
                        <option>Ratio</option>
                        <option>Ratio</option>
                    </select>
                    <select class="form-control form-control-border-bottom" id="FormControlTipo">
                        <option>Nº Cordones</option>
                        <option>Nº Cordones</option>
                        <option>Nº Cordones</option>
                        <option>Nº Cordones</option>
                        <option>Nº Cordones</option>
                    </select>
                    <a href="#" title="Filtrar segun categorías" class="form-control m-1 form-control-search-icon opacity-0 pointer-events-none">
                        <img src="{{ asset('front/img/icon-search-bar.svg') }}" alt="icono buscar">
                    </a>
                </div>
                <div class="d-flex form-group">
                    <select class="form-control form-control-border-bottom" id="FormControlMaterial">
                        <option>Color</option>
                        <option>Color</option>
                        <option>Color</option>
                        <option>Color</option>
                        <option>Color</option>
                    </select>
                    <select class="form-control opacity-0 pointer-events-none" id="FormControlMaterial">
                    </select>
                    <a href="#" title="Filtrar segun categorías" class="form-control m-1 form-control-search-icon opacity-0 pointer-events-none">
                        <img src="{{ asset('front/img/icon-search-bar.svg') }}" alt="icono buscar">
                    </a>
                </div>
            </div>
            <div class="d-flex form-control">
                <a id="btn_buscador_avanzado_mobile" href="#" title="Abrir buscador avanzado" class="underline">Abrir buscador avanzado</a>
            </div>
        </div>
    </div>
</div>
