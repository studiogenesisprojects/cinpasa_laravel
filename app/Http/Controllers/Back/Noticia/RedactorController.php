<?php

namespace App\Http\Controllers\Back\Noticia;

use App\Models\Language;
use App\Models\NoticiaRedactor;
use App\Models\NoticiaRedactorLang;
use App\Http\Requests\HandleUpdateNoticiaRedactor;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Pagination\Paginator;
use Illuminate\Http\UploadedFile;
use File;
use DB;
use Illuminate\Support\Str;
use Log;
use Spatie\LaravelImageOptimizer\Facades\ImageOptimizer;

class RedactorController extends Controller
{
    /*
     * Busca el slug que se pasa por parámetro en la base de datos en el idioma indicado y que no sea para el elemento en concreto
     * devuelve el número de veces que aparece el slug
     */
    private function buscarSlugRepetido($id, $slug)
    {
        if ($id !== false) {
            return NoticiaRedactor::where('id', '!=', $id)->where('slug', '=', $slug)->where('slug', '<>', '')->get()->count();
        }
        return NoticiaRedactor::where('slug', '=', $slug)->where('slug', '<>', '')->get()->count();
    }

    public function index(Request $request)
    {
        if ($request->isMethod('post')) {
            $request->session()->put('filtro_noticia_redactor_nombre', $request->input('nombre'));
            $nombre = $request->session()->get('filtro_noticia_redactor_nombre');

            $request->session()->put('filtro_noticia_redactor_slug', $request->input('slug'));
            $slug = $request->session()->get('filtro_noticia_redactor_slug');

            $request->session()->put('paginacion_current_redactor', 1);
        } else {
            $nombre = $request->session()->get('filtro_noticia_redactor_nombre');
            $slug = $request->session()->get('filtro_noticia_redactor_slug');

            if ($request->input('page') != '') {
                //Existe valor de paginador
                $request->session()->put('paginacion_current_redactor', $request->input('page'));
            }
        }

        $currentPage = $request->session()->get('paginacion_current_redactor', 1);

        Paginator::currentPageResolver(function () use ($currentPage) {
            return $currentPage;
        });

        $redactores = NoticiaRedactor::noticiaRedactorFiltradas($nombre, $slug);

        return view('back.noticia.redactor.index', compact('redactores', 'nombre', 'slug'));
    }

    public function delete($id)
    {
        try {
            DB::beginTransaction();
            $redactor = NoticiaRedactor::findOrFail($id);
            $errores = $redactor->permitirBorrar();
            if (empty($errores)) {
                $redactorImg = $redactor->imagen;
                $redactor->delete();
                $this->deleteFileImage($redactorImg);
            } else {
                return redirect()->action('Back\Noticia\RedactorController@index')->with('errores', $errores);
            }
            DB::commit();
            return redirect()->action('Back\Noticia\RedactorController@index');
        } catch (\Exception $e) {
            DB::rollback();
            Log::error('Error: ' . $e->getMessage() . ' ******* Fallo en ' . $e->getFile() . ' ------ En la línea ' . $e->getLine());
            return redirect()->action('Back\Noticia\RedactorController@index')->with('message', 'Error al borrar.');
        }
    }

    public function update($id = null)
    {
        try {
            if ($id) {
                $redactor = NoticiaRedactor::findOrFail($id);
            } else {
                $redactor = new NoticiaRedactor;
            }

            $languages = Language::all();
        } catch (\Exception $e) {
            return redirect()->action('Back\Noticia\RedactorController@index')->with('message', 'No se puede actualizar el registro.');
        }

        return view('back.noticia.redactor.redactor-update', compact('languages', 'redactor'));
    }

