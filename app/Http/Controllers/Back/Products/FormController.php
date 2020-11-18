<?php

namespace App\Http\Controllers\Back\Products;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\ProductsFormRequest;
use App\Models\Language;
use App\Models\ProductForm;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class FormController extends Controller
{
    public function index()
    {
        $forms = ProductForm::all();
        return view('back.products.forms.index', compact('forms'));
    }

    public function update($id = null)
    {
        if ($id) {
            $form = ProductForm::find($id);
        } else {
            $form = new ProductForm;
        }

        $languages = Language::all();

        return view('back.products.forms.update', compact('form', 'languages'));
    }

    public function handleUpdate(ProductsFormRequest $request, $id = null)
    {
        try {
            DB::beginTransaction();

            if ($id) {
                $form = ProductForm::findOrFail($id);
                $form->update($request->toArray());
                foreach (Language::all() as $language) {
                    $form->lang($language->id)->update([
                        'form_id' => $form->id,
                        'language_id' => $language->id,
                        'name' => $request->name[$language->id - 1],
                    ]);
                }
            } else {
                $form = ProductForm::create($request->toArray());

                foreach (Language::all() as $language) {
                    $form->formLangs()->create([
                        'form_id' => $form->id,
                        'language_id' => $language->id,
                        'name' => $request->name[$language->id - 1],
                    ]);
                }
            }
            DB::commit();

            return redirect()->route('formIndex')->with('success', "Guardado correctamente");
        } catch (\Exception $e) {
            DB::rollback();
            Log::error('Error: ' . $e->getMessage() . ' ******* Fallo en ' . $e->getFile() . ' ------ En la línea ' . $e->getLine());
            return redirect()->route('formUpdate')->with('message', 'No se ha podido realizar la acción.');
        }
    }

    public function delete($id)
    {
        $form = ProductForm::findOrFail($id);

        $form->delete();

        return response()->json("ok");
    }
}
