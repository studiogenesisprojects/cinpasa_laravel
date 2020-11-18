<?php

namespace App\Http\Controllers\Back\Products;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\ProductsColorsRequest;
use App\Models\Material;
use App\Models\ProductColor;
use App\Models\ProductColorCategory;
use App\Models\ProductColorShade;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;

class ColorController extends Controller
{
    public function index()
    {
        $colors = ProductColor::all();
        return view('back.products.colors.index', compact('colors'));
    }


    public function create()
    {
        $materials = Material::all();
        $shades = ProductColorShade::all();
        $categories = ProductColorCategory::where('active', 1)->get();

        return view('back.products.colors.create', compact('materials', 'categories'));
    }

    public function edit($id)
    {
        $materials = Material::all();
        $shades = ProductColorShade::all();
        $categories = ProductColorCategory::where('active', 1)->get();
        $productColor = ProductColor::findOrFail($id);
        return view('back.products.colors.edit', compact('materials', 'productColor', 'categories', 'shades'));
    }

    public function store(Request $request)
    {
        $productColor = ProductColor::create($request->toArray());
        $productColor->update(['active' => $request->active ? true : false]);

        foreach ($request->colorLanguages as $language) {
            $productColor->languages()->create($language);
        }

        $productColor->materials()->sync($request->materials);
        $productColor->categories()->sync($request->categories);
        $productColor->shades()->sync($request->shades);

        return redirect()->route('colores.index')->with('success', 'Color creado correctamente');
    }

    public function update(Request $request, $id)
    {
        $productColor = ProductColor::findOrFail($id);
        $productColor->update($request->toArray());
        $productColor->update(['active' => $request->active ? true : false]);
        $productColor->materials()->sync($request->materials);
        $productColor->categories()->sync($request->categories);
        $productColor->shades()->sync($request->shades);

        foreach ($request->colorLanguages as $language) {
            $productColor->lang((int) $language['language_id'])->update($language);
        }

        return redirect()->route('colores.index')->with('success', 'Color actualizado correctamente');
    }


    public function destroy($id)
    {
        $productColor = ProductColor::findOrFail($id);
        $productColor->delete();
        return response()->json("Color borrado correctamente");
    }
}
