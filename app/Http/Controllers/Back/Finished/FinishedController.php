<?php

namespace App\Http\Controllers\Back\Finished;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Models\Aplication;
use App\Models\Finished;
use App\Models\FinishedGaleryImage;
use App\Models\FinishedGalery;
use App\Models\FinishedColor;
use App\Models\FinishedMaterial;
use App\Models\FinishedPosition;
use App\Models\FinishedSize;
use App\Models\Language;
use App\Models\Material;

use Illuminate\Support\Facades\Storage;

class FinishedController extends Controller
{
    public function index()
    {
        // Finished::ponerOrder();
        $finisheds = Finished::orderBy('order')->get();
        return view('back.finisheds.index', compact('finisheds'));
    }

    public function create()
    {
        $materials = FinishedMaterial::all();
        $applications = Aplication::all();
        $languages = Language::all();
        $sizes = FinishedSize::all();
        $colors = FinishedColor::all();
        $positions = FinishedPosition::all();

        return view('back.finisheds.create', compact(
            'materials',
            'applications',
            'languages',
            'colors',
            'sizes',
            'positions'
        ));
    }

    public function store(Request $request)
    {
        // dd($request->all());
        $request->validate([
            "finishedLangs" => "required|array",
            "list_image" => "file",
            "section_image" => "file",
            "applications" => "array",
            "galery" => "array"
        ]);

        $finished = new Finished($request->toArray());

        if ($request->hasFile('secondary_image')) {
            $path = $request->file('secondary_image')->storeAs('acabados', $request->file('secondary_image')->getClientOriginalName());
            $finished->list_image = $path;
        }

        if ($request->hasFile('primary_image')) {
            $path = $request->file('primary_image')->storeAs('acabados', $request->file('primary_image')->getClientOriginalName());
            $finished->section_image = $path;
        }
        $finished->save();

        foreach (Language::all() as $language) {

            $finished->languages()->create([
                "finished_id" => $finished->id,
                "language_id" => $language->id,
                "name" => $request->finishedLangs[$language->id]['name'] ?? "",
                "subtitle" => $request->finishedLangs[$language->id]['subtitle'],
                "slug" => $request->finishedLangs[$language->id]['slug'],
                "lite_description" => $request->finishedLangs[$language->id]['lite_description'],
                "large_description" => $request->finishedLangs[$language->id]['large_description'],
                "observations" => $request->finishedLangs[$language->id]['observations'],
            ]);
        }


        $finished->materials()->sync($request->materials);

        $applications = $this->prepareApps($request->applications);
        $finished->aplications()->sync($applications);

        $finished->colors()->sync($request->colors);
        $finished->sizes()->sync($request->sizes);
        $finished->positions()->sync($request->positions);

        if ($finished->galery) {
            $finished->galery->update([
                "video" => $request->video
            ]);
        } else {
            $finished->galery()->create([
                "video" => $request->video
            ]);
        }

        return redirect()->route('acabados.index')->with('success', 'Acabado creado correctamente');
    }

    public function edit($id)
    {

        $finished = Finished::findOrFail($id);
        $applications = Aplication::all();
        $sizes = FinishedSize::all();
        $colors = FinishedColor::all();
        $positions = FinishedPosition::all();
        $materials = FinishedMaterial::all();
        $aplications = Aplication::all();
        $languages = Language::all();

        return view('back.finisheds.edit')->with([
            'finished' => $finished,
            'applications' => $applications,
            'sizes' => $sizes,
            'colors' => $colors,
            'positions' => $positions,
            'materials' => $materials,
            'applications' => $aplications,
            'languages' => $languages
        ]);
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            "colors" => "array",
            "sizes" => "array",
            "posicions" => "array",
            "materials" => "array",
            "applications" => "array",
            "galery" => "array"
        ]);

        $finished = Finished::findOrFail($id);
        if ($request->hasFile('primary_image')) {
            $path = $request->file('primary_image')->storeAs('acabados', $request->file('primary_image')->getClientOriginalName());
            // dd($path);
            $finished->update([
                'section_image' => $path,
            ]);
        }
        if ($request->hasFile('secondary_image')) {
            $path = $request->file('secondary_image')->storeAs('acabados', $request->file('secondary_image')->getClientOriginalName());
            $finished->update([
                'list_image' => $path,
            ]);
        }

        $finished->update([
            "active" => $request->active,
            "order" => $request->order,
            "galery_id" => $request->galery_id
        ]);

        $this->repeatedOrder($finished->order);

        foreach ($request->finishedLangs as $language) {
            $finishedLang = $finished->lang((int) $language['language_id']);
            if ($language["name"]) {
                if ($finishedLang) {
                    $finishedLang->update($language);
                } else {
                    $finished->languages()->create($language);
                }
            }
        }

        $finished->materials()->sync($request->materials);

        $applications = $this->prepareApps($request->applications);
        $finished->aplications()->sync($applications);
        $finished->colors()->sync($request->colors);
        $finished->sizes()->sync($request->sizes);
        $finished->positions()->sync($request->positions);

        if ($finished->galery) {
            $finished->galery->update([
                "video" => $request->video
            ]);
        } else {
            $finished->galery()->create([
                "video" => $request->video
            ]);
        }

        return redirect()->route('acabados.index')->with("success", "El acabado ha sido actualizado correctamente");
    }

    private function prepareApps($apps)
    {
        if ($apps) {
            $applications = [];
            $order = 1;
            foreach ($apps as $applicationId) {
                $applications[$applicationId] = ['order' => $order];
                $order++;
            }
            return $applications;
        }
        return [];
    }

    private function deleteGaleryImage($id)
    {
        return response()->json(["success" => "Imageb eliminada correctamente"]);
    }

    private function repeatedOrder($order)
    {
        //Busco todos los que tienen el order que le he mandado
        $sameOrders = Finished::where('order', $order)
            ->orderBy('updated_at', 'DESC')
            ->get();
        //si hay mas de uno pillo el segundo, le pongo de orden el siguiente numero y lo guardo
        if ($sameOrders->count() > 1) {
            $next = $sameOrders[1]->order + 1;
            $sameOrders[1]->update(['order' => $next]);

            //llamo otra vez a esta funcion con el número siguiente
            $this->repeatedOrder($next);
        }
    }

    public function deleteImage($id, $imagen)
    {
        $finished = Finished::find($id);

        if ($imagen == "primary") {
            $finished->update([
                "section_image" => null
            ]);
            if (Storage::exists($finished->section_image)) {
                Storage::delete($finished->section_image);
            }
        } else {
            $finished->update([
                "list_image" => null
            ]);
            if (Storage::exists($finished->list_image)) {
                Storage::delete($finished->list_image);
            }
        }

        return response()->json("ok");
    }

    public function destroy($id)
    {
        $finished = Finished::findOrFail($id);
        $finished->aplications()->sync([]);
        $finished->materials()->delete();
        $finished->delete();
        return response()->json('OK');
    }
}
