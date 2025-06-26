@extends('back.common.main')

@section('content')

<div class="content-box">
    <div class="element-wrapper" id="app">
        <h6 class="element-header">
            Crear Usuario
            <a href="{{ route('usuarios.index') }}" class="btn btn-white float-right">
                <i class="os-icon os-icon-chevron-left"></i> Volver
            </a>
        </h6>

        @if($errors->any())
            <div class="alert alert-danger">
                <p><strong>No se ha podido crear el usuario:</strong></p>
                <ul class="mb-0">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <div class="row">
            <div class="col-sm-12">
                <div class="element-wrapper">
                    <div class="element-box">
                        <form id="formValidate" novalidate="true" method="post" action="{{ route('usuarios.store') }}">
                            {{ csrf_field() }}

                            <div class="element-info">
                                <div class="element-info-with-icon">
                                    <div class="element-info-icon">
                                        <div class="ti-layout-cta-right"></div>
                                    </div>
                                    <div class="element-info-text">
                                        <h5 class="element-inner-header">Información del usuario</h5>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <input type="hidden" id="active" name="active" value="{{ old('active', '') }}">

                                <div class="col-sm-10">
                                    <div class="form-group">
                                        <label for="">Nombre</label>
                                        <input type="text" name="name" class="form-control" value="{{ old('name') }}" data-error="El nombre es obligatorio" required>
                                        <div class="help-block form-text with-errors form-control-feedback"></div>
                                    </div>
                                </div>

                                <div class="col-sm-2">
                                    <div class="form-group">
                                        <button class="btn toggle-user btn-primary btn-sm ml-3 mt-4-special">
                                            {{ old('active') == '0' ? 'Activar' : 'Desactivar' }}
                                        </button>
                                    </div>
                                </div>

                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label for="">Email</label>
                                        <input type="text" name="email" class="form-control" value="{{ old('email') }}" data-error="El email es obligatorio" required>
                                        <div class="help-block form-text with-errors form-control-feedback"></div>
                                    </div>
                                </div>

                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label for="">Contraseña</label>
                                        <input type="password" name="password" class="form-control" data-error="Introduzca una contraseña" required>
                                        <div class="help-block form-text with-errors form-control-feedback"></div>
                                    </div>
                                </div>

                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <label for="">Rol</label>
                                        <select class="form-control" name="role_id">
                                            @foreach ($roles as $rol)
                                                <option value="{{ $rol->id }}" {{ old('role_id') == $rol->id ? 'selected' : '' }}>
                                                    {{ $rol->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                            </div>

                            <div class="form-buttons-w">
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
<script>
    $('.toggle-user').each(function(i, e){
        $(e).click(function (e){
            e.preventDefault();

            if($('#active').val() == '1'){
                $(e.currentTarget).addClass('btn-primary').removeClass('btn-danger').html("Activar");
                $('#active').val(0);
            } else {
                $(e.currentTarget).addClass('btn-danger').removeClass('btn-primary').html("Desactivar");
                $('#active').val(1);
            }
        });

        // Initialize state based on old value
        if ($('#active').val() == '1') {
            $(e).addClass('btn-danger').removeClass('btn-primary').html("Desactivar");
        } else {
            $(e).addClass('btn-primary').removeClass('btn-danger').html("Activar");
        }
    });
</script>
@endsection
