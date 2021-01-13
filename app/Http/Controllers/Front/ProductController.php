<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use App\Models\Carousel;
use App\Models\Material;
use Illuminate\Http\Request;
use App\Models\ProductCategory;
use App\Models\Product;
use App\Models\ProductCaracteristics;
use App\Models\ProductColor;
use \Mcamara\LaravelLocalization\Facades\LaravelLocalization;


class ProductController extends Controller
{
    public function index()
    {
        $categories = ProductCategory::where('sup_product_category', null)->get();
        $carousel = Carousel::with(['slides' => function ($q) {
            $q->orderBy('order', 'asc');
        }])->where('section_id', 4)->where('active', 1)->where('main', 1)->first();
        return view('front.products.index', compact('categories', 'carousel'));
    }

    public function fetchCategories($sup, $locale)
    {
        app()->setLocale($locale);
        $categories = ProductCategory::where('sup_product_category', '=', $sup)->where('active', true)
            ->get();
        return response()->json($categories);
    }

    public function show(ProductCategory $productCategory, Request $request)
    {
        if($productCategory->active == 0){
            abort(404);
        }

        $categories = ProductCategory::where('active', 1)->get();
        $materials = Material::where('active', 1)->get();
        $colors = ProductColor::where('active', 1)->get();

        if($request->filter) {
            $filter = $request->filter;
        } else {
            $filter = 0;
        }

        $more_info_trigger = 1;
        if ($productCategory->father == null) {
            $products = $productCategory->childrens;
            if($filter == 1) {
                $products = $products->sortBy('name');
            } elseif($filter == 2) {
                $products = $products->sortByDesc('name');
            } else {
                $products = $products->sortByDesc('order');
            }
            $productCategoryChildrens = $productCategory->childrens;
            $fathers = ProductCategory::where('sup_product_category', null)->get();
            return view('front.products.showFather', compact('productCategory', 'categories','materials','colors','filter','productCategoryChildrens', 'fathers', 'products','more_info_trigger'));
        }
        $products = $productCategory->products;
        if($filter == 1) {
            $products = $products->sortBy('name');
        } elseif($filter == 2) {
            $products = $products->sortByDesc('name');
        } else {
            $products = $products->sortByDesc('order');
        }
        return view('front.products.show', compact('productCategory', 'categories','materials','colors','products','filter','more_info_trigger'));
    }

    public function showProduct(ProductCategory $productCategory, Product $product)
    {
        if($product->active == 0){
            abort(404);
        }
        $finishedColumns = [];
        $finisheds = $product->finisheds;
        $finisheds = $finisheds->sortBy('order');
        foreach ($finisheds as $index => $f) {
            $finishedColumns[$index / 7][] = $f;
        }

        $colorCategories = $product->colorCategories->filter(function ($value, $key) {
            return $value->active == 1;
        });

        $applicationCategories = $product->applications->groupBy(function ($item, $k) {
            return $item->applicationCategories->first()->name ?? "";
        });

        $product_caracteristics = ProductCaracteristics::where('product_id', $product->id)->orderBy('order')->get();

        $references = $product_caracteristics->pluck('references');
        $width = $product_caracteristics->pluck('width');
        $bags = $product_caracteristics->pluck('bags');
        $laces = $product_caracteristics->pluck('laces');
        $rapport = $product_caracteristics->pluck('rapport');
        $diameter = $product_caracteristics->pluck('diameter');
        $length = $product_caracteristics->pluck('length');
        $width_diameter = $product_caracteristics->pluck('width_diameter');
        $observations = $product_caracteristics->pluck('observations');

        $relateds = $product->relateds();
        $more_info_trigger = 1;

        return view('front.products._show', compact('relateds',
         'product_caracteristics',
         'references', 'width', 'bags', 'laces', 'rapport', 'diameter', 'length', 'width_diameter', 'observations',
         'product', 'finishedColumns',
          'productCategory',
           'colorCategories',
           'applicationCategories', 'more_info_trigger'));
    }

    public function showProductRedirect(Product $product)
    {
        return redirect(LaravelLocalization::getURLFromRouteNameTranslated(app()->getLocale(), 'routes.products.showProduct', [
            'productCategory' => $product->categories->first(),
            'product' => $product
        ]));
    }

