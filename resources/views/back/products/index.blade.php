@extends('back.common.main')

@section('content')

<div class="content-i" id="app">
    <div class="content-box">
        <div class="element-wrapper">
            <h6 class="element-header">Productos ({{ $products->count() }})
                <a href="{{ route('productos.create') }}" class="btn btn-primary float-right"><i class="ti-plus"></i> Nuevo producto</a>
            </h6>
            <div class="element-box element-box-usuarios">
                <div class="row">
                    <div class="col-sm-12 mb-3">
                        <button id="download-excel" class="btn btn-primary">Descargar productos por categorias</button>
                        <button id="download-excel-apps" class="btn btn-primary">Descargar productos por aplicaciones</button>

                    </div>
                </div>
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
    @include('back.common.modals.modal-delete')
    @section('js')

        <script>
            $(document).ready(function() {
            // Setup - add a text input to each footer cell
            $('#products tfoot th').each( function () {
                var title = $(this).text();
                title!= "Acciones" && $(this).html( '<input class="form-control" type="text" placeholder="Buscar por '+title+'" />' );
            } );

            // DataTable
            var table = $('#products').DataTable({
                "order": [[ 0, "asc" ]],
                "lengthChange" : false,
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

            //download excel
            $('#download-excel').click(function(e){
                axios.get('/admin/productos/download-excel', { responseType: "blob" })
                    .then(response => {
                        const url = window.URL.createObjectURL(new Blob([response.data]));
                        const link = document.createElement("a");
                        link.href = url;
                        link.setAttribute("download", "file.xls");
                        document.body.appendChild(link);
                        link.click();
                    })
            })
            $('#download-excel-apps').click(function(e){
                axios.get('/admin/productos/download-excel-apps', { responseType: "blob" })
                    .then(response => {
                        const url = window.URL.createObjectURL(new Blob([response.data]));
                        const link = document.createElement("a");
                        link.href = url;
                        link.setAttribute("download", "file.xls");
                        document.body.appendChild(link);
                        link.click();
                    })
            })
        });
        </script>
    @endsection

@endsection


