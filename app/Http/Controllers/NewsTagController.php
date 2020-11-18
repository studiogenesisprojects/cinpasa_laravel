<?php

namespace App\Http\Controllers;

use App\NewsTag;
use Illuminate\Http\Request;

class NewsTagController extends Controller
{
    public function index()
    {
        return response()->json(NewsTag::with('news')->get());
    }

    public function store(Request $request)
    {
        $tag = NewsTag::create([]);
        foreach ($request->languages as $language) {
            $tag->languages()->create($language);
        }
        return response()->json($tag);
    }

    public function update(Request $request, $id)
    {
        $tag = NewsTag::findOrFail($id);
        foreach ($request->languages as $language) {
            $tag->lang($language["language_id"])->update($language);
        }
        return response()->json($tag);
    }

    public function destroy($id)
    {
        $tag = NewsTag::findOrFail($id);
        $tag->languages()->delete();
        $tag->delete();
    }
}
