<?php

namespace App\Http\Controllers\Front;

use App\ApplicationHome;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Aplication;
use App\Models\AplicationLang;
use App\Models\ApplicationCategory;
use App\Models\ApplicationCategoryLang;
use App\Models\Carousel;
use App\Models\Material;
use App\Models\Product;
use App\Models\ProductCaracteristics;
use App\Models\ProductCategory;
use App\Models\ProductColor;
use Illuminate\Support\Str;

class ApplicationController extends Controller
{
    //
    public function index()
    {
        $carousel = Carousel::where('section_id', 7)->where('active', 1)->where('main', 1)->first();
        $categories = ProductCategory::where('active', 1)->whereNotNull('sup_product_category')->get();
        $materials = Material::where('active', 1)->get();
        $colors = ProductColor::where('active', 1)->get();
        $rapports = ProductCaracteristics::whereNotNull('rapport')->get()->pluck('rapport')->unique();
        //en el index mostramos aplicaciones padres
        $applicationCategories = ApplicationHome::orderBy('order')->get();

        return view('front.applications.index', compact(['categories', 'materials', 'colors','rapports','applicationCategories', 'carousel']));
    }

    public function show(ApplicationCategory $applicationCategory)
    {
        $carousel = null;
        switch ($applicationCategory->id) {
            case 25337:
                $carousel = Carousel::find(12);
                break;
            case 25338:
                $carousel = Carousel::find(14);
                break;
            case 25339:
                $carousel = Carousel::find(13);
                break;
            case 25340:
                $carousel = Carousel::find(15);
                break;
            case 25341:
                $carousel = Carousel::find(16);
                break;
        }

        $categories = ProductCategory::where('active', 1)->whereNotNull('sup_product_category')->get();
        $materials = Material::where('active', 1)->get();
        $colors = ProductColor::where('active', 1)->get();
        $rapports = ProductCaracteristics::whereNotNull('rapport')->get()->pluck('rapport')->unique();

        $applications = $applicationCategory->aplications()->where('active', true)->orderBy('order')->get();
        return view('front.applications.show', compact('categories', 'materials', 'colors','rapports','applicationCategory', 'applications', 'carousel'));
    }

    public function _show(ApplicationCategory $applicationCategory, Aplication $aplication)
    {
        $categories = ProductCategory::where('active', 1)->whereNotNull('sup_product_category')->get();
        $materials = Material::where('active', 1)->get();
        $colors = ProductColor::where('active', 1)->get();
        $rapports = ProductCaracteristics::whereNotNull('rapport')->get()->pluck('rapport')->unique();

        $products = Product::whereHas('applications', function ($q) use ($aplication) {
            $q->where('aplications.id', $aplication->id);
        })->where('active', true)->whereHas('languages', function ($q) {
            $q->where("language_id", Product::getLangIndex(app()->getLocale()))->where('active', true);
        })->orderBy('order')->get();
        return view('front.applications._show', compact('categories', 'materials', 'colors','rapports','aplication', 'applicationCategory', 'products'));
    }
}
