<?php

namespace App\Http\Controllers\Back\Products;

use App\Exports\GuideRequestSheet;
use App\Http\Controllers\Controller;
use App\Models\GuideRequest;
use App\Models\Section;
use Maatwebsite\Excel\Facades\Excel;

class GuideRequestController extends Controller
{
    public $section;

    public function __construct()
    {
        $this->section = Section::find(config('app.enabled_sections.productos'));
    }
    
    public function index()
    {
        $this->authorize('read', $this->section);
        $guideRequests = GuideRequest::with('product')->orderBy('created_at', 'DESC')->get();
        return view('back.guide-request.index', ['guideRequests' => $guideRequests]);
    }

    
    public function downloadExcel()
    {
        return Excel::download(new GuideRequestSheet, 'guide-request.xls');

    }

    
}
