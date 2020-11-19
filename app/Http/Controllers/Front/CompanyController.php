<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Carousel;
use Illuminate\Http\Request;

class CompanyController extends Controller
{
    public function index()
    {
        $carousel = Carousel::where('section_id', 16)->where('active', 1)->where('main', 1)->first();

        $carousel_history = Carousel::where('section_id', 16)->where('active', 1)->get();
        $carousel_history = $carousel_history[1];

        return view('front.business.index', compact('carousel', 'carousel_history'));
    }
}
