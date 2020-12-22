<?php

namespace App\Http\Controllers\Back\Noticia;

use App\Models\Galery;
use App\Models\GaleryImagen;
use App\Models\GaleryImagenLang;
use App\Models\Language;
use App\Models\Noticia;
use App\Models\NoticiaLang;
use App\Models\NoticiaCategoria;
use App\Models\NoticiaCategoriaLang;
use App\Models\NoticiaDocumento;
use App\Models\NoticiaEtiqueta;
use App\Models\NoticiaEtiquetaLang;
use App\Models\NoticiaRedactor;
use App\Models\NoticiaRedactorLang;
use App\Models\NoticiaRelacionada;
use App\Models\NoticiaBloque;
use App\Models\BloqueGaleria;
use App\Models\BloqueImagen;
use App\Models\BloqueMapa;
use App\Models\BloqueSeparador;
use App\Models\BloqueTexto;
use App\Models\BloqueVideo;
use Illuminate\Http\Request;
use App\Http\Requests\HandleUpdateNoticia;
use App\Http\Controllers\Controller;
use Illuminate\Pagination\Paginator;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\File;
use DB;
use Illuminate\Support\Str;
use Log;

class NoticiaController extends Controller
{
    /*
     * Obtener valores para las selects de noticias relacionadas
     */
    private function getNoticiasExceptThis($noticia_id)
    {
        $relacionadas = NoticiaRelacionada::select('noticia_relacionada')->where('noticia_id', '=', (int) $noticia_id)->groupby('noticia_relacionada')->orderby('orden', 'DESC')->get();
        $array_ids = array();
        foreach ($relacionadas as $key => $relacionada) {
            $array_ids[] = $relacionada->noticia_relacionada;
        }

        $noticias_asociadas = Noticia::whereIn('id', $array_ids)->where('id', '<>', $noticia_id)->orderby('fecha_publicacion', 'DESC')->get();
        if (count($noticias_asociadas) < 25) {
            $total_a_buscar = 25 - count($noticias_asociadas);
            $noticias_extras = Noticia::whereNotIn('id', $array_ids)->where('id', '<>', $noticia_id)->orderby('fecha_publicacion', 'DESC')->take($total_a_buscar)->get();
            return $noticias_asociadas->merge($noticias_extras);
        }

        return $noticias_asociadas;
    }

    /*
     * Busca el slug que se pasa por parámetro en la base de datos en el idioma indicado y que no sea para el elemento en concreto
     * devuelve el número de veces que aparece el slug
     */
    private function buscarSlugRepetido($id, $slug, $id_idioma)
    {
        return NoticiaLang::where('noticia_id', '!=', $id)->where('idioma_id', '=', $id_idioma)->where('slug', '=', $slug)->where('slug', '<>', '')->get()->count();
    }

    /**
     * Eliminar un registro de la tabla del bloque que corresponda
     * @param  [int] $id_bloque [id del bloque en su respectiva tabla]
     * @param  [int] $tipo      [tipo del bloque para saber de que tabla tenemos que eliminar]
     */
    private function eliminarRegistroTipoBLoque($id_bloque, $tipo)
    {
        switch ((int) $tipo) {
            case 1:
                $bloque = BloqueTexto::findOrFail($id_bloque)->delete();
                break;
            case 2:
                $bloque = BloqueImagen::findOrFail($id_bloque);
                $this->deleteFileImage($bloque->imagen);
                $bloque->delete();
                break;
            case 3:
                $bloque = BloqueGaleria::findOrFail($id_bloque)->delete();
                break;
            case 4:
                $bloque = BloqueVideo::findOrFail($id_bloque)->delete();
                break;
            case 5:
                $bloque = BloqueMapa::findOrFail($id_bloque);
                $this->deleteFileImage($bloque->imagen_puntero);
                $bloque->delete();
                break;
            case 6:
                $bloque = BloqueSeparador::findOrFail($id_bloque)->delete();
                break;
        }
    }

