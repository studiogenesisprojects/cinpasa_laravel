<form action="{{route('searcher')}}" method="get">
    @csrf
    <div class="row justify-content-center d-sm-flex d-none">
        <div class="col-11">
            <div class="overflow-hidden position-relative search-bar row flex-column transform-t-n50px z-1">
                <div class="d-flex form-group">
                    <input type="search" class="form-control form-control-border-bottom" value="{{isset($_GET['name']) ? $_GET['name'] : ''}}" name="name" placeholder="Nombre del producto">
                    <input type="number" class="form-control form-control-border-bottom" value="{{isset($_GET['width']) ? $_GET['width'] : ''}}" name="width" placeholder="Ancho">
                    <select class="form-control form-control-border-bottom" name="application" id="FormControlMaterial">
                        <option value="">Tipo</option>
                        @foreach($categories as $category)
                            <option value="{{$category->id}}" {{isset($_GET['application']) && $_GET['application'] == $category->id ? 'selected' : ''}}>{{$category->name}}</option>
                        @endforeach
                    </select>
                    <select class="form-control form-control-border-bottom" name="material" id="FormControlAncho">
                        <option value="">Material</option>
                        @foreach($materials as $material)
                            <option value="{{$material->id}}" {{isset($_GET['material']) && $_GET['material'] == $material->id ? 'selected' : ''}}>{{$material->name}}</option>
                        @endforeach
                    </select>
                    <button type="submit" title="Filtrar segun categorías" class="form-control m-1 form-control-search-icon">
                        <img src="{{ asset('front/img/icon-search-bar.svg') }}" alt="icono buscar">
                    </button>
                </div>
                <div id="buscador_avanzado" class="form-group">
                    <input type="number" class="form-control form-control-border-bottom" value="{{isset($_GET['bags']) ? $_GET['bags'] : ''}}" name="bags" placeholder="Nº Bolsas">
                    <select class="form-control form-control-border-bottom" name="rapport" id="FormControlAncho">
                        <option value="">Ratios</option>
                        @foreach($rapports as $rapport)
                            <option value="{{$rapport}}" {{isset($_GET['rapport']) && $_GET['rapport'] == $rapport ? 'selected' : ''}}>{{$rapport}}</option>
                        @endforeach
                    </select>
                    <input type="number" class="form-control form-control-border-bottom" value="{{isset($_GET['laces']) ? $_GET['laces'] : ''}}" name="laces" placeholder="Nº Cordones">
                    <select class="form-control form-control-border-bottom" name="color" id="FormControlTipo">
                        <option value="">Color</option>
                        @foreach($colors as $color)
                            <option value="{{$color->id}}" {{isset($_GET['color']) && $_GET['color'] == $color->id ? 'selected' : ''}}>{{$color->name}}</option>
                        @endforeach
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
</form>
