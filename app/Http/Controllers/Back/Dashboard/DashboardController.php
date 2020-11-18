<?php

namespace App\Http\Controllers\Back\Dashboard;

use App\Http\Controllers\Controller;
use App\Models\JobOfferInscription;
use App\Models\JobOfferResume;
use App\Models\Petition;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class DashboardController extends Controller
{
    public function index()
    {
        $petitions = Petition::all();
        $currculumVitaes = JobOfferResume::all();
        // dd($currculumVitaes);
        $inscriptions = JobOfferInscription::where('job_offer_id', '<>', 'null')->get();

        return view('back.dashboard.index', compact('petitions', 'currculumVitaes', 'inscriptions'));
    }

    public function downloadcv($id)
    {
        $pathtoFile = JobOfferResume::where('id', $id)->first();
        $extension = explode(".", $pathtoFile->path);
        $extension = $extension[count($extension) - 1];
        return Storage::download($pathtoFile->path, $pathtoFile->name . '.' . $extension);
    }
}