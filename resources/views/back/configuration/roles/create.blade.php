@extends('back.common.main')

@section('content')
<div class="content-box">
    <div class="element-wrapper" id="app">
        <h6 class="element-header">
            Crear Rol
            <a href="{{ route('roles.index') }}" class="btn btn-white float-right">
                <i class="os-icon os-icon-chevron-left"></i> Volver
            </a>
        </h6>

        @if($errors->any())
        <div class="alert alert-danger">
            <p>No se ha podido crear el rol</p>
            <p>El nombre ya ha sido utilizado</p>
        </div>
        @endif

        <div class="row">
            <div class="col-sm-12">
                <div class="element-wrapper">
                    <div class="element-box">
                        <form id="formValidate" novalidate method="POST" action="{{ route('roles.store') }}">
                            @csrf

                            <div class="element-info">
                                <div class="element-info-with-icon">
                                    <div class="element-info-icon">
                                        <div class="ti-layout-cta-right"></div>
                                    </div>
                                    <div class="element-info-text">
                                        <h5 class="element-inner-header">Información del rol</h5>
                                    </div>
                                </div>
                            </div>

                            <div class="form-group">
                                <label for="name">Nombre del rol</label>
                                <input type="text" id="name" name="name" class="form-control"
                                       data-error="El nombre es obligatorio" required value="{{ old('name') }}">
                                <div class="help-block form-text with-errors form-control-feedback"></div>
                            </div>

                            <table class="table mt-4">
                                <thead>
                                    <tr>
                                        <th>Sección</th>
                                        <th>Acceso</th>
                                        <th>Escritura</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <tr>
                                        <td class="text-weight-bold">Todo</td>
                                        <td class="px-4"><input type="checkbox" id="toggleRead"></td>
                                        <td class="px-4"><input type="checkbox" id="toggleWrite"></td>
                                    </tr>
                                    @foreach ($sections as $key => $section)
                                    <tr>
                                        <td>
                                            {{ $section->name }}
                                            <input type="hidden" name="sections[{{ $key }}][section_id]" value="{{ $section->id }}">
                                        </td>
                                        <td class="px-4">
                                            <input type="checkbox" class="read" name="sections[{{ $key }}][read]">
                                        </td>
                                        <td class="px-4">
                                            <input type="checkbox" class="write" name="sections[{{ $key }}][write]">
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>

                            <div class="form-buttons-w mt-4">
                                <button class="btn btn-success" type="submit">Guardar</button>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

@section('js')
<script type="text/javascript">
    // Set "Todo" checkboxes based on current state
    $('#toggleRead').prop("checked", $('.read:checked').length === $('.read').length);
    $('#toggleWrite').prop("checked", $('.write:checked').length === $('.write').length);

    // Toggle all "read" checkboxes
    $('#toggleRead').on('change', function () {
        $('.read').prop('checked', this.checked);
    });

    // Toggle all "write" checkboxes
    $('#toggleWrite').on('change', function () {
        $('.write').prop('checked', this.checked);
    });
</script>
@endsection
