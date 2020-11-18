<?php

namespace App\Http\View\Composers;

use Illuminate\View\View;
use App\Models\ProductCategory;
use App\Models\Product;
use App\Models\Material;
use App\Models\Aplication;
use App\Models\Finished;
use App\Models\MaterialCategory;
use App\Models\ProductBraided;
use App\Models\ProductColorShade;
use App\Models\ProductForm;
use Illuminate\Support\Facades\DB;

class SearcherComposer
{

    protected $product;


    public function __construct(Product $product)
    {

        $this->product = $product;
    }

    public function compose(View $view)
    {
        $view->with([

            'materials' => MaterialCategory::where('active', true)->orderBy('order')->get(),
            'shades' => ProductColorShade::orderBy('searcher_order')->get(),
            'categories' => ProductCategory::where('active', true)->where('sup_product_category', '!=', null)->orderBy('searcher_order')->get(),
            'braids' => ProductBraided::orderBy('searcher_order')->get(),
            'forms' => ProductForm::orderBy('searcher_order')->get(),

            'applications' => Aplication::with('languages')->get()->sortBy('name'),
            'endings' => Finished::where('active', true)->orderBy('order')->get(),
            'references' => DB::table('products_references')->select('diametro')->where('diametro', '!=', '')->distinct('diametro')->get()->sort(function ($a, $b) {
                return (float) $a->diametro > (float) $b->diametro;
            })
        ]);
    }
}
