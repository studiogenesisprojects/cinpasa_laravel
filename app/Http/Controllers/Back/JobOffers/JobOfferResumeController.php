<?php

namespace App\Http\Controllers\Back\JobOffers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\JobOffer;
use App\Models\JobOfferInscription;
use App\Models\JobOfferResume;
use App\Models\Section;
use Illuminate\Support\Facades\Storage;

class JobOfferResumeController extends Controller
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
        return view('back.job_offers.resumes.index', ['resumes' => JobOfferResume::all()]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $this->authorize('write', $this->section);
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
        $this->authorize('write', $this->section);
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
        $this->authorize('write', $this->section);
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
        $this->authorize('delete', $this->section);
        $jobResume = JobOfferResume::findOrFail($id);

        $file = Storage::url($jobResume->path);

        if (\File::exists($file)) {
            \File::delete($file);
        }

        $jobResume->delete();

        return redirect()->route('cvs.index')->with('success', 'CV eleminado correctamente');
    }
}