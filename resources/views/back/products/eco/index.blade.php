@extends('back.common.main')

@section('content')
<div class="content-i">
    <div class="content-box">
        <div class="element-wrapper">
            <h6 class="element-header">Logos Eco Friendly ({{ $ecos->count() }})
                <a href="{{ route('eco.create') }}" class="btn btn-primary float-right"><i class="ti-plus"></i> Nuevo Logo</a>
            </h6>
            @if(session('messages'))
            <div class="alert alert-success">{{ session('messages') }}</div>
            @endif
            <div class="element-box element-box-usuarios">
                <div class="table-responsive">
                    <table width="100%" id="eco" class="table table-striped table-lightfont table-hover">
                        <thead>
                            <tr>
                                <th>Nombre</th>
                                <th>Imagen</th>
                                <th class="td-acciones">Acciones</th>
                            </tr>
                        </thead>
                        <tfoot>
                            <tr>
                                <th>Nombre</th>
                                <th>Imagen</th>
                                <th class="td-acciones">Acciones</th>
                            </tr>
                        </tfoot>
                        <tbody>
                            @foreach($ecos as $eco)
                            <tr role="row">
                                <td><strong>{{ $eco->name ?? 'Sin nombre' }}</strong></td>
                                <td>{!! $eco->image ? '<img src="' . Storage::url($eco->image) . '" alt="" width="50px" height="auto">' : 'Sin imagen' !!}</td>
                                <td class="td-acciones">
                                    <div class="btn-group">
                                        <button aria-expanded="false" aria-haspopup="true" class="btn btn-default dropdown-toggle" data-toggle="dropdown" id="dropdownMenuButton2" form="button"><i class="icon-options-vertical"></i></button>
                                        <div aria-labelledby="dropdownMenuButton2" class="dropdown-menu dropdown-menu-right">
                                            <a class="dropdown-item" href="{{ route('eco.edit', $eco->id) }}">
                                                <i class="icon-pencil"></i> Editar
                                            </a>
                                            <a class="delete-register dropdown-item" href="#" data-url="{{ route('eco.destroy', $eco->id) }}" data-toggle="modal" data-target="#modal-delete"><i class="icon-trash"></i> Eliminar</a>
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

@section('swal.error.text', "El logo eco no se puede borrar porque esta asignado a algún producto")

@section('js')
<script>
    $(document).ready(function() {
        // Setup - add a text input to each footer cell
        $('#eco tfoot th').each( function () {
            var title = $(this).text();
            title!= "Acciones" && $(this).html( '<input class="form-control" type="text" placeholder="Buscar por '+title+'" />' );
        } );
        
        // DataTable
        var table = $('#eco').DataTable({
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