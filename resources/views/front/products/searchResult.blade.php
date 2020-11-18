@extends('front.common.main')

@section('content')

<div class="container">
    <div class="row">
        <div class="col-12">
            <div id="searcher-menu">
                @include('front.common.partials.searcher')
            </div>
        </div>
    </div>
</div>
<section class="intro-text py-5">
    <div class="container">
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