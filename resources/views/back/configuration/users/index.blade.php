@extends('back.common.main')
@section('content')

<div class="content-i">
    <div class="content-box">
        <div class="element-wrapper">
            <h6 class="element-header">Usuarios ({{$users->count()}})
                <a href="{{route('usuarios.create')}}" class="btn btn-primary float-right"><i class="ti-plus"></i> Nuevo usuario</a>
            </h6>

            <div class="element-box">
                <h5 class="form-header">Usuarios</h5>
                <hr>
                <div class="table-responsive">
                    <table  width="100%" class="table table-striped table-lightfont table-hover">
                        <thead>
                            <tr>
                                <th>Nombre</th>
                                <th>Último acceso</th>
                                <th>Role</th>
                                <th class="td-acciones"></th>
                            </tr>
                        </thead>
                        <tfoot>
                            <tr>
                                <th>Nombre</th>
                                <th>Último acceso</th>
                                <th>Role</th>
                                <th class="td-acciones"></th>
                            </tr>
                        </tfoot>
                        <tbody>
                            @foreach ($users as $user)
                                <tr>
                                    <td>{{$user->name}}</td>
                                    <td>{{$user->role->name}}</td>
                                    <td>{{\Carbon\Carbon::parse($user->last_login)->format('d-m-y H:i')}}</td>
                                    <td>
                                        <div class="btn-group">
                                            <button aria-expanded="false" aria-haspopup="true" class="btn btn-default dropdown-toggle" data-toggle="dropdown" id="dropdownMenuButton2" type="button"><i class="icon-options-vertical"></i></button>
                                            <div aria-labelledby="dropdownMenuButton2" class="dropdown-menu dropdown-menu-right">
                                                <a href="{{ route('usuarios.edit', $user->id)}}" class="dropdown-item"><i class="ti-pencil"></i> Editar</a>
                                                <a href="" class="dropdown-item delete-register" data-toggle="modal" data-target="#modal-delete" data-url="{{ route('usuarios.destroy', $user->id) }}"><i class="ti-trash"></i> Eliminar</a>
                                            </div>
                                        </div>
                                        <button user="{{$user->id}}" class="btn toggle-user btn-sm ml-3 {{$user->active ? "btn-danger" : "btn-primary"}} ">{{$user->active ? "Desactivar" : "Activar"}}</button>
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
                //window.location.reload()
                $(e.currentTarget).closest("tr").remove();
                $("#modal-delete").modal("toggle");
                swal({
                    title: res.data.success,
                    text: '',
                    type: 'success',
                    timer:2000
                })
            }).catch(function(error){
                $("#modal-delete").modal("toggle");
                swal({
                    title: error.response.data.error,
                    text: '',
                    type: 'error',
                    timer:2000
                })
            })
        })
    });

    $('.toggle-user').each(function(i, e){
        $(e).click(function (e){
            axios.post('usuarios/toggle', {id: $(e.currentTarget).attr('user')})
            .then(function(res){
                console.log(res)
                if(res.data.state){
                    $(e.currentTarget).addClass('btn-danger').removeClass('btn-primary').html("Desactivar") 
                }else{
                    $(e.currentTarget).addClass('btn-primary').removeClass('btn-danger').html("Activar") 
                }
            })
            .catch(function(error){
                console.log(error.response)
            })
        })
    })

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

{{--TODO include modal info --}}
<div class="modal fade stick-up in" id="modal_info" tabindex="-1" role="dialog" aria-hidden="false" style="display: none;">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header clearfix text-left">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true"><i class="pg-close fs-14"></i></button>
                <h4><span class="semi-bold text-primary">Info</span></h4>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-12">
                        <p id="mensaje_aviso"></p>
                    </div>
                </div>
            </div>
            <div class="modal-footer text-left">
                <button class="btn btn-default pull-right" data-dismiss="modal">Cerrar</button>
            </div>
        </div>
    </div>
</div>
@endsection