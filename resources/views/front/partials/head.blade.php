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
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css" integrity="sha384-zCbKRCUGaJDkqS1kPbPd7TveP5iyJE0EjAuZQTgFLD2ylzuqKfdKlfG/eSrtxUkn" crossorigin="anonymous">
    <link rel="stylesheet" href="{{ asset('front/css/style.css') }}">
    {!! htmlScriptTagJsApi(['lang' => 'es']) !!}

    {{-- <title>Cinpasa</title> --}}
    <title>@yield('meta-title')</title>
    <meta name="title" content="@yield('meta-title')">
    <meta name="description" content="@yield('meta-description')">

    @if(isset($products) && method_exists($products, 'links'))
        @if(!isset($_GET['page']))
            <link rel="next" href="{{Request::url() . '?page=1'}}">
        @elseif($products->nextPageUrl() != null)
            <link rel="next" href="{{$products->nextPageUrl()}}">
        @endif
        @if($products->previousPageUrl() == null && isset($_GET['page']))
            <link rel="prev" href="{{Request::url()}}">
        @elseif($products->previousPageUrl() != null)
            <link rel="prev" href="{{$products->previousPageUrl()}}">
        @endif
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
