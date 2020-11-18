<?php

namespace App\Exports;


use App\Models\ProductCategory;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithTitle;

class ProductCategorySheet implements FromCollection, WithTitle, WithHeadings, ShouldAutoSize
{

    private $productCategory;

    public function __construct(ProductCategory $productCategory)
    {
        $this->productCategory = $productCategory;
    }

    public function collection()
    {
        return $this->productCategory->products()->where('active', 1)->orderBy('order', 'ASC')->get()->map(function ($product) {
            return [
                $product->order,
                $product->name,
            ];
        });
    }

    public function title(): string
    {
        $title = $this->clean($this->productCategory->name);
        return $title;
    }

    public function headings(): array
    {
        return  [
            "Orden",
            "Producto"
        ];
    }

    function clean($string)
    {
        $string = str_replace(' ', '-', $string); // Replaces all spaces with hyphens.

        return preg_replace('/[^A-Za-z0-9\-]/', '', $string); // Removes special chars.
    }
}