    /**
     * Guardar los campos de bloques para una noticia
     * @param  [object] $request [objeto con los datos del formulario]
     * @param  [object] $noticia [objeto de la noticia a asociar]
     * @param  [type] $idioma_id  [idioma en el que está el bloque]
     * @param  [Array] $bloques    [array de datos de los bloques que componen la noticia]
     */
    private function guardarBloques(HandleUpdateNoticia $request, $noticia, $idioma_id, $bloques)
    {
        // Guardamos los que tiene asociados la noticia al principio
        $bloques_noticia = $noticia->noticiaBloquesLang($idioma_id)->toArray();
        $idsBloquesActuales = array_map(function ($element) {
            return $element['id'];
        }, $bloques_noticia);
        $idsBloquesNuevos = array();

        if (!empty($bloques[$idioma_id])) {
            foreach ($bloques[$idioma_id] as $key => $bloques) {
                foreach ($bloques as $tipo => $datos) {
                    $id_bloque = $datos['id'];
                    switch ($tipo) {
                        case 'textos':
                            $tipo_bloque = 1;
                            if (empty($id_bloque)) {
                                $bloque = BloqueTexto::create($datos);
                            } else {
                                $bloque = BloqueTexto::findOrFail($id_bloque);
                                $bloque->update($datos);
                            }
                            break;
                        case 'imagenes':
                            $tipo_bloque = 2;
                            if (empty($id_bloque)) {
                                // Hay que pasarle el array hasta acceder al campo foto.
                                // Aunque es un array para que lo coja de los input se pone separado por "." cada elemento, en vez de "[]"
                                if ($request->hasFile('bloques.' . $idioma_id . '.' . $key . '.' . $tipo . '.foto')) {
                                    if ($request->file('bloques.' . $idioma_id . '.' . $key . '.' . $tipo . '.foto')->isValid()) {
                                        $elemento = $request->file('bloques.' . $idioma_id . '.' . $key . '.' . $tipo . '.foto');
                                        // Sube y le da un nombre único
                                        $nombreImagen = sha1(time() . Str::random(4)) . '.' . $elemento->getClientOriginalExtension();
                                        $path = $elemento->storeAs('public/' . config('app.route_uploads.noticias-imagenes'), $nombreImagen, 'public_uploads');

                                        $datos['imagen'] = $nombreImagen;
                                    }
                                }

                                $bloque = BloqueImagen::create($datos);
                            } else {
                                $bloque = BloqueImagen::findOrFail($id_bloque);
                                // Hay que pasarle el array hasta acceder al campo foto.
                                // Aunque es un array para que lo coja de los input se pone separado por "." cada elemento, en vez de "[]"
                                if ($request->hasFile('bloques.' . $idioma_id . '.' . $key . '.' . $tipo . '.foto')) {
                                    if ($request->file('bloques.' . $idioma_id . '.' . $key . '.' . $tipo . '.foto')->isValid()) {
                                        $this->deleteFileImage($bloque->imagen);
                                        $elemento = $request->file('bloques.' . $idioma_id . '.' . $key . '.' . $tipo . '.foto');
                                        // Sube y le da un nombre único
                                        $nombreImagen = sha1(time() . Str::random(4)) . '.' . $elemento->getClientOriginalExtension();
                                        $path = $elemento->storeAs('public/' . config('app.route_uploads.noticias-imagenes'), $nombreImagen, 'public_uploads');

                                        $datos['imagen'] = $nombreImagen;
                                    }
                                }

                                $bloque->update($datos);
                            }
                            break;
                        case 'galerias':
                            $tipo_bloque = 3;
                            if (empty($id_bloque)) {
                                $bloque = BloqueGaleria::create($datos);
                            } else {
                                $bloque = BloqueGaleria::findOrFail($id_bloque);
                                $bloque->update($datos);
                            }
                            break;
                        case 'videos':
                            $tipo_bloque = 4;
                            if (empty($id_bloque)) {
                                $bloque = BloqueVideo::create($datos);
                            } else {
                                $bloque = BloqueVideo::findOrFail($id_bloque);
                                $bloque->update($datos);
                            }
                            break;
                        case 'mapas':
                            $tipo_bloque = 5;
                            if (empty($id_bloque)) {
                                // Hay que pasarle el array hasta acceder al campo puntero.
                                // Aunque es un array para que lo coja de los input se pone separado por "." cada elemento, en vez de "[]"
                                if ($request->hasFile('bloques.' . $idioma_id . '.' . $key . '.' . $tipo . '.puntero')) {
                                    if ($request->file('bloques.' . $idioma_id . '.' . $key . '.' . $tipo . '.puntero')->isValid()) {
                                        $elemento = $request->file('bloques.' . $idioma_id . '.' . $key . '.' . $tipo . '.puntero');
                                        // Sube y le da un nombre único
                                        $nombreImagen = sha1(time() . Str::random(4)) . '.' . $elemento->getClientOriginalExtension();
                                        $path = $elemento->storeAs('public/' . config('app.route_uploads.noticias-imagenes'), $nombreImagen, 'public_uploads');

                                        $datos['imagen_puntero'] = $nombreImagen;
                                    }
                                }

                                if (empty($datos['latitud'])) {
                                    $datos['latitud'] = 0.0;
                                }

                                if (empty($datos['longitud'])) {
                                    $datos['longitud'] = 0.0;
                                }

                                $bloque = BloqueMapa::create($datos);
                            } else {
                                $bloque = BloqueMapa::findOrFail($id_bloque);
                                // Hay que pasarle el array hasta acceder al campo puntero.
                                // Aunque es un array para que lo coja de los input se pone separado por "." cada elemento, en vez de "[]"
                                if ($request->hasFile('bloques.' . $idioma_id . '.' . $key . '.' . $tipo . '.puntero')) {
                                    if ($request->file('bloques.' . $idioma_id . '.' . $key . '.' . $tipo . '.puntero')->isValid()) {
                                        $this->deleteFileImage($bloque->imagen_puntero);
                                        $elemento = $request->file('bloques.' . $idioma_id . '.' . $key . '.' . $tipo . '.puntero');
                                        // Sube y le da un nombre único
                                        $nombreImagen = sha1(time() . Str::random(4)) . '.' . $elemento->getClientOriginalExtension();
                                        $path = $elemento->storeAs('public/' . config('app.route_uploads.noticias-imagenes'), $nombreImagen, 'public_uploads');

                                        $datos['imagen_puntero'] = $nombreImagen;
                                    }
                                }

                                $bloque->update($datos);
                            }
                            break;
                        case 'separadores':
                            $tipo_bloque = 6;
                            if (empty($id_bloque)) {
                                $bloque = BloqueSeparador::create($datos);
                            } else {
                                $bloque = BloqueSeparador::findOrFail($id_bloque);
                                $bloque->update($datos);
                            }
                            break;
                        default:
                            continue 2;
                            break;
                    }

                    $elementos_bloque = array(
                        'noticia_id' => $noticia->id,
                        'idioma_id' => $idioma_id,
                        'bloque_id' => $bloque->id,
                        'tipo_bloque' => $tipo_bloque,
                        'orden' => $datos['orden']
                    );

                    if (empty($id_bloque)) {
                        $noticia_bloques = NoticiaBloque::create($elementos_bloque);
                    } else {
                        // Le pongo todos los "where" para ser más específico y limitar el resultado el máximo
                        $noticia_bloques = NoticiaBloque::where('noticia_id', '=', $noticia->id)->where('idioma_id', '=', $idioma_id)->where('tipo_bloque', '=', $tipo_bloque)->where('bloque_id', '=', $bloque->id)->first();
                        $noticia_bloques->update($elementos_bloque);
                    }

                    $idsBloquesNuevos[] = $noticia_bloques->id;
                }
            }
        }

        $elementosAEliminar = array_diff($idsBloquesActuales, $idsBloquesNuevos);

        // Recorremos el array con los ids que ya no existen y los eliminamos de las tablas que les tocan
        foreach ($elementosAEliminar as $key => $elemento) {
            $NoticiaBloque = NoticiaBloque::findOrFail($elemento);
            $this->eliminarRegistroTipoBLoque($NoticiaBloque->bloque_id, $NoticiaBloque->tipo_bloque);
            $NoticiaBloque->delete();
        }
    }

