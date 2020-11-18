@extends('back.common.main')

@section('content')

<div class="content-box">
    <div class="element-wrapper" id="app">
        <h6 class="element-header">Customer
            <a href="{{route('customers')}}" class="btn btn-white float-right"><i
                class="os-icon os-icon-chevron-left"></i> Volver
            </a>
        </h6>
        <div class="row">
            <div class="col-sm-12">
                <div class="element-wrapper">
                    <div class="element-box">
                        @if ($errors->any())
                        <ul class="list">
                            @foreach ($errors->all() as $error)
                            <li class="text-danger">{{$error}}</li>
                            @endforeach
                        </ul>
                        @endif
                        <form id="formValidate" novalidate="true" method="post" action="{{route('storeCustomer')}}" enctype="multipart/form-data">
                            @csrf
                            <div class="element-info">
                                <div class="element-info-with-icon">
                                    <div class="element-info-icon">
                                        <div class="ti-layout-cta-right"></div>
                                    </div>
                                    <div class="element-info-text">
                                        <h5 class="element-inner-header">Información del cliente</h5>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label for="">Nombre del cliente</label>
                                        <input type="text" name="name" class="form-control" data-error="Introduzca un nombre" required>
                                        <div class="help-block form-text with-errors form-control-feedback"></div>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label for="">Orden de aparición</label>
                                        <input type="number" name="order" class="form-control" data-error="Introduzca un orden" required>
                                        <div class="help-block form-text with-errors form-control-feedback"></div>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label for="">Página Web</label>
                                        <input type="text" name="web" class="form-control" data-error="Introduzca una página web" required>
                                        <div class="help-block form-text with-errors form-control-feedback"></div>
                                    </div>
                                </div>
                                <div class="col-sm-6">
                                    <div class="form-group">
                                        <label for="">Activo</label>
                                        <select name="status" data-error="Por favor seleccione un dia" class="form-control" required>
                                            <option value="1">Sí</option>
                                            <option value="0">No</option>
                                        </select>
                                        <div class="help-block form-text with-errors form-control-feedback"></div>
                                    </div>
                                </div>
                            </div>
                            <div class="row" id="app">
                                <div class="col-md-2" v-for="(image, imgIndex) in images">
                                    <div id="preview">
                                        <img class="w-100 mb-3" v-if="images[imgIndex].url" :src="images[imgIndex].url" />
                                    </div>
                                    <label class="btn p-0 m-0" :for=`sel${imgIndex}`>
                                        <input :name=`images[${imgIndex}]` :id=`sel${imgIndex}` type="file" class="d-none" @change="onFileChange($event, imgIndex)">
                                        <span v-if="!image.url && imgIndex == 0 " class="btn btn-outline-success">Añadir imágen</span>
                                    </label>
                                    <button type="button" v-if="image.url" class="ml-0 btn btn-outline-danger" v-on:click="removeImage(imgIndex)">Eliminar</button>
                                </div>
                            </div>
                            <div class="form-buttons-w">
                                <button class="btn btn-success" type="submit">Guardar</button>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('js')
<script src="https://cdn.jsdelivr.net/npm/vue/dist/vue.js"></script>

<script>
    const aplication = new Vue({
        el: '#app',
        data: {
            images: [{url:null}]
        },
        updated(){

        },
        mounted(){

        },
        methods: {
            removeImage: function(i){this.images.splice(i, 1)},
            onFileChange: function(e, i){
                const file = e.target.files[0];
                this.$set(this.images[i],'url', URL.createObjectURL(file));
                this.images.push({url:null})
            },
        }
    });
</script>
@endsection
