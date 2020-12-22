<?php

namespace App\Http\Controllers\Back;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\FinishedGaleryImage;
use App\Models\FinishedGalery;
use Illuminate\Support\Facades\Storage;


class EndingGaleryController extends Controller
{
    public function handle(Request $request){
        $galery = FinishedGalery::find($request->galery_id);

        if($request->hasFile('image')){

            $path = $request->file('image')->storeAs('public/acabados', $request->file('image')->getClientOriginalName());

            if($galery){
                $image = FinishedGaleryImage::create([
                    "image" => $path,
                    "galery_id" => $galery->id
                ]);
            }else{
                $galery = FinishedGalery::create([]);
                $image = $galery->images()->create([
                    "image" => $path
                ]);
            }
            return response()->json($image);
        }else{
            //update the translations for finishedgaleryimage
            if($request->finished_galery_image_id){
                $finishedGaleryImage = FinishedGaleryImage::findOrFail($request->finished_galery_image_id);
                foreach($request->languages as $language){
                    $lang = $finishedGaleryImage->lang((int)$language['language_id']);

                    if($lang){
                        $lang->update($language);
                    }else{
                        $finishedGaleryImage->languages()->create($language);
                    }
                }
            }

            return response()->json("ok");
        }

        return response()->json($galery);
    }

    public function destroy($id){
        $finishedGaleryImage = FinishedGaleryImage::findOrFail($id);

        if(Storage::exists($finishedGaleryImage->image)){
            Storage::delete($finishedGaleryImage->image);
        }

        $finishedGaleryImage->delete();
        return response()->json('ok');
    }

}