    public function indexHemeroteca(Request $request)
    {
        if ($request->isMethod('post')) {
            $fecha_ini = $request->input('fecha_inicio');
            if ($fecha_ini != '') {
                $fecha_ini = str_replace('/', '-', $fecha_ini);
                $fecha_ini = date('Y-m-d', strtotime($fecha_ini));
            }
            $request->session()->put('filtro_noticia_listado_fecha_inicio', $fecha_ini);
            $fecha_ini = $request->session()->get('filtro_noticia_listado_fecha_inicio');

            $fecha_fin = $request->input('fecha_fin');
            if ($fecha_fin != '') {
                $fecha_fin = str_replace('/', '-', $fecha_fin);
                $fecha_fin = date('Y-m-d', strtotime($fecha_fin));
            }
            $request->session()->put('filtro_noticia_listado_fecha_fin', $fecha_fin);
            $fecha_fin = $request->session()->get('filtro_noticia_listado_fecha_fin');

            $request->session()->put('filtro_noticia_listado_titular', $request->input('titular'));
            $titular = $request->session()->get('filtro_noticia_listado_titular');

            $request->session()->put('filtro_noticia_listado_categoria', $request->input('categoria_id'));
            $categoria_id = $request->session()->get('filtro_noticia_listado_categoria');

            $request->session()->put('filtro_noticia_listado_etiqueta', $request->input('etiqueta_id'));
            $etiqueta_id = $request->session()->get('filtro_noticia_listado_etiqueta');

            $request->session()->put('filtro_noticia_listado_redactor', $request->input('redactor_id'));
            $redactor_id = $request->session()->get('filtro_noticia_listado_redactor');

            $request->session()->put('filtro_noticia_listado_idioma', $request->input('idioma_id'));
            $idioma_id = $request->session()->get('filtro_noticia_listado_idioma');

            //Restablecemos la pagina a la primera para que busque en todas
            $request->session()->put('filtro_paginacion_noticias_buscador', $request->input('page'));
        } else {
            $fecha_ini = $request->session()->get('filtro_noticia_listado_fecha_inicio');
            $fecha_fin = $request->session()->get('filtro_noticia_listado_fecha_fin');
            $titular = $request->session()->get('filtro_noticia_listado_titular');
            $categoria_id = $request->session()->get('filtro_noticia_listado_categoria');
            $etiqueta_id = $request->session()->get('filtro_noticia_listado_etiqueta');
            $redactor_id = $request->session()->get('filtro_noticia_listado_redactor');
            $idioma_id = $request->session()->get('filtro_noticia_listado_idioma');

            if ($request->input('page') != '') {
                //Existe valor de paginador
                $request->session()->put('filtro_paginacion_noticias_buscador', $request->input('page'));
            }
        }

        $currentPage = $request->session()->get('filtro_paginacion_noticias_buscador');

        Paginator::currentPageResolver(function () use ($currentPage) {
            return $currentPage;
        });

        $noticias = Noticia::noticiaFiltradas($fecha_ini, $fecha_fin, $titular, $categoria_id, $etiqueta_id, $redactor_id, $idioma_id);
        $categorias = NoticiaCategoria::cursor();
        $etiquetas = NoticiaEtiqueta::cursor();
        $redactores = NoticiaRedactor::cursor();
        $idiomas = Language::cursor();

        return view('back.noticia.noticia.index-hemeroteca', compact('fecha_ini', 'fecha_fin', 'titular', 'categoria_id', 'etiqueta_id', 'redactor_id', 'idioma_id', 'noticias', 'categorias', 'etiquetas', 'redactores', 'idiomas'));
    }

    public function indexListado(Request $request)
    {
        $noticias = Noticia::orderBy('fecha_publicacion', 'DESC')->paginate(25);
        return view('back.noticia.noticia.index-listado', compact('noticias'));
    }

    public function update(Request $request, $id = '', $pantalla_retorno)
    {
        try {
            if ($id == '') {
                $noticia = new Noticia;
            } else {
                $noticia = Noticia::findOrFail($id);
            }
            $languages = Language::cursor();
            $redactores = NoticiaRedactor::cursor();
            $categorias = NoticiaCategoria::all();
            $etiquetas = NoticiaEtiqueta::cursor();
            $galerias = Galery::cursor();

            // Recoger todos los documentos de la noticia asociados
            $documentos_noticia = $noticia->noticiaDocumentos;
            $documentos = array();
            foreach ($documentos_noticia as $documento) {
                $documentos[$documento->idioma_id][] = array('nombre_doc' => $documento->nombre_doc, 'identificador_doc' => $documento->identificador_doc);
            }

            // Recuperamos todas las categorías asociadas a la noticia y las guardamos en un array
            $categorias_noticia = array();
            foreach ($noticia->noticiaCategorias as $values) {
                $categorias_noticia[] = $values->pivot->categoria_id;
            }

            // Recuperamos todas las etiquetas asociadas a la noticia y las guardamos en un array
            $etiquetas_noticia = array();
            foreach ($noticia->noticiaEtiquetas as $values) {
                $etiquetas_noticia[] = $values->pivot->etiqueta_id;
            }

            if (isset($noticia->id)) {
                $noticias_select = $this->getNoticiasExceptThis($noticia->id);
            } else {
                $noticias_select = Noticia::orderby('fecha_publicacion', 'DESC')->take(25)->get();
            }
        } catch (\Exception $e) {
            if ($pantalla_retorno == 'listado') {
                return redirect()->action('Back\Noticia\NoticiaController@updateListado')->with('message', 'No se puede actualizar el registro.');
            } else {
                return redirect()->action('Back\Noticia\NoticiaController@updateHemeroteca')->with('message', 'No se puede actualizar el registro.');
            }
        }
        return view('back.noticia.noticia.noticia-update', compact('languages', 'noticia', 'redactores', 'categorias', 'etiquetas', 'galerias', 'categorias_noticia', 'etiquetas_noticia', 'documentos', 'noticias_select', 'pantalla_retorno'));
    }