    public function filter(Request $request, $filter)
    {

        if ($request->products && sizeof($request->products) > 0) {
            $products = Product::findMany($request->products)->where('active', 1);
        } else {
            $products = Product::where('active', 1)->orderBy('order')->get();
        }

        $results = $products->filter(function ($product) use ($request, $filter) {
            if ($filter == "colors2()") {
                $test = $product->colors2()->filter(function ($color) use ($request) {
                    return $color->id == $request->id;
                });
                return sizeof($test) > 0;
            } else {
                return $product->$filter->find($request->id);
            }
        })->map(function ($product) {
            return $product->only(['id', 'name', 'url', 'colors', 'materials', 'applications', "images", "lite_description"]);
        });

        return response()->json($results);
    }

    public function search(Request  $request)
    {
        $categories = ProductCategory::where('active', 1)->whereNotNull('sup_product_category')->get();
        $materials = Material::where('active', 1)->get();
        $colors = ProductColor::where('active', 1)->get();
        $rapports = ProductCaracteristics::whereNotNull('rapport')->get()->pluck('rapport')->unique();

        return view('front.products.searchResult', compact('categories', 'materials', 'colors', 'rapports'));
    }

    public function getSearchResults(Request $request, $locale)
    {

        app()->setLocale($locale);
        $results = Product::where('active', true)->whereHas('languages', function ($q) use ($locale) {
            $q->where('language_id', Product::getLangIndex($locale))->where('active', true);
        })->with(['primaryImage', 'ecoLogos'])->orderBy('order');

        $append = [];
        //Nombre
        if ($request->input('name')) {
            $results = $results->whereHas('languages', function ($q) use ($request) {
                $q->where('name', 'like', '%' . $request->input('name') . '%')
                    ->orWhere('description', 'like', '%' . $request->input('name') . '%');
            });

            if ($results->count() === 0) {
                $results = Product::where('active', true)->whereHas('languages', function ($q) {
                    $q->where('active', true);
                })->orderBy('order');
                $results = $results->whereHas('references', function ($q) use ($request) {
                    $q->where('referencia', 'like', '%' . $request->input('name') . '%');
                });
            }
            $append["name"] = $request->input('name');
        }

        //Ancho
        if ($request->input('width')) {
            $results = $results->whereHas('caracteristics', function ($q) use ($request) {
                $q->where('width', $request->input('width'));
            });

            $append["width"] = $request->input('width');
        }

        //Tipo
        if ($request->input('application')) {
            $results = $results->whereHas('categories', function ($q) use ($request) {
                $q->where('product_categories.id', $request->input('application'));
            });

            $append["application"] = $request->input('application');
        }

        //Material
        if ($request->input('material')) {
            $results = $results->whereHas('materials', function ($q) use ($request) {
                $q->where('materials.id', $request->input('material'));
            });

            $append["material"] = $request->input('material');
        }

        //Bolsas
        if ($request->input('bags')) {
            $results = $results->whereHas('caracteristics', function ($q) use ($request) {
                $q->where('bags', $request->input('bags'));
            });

            $append["bags"] = $request->input('bags');
        }

        //Ratios
        if ($request->input('rapport')) {
            $results = $results->whereHas('caracteristics', function ($q) use ($request) {
                $q->where('rapport', 'LIKE', '%'.$request->input('rapport').'%');
            });

            $append["rapport"] = $request->input('rapport');
        }

        //Cordones
        if ($request->input('laces')) {
            $results = $results->whereHas('caracteristics', function ($q) use ($request) {
                $q->where('laces', $request->input('laces'));
            });

            $append["laces"] = $request->input('laces');
        }

        //Color
        if ($request->input('color')) {
            $results = $results->whereHas('categoryColors', function ($q) use ($request) {
                $q->whereHas('colors', function ($q) use ($request) {
                    $q->where('product_colors.id', $request->input("color"));
                });
            });
        }

        $results = $results->paginate(8);
        return response()->json([
            "appends" => $append,
            "results" => $results,
        ]);
    }

    public function getProductUrl($id, $locale)
    {
        $product = Product::find($id);
        return $product->getUrl($locale);
    }

    public function lazy($id, $locale)
    {
        app()->setLocale($locale);
        $products = Product::with('ecoLogos')->whereHas('categories', function ($q) use ($id) {
            $q->where('product_categories.id', $id);
        })->where('active', true)->whereHas('languages', function ($q) use ($locale) {
            $q->where("language_id", Product::getLangIndex($locale))->where('active', true);
        })->orderBy('order', 'ASC');
        return response()->json($products->paginate(6));
    }
}
