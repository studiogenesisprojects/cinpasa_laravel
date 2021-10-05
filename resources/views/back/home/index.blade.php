@extends('back.common.main')

@section('content')
<div class="content-i">
    <div class="content-box">
        <div class="element-wrapper">
            <h6 class="element-header">Escritorio </h6>
            @if(session('messages'))
            <div class="alert alert-success">{{ session('messages') }}</div>
            @endif
            <div class="element-box element-box-usuarios">
                <form method="post" action="{{route('homeUpdate')}}">
                    @csrf
                    <h4>
                        Aplicaciones:
                    </h4>
                    <div class="row" id="home">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="">Aplicaciones</label>
                                <select class="form-control" v-model="appToAdd" @change="handleSelectApp">
                                    <option v-for="aplication in applications" :value="aplication.id" >@{{ aplication.name }}</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="">Categorías de aplicación</label>
                                <select class="form-control" v-model="appToAdd" @change="handleSelectCatApp">
                                    <option v-for="category in categories" :value="category.id" >@{{ category.name }}</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-sm-12">
                            <small>Elige un aplicación para añadir</small>
                            <hr>
                            <draggable @change="handleOrderChange" v-model="selectedApps">
                                <div class="row py-3 mb-3 border " v-for="app in selectedApps">
                                    <div class="col-10">
                                        @{{ app.name }}
                                    </div>
                                    <div class="col-2">
                                        <button type="button" @click="handleDeleteSelected(app)" class="btn btn-sm btn-danger">Eliminar</button>
                                    </div>
                                </div>
                            </draggable>

                        </div>
                    </div>
                    <hr>
                    <h4>
                        Noticias:
                    </h4>
                    <div class="row">
                        <div class="col-sm-3">
                            <input type="radio" name="select_type" value="1" id="manual" @if($manual) checked @endif> Seleccionar 3 noticias manualmente
                        </div>
                        <div class="col-sm-3">
                            <input type="radio" name="select_type" value="0" id="date" @if(!$manual) checked @endif> Seleccionar las 3 ultimas noticias
                        </div>
                    </div>
                    <br>
                    <div class="row" id="noticias">
                        @for ($i = 0; $i < 3; $i++)
                        <div class="col-sm-4">
                            <label>Noticia número {{ $i +1 }} </label>
                            <select name="main_noticias[]" class="form-control select2">
                                <option value=""></option>
                                @foreach ($news as $n)
                                <option value="{{$n->id}}" {{ ((!empty($newsFeatured[$i])) && ($newsFeatured[$i]->news_id === $n->id)) ? 'selected' : ''}}>{{$n->lang()->title}}</option>
                                @endforeach
                            </select>
                        </div>
                        @endfor
                    </div>
                    <div class="form-buttons-w">
                        <button class="btn btn-success" type="submit">Guardar</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>

@include('back.common.modals.modal-delete')
@endsection

@section('js')
<script src="https://cdn.jsdelivr.net/npm/vue/dist/vue.js"></script>
<script src="//cdn.jsdelivr.net/npm/sortablejs@1.8.4/Sortable.min.js"></script>
<script src="//cdnjs.cloudflare.com/ajax/libs/Vue.Draggable/2.20.0/vuedraggable.umd.min.js"></script>
<script>

    const aplication = new Vue({
        el: '#home',
        data: {
            enabled: true,
            dragging: true,
            products: @json($products),
            categories: @json($applicationCategories),
            applications: @json($aplications),
            canDrag: true,
            appToAdd: undefined,
            selectedApps: @json($homeApps),
        },
        mounted(){
        },
        methods: {
            handleOrderChange: function(e){
                this.sync()
            },
            sync: function(){
                axios.post('/admin/home-aplications/sync', {
                    applications: this.selectedApps,
                })
                    .then(r => {
                        console.log(r)
                    })
                    .catch(e => console.log(e.response));
            },
            handleDeleteSelected: function(e){
                this.$delete(this.selectedApps, this.selectedApps.indexOf(e));
                this.sync();
            },
            handleSelectApp: function(){
                const app = this.applications.filter( a => a.id == this.appToAdd)[0];
                    this.selectedApps.push({
                        ...app,
                        type: 2
                    });
                    this.sync();
            },
            handleSelectCatApp: function(){
                const app = this.categories.filter( a => a.id == this.appToAdd)[0];
                    this.selectedApps.push({
                        ...app,
                        type: 1
                    });
                    this.sync();
            },
            onMoveCallbackProducts: function(e){
                this.canDrag = false;
                axios.post('/admin/productos/ordenar', {
                    'products':this.products
                }).then(response => {
                    this.products = response.data;
                    this.canDrag = true;
                })
                .catch(e => {
                })
                return true;
            },
            onMoveCallbackApplications: function(e){
                this.canDrag = false;
                axios.post('/admin/aplicaciones/ordenar', {
                    'applications':this.applications
                }).then(response => {
                    this.applications = response.data;
                    this.canDrag = true;
                })
                .catch(e => {
                })
                return true;
            }
        }
    });

    $(document).ready(function(){
        $('.select2').select2()

        if ($('#date').is(":checked")) {
            $("#noticias").hide();
        }

        $("#date").click(function() {
            $("#noticias").hide();
        });

        $("#manual").click(function() {
            $("#noticias").show();
        });

        if ($('#manual').is(":checked")) {
            $("#noticias").show();
        }
    })

</script>
@endsection
