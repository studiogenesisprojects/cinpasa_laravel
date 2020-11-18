<?php

namespace App\Http\Controllers\Back\Galery;

use App\Models\Language;
use App\Models\Galery;
use App\Models\GaleryImage;
use App\Models\GaleryImageLang;
use App\Http\Requests\HandleUpdateGaleryImage;
use App\Http\Requests\HandleUpdateGalery;
use Illuminate\Http\Request;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\File;
use App\Http\Controllers\Controller;
use Log;
use DB;
use Illuminate\Support\Str;
use ImageOptimizer;


class GaleryController extends Controller
{
    public function index(Request $request)
    {
        if ($request->isMethod('post')) {
            $request->session()->put('filtro_galeria_titulo', $request->input('titulo'));
            $titulo = $request->session()->get('filtro_galeria_titulo');

            $fecha = $request->input('fecha_filtro');
            if ($fecha != '') {
                $fecha = str_replace('/', '-', $fecha);
                $fecha = date('Y-m-d', strtotime($fecha));
            }
            $request->session()->put('filtro_galeria_fecha', $fecha);
            $fecha = $request->session()->get('filtro_galeria_fecha');

            $request->session()->put('paginacion_current_galeria', 1);
        } else {
            $titulo = $request->session()->get('filtro_galeria_titulo');
            $fecha = $request->session()->get('filtro_galeria_fecha');

            if ($request->input('page') != '') {
                //Existe valor de paginador
                $request->session()->put('paginacion_current_galeria', $request->input('page'));
            }
        }

        $currentPage = $request->session()->get('paginacion_current_galeria');

        Paginator::currentPageResolver(function () use ($currentPage) {
            return $currentPage;
        });

        $galerias = Galery::galeriasFiltradas($titulo, $fecha);

        return view('back.galery.index', compact('galerias', 'titulo', 'fecha'));
    }

    public function delete($id)
    {
        try {
            DB::beginTransaction();
            $galeria = Galery::findOrFail($id);
            $errores = $galeria->permitirBorrar();
            if (empty($errores)) {
                $imagenes = $galeria->imagenesGaleria;
                foreach ($imagenes as $key => $imagen) {
                    $this->deleteFileImage($imagen->imagen);
                    $imagen->delete();
                }
                $galeria->delete();
            } else {
                return redirect()->action('Back\Galery\GaleryController@index')->with('errores', $errores);
            }
            DB::commit();
        } catch (\Exception $e) {
            DB::rollback();
            Log::error('Error: ' . $e->getMessage() . ' ******* Fallo en ' . $e->getFile() . ' ------ En la línea ' . $e->getLine());
            return redirect()->action('Back\Galery\GaleryController@index')->with('message', 'Error al borrar.');
        }
        return redirect()->action('Back\Galery\GaleryController@index');
    }

    public function updateStatus($id)
    {
        try {
            $galeria = Galery::findOrFail($id);
            if ($galeria->activo) {
                $galeria->activo = 0;
            } else {
                $galeria->activo = 1;
            }
            $galeria->save();
        } catch (\Exception $e) {
            return redirect()->action('Back\Galery\GaleryController@index')->with('message', 'Error al actualizar.');
        }

        return redirect()->action('Back\Galery\GaleryController@index');
    }

    public function update($id = null)
    {
        try {
            if ($id) {
                $galeria = Galery::findOrFail($id);
            } else {
                $galeria = new Galery;
            }

            $idiomas = Language::cursor();
        } catch (\Exception $e) {
            return redirect()->action('Back\Galery\GaleryController@index')->with('message', 'No se puede actualizar el registro.');
        }

        return view('back.galery.galeria-update', compact('idiomas', 'galeria'));
    }

