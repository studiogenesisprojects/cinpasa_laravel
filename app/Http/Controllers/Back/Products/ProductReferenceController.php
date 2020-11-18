<?php

namespace App\Http\Controllers\Back\Products;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ProductReference;

class ProductReferenceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
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
        ProductReference::create([
            "referencia" => $request->name,
            "diametro" => $request->reference
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
        $reference = ProductReference::findOrFail($id);
        $reference->update([
            "referencia" => $request->name,
            "diametro" => $request->reference
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

        $reference = ProductReference::findOrFail($id);

        $reference->delete();

        return response()->json("OK");
    }
}