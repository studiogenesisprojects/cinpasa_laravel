<?php

namespace App\Http\Controllers\Back\Petitions;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Petition;
use App\Models\ProductPetition;
use Maatwebsite\Excel\Facades\Excel;
use App\Exports\ContactsExport;
use App\Http\Requests\RecapchaValidateRequest;

class PetitionController extends Controller
{
    public function __construct()
    {
        // TODO: arreglar permisos
        // $this->authorizeResource(Petition::class, 'id');
    }

    public function excel()
    {
        $petitions = Petition::select('id', 'created_at', 'updated_at', 'origen', 'fullname', 'company', 'email', 'phone_number', 'country', 'comment')->get();

        return Excel::download(new ContactsExport($petitions), 'peticiones_de_contacto.xlsx');
    }

    public function index()
    {
        $petitions = Petition::all();
        return view('back.petitions.index', ['petitions' => $petitions]);
    }

    public function show($id)
    {
        $petition = Petition::findOrFail($id);
        return view('back.petitions.show', ['petition' => $petition]);
    }

    public function destroy($id)
    {
        $p = Petition::findOrFail($id);
        $p->petitionProducts()->delete();
        $p->delete();

        return response()->json('ok');
    }
}