    // Para saber si vamos desde la pantalla del listado
    public function updateListado(Request $request, $id = '')
    {
        return $this->update($request, $id, 'listado');
    }

    // Para saber si vamos desde la pantalla del hemeroteca
    public function updateHemeroteca(Request $request, $id = '')
    {
        return $this->update($request, $id, 'hemeroteca');
    }

    public function handleUpdate(HandleUpdateNoticia $request, $id = '', $pantalla_retorno)
    {
        try {
            DB::beginTransaction();
            $mensaje = array();

            if ($id == '') {
                if ($request->hasFile('foto_noticia')) {
                    if ($request->file('foto_noticia')->isValid()) {
                        // Sube y le da un nombre único
                        $nombreImagen = sha1(time() . Str::random(4)) . '.' . $request->file('foto_noticia')->getClientOriginalExtension();
                        $path = $request->file('foto_noticia')->storeAs(config('app.route_uploads.noticias-imagenes'), $nombreImagen, 'public_uploads');

                        $request->merge(['imagen_principal' => $nombreImagen]);
                    }
                }

                $noticia = Noticia::create($request->all());

                // Hay que ponerlo así porque siempre hay que pasar un array y si no hay elementos no se recibe como Array
                $categoriasAsociadas = array();
                if ($request->input('categorias') != null && count($request->input('categorias'))) {
                    $categoriasAsociadas = $request->input('categorias');
                }

                $noticia->noticiaCategorias()->sync($categoriasAsociadas);

                $etiquetasAsociadas = array();
                if ($request->input('etiquetas') != null && count($request->input('etiquetas'))) {
                    $etiquetasAsociadas = $request->input('etiquetas');
                }

                $noticia->noticiaEtiquetas()->sync($etiquetasAsociadas);
                foreach (Language::all() as $key => $idioma) {
                    $noticiasLang = $request->input('noticias')[$idioma->id];
                    $new_elements = array(
                        'idioma_id' => $idioma->id,
                        'noticia_id' => $noticia->id
                    );
                    $noticiasLang = array_merge($noticiasLang, $new_elements);
                    // Comprobar si existe ese slug
                    if ($repeticiones_slug = $this->buscarSlugRepetido($noticia->id, $noticiasLang['slug'], $idioma->id)) {
                        $noticiasLang['slug'] = $noticiasLang['slug'] . '-' . $repeticiones_slug;
                        $mensaje[] = '<p>El slug se ha modificado en el idioma "' . strtoupper($idioma->code) . '" porque ya existía en otra noticia para este idioma</p>';
                    }

                    $noticiaLang = NoticiaLang::create($noticiasLang);

                    // Guardamos los documentos asociados a la noticia según el idioma en el que se hayan adjuntado
                    if ($request->hasFile('documentos_' . $idioma->id)) {
                        $documentos = $request->file('documentos_' . $idioma->id);
                        foreach ($documentos as $indiceDocumento => $documento) {
                            if ($documentos[$indiceDocumento]->isValid()) {
                                // Sube y le da un nombre único
                                $identificador = sha1(time() . Str::random(4)) . '.' . $documentos[$indiceDocumento]->getClientOriginalExtension();
                                $path = $documentos[$indiceDocumento]->storeAs(config('app.route_uploads.noticias-documentos'), $identificador, 'public_uploads');

                                $nuevosElementosDocumento = array(
                                    'identificador_doc' => $identificador,
                                    'orden' => $indiceDocumento,
                                    'nombre_doc' => $request->input('nombre_doc_' . $idioma->id)[$indiceDocumento],
                                    'idioma_id' => $idioma->id,
                                    'noticia_id' => $noticia->id
                                );
                                $noticiaDocumento = array_merge($documentos, $nuevosElementosDocumento);

                                $documentoNoticia = NoticiaDocumento::create($noticiaDocumento);
                            }
                        }
                    }

                    // Guardamos las noticias relacionadas, si es "yes" son para todos los idiomas las mismas, si no pueden ser diferentes
                    $contador_orden = 0;
                    if ($request->input('relacionadas_iguales') == 'yes') {
                        $noticiasRelacionadas = $request->input('noticiasRelacionadas');
                        foreach ($noticiasRelacionadas as $key => $noticia_rel) {
                            // Se pueden enviar selects sin haber elegido valor, por lo tango llegan vacios
                            if (!empty($noticia_rel)) {
                                $camposNuevosRelaciondas = array(
                                    'noticia_id' => $noticia->id,
                                    'idioma_id' => $idioma->id,
                                    'noticia_relacionada' => $noticia_rel,
                                    'orden' => $contador_orden
                                );
                                $noticiaRelacionada = NoticiaRelacionada::create($camposNuevosRelaciondas);
                                $contador_orden++;
                            }
                        }
                    } else {
                        $noticiasRelacionadas = $request->input('noticiasRelacionadas')[$idioma->id];
                        foreach ($noticiasRelacionadas as $key => $noticia_rel) {
                            // Se pueden enviar selects sin haber elegido valor, por lo tango llegan vacios
                            if (!empty($noticia_rel)) {
                                $camposNuevosRelaciondas = array(
                                    'noticia_id' => $noticia->id,
                                    'idioma_id' => $idioma->id,
                                    'noticia_relacionada' => $noticia_rel,
                                    'orden' => $contador_orden
                                );
                                $noticiaRelacionada = NoticiaRelacionada::create($camposNuevosRelaciondas);
                                $contador_orden++;
                            }
                        }
                    }

                    $this->guardarBloques($request, $noticia, $idioma->id, $request->input('bloques'));
                }
            } else {
                $noticia = Noticia::findOrFail($id);

                // Hay que ponerlo así porque siempre hay que pasar un array y si no hay elementos no se recibe como Array
                $categoriasAsociadas = array();
                if ($request->input('categorias') != null && count($request->input('categorias'))) {
                    $categoriasAsociadas = $request->input('categorias');
                }

                $noticia->noticiaCategorias()->sync($categoriasAsociadas);

                $etiquetasAsociadas = array();
                if ($request->input('etiquetas') != null && count($request->input('etiquetas'))) {
                    $etiquetasAsociadas = $request->input('etiquetas');
                }

                $noticia->noticiaEtiquetas()->sync($etiquetasAsociadas);

                if ($request->hasFile('foto_noticia')) {
                    if ($request->file('foto_noticia')->isValid()) {
                        $this->deleteFileImage($noticia->imagen_principal);
                        // Sube y le da un nombre único
                        $nombreImagen = sha1(time() . Str::random(4)) . '.' . $request->file('foto_noticia')->getClientOriginalExtension();
                        $path = $request->file('foto_noticia')->storeAs(config('app.route_uploads.noticias-imagenes'), $nombreImagen, 'public_uploads');

                        $request->merge(['imagen_principal' => $nombreImagen]);
                    }
                }

                foreach (Language::all() as $key => $idioma) {
                    $NoticiasLang = $request->input('noticias')[$idioma->id];
                    $new_elements = array(
                        'idioma_id' => $idioma->id,
                        'noticia_id' => $noticia->id
                    );
                    $NoticiasLang = array_merge($NoticiasLang, $new_elements);

                    // Comprobar si existe ese slug
                    if ($repeticiones_slug = $this->buscarSlugRepetido($noticia->id, $NoticiasLang['slug'], $idioma->id)) {
                        $NoticiasLang['slug'] = $NoticiasLang['slug'] . '-' . $repeticiones_slug;
                        $mensaje[] = '<p>El slug se ha modificado en el idioma "' . strtoupper($idioma->code) . '" porque ya existía en otra noticia para este idioma</p>';
                    }

                    $noticiaLang = NoticiaLang::where('idioma_id', '=', $idioma->id)->where('noticia_id', '=', $id)->first();
                    if ($noticiaLang) {
                        $noticiaLang->update($NoticiasLang);
                    } else {
                        $noticiaLang = NoticiaLang::create($NoticiasLang);
                    }


                    // Guardamos los documentos asociados a la noticia según el idioma en el que se hayan adjuntado ( estos serán los que ya existían), en este caso el Input::file llegara vacio.
                    if ($request->input('identificador_doc_' . $idioma->id)) {
                        // recogemos cuales están en la BBDD para que después de vovler a guardar se eliminen los archivos físicos de aquellos que no se encuentren
                        $docs_actuales = NoticiaDocumento::where('idioma_id', '=', $idioma->id)->where('noticia_id', '=', $id)->get();

                        $docs_exitentes = array();
                        foreach ($docs_actuales as $doc) {
                            $docs_exitentes[] = $doc->identificador_doc;
                        }

                        // Obtenemos la diferencia de los que había con los que se siguen enviando
                        $docs_a_eliminar = array_diff($docs_exitentes, $request->input('identificador_doc_' . $idioma->id));

                        foreach ($docs_a_eliminar as $archivo) {
                            $this->deleteFileDocumento($archivo);
                            // Eliminamos los registros que ya no están
                            NoticiaDocumento::where('noticia_id', '=', $id)->where('idioma_id', '=', $idioma->id)->where('identificador_doc', '=', $archivo)->delete();
                        }

                        // Actualizamos los datos de los que ya existían
                        foreach ($request->input('identificador_doc_' . $idioma->id) as $key => $info_doc) {
                            // Es el valor del campo oculto de las imagenes
                            if ($info_doc != '') {
                                $documento = NoticiaDocumento::where('noticia_id', '=', $id)->where('idioma_id', '=', $idioma->id)->where('identificador_doc', '=', $info_doc)->first();
                                $documento->nombre_doc = $request->input('nombre_doc_' . $idioma->id)[$key];
                                $documento->save();
                            }
                        }
                    } else {
                        // Eliminamos los registros existentes una vez ya los tenemos en el array creado anteriormente
                        $docs_eliminar = NoticiaDocumento::where('noticia_id', '=', $id)->where('idioma_id', '=', $idioma->id)->get();
                        foreach ($docs_eliminar as $key => $doc) {
                            $this->deleteFileDocumento($doc->identificador_doc);
                            $doc->delete();
                        }
                    }

                    // Guardamos los documentos asociados a la noticia según el idioma en el que se hayan adjuntado
                    if ($request->hasFile('documentos_' . $idioma->id)) {
                        if (count(NoticiaDocumento::all())) {
                            $orden = NoticiaDocumento::max('orden');
                        } else {
                            $orden = 0;
                        }
                        $documentos = $request->file('documentos_' . $idioma->id);
                        $totalIdentidicadores = count($request->input('identificador_doc_' . $idioma->id));

                        foreach ($documentos as $indiceDocumento => $documento) {
                            if ($documentos[$indiceDocumento]->isValid()) {
                                // Sube y le da un nombre único
                                $identificador = sha1(time() . Str::random(4)) . '.' . $documentos[$indiceDocumento]->getClientOriginalExtension();
                                $path = $documentos[$indiceDocumento]->storeAs(config('app.route_uploads.noticias-documentos'), $identificador, 'public_uploads');

                                $nuevosElementosDocumento = array(
                                    'identificador_doc' => $identificador,
                                    'orden' => $orden,
                                    'nombre_doc' => $request->input('nombre_doc_' . $idioma->id)[$indiceDocumento],
                                    'idioma_id' => $idioma->id,
                                    'noticia_id' => $noticia->id
                                );
                                $noticiaDocumento = array_merge($documentos, $nuevosElementosDocumento);

                                if ($indiceDocumento <= $totalIdentidicadores && !empty($request->input('identificador_doc_' . $idioma->id)[$indiceDocumento])) {
                                    $info_doc_actual = $request->input('identificador_doc_' . $idioma->id)[$indiceDocumento];
                                    $documentoNoticia = NoticiaDocumento::where('noticia_id', '=', $noticia->id)->where('idioma_id', '=', $idioma->id)->where('identificador_doc', '=', $info_doc_actual)->first();
                                    $documentoNoticia->update($noticiaDocumento);
                                    $this->deleteFileDocumento($info_doc_actual);
                                } else {
                                    $documentoNoticia = NoticiaDocumento::create($noticiaDocumento);
                                    $orden++;
                                }
                            }
                        }
                    }

                    // Primero eliminamos todas las noticias que tuviese relaciondas y las creamos de nuevo por si han cambiado el orden
                    $borradas = NoticiaRelacionada::where('noticia_id', '=', $noticia->id)->where('idioma_id', '=', $idioma->id)->delete();
                    // Guardamos las noticias relacionadas, si es "yes" son para todos los idiomas las mismas, si no pueden ser diferentes
                    $contador_orden = 0;
                    if ($request->input('relacionadas_iguales') == 'yes') {
                        $noticiasRelacionadas = $request->input('noticiasRelacionadas');
                        foreach ($noticiasRelacionadas as $key => $noticia_rel) {
                            // Se pueden enviar selects sin haber elegido valor, por lo tango llegan vacios
                            if (!empty($noticia_rel)) {
                                $camposNuevosRelaciondas = array(
                                    'noticia_id' => $noticia->id,
                                    'idioma_id' => $idioma->id,
                                    'noticia_relacionada' => $noticia_rel,
                                    'orden' => $contador_orden
                                );
                                $noticiaRelacionada = NoticiaRelacionada::create($camposNuevosRelaciondas);
                                $contador_orden++;
                            }
                        }
                    } else {
                        $noticiasRelacionadas = $request->input('noticiasRelacionadas')[$idioma->id];
                        foreach ($noticiasRelacionadas as $key => $noticia_rel) {
                            // Se pueden enviar selects sin haber elegido valor, por lo tango llegan vacios
                            if (!empty($noticia_rel)) {
                                $camposNuevosRelaciondas = array(
                                    'noticia_id' => $noticia->id,
                                    'idioma_id' => $idioma->id,
                                    'noticia_relacionada' => $noticia_rel,
                                    'orden' => $contador_orden
                                );
                                $noticiaRelacionada = NoticiaRelacionada::create($camposNuevosRelaciondas);
                                $contador_orden++;
                            }
                        }
                    }

                    $this->guardarBloques($request, $noticia, $idioma->id, $request->input('bloques'));
                }

                $noticia->update($request->all());

                // El updated_at lo modificamos asi, porque si no se modifican registros que no son multi-idioma no cambia y necesitamos que
                // cambie siempre que se guarda la noticia
                $noticia->updated_at = date('Y-m-d H:i:s');
                $noticia->save();
            }
            DB::commit();
            if ($pantalla_retorno == 'listado') {
                if ($request->input('actualizar-noticia') == '1') {
                    $mensaje[] = '<p>La noticia se ha guardado correctamente';
                    return redirect()->action('Back\Noticia\NoticiaController@updateListado', $noticia->id)->with('avisos', $mensaje);
                } else {
                    return redirect()->action('Back\Noticia\NoticiaController@indexListado')->with('avisos', $mensaje);
                }
            } else {
                if ($request->input('actualizar-noticia') == '1') {
                    $mensaje[] = '<p>La noticia se ha guardado correctamente';
                    return redirect()->action('Back\Noticia\NoticiaController@updateHemeroteca', $noticia->id)->with('avisos', $mensaje);
                } else {
                    return redirect()->action('Back\Noticia\NoticiaController@indexHemeroteca')->with('avisos', $mensaje);
                }
            }
        } catch (\Exception $e) {
            DB::rollback();
            Log::error($e);
            if ($pantalla_retorno == 'listado') {
                return redirect()->action('Back\Noticia\NoticiaController@updateListado', $id)->with('avisos', 'Error al guardar.');
            } else {
                return redirect()->action('Back\Noticia\NoticiaController@updateHemeroteca', $id)->with('avisos', 'Error al guardar.');
            }
        }
    }

