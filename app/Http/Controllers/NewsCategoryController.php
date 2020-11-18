<?php

namespace App\Http\Controllers;

use App\NewsCategory;
use Illuminate\Http\Request;

class NewsCategoryController extends Controller
{


    public function index()
    {
        return response()->json(NewsCategory::with('news')->get());
    }

    public function store(Request $request)
    {
        $category = NewsCategory::create([]);
        foreach ($request->languages as $language) {
            $category->languages()->create($language);
        }
        return response()->json($category);
    }

    public function update(Request $request, $id)
    {
        $category = NewsCategory::findOrFail($id);
        foreach ($request->languages as $language) {
            $category->lang($language["language_id"])->update($language);
        }
        return response()->json($category);
    }

    public function destroy($id)
    {
        $category = NewsCategory::findOrFail($id);
        $category->languages()->delete();
        $category->delete();
    }
}
