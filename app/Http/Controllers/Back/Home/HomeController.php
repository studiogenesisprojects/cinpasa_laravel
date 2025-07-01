<?php

namespace App\Http\Controllers\Back\Home;

use App\ApplicationHome;
use App\Http\Controllers\Controller;
use App\Models\Aplication;
use App\Models\ApplicationCategory;
use App\Models\Product;
use App\Models\Section;
use App\News;
use App\NewsFeatured;
use Illuminate\Http\Request;

class HomeController extends Controller
{
    public $section;

    public function __construct()
    {
        $this->section = Section::find(config('app.enabled_sections.inicio'));

        //$this->authorizeResource(Product::class, 'id');
    }

    public function index()
    {
        $this->authorize('read', $this->section);
        $news = News::orderBy('created_at', 'DESC')->get();
        $newsFeatured = NewsFeatured::all();
        $products = Product::orderBy('order')->take(10)->get();
        $aplications = Aplication::orderBy('order')->get();
        $homeApps = ApplicationHome::orderBy('order')->get();
        $applicationCategories = ApplicationCategory::orderBy('order')->get();

        $manual = true;
        if ($newsFeatured->first()) {
            if (
                $newsFeatured->first()->news_id == $news->first()->id
                && $newsFeatured[1]->news_id == $news[1]->id
                && $newsFeatured[2]->news_id == $news[2]->id
            ) {
                $manual = false;
            }
        }

        return view('back.home.index', compact('news', 'newsFeatured', 'products', 'aplications', 'manual', 'homeApps', 'applicationCategories'));
    }

    public function update(Request $request)
    {
        $this->authorize('write', $this->section);
        //logica para guardar las 3 noticias principales
        if ($request->select_type) {
            NewsFeatured::truncate();
            foreach ($request->main_noticias as $value) {
                NewsFeatured::updateOrCreate(
                    [
                        'news_id' => $value
                    ]
                );
            }
        } else {
            NewsFeatured::truncate();
            $news = News::orderBy('created_at', 'DESC')->get()->take(3);
            foreach ($news as $n) {
                NewsFeatured::create([
                    "news_id" => $n->id,
                ]);
            }
        }
        return redirect()->route('homeIndex');
    }
}
