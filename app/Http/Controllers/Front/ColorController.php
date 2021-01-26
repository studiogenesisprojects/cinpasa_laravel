<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Carousel;
use App\Models\Product;
use App\Models\ProductCategory;
use App\Models\ProductColor;
use Illuminate\Http\Request;
use App\Models\ProductColorCategory;
use App\Models\ProductColorCategoryLang;

class ColorController extends Controller
{

    public function index()
    {
        $colorCategories = ProductColorCategory::where('active', 1)->orderBy('order')->get();

        $carousel = Carousel::where('section_id', 17)->where('active', 1)->where('main', 1)->first();

        return view('front.colors.index', compact('colorCategories', 'carousel'));
    }

    public function show(ProductColorCategory $productCategoryColor)
    {

        $productColorCategories = ProductColorCategory::where('active', 1)->orderBy('order')->get();
        return view('front.colors.show', compact('productCategoryColor', 'productColorCategories'));
    }

    public function getProductColor(Request $request)
    {
        $category = ProductCategory::find($request->id);
        $colors = [];

        foreach($category->products as $product) {
            foreach($product->colors as $color){
                if(!in_array($color->name, $colors)){
                    $colors[$color->id] = $color->name;
                }
            }
        }

        return $colors;
    }

    public function ajaxColor($colorID, $productColorCategoryId)
    {
        $category = ProductColorCategory::find($productColorCategoryId);
        $color = ProductColor::findOrFail($colorID);
        $products = Product::where('active', 1)->orderBy('order', 'asc')->whereHas('colorCategories', function ($q) use ($colorID, $productColorCategoryId) {
            $q->where('product_color_categories.id', $productColorCategoryId)
                ->whereHas('colors', function ($q2) use ($colorID) {
                    $q2->where('product_colors.id', $colorID);
                });
        })->take(4)->get();

        if ($products->count() < 4) {
            $productToAdd = Product::where('active', 1)->orderBy('order', 'asc')->whereHas('colorCategories', function ($q) use ($colorID) {
                $q->whereHas('colors', function ($q2) use ($colorID) {
                    $q2->where('product_colors.id', $colorID);
                });
            })->take(10)->get();

            $products = $products->merge($productToAdd);
        }

        $products = $products->map(function ($m) {
            return  $m->load('primaryImage')->only(['id', 'name', 'slug', "primaryImage", "class"]);
        })->toArray();

        return response()->json([
            "description" => $category->getDescriptionAttribute(),
            "color" => $color,
            "products" => array_values($products),
        ], 200);
    }
}
