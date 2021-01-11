@extends('back.common.main')
@section('content')
<div class="content-i">
    <div class="content-box">
        <div class="element-wrapper">
            @if (\Session::has('message'))
                <div class="alert alert-success">{!! \Session::get('message') !!}</div>
            @endif
            <h6 class="element-header">Banners ({{$banners->count()}})
                <a href="{{ route('outlet.create') }}" class="btn btn-primary float-right"><i class="ti-plus"></i> Nuevo</a>
            </h6>
            <div class="element-box element-box-usuarios">
                <div class="table-responsive" >
                    <table width="100%" id="endings" class="table table-striped table-lightfont table-hover">
                        <thead>
                            <tr>
                                <th>Nombre</th>
                                <th>Activo</th>
                                <th class="td-acciones">Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                        @foreach($banners as $banner)
                            <tr role="row">
                                <td>
                                    <img src="{{ Storage::url($banner->image) }}" alt="" width="50px" height="auto">
                                    <strong>{{ $banner->name }}</strong>
                                </td>
                                <td>{{$banner->active == 1 ? 'Sí' : 'No'}}</td>
                                <td class="td-acciones">
                                    <div class="btn-group">
                                        <button aria-expanded="false" aria-haspopup="true" class="btn btn-default dropdown-toggle" data-toggle="dropdown" id="dropdownMenuButton2" type="button"><i class="icon-options-vertical"></i></button>
                                        <div aria-labelledby="dropdownMenuButton2" class="dropdown-menu dropdown-menu-right">
                                            <a class="dropdown-item" href="{{ route('outlet.edit', $banner->id) }}">
                                                <i class="icon-pencil"></i> Editar
                                            </a>
                                            <a class="delete-register dropdown-item" href="#" data-url="{{ route('outlet.destroy', $banner->id) }}" data-toggle="modal" data-target="#modal-delete"><i class="icon-trash"></i> Eliminar</a>

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
                <form action="{{route('outlet.featured')}}" method="post">
                    @csrf
                    <h4>
                        Productos destacados:
                    </h4>
                    <div class="row" id="noticias">
                        @for($i = 0; $i < 5; $i++)
                        <div class="col-sm-4">
                            <label>Producto número {{$i + 1}}</label>
                            <select name="productos_destacados[]" class="form-control select2">
                                <option value="">Selecciona un producto de la lista</option>
                                @foreach($products as $product)
                                    <option value="{{$product->id}}" {{isset($featured[$i]) && $product->id == $featured[$i]->product_id ? 'selected' : ''}}>{{$product->name}}</option>
                                @endforeach
                            </select>
                        </div>
                        @endfor
                    </div>
                    <div class="form-buttons-w">
                        <button class="btn btn-success" type="submit">Guardar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/css/select2.min.css" rel="stylesheet" />
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/js/select2.min.js"></script>
<script>
    $('.select2').select2();
</script>
@include('back.common.modals.modal-delete')
@endsection

@section('swal.error.text', "El Banner no se ha podido borrar porque se esta usando")

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
