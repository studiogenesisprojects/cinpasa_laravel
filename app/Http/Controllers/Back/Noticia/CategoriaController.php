<?php

namespace App\Http\Controllers\Back\Noticia;

use App\Models\Language;
use App\Models\NoticiaCategoria;
use App\Models\NoticiaCategoriaLang;
use App\Http\Requests\HandleUpdateNoticiaCategoria;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Pagination\Paginator;
use Log;
use DB;

class CategoriaController extends Controller
{
    /*
    * Busca el slug que se pasa por parámetro en la base de datos en el idioma indicado y que no sea para el elemento en concreto
    * devuelve el número de veces que aparece el slug
    */
    private function buscarSlugRepetido($id, $slug, $id_idioma)
    {
        return NoticiaCategoriaLang::where('noticia_categoria_id', '!=', $id)
            ->where('idioma_id', '=', $id_idioma)
            ->where('slug', '=', $slug)
            ->where('slug', '<>', '')
            ->count();
    }

    public function index(Request $request)
    {
        if ($request->isMethod('post')) {
            $request->session()->put('filtro_noticia_categoria_nombre', $request->input('nombre'));
            $nombre = $request->session()->get('filtro_noticia_categoria_nombre');

            $request->session()->put('filtro_noticia_categoria_slug', $request->input('slug'));
            $slug = $request->session()->get('filtro_noticia_categoria_slug');

            $request->session()->put('paginacion_current_categoria', 1);
        } else {
            $nombre = $request->session()->get('filtro_noticia_categoria_nombre');
            $slug = $request->session()->get('filtro_noticia_categoria_slug');

            if ($request->input('page') != '') {
                //Existe valor de paginador
                $request->session()->put('paginacion_current_categoria', $request->input('page'));
            }
        }

        $currentPage = $request->session()->get('paginacion_current_categoria');

        Paginator::currentPageResolver(function () use ($currentPage) {
            return $currentPage;
        });

        $categorias = NoticiaCategoria::noticiaCategoriaFiltradas($nombre, $slug);

        return view('back.noticia.categoria.index', compact('categorias', 'nombre', 'slug'));
    }

    public function delete($id)
    {
        try {
            DB::beginTransaction();
            $categoria = NoticiaCategoria::findOrFail($id);
            $errores = $categoria->permitirBorrar();
            if (empty($errores)) {
                $categoria->delete();
            } else {
                return redirect()->action('Back\Noticia\CategoriaController@index')->with('errores', $errores);
            }
            DB::commit();
            return redirect()->action('Back\Noticia\CategoriaController@index');
        } catch (\Exception $e) {
            DB::rollback();
            Log::error('Error: ' . $e->getMessage() . ' ******* Fallo en ' . $e->getFile() . ' ------ En la línea ' . $e->getLine());
            return redirect()->action('Back\Noticia\CategoriaController@index')->with('message', 'Error al borrar.');
        }
    }

    public function update($id = null)
    {
        try {
            if ($id) {
                $categoria = NoticiaCategoria::findOrFail($id);
            } else {
                $categoria = new NoticiaCategoria;
            }

            $languages = Language::cursor();
        } catch (\Exception $e) {
            return redirect()->action('Back\Noticia\CategoriaController@index')->with('message', 'No se puede actualizar el registro.');
        }

        return view('back.noticia.categoria.categoria-update', compact('languages', 'categoria'));
    }

    public function handleUpdate(HandleUpdateNoticiaCategoria $request, $id = null)
    {
        try {
            $mensaje = array();

            if ($id) {
                $categoria = NoticiaCategoria::findOrFail($id);
                $categoria->update($request->all());
            } else {
                $categoria = NoticiaCategoria::create($request->all());
            }

            foreach (Language::all() as $key => $idioma) {
                $categorias = $request->input('categorias')[$idioma->id];
                $new_elements = array(
                    'idioma_id' => $idioma->id,
                    'noticia_categoria_id' => $categoria->id
                );
                $categorias = array_merge($categorias, $new_elements);

                // Comprobar si existe ese slug
                $repeticiones = false;
                $repetido = false;

                do {
                    $repeticiones_slug = $this->buscarSlugRepetido($categoria->id, $categorias['slug'], $idioma->id);

                    if ($repeticiones_slug) {
                        $repetido = true;
                        $repeticiones = true;
                        $categorias['slug'] = $categorias['slug'] . '-' . $repeticiones_slug;
                    } else {
                        $repetido = false;
                    }
                } while ($repetido);

                if ($repeticiones) {
                    $mensaje[] = '<p>El slug se ha modificado en el idioma "' . strtoupper($idioma->code) . '" porque ya existía en otra categoría para este idioma</p>';
                }

                $categoriaLang = NoticiaCategoriaLang::where('idioma_id', '=', $idioma->id)->where('noticia_categoria_id', '=', $categoria->id)->first();
                if (is_null($categoriaLang)) {
                    $categoriaLang = NoticiaCategoriaLang::create($categorias);
                } else {
                    $categoriaLang->update($categorias);
                }
            }

            return redirect()->action('Back\Noticia\CategoriaController@update', $categoria->id)->with('avisos', $mensaje);
        } catch (\Exception $e) {
            return redirect()->action('Back\Noticia\CategoriaController@update', $id)->with('message', 'Error al guardar.');
        }
    }
}