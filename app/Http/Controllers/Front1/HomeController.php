<?php

namespace App\Http\Controllers\Front;

use App\ApplicationHome;
use App\Http\Controllers\Controller;
use App\Models\ApplicationCategory;
use App\Models\Carousel;
use App\Models\Customer;
use App\Models\Noticia;
use App\Models\NoticiaPrincipal;
use App\NewsFeatured;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public function index()
    {
        $applicationCategories = ApplicationCategory::orderBy('order')->take(6)->get();
        $homeApps = ApplicationHome::orderBy('order')->take(8)->get();

        $customers = Customer::all();

        $carousel = Carousel::with(['slides' => function ($q) {
            $q->orderBy('order', 'asc');
        }])->where('section_id', 2)->where('active', 1)->where('main', 1)->first();

        $featuredNews = NewsFeatured::all();

        return view('front.home.index', compact('applicationCategories', 'featuredNews', 'carousel', 'customers', "homeApps"));
    }
}
