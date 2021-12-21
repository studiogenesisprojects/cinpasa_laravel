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
        $no_contact = false;

        return view('front.contact.index', compact('carousel', 'no_contact'));
    }

    public function stored()
    {
        return view('front.contact.stored');
    }
}
