<head>
    <!-- Google Tag Manager -->
    <script>(function(w,d,s,l,i){w[l]=w[l]||[];w[l].push({'gtm.start':
    new Date().getTime(),event:'gtm.js'});var f=d.getElementsByTagName(s)[0],
    j=d.createElement(s),dl=l!='dataLayer'?'&l='+l:'';j.async=true;j.src=
    'https://www.googletagmanager.com/gtm.js?id='+i+dl;f.parentNode.insertBefore(j,f);
    })(window,document,'script','dataLayer','GTM-5R5VDBD');</script>
    <!-- End Google Tag Manager -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <link rel="icon" type="image/png" href="{{ asset('front/img/favicon.png') }}" sizes="64x64">
    <link href="https://fonts.googleapis.com/css2?family=Nunito+Sans:ital,wght@0,300;0,400;0,600;0,700;1,300;1,400;1,600;1,700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Grandstander&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" integrity="sha384-JcKb8q3iqJ61gNV9KGb8thSsNjpSL0n8PARn9HuZOnIxN0hoP+VmmDGMN5t9UJ0Z" crossorigin="anonymous">
    <link rel="stylesheet" href="{{ asset('front/css/style.css') }}">
    {!! htmlScriptTagJsApi(['lang' => 'es']) !!}

    <title>Cinpasa</title>
    <meta name="title" content="@yield('meta-title')">
    <meta name="description" content="@yield('meta-description')">

    {{-- Facebook --}}
    <meta property=”og:title” content="@yield('meta-title')">
    <meta property=”og:type” content=”website”>
    <meta property=”og:description” content="@yield('meta-description')">
    @if(isset($product) && isset($product->galeries))
        <meta property="og:image" content="{{asset('/storage/' . $product->galeries->first()->images[0]->path)}}">
    @elseif(isset($news) && isset($news->lang()->title))
        <meta property="og:image" content="{{$news->image}}">
    @else
        <meta property="og:image" content="{{asset('front/img/logo-cinpasa.svg')}}">
    @endif
    <meta property="og:url" content="{{\URL::current()}}">
    <meta property=”og:site_name” content=”Cinpasa.com”>
    <meta property="og:locale" content="{{App::getLocale()}}">

    {{-- Twitter --}}
    <meta name="twitter:card" content="summary_large_image">
    <meta name=”twitter:url” contnet="{{\URL::current()}}">
    <meta name=”twitter:title” content="@yield('meta-title')">
    <meta name=”twitter:description” content="@yield('meta-description')">
    @if(isset($product))
        <meta property="twitter:image" content="{{asset('/storage/' . $product->galeries->first()->images[0]->path)}}">
    @elseif(isset($news) && isset($news->lang()->title))
        <meta property="twitter:image" content="{{$news->image}}">
    @else
        <meta name="twitter:image" content="{{asset('front/img/logo-cinpasa.svg')}}">
    @endif


    {{-- @foreach(\App\Models\Language::all() as $language)
        @if($language->code == 'es')
            <link rel="canonical" href="{{LaravelLocalization::getLocalizedURL($language->code)}}" />
        @else
            <link rel="alternate" hreflang="{{$language->code}}" href="{{LaravelLocalization::getLocalizedURL($language->code)}}" />
        @endif
    @endforeach --}}
    {{-- <link rel="alternate" href="http://example.com/" hreflang="{{App::getLocale()}}" /> --}}
</head>
