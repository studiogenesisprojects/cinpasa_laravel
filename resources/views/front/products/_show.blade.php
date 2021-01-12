@extends('front.common.main')
@section('meta-title', $product->lang(App::getLocale())->seo_title ?? $product->lang(App::getLocale())->seo_title)
@section('meta-description', $product->lang(App::getLocale())->seo_description ?? $product->lang(App::getLocale())->seo_description )

@section('content')
<section id="home">
    <div class="container">
        <div class="row">
            <div class="col-12 my-5 d-flex align-items-center">
                <nav aria-label="breadcrumb">
                    <ol class="breadcrumb no-bg pt-2 pb-0 px-0" style="background-color: white;">
                        <li class="breadcrumb-item text-uppercase text-muted"><a class=""
                                href="./">{{__('Comun.ruta_navegacion_inicio')}}</a></li>
                        <li class="breadcrumb-item text-uppercase text-muted " aria-current="page">
                            <a href="{{LaravelLocalization::localizeUrl('/productos')}}">{{__('Encabezado.productos')}}
                            </a>
                        </li>
                        <li class="breadcrumb-item text-uppercase text-muted ">
                            <a
                                href="{{LaravelLocalization::getURLFromRouteNameTranslated(App::getLocale(), 'routes.products.show', ['productCategory' => $productCategory->lang(App::getLocale())->slug])}}">
                                {{$productCategory->lang()->name}} </a>
                        </li>
                        <li class="breadcrumb-item text-uppercase text-muted active"> {{$product->name}}</li>
                    </ol>
                </nav>
            </div>
            <div class="col-lg-7 col-10 offset-lg-0 offset-1 order-lg-1 order-2 mt-lg-0 mt-5">
                <div id="carousel-token" class="carousel slide carousel-token" data-ride="carousel"
                    data-interval="false">
                    <div class="carousel-inner">
                        {{-- @if ($product->primaryImage)
                        <div class="carousel-item active">
                            <figure class="bg-cover bg-lg box-list__figure">
                                <img src="@if(!empty($product->primaryImage->path)){{ route('carousel.getImage', str_replace("/",";",$product->primaryImage->path))}}@else{{Storage::url('/img/nofoto.png')}}@endif" alt="@empty($product->primaryImage->alt) {{ $product->name }} @else {{  $product->primaryImage->alt}} @endempty" class="box-product__carousel">
                            </figure>
                        </div>
                        @endif --}}
                        @if($product->galeries->first())
                        @foreach ($product->galeries->first()->images as $image)
                        <div class="carousel-item {{($loop->first) ? 'active' : ''}}">
                            <figure class="bg-cover bg-lg box-list__figure">
                                <img src="@if(!empty($image->path)){{Storage::url($image->path)}}@else{{Storage::url('/img/nofoto.png')}}@endif" alt="@empty($image->alt) {{ $product->name }} @else {{  $image->alt}} @endempty" class="box-product__carousel">
                            </figure>
                        </div>
                        @endforeach
                        @endif
                        @if($product->video)
                        <div class="carousel-item">
                            <figure class="bg-cover bg-lg">
                                <iframe title="video producto" width="100%" height="100%"
                                    src="https://www.youtube.com/embed/{{$product->video}}" frameborder="0"
                                    allow="accelerometer; autoplay; encrypted-media; gyroscope; picture-in-picture"
                                    allowfullscreen></iframe>
                            </figure>
                        </div>
                        @endif
                    </div>
                    <ol class="carousel-indicators carousel-indicators-productos mt-3">
                        {{-- @if ($product->primaryImage)
                        <li data-target="#carousel-token" data-slide-to="0" class="active col">
                            <figure class="bg-cover bg-sm"
                                style="background-image:@if(!empty($product->primaryImage->path)) url('{{route('carousel.getImage', str_replace("/",";",$product->primaryImage->path))}}')@else url('{{Storage::url('/img/nofoto.png')}}')@endif">
                            </figure>
                        </li>
                        @endif --}}
                        @if ($product->galeries->first())
                        @foreach ($product->galeries->first()->images as $i => $image)
                        <li data-target="#carousel-token" data-slide-to="{{$product->primaryImage ? $i : $i}}" class="{{$loop->first && !$product->primaryImage ? 'active' : ''}} col">
                            <img class="border-img miniatura" style="width: 90px; height: 90px;" src="@if(!empty($image->path)) {{ Storage::url($image->path)}} @else {{Storage::url('/img/nofoto.png')}}@endif" alt="miniatura carousel">
                        </li>
                        @endforeach
                        @endif
                        @if($product->video)
                        <li data-target="#carousel-token"
                            data-slide-to="{{ $product->galeries->first()->images->count() +1  }}" class="col">
                            <figure class="bg-cover bg-sm"
                                style="background-image: url(https://img.youtube.com/vi/{{$product->video}}/default.jpg)">
                                <span class="video"><img src="{{Storage::url('/img/video.svg')}}" alt="video"
                                        class="img-fluid"></span>
                            </figure>
                        </li>
                        @endif
                    </ol>
                    <div class="carousel-control-prev bg-lg" data-target="#carousel-token" role="button"
                        data-slide="prev">
                        <i class="fi-xnllxl-chevron fi-3x"></i>
                        <span class="sr-only">Previous</span>
                    </div>
                    <div class="carousel-control-next bg-lg" data-target="#carousel-token" role="button"
                        data-slide="next">
                        <i class="fi-xnlrxl-chevron fi-3x"></i>
                        <span class="sr-only">Next</span>
                    </div>
                </div>
            </div>
            <div class="col-lg-5 d-flex flex-column justify-content-between order-lg-2 order-1">
                <div>
                    <h3 class="font-bold before-title mt-4">{{$product->name}}</h3>
                    <p class="mt-3 p-small">{!! $product->lang()->description !!}</p>
                </div>
                <br>
                <div class="d-lg-block d-none">
                    <hr>
                    <div class="d-flex justify-content-between">
                        <p class="small py-3">Compartir</p>
                        <div class="share-btn mt-2">
                            <a class="btn-whatsapp" title="comparteix a whatsapp" href="whatsapp://send?text=<?php echo URL::current(); ?>" data-action="share/whatsapp/share" target="_blank"><img  class="mr-3" src="{{ asset('front/img/whatsapp.svg') }}" alt="icono whatsapp"></a>
                            <a class="btn-facebook" title="comparteix a facebook" href="https://www.facebook.com/sharer/sharer.php?u=<?php echo URL::current(); ?>" target="_blank"><img class="mr-3" src="{{ asset('front/img/icon-facebook.svg') }}" alt="icono facebook"></a>
                            <a class="btn-twitter" title="comparteix a twitter" href="https://twitter.com/home?status=<?php echo URL::current(); ?>" target="_blank"><img class="mr-3" src="{{ asset('front/img/icon-twitter.svg') }}" alt="icono twitter"></a>
                            <a class="btn-linkedin" title="comparteix a linkedin" href="https://www.linkedin.com/shareArticle?mini=true&url=&title=&summary=&source=<?php echo URL::current(); ?>" target="_blank"><i class="fab fa-linkedin-in"></i></a>
                            <a class="btn-pinterest" title="comparteix a pinterest" href="https://pinterest.com/pin/create/button/?url=<?php echo URL::current(); ?>&media=&description=<?php echo URL::current(); ?>"><img class="mr-3" src="{{ asset('front/img/icon-pinterest.svg') }}" alt="icono pinterest"></a>
                        </div>
                    </div>
                    <hr>
                    <div class="d-flex justify-content-end py-3">
                        <button onClick="setFavorite({{$product->id}})" class="btn btn-third"><img id="fav_button" src="{{request()->session()->exists('product-' . $product->id) ? asset('front/img/fav-active.svg') : ''}}">Añadir a favoritos</button>
                    </div>
                    <hr>
                </div>
            </div>
        </div>
        @if(isset($product_caracteristics))
        <div class="row mt-5">
            <div class="col-md-12">
                <hr>
                <p class="font-bold color-black mt-4">{{__('Productos.producto_mostrar_caracteristicas')}}</p>
                <div class="row mt-4">
                    @if($product->materials)
                    <div class="col-12">
                        <p class="color-black">{{__('Productos.producto_mostrar_materiales')}}
                        @foreach($product->materials as $material)
                            <span class="color-primary">{{$material->name}}</span>
                        @endforeach
                        </p>
                    </div>
                    @endif
                </div>
            </div>
            <div class="col-md-12">
                <p class="font-bold color-black mt-4">{{__('Productos.producto_mostrar_referencias')}}</p>
                   <p class="d-sm-none d-block">{{__('Productos.scroll')}}</p>
                    <div class="table-responsive mt-3">
                        <table id="caracteritics_table" width="100%" height="150px" class="table table-striped table-lightfont">
                            <thead>
                                <tr>
                                    @if(in_array(!null, $references->toArray()))
                                        <th>{{__('Productos.referencia')}}</th>
                                    @endif
                                    @if(in_array(!null, $width->toArray()))
                                        <th>{{__('Productos.ancho')}}</th>
                                    @endif
                                    @if(in_array(!null, $bags->toArray()))
                                        <th>{{__('Productos.bolsas')}}</th>
                                    @endif
                                    @if(in_array(!null, $laces->toArray()))
                                        <th>{{__('Productos.cordones')}}</th>
                                    @endif
                                    @if(in_array(!null, $rapport->toArray()))
                                        <th>{{__('Productos.rapport')}}</th>
                                    @endif
                                    @if(in_array(!null, $diameter->toArray()))
                                        <th>{{__('Productos.diametro')}}</th>
                                    @endif
                                    @if(in_array(!null, $length->toArray()))
                                        <th>{{__('Productos.largo')}}</th>
                                    @endif
                                    @if(in_array(!null, $width_diameter->toArray()))
                                        <th>{{__('Productos.ancho_diametro')}}</th>
                                    @endif
                                    @if(in_array(!null, $observations->toArray()))
                                        <th>{{__('Productos.observaciones')}}</th>
                                    @endif
                                </tr>
                            </thead>
                            <tbody id="caracteristics_body">
                                @for($i = 0; $i < sizeOf($product_caracteristics); $i++)
                                <div id="bloc_1">
                                    <tr id="row_0">
                                        @if(in_array(!null, $references->toArray()))
                                            <td>
                                                <span class="color-primary">{{$references[$i]}}</span>
                                            </td>
                                        @endif
                                        @if(in_array(!null, $width->toArray()))
                                            <td>
                                                <span>{{$width[$i]}}</span>
                                            </td>
                                        @endif
                                        @if(in_array(!null, $bags->toArray()))
                                            <td>
                                                <span>{{$bags[$i]}}</span>
                                            </td>
                                        @endif
                                        @if(in_array(!null, $laces->toArray()))
                                            <td>
                                                <span>{{$laces[$i]}}</span>
                                            </td>
                                        @endif
                                        @if(in_array(!null, $rapport->toArray()))
                                            <td>
                                                <span>{{$rapport[$i]}}</span>
                                            </td>
                                        @endif
                                        @if(in_array(!null, $diameter->toArray()))
                                            <td>
                                                <span>{{$diameter[$i]}}</span>
                                            </td>
                                        @endif
                                        @if(in_array(!null, $length->toArray()))
                                            <td>
                                                <span>{{$length[$i]}}</span>
                                            </td>
                                        @endif
                                        @if(in_array(!null, $width_diameter->toArray()))
                                            <td>
                                                <span>{{$width_diameter[$i]}}</span>
                                            </td>
                                        @endif
                                        @if(in_array(!null, $observations->toArray()))
                                            <td>
                                                <input type="text" class="form-control " value="{{$observations[$i]}}" name="observations[]">
                                            </td>
                                        @endif
                                    </tr>
                                </div>
                                @endfor
                            </tbody>
                        </table>
                    </div>
            </div>
        </div>
        @endif
        <div class="row">
            <div class="col-12 mt-5">
                <p class="font-bold color-black"><strong>{{__('Productos.producto_mostrar_colores')}}</strong></p>
                <p class="mt-3">{{__('Productos.producto_mostrar_colores_texto2')}}</p>
            </div>
            <div class="col-12 mt-5 d-flex flex-wrap">
                @foreach ($colorCategories as $colorCategory)
                    @foreach ($colorCategory->colors as $color)
                        <a href="#" title="Más información sobre el color" class="card-color p-2 mr-3 mt-2 show-color-modal" data-toggle="modal" cc="{{$colorCategory->id}}" id="{{$color->id}}"
                            data-target="#modal-color" >
                            <div class="color" style="background:#{{$color->hex_color}}">
                                <img class="position-absolute t-0 r-0 background-blue p-1 icon-plus-color" src="{{ asset('front/img/icon-plus.svg') }}" alt="icono más">
                            </div>
                            <p class="small-xs font-semibold mt-2">{{$color->name}}</p>
                        </a>
                    @endforeach
                @endforeach
            </div>
        </div>

        <div class="row mt-5">
            <div class="col-12">
                <hr>
                <p class="font-bold color-black mt-4">{{__('Productos.producto_mostrar_acabados')}}</p>
            </div>
            @foreach ($finishedColumns as $cols)
            <div class="col-lg-4 col-sm-6 mt-5">
                    @foreach ($cols as $finished)
                    <p class="color-black mb-3">{{$finished->lang()->name}}</p>
                    <hr>
                    @endforeach
            </div>
            @endforeach
        </div>
        <div class="row mt-5">
            <div class="col-12">
                <p class="font-bold color-black">{{__('Productos.producto_mostrar_aplicaciones')}}</p>
            </div>
            <div class="col-lg-4 col-md-6 mt-5">
                @foreach ($applicationCategories as $applicationCategory => $apps)
                    @foreach ($apps as $app)
                        <a href="{{LaravelLocalization::getURLFromRouteNameTranslated(App::getLocale(), 'routes.applications._show', [
                            "applicationCategory" => $app->applicationCategories->first()->lang() ? $app->applicationCategories->first()->lang()->slug : "",
                            "aplication" => $app
                        ])}}" title="Acceder a la aplicación" class="d-flex justify-content-between align-items-center">
                            <p class="color-black mb-3">{{$app->lang()->name}}</p>
                            <img class="mr-sm-0 mr-3" src="{{ asset('front/img/arrow-right.svg') }}" alt="icono flecha derecha">
                        </a>
                    @endforeach
                @endforeach
                <hr>
            </div>
        </div>
    </div>
