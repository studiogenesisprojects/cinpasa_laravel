@extends('back.common.main')

@section('content')

<div class="content-box">
    <div class="element-wrapper" id="app">
        <h6 class="element-header">Crear Rol
            <a href="{{route('roles.index')}}" class="btn btn-white float-right"><i
                class="os-icon os-icon-chevron-left"></i> Volver</a>
            </h6>
            @if($errors->any())
            <div class="alert alert-danger">
                <p>No se ha podido crear el role</p>
                <p>El nombre y ha sido utilizado</p>
            </div>
            @endif
            <div class="row">
                <div class="col-sm-12">
                    <div class="element-wrapper">
                        <div class="element-box">
                            <form id="formValidate" novalidate="true" method="post" action="{{route('roles.update', $role->id)}}">
                            {{ csrf_field() }}
                            @method('PUT')
                            <div class="element-info">
                                <div class="element-info-with-icon">
                                    <div class="element-info-icon">
                                        <div class="ti-layout-cta-right"></div>
                                    </div>
                                    <div class="element-info-text">
                                        <h5 class="element-inner-header">Editar Role</h5>
                                    </div>
                                </div>
                            </div>

                            <div class="row">

                                <div class="col-sm-12">
                                    <div class="form-group">
                                        <label for="">Nombre del rol</label>
                                    <input type="text" name="name" class="form-control" data-error="El nombre es obligatorio" required value={{$role->name}}>
                                        <div class="help-block form-text with-errors form-control-feedback"></div>
                                    </div>
                                </div>

                                <table>
                                    <thead>
                                        <tr>
                                            <td>Sección</td>
                                            <td>Acceso</td>
                                            <td>Escritura</td>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr>
                                            <td class="text-wight-bold">Todo</td>
                                            <td class="px-4"><input id="toggleRead" type="checkbox"></td>
                                            <td class="px-4"><input id="toggleWrite" type="checkbox"></td>
                                        </tr>
                                        @foreach ($sections as $key => $section)
                                            @if ($section->id < 16)
                                            <tr>
                                                <td>{{$section->name}} <input name="sections[{{$key}}][section_id]" value="{{$section->id}}" hidden/></td>
                                                <td class="px-4">
                                                    <input name="sections[{{$key}}][read]" class="read" type="checkbox" {{$role->canRead($section) ? "checked" : ""}} />
                                                </td>
                                                <td class="px-4">
                                                    <input name="sections[{{$key}}][write]" class="write" type="checkbox" {{$role->canWrite($section) ? "checked" : ""}} />
                                                </td>
                                            </tr>
                                            @endif
                                        @endforeach
                                    </tbody>
                                </table>

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
    <script type="text/javascript">
        $('#toggleRead').prop("checked", $('.read').prop("checked"))
        $('#toggleWrite').prop("checked", $('.write').prop("checked"))

        $('#toggleRead').change(function(e){
            var checkBoxes = $('.read');
            checkBoxes.prop("checked", !checkBoxes.prop("checked"));
            })
        $('#toggleWrite').change(function(e){
            var checkBoxes = $('.write');
            checkBoxes.prop("checked", !checkBoxes.prop("checked"));
            })
    </script>
@endsection
