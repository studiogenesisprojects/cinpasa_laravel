@extends('front.common.main')

@section('content')
@include('front.home.carousel')
<section id="porque">
    <div class="container mt-5">
        <div class="row">
            <div class="col-12 mt-lg-5">
                <h3>¿Por qué Cinpasa?</h3>
                <hr class="mt-3">
            </div>
        </div>
        <div class="row mt-md-5">
            <div class="col-md-1 col-2  mt-md-0 mt-5">
                <img src="{{ asset('front/img/icon-empresa-1.svg') }}" alt="icono referencias">
            </div>
            <div class="col-md-4 col-10 d-flex mt-md-0 mt-5">
                <hr class="hr-vertical background-blue-light">
                <div class="ml-4">
                    <h6>MÁS DE 200 REFERENCIAS</h6>
                    <p class="lineheight-small mt-2"><small>Disponemos de más de 200 referencias en estoc contínuo para poder dar respuesta inmediata y realizar envíos a corto plazo.</small></p>
                </div>
            </div>
            <div class="col-md-1 col-2 offset-md-1 mt-md-0 mt-5">
                <img src="{{ asset('front/img/icon-empresa-2.svg') }}" alt="icono medida">
            </div>
            <div class="col-md-4 col-10 mt-md-0 mt-5 d-flex">
                <hr class="hr-vertical background-blue-light">
                <div class="ml-4">
                    <h6>SOLUCIONES A MEDIDA</h6>
                    <p class="lineheight-small mt-2"><small>Cada día hay nuevas necesidades. Nuestra misión es dar respuesta a cada una de ellas. Si algo no existe, investigamos.</small></p>
                </div>
            </div>
        </div>
        <div class="row mt-md-5 mt-0">
            <div class="col-md-1 col-2 mt-md-0 mt-5">
                <img src="{{ asset('front/img/icon-empresa-3.svg') }}" alt="icono personalizacio">
            </div>
            <div class="col-md-4 col-10 mt-md-0 mt-5 d-flex">
                <hr class="hr-vertical background-blue-light">
                <div class="ml-4">
                    <h6>PERSONALIZACIÓN</h6>
                    <p class="lineheight-small mt-2"><small>CINPASA diseña y fabrica según las necesidades del cliente y los requisitos técnicos de cada aplicación.</small></p>
                </div>
            </div>
            <div class="col-md-1 col-2 offset-md-1 mt-md-0 mt-5">
                <img src="{{ asset('front/img/icon-empresa-4.svg') }}" alt="icono producción">
            </div>
            <div class="col-md-4 col-10 mt-md-0 mt-5 d-flex">
                <hr class="hr-vertical background-blue-light">
                <div class="ml-4">
                    <h6>ALTA CAPACIDAD DE PRODUCCIÓN</h6>
                    <p class="lineheight-small mt-2"><small>CINPASA tiene una capacidad de producción que permite fabricar grandes volúmenes a precios ajustados.</small></p>
                </div>
            </div>
        </div>
        <div class="row mt-md-5 mt-0">
            <div class="col-md-1 col-2  mt-md-0 mt-5">
                <img src="{{ asset('front/img/icon-empresa-5.svg') }}" alt="icono satisfacción">
            </div>
            <div class="col-md-4 col-10 d-flex mt-md-0 mt-5">
                <hr class="hr-vertical background-blue-light">
                <div class="ml-4">
                    <h6>SATISFACCIÓN</h6>
                    <p class="lineheight-small mt-2"><small>Nuestro equipo comercial está enfocado a la satisfacción del cliente y a la superación de sus expectativas.</small></p>
                </div>
            </div>
            <div class="col-md-1 col-2 offset-md-1 mt-md-0 mt-5">
                <img src="{{ asset('front/img/icon-empresa-6.svg') }}" alt="icono líderes">
            </div>
            <div class="col-md-4 col-10 mt-md-0 mt-5 d-flex">
                <hr class="hr-vertical background-blue-light">
                <div class="ml-4">
                    <h6>LÍDERES</h6>
                    <p class="lineheight-small mt-2"><small>Ser líderes europeos en el mercado de la cinta nos obliga a ser más exigentes para seguir ofreciendo excelencia.</small></p>
                </div>
            </div>
        </div>
        <div class="row mt-5">
            <img src="{{ asset('front/img/empresa-1.jpg') }}" alt="imagen youtube" class="w-100 border-img mt-5">
        </div>
    </div>
</section>

<hr class="mt-5">

<section>
    <div class="container mt-5">
        <div class="row">
            <div class="col-md-10">
                <h2 class="mt-5 before-title">Calidad</h2>
                <p class="mt-3 color-blue mb-5">La calidad de nuestros productos se mide con parámetros objetivos, incluyendo siempre las opiniones de nuestros clientes.<br><br>Garantizamos la conformidad de nuestros productos así como su mejora continua. Nos comprometemos a tener una continua comunicación con el cliente. Cumplimos con los requisitos pactados con el cliente, nos anticipamos a sus necesidades y mantenemos un alto nivel de innovación y desarrollo.</p>
            </div>
        </div>
    </div>
</section>

<hr class="mt-5">

@include('front.home.carousel--business')

@endsection
