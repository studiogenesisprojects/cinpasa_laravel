<?php

namespace App\Http\Controllers;

use App\Models\Section;
use App\NewsCategory;
use Illuminate\Http\Request;

class NewsCategoryController extends Controller
{
    public $section;

    public function __construct()
    {
        $this->section = Section::find(config('app.enabled_sections.noticias'));
    }

    public function index()
    {
        return response()->json(NewsCategory::with('news')->get());
    }

    public function store(Request $request)
    {
        $this->authorize('write', $this->section);
        $category = NewsCategory::create([]);
        foreach ($request->languages as $language) {
            $category->languages()->create($language);
        }
        return response()->json($category);
    }

    public function update(Request $request, $id)
    {
        $this->authorize('write', $this->section);
        $category = NewsCategory::findOrFail($id);
        foreach ($request->languages as $language) {
            $category->lang($language["language_id"])->update($language);
        }
        return response()->json($category);
    }

    public function destroy($id)
    {
        $this->authorize('delete', $this->section);
        $category = NewsCategory::findOrFail($id);
        $category->languages()->delete();
        $category->delete();
    }
}
