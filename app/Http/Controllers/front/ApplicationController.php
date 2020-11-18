<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Aplication;
use App\Models\AplicationLang;
use App\Models\ApplicationCategory;
use App\Models\ApplicationCategoryLang;
use App\Models\Carousel;
use App\Models\Product;
use Illuminate\Support\Str;

class ApplicationController extends Controller
{
    //
    public function index()
    {
        $carousel = Carousel::where('section_id', 7)->where('active', 1)->where('main', 1)->first();

        //en el index mostramos aplicaciones padres
        $applicationCategories = ApplicationCategory::where('active', true)->orderBy('order')->get();
        return view('front.applications.index', compact(['applicationCategories', 'carousel']));
    }

    public function show(ApplicationCategory $applicationCategory)
    {
        $applications = $applicationCategory->aplications()->where('active', true)->whereHas('languages', function ($q) {
            $q->where('active', true)->where('language_id', Aplication::getLangIndex(app()->getLocale()));
        })->orderBy('order')->get();
        return view('front.applications.show', compact('applicationCategory', 'applications'));
    }

    public function _show(ApplicationCategory $applicationCategory, Aplication $aplication)
    {
        $products = Product::whereHas('applications', function ($q) use ($aplication) {
            $q->where('aplications.id', $aplication->id);
        })->where('active', true)->whereHas('languages', function ($q) {
            $q->where("language_id", Product::getLangIndex(app()->getLocale()))->where('active', true);
        })->orderBy('order')->get();
        return view('front.applications._show', compact('aplication', 'applicationCategory', 'products'));
    }
}
