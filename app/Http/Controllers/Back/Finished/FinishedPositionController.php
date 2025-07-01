<?php

namespace App\Http\Controllers\Back\Finished;

use App\Http\Controllers\Controller;
use App\Models\FinishedPosition;
use App\Models\FinishedPositionLang;
use App\Models\Language;
use App\Models\Section;
use Illuminate\Http\Request;

class FinishedPositionController extends Controller
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
        $positions = FinishedPosition::all();
        return view('back.finisheds.positions.index', compact('positions'));
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
        return view('back.finisheds.positions.create', compact('languages'));
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

        $position = FinishedPosition::create();

        foreach ($request->languages as $index => $language) {
            $position->languages()->create([
                "language_id" => $language['language_id'],
                "name" => $request->posiciones[$index]['name']
            ]);
        }

        return redirect()->route('posiciones.index')->with('success', "Posición creada correctamente");
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
        $finishedPosition = FinishedPosition::findOrFail($id);
        $languages = Language::all();
        return view('back.finisheds.positions.edit', compact('finishedPosition', 'languages'));
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
        $position = FinishedPosition::findOrFail($id);
        foreach ($request->languages as $index => $language) {
            $position->lang((int) $language['language_id'])->update([
                "name" => $request->posiciones[$index]['name']
            ]);
        }

        return redirect()->route('posiciones.index')->with('success', "Posición actualizada correctamente");
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
        $p = FinishedPosition::findOrFail($id);
        $p->delete();
        return response()->json("OK");
    }
}