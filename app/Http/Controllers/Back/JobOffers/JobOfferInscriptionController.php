<?php

namespace App\Http\Controllers\Back\JobOffers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\JobOfferInscription;
use App\Models\JobOfferLang;
use App\Models\JobOfferResume;
use App\Models\Section;
use Illuminate\Support\Facades\Storage;

class JobOfferInscriptionController extends Controller
{

    public $section;
    public function __construct()
    {
        $this->section = Section::find(config('app.enabled_sections.solicitudes'));
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index()
    {
        $this->authorize('read', $this->section);
        return view('back.job_offers.inscriptions.index', ['inscriptions' => JobOfferInscription::all()]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store()
    {
        # code...
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $this->authorize('write', $this->section);
        $jobInscription = JobOfferInscription::findOrFail($id);
        return view('back.job_offers.inscriptions.edit', ['inscription' => $jobInscription]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $this->authorize('write', $this->section);
        $jobInscription = JobOfferInscription::findOrFail($id);
        $jobInscription->update($request->toArray());
        return redirect()->route('inscritos.index')->with('success', 'Inscripción actualizada correctamente');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $this->authorize('delete', $this->section);
        $jobInscription = JobOfferInscription::findOrFail($id);
        $jobInscription->delete();

        return back()->with('succes', 'La enscripción ha sido eliminada correctamente');
    }
}
