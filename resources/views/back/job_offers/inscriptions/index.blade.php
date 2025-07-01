@extends('back.common.main')
@section('content')

<div class="content-i">
    <div class="content-box">
        <div class="element-wrapper">

            <div class="element-box">
                <h5 class="form-header">Inscripciones</h5>
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
                    <table id="inscriptions" width="100%" class="table table-striped table-lightfont table-hover">
                        <thead>
                            <tr>
                                <th>Nombre</th>
                                <th>Email</th>
                                <th>Teléfono</th>
                                <th>Oferta donde aplica</th>
                                <th>Información</th>
                                <th class="td-acciones"></th>
                            </tr>
                        </thead>
                        <tfoot>
                            <tr>
                                <th>Nombre</th>
                                <th>Email</th>
                                <th>Teléfono</th>
                                <th>Oferta donde aplica</th>
                                <th>Información</th>
                                <th class="td-acciones"></th>
                            </tr>
                        </tfoot>
                        <tbody>
                            @foreach ($inscriptions as $inscription)
                                <tr>
                                    <td>{{$inscription->name}}</td>
                                    <td>{{$inscription->email}}</td>
                                    <td>{{$inscription->phone_number}}</td>
                                    <td>{{$inscription->job_offer->name ?? "sin-oferta"}}</td>
                                    <td>
                                        <ul class="list">
                                            <li>Fecha: {{\Carbon\Carbon::parse($inscription->created_at)->format('d-m-y')}}</li>
                                            <li>Navegador: {{$inscription->browser}}</li>
                                            <li>IP: {{$inscription->ip}}</li>
                                        </ul>
                                    </td>
                                    <td>
                                        <div class="btn-group">
                                            <button aria-expanded="false" aria-haspopup="true" class="btn btn-default dropdown-toggle" data-toggle="dropdown" id="dropdownMenuButton2" type="button"><i class="icon-options-vertical"></i></button>
                                            <div aria-labelledby="dropdownMenuButton2" class="dropdown-menu dropdown-menu-right">
                                                @if(Auth()->user()->role->canWrite(App\Models\Section::find(config('app.enabled_sections.solicitudes'))))
                                                    <a href="{{ route('inscritos.edit', $inscription->id)}}" class="dropdown-item"><i class="ti-pencil"></i> Editar</a>
                                                @endif
                                                
                                                @if(Auth()->user()->role->canDelete(App\Models\Section::find(config('app.enabled_sections.solicitudes'))))
                                                    <a href="{{ route('inscritos.destroy', $inscription->id)}}" class="dropdown-item delete-register" data-toggle="modal" data-target="#modal-delete" data-url="{{ route('inscritos.destroy', $inscription->id)}}"><i class="ti-trash"></i> Eliminar</a>
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

    var table = $('#inscriptions').DataTable({
        paging: false,
        language: {
            url: "https://cdn.datatables.net/plug-ins/1.10.20/i18n/Spanish.json"
        }
    });
    $('#searcher').keydown(function(event) {
        //console.log(event.currentTarget.value);
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
