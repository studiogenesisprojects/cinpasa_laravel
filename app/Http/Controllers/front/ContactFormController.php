<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Http\Requests\RecapchaValidateRequest;
use App\Models\Carousel;
use App\Models\Petition;
use Illuminate\Http\Request;

class ContactFormController extends Controller
{
    public function index()
    {

        $carousel = Carousel::where('section_id', 18)->where('active', 1)->where('main', 1)->first();

        return view('front.static.contact', compact('carousel'));
    }

    public function stored()
    {
        return view('front.contact.stored');
    }
}
