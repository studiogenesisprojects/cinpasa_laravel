@extends('back.common.main')
@section('content')

<div class="content-box">
    <div class="element-wrapper" id="app">
        <h6 class="element-header">Carousel
            <a href="{{route('carousels.index')}}" class="btn btn-primary float-right"><i
                class="os-icon os-icon-chevron-left"></i> Volver
            </a>
        </h6>
        <div class="row">
            <div class="col-sm-12">
                <div class="element-wrapper">
                    <div class="element-box">
                        <form id="formValidate" novalidate="true" method="post" accept-charset="utf-8" enctype="multipart/form-data" action="{{route('carousels.update', $carousel->id)}}">
                            @csrf
                            @method('PATCH')

                            <div class="element-info">
                                <div class="element-info-with-icon">
                                    <div class="element-info-icon">
                                        <div class="ti-layout-cta-right"></div>
                                    </div>
                                    <div class="element-info-text">
                                        <h5 class="element-inner-header">Información del carousel</h5>
                                    </div>
                                </div>
                            </div>
                            @if ($errors->any())
                                <ul class="alert alert-danger">
                                @foreach ($errors->all() as $error)
                                    <li>{{$error}}</li>
                                @endforeach
                                </ul>
                            @endif
                            <div class="row">
                                <div class="col-sm-5">
                                    <div class="form-group">
                                        <label for="">Nombre del carousel</label>
                                        <input type="text" name="carousel_name" class="form-control" data-error="Introduzca un nombre" value="{{$carousel->name}}">
                                        <div class="help-block form-text with-errors form-control-feedback"></div>
                                    </div>
                                </div>
                                <div class="col-sm-5">
                                    <div class="form-group">
                                        <label for="">Sección a la que pertenece</label>
                                        <select class="form-control" name="section" >
                                            @foreach ($sections as $section)
                                                @if ($section->id == 2 || $section->id == 7 || $section->id == 8 || $section->id == 9 || $section->id == 16|| $section->id == 17|| $section->id == 18)
                                                    <option value="{{$section->id}}" {{$section->id == $carousel->section_id ? 'selected' : ''}} >{{$section->name}} </option>
                                                @endif
                                            @endforeach
                                        </select>
                                    </div>
                                </div>
                                <div class="col-sm-1">
                                    <div class="form-group"><label for="">Activo</label><br>
                                        <input type="hidden" name="active_carousel" value="0">
                                        <input type="checkbox" name="active_carousel" {{$carousel->active ? 'checked' : ''}} value="1">
                                    </div>
                                </div>
                                <div class="col-sm-1">
                                    <div class="form-group"><label for="">Principal</label><br>
                                        <input type="hidden" name="main_carousel" value="0">
                                        <input type="checkbox" name="main_carousel" {{$carousel->main ? 'checked' : ''}} value="1">
                                    </div>
                                </div>
                            </div>
                            <hr>

                            <div id="slides">
                                <div class="p-3" v-for="(slide, numSlides) in slides">
                                    <input type="hidden" :value="slide.id" :name=`slides[${numSlides}][id]`>
                                    <h4> Slide número @{{numSlides + 1}} </h4>
                                    <div class="row">

                                        <div class="col-sm-3">
                                            <div id="preview">
                                                <img class="w-100 mb-3" v-if="slides[numSlides].image.url" :src="slides[numSlides].image.file ? slides[numSlides].image.url : `/storage/` + slides[numSlides].image.url " />
                                            </div>
                                        </div>
                                        <div class="col-sm-3">
                                            <label class="btn p-0 m-0" :for=`sel${numSlides}`>
                                                <input :name=`images[${numSlides}]` :id=`sel${numSlides}` type="file" class="d-none" @change="onFileChange($event, numSlides)">
                                                <span v-if="!slides[numSlides].image.url" class="btn btn-outline-success">Añadir imágen</span>

                                                <button type="button" v-if="slides[numSlides].image.url" class="ml-0 btn btn-outline-danger" v-on:click="removeImage(slide, numSlides)">Eliminar</button>
                                            </label>
                                        </div>

                                        <div class="col-sm-4">
                                            <div class="form-group">
                                                <label for="">Url</label>
                                                <input type="text" :name=`slides[${numSlides}][url]` class="form-control" data-error="Introduzca una url" v-model="slide.url">
                                                <div class="help-block form-text with-errors form-control-feedback">
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-sm-1">
                                            <div class="form-group"><label for="">Principal</label><br>
                                                <input type="hidden" :name=`slides[${numSlides}][main]` value="0">
                                                <span v-if="slide.main == 1">
                                                    <input type="checkbox" v-model="slide.main" :name=`slides[${numSlides}][main]` checked value="1">
                                                </span>
                                                <span v-else>
                                                    <input type="checkbox" v-model="slide.main" :name=`slides[${numSlides}][main]` value="1">
                                                </span>
                                            </div>
                                        </div>
                                        <div class="col-sm-1">
                                            <a href="" class="btn btn-danger" v-on:click.prevent="removeSlide(numSlides)">
                                                <span class="ti-trash"></span>Eliminar
                                            </a>
                                        </div>

                                    </div>
                                    <div class="row">
                                        <div class="col-sm-12">
                                            <div class="os-tabs-w">
                                                <div class="os-tabs-controls os-tabs-controls-cliente">
                                                    <ul class="nav nav-tabs upper">
                                                        <li class="nav-item" v-for="(lang, index) in languages" >
                                                            <a aria-expanded="false" class="nav-link" :class="[index == 0 ? 'active' : '']" data-toggle="tab" :href="'#tab_'+ slide.id + '_' + lang.id">@{{lang.code}}</a>
                                                        </li>
                                                    </ul>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="tab-content">
                                        <div v-for="(lang, index) in languages" class="tab-pane" :class="[index == 0 ? 'active' : '']"  :id="'tab_'+ slide.id + '_' + lang.id">
                                            <div class="row">
                                                <div class="col-sm-5">
                                                    <label for="">Título</label>
                                                    <input type="text" :name=`slides[${numSlides}][${lang.id}][title]` class="form-control" v-model='slide.languages[index] && slide.languages[index].title'>
                                                    <div class="help-block form-text with-errors form-control-feedback">
                                                    </div>
                                                </div>
                                                <div class="col-sm-6">
                                                    <label for="">Texto</label>
                                                    <input type="text" :name=`slides[${numSlides}][${lang.id}][text]` class="form-control" v-model='slide.languages[index] && slide.languages[index].text'>
                                                    <div class="help-block form-text with-errors form-control-feedback">
                                                    </div>
                                                </div>
                                                <div class="col-sm-1">
                                                    <div class="form-group"><label for="">Activo</label><br>
                                                        <input type="hidden" :name=`slides[${numSlides}][${lang.id}][active]` value="0">
                                                    <span v-if="slide.languages[index] && slide.languages[index].active == 1">
                                                        <input type="checkbox" :name=`slides[${numSlides}][${lang.id}][active]` checked value="1">
                                                    </span>
                                                    <span v-else>
                                                        <input type="checkbox" :name=`slides[${numSlides}][${lang.id}][active]` value="1">
                                                    </span>
                                                    </div>
                                                </div>
                                                <div class="col-sm-6">
                                                    <label for="">Alt de la imagen</label>
                                                    <input type="text" :name=`slides[${numSlides}][${lang.id}][alt_img]` class="form-control" v-model='slide.languages[index] && slide.languages[index].alt_img'>
                                                    <div class="help-block form-text with-errors form-control-feedback">
                                                    </div>
                                                </div>
                                                <div class="col-sm-6">
                                                    <label for="">Título de la url</label>
                                                    <input type="text" :name=`slides[${numSlides}][${lang.id}][title_url]` class="form-control" v-model='slide.languages[index] && slide.languages[index].title_url'>
                                                    <div class="help-block form-text with-errors form-control-feedback">
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <a href="" class="text-success" v-on:click.prevent="addSlide">
                                    <i class="fa fa-plus"></i> Añadir slide
                                </a>
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
<script src="https://cdn.jsdelivr.net/npm/vue/dist/vue.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/axios/0.19.0/axios.js"></script>

