<?php

namespace App\Exports;

use App\Models\Petition;
use Maatwebsite\Excel\Concerns\FromCollection;

class ContactsExport implements FromCollection
{
    /**
     * @return \Illuminate\Support\Collection
     */

    public function __construct($petitions = null)
    {
        $this->petitions = $petitions;
    }

    public function collection()
    {

        return $this->petitions ?: Petition::all();
    }
}