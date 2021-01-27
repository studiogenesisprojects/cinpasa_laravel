<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Carousel;
use App\Models\Material;
use Illuminate\Http\Request;
use App\Localization\laravellocalization\src\Mcamara\LaravelLocalization\Facades\LaravelLocalization;

class EcologyController extends Controller
{
    public function index()
    {
        $carousel = Carousel::with(['slides' => function ($q) {
            $q->orderBy('order', 'asc');
        }])->where('section_id', 20)->where('active', 1)->where('main', 1)->first();

        $fscMaterial = Material::find(23620);

        return view('front.static.ecology', compact('carousel', 'fscMaterial'));
    }

    public function getPageUrl($locale)
    {
        return LaravelLocalization::getURLFromRouteNameTranslated($locale, 'routes.ecology.index');
    }
}
