@extends('back.common.main')

@section('content')
<div class="content-i" id="app">
    <div class="content-box">
        <div class="element-wrapper">
            <h6 class="element-header">Categorías ({{ $categories->count() }})
                <a href="{{ route('product.categorias.create') }}" class="btn btn-primary float-right"><i class="ti-plus"></i> Nuevo</a>
            </h6>
            @if(session('messages'))
            <div class="alert alert-success">{{ session('messages') }}</div>
            @endif
            <div class="element-box element-box-usuarios">
                <div class="table-responsive">
                    <table width="100%" id="categorias" class="table table-striped table-lightfont table-hover">
                        <thead>
                            <tr>
                                <th>Orden</th>
                                <th>Nombre</th>
                                <th>Activo</th>
                                <th>Categoría Padre</th>
                                <th class="td-acciones">Acciones</th>
                            </tr>
                        </thead>
                        <tfoot>
                            <tr>
                                <th>Orden</th>
                                <th>Nombre</th>
                                <th>Activo</th>
                                <th>Categoría Padre</th>
                                <th class="td-acciones">Acciones</th>
                            </tr>
                        </tfoot>
                        <tbody>
                            @foreach($categories as $category)
                                @if ($category->sup_product_category)
                                    <tr role="row">
                                        <td>
                                            <span class="d-none">{{ $category->order }}</span>
                                            <input class="form-control order" product_id="{{ $category->id }}" type="number" value="{{ $category->order }}">
                                        </td>

                                        <td><strong>{{ $category->name }}</strong></td>
                                        <td>
                                            <button  product_id="{{ $category->id }}" type="btn" class="toggle btn btn-small @if($category->active) btn-danger @else btn-success @endif ">@if($category->active) Desactivar @else Activar @endif</button>
                                        </td>
                                        <td>{{$category->sup_product_category ? $category->father->lang()->name : 'No tiene'}} </td>
                                        <td class="td-acciones">
                                            <div class="btn-group">
                                                <button aria-expanded="false" aria-haspopup="true" class="btn btn-default dropdown-toggle" data-toggle="dropdown" id="dropdownMenuButton2" type="button"><i class="icon-options-vertical"></i></button>
                                                <div aria-labelledby="dropdownMenuButton2" class="dropdown-menu dropdown-menu-right">
                                                    <a class="dropdown-item" href="{{ route('categorias.edit', $category->id) }}">
                                                        <i class="icon-pencil"></i> Editar
                                                    </a>
                                                    <a class="delete-register dropdown-item" href="#" data-url="{{ route('categorias.destroy', $category->id) }}" data-toggle="modal" data-target="#modal-delete"><i class="icon-trash"></i> Eliminar</a>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                @endif
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    <div class="content-box">
        <div class="element-wrapper">
            <h6 class="element-header">Categorías Padre
                <a href="{{ route('product.category-father.create') }}" class="btn btn-primary float-right"><i class="ti-plus"></i> Nuevo</a>
            </h6>
            @if(session('messages'))
            <div class="alert alert-success">{{ session('messages') }}</div>
            @endif
            <div class="element-box element-box-usuarios">
                <div class="table-responsive">
                    <table width="100%" id="categorias-padre" class="table table-striped table-lightfont table-hover">
                        <thead>
                            <tr>
                                <th>Nombre</th>
                                <th>Descripción</th>
                                <th>Orden</th>
                                <th class="td-acciones">Acciones</th>
                            </tr>
                        </thead>
                        <tfoot>
                            <tr>
                                <th>Nombre</th>
                                <th>Descripción</th>
                                <th class="td-acciones">Acciones</th>
                            </tr>
                        </tfoot>
                        <tbody>
                            @foreach($categories as $category)
                                @if ($category->sup_product_category == null)
                                    <tr role="row">
                                        <td><strong>{{ $category->name }}</strong></td>
                                        <td>{{ $category->description }}</td>
                                        <td>{{ $category->order }}</td>
                                        <td class="td-acciones">
                                            <div class="btn-group">
                                                <button aria-expanded="false" aria-haspopup="true" class="btn btn-default dropdown-toggle" data-toggle="dropdown" id="dropdownMenuButton2" type="button"><i class="icon-options-vertical"></i></button>
                                                <div aria-labelledby="dropdownMenuButton2" class="dropdown-menu dropdown-menu-right">
                                                    <a class="dropdown-item" href="{{ route('product.category-father.edit', $category->id) }}">
                                                        <i class="icon-pencil"></i> Editar
                                                    </a>
                                                    <a class="delete-register dropdown-item" href="#" data-url="{{ route('categorias.destroy', $category->id) }}" data-toggle="modal" data-target="#modal-delete"><i class="icon-trash"></i> Eliminar</a>
                                                </div>
                                            </div>
                                        </td>
                                    </tr>
                                @endif
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@include('back.common.modals.modal-delete')
@endsection

@section('swal.error.text', "La categoria no se ha podido borrar porque contiene productos")
@section('js')
<script>
    $(document).ready(function() {
        // Setup - add a text input to each footer cell
        $('#categorias tfoot th').each( function () {
            var title = $(this).text();
            (title!= "Acciones" && title!= "Activo") && $(this).html( '<input class="form-control" type="text" placeholder="Buscar por '+title+'" />' );
        } );

        // DataTable
        var table = $('#categorias').DataTable({
            "order": [[ 0, "asc" ]]
        });

        // Apply the search
        table.columns().every( function () {
            var that = this;

            $( 'input', this.footer() ).on( 'keyup change clear', function () {
                if ( that.search() !== this.value ) {
                    that
                        .search( this.value )
                        .draw();
                }
            });
        });

        // Setup - add a text input to each footer cell
        $('#categorias-padre tfoot th').each( function () {
            var title = $(this).text();
            title!= "Acciones" && $(this).html( '<input class="form-control" type="text" placeholder="Buscar por '+title+'" />' );
        } );

        // DataTable
        var table = $('#categorias-padre').DataTable({
            "order": [[ 0, "asc" ]]
        });

        // Apply the search
        table.columns().every( function () {
            var that = this;

            $( 'input', this.footer() ).on( 'keyup change clear', function () {
                if ( that.search() !== this.value ) {
                    that
                        .search( this.value )
                        .draw();
                }
            });
        });

        $("#categorias").on("click", ".toggle", function(e){
            let id = $(e.currentTarget).attr('product_id');
            axios.get('/admin/productos/categorias/toggle-active/'+ id)
                .then(r => {
                    if(r.data.active){
                        $(e.currentTarget).removeClass("btn-success").addClass("btn-danger")
                        $(e.currentTarget).html("Desactivar");
                    }else{
                        $(e.currentTarget).addClass("btn-success").removeClass("btn-danger")
                        $(e.currentTarget).html("Activar");
                    }
                })
                .catch(e => {
                    console.log(e.response)
                })
        });

        $("#categorias").on("keyup", ".order", function(e){
            const id = $(e.currentTarget).attr('product_id');
            const value = e.currentTarget.value;
            if(value != ''){
                axios.post('/admin/productos/categorias/change-order/'+ id, {order: value})
                .then(r => {

                })
                .catch(e => {
                    console.log(e.response)
                })
            }
        });
    });
</script>

@endsection
