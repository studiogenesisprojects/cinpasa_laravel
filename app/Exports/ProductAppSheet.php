<?php

namespace App\Exports;

use App\Models\Aplication;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithTitle;

class ProductAppSheet implements FromCollection, WithTitle, WithHeadings, ShouldAutoSize
{

    private $app;

    public function __construct(Aplication $app)
    {
        $this->app = $app;
    }

    public function collection()
    {
        return $this->app->products()->where('active', 1)->orderBy('order', 'ASC')->get()->map(function ($product) {
            return [
                $product->order,
                $product->name,
            ];
        });
    }

    public function title(): string
    {
        $title = $this->clean($this->app->name);
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
        $string = substr($string, 0, 30);
        return preg_replace('/[^A-Za-z0-9\-]/', '', $string); // Removes special chars.
    }
}
