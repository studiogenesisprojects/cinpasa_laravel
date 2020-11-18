<?php

namespace App\Http\Controllers;

use App\ApplicationHome;
use App\Models\Aplication;
use App\Models\ApplicationCategory;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ApplicationHomeController extends Controller
{


    public function sync(Request $request)
    {
        try {
            DB::beginTransaction();
            ApplicationHome::truncate();
            foreach ($request->applications as $key => $aplication) {

                if (isset($aplication["aplication_id"])) {
                    $aplication_id = $aplication["aplication_id"];
                } else {
                    $aplication_id = $aplication["id"];
                }
                ApplicationHome::create([
                    "order" => $key + 1,
                    "aplication_id" => $aplication_id,
                    "aplication_type" => $aplication["aplication_type"]
                ]);
            }
            DB::commit();
        } catch (Exception $e) {
            DB::rollback();
            return response()->json("error", 500);
        }
    }
}
