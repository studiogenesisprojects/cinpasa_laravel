<?php

namespace App\Http\Controllers;

use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Foundation\Bus\DispatchesJobs;
use Illuminate\Foundation\Validation\ValidatesRequests;
use Illuminate\Routing\Controller as BaseController;
use Illuminate\Support\Facades\Log;
use App\Models\Section;

class Controller extends BaseController
{
    use AuthorizesRequests, DispatchesJobs, ValidatesRequests;

    public function authorize($permission, Section $section)
    {   
        switch ($permission) {
            case 'read':
                if (!auth()->user()->role->canRead($section)) {
                    abort(403);
                }
                break;
            case 'write':
                if (!auth()->user()->role->canWrite($section)) {
                    abort(403);
                }
                break;
            case 'delete':
                if (!auth()->user()->role->canDelete($section)) {
                    abort(403);
                }
                break;
            default:
                Log::error('Permission not found: ' . $permission);
                abort(500);
                break;
        }
    }

    public function hasPermission($permission, $section)
    {
        $section = Section::findOrFail(config('app.enabled_sections.' . $section));
        
        switch ($permission) {
            case 'read':
                return auth()->user()->role->canRead($section);
            case 'write':
                return auth()->user()->role->canWrite($section);
            case 'delete':
                return auth()->user()->role->canDelete($section);
            default:
                Log::error('Permission not found: ' . $permission);
                return response()->json(["message" => "Permission not found"], 500); 
        }
    }
}
