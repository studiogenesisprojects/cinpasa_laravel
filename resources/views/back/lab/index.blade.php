@extends('back.common.main')

@section('content')
<div class="content-i">
    <div class="content-box">
        <div class="element-wrapper">
            @if (\Session::has('message'))
                <div class="alert alert-success">{!! \Session::get('message') !!}</div>
            @endif
            <h6 class="element-header">LAB ({{$labCategories->count()}})
                <a href="{{ route('lab.create') }}" class="btn btn-primary float-right"><i class="ti-plus"></i> Nuevo</a>
            </h6>
            <div class="element-box element-box-usuarios">
                <div class="table-responsive" >
                    <table width="100%" id="endings" class="table table-striped table-lightfont table-hover">
                        <thead>
                            <tr>
                                <th>Nombre</th>
                                <th>Orden</th>
                                <th>Activo</th>
                                <th class="td-acciones">Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                        @foreach($labCategories as $lab)
                            <tr role="row">
                                <td>
                                    <img src="{{ Storage::url($lab->image) }}" alt="" width="50px" height="auto">
                                    <strong>{{ $lab->name }}</strong>
                                </td>
                                <td>{{$lab->order}}</td>
                                <td>{{$lab->active == 1 ? 'Sí' : 'No'}}</td>
                                <td class="td-acciones">
                                    <div class="btn-group">
                                        <button aria-expanded="false" aria-haspopup="true" class="btn btn-default dropdown-toggle" data-toggle="dropdown" id="dropdownMenuButton2" type="button"><i class="icon-options-vertical"></i></button>
                                        <div aria-labelledby="dropdownMenuButton2" class="dropdown-menu dropdown-menu-right">
                                            <a class="dropdown-item" href="{{ route('lab.edit', $lab->id) }}">
                                                <i class="icon-pencil"></i> Editar
                                            </a>
                                            <a class="delete-register dropdown-item" href="#" data-url="{{ route('lab.destroy', $lab->id) }}" data-toggle="modal" data-target="#modal-delete"><i class="icon-trash"></i> Eliminar</a>

                                        </div>
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                        <tfoot>
                            <tr>
                                <th>Nombre</th>
                                <th>Orden</th>
                                <th>Activo</th>
                                <th class="td-acciones">Acciones</th>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>
@include('back.common.modals.modal-delete')
@endsection

@section('swal.error.text', "El LAB no se ha podido borrar porque se esta usando")

@section('js')
    <script>
    $(document).ready(function() {
    // Setup - add a text input to each footer cell
    $('#endings tfoot th').each( function () {
        var title = $(this).text();
        title!= "Acciones" && $(this).html( '<input class="form-control" type="text" placeholder="Buscar por '+title+'" />' );
    } );

    // DataTable
    var table = $('#endings').DataTable({
        "order": [[ 1, "asc" ]]
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
