<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Http\Requests\WorkWithUsRequest;
use App\Models\Carousel;
use App\Models\JobOffer;
use App\Models\JobOfferInscription;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Str;
use App\Localization\laravellocalization\src\Mcamara\LaravelLocalization\Facades\LaravelLocalization;

class WorkWithUsController extends Controller
{
    public function getBrowser($user_agent)
    {
        if (strpos($user_agent, 'MSIE') !== FALSE)
            return 'Internet explorer';
        elseif (strpos($user_agent, 'Edge') !== FALSE) //Microsoft Edge
            return 'Microsoft Edge';
        elseif (strpos($user_agent, 'Trident') !== FALSE) //IE 11
            return 'Internet explorer';
        elseif (strpos($user_agent, 'Opera Mini') !== FALSE)
            return 'Opera Mini';
        elseif (strpos($user_agent, 'Opera') || strpos($user_agent, 'OPR') !== FALSE)
            return 'Opera';
        elseif (strpos($user_agent, 'Firefox') !== FALSE)
            return 'Mozilla Firefox';
        elseif (strpos($user_agent, 'Chrome') !== FALSE)
            return 'Google Chrome';
        elseif (strpos($user_agent, 'Safari') !== FALSE)
            return 'Safari';
        else
            return 'No hemos podido detectar su navegador';
    }

    public function index()
    {
        $no_contact = 1;
        $offers = JobOffer::all();
        $carousel = Carousel::find(25);
        return view('front.work-with-us.index', compact('offers', 'carousel', 'no_contact'));
    }

    public function store(WorkWithUsRequest $request)
    {
        $user_agent = $_SERVER['HTTP_USER_AGENT'];
        $offer = JobOffer::find($request->offerId);
        $inscription = JobOfferInscription::create([
            'name' => $request->name . " " . $request->surname,
            'email' => $request->email,
            'phone_number' => $request->tel,
            'browser' => $this->getBrowser($user_agent),
            'ip' => $request->ip(),
            'job_offer_id' => $offer->id ?? NULL
        ]);

        if ($offer) {
            $cvPath = $request->file('file')->storeAs('curriculums/' . Str::slug($offer->name), 'curriculum_' . $request->name . '_' . $request->surname . '.pdf');
        } else {
            $cvPath = $request->file('file')->storeAs('curriculums/sin-oferta', 'curriculum_' . $request->name . '_' . $request->surname);
        }
        $inscription->job_offer_resume()->create([
            'name' => $request->name . " " . $request->surname,
            'path' => $cvPath ?? null,
        ]);

        $request->session()->flash('inscription', $inscription);
        $request->session()->flash('filename', $request->file('file')->getClientOriginalName());
        return redirect()->back()->with('message', 'CV recibido correctamente!');
    }

    public function show(JobOffer $jobOffer)
    {

        return view('front.work-with-us.show', ['offer' => $jobOffer, 'no_contact' => $no_contact]);
    }

    public function stored()
    {
        return view('front.work-with-us.stored');
    }
}
