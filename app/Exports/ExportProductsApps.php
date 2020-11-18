<?php

namespace App\Exports;

use App\Models\Aplication;
use App\Models\ProductApplication;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\WithMultipleSheets;

class ExportProductsApps implements WithMultipleSheets
{
    use Exportable;

    public function sheets(): array
    {
        $sheets = [];

        foreach (Aplication::whereHas('products')->get() as $index => $aplication) {
            $sheets[$index] = new ProductAppSheet($aplication);
        }

        return $sheets;
    }
}
