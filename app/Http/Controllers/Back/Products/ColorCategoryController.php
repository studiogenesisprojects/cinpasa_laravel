<?php

namespace App\Http\Controllers\Back\Products;

use App\Http\Controllers\Controller;
use App\Models\ProductColor;
use App\Models\ProductColorCategory;
use Illuminate\Http\Request;

class ColorCategoryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $categories = ProductColorCategory::cursor();
        return view('back.products.categoryColors.index', compact('categories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $colors = ProductColor::where('active', 1)->get();

        return view('back.products.categoryColors.create', compact('colors'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $productColorCategory = ProductColorCategory::create([
            "active" => $request->active ?? 0,
        ]);

        // $productColorCategory = ProductColorCategory::create($request->toArray());
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

        return redirect()->route('categorias-colores.index')->with('success', 'Muestrario creado correctamente!');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $colorCategory = ProductColorCategory::findOrFail($id);
        $colors = ProductColor::where('active', 1)->get();

        return view('back.products.categoryColors.edit', compact('colorCategory', 'colors'));
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
        $colorCategory = ProductColorCategory::findOrFail($id);

        $colorCategory->update($request->toArray());

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
        return redirect()->route('categorias-colores.index')->with('success', 'Muestrario actualizado correctamente');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $productColor = ProductColorCategory::findOrFail($id);
        $productColor->delete();
        return response()->json("Muestrario borrado correctamente");
    }
}
