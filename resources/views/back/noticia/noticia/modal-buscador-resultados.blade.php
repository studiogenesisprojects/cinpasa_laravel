<table class="table table-hover table-condensed demo-table-search dataTable no-footer" role="grid" aria-describedby="tableWithSearch_info">
    <thead>
        <tr role="row">
            <th>Fecha publicación</th>
            <th>Titular</th>
            <th>Acciones</th>
        </tr>
    </thead>
    <tbody>
        @foreach ($noticias as $key => $noticia) 
            <tr role="row">
                <td>{{ date('d/m/Y', strtotime($noticia->fecha_publicacion)) }}</td>
                <td>{{ $noticia->noticiaLang(config('app.lang_default'))->titulo }}</td>
                <td><button type="button" class="btn btn-success add-select" data-tipo="1" data-id="{{ $noticia->id }}" data-nombre="{{ $noticia->noticiaLang(config('app.lang_default'))->titulo }}" data-posicion="{{ $posicion }}" data-idioma="{{ $idioma_id }}" title="Añadir"><i class="fa fa-check"></i></button></td>
            </tr>
        @endforeach
    </tbody>
</table>
<div class="row">
    <div id="pagination">
        {{ $noticias->links() }}
    </div>
</div>