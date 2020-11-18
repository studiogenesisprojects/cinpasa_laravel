@extends('back.common.main')

@section('content')
<div class="content-i">
    <div class="content-box">
        <div class="element-wrapper">
            <h6 class="element-header">Tipos ({{ $types->count() }})
                <a href="{{ route('typeUpdate') }}" class="btn btn-primary float-right"><i class="ti-plus"></i> Nuevo</a>
            </h6>
            @if(session('messages'))
            <div class="alert alert-success">{{ session('messages') }}</div>
            @endif
            <div class="element-box element-box-usuarios">
                <div class="table-responsive">
                    <table width="100%" class="table table-striped table-lightfont table-hover">
                        <thead>
                            <tr>
                                <th>Nombre</th>
                                <th>Descripción</th>
                                <th>Estado</th>
                                <th class="td-acciones"></th>
                            </tr>
                        </thead>
                        <tfoot>
                            <tr>
                                <th>Nombre</th>
                                <th>Descripción</th>
                                <th>Estado</th>
                                <th class="td-acciones"></th>
                            </tr>
                        </tfoot>
                        <tbody>
                            @foreach($types as $type)
                            <tr role="row">
                                <td><strong>{{ $type->lang()->name }}</strong></td>
                                <td>{{ $type->lang()->description }}</td>
                                <th>{{ $type->active ? "Activo" : "Desactivado" }}</th>
                                <td class="td-acciones">
                                    <div class="btn-group">
                                        <button aria-expanded="false" aria-haspopup="true" class="btn btn-default dropdown-toggle" data-toggle="dropdown" id="dropdownMenuButton2" type="button"><i class="icon-options-vertical"></i></button>
                                        <div aria-labelledby="dropdownMenuButton2" class="dropdown-menu dropdown-menu-right">
                                            <a class="dropdown-item" href="{{ route('typeUpdate', $type->id) }}">
                                                <i class="icon-pencil"></i> Editar
                                            </a>
                                            <a class="delete-register dropdown-item" href="#" data-url="{{ route('typeDelete', $type->id) }}" data-toggle="modal" data-target="#modal-delete"><i class="icon-trash"></i> Eliminar</a>

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
@section('swal.error.text', "El tipo no se ha podido borrar porque se esta usando")

