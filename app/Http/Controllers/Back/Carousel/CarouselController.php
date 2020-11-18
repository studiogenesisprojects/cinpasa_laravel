<?php

namespace App\Http\Controllers\Back\Carousel;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Carousel;
use App\Models\Section;
use App\Models\Slide;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Response;

class CarouselController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $carousels = Carousel::with('slides', 'slides.languages')->get();
        return response()->json($carousels);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {

        $data = json_decode($request->carousel, true);
        $carousel = Carousel::create($data);
        foreach ($data['slides'] as $i => $slide) {
            $slide = collect($slide);
            $createdSlide = $carousel->slides()->create($slide->except('image')->toArray());
            foreach ($slide["languages"] as $language) {
                $createdSlide->languages()->create($language);
            }
            $file = $request->slidesImages[$i];
            $path = $file->store('carousels');

            $createdSlide->update([
                "image" => $path,
            ]);
        }

        return response()->json('ok');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $c = Carousel::findOrFail($id)->with('languages', 'slides');
        return response()->json($c);
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
        $data = json_decode($request->carousel, true);
        $carousel = Carousel::findOrFail($id);
        $carousel->update($data);
        $ci = 0;
        foreach ($data['slides'] as $i => $slide) {
            $slide = collect($slide);
            if (isset($slide['id'])) {
                $ci++;
                $createdSlide = Slide::findOrFail($slide["id"]);
                $createdSlide->update($slide->except('image')->toArray());
            } else {
                // return response()->json([$i, $ci], 500);
                $createdSlide = $carousel->slides()->create($slide->except('image')->toArray());
                $file = $request->slidesImages[$i - $ci];
                $path = $file->store('carousels');

                $createdSlide->update([
                    "image" => $path,
                ]);
            }
            foreach ($slide["languages"] as $language) {
                $lang = $createdSlide->lang($language["language_id"]);
                if ($lang) {
                    $lang->update($language);
                } else {
                    $createdSlide->languages()->create($language);
                }
            }
        }
        return response()->json('ok');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $carrousel = Carousel::findOrFail($id);

        $carrousel->slides->each(function ($slide) {
            $slide->delete();
        });

        $carrousel->delete();

        return response()->json([
            "msg" => "ok"
        ]);
    }

    public function deleteSlide($id)
    {

        $slide = Slide::findOrFail($id);
        $slide->delete();
        return  response()->json($id);
    }


    public function toggleActive($id)
    {
        $c = Carousel::findOrFail($id);
        $c->update([
            "active" => !$c->active
        ]);
    }

    public function toggleMain($id)
    {
        $c = Carousel::findOrFail($id);
        if (!$c->active) {
            Carousel::where('section_id', $c->section_id)->where('main', true)->get()->each(function ($c) {
                $c->update([
                    "main" => false
                ]);
            });
        }
        $c->update([
            "main" => !$c->main
        ]);
    }

    public function fetchSections()
    {
        $sections = Section::where('front', true)->get();
        return response()->json($sections);
    }

    function updateSlideImage(Request $request, $id)
    {
        $slide = Slide::findOrFail($id);
        if ($request->hasFile('image')) {
            $t = $request->file('image')->store('carousels');
            $slide->update([
                "image" => $t,
            ]);
            return response()->json([
                "image" => $slide->image,
            ]);
        } else {
            return response()->json('no file', 403);
        }
    }

    public function getImage($image)
    {
        $image = str_replace(";","/",$image);

        $path = storage_path() . '/app/' . $image;

        if (!File::exists($path)) {

            abort(404);

        }
        $file = File::get($path);

        $type = File::mimeType($path);

        $response = Response::make($file, 200);

        $response->header("Content-Type", $type);

        return $response;
    }

    public function getNewsImage($image)
    {

        $path = storage_path() . '/app/noticias/' . $image;

        if (!File::exists($path)) {

            abort(404);

        }
        $file = File::get($path);

        $type = File::mimeType($path);

        $response = Response::make($file, 200);

        $response->header("Content-Type", $type);

        return $response;
    }
}
