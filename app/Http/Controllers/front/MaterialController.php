<?php

namespace App\Http\Controllers\Front;

use App\Models\Carousel;
use App\Models\Material;
use App\Models\MaterialCategory;
use App\Models\MaterialLang;
use App\Models\Product;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Str;

class MaterialController extends Model
{
    /**
     * Todos los materiales
     */
    public function index()
    {
        $carousel = Carousel::where('section_id', 9)->where('active', 1)->where('main', 1)->first();
        $categories = MaterialCategory::where('active', true)->orderBy('order', 'ASC')->get();
        return view('front.materials.index', compact('categories', 'carousel'));
    }

    public function fetch($locale)
    {
        App::setLocale($locale);
        $materials = Material::where('active', true)->where('sup_material', '!=', null)->whereHas('products')->orderBy('order', "ASC")->get();

        $categories = MaterialCategory::whereHas('materials', function ($q) {
            $q->whereHas('products');
        })->where('active', true)->orderBy('order', 'ASC')->get();
        $materials = $categories->reduce(function ($acc, $curr) {
            $acc = $acc->merge($curr->materials()->whereHas('products')->get());
            return $acc;
        }, collect());

        return response()->json($materials);
    }

    /**
     * Mostrar pantalla de un producto en concreto
     */
    public function show(Material $material)
    {
        $categories = MaterialCategory::whereHas('materials', function ($q) {
            $q->whereHas('products');
        })->where('active', true)->get();
        $products = Product::whereHas('materials', function ($q) use ($material) {
            $q->where('materials.id', $material->id);
        })->orderBy('order')->where('active', 1)->get();
        return view('front.materials.show', compact('material', 'products', 'categories'));
    }

    public function lazy($id, $locale)
    {
        App::setLocale($locale);
        $products = Product::with('ecoLogos')->whereHas('materials', function ($q) use ($id) {
            $q->where('materials.id', $id);
        })->where('active', true)->orderBy('order', 'ASC');
        return response()->json($products->paginate(6));
    }
}
