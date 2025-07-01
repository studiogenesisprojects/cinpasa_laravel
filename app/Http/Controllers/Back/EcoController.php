<?php

namespace App\Http\Controllers\Back;

use App\Helpers\FileHelper;
use App\Http\Controllers\Controller;
use App\Models\EcoFriend;
use App\Models\Language;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Models\Section;

class EcoController extends Controller
{   
    public $section;
    private $fileHelper;

    public function __construct()
    {
        $this->section = Section::find(config('app.enabled_sections.productos'));
        $this->fileHelper = new FileHelper('image', 'public/' . config('app.path_uploads.eco'));
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->authorize('read', $this->section);
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
        $this->authorize('write', $this->section);
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
        $this->authorize('write', $this->section);
        $logo = EcoFriend::create();

        if ($request->hasFile('image')) {
            $this->fileHelper->saveFile($request->file('image'), $logo);
        }

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
        $this->authorize('write', $this->section);
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
        $this->authorize('write', $this->section);
        $eco = EcoFriend::find($id);

        if ($request->hasFile('image')) {

            $this->fileHelper->saveFile($request->file('image'), $eco);
        }

        foreach ($request->languages as $language) {
            $eco->lang((int) $language["language_id"])->update($language);
        }

        return redirect()->route('eco.index')->with('success', 'Logo actualizado correctamente');
    }


    public function deleteImage($id)
    {
        $this->authorize('write', $this->section);
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
        $this->authorize('delete', $this->section);
        $eco = EcoFriend::find($id);

        if (Storage::exists($eco->section_image)) {
            Storage::delete($eco->section_image);
        }

        $eco->delete();

        return redirect()->route('eco.index')->with('success', 'Logo eliminado correctamente');
    }
}
