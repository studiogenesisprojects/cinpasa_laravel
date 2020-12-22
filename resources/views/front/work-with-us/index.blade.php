@extends('front.common.main')

@section('content')
<section id="aplicaciones">
    <div class="container">
        <div class="row mt-5">
            <div class="col-lg-7 mt-5">
                <h2 class="before-title">¡Únete al equipo de Cinpasa!</h2>
                <p class="mt-3">Encuentra más que un trabajo con nosotros. Adipisci commodi ad aut excepturi repudiandae perspiciatis voluptatem et quis. Ab quo eveniet eos dolor sint deleniti et. Saepe dolores voluptas amet molestiae autem. Voluptatum ea nulla officia alias rerum. Nisi iste expedita eos et ab.</p>
            </div>
        </div>
        <div class="row mt-5">
            <div class="col-lg-4 mt-5">
                <h3>¿Qué ofrecemos?</h3>
                <hr class="mt-4">
                <p class="mt-4">
                    Doloremque temporibus sit quia sequi perferendis. Et sed cupiditate qui est natus adipisci autem. Possimus dolorem quisquam quaerat inventore sed quia dignissimos commodi. Qui itaque omnis labore porro assumenda dolor saepe.
                </p>
            </div>
            <div class="col-lg-8 mt-5">
                <div class="row">
                    <div class="col-lg-4 col-md-6 offset-lg-2">
                        <img src="{{ asset('front/img/icon-trabaja-1.svg') }}" alt="icono vectorial oportunidades para crecer">
                        <h5 class="color-blue">OPORTUNIDADES PARA CRECER</h5>
                        <p class="small mt-3">Nuestro talento interno es nuestro mayor activo. El crecimiento y la evolución de nuestra gente es lo que nos permite seguir creciendo y evolucionando como empresa.</p>
                    </div>
                    <div class="col-lg-4 col-md-6 offset-lg-2 mt-md-0 mt-4">
                        <img src="{{ asset('front/img/icon-trabaja-2.svg') }}" alt="icono vectorial tecnología">
                        <h5 class="color-blue">TECNOLOGÍA</h5>
                        <p class="small mt-3">Confiamos en la última tecnología disponible para mejorar todos nuestros procesos y facilitar el trabajo de nuestros empleados.</p>
                    </div>
                    <div class="col-lg-4 col-md-6 offset-lg-2 mt-4">
                        <img src="{{ asset('front/img/icon-trabaja-3.svg') }}" alt="icono vectorial aprendizaje">
                        <h5 class="color-blue">APRENDIZAJE CONTINUO</h5>
                        <p class="small mt-3">Nunca dejamos de aprender. Además de la capacitación en el trabajo, y una formación continua.</p>
                    </div>
                    <div class="col-lg-4 col-md-6 offset-lg-2 mt-4">
                        <img src="{{ asset('front/img/icon-trabaja-4.svg') }}" alt="icono vectorial comunicación">
                        <h5 class="color-blue">COMUNICACIÓN ABIERTA</h5>
                        <p class="small mt-3">Alentamos a todos a contribuir a su éxito personal y el de la empresa. Nuestra organización es horizontal con una estructura jerárquica plana.</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
<section>
    <div class="container mt-5">
        <div class="row">
            <div class="col-12 mt-5">
                <h3 class="before-title">Ofertas de trabajo</h3>
            </div>
            @foreach($offers as $offer)
                <div class="col-lg-3 col-sm-6 mt-4">
                    <div class="card p-3">
                        <p class="small color-blue">{{$offer->publication_date}}</p>
                        <p class="color-black font-bold">{{$offer->lang()->name}}</p>
                        <p class="small mt-2">{!!$offer->lang()->additional_info!!}</p>
                        <a href="trabaja_ficha.php" title="Ver oferta de gestor de proyectos" class="color-black font-bold mt-2">Ver oferta <img class="ml-2" src="{{ asset('front/img/icon-arrow-right-black.svg') }}" alt="icono flecha derecha"></a>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
</section>
@endsection
