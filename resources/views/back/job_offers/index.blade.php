@extends('back.common.main')
@section('content')

<div class="content-i">
    <div class="content-box">
        <div class="element-wrapper">
            <h6 class="element-header">Ofertas ({{$offers->count()}})
                <a href="{{route('ofertas-trabajo.create')}}" class="btn btn-primary float-right"><i class="ti-plus"></i> Nueva oferta</a>
            </h6>

            <div class="element-box">
                <h5 class="form-header">Ofertas</h5>
                <hr>
                <div class="table-responsive">
                    <table  width="100%" class="table table-striped table-lightfont table-hover">
                        <thead>
                            <tr>
                                <th>Nombre</th>
                                <th>Fecha de publicación</th>
                                <th>Fecha de finalización</th>
                                <th>Nº de inscritos</th>
                                <th class="td-acciones"></th>
                            </tr>
                        </thead>
                        <tfoot>
                            <tr>
                                <th>Nombre</th>
                                <th>Fecha de publicación</th>
                                <th>Fecha de finalización</th>
                                <th>Nº de inscritos</th>
                                <th class="td-acciones"></th>
                            </tr>
                        </tfoot>
                        <tbody>
                            @foreach ($offers as $offer)
                                <tr>
                                    <td>{{$offer->name}}</td>
                                    <td>{{$offer->publication_date}}</td>
                                    <td>{{$offer->end_date}}</td>
                                    <td>{{$offer->job_offer_inscriptions->count()}}</td>
                                    <td>
                                        <div class="btn-group">
                                            <button aria-expanded="false" aria-haspopup="true" class="btn btn-default dropdown-toggle" data-toggle="dropdown" id="dropdownMenuButton2" type="button"><i class="icon-options-vertical"></i></button>
                                            <div aria-labelledby="dropdownMenuButton2" class="dropdown-menu dropdown-menu-right">
                                                @if(Auth()->user()->role->canWrite(App\Models\Section::find(config('app.enabled_sections.solicitudes'))))
                                                    <a href="{{ route('ofertas-trabajo.edit', $offer->id)}}" class="dropdown-item"><i class="ti-pencil"></i> Editar</a>
                                                @endif
                                                
                                                @if(Auth()->user()->role->canDelete(App\Models\Section::find(config('app.enabled_sections.solicitudes'))))  
                                                    <a href="" class="dropdown-item delete-register" data-toggle="modal" data-target="#modal-delete" data-url="{{ route('ofertas-trabajo.destroy', $offer->id) }}"><i class="ti-trash"></i> Eliminar</a>
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
@endsection
@include('back.common.modals.modal-delete')
@section('js')
<script type="text/javascript">
    $('.delete-register').click(function(e) {
        url = $(this).data('url');
        $('#delete_link').attr('href', '#')
        $('#delete_link').click(function(d){
            axios.delete(url).then(function(res){
                //eleminar el tr de la tabla
                window.location.reload()
            }).catch(function(error){
                window.location.reload()
            })
        })
    });
    @if(session('success'))
    swal({
        title: "{{ session('success') }}",
        text: ' ',
        type: "success",
        timer: 2000
    });
    @endif
    @if(session('error'))
    swal({
        title: "{{ session('error') }}",
        text: ' ',
        type: "error",
        timer: 2000
    });
    @endif
</script>
@endsection
