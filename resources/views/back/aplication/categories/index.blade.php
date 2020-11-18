@extends('back.common.main')
@section('content')
<div class="content-i" id="app">
    <div class="content-box">
        <div class="element-wrapper">
            <h6 class="element-header">
                Categorías de aplicaciones ({{ $applicationCategories->count() }})
                <a href="{{ route('categorias-aplicaciones.create') }}" class="btn btn-primary float-right"><i class="ti-plus"></i>
                    Nuevo</a>
            </h6>
            @if(session('messages'))
            <div class="alert alert-success">{{ session("messages") }}</div>
            @endif
            <div class="element-box element-box-usuarios">
                <div class="table-responsive">
                    <table id="applications" width="100%" class="table table-striped table-lightfont table-hover">
                        <thead>
                            <tr>
                                <th>Orden</th>
                                <th>Nombre</th>
                                <th>Estado</th>
                                <th class="td-acciones"></th>
                            </tr>
                        </thead>
                        <tfoot>
                            <tr>
                                <th>Orden</th>
                                <th>Nombre</th>
                                <th>Estado</th>
                                <th class="td-acciones"></th>
                            </tr>
                        </tfoot>
                        <tbody>
                            @foreach($applicationCategories as $applicationCategory)
                            <tr role="row">
                                <td>
                                    <span class="d-none">{{ $applicationCategory->order }}</span>
                                    <input class="form-control order" product_id="{{ $applicationCategory->id }}" type="number" value="{{ $applicationCategory->order }}">
                                </td>

                                <td><strong>{{ $applicationCategory->name }}</strong></td>
                                <td>
                                    <button  product_id="{{ $applicationCategory->id }}" type="btn" class="toggle btn btn-small @if($applicationCategory->active) btn-danger @else btn-success @endif ">@if($applicationCategory->active) Desactivar @else Activar @endif</button>
                                </td>
                                <td class="td-acciones">
                                    <div class="btn-group">
                                        <button aria-expanded="false" aria-haspopup="true"
                                            class="btn btn-default dropdown-toggle" data-toggle="dropdown"
                                            id="dropdownMenuButton2" type="button">
                                            <i class="icon-options-vertical"></i>
                                        </button>
                                        <div aria-applicationCategoryledby="dropdownMenuButton2"
                                            class="dropdown-menu dropdown-menu-right">
                                            <a class="dropdown-item"
                                                href="{{ route('categorias-aplicaciones.edit', $applicationCategory->id) }}">
                                                <i class="icon-pencil"></i>
                                                Editar
                                            </a>
                                            <a href="" class="dropdown-item delete-register" data-toggle="modal" data-target="#modal-delete" data-url="{{ route('categorias-aplicaciones.destroy', $applicationCategory->id) }}">
                                                <i class="ti-trash"></i> Eliminar
                                            </a>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('swal.error.text', "La aplicación no se ha podido borrar")

@section('js')
<script>
    $(document).ready(function() {
        // Setup - add a text input to each footer cell
        $('#applications tfoot th').each( function () {
            var title = $(this).text();
            (title!= "Acciones" && title!= "Activo") && $(this).html( '<input class="form-control" type="text" placeholder="Buscar por '+title+'" />' );
        } );

        // DataTable
        var table = $('#applications').DataTable({
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

        $("#applications").on("click", ".toggle", function(e){
            let id = $(e.currentTarget).attr('product_id');
            axios.get('/admin/categorias-aplicaciones/toggle-active/'+ id)
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

        $("#applications").on("keyup", ".order", function(e){
            const id = $(e.currentTarget).attr('product_id');
            const value = e.currentTarget.value;
            if(value != ''){
                axios.post('/admin/categorias-aplicaciones/change-order/'+ id, {order: value})
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

@include('back.common.modals.modal-delete')

