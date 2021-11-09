<?php

namespace App\Http\Controllers\Back\Outlet;

use App\Http\Controllers\Controller;
use App\Models\Banner;
use App\Models\FeaturedProduct;
use App\Models\Product;
use Illuminate\Http\Request;
use Str;
use App\Localization\laravellocalization\src\Mcamara\LaravelLocalization\Facades\LaravelLocalization;
use Log;

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
        $products = Product::where('outlet', 1)->get();
        return view('back.outlet.index', compact('banners', 'products'));
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
        $validated = $request->validate([
            'name' => 'required|unique:banners|max:191',
            'order' => 'required',
        ]);

        $banner = new Banner;
        $banner->name = $request->name;
        $banner->active = isset($request->active);
        if(!empty($request->order)){
            $banner->order = $request->order;
        } else {
            $banner->order = Banner::all()->count();
        }

        foreach(LaravelLocalization::getSupportedLocales() as $localeCode => $properties) {
            $banner->setTranslation('url', $localeCode, $request['url-'.$localeCode]);

            if ($request->hasFile('image-'.$localeCode)) {
                $path = $request->file('image-'.$localeCode)->storeAs('public/banners/'.$localeCode, Str::slug($request->name).'.'.$request->file('image-'.$localeCode)->extension() );
                $banner->setTranslation('image', $localeCode, $path);
            }
        }

        $banner->save();

        return redirect()->route('outlet.index')->with('message', '¡Banner creado correctamente!');
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
        $validated = $request->validate([
            'name' => 'required|max:191',
            'order' => 'required',
        ]);

        $banner = Banner::find($id);
        $banner->name = $request->name;
        $banner->active = isset($request->active);

        if(!empty($request->order)){
            $banner->order = $request->order;
        } else {
            $banner->order = Banner::all()->count();
        }
        foreach(LaravelLocalization::getSupportedLocales() as $localeCode => $properties) {
            $banner->setTranslation('url', $localeCode, $request['url-'.$localeCode]);

            if ($request->hasFile('image-'.$localeCode)) {
                $path = $request->file('image-'.$localeCode)->storeAs('public/banners/'.$localeCode, Str::slug($request->name).'.'.$request->file('image-'.$localeCode)->extension() );
                $banner->setTranslation('image', $localeCode, $path);
            }
        }

        $banner->save();
        return redirect()->route('outlet.index')->with('message', '¡Banner modificado correctamente!');
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
        return redirect()->route('outlet.index')->with('message', '¡Banner elimiando correctamente!');
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
