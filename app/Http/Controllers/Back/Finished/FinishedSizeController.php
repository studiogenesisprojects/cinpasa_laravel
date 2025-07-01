<?php

namespace App\Http\Controllers\Back\Finished;

use App\Http\Controllers\Controller;
use App\Models\FinishedSize;
use App\Models\Language;
use App\Models\Section;
use Illuminate\Http\Request;

class FinishedSizeController extends Controller
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
        $sizes = FinishedSize::all();
        return view('back.finisheds.sizes.index', compact('sizes'));
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
        return view('back.finisheds.sizes.create', compact('languages'));
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

        $size = FinishedSize::create();

        foreach ($request->languages as $index => $language) {
            $size->languages()->create([
                "language_id" => $language['language_id'],
                "name" => $request->tamanos[$index]['name']
            ]);
        }

        return redirect()->route('tamanos.index')->with('success', "Tamaño creado correctamente");
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $this->authorize('write', $this->section);
        $size = FinishedSize::findOrFail($id);
        $languages = Language::all();
        return view('back.finisheds.sizes.edit', compact('size', 'languages'));
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
        $this->authorize('write', $this->section);
        $size = FinishedSize::findOrFail($id);
        foreach ($request->languages as $index => $language) {
            $size->lang((int) $language['language_id'])->update([
                "name" => $request->tamanos[$index]['name']
            ]);
        }

        return redirect()->route('tamanos.index')->with('success', "Tamaño actualizado correctamente");
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
        $p = FinishedSize::findOrFail($id);
        $p->delete();
        return response()->json("OK");
    }
}