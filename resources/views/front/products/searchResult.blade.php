@extends('front.common.main')

@section('content')
@if(isset($isLab))
    @include('front.home.carousel2')
@else
    <br><br><br>
@endif
@include('front.home.barra-busqueda')
<section class="intro-text">
    <div class="container" id="app">
        <search-results-component :favorites='{{ $favorites }}'
        :locale="'{{ App::getLocale() }}'"
        :title="'{{addslashes((__('Productos.buscador_productos_titulo')))}}'"
        :nresults="'{{addslashes(__('Buscador.sin_resultados'))}}'"></search-results-component>
    </div>
</section>
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
                    $(ev.currentTarget).addClass('active')
                }else{
                    $(ev.currentTarget).removeClass('active')
                }

                $('#header-fav-count').html(`(${r.data.count})`)
            })
            .catch(e => console.log(e.response))
        })
    })
    $('figure').click( function(e){
        let url = $(e.target).attr('url');
        window.location = url;
    })
</script>
@endpush
