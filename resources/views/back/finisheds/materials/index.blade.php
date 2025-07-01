@extends('back.common.main')
@section('content')

<div class="content-i">
    <div class="content-box">
        <div class="element-wrapper">
            <h6 class="element-header">Materiales ({{$materials->count()}})
                <a href="{{route('materiales-acabados.create')}}" class="btn btn-primary float-right"><i class="ti-plus"></i> Nuevo Material</a>
            </h6>

            <div class="element-box">
                <h5 class="form-header">Materiales de acabados</h5>
                <hr>
                <div class="table-responsive">
                    <table  width="100%" class="table table-striped table-lightfont table-hover">
                        <thead>
                            <tr>
                                <th>Nombre</th>
                                <th class="td-acciones"></th>
                            </tr>
                        </thead>
                        <tfoot>
                            <tr>
                                <th>Nombre</th>
                                <th class="td-acciones"></th>
                            </tr>
                        </tfoot>
                        <tbody>
                            @foreach ($materials as $material)
                                <tr>
                                    <td>{{$material->lang()->name}}</td>
                                    <td>
                                        <div class="btn-group">
                                            <button aria-expanded="false" aria-haspopup="true" class="btn btn-default dropdown-toggle" data-toggle="dropdown" id="dropdownMenuButton2" type="button"><i class="icon-options-vertical"></i></button>
                                            <div aria-labelledby="dropdownMenuButton2" class="dropdown-menu dropdown-menu-right">
                                                @if(Auth()->user()->role->canWrite(App\Models\Section::find(config('app.enabled_sections.acabados'))))
                                                    <a href="{{ route('materiales-acabados.edit', $material->id)}}" class="dropdown-item"><i class="ti-pencil"></i> Editar</a>
                                                @endif
                                                @if(Auth()->user()->role->canDelete(App\Models\Section::find(config('app.enabled_sections.acabados'))))
                                                    <a href="" class="dropdown-item delete-register" data-toggle="modal" data-target="#modal-delete" data-url="{{ route('materiales-acabados.destroy', $material->id) }}"><i class="ti-trash"></i> Eliminar</a>
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
                $(e.currentTarget).closest("tr").remove();
                $("#modal-delete").modal("toggle");
                swal({
                    title: "Elimnado correctamente",
                    text: '',
                    type: 'success',
                    timer:2000
                })
            }).catch(function(error){
                console.log(error.response)
                $("#modal-delete").modal("toggle");
                swal({
                    title: "Error al intentar eliminar ",
                    text: '',
                    type: 'error',
                    timer:2000
                })
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
