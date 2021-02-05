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
use App\Models\ProductCaracteristics;
use App\Models\ProductColor;
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
        $bags = ProductCaracteristics::whereNotNull('bags')->orderBy('bags', 'ASC')->get()->pluck('bags')->unique();
        $bags = $bags->sortBy(function($item){
            return $item;
        });

        $rapports = ProductCaracteristics::whereNotNull('rapport')->orderBy('rapport', 'ASC')->get()->pluck('rapport')->unique();
        $rapports = $rapports->sortByDesc(function($item){
            return $item;
        });

        $laces = ProductCaracteristics::whereNotNull('laces')->orderBy('laces', 'ASC')->get()->pluck('laces')->unique();
        $laces = $laces->sortByDesc(function($item){
            return $item;
        });

        $colors = [];
        $colors[] = ProductColor::find(22652);
        $colors[] = ProductColor::find(22694);
        $colors[] = ProductColor::find(22677);
        foreach(ProductColor::where('active', 1)->whereNotIn('id', $colors)->get() as $color){
            $colors[] = $color;
        }

        $view->with([
            'colors' => $colors,
            'rapports' => array_reverse($rapports->toArray()),
            'laces' => array_reverse($laces->toArray()),
            'materials' => Material::where('active', true)->orderBy('order')->get(),
            'categories' => ProductCategory::where('active', true)->where('sup_product_category', '!=', null)->orderBy('searcher_order')->get(),
            'anchos' => ProductCaracteristics::whereNotNull('width')->orderBy('width', 'ASC')->get()->pluck('width')->unique(),
            'bags' => $bags,
            ]);
    }
}
