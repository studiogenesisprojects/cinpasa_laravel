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
        $idHomeApps = [47734, 47748, 47753, 47747, 47737, 25338, 47736];

        $homeApps = ProductCategory::whereIn('id', $idHomeApps)->with('getLang')->get();

        $homeApps[] = ApplicationCategory::with('getLang')->find(25339);

        $labs = Lab::all();

        $carousel = Carousel::with(['slides' => function ($q) {
            $q->orderBy('order', 'asc');
        }])->where('section_id', 2)->where('active', 1)->where('main', 1)->first();

        $featuredNews = NewsFeatured::all();

        return view('front.home.index', compact('applicationCategories', 'featuredNews', 'carousel', "homeApps", 'labs'));
    }
}