    //A la hora de guardar saber si volvemos a la pantalla de listado
    public function handleUpdateListado(HandleUpdateNoticia $request, $id = '')
    {
        return $this->handleUpdate($request, $id, 'listado');
    }

    //A la hora de guardar saber si volvemos a la pantalla de hemeroteca
    public function handleUpdateHemeroteca(HandleUpdateNoticia $request, $id = '')
    {
        return $this->handleUpdate($request, $id, 'hemeroteca');
    }

    public function deleteImage($id)
    {
        try {
            $noticia = Noticia::findOrFail($id);
            if (!empty($noticia->imagen_principal)) {
                $path = public_path() . DIRECTORY_SEPARATOR . 'uploads' . DIRECTORY_SEPARATOR . config('app.route_uploads.noticias-imagenes') . DIRECTORY_SEPARATOR;
                $file = $path . $noticia->imagen_principal;
                if (File::exists($file)) {
                    File::delete($file);
                    $noticia->imagen_principal = '';
                    $noticia->save();
                }
            }

            return response()->json(['retCode' => 0, 'mensaje' => 'Imagen eliminada']);
        } catch (\Exception $e) {
            return response()->json(['retCode' => 1, 'mensaje' => 'No se pudo eliminar la imagen']);
        }
    }

    public function deleteBloqueImage($tipo_bloque, $id_bloque, $campo)
    {
        try {
            switch ((int) $tipo_bloque) {
                case 2:
                    $bloque = BloqueImagen::findOrFail($id_bloque);
                    $imagen = $bloque->{$campo};
                    break;
                case 5:
                    $bloque = BloqueMapa::findOrFail($id_bloque);
                    $imagen = $bloque->{$campo};
                    break;
                default:
                    $imagen = '';
                    break;
            }

            if (!empty($imagen)) {
                $path = public_path() . DIRECTORY_SEPARATOR . 'uploads' . DIRECTORY_SEPARATOR . config('app.route_uploads.noticias-imagenes') . DIRECTORY_SEPARATOR;
                $file = $path . $imagen;
                if (File::exists($file)) {
                    File::delete($file);
                    $bloque->{$campo} = '';
                    $bloque->save();
                }
            }

            return response()->json(['retCode' => 0, 'mensaje' => 'Imagen eliminada']);
        } catch (\Exception $e) {
            return response()->json(['retCode' => 1, 'mensaje' => 'No se pudo eliminar la imagen']);
        }
    }

