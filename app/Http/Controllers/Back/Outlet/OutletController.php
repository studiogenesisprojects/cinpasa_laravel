<?php

namespace App\Http\Controllers\Back\Outlet;

use App\Http\Controllers\Controller;
use App\Models\Banner;
use App\Models\FeaturedProduct;
use App\Models\Product;
use Illuminate\Http\Request;
use Str;

class OutletController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $banners = Banner::all();
        $products = Product::where('active', 1)->where('outlet', 1)
                        ->whereHas('caracteristics',function($q) {
                            $q->whereNotNull('discount');
                        })->get();
        $featured = FeaturedProduct::all();
        return view('back.outlet.index', compact('banners', 'products', 'featured'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('back.outlet.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $banner = new Banner;
        $banner->name = $request->name;
        $banner->active = isset($request->active);

        if ($request->hasFile('image')) {
            $path = $request->file('image')->storeAs('public/banners', Str::slug($request->name).'.'.$request->file('image')->extension() );
            $banner->image = $path;
        }

        $banner->save();

        return redirect()->route('outlet.index')->with('message', 'Banner creat correctament!');
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $banner = Banner::find($id);
        return view('back.outlet.edit', compact('banner'));
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
        $banner = Banner::find($id);
        $banner->name = $request->name;
        $banner->active = isset($request->active);

        if ($request->hasFile('image')) {
            $path = $request->file('image')->storeAs('public/banners', Str::slug($request->name).'.'.$request->file('image')->extension() );
            $banner->image = $path;
        }

        $banner->save();
        return redirect()->route('outlet.index')->with('message', 'Banner modificat correctament!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $banner = Banner::find($id);
        $banner->delete();
        return redirect()->route('outlet.index')->with('message', 'Banner borrat correctament!');
    }

    public function featuredProducts(Request $request){
        FeaturedProduct::whereNotNull('id')->delete();

        foreach($request->productos_destacados as $featured) {
            if($featured){
                $product = new FeaturedProduct;
                $product->product_id = $featured;
                $product->save();
            }
        }

        return redirect()->route('outlet.index')->with('message', 'Productos destacados cambiados correctamente.');
    }
}
