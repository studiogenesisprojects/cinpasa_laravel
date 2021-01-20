<?php

namespace App\Http\Controllers\Back\Aplication;

use App\Http\Controllers\Controller;
use App\Models\ApplicationCategory;
use App\Models\ApplicationCategoryLang;
use App\Models\Language;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ApplicationCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $applicationCategories = ApplicationCategory::orderBy('order')->get();
        return view('back.aplication.categories.index', compact('applicationCategories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $languages = Language::all();

        return view('back.aplication.categories.create', compact('languages'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $applicationCategory = ApplicationCategory::create([]);

        foreach ($request->applications as $application) {
            !$application['name'] ?: $applicationCategory->languages()->create($application);
        }

        if ($request->hasFile('image')) {
            $path = $request->file('image')->storeAs('public/applications', str_replace(" ","-",$request->file('image')->getClientOriginalName()));
            $applicationCategory->update(['image' => $path]);
        }

        if ($request->hasFile('list_image')) {
            $path = $request->file('list_image')->storeAs('public/applications', str_replace(" ","-",$request->file('list_image')->getClientOriginalName()));
            $applicationCategory->update(['list_image' => $path]);
        }

        return redirect()->route('categorias-aplicaciones.index')->with('success', "Aplicación creada correctamente");
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $applicationCategory = ApplicationCategory::findOrFail($id);
        $languages = Language::all();

        return view('back.aplication.categories.edit', compact('applicationCategory', 'languages'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $applicationCategory = ApplicationCategory::find($id);

        foreach ($request->applications as $language) {
            $lang = $applicationCategory->lang((int) $language['language_id']);
            if ($lang) {
                $lang->update($language);
            } else {
                $applicationCategory->languages()->create($language);
            }
        }

        if ($request->hasFile('image')) {
            $path = $request->file('image')->storeAs('public/applications', str_replace(" ","-",$request->file('image')->getClientOriginalName()));
            $applicationCategory->update(['image' => $path]);
        }

        if ($request->hasFile('list_image')) {
            $path = $request->file('list_image')->storeAs('public/applications', str_replace(" ","-",$request->file('list_image')->getClientOriginalName()));
            $applicationCategory->update(['list_image' => $path]);
        }

        return redirect()->route('categorias-aplicaciones.index')->with('success', "Categoría actualizada correctamente");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $applicationCategory = ApplicationCategory::findOrFail($id);

        $applicationCategory->aplications()->detach();
        ApplicationCategoryLang::where('application_category_id', $applicationCategory->id)->delete();

        Storage::delete($applicationCategory->image);
        Storage::delete($applicationCategory->list_image);

        $applicationCategory->delete();
        return response()->json('ok');
    }

    public function toggleActive($id)
    {
        $category = ApplicationCategory::findOrFail($id);
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
        $category = ApplicationCategory::findOrFail($id);
        $category->update([
            "order" => $request->order,
        ]);
        return response()->json(["order" => $category->order]);
    }
}
