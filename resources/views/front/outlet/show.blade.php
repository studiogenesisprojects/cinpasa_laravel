@extends('front.common.main')
@section('meta-title', $product->lang(App::getLocale())->seo_title ?? $product->lang(App::getLocale())->title)
@section('meta-description', $product->lang(App::getLocale())->seo_description ?? $product->lang(App::getLocale())->description )

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
                                href="{{LaravelLocalization::getURLFromRouteNameTranslated(App::getLocale(), 'routes.products.show', ['productCategory' => $product->categories[0]->lang(App::getLocale())->slug])}}">
                                {{$product->categories[0]->lang()->name}} </a>
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
                            <a class="btn-whatsapp" title="comparteix a whatsapp" href="whatsapp://send?text=<?php echo URL::current(); ?>" data-action="share/whatsapp/share" target="_blank"><img  class="mr-3" src="{{ asset('front/img/whatsapp.svg') }}" alt="whatsapp"></a>
                            <a class="btn-facebook" title="comparteix a facebook" href="https://www.facebook.com/sharer/sharer.php?u=<?php echo URL::current(); ?>" target="_blank"><img class="mr-3" src="{{ asset('front/img/icon-facebook.svg') }}" alt="facebook"></a>
                            <a class="btn-twitter" title="comparteix a twitter" href="https://twitter.com/home?status=<?php echo URL::current(); ?>" target="_blank"><img class="mr-3" src="{{ asset('front/img/icon-twitter.svg') }}" alt="twitter"></a>
                            <a class="btn-linkedin" title="comparteix a linkedin" href="https://www.linkedin.com/shareArticle?mini=true&url=&title=&summary=&source=<?php echo URL::current(); ?>" target="_blank"><img class="mr-3" src="{{ asset('front/img/linkedin.svg') }}" alt="linkedin"></a>
                            <a class="btn-pinterest" title="comparteix a pinterest" href="https://pinterest.com/pin/create/button/?url=<?php echo URL::current(); ?>&media=&description=<?php echo URL::current(); ?>"><img class="mr-3" src="{{ asset('front/img/icon-pinterest.svg') }}" alt="pinterest"></a>
                        </div>
                    </div>
                    <hr>
                    <div class="d-flex justify-content-end py-3">
                        <p class="btn btn-third">{{__('Productos.ficha_producto_anadir_favoritos')}}</p>
                    </div>
                    <hr>
                </div>
            </div>
        </div>
        @if(isset($product_caracteristics))
        <div class="row mt-3">
            <div class="col-md-12">
                <hr>
                <p class="font-bold color-black mt-4">{{__('Productos.producto_mostrar_caracteristicas')}}</p>
                <div class="row mt-3">
                    @if($product->materials)
                    <div class="col-12">
                        <p class="color-black">
                        @foreach($product->materials as $material)
                            <span class="color-primary"><strong>{{$material->name}}</strong></span> / 
                        @endforeach
                        </p>
                    </div>
                    @endif
                </div>
            </div>
        </div>
        <div class="row mt-3">
            <div class="col-md-12">
                <hr>
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
                                    <th>{{__('Productos.descuento')}}</th>
                                </tr>
                            </thead>
                            <tbody id="caracteristics_body">
                                @for($i = 0; $i < sizeOf($product_caracteristics); $i++)
                                <div id="bloc_1">
                                    <tr id="row_0">
                                        @if(in_array(!null, $references->toArray()))
                                            <td>
                                                <span class="color-primary"><strong>{{$references[$i]}}</strong></span>
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
                                        <td>
                                            <span>-{{$product_caracteristics[$i]->discount}}%</span>
                                        </td>
                                    </tr>
                                </div>
                                @endfor
                            </tbody>
                        </table>
                    </div>
            </div>
        </div>
        @endif
        <div class="row mt-5">
            <div class="col-12">
                <hr>
                <p class="font-bold color-black"><strong>{{__('Productos.producto_mostrar_colores')}}</strong></p>
                <p class="mt-3">{{__('Productos.producto_mostrar_colores_texto2')}}</p>
            </div>
            <div class="col-12 mt-2 d-flex flex-wrap">
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

        <div class="row mt-3">
            <div class="col-12">
                <hr>
                <p class="font-bold color-black mt-4">{{__('Productos.producto_mostrar_acabados')}}</p>
            </div>
            @foreach ($finishedColumns as $cols)
            <div class="col-lg-4 col-sm-6 mt-3">
                <div class="row">
                    @foreach ($cols as $finished)
                        <div class="col-sm-4">
                            <p class="color-black">{{$finished->lang()->name}}</p>
                            <hr>
                        </div>
                    @endforeach
                </div>
            </div>
            @endforeach
        </div>

        <div class="row mt-3">
            <div class="col-12">
                <hr>
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
                        <hr>
                    @endforeach
                @endforeach
            </div>
        </div>
    </div>
</section>
<section class="trio-iconos">
    <div class="container">
        <div class="row">
            <div class="col-sm-4">
                <p><img src="{{ asset('front/img/ico-tamanos.svg') }}" alt="" class="img-fluid"></p>
                <hr>
                <p>Diferentes tamaños</p>
            </div>
            <div class="col-sm-4">
                <p><img src="{{ asset('front/img/ico-calidad.svg') }}" alt="" class="img-fluid"></p>
                <hr>
                <p>Calidad superior</p>
            </div>
            <div class="col-sm-4">
                <p><img src="{{ asset('front/img/ico-colores.svg') }}" alt="" class="img-fluid"></p>
                <hr>
                <p>Diferentes colores</p>
            </div>
        </div>
    </div>
</section>
@endsection
