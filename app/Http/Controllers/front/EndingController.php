<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Carousel;
use Illuminate\Http\Request;
use App\Models\FinishedLang;
use App\Models\Finished;
use Illuminate\Support\Facades\App;

class EndingController extends Controller
{
    public function index()
    {
        $carousel = Carousel::where('section_id', 8)->where('active', 1)->where('main', 1)->first();
        $finisheds = Finished::where("active", 1)->orderBy('order')->get();
        return view('front.endings.index', compact('finisheds', 'carousel'));
    }

    public function show(Finished $finished)
    {
        return view('front.endings.show', compact('finished'));
    }

    public function search(Request $request)
    {
        $request->validate([
            "query" => "required|string|max:255"
        ]);

        $results = Finished::where("active", true)->whereHas("languages", function ($query) use ($request) {
            $query->where('name', 'LIKE', '%' . $request['query'] . '%');
        })
            ->orWhereHas('aplications', function ($q) use ($request) {
                $q->whereHas('languages', function ($q) use ($request) {
                    $q->where('name', 'LIKE', '%' . $request['query'] . '%');
                });
            })->get();
        $results = $results->map(function ($finished) {
            return $finished->only(['name', 'id', 'url', 'image', 'alt']);
        });

        return response()->json($results);
    }

    public function lazy($fromId, $locale)
    {
        App::setLocale($locale);

        $finisheds = Finished::where('order', '>=', $fromId)->where("active", 1)->orderBy('order')->take(3)->get();
        $finisheds = $finisheds->map(function ($finished) {
            return $finished->only(['id', 'order', 'name', "url", "image", 'alt']);
        });
        return response()->json($finisheds);
    }
}
