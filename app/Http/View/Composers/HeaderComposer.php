<?php

namespace App\Http\View\Composers;

use Illuminate\View\View;
use App\Models\ProductCategory;
use App\Localization\laravellocalization\src\Mcamara\LaravelLocalization\Facades\LaravelLocalization;
use Illuminate\Support\Str;

class HeaderComposer
{

    protected $categories;

    public function __construct(ProductCategory $categories)
    {
        $this->categories = $categories;
    }

    public function compose(View $view)
    {
        $view->with([
            "fathers" => $this->categories->where('sup_product_category', null)->get(),
            "currentUrl" => LaravelLocalization::getLocalizedURL('es'),
            "favorites" =>
            collect(session()->all())->filter(function ($e, $key) {
                return Str::contains($key, 'product-');
            })->map(function ($e, $key) {
                return \str_replace('product-', '', $key);
            })
        ]);
    }
}
