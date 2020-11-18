@extends('back.common.main')

@section('content')
<div class="content-i">
    <div class="content-box">
        <div class="element-wrapper">
            <h6 class="element-header">Tonalidades de Colores ({{ $shades->count() }})
                <a href="{{ route('tonalidades-colores.create') }}" class="btn btn-primary float-right"><i class="ti-plus"></i> Nueva Tonalidad</a>
            </h6>
            @if(session('messages'))
            <div class="alert alert-success">{{ session('messages') }}</div>
            @endif
            <div class="element-box element-box-usuarios">
                <div class="table-responsive">
                    <table width="100%" id="shades" class="table table-striped table-lightfont table-hover">
                        <thead>
                            <tr>
                                <th>Nombre</th>
                                <th>Slug</th>
                                <th>Descrición</th>
                                <th class="td-acciones"></th>
                            </tr>
                        </thead>
                        <tfoot>
                            <tr>
                                <th>Nombre</th>
                                <th>Slug</th>
                                <th>Descrición</th>
                                <th class="td-acciones"></th>
                            </tr>
                        </tfoot>
                        <tbody>
                            @foreach($shades as $shade)
                            <tr role="row">
                                <td><strong>{{ $shade->name ?? 'Sin nombre' }}</strong></td>
                                <td>{{ $shade->slug }}</td>
                                <td>{{ $shade->description }}</td>
                                <td class="td-acciones">
                                    <div class="btn-group">
                                        <button aria-expanded="false" aria-haspopup="true" class="btn btn-default dropdown-toggle" data-toggle="dropdown" id="dropdownMenuButton2" form="button"><i class="icon-options-vertical"></i></button>
                                        <div aria-labelledby="dropdownMenuButton2" class="dropdown-menu dropdown-menu-right">
                                            <a class="dropdown-item" href="{{ route('tonalidades-colores.edit', $shade->id) }}">
                                                <i class="icon-pencil"></i> Editar
                                            </a>
                                            <a class="delete-register dropdown-item" href="#" data-url="{{ route('tonalidades-colores.destroy', $shade->id) }}" data-toggle="modal" data-target="#modal-delete"><i class="icon-trash"></i> Eliminar</a>
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

@section('swal.error.text', "La tonalidad no se puede borrar porque tiene colores")

@section('js')
<script>
    $(document).ready(function() {
        // Setup - add a text input to each footer cell
        $('#shades tfoot th').each( function () {
            var title = $(this).text();
            title!= "Acciones" && $(this).html( '<input class="form-control" type="text" placeholder="Buscar por '+title+'" />' );
        } );
        
        // DataTable
        var table = $('#shades').DataTable({
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
    });
</script>
@endsection