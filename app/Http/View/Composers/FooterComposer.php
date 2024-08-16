<?php

namespace App\Http\View\Composers;

use App\Models\Aplication;
use App\Models\ApplicationCategory;
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
        $footers = [];
        $footers[] = ProductCategory::find(47734);
        $footers[] = ProductCategory::find(47735);
        $footers[] = ProductCategory::find(47744);
        $footers[] = ProductCategory::find(47736);
        $footers[] = ProductCategory::find(47755);
        $footers[] = ProductCategory::find(47753);
        $footers[] = ProductCategory::find(25338);
        $footers[] = ProductCategory::find(47741);

        $view->with([
            "footers" => $footers,
        ]);
    }
}