    public function deleteFileImage($imagen)
    {
        if (!empty($imagen)) {
            $path = public_path() . DIRECTORY_SEPARATOR . 'uploads' . DIRECTORY_SEPARATOR . config('app.route_uploads.noticias-imagenes') . DIRECTORY_SEPARATOR;
            $file = $path . $imagen;

            if (File::exists($file)) {
                File::delete($file);
            }
        }
    }

    public function deleteFileDocumento($doc)
    {
        if (!empty($doc)) {
            $path = public_path() . DIRECTORY_SEPARATOR . 'uploads' . DIRECTORY_SEPARATOR . config('app.route_uploads.noticias-documentos') . DIRECTORY_SEPARATOR;
            $file = $path . $doc;

            if (File::exists($file)) {
                File::delete($file);
            }
        }
    }

    public function delete($id)
    {
        try {
            DB::beginTransaction();
            $noticia = Noticia::findOrFail($id);
            // Borrar el fichero físico de la imagen
            $this->deleteFileImage($noticia->imagen_principal);
            $documentos = $noticia->noticiaDocumentos;
            foreach ($documentos as $key => $doc) {
                // Borrar el fichero físico del documento
                $this->deleteFileDocumento($doc->identificador_doc);
                // Borrar el registro del documento asociado
                $doc->delete();
            }
            // Eliminar la relación de categorias asociadas
            $noticia->noticiaCategorias()->detach();
            // Eliminar la relación de etiquetas asociadas
            $noticia->noticiaEtiquetas()->detach();
            // Eliminar todos los bloques de la noticia
            foreach ($noticia->noticiasBloques as $infobloque) {
                $this->eliminarRegistroTipoBLoque($infobloque->bloque_id, $infobloque->tipo_bloque);
            }
            $noticia->noticiasBloques()->delete();

            // Eliminar los registros de multi-idioma
            $noticia->noticiasLangs()->delete();
            // $noticia->noticiasRelaciondas()->detach();
            // Eliminar la relación  de noticiasRelacionadas
            NoticiaRelacionada::where('noticia_id', '=', $id)->orWhere('noticia_relacionada', '=', $id)->delete();
            $noticia->delete();
            DB::commit();
            return response()->json(['retCode' => 0, 'mensaje' => 'Noticia eliminada.']);
        } catch (\Exception $e) {
            DB::rollback();
            Log::error('Error: ' . $e->getMessage() . ' ******* Fallo en ' . $e->getFile() . ' ------ En la línea ' . $e->getLine());
            return response()->json(['retCode' => 1, 'mensaje' => 'No se pudo eliminar la noticia.']);
        }
    }

