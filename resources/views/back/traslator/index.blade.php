@extends('back.common.main')

@section('content')
<div class="content-i">
    <div class="content-box">
        <div class="element-wrapper">
            <h6 class="element-header">Traducciones ({{ $traslators->count() }})
                <a href="{{ action('Back\Traslator\TraslatorController@newTranslate') }}" class="btn btn-primary float-right"><i class="ti-plus"></i> Nuevo</a>
            </h6>
            @if(session('messages'))
            <div class="alert alert-success">{{ session('messages') }}</div>
            @endif
            <div class="element-box element-box-usuarios">
                <h4>Traducciones</h4>
                <form action="" class="mb-2" method="post">
                    @csrf
                    <div class="row">
                        <div class="col-sm-6">
                            <label for="">Busca la cadena de texto que quieras cambiar!</label>
                            <input  class="form-control item" type="text" name="traduction">
                        </div>
                        <div class="col-sm-2">
                            <label for="">Tipo de busqueda</label>
                            <select name="type" class="form-control item" >
                                <option value="0">Por grupos</option>
                                <option value="1">Por cadena</option>
                            </select>
                        </div>

                        <div class="col-sm-2">
                            <button class="btn btn-success mt-4-special" type="submit">Buscar!</button>
                        </div>
                    </div>
                </form>
                <div class="table-responsive">
                    <table width="100%" class="table table-striped table-lightfont table-hover">
                        <thead>
                            <tr>
                                <th>Grupo de traducciones</th>
                                <th class="td-acciones"></th>
                            </tr>
                        </thead>
                        <tfoot>
                            <tr>
                                <th>Grupo de traducciones</th>
                                <th class="td-acciones"></th>
                            </tr>
                        </tfoot>
                        <tbody>
                            @foreach($traslators as $traslator)
                            <tr>
                                <td><strong>{{ $traslator->group }}<strong></td>
                                    <td class="td-acciones">
                                        <div class="btn-group">
                                            <button aria-expanded="false" aria-haspopup="true" class="btn btn-default dropdown-toggle" data-toggle="dropdown" id="dropdownMenuButton2" type="button"><i class="icon-options-vertical"></i></button>
                                            <div aria-labelledby="dropdownMenuButton2" class="dropdown-menu dropdown-menu-right">
                                                @if(Auth()->user()->role->canWrite(App\Models\Section::find(config('app.enabled_sections.traducciones'))))
                                                    <a class="dropdown-item" href="{{ action('Back\Traslator\TraslatorController@update', $traslator->group) }}">
                                                        <i class="icon-pencil"></i> Editar
                                                    </a>
                                                @endif

                                                @if(Auth()->user()->role->canDelete(App\Models\Section::find(config('app.enabled_sections.traducciones'))))
                                                    <a class="delete-register dropdown-item" href="#" data-url="{{ action('Back\Traslator\TraslatorController@delete', $traslator->group) }}" data-toggle="modal" data-target="#modal-delete"><i class="icon-trash"></i> Eliminar</a>
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

    $('.delete-register').click(function(e) {
        url = $(this).data('url');
        $('#delete_link').attr('href', url);
    });
</script>
@endsection
