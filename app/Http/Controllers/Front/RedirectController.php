<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\AplicationLang;
use App\Models\ProductCategoryLang;
use App\Models\Product;
use App\Models\ProductLang;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use App\Localization\laravellocalization\src\Mcamara\LaravelLocalization\Facades\LaravelLocalization;

class RedirectController extends Controller
{

    public function index()
    {
        $url = LaravelLocalization::getURLFromRouteNameTranslated(app()->getLocale(), 'routes.products.index');
        return redirect($url, 302);
    }

    public function show($slug)
    {
        $l = ProductLang::where('slug', 'like', '%' . $slug . '%')->firstOrFail();

        $url = LaravelLocalization::getURLFromRouteNameTranslated(
            App::getLocale(),
            'routes.products.showProduct',
            [
                "productCategory" => $l->product->categories->first()->slug ?? "",
                "product" => $l->product
            ]
        );

        return redirect($url, 301);
    }


    public function applications($slug)
    {
        $l = AplicationLang::where('slug', $slug)->first();
        if ($l) {
            $url = LaravelLocalization::getURLFromRouteNameTranslated(
                App::getLocale(),
                'routes.applications._show',
                [
                    "applicationCategory" => $l->application->applicationCategories->first() ?? "",
                    "aplication" => $l->application
                ]
            );
        } else {
            $url = LaravelLocalization::getURLFromRouteNameTranslated(
                App::getLocale(),
                'routes.applications.index'
            );
        }


        return redirect($url, 301);
    }


    public function pCategories($slug)
    {
        $l = ProductCategoryLang::where('slug', 'like', '%' . $slug . '%')->first();
        if ($l) {
            $url = LaravelLocalization::getURLFromRouteNameTranslated(
                App::getLocale(),
                'routes.products.show',
                [
                    "productCategory" => $l->productCategory ?? "",
                ]
            );
        } else {
            $url = LaravelLocalization::getURLFromRouteNameTranslated(
                App::getLocale(),
                'routes.products.index'
            );
        }
        return redirect($url, 301);
    }
}
