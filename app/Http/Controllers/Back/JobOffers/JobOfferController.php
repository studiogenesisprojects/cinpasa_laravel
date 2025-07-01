<?php

namespace App\Http\Controllers\Back\JobOffers;

use Illuminate\Http\Request;
use App\Models\JobOffer;
use App\Models\JobOfferInscription;
use App\Models\JobOfferResume;

use App\Http\Controllers\Controller;
use App\Models\Language;
use App\Models\Section;

class JobOfferController extends Controller
{
    public $section;
    public function __construct()
    {
        $this->section = Section::find(config('app.enabled_sections.solicitudes'));
    }

    public function index()
    {
        $this->authorize('read', $this->section);
        $offers = JobOffer::all();
        return view('back.job_offers.index', ['offers' => $offers]);
    }

    public function edit($id)
    {
        $this->authorize('write', $this->section);
        $languages = Language::all();
        $jobOffer = JobOffer::findOrFail($id);
        return view('back.job_offers.edit', ['offer' => $jobOffer, 'languages' => $languages]);
    }

    public function update(Request $request, $id)
    {
        $this->authorize('write', $this->section);

        $jobOffer = JobOffer::findOrFail($id);

        //creamos la oferta de trabajo
        $jobOffer->update([
            "publication_date" => $request->publication_date,
            "end_date" => $request->end_date
        ]);
        foreach ($request->jobOfferLangs as $language) {
            $lang = $jobOffer->lang((int) $language['language_id']);

            if ($language["name"]) {
                if ($lang) {
                    $lang->update($language);
                } else {
                    $jobOffer->languages()->create($language);
                }
            }
        }

        return redirect()->route('ofertas-trabajo.index')->with('success', 'La oferta de trabajo ha sido actualizada correctamente');
    }

    public function create(Request $request)
    {
        $this->authorize('write', $this->section);
        $languages = Language::all();

        return view('back.job_offers.create', ['languages' => $languages]);
    }

    public function  store(Request $request)
    {
        $this->authorize('write', $this->section);
        //creamos la oferta de trabajo
        $jobOffer = JobOffer::create([
            "publication_date" => $request->publication_date,
            "end_date" => $request->end_date
        ]);

        foreach ($request->jobOfferLangs as $language) {
            !$language["name"] ?:   $jobOffer->job_offer_langs()->create($language);
        }

        return redirect()->route('ofertas-trabajo.index')->with('success', 'Oferta de trabajo creada correctamente!');
    }

    public function destroy(Request $request, $id)
    {
        $this->authorize('delete', $this->section);
        $jobOffer = JobOffer::findOrFail($id);
        $jobOffer->delete();

        return back()->with('success', 'Oferta de trabajo eliminada correctamente!');
    }
}
