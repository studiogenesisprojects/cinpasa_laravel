<?php

namespace App\Http\View\Composers;

use App\Models\Aplication;
use App\Models\Product;
use Illuminate\View\View;
use App\Models\ProductCategory;

class FooterComposer
{

    protected $categories;

    public function __construct(ProductCategory $categories)
    {
        $this->categories = $categories;
    }

    public function compose(View $view)
    {
        $view->with([
            "productCategories" => ProductCategory::where('active', true)->where('sup_product_category', null)->get()->take(5),
            "aplications" => Aplication::orderBy('order')->get()->take(5)
        ]);
    }
}