    public function updateStatus($id)
    {
        try {
            $noticia = Noticia::findOrFail($id);
            if ($noticia->activo) {
                $noticia->activo = 0;
                $cambio = 0;
            } else {
                $noticia->activo = 1;
                $cambio = 1;
            }
            $noticia->save();
            return response()->json(['retCode' => 0, 'mensaje' => 'Se ha cambiado el estado de la noticia.', 'cambio' => $cambio]);
        } catch (\Exception $e) {
            return response()->json(['retCode' => 1, 'mensaje' => 'No se pudo cambiar el estado de la noticia.', 'cambio' => $cambio]);
        }
    }

    public function noticiaRelacionada(Request $request)
    {
        try {
            if ($request->noticia_id != '0') {
                $noticias = $this->getNoticiasExceptThis($request->noticia_id);
            } else {
                $noticias = Noticia::orderby('fecha_publicacion', 'DESC')->take(25)->get();
            }

            $index = $request->index;

            if ($request->idioma == '0') {
                $vista = view('back.noticia.noticia.noticia-relacionada-iguales', compact('noticias', 'index'))->render();
                return response()->json(['retCode' => 0, 'mensaje' => '', 'idioma' => "", 'vista' => $vista]);
            } else {
                $idioma = $request->idioma;
                $vista = view('back.noticia.noticia.noticia-relacionada-multiidioma', compact('noticias', 'idioma', 'index'))->render();
                return response()->json(['retCode' => 0, 'mensaje' => '', 'idioma' => $idioma, 'vista' => $vista]);
            }
        } catch (\Exception $e) {
            return response()->json(['retCode' => 1, 'mensaje' => 'Ocurrio un error y no puedieron mostrarse las noticias.']);
        }
    }

    /*
     * Devuelve la vista de los tabs o sin tabs si es multi-idiomas o no las noticias relaciondas
     */
    public function noticiaRelacionadaMultiidioma(Request $request)
    {
        // try {
        if ($request->noticia_id != '0') {
            $noticias = $this->getNoticiasExceptThis($request->noticia_id);
        } else {
            $noticias = Noticia::orderby('fecha_publicacion', 'DESC')->take(25)->get();
        }
        $index = 0;
        if ($request->multiidioma == 'yes') {
            $vista = view('back.noticia.noticia.relacionadas-iguales', compact('index', 'noticias'))->render();
        } else {
            $languages = Language::all();
            // dd($languages);
            $vista = view('back.noticia.noticia.relacionadas-tabs-idiomas', compact('languages', 'noticias', 'index'))->render();
        }

        return response()->json(['retCode' => 0, 'mensaje' => '', 'vista' => $vista]);
        // } catch (\Exception $e) {
        //     return response()->json(['retCode' => 1, 'mensaje' => 'Ocurrio un error y no puedieron mostrarse las noticias.']);
        // }
    }

