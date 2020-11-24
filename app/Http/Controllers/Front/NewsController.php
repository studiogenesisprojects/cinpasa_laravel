<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Language;
use Illuminate\Http\Request;
use App\Models\Noticia;
use App\Models\NoticiaEtiqueta;
use App\Models\NoticiaCategoria;
use App\Models\NoticiaPrincipal;
use App\News;
use App\NewsFeatured;
use Illuminate\Support\Facades\App;
use Maatwebsite\Excel\Concerns\ToArray;

class NewsController extends Controller
{

    public function index()
    {
        // $featuredNews = NewsFeatured::first();
        // if (!$featuredNews) {
        //     $featuredNews = News::where('active', true)
        //         ->whereHas('languages', function ($q) {
        //             $q->where('language_id', $this->langCodeIds[App::getLocale()])
        //                 ->where('active', 1);
        //         })
        //         ->orderBy('created_at', 'DESC')->first();
        // } else {
        //     $featuredNews = $featuredNews->news;
        // }
        $featuredNews = NewsFeatured::all();
        return view('front.news.index', compact('featuredNews'));
    }

    public function show(News $news)
    {
        return view('front.news.show', compact('news'));
    }

    public function showTag(NoticiaEtiqueta $noticiaEtiqueta)
    {
        $news = $noticiaEtiqueta->news;
        return view('front.news.tags.index', compact('news', 'noticiaEtiqueta'));
    }

    public function showCategory(NoticiaCategoria $noticiaCategoria)
    {
        $news = $noticiaCategoria->news;
        return view('front.news.categories.index', compact('news', 'noticiaCategoria'));
    }


    public function lazy($locale)
    {
        app()->setLocale($locale);
        $products = News::orderBy('created_at', 'DESC')
            ->with('categories', 'tags')
            ->where('active', true)
            ->whereHas('languages', function ($q) use ($locale) {
                $q->where('language_id', $this->langCodeIds[$locale])
                    ->where('active', 1);
            });
        return response()->json($products->paginate(6));
    }
}
