@extends('back.common.main')

@section('content')
<div class="content-i" id="app">
    <div class="content-box">
        <div class="element-wrapper">
            <h6 class="element-header">Escritorio </h6>
            @if(session('messages'))
            <div class="alert alert-success">{{ session('messages') }}</div>
            @endif
            <div class="element-box element-box-usuarios">
                <div class="table-responsive">
                    <h4>
                        Formulario de contacta
                    </h4>
                    <table id="information"  width="100%" class="table table-striped table-lightfont table-hover">
                        <thead>
                            <tr>
                                <th>Origen</th>
                                <th>Empresa</th>
                                <th>Email</th>
                                <th>Teléfono</th>
                                <th>País</th>
                                <th>Fecha de envío</th>
                                <th>Acciones</th>
                            </tr>
                        </thead>
                        <tfoot>
                            <tr>
                                <th>Origen</th>
                                <th>Empresa</th>
                                <th>Email</th>
                                <th>Teléfono</th>
                                <th>País</th>
                                <th>Fecha de envío</th>
                                <th>Acciones</th>
                            </tr>
                        </tfoot>
                        <tbody>
                            @foreach ($petitions as $petition)
                            <tr>
                                <td><a href="{{route('peticiones.show', $petition->id)}}">{{urldecode($petition->origen)}}</a></td>
                                <td>{{$petition->company}}</td>
                                <td>{{$petition->email}}</td>
                                <td>{{$petition->phone_number}}</td>
                                <td>{{$petition->country}}</td>
                                <td>{{$petition->created_at}}</td>
                                <td class="acciones">
                                    <div class="btn-group">
                                        <button aria-expanded="false" aria-haspopup="true" class="btn btn-default dropdown-toggle" data-toggle="dropdown" id="dropdownMenuButton2" type="button">
                                            <i class="icon-options-vertical"></i>
                                        </button>
                                        <div aria-labelledby="dropdownMenuButton2" class="dropdown-menu dropdown-menu-right">
                                            <a href="{{route('peticiones.show', $petition->id)}}" class="dropdown-item"><i class="ti-pencil"></i>Ver</a>
                                            <a href="" class="dropdown-item delete-register" data-toggle="modal" data-target="#modal-delete" data-url="{{route('peticiones.destroy', $petition->id)}}"><i class="ti-trash"></i> Eliminar</a>
                                        </div>
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
                <br><hr><br>
                <div class="row">
                    <div class="col-sm-5">
                        <div class="table-responsive">
                            <h4>
                                Curriculums recibidos
                            </h4>
                            <table  width="100%" class="table table-striped table-lightfont table-hover">
                                <thead>
                                    <tr>
                                        <th>Nombre</th>
                                        <th>Fecha de recepción</th>
                                        <th>Descargar</th>
                                    </tr>
                                </thead>
                                <tfoot>
                                    <tr>
                                        <th>Nombre</th>
                                        <th>Fecha de recepción</th>
                                        <th>Descargar</th>
                                    </tr>
                                </tfoot>
                                <tbody>
                                    @foreach ($currculumVitaes as $currculumVitaes)
                                    <tr>
                                        <td>{{$currculumVitaes->name}}</td>
                                        <td>{{$currculumVitaes->created_at}}</td>
                                        <td><a href="{{route('downloadCV', ['id' => $currculumVitaes->id])}}"> <span class="ti-download align-center"></span></a></td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                    <div class="col-sm-7">
                        <div class="table-responsive">
                            <h4>
                                Inscritos a ofertas de trabajo
                            </h4>
                            <table  width="100%" class="table table-striped table-lightfont table-hover">
                                <thead>
                                    <tr>
                                        <th>Nombre</th>
                                        <th>Email</th>
                                        <th>Teléfono</th>
                                        <th>Oferta donde aplica</th>
                                        <th>Información</th>
                                    </tr>
                                </thead>
                                <tfoot>
                                    <tr>
                                        <th>Nombre</th>
                                        <th>Email</th>
                                        <th>Teléfono</th>
                                        <th>Oferta donde aplica</th>
                                        <th>Información</th>
                                    </tr>
                                </tfoot>
                                <tbody>
                                    @foreach ($inscriptions as $inscription)
                                    <tr>
                                        <td>{{$inscription->name}}</td>
                                        <td>{{$inscription->email}}</td>
                                        <td>{{$inscription->phone_number}}</td>
                                        <td>{{$inscription->job_offer->name}}</td>
                                        <td>
                                            <ul class="list">
                                                <li>Fecha: {{\Carbon\Carbon::parse($inscription->created_at)->format('d-m-y')}}</li>
                                                <li>Navegador: {{$inscription->browser}}</li>
                                                <li>IP: {{$inscription->ip}}</li>
                                            </ul>
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
    </div>
</div>
@include('back.common.modals.modal-delete')
@endsection

@section('js')
<script>
    $(document).ready(function(){
        $('#information tfoot th').each( function () {
            var title = $(this).text();
            title!= "Acciones" && $(this).html( '<input class="form-control" type="text" placeholder="Buscar por '+title+'" />' );
        } );

        var table = $('#information').DataTable({
            "order": [[ 5, "desc" ]]
        });
        table.columns().every( function () {
            var that = this;
            $( 'input', this.footer() ).on( 'keyup change clear', function () {
                if ( that.search() !== this.value ) {
                    that
                        .search( this.value )
                        .draw();
                }
            } );
        });
    })
</script>
@endsection