    public function noticiaRelacionadaModal(Request $request)
    {
        try {
            if ($request->isMethod('post')) {
                //Aplica filtros en la pagina, hay que coger los valores de los imputs
                $request->session()->put('pagination_categoria_noticia_buscador', $request->input('categoria_buscador'));
                $categoria_id = $request->session()->get('pagination_categoria_noticia_buscador');

                $request->session()->put('pagination_etiqueta_noticia_buscador', $request->input('etiqueta_buscador'));
                $etiqueta_id = $request->session()->get('pagination_etiqueta_noticia_buscador');

                $request->session()->put('pagination_redactor_noticia_buscador', $request->input('redactor_buscador'));
                $redactor_id = $request->session()->get('pagination_redactor_noticia_buscador');

                $request->session()->put('pagination_idioma_noticia_buscador', $request->input('idioma_buscador'));
                $idioma_id = $request->session()->get('pagination_idioma_noticia_buscador');

                $request->session()->put('pagination_titular_noticia_buscador', $request->input('titular_buscador'));
                $titular = $request->session()->get('pagination_titular_noticia_buscador');

                $fecha_ini = $request->input('fecha_inicio_buscador');
                if ($fecha_ini != '') {
                    $fecha_ini = str_replace('/', '-', $fecha_ini);
                    $fecha_ini = date('Y-m-d', strtotime($fecha_ini));
                }
                $fecha_fin = $request->input('fecha_fin_buscador');
                if ($fecha_fin != '') {
                    $fecha_fin = str_replace('/', '-', $fecha_fin);
                    $fecha_fin = date('Y-m-d', strtotime($fecha_fin));
                }
                $request->session()->put('pagination_fecha_inicio_noticia_buscador', $fecha_ini);
                $fecha_ini = $request->session()->get('pagination_fecha_inicio_noticia_buscador');

                $request->session()->put('pagination_fecha_fin_noticia_buscador', $fecha_fin);
                $fecha_fin = $request->session()->get('pagination_fecha_fin_noticia_buscador');
                //Restablecemos la pagina a la primera para que busque en todas
                $request->session()->put('paginacion_current_noticias_buscador', $request->input('page'));
            } else {
                //No aplica filtros en la página, se utilizan los valores de la sesión
                $categoria_id =  $request->session()->get('pagination_categoria_noticia_buscador');
                $etiqueta_id =  $request->session()->get('pagination_etiqueta_noticia_buscador');
                $redactor_id =  $request->session()->get('pagination_redactor_noticia_buscador');
                $idioma_id =  $request->session()->get('pagination_idioma_noticia_buscador');
                $titular =  $request->session()->get('pagination_titular_noticia_buscador');
                $fecha_ini =  $request->session()->get('pagination_fecha_inicio_noticia_buscador');
                $fecha_fin =  $request->session()->get('pagination_fecha_fin_noticia_buscador');

                if ($request->input('page') != '') {
                    //Existe valor de paginador
                    $request->session()->put('paginacion_current_noticias_buscador', $request->input('page'));
                }
            }

            $currentPage = $request->session()->get('paginacion_current_noticias_buscador');

            Paginator::currentPageResolver(function () use ($currentPage) {
                return $currentPage;
            });
            $noticia_actual = $request->input('noticia_id');

            $noticias = Noticia::noticiaFiltradas($fecha_ini, $fecha_fin, $titular, $categoria_id, $etiqueta_id, $redactor_id, $idioma_id, $noticia_actual);

            if (count($noticias) == 0) {
                $html = '<h4>No se han encontrado articulos...</h4>';
            } else {
                $posicion = $request->input('posicion');
                $idioma_id = $request->input('idiomaId');
                $html = view('back.noticia.noticia.modal-buscador-resultados', compact('posicion', 'noticias', 'idioma_id'))->render();
            }

            return response()->json(['retCode' => 0, 'mensaje' => '', 'html' => $html]);
        } catch (\Exception $e) {
            $html = '<h4 class="text-danger">No se pudo realizar la búsqueda</h4>';
            return response()->json(['retCode' => 1, 'mensaje' => '', 'html' => $html]);
        }
    }

    public function mostrarNuevoBloque(Request $request)
    {
        try {
            $idioma = $request->input('idioma');
            $tipo = $request->input('tipo');
            $index = $request->input('index');
            $bloque_id = $request->input('bloque_id');

            switch ($tipo) {
                case '1':
                    $html_bloque = view('back.common.bloques.bloque-texto', compact('idioma', 'index', 'bloque_id'))->render();
                    break;
                case '2':
                    $html_bloque = view('back.common.bloques.bloque-imagen', compact('idioma', 'index', 'bloque_id'))->render();
                    break;
                case '3':
                    $galerias = Galery::all();
                    $html_bloque = view('back.common.bloques.bloque-galeria', compact('idioma', 'index', 'galerias', 'bloque_id'))->render();
                    break;
                case '4':
                    $html_bloque = view('back.common.bloques.bloque-video', compact('idioma', 'index', 'bloque_id'))->render();
                    break;
                case '5':
                    $html_bloque = view('back.common.bloques.bloque-mapa', compact('idioma', 'index', 'bloque_id'))->render();
                    break;
                case '6':
                    $html_bloque = view('back.common.bloques.bloque-separador', compact('idioma', 'index', 'bloque_id'))->render();
                    break;

                default:
                    $html_bloque = '';
                    break;
            }
            return response()->json(['retCode' => 0, 'mensaje' => '', 'html' => $html_bloque]);
        } catch (\Exception $e) {
            return response()->json(['retCode' => 1, 'mensaje' => 'Fallo', 'html' => ""]);
        }
    }
}
