<?php

namespace App\Http\Controllers\Back;

use App\Http\Controllers\Controller;
use App\Models\EcoFriend;
use App\Models\Language;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class EcoController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $ecos = EcoFriend::cursor();
        return view('back.products.eco.index', compact('ecos'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $languages = Language::all();
        return view('back.products.eco.create', compact('languages'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        if ($request->hasFile('image')) {
            $path = Storage::putFile('eco-logos', $request->image);
        } else {
            $path = null;
        }

        $logo = EcoFriend::create([
            "image" => $path
        ]);
        foreach ($request->languages as $language) {
            $logo->languages()->create($language);
        }

        return redirect()->route('eco.index')->with('success', 'Logo creado correctamente');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $eco = EcoFriend::find($id);
        $languages = Language::all();
        return view('back.products.eco.edit', compact('eco', 'languages'));
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
        $eco = EcoFriend::find($id);

        if ($request->hasFile('image')) {

            $path = Storage::putFile('eco-logos', $request->image);

            if (Storage::exists($eco->section_image)) {
                Storage::delete($eco->section_image);
            }

            $eco->update([
                "image" => $path
            ]);
        }



        foreach ($request->languages as $language) {
            $eco->lang((int) $language["language_id"])->update($language);
        }

        return redirect()->route('eco.index')->with('success', 'Logo actualizado correctamente');
    }


    public function deleteImage($id)
    {
        $eco = EcoFriend::find($id);

        $eco->update([
            "section_image" => null
        ]);
        if (Storage::exists($eco->section_image)) {
            Storage::delete($eco->section_image);
        }


        return response()->json("ok");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $eco = EcoFriend::find($id);

        if (Storage::exists($eco->section_image)) {
            Storage::delete($eco->section_image);
        }

        $eco->delete();

        return redirect()->route('eco.index')->with('success', 'Logo eliminado correctamente');
    }
}
