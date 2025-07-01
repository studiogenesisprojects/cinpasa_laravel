<?php

namespace App\Http\Controllers\Back\Products;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\ProductLabelRequest;
use App\Models\ProductLabel;
use App\Models\Section;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class LabelController extends Controller
{
    public $section;

    public function __construct()
    {
        $this->section = Section::find(config('app.enabled_sections.productos'));
    }
    
    public function index()
    {
        $this->authorize('read', $this->section);
        $labels = ProductLabel::cursor();
        return view('back.products.labels.index', compact('labels'));
    }

    public function update($id = null)
    {
        $this->authorize('write', $this->section);
        if ($id) {
            $label = ProductLabel::find($id);
        } else {
            $label = new ProductLabel;
        }

        return view('back.products.labels.update', compact('label'));
    }

    public function handleUpdate(ProductLabelRequest $request, $id = null)
    {
        $this->authorize('write', $this->section);
        try {
            DB::beginTransaction();

            if ($id) {
                $label = ProductLabel::findOrFail($id);
                $label->update([
                    'name' => $request->name,
                    'description' => $request->description,
                ]);
            } else {
                $label = ProductLabel::create([
                    'name' => $request->name,
                    'description' => $request->description,
                ]);
            }
            DB::commit();
            return redirect()->route('labelIndex', $label->id);
        } catch (\Exception $e) {
            DB::rollback();
            Log::error('Error: ' . $e->getMessage() . ' ******* Fallo en ' . $e->getFile() . ' ------ En la línea ' . $e->getLine());
            return redirect()->route('labelUpdate')->with('message', 'No se ha podido realizar la acción.');
        }
    }

    public function delete($id)
    {
        $this->authorize('delete', $this->section);
        $label = ProductLabel::findOrFail($id);

        $label->delete();

        return response()->json("ok");
    }
}