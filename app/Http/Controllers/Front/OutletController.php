<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Banner;
use App\Models\Carousel;
use App\Models\FeaturedProduct;
use App\Models\Product;
use App\Models\ProductCaracteristics;
use App\Models\ProductCategory;
use Illuminate\Http\Request;

class OutletController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        /*$featureds = FeaturedProduct::all();
        $idHigher = $featureds->pluck('product_id');
        $bottomOnes = ProductCategory::whereHas('products', function($q) use($idHigher) {
            $q->where('active', 1)->where('outlet', 1)->whereNotIn('products.id', $idHigher);
        })->orderBy('order', 'desc')->get();

        $products_sorted = [];*/

        $categoriesOutlet = ProductCategory::whereHas('products', function($q) {
            $q->where('active', 1)->where('outlet', 1);
        })->orderBy('order', 'desc')->get();


        foreach($categoriesOutlet as $category){
            $products = $category->outlet_products->where('active', 1)->where('outlet', 1)->sortBy('order');
            $products_sorted[] = $products;
        }

        $categoriesOutlet = $products_sorted;

        $carousel = Carousel::find(26);
        $banners = Banner::where('active', 1)->orderBy('order')->get();

        return view('front.outlet.index', compact('categoriesOutlet','carousel', 'banners'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        if($product->active == 0){
            abort(404);
        }
        $finishedColumns = [];
        $finisheds = $product->finisheds;
        $finisheds = $finisheds->sortBy('order');
        foreach ($finisheds as $index => $f) {
            $finishedColumns[$index / 7][] = $f;
        }

        $colorCategories = $product->colorCategories->filter(function ($value, $key) {
            return $value->active == 1;
        });

        $applicationCategories = $product->applications->groupBy(function ($item, $k) {
            return $item->applicationCategories->first()->name ?? "";
        });

        $product_caracteristics = ProductCaracteristics::where('product_id', $product->id)->whereNotNull('discount')->orderBy('discount', 'desc')->orderBy('order')->get();

        $references = $product_caracteristics->pluck('references');
        $width = $product_caracteristics->pluck('width');
        $bags = $product_caracteristics->pluck('bags');
        $laces = $product_caracteristics->pluck('laces');
        $rapport = $product_caracteristics->pluck('rapport');
        $diameter = $product_caracteristics->pluck('diameter');
        $length = $product_caracteristics->pluck('length');
        $width_diameter = $product_caracteristics->pluck('width_diameter');
        $observations = $product_caracteristics->pluck('observations');

        $relateds = $product->relateds();
        $more_info_trigger = 1;

        return view('front.outlet.show', compact('relateds',
         'product_caracteristics',
         'references', 'width', 'bags', 'laces', 'rapport', 'diameter', 'length', 'width_diameter', 'observations',
         'product', 'finishedColumns',
           'colorCategories',
           'applicationCategories', 'more_info_trigger'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
