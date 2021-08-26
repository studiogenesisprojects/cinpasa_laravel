<?php

namespace App\Http\Controllers\Back\Products;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\ProductCategoryRequest;
use App\Models\ProductCategory;
use App\Models\ProductCategoryLang;
use Illuminate\Support\Facades\Storage;

class CategoryController extends Controller
{
    public function index()
    {
        $categories = ProductCategory::orderBy('searcher_order', 'ASC')->get();
        return view('back.products.categories.index', compact('categories'));
    }

    public function create()
    {
        $categories = ProductCategory::where('sup_product_category', null)->get();
        return view('back.products.categories.create', compact('categories'));
    }

    public function edit($id)
    {
        $category = ProductCategory::findOrFail($id);
        $categories = ProductCategory::where('sup_product_category', null)->get();
        return view('back.products.categories.edit', compact('categories', 'category'));
    }

    public function createFather()
    {
        $categories = ProductCategory::where('sup_product_category', null)->get();
        return view('back.products.categories.create-father', compact('categories'));
    }

    public function editFather($id)
    {
        $category = ProductCategory::findOrFail($id);
        $categories = ProductCategory::where('sup_product_category', null)->get();
        return view('back.products.categories.edit-father', compact('categories', 'category'));
    }

    public function store(Request $request)
    {
        $productCategory = ProductCategory::create($request->toArray());
        foreach ($request->productCategoryLanguages as $language) {
            $productCategory->languages()->create($language);
        }

        if ($request->hasFile('image')) {
            $path = $request->file('image')->storeAs('public/productos/categorias', $request->file('image')->getClientOriginalName());
            $productCategory->update(['image' => $path,]);
        }
        return redirect()->route('categorias.index')->with('success', 'Categoría creada correctamente');
    }

    public function update(Request $request, $id)
    {
        $category = ProductCategory::findOrFail($id);
        $category->update($request->toArray());

        if($category->sup_product_category == null){
            if($request->active){
                $category->active = 0;
                foreach($category->childrens as $children) {
                    $children->active = 0;
                    $children->save();
                }
            } else {
                $category->active = 1;
            }

            $category->save();
        }

        foreach ($request->productCategoryLanguages as $language) {
            if ($category->lang((int) $language['language_id'])) {
                $category->lang((int) $language['language_id'])->update($language);
            } else {
                $category->languages()->create($language);
            }
        }

        if(isset($request->alt_text_image)) {
            foreach($request->alt_text_image as $key => $image_text) {
                foreach($image_text as $text) {
                    if($category->lang((int) $text['language_id'])) {
                        $category->lang((int) $text['language_id'])->update(['alt_text_image_' . ($key + 1) => $text['alt_text']]);
                    } else {
                        $category->languages()->create(['alt_text_image_' . ($key + 1) => $text['alt_text']]);
                    }
                }
            }
        }

        if ($request->hasFile('image')) {

            if (Storage::exists($category->image)) {
                Storage::delete($category->image);
            }

            $path = $request->file('image')->storeAs('public/productos/categorias', $request->file('image')->getClientOriginalName());
            $category->update(['image' => $path,]);
        }

        for($i = 1; $i < 4; $i++) {
            if ($request->hasFile('image_low_' . $i)) {


                if (Storage::exists($category->image)) {
                    Storage::delete($category->image);
                }

                $path = $request->file('image_low_' . $i)->storeAs('public/productos/categorias', $request->file('image_low_' . $i)->getClientOriginalName());
                $category->update(['image_low_' . $i => $path,]);
            }
        }

        return redirect()->route('categorias.index')->with('success', 'Categoría actualizada correctamente');
    }

    public function destroy($id)
    {
        $category = ProductCategory::findOrFail($id);
        $category->delete();

        return response()->json("ok");
    }

    public function toggleActive($id)
    {
        $category = ProductCategory::findOrFail($id);
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
        $category = ProductCategory::findOrFail($id);
        $category->update([
            "order" => $request->order,
        ]);
        return response()->json(["order" => $category->order]);
    }
}
