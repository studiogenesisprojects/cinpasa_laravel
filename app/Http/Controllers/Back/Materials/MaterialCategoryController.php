<?php

namespace App\Http\Controllers\Back\Materials;

use App\Http\Controllers\Controller;
use App\Models\Language;
use App\Models\Material;
use App\Models\MaterialCategory;
use App\Models\Section;
use Illuminate\Http\Request;

class MaterialCategoryController extends Controller
{
    public $section;
    public function __construct()
    {
        $this->section = Section::find(config('app.enabled_sections.materiales'));
    }

    public function index()
    {
        $this->authorize('read', $this->section);
        $categories = MaterialCategory::all();
        return view('back.materials.categories.index', compact('categories'));
    }

    public function create()
    {
        $this->authorize('write', $this->section);
        $category = new MaterialCategory();
        $materials = Material::all();
        $languages = Language::all();
        return view('back.materials.categories.create', compact('category', 'materials', 'languages'));
    }

    public function edit($id)
    {
        $this->authorize('write', $this->section);
        $category = MaterialCategory::findOrFail($id);
        $materials = Material::all();
        $languages = Language::all();
        return view('back.materials.categories.edit', compact('category', 'materials', 'languages'));
    }

    public function store(Request $request)
    {
        $this->authorize('write', $this->section);
        $materialCategory = MaterialCategory::create($request->all());
        $materialCategory->materials()->sync($request->materials);
        foreach ($request->materialsLangs as $language) {
            $materialCategory->languages()->create($language);
        }
        return redirect()->route('material.categorias.index')->with(['success' => "Categoría creada correcatemente"]);
    }

    public function update(Request $request, $id)
    {
        $this->authorize('write', $this->section);
        $materialCategory = MaterialCategory::findOrFail($id);
        $materialCategory->update($request->all());

        $materialCategory->materials()->detach();
        foreach ($request->materials as $index => $material) {
            if ($material) {
                $materialCategory->materials()->attach([
                    "material_id" => $material,
                ]);
            }
        }

        foreach ($request->materialsLangs as $language) {
            $materialCategory->lang((int) $language["language_id"])->update($language);
        }

        return redirect()->route('material.categorias.index')->with(['success' => "Categoría actualizada correcatemente"]);
    }

    public function destroy($id)
    {
        $this->authorize('delete', $this->section);
        $category = MaterialCategory::findOrFail($id);
        $category->materials()->detach();
        $category->delete();
        return response()->noContent();
    }

    public function toggleActive($id)
    {
        $this->authorize('write', $this->section);
        $category = MaterialCategory::findOrFail($id);
        $category->update([
            "active" => !$category->active
        ]);

        return response()->json(["active" => $category->active]);
    }

    public function changeOrder(Request $request, $id)
    {
        $this->authorize('write', $this->section);
        $request->validate([
            "order" => "required|numeric",
        ]);
        $category = MaterialCategory::findOrFail($id);
        $category->update([
            "order" => $request->order,
        ]);
        return response()->json(["order" => $category->order]);
    }
}
