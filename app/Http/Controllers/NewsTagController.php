<?php

namespace App\Http\Controllers;

use App\Models\Section;
use App\NewsTag;
use Illuminate\Http\Request;

class NewsTagController extends Controller
{
    public $section;

    public function __construct()
    {
        $this->section = Section::find(config('app.enabled_sections.noticias'));
    }

    public function index()
    {
        return response()->json(NewsTag::with('news')->get());
    }

    public function store(Request $request)
    {
        $this->authorize('write', $this->section);
        $tag = NewsTag::create([]);
        foreach ($request->languages as $language) {
            $tag->languages()->create($language);
        }
        return response()->json($tag);
    }

    public function update(Request $request, $id)
    {
        $this->authorize('write', $this->section);
        $tag = NewsTag::findOrFail($id);
        foreach ($request->languages as $language) {
            $tag->lang($language["language_id"])->update($language);
        }
        return response()->json($tag);
    }

    public function destroy($id)
    {
        $this->authorize('delete', $this->section);
        $tag = NewsTag::findOrFail($id);
        $tag->languages()->delete();
        $tag->delete();
    }
}
