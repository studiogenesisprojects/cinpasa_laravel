@include('front.partials.head')
<body>
    <section>
        <div class="container d-flex vh-100 justify-content-center align-items-center">
            <div class="row">
                <div class="col-lg-7">
                    <img class="w-100" src="{{ asset('front/img/404.svg') }}" alt="imagen error 404">
                </div>
                <div class="col-lg-4 offset-lg-1 mt-lg-0 mt-5 d-flex flex-column align-items-lg-start align-items-center">
                    <p class="color-black font-bold">{{__('404.title')}}</p>
                    <p class="mt-lg-3">{{__('404.subtitle')}}</p>
                    <a href="#" title="Acceder al apartado inicio" class="btn btn-primary mt-5">
                        {{__('404.boton')}}<img class="ml-3" src="{{ asset('front/img/icon-arrow-right.svg') }}" alt="">
                </a>
                </div>
            </div>
        </div>
    </section>
</body>

