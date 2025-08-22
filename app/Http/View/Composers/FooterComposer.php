<?php

namespace App\Http\View\Composers;

use App\Models\Aplication;
use App\Models\ApplicationCategory;
use App\Models\Product;
use Illuminate\View\View;
use App\Models\ProductCategory;
use Illuminate\Support\Facades\Cache;

class FooterComposer
{
    public function compose(View $view)
    {
        $footers = Cache::rememberForever('footers', function() {
            $footersArray = [];
            $footersArray[] = ProductCategory::find(47734);
            $footersArray[] = ProductCategory::find(47735);
            $footersArray[] = ProductCategory::find(47744);
            $footersArray[] = ProductCategory::find(47736);
            $footersArray[] = ProductCategory::find(47755);
            $footersArray[] = ProductCategory::find(47753);
            $footersArray[] = ProductCategory::find(25338);
            $footersArray[] = ProductCategory::find(47741);

            return $footersArray;
        });

        $view->with([
            "footers" => $footers,
        ]);
    }
}