    public function handleUpdate(HandleUpdateGalery $request, $id = null)
    {
        try {
            $mensaje = array();
            // Ponemos el orden a 0 por defecto
            $orden = 0;

            // Si tenemos id buscamos la galeria y actualizamos el orden a la ultima posición
            if ($id) {
                $galeria = Galery::find($id);
                $galeria->update($request->all());
                if ($galeria->imagenesGaleria->count())
                    $orden = $galeria->imagenesGaleria->max('orden');
            } else {
                $galeria = Galery::create($request->all());
            }


            // Logica para subir imagenes i optimizarlas
            if ($request->hasFile('imagenes')) {
                foreach ($request->file('imagenes') as $indiceImagen => $imagen) {
                    if ($request->file('imagenes')[$indiceImagen]->isValid()) {
                        // Sube y le da un nombre único
                        $nombreImagen = sha1(time() . Str::random(4)) . '.' . $request->file('imagenes')[$indiceImagen]->getClientOriginalExtension();
                        $request->file('imagenes')[$indiceImagen]->storeAs(config('app.route_uploads.galerias'), $nombreImagen, 'public_uploads');
                        ImageOptimizer::optimize(public_path('uploads' . DIRECTORY_SEPARATOR . 'galerias' . DIRECTORY_SEPARATOR . $nombreImagen));

                        // Ponemos en el request los valores que no nos llegan y van a la tabla de galeria_imagenes
                        $request->merge([
                            'imagen' => $nombreImagen,
                            'galeria_id' => $galeria->id,
                            'orden' => ++$orden
                        ]);

                        $galeriaImagen = GaleryImage::create($request->all());
                    }

                    foreach (Language::all() as $idioma) {
                        $request->merge([
                            'galeria_imagen_id' => $galeriaImagen->id,
                            'idioma_id' => $idioma->id,
                            'texto' => $request->input('textos')[$idioma->id][$indiceImagen]
                        ]);

                        GaleryImageLang::create($request->all());
                    }
                }
            }

            return redirect()->action('Back\Galery\GaleryController@update', $galeria->id)->with('avisos', $mensaje);
        } catch (\Exception $e) {
            Log::error('Error: ' . $e->getMessage() . ' ******* Fallo en ' . $e->getFile() . ' ------ En la línea ' . $e->getLine());
            return redirect()->action('Back\Galery\GaleryController@update', $id)->with('message', 'Error al guardar.');
        }
    }

    public function deleteImage($galeria_id, $id)
    {
        try {
            $imagen = GaleryImage::findOrFail($id);
            if ($imagen->galeria_id == $galeria_id) {
                if (!empty($imagen->imagen)) {
                    $path = public_path() . DIRECTORY_SEPARATOR . 'uploads' . DIRECTORY_SEPARATOR . config('app.route_uploads.galerias') . DIRECTORY_SEPARATOR;
                    $file = $path . $imagen->imagen;
                    if (File::exists($file)) {
                        File::delete($file);
                        // Recogemos todas las imágenes de la galería y les actualizamos el orden con respecto a la que se ha eliminado.
                        $imagenesOrdenSup = GaleryImage::where('galeria_id', '=', $galeria_id)->where('galeria_id', '=', $galeria_id)->where('orden', '>', $imagen->orden)->orderBy('orden', 'ASC')->get();

                        $nuevo_orden =  $imagen->orden;
                        foreach ($imagenesOrdenSup as $img) {
                            $img->orden = $nuevo_orden;
                            $nuevo_orden++;
                            $img->save();
                        }

                        // Después de eliminar y reordenar los elementos elimino el registro deseado
                        $imagen->delete();
                    }
                }
            } else {
                return redirect()->action('Back\Galery\GaleryController@update', $galeria_id)->with('message', 'Error al borrar.');
            }
            return redirect()->action('Back\Galery\GaleryController@update', $galeria_id);
        } catch (\Exception $e) {
            return redirect()->action('Back\Galery\GaleryController@update', $galeria_id)->with('message', 'Error al borrar.');
        }
    }

    public function editImage($galeria_id, $id)
    {
        try {
            $imagen = GaleryImage::findOrFail($id);
            if ($imagen->galeria_id == $galeria_id) {
                $idiomas = Language::cursor();
                return view('back.galery.galeria-editar-imagen', compact('imagen', 'galeria_id', 'idiomas'));
            } else {
                return redirect()->action('Back\Galery\GaleryController@update', $galeria_id)->with('message', 'Error al editar imagen.');
            }
        } catch (\Exception $e) {
            return redirect()->action('Back\Galery\GaleryController@update', $galeria_id)->with('message', 'Error al editar imagen.');
        }
    }

