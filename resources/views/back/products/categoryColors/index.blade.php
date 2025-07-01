@extends('back.common.main')

@section('content')
<div class="content-i">
    <div class="content-box">
        <div class="element-wrapper">
            <h6 class="element-header">Muestrario de Colores ({{ $categories->count() }})
                <a href="{{ route('categorias-colores.create') }}" class="btn btn-primary float-right"><i class="ti-plus"></i> Nuevo muestrario</a>
            </h6>
            @if(session('messages'))
            <div class="alert alert-success">{{ session('messages') }}</div>
            @endif
            <div class="element-box element-box-usuarios">
                <div class="table-responsive">
                    <table width="100%" class="table table-striped table-lightfont table-hover" id="table">
                        <thead>
                            <tr>
                                <th>Orden</th>
                                <th>Nombre</th>
                                <th>Slug</th>
                                <th>Activo</th>
                                <th class="td-acciones">Acciones</th>
                            </tr>
                        </thead>
                        <tfoot>
                            <tr>
                                <th>Orden</th>
                                <th>Nombre</th>
                                <th>Slug</th>
                                <th>Activo</th>
                                <th class="td-acciones">Acciones</th>
                            </tr>
                        </tfoot>
                        <tbody>
                            @foreach($categories as $category)
                            <tr role="row">
                                <td>{{$category->order}}</td>
                                <td><strong>{{ $category->name ?? 'Sin nombre' }}</strong></td>
                                <td>{{ $category->slug }}</td>
                                <td>{!! $category->active ? '<span class="text-success">Sí</span>' : '<span class="text-danger">No</span>' !!}</td>
                                <td class="td-acciones">
                                    <div class="btn-group">
                                        <button aria-expanded="false" aria-haspopup="true" class="btn btn-default dropdown-toggle" data-toggle="dropdown" id="dropdownMenuButton2" form="button"><i class="icon-options-vertical"></i></button>
                                        <div aria-labelledby="dropdownMenuButton2" class="dropdown-menu dropdown-menu-right">
                                            @if(Auth()->user()->role->canWrite(App\Models\Section::find(config('app.enabled_sections.productos'))))
                                                <a class="dropdown-item" href="{{ route('categorias-colores.edit', $category->id) }}">
                                                    <i class="icon-pencil"></i> Editar
                                                </a>
                                            @endif
                                            @if(Auth()->user()->role->canDelete(App\Models\Section::find(config('app.enabled_sections.productos'))))
                                                <a class="delete-register dropdown-item" href="#" data-url="{{ route('categorias-colores.destroy', $category->id) }}" data-toggle="modal" data-target="#modal-delete"><i class="icon-trash"></i> Eliminar</a>
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
@include('back.common.modals.modal-delete')
@endsection

@section('swal.error.text', "La categoría de colores o muestrario no se puede borrar porque tiene colores")

@section('js')
<script>
    $(document).ready(function() {
    // Setup - add a text input to each footer cell
    $('#table tfoot th').each( function () {
        var title = $(this).text();
        title!= "Acciones" && $(this).html( '<input class="form-control" type="text" placeholder="Buscar por '+title+'" />' );
    } );

    // DataTable
    var table = $('#table').DataTable({
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
        } );
    } );
} );
</script>
@endsection
