@extends('back.common.main')
@section('content')

<div class="content-i">
    <div class="content-box">
        <div class="element-wrapper">
            <h6 class="element-header">Peticiones ({{$petitions->count()}})</h6>
            <div class="element-box">
                <a href="{{ route('petitionsExcel') }}" class="btn btn-primary float-right"><i class="far fa-file-excel"></i> Exportar Datos</a>
                <h5 class="form-header">Peticiones</h5>
                <hr>
                <div class="table-responsive">
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
                                            @if(Auth()->user()->role->canDelete(App\Models\Section::find(config('app.enabled_sections.peticiones'))))
                                                <a href="" class="dropdown-item delete-register" data-toggle="modal" data-target="#modal-delete" data-url="{{route('peticiones.destroy', $petition->id)}}"><i class="ti-trash"></i> Eliminar</a>
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
@section('js')
<script type="text/javascript">
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
