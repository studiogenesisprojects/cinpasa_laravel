<?php

namespace App\Http\Controllers\Back\Aplication;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Aplication;
use App\Models\AplicationLang;
use App\Models\ApplicationCategory;
use App\Models\ProductCategory;
use App\Models\Language;
use Illuminate\Support\Facades\Storage;

class AplicationController extends Controller
{
    public function index()
    {
        $aplications = Aplication::orderBy('order', 'DESC')->get();

        return view('back.aplication.index', compact('aplications'));
    }

    public function create()
    {

        $applicationCategories = ApplicationCategory::all();
        $languages = Language::all();
        return view('back.aplication.create', compact('applicationCategories', 'languages'));
    }

    public function store(Request $request)
    {

        $app = Aplication::create($request->all());

        if ($request->hasFile('section_image')) {
            $path = $request->file('section_image')->storeAs('aplicaciones', $request->file('section_image')->getClientOriginalName());
            $app->primary_image = $path;
        }

        if ($request->hasFile('list_image')) {
            $path = $request->file('list_image')->storeAs('aplicaciones', $request->file('list_image')->getClientOriginalName());
            $app->list_image = $path;
        }

        $app->save();

        foreach ($request->languages as $language) {
            $language["active"] = isset($language["active"]);
            $app->languages()->create($language);
        }
        !$request->applicationCategories ?: $app->applicationCategories()->sync(array_values($request->applicationCategories));
        return redirect()->route('aplicaciones.index')->with('success', "aplicación creada correctamente");
    }

    public function edit($id)
    {
        $application = Aplication::findOrFail($id);
        $applicationCategories = ApplicationCategory::all();
        $languages = Language::all();
        return view('back.aplication.edit', compact("application", "applicationCategories", "languages"));
    }


    public function update(Request $request, $id)
    {
        $aplication = Aplication::findOrFail($id);
        $aplication->order = $request->order;
        if ($request->hasFile('section_image')) {
            $path = $request->file('section_image')->storeAs('aplicaciones', $request->file('section_image')->getClientOriginalName());
            $aplication->primary_image = $path;
        }

        if ($request->hasFile('list_image')) {
            $path = $request->file('list_image')->storeAs('aplicaciones', $request->file('list_image')->getClientOriginalName());
            $aplication->list_image = $path;
        }

        $aplication->save();
        !$request->applicationCategories ?: $aplication->applicationCategories()->sync(array_values($request->applicationCategories));
        foreach ($request->languages as $language) {
            $language["active"] = isset($language["active"]);
            $lang = $aplication->lang((int) $language['language_id']);
            $lang ? $lang->update($language) : $aplication->languages()->create($language);
        }

        return redirect()->route('aplicaciones.index')->with('success', 'Aplicación actualizada correctamente');
    }

    public function order(Request $request)
    {
        foreach ($request->applications as $i => $application) {
            $p = ApplicationCategory::find($application['id']);
            $p->update([
                'order' => $i
            ]);
        }
        return response()->json($request->applications);
    }

    public function destroy($id)
    {
        $aplication = Aplication::findOrFail($id);
        $aplication->applicationCategories()->sync([]);
        $aplication->finisheds()->sync([]);

        if (Storage::exists($aplication->primary_image)) {
            Storage::delete($aplication->primary_image);
        }
        if (Storage::exists($aplication->list_image)) {
            Storage::delete($aplication->list_image);
        }

        $aplication->delete();

        return response()->json("ok");
    }


    public function toggleActive($id)
    {
        $category = Aplication::findOrFail($id);
        $category->update([
            "active" => !$category->active
        ]);

        return response()->json(["active" => $category->active]);
    }

    public function changeOrder(Request $request, $id)
    {
        $request->validate([
            "order" => "required|numeric",
        ]);
        $category = Aplication::findOrFail($id);
        $category->update([
            "order" => $request->order,
        ]);
        return response()->json(["order" => $category->order]);
    }
}
