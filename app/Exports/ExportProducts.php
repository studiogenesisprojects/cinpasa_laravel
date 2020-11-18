<?php

namespace App\Exports;

use App\Models\ProductCategory;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\WithMultipleSheets;

class ExportProducts implements WithMultipleSheets
{
    use Exportable;

    public function sheets(): array
    {
        $sheets = [];

        foreach (ProductCategory::where('sup_product_category', '!=', null)->get() as $index => $productCategory) {
            $sheets[$index] = new ProductCategorySheet($productCategory);
        }

        return $sheets;
    }
}
