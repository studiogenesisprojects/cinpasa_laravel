<?php

namespace App\Http\Controllers\Back\Lab;

use App\Http\Controllers\Controller;
use App\Models\Lab;
use Illuminate\Http\Request;

class LabController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $labCategories = Lab::orderBy('order')->get();
        return view('back.lab.index', compact('labCategories'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('back.lab.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $newLab = new Lab;

        $newLab->name = $request->name;
        $newLab->order = $request->order;
        $newLab->active = isset($request->active);
        $newLab->description = $request->description;

        if ($request->hasFile('primary_image')) {
            $path = $request->file('primary_image')->storeAs('labs', $request->file('primary_image')->getClientOriginalName());
            $newLab->image = $path;
        } else {
            $newLab->image = 'no image';
        }

        if ($request->hasFile('secondary_image')) {
            $path = $request->file('secondary_image')->storeAs('labs', $request->file('secondary_image')->getClientOriginalName());
            $newLab->secondary_image = $path;
        }

        $newLab->save();

        return  redirect()->route('lab')->with('message', 'LAB creat correctament!');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Lab  $lab
     * @return \Illuminate\Http\Response
     */
    public function show(Lab $lab)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Lab  $lab
     * @return \Illuminate\Http\Response
     */
    public function edit(Lab $lab)
    {
        return view('back.lab.edit', compact('lab'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Lab  $lab
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request)
    {
        $lab = Lab::find($request->id);

        $lab->name = $request->name;
        $lab->order = $request->order;
        $lab->active = isset($request->active);
        $lab->description = $request->description;

        if ($request->hasFile('primary_image')) {
            $path = $request->file('primary_image')->storeAs('labs', $request->file('primary_image')->getClientOriginalName());
            $lab->image = $path;
        }

        if ($request->hasFile('secondary_image')) {
            $path = $request->file('secondary_image')->storeAs('labs', $request->file('secondary_image')->getClientOriginalName());
            $lab->secondary_image = $path;
        }

        $lab->save();

        return  redirect()->route('lab')->with('message', 'LAB modificat correctament!');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Lab  $lab
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $lab = Lab::find($id);
        $lab->delete();

        return  redirect()->route('lab')->with('message', 'LAB esborrat correctament!');
    }
}
