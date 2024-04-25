<?php

namespace App\Exports;

use App\Models\GuideRequest;
use Maatwebsite\Excel\Concerns\FromQuery;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;

class GuideRequestSheet implements 
    FromQuery,
    WithMapping,
    WithHeadings, 
    ShouldAutoSize
{

    public function query()
    {
        $guideRequests = GuideRequest::with(['product']);

        return $guideRequests;
    }

    public function map($guideRequest): array
    {
        return [
            $guideRequest->product->name,
            $guideRequest->email,
            $guideRequest->created_at,
        ];
    }

    public function headings(): array
    {
        return  [
            "Producto",
            "Correo solicitante",
            "Fecha de solicitud"
        ];
    }

}
