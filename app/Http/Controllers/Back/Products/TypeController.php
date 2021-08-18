<?php

namespace App\Http\Controllers\Back\Products;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\ProductsTypeRequest;
use App\Models\Language;
use App\Models\ProductType;
use App\Models\TypeLang;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class TypeController extends Controller
{
    public function index()
    {
        $types = ProductType::all();
        return view('back.products.types.index', compact('types'));
    }

    public function update($id = null)
    {
        if ($id) {
            $type = ProductType::find($id);
        } else {
            $type = new ProductType;
        }

        $languages = Language::all();

        return view('back.products.types.update', compact('type', 'languages'));
    }

    public function handleUpdate(ProductsTypeRequest $request, $id = null)
    {
        try {
            DB::beginTransaction();

            if ($id) {
                $type = ProductType::findOrFail($id);
                $type->update([
                    "active" => $request->active == "on" ? true : false
                ]);
                foreach (Language::all() as $language) {
                    $type->lang($language->id)->update([
                        'type_id' => $type->id,
                        'language_id' => $language->id,
                        'name' => $request->name[$language->id - 1],
                        'description' => $request->description[$language->id - 1],
                    ]);
                }
            } else {
                $type = ProductType::create([
                    "active" => $request->active
                ]);

                foreach (Language::all() as $language) {
                    $type->typeLangs()->create([
                        'type_id' => $type->id,
                        'language_id' => $language->id,
                        'name' => $request->name[$language->id - 1],
                        'description' => $request->description[$language->id - 1],
                    ]);
                }
            }
            DB::commit();

            return redirect()->route('typeIndex', $type->id);
        } catch (\Exception $e) {
            DB::rollback();
            Log::error('Error: ' . $e->getMessage() . ' ******* Fallo en ' . $e->getFile() . ' ------ En la línea ' . $e->getLine());
            return redirect()->route('typeUpdate', $type->id)->with('message', 'No se ha podido realizar la acción.');
        }
    }

    public function delete($id)
    {
        $type = ProductType::findOrFail($id);

        $type->delete();

        return response()->json("ok");
    }
}
