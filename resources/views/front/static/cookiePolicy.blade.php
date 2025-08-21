@extends('front.common.main')
@section('meta-title', __('Textos_legals.cookie_policy_meta_title'))
@section('meta-description', __('Textos_legals.cookie_policy_meta_description'))

@section('content')
<div class="container">
<div class="row justify-content-center mt-5">
    <h1 class="before-title-center">{{__('Textos_legals.cookie_policy_titulo')}}</h1>
</div>
<p class="mt-3 color-blue mb-5">{{__('Textos_legals.cookie_policy')}}</p>
</div>
@endsection
