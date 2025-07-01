<?php

namespace App\Http\Controllers\Back\Finished;

use App\Http\Controllers\Controller;
use App\Models\FinishedMaterial;
use App\Models\Language;
use App\Models\Section;
use Illuminate\Http\Request;

class FinishedMaterialController extends Controller
{
    public $section;

    public function __construct()
    {
        $this->section = Section::find(config('app.enabled_sections.acabados'));
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->authorize('read', $this->section);
        $materials = FinishedMaterial::all();
        return view('back.finisheds.materials.index', compact('materials'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $this->authorize('write', $this->section);
        $languages = Language::all();
        return view('back.finisheds.materials.create', compact('languages'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->authorize('write', $this->section);
        $request->validate([]);

        $material = FinishedMaterial::create();

        foreach ($request->languages as $index => $language) {
            $material->languages()->create([
                "language_id" => $language['language_id'],
                "name" => $request->materials[$index]['name']
            ]);
        }

        return redirect()->route('materiales-acabados.index')->with('success', "Material creado correctamente");
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $this->authorize('write', $this->section);
        $material = FinishedMaterial::findOrFail($id);
        $languages = Language::all();
        return view('back.finisheds.materials.edit', compact('material', 'languages'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->authorize('write', $this->section);
        $material = FinishedMaterial::findOrFail($id);
        foreach ($request->languages as $index => $language) {
            $material->lang((int) $language['language_id'])->update([
                "name" => $request->materials[$index]['name']
            ]);
        }

        return redirect()->route('materiales-acabados.index')->with('success', "Material actualizado correctamente");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $this->authorize('delete', $this->section);
        $p = FinishedMaterial::findOrFail($id);
        $p->delete();
        return response()->json("OK");
    }
}