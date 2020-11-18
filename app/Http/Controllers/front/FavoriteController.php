<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Petition;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\ProductCategory;
use Illuminate\Support\Str;

class FavoriteController extends Controller
{

    private $ps;

    //
    public function index(Request $request)
    {
        $ps = array_values(
            collect($request->session()->all())->filter(function ($e, $key) {
                return Str::contains($key, 'product-');
            })->map(function ($e, $key) {
                return \str_replace('product-', '', $key);
            })->toArray()
        );
        $products = Product::findMany($ps);
        return view('front.favorites.index', compact('products'));
    }

    public function info(Request $request)
    {
        $ps = array_values(
            collect($request->session()->all())->filter(function ($e, $key) {
                return Str::contains($key, 'product-');
            })->map(function ($e, $key) {
                return \str_replace('product-', '', $key);
            })->toArray()
        );

        $products = Product::findMany($ps);

        return view('front.favorites.info', compact('products'));
    }

    public function stored()
    {
        return view('front.favorites.stored');
    }


    /**
     * Añade el product a la lista de favoritos en
     */
    public function fav(Request $request)
    {
        //comprobamos si el item existe
        if ($request->session()->exists('product-' . $request->value)) {
            //si existe, lo eliminamos
            $request->session()->forget('product-' . $request->value);
        } else {
            //si no existe lo añadimos
            //Guardamos en la lista de favoritos
            $request->session()->put('product-' . $request->value);
        }

        $ps =
            collect($request->session()->all())->filter(function ($e, $key) {
                return Str::contains($key, 'product-');
            })->map(function ($e, $key) {
                return \str_replace('product-', '', $key);
            });

        return response()->json([
            "count" => $ps->count(),
            "action" =>  $request->session()->exists('product-' . $request->value) ? "added" : "removed",
        ]);
    }
}
