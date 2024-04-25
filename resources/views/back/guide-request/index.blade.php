@extends('back.common.main')

@section('content')

<div class="content-i" id="app">
    <div class="content-box">
        <div class="element-wrapper">
            <h6 class="element-header">Solcitudes de productos ({{ $guideRequests->count() }})</h6>
            <div class="element-box element-box-usuarios">
                <div class="row">
                    <div class="col-sm-12 mb-3">
                        <button id="download-excel" class="btn btn-primary">Descargar solicitudes</button>
                    </div>
                </div>
                <div class="table-responsive">
                    <table width="100%" id="products" class="table table-striped table-lightfont table-hover">
                        <thead>
                            <tr role="row">
                                <th>Correo</th>
                                <th>Nombre producto</th>
                                <th>Fichero</th>
                                <th>Fecha de solitiud</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($guideRequests as $guideRequest)
                            <tr role="row">
                                <td>{{ $guideRequest->email }}</td>
                                <td>{{ $guideRequest->product->name }}</td>
                                <td> 
                                    <a href="{{ asset(Storage::url('public/productos/guia-tecnica/'.$guideRequest->product->technical_guide_file)) }}">
                                        {{$guideRequest->product->technical_guide_file}} 
                                    </a>
                                </td>
                                <td>{{ $guideRequest->created_at }}</td>

                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</div>

@section('js')
    <script>
        $('#download-excel').click(function(e){
            axios.get('/admin/solicitudes-guias/download-excel', { responseType: "blob" })
                .then(response => {
                    const url = window.URL.createObjectURL(new Blob([response.data]));
                    const link = document.createElement("a");
                    link.href = url;
                    link.setAttribute("download", "guide-request.xls");
                    document.body.appendChild(link);
                    link.click();
                })
        })   
    </script>
@endsection
@endsection
