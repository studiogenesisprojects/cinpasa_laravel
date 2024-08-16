<?php

namespace App\Http\Controllers\Front;

use App\ApplicationHome;
use App\Http\Controllers\Controller;
use App\Models\ApplicationCategory;
use App\Models\Carousel;
use App\Models\Customer;
use App\Models\Lab;
use App\Models\Material;
use App\Models\Noticia;
use App\Models\NoticiaPrincipal;
use App\Models\ProductCaracteristics;
use App\Models\ProductCategory;
use App\Models\ProductColor;
use App\NewsFeatured;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $applicationCategories = ApplicationCategory::orderBy('order')->take(6)->get();

        $homeApps = [];

        $homeApps[] = ProductCategory::where('id',47734)->with('getLang')->first();
        $homeApps[] = ProductCategory::where('id',47735)->with('getLang')->first();
        $homeApps[] = ProductCategory::where('id',47744)->with('getLang')->first();
        $homeApps[] = ProductCategory::where('id',47736)->with('getLang')->first();
        $homeApps[] = ProductCategory::where('id',47755)->with('getLang')->first();
        $homeApps[] = ProductCategory::where('id',47753)->with('getLang')->first();
        $homeApps[] = ProductCategory::where('id',25338)->with('getLang')->first();
        $homeApps[] = ProductCategory::where('id',47741)->with('getLang')->first();

        $labs = Lab::all();

        $carousel = Carousel::with(['slides' => function ($q) {
            $q->orderBy('order', 'asc');
        }])->where('section_id', 2)->where('active', 1)->where('main', 1)->first();

        $featuredNews = NewsFeatured::all();

        return view('front.home.index', compact('applicationCategories', 'featuredNews', 'carousel', "homeApps", 'labs'));
    }
}