</section>



@if ($relateds)
    @include('front.partials.related')
@endif

{{-- @include('front.common.partials.mid-banner') --}}
@include('front.common.modals.color')
@endsection

@push('js')
<script>

    $('[data-toggle="popover"]').popover({
        trigger: "hover"
       });

    $('.favorit').each( (i, e) => {
        $(e).click( ev => {
            ev.preventDefault();
            const id = $(ev.currentTarget).attr('id');
            axios.post('/fav', {
                value: id,
            })
            .then(r => {
                if (r.data.action == 'added') {
                    // $(ev.currentTarget).addClass('active')
                    $(ev.currentTarget).html('<i class="far fa-trash-alt mr-3"></i></i>' + "{{__('Productos.producto_mostrar_no_favorito')}}")
                }else{
                    // $(ev.currentTarget).removeClass('active')
                    $(ev.currentTarget).html('<i class="far fa-heart mr-3"></i>' + "{{__('Productos.producto_mostrar_favoritos')}}")
                }

                $('#header-fav-count').html(`(${r.data.count})`)
            })
            .catch(e => console.log(e.response))
        })
    })

    $('.show-color-modal').each( (i, v) => {
        $(v).click( e => {
            var search = "";
            var id = $(e.currentTarget).attr('id')
            var cc = $(e.currentTarget).attr('cc')
            $('#modal-color').modal('toggle')

            axios.get('/colors/ajax/'+id +'/' + cc)
            .then(r => {
                $('#color-modal-name').html(r.data.color.name)
                $('#color-modal-pantone').html(r.data.color.pantone)
                $('#color-modal-description').html(r.data.description);
                $('#color-modal-color').css('background-color', '#' + r.data.color.hex_color)
                $('#color-modal-products').html('');
                if (r.data.products.length > 0) {
                    $('#color-modal-products').append(`
                    <div class="col-12">
                        <hr>
                    </div>
                    `)

                    for(i = 0 ; i < 4; i++){

                        search = "?color=" + r.data.color.id;

                        var image = r.data.products[i]['primaryImage'].path.length != 0 ? encodeURI(r.data.products[i]['primaryImage'].path) : '/img/nofoto.png';
                        var alt = r.data.products[i]['primaryImage'].alt.length != 0 ? r.data.products[i]['primaryImage'].alt : r.data.products[i]['name'];

                        $('#color-modal-products').append(`

                        <div class="col-md-3 col-6">
                            <div class="box-product">
                                <a href="{{LaravelLocalization::getURLFromRouteNameTranslated(App::getLocale(), 'routes.products.showProductRe', [
                                    'product' => '${ r.data.products[i].slug}'
                                ])}}">
                                    <figure class="border mb-0 square box-product__figure ${ r.data.products[i].class}">
                                        <img src="{{Storage::url('${image}')}}" class="box-product__img" alt="${r.data.products[i]['name']}">
                                    </figure>
                                    <div class="box-product-info">
                                        <p class="text-primary"><strong>${r.data.products[i]['name']}</strong></p>
                                    </div>
                                </a>
                            </div>
                        </div>
                        `)
                    }
                }
            })
            .catch(e => console.log(e.response))
        })
    })

</script>
@endpush
