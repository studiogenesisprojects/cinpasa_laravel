<?php

namespace App\Http\Controllers;

use App\Writer;
use Illuminate\Http\Request;

class WriterController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return response()->json(Writer::with('languages')->get());
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $data = json_decode($request->writer, true);
        $writer = Writer::create($data);

        if ($request->hasFile('image')) {
            $path =  $request->file('image')->store('news/writers');
            $writer->update(['image' => $path]);
        }
        foreach ($data["languages"] as $lang) {
            $writer->languages()->create($lang);
        }
        return response()->json($writer);
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
        $data = json_decode($request->writer, true);
        $writer = Writer::findOrFail($id);
        $writer->update($data);
        if ($request->hasFile('image')) {
            $path =  $request->file('image')->store('news/writers');
            $writer->update(['image' => $path]);
        }
        foreach ($data["languages"] as $lang) {
            $writer->lang($lang["language_id"])->update($lang);
        }
        return response()->json($writer);
    }

    public function destroy($id)
    {
        $writer = Writer::findOrFail($id);
        $writer->languages()->delete();
        $writer->delete();
        return response()->json('ok');
    }
}
