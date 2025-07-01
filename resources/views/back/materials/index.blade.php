@extends('back.common.main')
@section('content')
<div class="content-i" id="app">
    <div class="content-box">
        <div class="element-wrapper">
            <h6 class="element-header">
                Materiales ({{ $materials->count() }})
                <a href="{{ action('Back\Materials\MaterialsController@update') }}" class="btn btn-primary float-right"><i class="ti-plus"></i>
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
                                <th class="td-acciones">Acciones</th>
                            </tr>
                        </thead>
                        <tfoot>
                            <tr>
                                <th>Orden</th>
                                <th>Nombre</th>
                                <th>Estado</th>
                                <th class="td-acciones">Acciones</th>
                            </tr>
                        </tfoot>
                        <tbody>
                            @foreach($materials as $material)
                            <tr role="row">
                                <td>
                                    <span class="d-none">{{ $material->order }}</span>
                                    <input class="form-control order" product_id="{{ $material->id }}" type="number" value="{{ $material->order }}">
                                </td>

                                <td><strong>{{ $material->lang()->name }}</strong></td>
                                <td>
                                    <button  product_id="{{ $material->id }}" type="btn" class="toggle btn btn-small @if($material->active) btn-danger @else btn-success @endif ">@if($material->active) Desactivar @else Activar @endif</button>
                                </td>
                                <td class="td-acciones">
                                    <div class="btn-group">
                                        <button aria-expanded="false" aria-haspopup="true"
                                            class="btn btn-default dropdown-toggle" data-toggle="dropdown"
                                            id="dropdownMenuButton2" type="button">
                                            <i class="icon-options-vertical"></i>
                                        </button>
                                        <div aria-aplicationledby="dropdownMenuButton2"
                                            class="dropdown-menu dropdown-menu-right">
                                            @if(Auth()->user()->role->canWrite(App\Models\Section::find(config('app.enabled_sections.materiales'))))
                                                <a class="dropdown-item"
                                                    href="{{ action('Back\Materials\MaterialsController@update', $material->id) }}">
                                                    <i class="icon-pencil"></i>
                                                    Editar
                                                </a>
                                            @endif
                                            @if(Auth()->user()->role->canDelete(App\Models\Section::find(config('app.enabled_sections.materiales'))))
                                                <a href="" class="dropdown-item delete-register" data-toggle="modal" data-target="#modal-delete" data-url="{{ action('Back\Materials\MaterialsController@delete', $material->id) }}">
                                                    <i class="ti-trash"></i> Eliminar
                                                </a>
                                            @endif
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
@section('js')
<script>
    $(document).ready(function() {
    // Setup - add a text input to each footer cell
    $('#applications tfoot th').each( function () {
        var title = $(this).text();
        title!= "Acciones" && $(this).html( '<input class="form-control" type="text" placeholder="Buscar por '+title+'" />' );
    } );

    // DataTable
    var table = $('#applications').DataTable();

    // Apply the search
    table.columns().every( function () {
        var that = this;

        $( 'input', this.footer() ).on( 'keyup change clear', function () {
            if ( that.search() !== this.value ) {
                that
                    .search( this.value )
                    .draw();
            }
        } );
    } );

    $("#applications").on("click", ".toggle", function(e){
            let id = $(e.currentTarget).attr('product_id');
            axios.get('/admin/materiales/toggle-active/'+ id)
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
                axios.post('/admin/materiales/change-order/'+ id, {order: value})
                .then(r => {
                   
                })
                .catch(e => {
                    console.log(e.response)
                }) 
            }           
        });
} );
</script>
@endsection
@section('swal.error.text', "La aplicación no se ha podido borrar")
@include('back.common.modals.modal-delete')

