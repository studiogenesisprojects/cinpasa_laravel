<?php

namespace App\Http\Controllers\Back\Finished;

use App\Http\Controllers\Controller;
use App\Models\FinishedColor;
use App\Models\Language;
use Illuminate\Http\Request;

class FinishedColorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $colors = FinishedColor::all();
        return view('back.finisheds.colors.index', compact('colors'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $languages = Language::all();
        return view('back.finisheds.colors.create', compact('languages'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([]);

        $color = FinishedColor::create();

        foreach ($request->languages as $index => $language) {
            $color->languages()->create([
                "language_id" => $language['language_id'],
                "name" => $request->colores[$index]['name']
            ]);
        }

        return redirect()->route('colores-acabados.index')->with('success', "Color creado correctamente");
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $color = FinishedColor::findOrFail($id);
        $languages = Language::all();
        return view('back.finisheds.colors.edit', compact('color', 'languages'));
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
        $color = FinishedColor::findOrFail($id);
        foreach ($request->languages as $index => $language) {
            $color->lang((int) $language['language_id'])->update([
                "name" => $request->colores[$index]['name']
            ]);
        }

        return redirect()->route('colores-acabados.index')->with('success', "Color actualizado correctamente");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $p = FinishedColor::findOrFail($id);
        $p->delete();
        return response()->json("OK");
    }
}