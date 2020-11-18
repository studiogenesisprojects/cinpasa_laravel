<div class="row relacionadas-{{ $idioma }}">
	<div class="col-sm-10">
		<div class="form-group form-group-default ">
			<label for="">Noticia</label>
			<select name="noticiasRelacionadas[{{ $idioma }}][]" class="form-control" id="select-relacionda{{ $index }}-{{ $idioma }}">
				<option value="">Seleccione una noticia</option>
				@foreach($noticias as $key => $noticia)
				<option value="{{ $noticia->id }}">{{ $noticia->noticiaLang(config('app.lang_default'))->titulo }}</option>
				@endforeach
			</select>
		</div>
	</div>
	<div class="col-sm-2">
		<button type="button" data-url="{{ action('Back\Noticia\NoticiaController@noticiaRelacionadaModal') }}" class="btn btn-default busqueda-relacionada" data-pos="{{ $index }}" data-idioma="{{ $idioma }}"><i class="fa fa-search"></i></button>
	</div>
</div>