    public function handleUpdateImage(HandleUpdateGaleryImage $request, $galeria_id, $id)
    {
        try {
            $imagen = GaleryImage::findOrFail($id);
            foreach (Language::all() as $idioma) {
                $textoIdioma = GaleryImageLang::where('galeria_imagen_id', '=', $imagen->id)->where('idioma_id', '=', $idioma->id)->first();
                $request->merge([
                    'galeria_imagen_id' => $imagen->id,
                    'idioma_id' => $idioma->id,
                    'texto' => $request->input('textos')[$idioma->id]['texto']
                ]);

                // Si se añade un nuevo idioma, que no tenía dado de alta antes, en vez de actualzar hay que crear el objeto
                if (!is_null($textoIdioma)) {
                    $textoIdioma->update($request->all());
                } else {
                    $textoIdioma = GaleryImageLang::create($request->all());
                }
            }

            if ($request->hasFile('img_new')) {
                if ($request->file('img_new')->isValid()) {
                    $imagenBorrar = $imagen->imagen;
                    // Sube y le da un nombre único
                    $nombreImagen = sha1(time() . Str::random(4)) . '.' . $request->file('img_new')->getClientOriginalExtension();
                    $path = $request->file('img_new')->storeAs(config('app.route_uploads.galerias'), $nombreImagen, 'public_uploads');
                    ImageOptimizer::optimize(public_path('uploads' . DIRECTORY_SEPARATOR . 'galerias' . DIRECTORY_SEPARATOR . $nombreImagen));

                    // Ponemos en el request los valores que no nos llegan y van a la tabla de galeria_imagenes
                    $request->merge([
                        'imagen' => $nombreImagen,
                        'galeria_id' => $imagen->galeria_id,
                        'orden' => $imagen->orden
                    ]);
                    $this->deleteFileImage($imagenBorrar);
                    $imagen->update($request->all());
                }
            }
            return redirect()->action('Back\Galery\GaleryController@update', [$galeria_id]);
        } catch (\Exception $e) {

            return redirect()->action('Back\Galery\GaleryController@editImage', [$galeria_id, $id])->with('message', 'Error guardar.');
        }
    }

    public function disminuirPosicion($galeria_id, $imagen_id)
    {
        try {
            $imagen = GaleryImage::findOrFail($imagen_id);
            if ($imagen->galeria_id == $galeria_id) {

                // Guardo las posiciónes del que quiero actualizar y del que está encima
                $pos_inferior = $imagen->orden - 1;
                $pos_superior = $imagen->orden;

                // Busco la imagen que tenga el orden uno superior
                $imagen_anterior = GaleryImage::where('orden', '=', $pos_inferior)->first();

                // Intercambio las posiciones de las imagenes
                $imagen_anterior->orden = $pos_superior;
                $imagen_anterior->save();
                $imagen->orden = $pos_inferior;
                $imagen->save();
            } else {
                return redirect()->action('Back\Galery\GaleryController@update', $galeria_id)->with('message', 'Error al actualizar posición.');
            }

            return redirect()->action('Back\Galery\GaleryController@update', $galeria_id);
        } catch (\Exception $e) {
            return redirect()->action('Back\Galery\GaleryController@update', $galeria_id)->with('message', 'Error al actualizar posición.');
        }
    }

    public function aumentarPosicion($galeria_id, $imagen_id)
    {
        try {
            $imagen = GaleryImage::findOrFail($imagen_id);
            if ($imagen->galeria_id == $galeria_id) {
                // Guardo las posiciónes del que quiero actualizar y del que está encima

                $pos_inferior = $imagen->orden + 1;
                $pos_superior = $imagen->orden;

                // Busco la imagen que tenga el orden uno superior
                $imagen_anterior = GaleryImage::where('orden', '=', $pos_inferior)->first();

                // Intercambio las posiciones de las imagenes
                $imagen_anterior->orden = $pos_superior;
                $imagen_anterior->save();
                $imagen->orden = $pos_inferior;
                $imagen->save();
            } else {
                return redirect()->action('Back\Galery\GaleryController@update', $galeria_id)->with('message', 'Error al actualizar posición.');
            }

            return redirect()->action('Back\Galery\GaleryController@update', $galeria_id);
        } catch (\Exception $e) {
            return redirect()->action('Back\Galery\GaleryController@update', $galeria_id)->with('message', 'Error al actualizar posición.');
        }
    }

    public function deleteFileImage($imagen)
    {
        if (!empty($imagen)) {
            $path = public_path() . DIRECTORY_SEPARATOR . 'uploads' . DIRECTORY_SEPARATOR . config('app.route_uploads.galerias') . DIRECTORY_SEPARATOR;
            $file = $path . $imagen;

            if (File::exists($file)) {
                File::delete($file);
            }
        }
    }

    /**
     * Buscar galerías usando la select 2 por post
     * @param  Request $request
     * @return Collection Galeria
     */
    public function buscarGalerias(Request $request)
    {
        try {
            $term = $request->input('term');

            $galerias = Galery::where('titulo', 'like',  '%' . $term . '%')->get();

            return $galerias;
        } catch (Exception $e) {
            Log::error('Error: ' . $e->getMessage() . ' ******* Fallo en ' . $e->getFile() . ' ------ En la línea ' . $e->getLine());
            return collect(new Galeria);
        }
    }
}
