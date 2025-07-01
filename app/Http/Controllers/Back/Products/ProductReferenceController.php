<?php

namespace App\Http\Controllers\Back\Products;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ProductReference;
use App\Models\Section;

class ProductReferenceController extends Controller
{
    public $section;

    public function __construct()
    {
        $this->section = Section::find(config('app.enabled_sections.productos'));
    }

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->authorize('read', $this->section);
        $references = ProductReference::cursor();
        return  view('back.products.references.index', compact('references'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $this->authorize('write', $this->section);
        return  view('back.products.references.create');
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
        ProductReference::create([
            "referencia" => $request->name,
            "diametro" => $request->reference,
            "bolsas" => $request->bags,
            "rapport" => $request->rapport,
            "cordones" => $request->cordons
        ]);

        return redirect()->route('referencias.index');
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
        $reference = ProductReference::find($id);

        return view('back.products.references.edit', compact('reference'));
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
        $reference = ProductReference::findOrFail($id);
        $reference->update([
            "referencia" => $request->name,
            "diametro" => $request->reference,
            "bolsas" => $request->bags,
            "rapport" => $request->rapport,
            "cordones" => $request->cordons
        ]);

        return redirect()->route('referencias.index');
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
        $reference = ProductReference::findOrFail($id);

        $reference->delete();

        return response()->json("OK");
    }
}
