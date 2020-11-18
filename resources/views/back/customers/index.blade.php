@extends('back.common.main')

@section('content')
<div class="content-i">
    <div class="content-box">
        <div class="element-wrapper">
            <h6 class="element-header">Clientes ({{ $customers->count() }})
                <a href="{{ route('createCustomer') }}" class="btn btn-primary float-right"><i class="ti-plus"></i> Nuevo</a>
            </h6>
            @if(session('messages'))
            <div class="alert alert-success">{{ session('messages') }}</div>
            @endif
            <div class="element-box element-box-usuarios">
                <div class="table-responsive">
                    <table width="100%" class="table table-striped table-lightfont table-hover">
                        <thead>
                            <tr>
                                <th width="20%">Logo</th>
                                <th>Nombre</th>
                                <th>Web</th>
                                <th>Orden</th>
                                <th>Activo</th>
                                <th class="td-acciones"></th>
                            </tr>
                        </thead>
                        <tfoot>
                            <tr>
                                <th>Logo</th>
                                <th>Nombre</th>
                                <th>Web</th>
                                <th>Orden</th>
                                <th>Activo</th>
                                <th class="td-acciones"></th>
                            </tr>
                        </tfoot>
                        <tbody>
                            @foreach($customers as $customer)
                            <tr role="row">
                                <td><img src="{{Storage::url($customer->logotype)}}" alt="" width="75px" height="50px"></td>
                                <td><strong>{{ $customer->name }}</strong></td>
                                <td>{{ $customer->web }}</td>
                                <td>{{ $customer->order }}</td>
                                <td> {!!($customer->status == 1) ? '<span class="text-success">Sí</span>' : '<span class="text-danger">No</span>'!!}</td>
                                <td class="td-acciones">
                                    <div class="btn-group">
                                        <button aria-expanded="false" aria-haspopup="true" class="btn btn-default dropdown-toggle" data-toggle="dropdown" id="dropdownMenuButton2" type="button"><i class="icon-options-vertical"></i></button>
                                        <div aria-labelledby="dropdownMenuButton2" class="dropdown-menu dropdown-menu-right">
                                            <a class="dropdown-item" href="{{ route('updateCustomer', $customer->id) }}">
                                                <i class="icon-pencil"></i> Editar
                                            </a>
                                            <a class="delete-register dropdown-item" href="#" data-url="{{ route('deleteCustomer', $customer->id) }}" data-toggle="modal" data-target="#modal-delete"><i class="icon-trash"></i> Eliminar</a>

                                        </div>
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                        </tbody>
                    </table>
                    {{$customers->links()}}
                </div>
            </div>
        </div>
    </div>
</div>
@include('back.common.modals.modal-delete')
@endsection
@section('swal.error.text', "No se ha podido borrar el cliente")

