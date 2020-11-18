@extends('back.common.main')

@section('content')

<div class="content-box">
    <div class="element-wrapper" id="app">
        <h6 class="element-header">Crear Usuario
            <a href="{{route('usuarios.index')}}" class="btn btn-white float-right"><i
                class="os-icon os-icon-chevron-left"></i> Volver</a>
            </h6>
            @if($errors->any())
            <div class="alert alert-danger">
                <p>No se ha podido crear el usuario</p>
                <p>Asegúrate de introducir los campos obligatorios</p>
            </div>
            @endif
            <div class="row">
                <div class="col-sm-12">
                    <div class="element-wrapper">
                        <div class="element-box">
                            <form id="formValidate" novalidate="true" method="post" action="{{route('usuarios.store')}}">
                            {{ csrf_field() }}
                            <div class="element-info">
                                <div class="element-info-with-icon">
                                    <div class="element-info-icon">
                                        <div class="ti-layout-cta-right"></div>
                                    </div>
                                    <div class="element-info-text">
                                        <h5 class="element-inner-header">Información del usuario </h5>
                                    </div>
                                </div>
                            </div>

                            <div class="row">
                                <input type="hidden" id="active" name="active" value="">
                                <div class="col-sm-10">
                                    <div class="form-group">
                                        <label for="">Nombre</label>
                                    <input type="text" name="name" class="form-control" data-error="El nombre es obligatorio" required>
                                        <div class="help-block form-text with-errors form-control-feedback"></div>
                                    </div>
                                </div>
                                <div class="col-sm-2">
                                    <div class="form-group">
                                        <button class="btn toggle-user btn-primary btn-sm ml-3 mt-4-special">Desactivar</button>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label for="">Email</label>
                                    <input type="text" name="email" class="form-control" data-error="El email es obligatorio" required>
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
                                            <option value={{$rol->id}}>{{$rol->name}}</option>
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
@endsection
@section('js')
<script>
    $('.toggle-user').each(function(i, e){
        $(e).click(function (e){
            e.preventDefault()

                if($(e.currentTarget).hasClass('btn-primary')){
                    $(e.currentTarget).addClass('btn-danger').removeClass('btn-primary').html("Desactivar")
                    $('#active').val(1)
                }else{
                    $(e.currentTarget).addClass('btn-primary').removeClass('btn-danger').html("Activar")
                    $('#active').val(0)
                }
            })
        })
</script>
@endsection
