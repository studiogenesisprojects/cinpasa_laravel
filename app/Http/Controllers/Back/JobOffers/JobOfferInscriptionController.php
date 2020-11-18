<?php

namespace App\Http\Controllers\Back\JobOffers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\JobOfferInscription;
use App\Models\JobOfferLang;
use App\Models\JobOfferResume;
use Illuminate\Support\Facades\Storage;

class JobOfferInscriptionController extends Controller
{

    public function __construct()
    {
        $this->authorizeResource(JobOfferInscription::class, 'id');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */

    public function index()
    {
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
        $jobInscription = JobOfferInscription::findOrFail($id);
        $jobInscription->delete();

        return back()->with('succes', 'La enscripción ha sido eliminada correctamente');
    }
}
