@extends('back.common.main')

@section('content')

<div class="content-box">
    <div class="element-wrapper" id="app">
        <h6 class="element-header">
            Editar Usuario
            <a href="{{ route('usuarios.index') }}" class="btn btn-white float-right">
                <i class="os-icon os-icon-chevron-left"></i> Volver
            </a>
        </h6>

        @if($errors->any())
            <div class="alert alert-danger">
                <p><strong>No se ha podido actualizar el usuario:</strong></p>
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
                        <form id="formValidate" novalidate="true" method="post" action="{{ route('usuarios.update', $user->id) }}">
                            @method('PUT')
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
                                <div class="col-sm-5">
                                    <div class="form-group">
                                        <label for="">Nombre</label>
                                        <input type="text" name="name" class="form-control" data-error="El nombre es obligatorio" required value="{{ old('name', $user->name) }}">
                                        <div class="help-block form-text with-errors form-control-feedback"></div>
                                    </div>
                                </div>

                                <div class="col-sm-5">
                                    <div class="form-group">
                                        <label for="">Email</label>
                                        <input type="text" name="email" class="form-control" data-error="El email es obligatorio" required value="{{ old('email', $user->email) }}">
                                        <div class="help-block form-text with-errors form-control-feedback"></div>
                                    </div>
                                </div>

                                <div class="col-sm-2">
                                    <div class="form-group">
                                        <button user="{{ $user->id }}" class="btn toggle-user btn-sm ml-3 mt-4-special {{ $user->active ? 'btn-danger' : 'btn-primary' }}">
                                            {{ $user->active ? 'Desactivar' : 'Activar' }}
                                        </button>
                                    </div>
                                </div>

                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <label for="">Rol</label>
                                        <select class="form-control" name="role_id">
                                            @foreach ($roles as $rol)
                                                <option value="{{ $rol->id }}" {{ old('role_id', $user->role_id) == $rol->id ? 'selected' : '' }}>
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
            axios.post("{{ route('toggleUsers') }}", { id: $(e.currentTarget).attr('user') })
                .then(function(res){
                    if(res.data.state){
                        $(e.currentTarget).addClass('btn-danger').removeClass('btn-primary').html("Desactivar");
                    } else {
                        $(e.currentTarget).addClass('btn-primary').removeClass('btn-danger').html("Activar");
                    }
                })
                .catch(function(error){
                    console.log(error.response);
                });
        });
    });
</script>
@endsection
