<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Product;
use Illuminate\Http\Request;

class FavoritesController extends Controller
{
    public function getFavorites(Request $request){
        $json = '';
        if($request->values != null){
            foreach($request->values as $id){
                $product = Product::find($id);
                $json = $json . json_encode($product);
            }

            return $json;
        } else {
            return 1;
        }
    }
}
