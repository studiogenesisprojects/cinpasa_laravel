<?php

namespace App\Http\Controllers\Back\Outlet;

use App\Http\Controllers\Controller;
use App\Models\Banner;
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
        $banners = Banner::all();
        return view('back.outlet.index', compact('banners'));
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
            $path = $request->file('image')->storeAs('public/banners', $request->file('image')->getClientOriginalName());
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
            $path = $request->file('image')->storeAs('public/banners', $request->file('image')->getClientOriginalName());
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
}
