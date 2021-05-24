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
use App\NewsLang;
use App\NewsTag;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Maatwebsite\Excel\Concerns\ToArray;

class NewsController extends Controller
{

    public function index()
    {
        $featuredNews = NewsFeatured::all();
        $lang = Language::where('code', App::getLocale())->first();
        $news = News::whereHas('newsLang', function ($q) use($lang){
            $q->where('active',1)->where('language_id', $lang->id);
        })->orderBy('created_at', 'desc')->where('active', 1)->paginate(9);

        $carousel = new Carousel;
        $slideCarousel = new Slide;
        $slideCarousel->title = $featuredNews[0]->news ? $featuredNews[0]->news->lang()->title : 'No featured news';
        $slideCarousel->text = $featuredNews[0]->news ? $featuredNews[0]->news->lang()->content : 'No featured content';
        $slideCarousel->image = $featuredNews[0]->news ? Storage::url('noticias/'.$featuredNews[0]->news->image) : asset('front/img/no-foto.jpg');
        $carousel->setRelation('slides', [$slideCarousel]);

        return view('front.news.index', compact('news', 'featuredNews','carousel', 'slideCarousel'));
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
        $news = $noticiaEtiqueta->news()->orderBy('created_at', 'DESC')->paginate(18);
        return view('front.news.showCategory_Tag', compact('news', 'title'));
    }

    public function showCategory($noticiaCategoria)
    {
        $noticiaCategoria = NewsCategory::whereHas('languages', function ($q) use($noticiaCategoria) {
                            $q->where('slug', $noticiaCategoria);
                        })->first();
        $title = $noticiaCategoria;
        $news = $noticiaCategoria->news()->orderBy('created_at', 'DESC')->paginate(18);
        return view('front.news.showCategory_Tag', compact('news', 'title'));
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
