<?php

namespace App\Http\Controllers\Back\Noticia;

use App\Models\Language;
use App\Models\NoticiaEtiqueta;
use App\Models\NoticiaEtiquetaLang;
use App\Http\Requests\HandleUpdateNoticiaEtiqueta;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Pagination\Paginator;
use DB;
use Log;

class EtiquetaController extends Controller
{
    /*
     * Busca el slug que se pasa por parámetro en la base de datos en el idioma indicado y que no sea para el elemento en concreto
     * devuelve el número de veces que aparece el slug
     */
    private function buscarSlugRepetido($id, $slug, $id_idioma)
    {
        return NoticiaEtiquetaLang::where('noticia_etiqueta_id', '!=', $id)->where('idioma_id', '=', $id_idioma)->where('slug', '=', $slug)->where('slug', '<>', '')->get()->count();
    }

    public function index(Request $request)
    {
        if ($request->isMethod('post')) {
            $request->session()->put('filtro_noticia_etiqueta_nombre', $request->input('nombre'));
            $nombre = $request->session()->get('filtro_noticia_etiqueta_nombre');

            $request->session()->put('filtro_noticia_etiqueta_slug', $request->input('slug'));
            $slug = $request->session()->get('filtro_noticia_etiqueta_slug');

            $request->session()->put('paginacion_current_etiqueta', 1);
        } else {
            $nombre = $request->session()->get('filtro_noticia_etiqueta_nombre');
            $slug = $request->session()->get('filtro_noticia_etiqueta_slug');

            if ($request->input('page') != '') {
                //Existe valor de paginador
                $request->session()->put('paginacion_current_etiqueta', $request->input('page'));
            }
        }

        $currentPage = $request->session()->get('paginacion_current_etiqueta');

        Paginator::currentPageResolver(function () use ($currentPage) {
            return $currentPage;
        });

        $etiquetas = NoticiaEtiqueta::noticiaEtiquetaFiltradas($nombre, $slug);

        return view('back.noticia.etiqueta.index', compact('etiquetas', 'nombre', 'slug'));
    }

    public function delete($id)
    {
        try {
            DB::beginTransaction();
            $etiqueta = NoticiaEtiqueta::findOrFail($id);
            $errores = $etiqueta->permitirBorrar();
            if (empty($errores)) {
                $etiqueta->delete();
            } else {
                return redirect()->action('Back\Noticia\EtiquetaController@index')->with('errores', $errores);
            }
            DB::commit();
            return redirect()->action('Back\Noticia\EtiquetaController@index');
        } catch (\Exception $e) {
            DB::rollback();
            Log::error('Error: ' . $e->getMessage() . ' ******* Fallo en ' . $e->getFile() . ' ------ En la línea ' . $e->getLine());
            return redirect()->action('Back\Noticia\EtiquetaController@index')->with('message', 'Error al borrar.');
        }
    }

    public function update($id = null)
    {
        try {
            if ($id) {
                $etiqueta = NoticiaEtiqueta::findOrFail($id);
            } else {
                $etiqueta = new NoticiaEtiqueta;
            }

            $languages = Language::cursor();
        } catch (\Exception $e) {
            return redirect()->action('Back\Noticia\EtiquetaController@index')->with('message', 'No se puede actualizar el registro.');
        }

        return view('back.noticia.etiqueta.etiqueta-update', compact('languages', 'etiqueta'));
    }

    public function handleUpdate(HandleUpdateNoticiaEtiqueta $request, $id = '')
    {
        try {

            $mensaje = array();

            if ($id) {
                $etiqueta = NoticiaEtiqueta::findOrFail($id);
                $etiqueta->update($request->all());
            } else {
                $etiqueta = NoticiaEtiqueta::create($request->all());
            }

            foreach (Language::all() as $key => $idioma) {
                $etiquetas = $request->input('etiquetas')[$idioma->id];
                $new_elements = array(
                    'idioma_id' => $idioma->id,
                    'noticia_etiqueta_id' => $etiqueta->id
                );
                $etiquetas = array_merge($etiquetas, $new_elements);

                // Comprobar si existe ese slug
                $repeticiones = false;
                $repetido = false;

                do {
                    $repeticiones_slug = $this->buscarSlugRepetido($etiqueta->id, $etiquetas['slug'], $idioma->id);

                    if ($repeticiones_slug) {
                        $repetido = true;
                        $repeticiones = true;
                        $etiquetas['slug'] = $etiquetas['slug'] . '-' . $repeticiones_slug;
                    } else {
                        $repetido = false;
                    }
                } while ($repetido);

                if ($repeticiones) {
                    $mensaje[] = '<p>El slug se ha modificado en el idioma "' . strtoupper($idioma->code) . '" porque ya existía en otra categoría para este idioma</p>';
                }

                $etiquetaLang = NoticiaEtiquetaLang::where('idioma_id', '=', $idioma->id)->where('noticia_etiqueta_id', '=', $etiqueta->id)->first();
                if (is_null($etiquetaLang)) {
                    $etiquetaLang = NoticiaEtiquetaLang::create($etiquetas);
                } else {
                    $etiquetaLang->update($etiquetas);
                }
            }

            return redirect()->action('Back\Noticia\EtiquetaController@update', $etiqueta->id)->with('avisos', $mensaje);
        } catch (\Exception $e) {
            return redirect()->action('Back\Noticia\EtiquetaController@update', $id)->with('message', 'Error al guardar.');
        }
    }
}
