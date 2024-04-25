<?php

namespace App\Exports;

use App\Models\GuideRequest;
use App\Models\ProductCategory;
use Maatwebsite\Excel\Concerns\Exportable;
use Maatwebsite\Excel\Concerns\WithMultipleSheets;
use Log;

class ExportGuideRequests implements WithMultipleSheets
{
    use Exportable;

    public function sheets(): array
    {
        $sheets = [];
        $guideRequests = GuideRequest::all();

        foreach ($guideRequests as $index => $guideRequest) {
            $sheets[$index] = new GuideRequestSheet($guideRequest);
        }

        return $sheets;
    }
}
