<?php

namespace App\Exports;

use App\Models\Product;
use Illuminate\Contracts\Queue\ShouldQueue;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithTitle;

class ExportProductsDetail implements FromCollection, WithTitle, WithHeadings, ShouldQueue, ShouldAutoSize {

    public function __construct()
    {
    }

    public function collection()
    {
        return Product::with([        
                'labels:id,name',                         
                'ecoLogos' => function($q) {
                    $q->with('languages')->whereHas('languages', function($translation) {
                            $translation->where('language_id', 1);
                    });
                },                             
                'primaryImage' => function($q) {
                    $q->with('languages')->whereHas('languages', function($translation) {
                            $translation->where('language_id', 1);
                    });
                },                             
                'form' => function($q) {
                    $q->with('languages')->whereHas('languages', function($translation) {
                            $translation->where('language_id', 1);
                    });
                },              
                'braided' => function($q) {
                    $q->with('languages')->whereHas('languages', function($translation) {
                            $translation->where('language_id', 1);
                    });
                }, 
                'materials' => function($q) {
                    $q->with('languages')->whereHas('languages', function($translation) {
                            $translation->where('language_id', 1);
                    });
                }, 
                'caracteristics', 
                'categories' => function($q) {
                    $q->with('languages')->whereHas('languages', function($translation) {
                            $translation->where('language_id', 1);
                    });
                }, 
                'categoryColors' => function($q) {
                    $q->with('languages')->whereHas('languages', function($translation) {
                            $translation->where('language_id', 1);
                    });
                }, 
                'finisheds' => function($q) {
                    $q->with('languages')->whereHas('languages', function($translation) {
                            $translation->where('language_id', 1);
                    });
                },
                'applications' => function($q) {
                    $q->with('languages')->whereHas('languages', function($translation) {
                            $translation->where('language_id', 1);
                    });
                },
            ])
            ->orderBy('order', 'ASC')->get()->map(function ($product) {
            return [
                $product->name,
                $product->lite_description,
                strip_tags(html_entity_decode($product->description)),
                (!empty($product->primaryImage))?$product->primaryImage->alt:'',
                ($product->active)?'Sí':'No',
                $product->order,
                $product->labels->count() > 0 ? $product->labels->implode('name', ' / ') : '',
                $product->ecoLogos->count() > 0 ? $product->ecoLogos->implode('name', ' / ') : '',
                $product->form != null ? $product->form->name : '',
                $product->braided != null ? $product->braided->name : '',
                $product->caracteristicsMaterials->count() > 0 ? $product->caracteristicsMaterials->implode('name', ' / ') : '',
                $product->caracteristics->count() > 0 ? $product->caracteristics->implode('references', ' / ') : '',
                $product->categories->count() > 0 ? $product->categories->implode('name', ' / ') : '',
                $product->categoryColors->count() > 0 ? $product->categoryColors->implode('name', ' / ') : '',
                $product->finisheds->count() > 0 ? $product->finisheds->implode('name', ' / ') : '',
                $product->applications->count() > 0 ? $product->applications->implode('name', ' / ') : '',
            ];
        });
    }

    public function title(): string
    {
        $title = "Productos";
        return $title;
    }

    public function headings(): array
    {
        return  [
            "Producto",
            "Descripción corta",
            "Descripción",
            "Etiqueta ALT de la imagen principal",
            "Activo",
            "Orden",
            "Etiquetas",
            "Eco Logos",
            "Forma",
            "Trenzado",
            "Materiales",
            "Referencias",
            "Categorías",
            "Muestrarios",
            "Acabados",
            "Aplicaciones"
        ];
    }
}
