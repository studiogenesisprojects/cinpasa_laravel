<head>
    <!-- Google Tag Manager -->
	<!-- Google tag (gtag.js) -->
	<script async src="https://www.googletagmanager.com/gtag/js?id=G-20FMRY22PL"></script>
	<script>
	  window.dataLayer = window.dataLayer || [];
	  function gtag(){dataLayer.push(arguments);}
	  gtag('js', new Date());

	  gtag('config', 'G-20FMRY22PL');
	</script>
	
    <!-- End Google Tag Manager -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}" />

    <link rel="icon" type="image/png" href="{{ asset('front/img/favicon.png') }}" sizes="64x64">
    <link href="https://fonts.googleapis.com/css2?family=Nunito+Sans:ital,wght@0,300;0,400;0,600;0,700;1,300;1,400;1,600;1,700&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Grandstander&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css" integrity="sha384-zCbKRCUGaJDkqS1kPbPd7TveP5iyJE0EjAuZQTgFLD2ylzuqKfdKlfG/eSrtxUkn" crossorigin="anonymous">
    <link rel="stylesheet" href="{{ asset('front/css/style.css') }}">
    {!! RecaptchaV3::initJs() !!}

    <style>
        .grecaptcha-badge { 
            visibility: hidden !important;
        }
    </style>
    
    {{-- <title>Cinpasa</title> --}}
    <title>@yield('meta-title')</title>
    <meta name="title" content="@yield('meta-title')">
    <meta name="description" content="@yield('meta-description')">
    <meta name="facebook-domain-verification" content="luojrac4agvuqxefqvay508oqxfk86" />
    <meta name="google-site-verification" content="gBGhpBgCMjyxbklcebgapd2fqjrTkuy5_gW6uC8QsSQ" />

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
