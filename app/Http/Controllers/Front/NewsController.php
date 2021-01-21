<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Carousel;
use App\Models\Language;
use App\Models\Material;
use Illuminate\Http\Request;
use App\Models\Noticia;
use App\Models\NoticiaEtiqueta;
use App\Models\NoticiaCategoria;
use App\Models\NoticiaPrincipal;
use App\Models\ProductCaracteristics;
use App\Models\ProductCategory;
use App\Models\ProductColor;
use App\Models\Slide;
use App\News;
use App\NewsFeatured;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\Storage;
use Maatwebsite\Excel\Concerns\ToArray;

class NewsController extends Controller
{

    public function index()
    {
        $categories = ProductCategory::where('active', 1)->whereNotNull('sup_product_category')->get();
        $materials = Material::where('active', 1)->get();
        $colors = ProductColor::where('active', 1)->get();
        $rapports = ProductCaracteristics::whereNotNull('rapport')->get()->pluck('rapport')->unique();

        $featuredNews = NewsFeatured::all();
        $news = News::orderBy('created_at', 'desc')->paginate(9);

        $carousel = new Carousel;
        $slideCarousel = new Slide;
        $slideCarousel->title = $featuredNews[0]->news->lang()->title;
        $slideCarousel->text = $featuredNews[0]->news->lang()->content;
        $slideCarousel->image = Storage::url('noticias/'.$featuredNews[0]->news->image);
        $carousel->setRelation('slides', [$slideCarousel]);

        return view('front.news.index', compact('news', 'featuredNews','categories', 'materials', 'colors','rapports', 'carousel', 'slideCarousel'));
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
