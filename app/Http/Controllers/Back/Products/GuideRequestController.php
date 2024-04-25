<?php

namespace App\Http\Controllers\Back\Products;

use App\Exports\GuideRequestSheet;
use App\Http\Controllers\Controller;
use App\Models\GuideRequest;
use Maatwebsite\Excel\Facades\Excel;

class GuideRequestController extends Controller
{

    public function index()
    {
        $guideRequests = GuideRequest::with('product')->orderBy('created_at', 'DESC')->get();
        return view('back.guide-request.index', ['guideRequests' => $guideRequests]);
    }

    
    public function downloadExcel()
    {
        return Excel::download(new GuideRequestSheet, 'guide-request.xls');

    }

    
}
