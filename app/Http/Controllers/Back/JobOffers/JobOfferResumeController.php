<?php

namespace App\Http\Controllers\Back\JobOffers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\JobOffer;
use App\Models\JobOfferInscription;
use App\Models\JobOfferResume;
use Illuminate\Support\Facades\Storage;

class JobOfferResumeController extends Controller
{

    public function __construct()
    {
        // TODO arreglar permisos
        // $this->authorizeResource(JobOfferInscription::class, 'id');
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('back.job_offers.resumes.index', ['resumes' => JobOfferResume::all()]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('back.job_offers.resumes.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
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
        $jobResume = JobOfferResume::findOrFail($id);
        return view('back.job_offers.resumes.edit', ['resume' => $jobResume]);
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
        $request->validate([
            "created_at" => "date",
            "name" => "required|string"
        ]);

        $jobResume = JobOfferResume::findOrFail($id);
        $jobResume->update($request->toArray());

        return redirect()->route('cvs.index')->with('success', 'CV actualizado correctamente');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $jobResume = JobOfferResume::findOrFail($id);

        $file = Storage::url($jobResume->path);

        if (\File::exists($file)) {
            \File::delete($file);
        }

        $jobResume->delete();

        return redirect()->route('cvs.index')->with('success', 'CV eleminado correctamente');
    }
}