<?php

namespace App\Http\Controllers\Back\Products;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\ProductsBraidedRequest;
use App\Models\Language;
use App\Models\ProductBraided;
use App\Models\Section;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class BraidedController extends Controller
{
    public $section;

    public function __construct()
    {
        $this->section = Section::find(config('app.enabled_sections.productos'));
    }
    
    public function index()
    {
        $this->authorize('read', $this->section);
        $braids = ProductBraided::cursor();
        return view('back.products.braids.index', compact('braids'));
    }

    public function update($id = null)
    {
        $this->authorize('write', $this->section);
        if ($id) {
            $braid = ProductBraided::find($id);
        } else {
            $braid = new ProductBraided;
        }
        $languages = Language::all();

        return view('back.products.braids.update', compact('braid', 'languages'));
    }

    public function handleUpdate(ProductsBraidedRequest $request, $id = null)
    {
        $this->authorize('write', $this->section);
        try {
            DB::beginTransaction();

            if ($id) {
                $braid = ProductBraided::findOrFail($id);
                $braid->update($request->toArray());
                foreach (Language::all() as $language) {
                    $braid->lang($language->id)->update([
                        'product_braided_id' => $braid->id,
                        'language_id' => $language->id,
                        'name' => $request->name[$language->id - 1],
                        'description' => $request->description[$language->id - 1],
                    ]);
                }
            } else {
                $braid = ProductBraided::create($request->toArray());

                foreach (Language::all() as $language) {
                    $braid->languages()->create([
                        'product_braided_id' => $braid->id,
                        'language_id' => $language->id,
                        'name' => $request->name[$language->id - 1],
                        'description' => $request->description[$language->id - 1],
                    ]);
                }
            }
            DB::commit();

            return redirect()->route('braidedIndex', $braid->id);
        } catch (\Exception $e) {
            DB::rollback();
            Log::error('Error: ' . $e->getMessage() . ' ******* Fallo en ' . $e->getFile() . ' ------ En la línea ' . $e->getLine());
            return redirect()->route('braidedUpdate')->with('error_message', 'No se ha podido realizar la acción.');
        }
    }

    public function delete($id)
    {
        $this->authorize('delete', $this->section);
        $braid = ProductBraided::findOrFail($id);
        $braid->delete();

        return response()->json("ok");
    }
}
