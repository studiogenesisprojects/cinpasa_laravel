<?php

namespace App\Http\Controllers\Back\Materials;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\MaterialRequest;
use App\Models\Language;
use App\Models\Material;
use App\Models\MaterialCategory;
use Exception;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class MaterialsController extends Controller
{
    public function index()
    {
        // Material::ponerOrder();
        $materials = Material::cursor();

        return view('back.materials.index', compact('materials'));
    }

    public function update($id = null)
    {
        if ($id) {
            $material = Material::find($id);
        } else {
            $material = new Material;
        }

        $languages = Language::all();
        $categories = MaterialCategory::where('active', true)->get();

        return view('back.materials.update', compact('material', 'categories', 'languages'));
    }

    public function handleUpdate(MaterialRequest $request, $id = null)
    {
        try {
            DB::beginTransaction();
            if ($request->category_father != "null") {
                $category = $request->category_father;
            } else {
                $category = null;
            }

            if ($id) {
                $material = Material::findOrFail($id);
                $material->categories()->sync($request->materialCategories);
                $material->update([
                    'order' => $request->order,
                    'sup_material' => $category,
                ]);

                $this->repeatedOrder($material->order);

                foreach ($request->materialsLangs as $language) {
                    if ($material->lang((int) $language['language_id'])) {
                        $material->lang((int) $language['language_id'])->update($language);
                    } else {
                        $material->languages()->create($language);
                    }
                }

                DB::commit();

                return redirect()->route('materialIndex')->with('success', "Material actualizado correctamente");
            } else {
                $material = Material::create([
                    'order' => $request->order,
                    'sup_material' => $category,
                ]);
                $material->categories()->sync($request->materialCategories);

                foreach ($request->materialsLangs as $language) {
                    $material->languages()->create($language);
                }

                DB::commit();

                return redirect()->route('materialIndex')->with('success', "Material creado correctamente");
            }
        } catch (\Exception $e) {
            DB::rollback();
            Log::error('Error: ' . $e->getMessage() . ' ******* Fallo en ' . $e->getFile() . ' ------ En la línea ' . $e->getLine());
            return redirect()->route('materialUpdate')->with('error_message', 'No se ha podido realizar la acción.');
        }
    }

    private function repeatedOrder($order)
    {
        //Busco todos los que tienen el order que le he mandado
        $sameOrders = Material::where('order', $order)
            ->orderBy('updated_at', 'DESC')
            ->get();
        //si hay mas de uno pillo el segundo, le pongo de orden el siguiente numero y lo guardo
        if ($sameOrders->count() > 1) {
            $next = $sameOrders[1]->order + 1;
            $sameOrders[1]->update(['order' => $next]);

            //llamo otra vez a esta funcion con el número siguiente
            $this->repeatedOrder($next);
        }
    }

    public function delete($id)
    {
        $material = Material::findOrFail($id);

        $material->delete();

        return response()->json("ok");
    }

    public function toggleActive($id)
    {
        $material = Material::findOrFail($id);
        $material->update([
            "active" => !$material->active
        ]);

        return response()->json(["active" => $material->active]);
    }

    public function changeOrder(Request $request, $id)
    {
        $request->validate([
            "order" => "required|numeric",
        ]);
        $material = Material::findOrFail($id);
        $material->update([
            "order" => $request->order,
        ]);
        return response()->json(["order" => $material->order]);
    }
}
