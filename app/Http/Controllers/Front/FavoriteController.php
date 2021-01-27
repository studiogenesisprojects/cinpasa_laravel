<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Petition;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\ProductCategory;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Str;
use App\Localization\laravellocalization\src\Mcamara\LaravelLocalization\Facades\LaravelLocalization;

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

        $products = new Collection;
        $categories = new Collection;
        $text = strtoupper(__('Menu.products'));

        foreach($ps as $item){
            $product = Product::find($item);

            if(!$product){
                $category = ProductCategory::find($item);
                $categories->push($category);
                $text = $text . '\n' . $category->name . ':';
            } else {
                $products->push($product);
                $text = $text . '\n' . $product->name . ':';
            }
        }

        $favorite_info = true;

        return view('front.favorites.index', compact('products', 'text','categories', 'favorite_info'));
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

        $product = Product::find($request->value);

        if(!$product){
            $product = ProductCategory::find($request->value);
            $link = LaravelLocalization::getURLFromRouteNameTranslated(App::getLocale(), 'routes.products.show', ["productCategory" => $product]);
        } else {
            $link = LaravelLocalization::getURLFromRouteNameTranslated(App::getLocale(), 'routes.products.showProduct', [
                "productCategory" => $product->categories[0],
                "product" => $product
                ]);
        }

        $ps = collect($request->session()->all())->filter(function ($e, $key) {
                return Str::contains($key, 'product-');
            })->map(function ($e, $key) {
                return \str_replace('product-', '', $key);
            });

        return response()->json([
            "count" => $ps->count(),
            "action" =>  $request->session()->exists('product-' . $request->value) ? "0" : "1",
            "product" => $product,
            "link" => $link
        ]);
    }

    public function getProducts(Request $request) {
        $values = str_replace("&quot;",'"',$request->values);
        $array = [];

        foreach(json_decode($values) as $id){
            $product = Product::find($id);

            if(!$product){
                $product = ProductCategory::find($id);
                $link = LaravelLocalization::getURLFromRouteNameTranslated(App::getLocale(), 'routes.products.show', ["productCategory" => $product]);
                $image =  $product->image;
            } else {
                $link = LaravelLocalization::getURLFromRouteNameTranslated(App::getLocale(), 'routes.products.showProduct', [
                    "productCategory" => $product->categories[0],
                    "product" => $product
                    ]);
                $image = $product->getPrimaryImageUrlAttribute();
            }

            $array[] = array_merge($product->toArray(), ['link' => $link, 'image_' => $image]);
        }

        return $array;
    }
}
