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
use App\NewsCategory;
use App\NewsFeatured;
use App\NewsTag;
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

    public function showTag($noticiaEtiqueta)
    {
        $noticiaEtiqueta = NewsTag::whereHas('languages', function ($q) use($noticiaEtiqueta) {
            $q->where('slug', $noticiaEtiqueta);
        })->first();
        $title = $noticiaEtiqueta;
        $news = $noticiaEtiqueta->news()->paginate(18);
        $categories = ProductCategory::where('active', 1)->whereNotNull('sup_product_category')->get();
        $materials = Material::where('active', 1)->get();
        $colors = ProductColor::where('active', 1)->get();
        $rapports = ProductCaracteristics::whereNotNull('rapport')->get()->pluck('rapport')->unique();
        return view('front.news.showCategory_Tag', compact('categories', 'rapports', 'materials', 'colors','news', 'title'));
    }

    public function showCategory($noticiaCategoria)
    {
        $noticiaCategoria = NewsCategory::whereHas('languages', function ($q) use($noticiaCategoria) {
                            $q->where('slug', $noticiaCategoria);
                        })->first();
        $title = $noticiaCategoria;
        $news = $noticiaCategoria->news()->paginate(18);
        $categories = ProductCategory::where('active', 1)->whereNotNull('sup_product_category')->get();
        $materials = Material::where('active', 1)->get();
        $colors = ProductColor::where('active', 1)->get();
        $rapports = ProductCaracteristics::whereNotNull('rapport')->get()->pluck('rapport')->unique();
        return view('front.news.showCategory_Tag', compact('categories', 'rapports', 'materials', 'colors','news', 'title'));
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