<script>
    // SLIDE
    // *************
    const slide = new Vue({
        el: '#slides',
        data: {
            languages: @json($languages),
            slides: @json($slides).map(e => ({
                ...e,
                image: { url: e.image}
            })),
        },
        mounted() {
            console.log(this.slides);
        },
        methods: {

            removeImage: function(slide, i){
                slide.image.url = null
                $('#alt' + i).val('')

            },
            onFileChange: function(e, i){
                
                var alt = $('#sel' + i).val().substring(12)
                this.slides[i].alt_img = alt;
                $('#alt' + i).val(alt)

                const file = e.target.files[0];
                this.$set(this.slides[i].image,'url', URL.createObjectURL(file));
                this.$set(this.slides[i].image,'file', true);
            },
            addSlide: function() {
                this.slides.push({
                    id: null,
                    carousel_id: null,
                    active: null,
                    main: null,
                    title: null,
                    text: null,
                    languages: [{},{},{},{},{}],
                    image: {
                        url: null,
                    },
                    alt_img: null,
                    url: null,
                    title_url: null
                });
            },
            uploadFile: function() {
                this.slides[i].alt_img = $('#sel' + i).val().substring(12);
                $('#alt' + i).val(alt);

                this.slides.image = this.$refs.file[0];
            },
            removeSlide: function(index){
                Swal.fire({
                    title: "Seguro que deseas eliminar este slide?",
                    showCancelButton: true,
                    confirmButtonText: 'Eliminar',
                    showLoaderOnConfirm: true,
                    preConfirm: (login) => {
                        console.log(this.slides[index])
                        this.slides[index].created_at ?
                            axios.delete('/admin/slides/'+this.slides[index].id+'/delete')
                            .then(response => {
                                console.log(response);
                                this.slides.splice(index, 1);
                            })
                            .catch(error => {
                                console.log(error.response)
                            })
                            :
                            this.slides.splice(index, 1)
                    }
                })
            }
        }
    });
    // END
    // ***
</script>
@endsection
