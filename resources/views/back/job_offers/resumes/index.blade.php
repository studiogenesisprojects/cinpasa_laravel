@extends('back.common.main')
@section('content')

<div class="content-i">
    <div class="content-box">
        <div class="element-wrapper">
            
            <div class="element-box">
                <h5 class="form-header">Curriculums</h5>
                <hr>
                <div class="p-2">
                    <div class="row">
                        <div class="col-sm-6">
                            <label>Buscar: </label>
                            <input class="form-control" id="searcher" />
                        </div>
                    </div>
                </div>
                <div class="table-responsive">
                    <table id="resumes" width="100%" class="table table-striped table-lightfont table-hover">
                        <thead>
                            <tr>
                                <th>Nombre</th>
                                <th>Fecha de recepción</th>
                                <th class="td-acciones"></th>
                            </tr>
                        </thead>
                        <tfoot>
                            <tr>
                                <th>Nombre</th>
                                <th>Fecha de recepción</th>
                                <th class="td-acciones"></th>
                            </tr>
                        </tfoot>
                        <tbody>
                            @foreach ($resumes as $resume)
                                <tr>
                                    <td>{{$resume->name}}</td>
                                    <td>{{$resume->created_at}}</td>
                                    <td>
                                        <div class="btn-group">
                                            <button aria-expanded="false" aria-haspopup="true" class="btn btn-default dropdown-toggle" data-toggle="dropdown" id="dropdownMenuButton2" type="button"><i class="icon-options-vertical"></i></button>
                                            <div aria-labelledby="dropdownMenuButton2" class="dropdown-menu dropdown-menu-right">
                                                <a href="{{ route('cvs.edit', $resume->id)}}" class="dropdown-item"><i class="ti-pencil"></i> Editar</a>
                                                <a href="{{ route('cvs.destroy', $resume->id)}}" class="dropdown-item delete-register" data-toggle="modal" data-target="#modal-delete" data-url="{{ route('cvs.destroy', $resume->id)}}"><i class="ti-trash"></i> Eliminar</a>
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
    var table = $('#resumes').DataTable({
        paging: false,
        language: {
            url: "https://cdn.datatables.net/plug-ins/1.10.20/i18n/Spanish.json"
        }
    });
    $('#searcher').keydown(function(event) {
        table.search(event.currentTarget.value).draw()
    })

    $('.delete-register').click(function(e) {
        url = $(this).data('url');
        $('#delete_link').attr('href', '#')
        $('#delete_link').click(function(d){
            axios.delete(url).then(function(res){
                console.log(res)
                window.location.reload()
            }).catch(function(error){
                console.log(error.response)
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
