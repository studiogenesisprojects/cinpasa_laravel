<div class="os-tabs-w">
    <div class="os-tabs-controls os-tabs-controls-cliente">
        <ul class="nav nav-tabs upper">
            @foreach($languages as $key => $language)
                <li class="nav-item">
                    <a aria-expanded="false" class="nav-link @if($key == 0){{'active'}}@endif" data-toggle="tab" href="#relacionada_{{$language->code}}">{{ strtoupper($language->code) }}</a>
                </li>
            @endforeach
        </ul>
    </div>
</div>
<div class="tab-content">
		@foreach($languages as $key => $idioma)
			<div class="tab-pane @if($key == 0){{ 'active' }}@endif" id="idioma-relacionada{{ $idioma->id }}">
				<div id="noticia-relacionada-idiomas{{ $idioma->id }}">
					<div class="row relacionadas-{{ $idioma->id }}">
					    <div class="col-sm-10">
					        <div class="form-group form-group-default ">
					            <label for="">Noticia</label>
					            <select name="noticiasRelacionadas[{{ $idioma->id }}][]" class="form-control" id="select-relacionda{{ $index }}-{{ $idioma->id }}">
					            	<option value="">Seleccione una noticia</option>
					                @foreach($noticias as $key => $noticia)
					                    <option value="{{ $noticia->id }}">{{ $noticia->noticiaLang(config('app.lang_default'))->titulo }}</option>
					                @endforeach
					            </select>
					        </div>
					    </div>
					    <div class="col-sm-2">
					        <button type="button" data-url="{{ action('Back\Noticia\NoticiaController@noticiaRelacionadaModal') }}" class="btn btn-default busqueda-relacionada" data-pos="{{ $index }}" data-idioma="{{ $idioma->id }}"><i class="fa fa-search"></i></button>
					    </div>
					</div>
				</div>
				<p><a href="{{ action('Back\Noticia\NoticiaController@noticiaRelacionada') }}" class="text-success noticias-relacionadas-add" data-lang="{{ $idioma->id }}"><i class="fa fa-plus"></i> Añadir otra noticia relacionada</a></p>
			</div>
		@endforeach
</div>
