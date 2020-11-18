@extends('back.common.main')

@section('content')
<div class="content-i">
    <div class="content-box">
        <div class="element-wrapper">
            <h6 class="element-header">Colores ({{ $colors->count() }})
                <a href="{{ route('colores.create') }}" class="btn btn-primary float-right"><i class="ti-plus"></i> Nuevo</a>
            </h6>
            @if(session('messages'))
            <div class="alert alert-success">{{ session('messages') }}</div>
            @endif
            <div class="element-box element-box-usuarios">
                <div class="table-responsive">
                    <table width="100%" id="colors" class="table table-striped table-lightfont table-hover">
                        <thead>
                            <tr>
                                <th>Nombre</th>
                                <th>Pantone</th>
                                <th>Color en hexadecimal</th>
                                <th>Tonalidad</th>
                                <th class="td-acciones">Acciones</th>
                            </tr>
                        </thead>
                        <tfoot>
                            <tr>
                                <th>Nombre</th>
                                <th>Pantone</th>
                                <th>Color en hexadecimal</th>
                                <th>Tonalidad</th>
                                <th class="td-acciones">Acciones</th>
                            </tr>
                        </tfoot>
                        <tbody>
                            @foreach($colors as $color)
                            <tr role="row">
                                <td><strong>{{ $color->name ?? 'Sin nombre' }}</strong></td>
                                <td>{{ $color->pantone }}</td>
                                <td><span style="background-color:#{{$color->hex_color}}" class="p-2 pr-4"> </span>&nbsp; #{{ $color->hex_color }}</td>
                                <td> @foreach($color->shades as $shade) {{$shade->name}} @if(!$loop->last), @endif @endforeach</td>
                                <td class="td-acciones">
                                    <div class="btn-group">
                                        <button aria-expanded="false" aria-haspopup="true" class="btn btn-default dropdown-toggle" data-toggle="dropdown" id="dropdownMenuButton2" form="button"><i class="icon-options-vertical"></i></button>
                                        <div aria-labelledby="dropdownMenuButton2" class="dropdown-menu dropdown-menu-right">
                                            <a class="dropdown-item" href="{{ route('colores.edit', $color->id) }}">
                                                <i class="icon-pencil"></i> Editar
                                            </a>
                                            <a class="delete-register dropdown-item" href="#" data-url="{{ route('colores.destroy', $color->id) }}" data-toggle="modal" data-target="#modal-delete"><i class="icon-trash"></i> Eliminar</a>

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
@section('swal.error.text', "El color no se puede borrar porque pertenece a una muestrario o categoría de colores")

@section('js')
<script>
    $(document).ready(function() {
        // Setup - add a text input to each footer cell
        $('#colors tfoot th').each( function () {
            var title = $(this).text();
            title!= "Acciones" && $(this).html( '<input class="form-control" type="text" placeholder="Buscar por '+title+'" />' );
        } );
        
        // DataTable
        var table = $('#colors').DataTable({
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