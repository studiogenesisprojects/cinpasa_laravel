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
                    <table width="100%" id="banners" class="table table-striped table-lightfont table-hover">
                        <thead>
                            <tr>
                                <th>Orden</th>
                                <th>Nombre</th>
                                <th>Activo</th>
                                <th class="td-acciones">Acciones</th>
                            </tr>
                        </thead>
                        <tbody>
                        @foreach($banners as $banner)
                            <tr role="row">
                                <td>{{ $banner->order }}</td>
                                <td>
                                    @if(!empty($banner->image))
                                    <img src="{{ Storage::url($banner->image) }}" alt="{{ $banner->name }}" width="50px" height="auto">
                                    @endif
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
                                <th>Orden</th>
                                <th>Nombre</th>
                                <th>Activo</th>
                                <th class="td-acciones">Acciones</th>
                            </tr>
                        </tfoot>
                    </table>
                </div>
            </div>
        </div>
        <div class="element-wrapper">
            <h6 class="element-header">Productos outlet ({{ $products->count() }})
                <a href="{{ route('productos-outlet.create') }}" class="btn btn-primary float-right"><i class="ti-plus"></i> Nuevo producto outlet</a>
            </h6>
            <div class="element-box element-box-usuarios">
                <div class="table-responsive">
                    <table width="100%" id="products" class="table table-striped table-lightfont table-hover">
                        <thead>
                            <tr role="row">
                                <th>Orden</th>
                                <th>Nombre</th>
                                <th>Activo</th>
                                <th class="acciones">Acciones</th>
                            </tr>
                        </thead>
                        <tfoot>
                            <tr>
                                <th>Orden</th>
                                <th>Nombre</th>
                                <th>Activo</th>
                                <th class="acciones">Acciones</th>
                            </tr>
                        </tfoot>
                        <tbody>
                            @foreach($products as $product)
                            <tr role="row">
                                <td>{{ $product->order }}</td>
                                <td>{{ $product->name }}</td>
                                <td>{!! $product->active ? '<span class="text-success">Sí</span>' : '<span class="text-danger">No</span>' !!}</td>

                                <td class="acciones">
                                    <div class="btn-group">
                                        <button aria-expanded="false" aria-haspopup="true" class="btn btn-default dropdown-toggle" data-toggle="dropdown" id="dropdownMenuButton2" type="button"><i class="icon-options-vertical"></i></button>
                                        <div aria-labelledby="dropdownMenuButton2" class="dropdown-menu dropdown-menu-right">
                                            <a href="{{ route('productos.edit', $product->id)}}" class="dropdown-item"><i class="ti-pencil"></i> Editar</a>
                                            <a href="" class="dropdown-item delete-register" data-toggle="modal" data-target="#modal-delete" data-url="{{ route('products.destroy', $product->id) }}"><i class="ti-trash"></i> Eliminar</a>
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
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/css/select2.min.css" rel="stylesheet" />
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-beta.1/dist/js/select2.min.js"></script>
<script>
    $('.select2').select2();
</script>
@include('back.common.modals.modal-delete')
@endsection

@section('swal.error.text', "El Banner no se ha podido borrar porque se está usando.")

@section('js')
    <script>
    $(document).ready(function() {
        // Setup - add a text input to each footer cell
        $('#banners tfoot th').each( function () {
            var title = $(this).text();
            title!= "Acciones" && $(this).html( '<input class="form-control" type="text" placeholder="Buscar por '+title+'" />' );
        } );

         // Setup - add a text input to each footer cell
         $('#products tfoot th').each( function () {
            var title = $(this).text();
            title!= "Acciones" && $(this).html( '<input class="form-control" type="text" placeholder="Buscar por '+title+'" />' );
        } );

        // DataTable
        var table1 = $('#banners').DataTable({
            "order": [[ 0, "asc" ]],
            "columnDefs": [
                {
                    "targets": [ 2 ],
                    "searchable": false,
                    "orderable": false,
                },
                {
                    "targets": [ 3 ],
                    "searchable": false,
                    "orderable": false,
                },
            ],
            language: {
      			url: 'https://cdn.datatables.net/plug-ins/1.10.20/i18n/Spanish.json'
              }
        });

        // Apply the search
        table1.columns().every( function () {
            var that = this;

            $( 'input', this.footer() ).on( 'keyup change clear', function () {
               //if ( that.search() !== this.value ) {
                    that.search( this.value ).draw();
                //}
            } );
        } );



        // DataTable
        var table2 = $('#products').DataTable({
            "order": [[ 0, "asc" ]],
            "columnDefs": [
                {
                    "targets": [ 2 ],
                    "searchable": false,
                    "orderable": false,
                },
                {
                    "targets": [ 3 ],
                    "searchable": false,
                    "orderable": false,
                },
            ],
            language: {
      			url: 'https://cdn.datatables.net/plug-ins/1.10.20/i18n/Spanish.json'
              }
        });

        // Apply the search
        table2.columns().every( function () {
            var column = this;

            $( 'input', this.footer() ).on( 'keyup change clear', function () {
                //if ( column.search() !== this.value ) {
                    column.search( this.value ).draw();
                //}
            } );
        } );
} );
</script>
@endsection
