<form action="{{route('searcher')}}" method="get">
    @csrf
    <div class="row justify-content-center d-sm-flex d-none">
        <div class="col-11">
            <div class="overflow-hidden position-relative search-bar row flex-column transform-t-n50px z-1">
                <div class="d-flex form-group">
                    <input type="search" class="form-control form-control-border-bottom" value="{{isset($_GET['name']) ? $_GET['name'] : ''}}" name="name" placeholder="{{__('Productos.nombre')}} / {{__('Productos.referencia')}}">
                    {{-- <input type="number" class="form-control form-control-border-bottom" value="{{isset($_GET['width']) ? $_GET['width'] : ''}}" name="width" placeholder="Ancho"> --}}
                    <select class="form-control form-control-border-bottom" name="width" id="FormControlMaterial">
                        <option value="">{{__('Productos.ancho')}}</option>
                        @foreach($anchos as $ancho)
                            <option value="{{$ancho}}" {{isset($_GET['width']) && $_GET['width'] == $ancho ? 'selected' : ''}}>{{$ancho}}</option>
                        @endforeach
                    </select>
                    <select class="form-control form-control-border-bottom type" name="application" id="type_searcher">
                        <option value="">{{ucfirst(strtolower(__('Productos.categorias')))}}</option>
                        @foreach($categories as $category)
                            <option value="{{$category->id}}" {{isset($_GET['application']) && $_GET['application'] == $category->id ? 'selected' : ''}}>{{$category->name}}</option>
                        @endforeach
                    </select>
                    <select class="form-control form-control-border-bottom" name="material" id="FormControlAncho">
                        <option value="">{{__('Productos.material')}}</option>
                        @foreach($materials as $material)
                            <option value="{{$material->id}}" {{isset($_GET['material']) && $_GET['material'] == $material->id ? 'selected' : ''}}>{{$material->name}}</option>
                        @endforeach
                    </select>
                    <button type="submit" title="Filtrar segun categorías" class="form-control m-1 form-control-search-icon">
                        <img src="{{ asset('front/img/icon-search-bar.svg') }}" alt="icono buscar">
                    </button>
                </div>

                <div id="buscador_avanzado" class="form-group">
                    <select class="form-control form-control-border-bottom" name="bags" id="FormControlAncho">
                        <option value="">{{__('Productos.bolsas')}}</option>
                        @foreach($bags as $bag)
                            <option value="{{$bag}}" {{isset($_GET['bags']) && $_GET['bags'] == $bag ? 'selected' : ''}}>{{$bag}}</option>
                        @endforeach
                    </select>
                    <select class="form-control form-control-border-bottom" name="rapport" id="FormControlAncho">
                        <option value="">{{__('Productos.rapport')}}</option>
                        @foreach($rapports as $rapport)
                            <option value="{{$rapport}}" {{isset($_GET['rapport']) && $_GET['rapport'] == $rapport ? 'selected' : ''}}>{{$rapport}}</option>
                        @endforeach
                    </select>
                    <select class="form-control form-control-border-bottom" name="laces" id="FormControlAncho">
                        <option value="">{{__('Productos.cordones')}}</option>
                        @foreach($laces as $lace)
                            <option value="{{$lace}}" {{isset($_GET['laces']) && $_GET['laces'] == $lace && $_GET['laces'] != '' ? 'selected' : ''}}>{{$lace}}</option>
                        @endforeach
                    </select>
                    <select class="form-control form-control-border-bottom" name="color" id="color_searcher">
                        <option value="">{{ucfirst(strtolower(__('Productos.producto_mostrar_colores')))}}</option>
                        @foreach($colors as $color)
                            <option value="{{$color->id}}" {{isset($_GET['color']) && $_GET['color'] == $color->id ? 'selected' : ''}}>{{$color->name}}</option>
                        @endforeach
                    </select>
                    <a href="#" title="Filtrar segun categorías" class="form-control m-1 form-control-search-icon opacity-0 pointer-events-none">
                        <img src="{{ asset('front/img/icon-search-bar.svg') }}" alt="icono buscar">
                    </a>
                </div>
                <div class="d-flex form-control">
                    <a id="btn_buscador_avanzado" href="#" title="Abrir buscador avanzado" class="btn_buscador_avanzado_abrir underline">{{__('Productos.buscador_avanzado')}}</a>
                    <a id="btn_buscador_avanzado" href="#" title="Abrir buscador avanzado" style="display: none;" class="btn_buscador_avanzado_cerrar underline">{{__('Productos.buscador_avanzado_cerrar')}}</a>
                </div>
            </div>
        </div>
    </div>
</form>

<script>
    // Choose dinamically colors based on the category selected
    $("#type_searcher").change(function(){
        var id = $("#type_searcher").val();

        $.ajaxSetup({
            headers: {
                'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
            }
        });

        $.ajax({
            method: "POST",
            url: '{{ route('product.color') }}',
            data: {'id': id, "_token": "{{ csrf_token() }}"},
            success : function(data){
                $('#color_searcher').html(`<option value="">Color</option>`);
                Object.keys(data).forEach(function(key){
                    $('#color_searcher').html($('#color_searcher').html()
                     + `<option value="`+key+`">`+data[key]+`</option>`);
                });
            },
            error : function(xhr, status){
                console.log(xhr,status);
            }
        });
    });
</script>
