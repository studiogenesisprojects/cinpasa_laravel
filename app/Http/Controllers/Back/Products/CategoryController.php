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
        $categories = ProductCategory::orderBy('order', 'ASC')->get();
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
            $path = $request->file('image')->storeAs('productos/categorias', $request->file('image')->getClientOriginalName());
            $productCategory->update(['image' => $path,]);
        }
        return redirect()->route('categorias.index')->with('success', 'Categoría creada correctamente');
    }

    public function update(Request $request, $id)
    {
        $category = ProductCategory::findOrFail($id);
        $category->update($request->toArray());

        foreach ($request->productCategoryLanguages as $language) {
            if ($category->lang((int) $language['language_id'])) {
                $category->lang((int) $language['language_id'])->update($language);
            } else {
                $category->languages()->create($language);
            }
        }

        if ($request->hasFile('image')) {
            if (Storage::exists($category->image)) {
                Storage::delete($category->image);
            }

            $path = $request->file('image')->storeAs('productos/categorias', $request->file('image')->getClientOriginalName());
            $category->update(['image' => $path,]);
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
