<?php

namespace App\Http\Controllers\Back\Petitions;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Petition;
use App\Models\ProductPetition;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\ContactsExport;
use App\Http\Requests\RecapchaValidateRequest;
use App\Models\Section;

class PetitionController extends Controller
{
    public $section;

    public function __construct()
    {
        $this->section = Section::find(config('app.enabled_sections.peticiones'));
    }

    public function excel()
    {
        $petitions = Petition::select('id', 'created_at', 'updated_at', 'origen', 'fullname', 'company', 'email', 'phone_number', 'country', 'comment')->get();

        return Excel::download(new ContactsExport($petitions), 'peticiones_de_contacto.xlsx');
    }

    public function index()
    {
        $this->authorize('read', $this->section);
        $petitions = Petition::all();
        return view('back.petitions.index', ['petitions' => $petitions]);
    }

    public function show($id)
    {   
        $this->authorize('read', $this->section);
        $petition = Petition::findOrFail($id);
        return view('back.petitions.show', ['petition' => $petition]);
    }

    public function destroy($id)
    {
        $this->authorize('delete', $this->section);
        $p = Petition::findOrFail($id);
        $p->petitionProducts()->delete();
        $p->delete();

        return response()->json('ok');
    }
}
