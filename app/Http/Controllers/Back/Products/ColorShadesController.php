<?php

namespace App\Http\Controllers\Back\Products;

use App\Http\Controllers\Controller;
use App\Models\ProductColor;
use App\Models\ProductColorShade;
use Illuminate\Http\Request;

class ColorShadesController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $shades = ProductColorShade::cursor();
        return view('back.products.colorsShades.index', compact('shades'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $colors = ProductColor::all();
        return view('back.products.colorsShades.create', compact('colors'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $productColorCategory = ProductColorShade::create([
            "active" => $request->active ?? 0,
        ]);

        foreach ($request->colorLanguages as $language) {
            $productColorCategory->languages()->create($language);
        }

        $data = [];
        $i = 0;
        foreach ($request->colors as $color) {
            $data[$color] = ["order" => $i];
            $i++;
        }

        $productColorCategory->colors()->sync($data);

        return redirect()->route('tonalidades-colores.index')->with('success', 'Tonalidad creada correctamente!');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $colors = ProductColor::all();

        $shade = ProductColorShade::findOrFail($id);

        return view('back.products.colorsShades.edit', ["shade" => $shade, "colors" => $colors]);
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
        $colorCategory = ProductColorShade::findOrFail($id);

        $colorCategory->update($request->all());

        foreach ($request->colorLanguages as $language) {
            if ($colorCategory->lang((int) $language['language_id']) === null) {
                $colorCategory->languages()->create($language);
            } else {
                $colorCategory->lang((int) $language['language_id'])->update($language);
            }
        }

        $data = [];
        $i = 0;
        foreach ($request->colors as $color) {
            $data[$color] = ["order" => $i];
            $i++;
        }

        $colorCategory->colors()->sync($data);

        return redirect()->route('tonalidades-colores.index')->with('success', 'Tonalidad actualizada correctamente');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $productColor = ProductColorShade::findOrFail($id);
        $productColor->delete();
        return response()->json("Tonalidad borrada correctamente");
    }
}