    public function handleUpdate(HandleUpdateNoticiaRedactor $request, $id = '')
    {
        try {
            $mensaje = array();
            if ($id == '') {
                // Comprobar si existe ese slug
                if ($repeticioneSlug = $this->buscarSlugRepetido(false, $request->input('slug'))) {
                    $request->merge(['slug' => $request->input('slug') . '-' . $repeticioneSlug]);
                    $mensaje[] = '<p>El slug se ha modificado porque ya existía en otro redactor para este idioma</p>';
                }

                if ($request->hasFile('foto_redactor')) {
                    if ($request->file('foto_redactor')->isValid()) {
                        // Sube y le da un nombre único
                        $nombreImagen = sha1(time() . Str::random(4)) . '.' . $request->file('foto_redactor')->getClientOriginalExtension();

                        $path = $request->file('foto_redactor')->storeAs(config('app.route_uploads.noticias-redactores'), $nombreImagen, 'public_uploads');

                        ImageOptimizer::optimize(public_path('uploads' . DIRECTORY_SEPARATOR . 'noticias' . DIRECTORY_SEPARATOR . 'redactores' . DIRECTORY_SEPARATOR . $nombreImagen));
                        $request->merge(['imagen' => $nombreImagen]);
                    }
                }

                $redactor = NoticiaRedactor::create($request->all());

                foreach (Language::all() as $key => $idioma) {
                    $redactores = $request->input('redactores')[$idioma->id];
                    $new_elements = array(
                        'idioma_id' => $idioma->id,
                        'noticia_redactor_id' => $redactor->id
                    );
                    $redactores = array_merge($redactores, $new_elements);

                    $redactorLang = NoticiaRedactorLang::create($redactores);
                }
            } else {
                $redactor = NoticiaRedactor::findOrFail($id);
                // Comprobar si existe ese slug
                if ($repeticioneSlug = $this->buscarSlugRepetido($id, $request->input('slug'))) {
                    $request->merge(['slug' => $request->input('slug') . '-' . $repeticioneSlug]);
                    $mensaje[] = '<p>El slug se ha modificado porque ya existía en otro redactor para este idioma</p>';
                }

                if ($request->hasFile('foto_redactor')) {
                    if ($request->file('foto_redactor')->isValid()) {
                        $this->deleteFileImage($redactor->imagen);
                        // Sube y le da un nombre único
                        $nombreImagen = sha1(time() . Str::random(4)) . '.' . $request->file('foto_redactor')->getClientOriginalExtension();
                        $path = $request->file('foto_redactor')->storeAs(config('app.route_uploads.noticias-redactores'), $nombreImagen, 'public_uploads');


                        $request->merge(['imagen' => $nombreImagen]);
                    }
                }

                foreach (Language::all() as $key => $idioma) {
                    $redactores = $request->input('redactores')[$idioma->id];
                    $new_elements = array(
                        'idioma_id' => $idioma->id,
                        'noticia_redactor_id' => $redactor->id
                    );
                    $redactores = array_merge($redactores, $new_elements);

                    $redactorLang = NoticiaRedactorLang::where('idioma_id', '=', $idioma->id)->where('noticia_redactor_id', '=', $id)->first();
                    $redactorLang->update($redactores);
                }

                $redactor->update($request->all());
            }
            return redirect()->action('Back\Noticia\RedactorController@update', $id)->with('avisos', $mensaje);
        } catch (\Exception $e) {
            return redirect()->action('Back\Noticia\RedactorController@update', $id)->with('message', 'Error al guardar.');
        }
    }

    public function deleteImage($id)
    {
        try {
            $redactor = NoticiaRedactor::findOrFail($id);
            if (!empty($redactor->imagen)) {
                $path = public_path() . DIRECTORY_SEPARATOR . 'uploads' . DIRECTORY_SEPARATOR . config('app.ruta_uploads.noticias-redactores') . DIRECTORY_SEPARATOR;
                $file = $path . $redactor->imagen;
                if (File::exists($file)) {
                    File::delete($file);
                    $redactor->imagen = '';
                    $redactor->save();
                }
            }
            return redirect()->action('Back\Noticia\RedactorController@update', $id);
        } catch (\Exception $e) {
            return redirect()->action('Back\Noticia\RedactorController@update', $id)->with('message', 'Error al guardar.');
        }
    }

    public function deleteFileImage($imagen)
    {
        if (!empty($imagen)) {
            $path = public_path() . DIRECTORY_SEPARATOR . 'uploads' . DIRECTORY_SEPARATOR . config('app.ruta_uploads.noticias-redactores') . DIRECTORY_SEPARATOR;
            $file = $path . $imagen;

            if (File::exists($file)) {
                File::delete($file);
            }
        }
    }
}