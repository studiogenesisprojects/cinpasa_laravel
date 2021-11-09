<?php

namespace App\Http\Controllers\Back\Outlet;

use App\Http\Controllers\Back\Products\ProductController;
use App\Models\ProductColorCategory;
use App\Models\Finished;
use App\Models\Product;
use App\Models\Aplication;
use App\Models\ProductCategory;
use App\Models\ProductLabel;
use App\Models\EcoFriend;
use App\Models\ProductType;
use App\Models\ProductForm;
use App\Models\ProductBraided;
use App\Models\Material;
use App\Models\ProductReference;
use App\Models\Lab;
use App\Models\Language;

class ProductOutletController extends ProductController {

    public function create()
    {
        ini_set('memory_limit', '-1');
        $colors = ProductColorCategory::where('active', 1)->get();
        $finishes = Finished::all();
        $applications = Aplication::all();
        $related = Product::all();
        $categories = ProductCategory::where('sup_product_category', '!=', null)->get();
        $tags = ProductLabel::all();
        $ecos = EcoFriend::all();

        //características
        $types = ProductType::where('active', true)->get();
        $shapes = ProductForm::all();
        $braids = ProductBraided::all();
        $materials = Material::all();
        $references = ProductReference::all();
        $labs = Lab::all();

        return view('back.products.create', [
            "categories" => $categories,
            "colors" => $colors,
            "applications" => $applications,
            "relateds" => $related,
            "tags" => $tags,
            "ecos" => $ecos,
            "finishes" => $finishes,
            //features
            "types" => $types,
            "shapes" => $shapes,
            "braids" => $braids,
            "materials" => $materials,
            "references" => $references,
            'languages' => Language::all(),
            'labs' => $labs,
            'outlet' => true,
        ]);
    }
}
