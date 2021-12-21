<?php

namespace App\Http\Controllers\Front;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\ProductLang;
use App\Models\ProductCategory;
use App\Models\Language;
use App\Models\ApplicationCategory;
use App\Models\Finished;
use App\Models\MaterialCategory;
use App\Models\ProductColorCategory;
use App\News;
use App;
use LaravelLocalization;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\URL;
use App\Models\JobOffer;
use App\Models\Aplication;
use App\ApplicationHome;
use App\Models\FeaturedProduct;
use App\Models\Lab;
use App\Models\Material;
use DB;

class SiteMapController extends Controller
{
    /**
     * Genera el sitemap
     */
    public function index()
    {
        // create new sitemap object
        $sitemap = App::make('sitemap');
        $view = config('view.paths')[0];
        $languages = Language::all();

        //Main routes
        foreach ($languages as $key => $language) {
                $homePageTrans[$key] = [
                    'language' => $language->code,
                    'url' => URL::to('/' . $language->code)
                ];
                $companyTranslations[$key] = [
                    'language' => $language->code,
                    'url' => LaravelLocalization::getURLFromRouteNameTranslated($language->code, 'routes.company.index')
                ];
                $applicationsTranslations[$key] = [
                    'language' => $language->code,
                    'url' => LaravelLocalization::getURLFromRouteNameTranslated($language->code, 'routes.applications.index')
                ];
                $newsTranslations[$key] = [
                    'language' => $language->code,
                    'url' => LaravelLocalization::getURLFromRouteNameTranslated($language->code, 'routes.news.index')
                ];
                $productsTranslations[$key] = [
                    'language' => $language->code,
                    'url' => LaravelLocalization::getURLFromRouteNameTranslated($language->code, 'routes.products.index')
                ];
                $workWithUsTranslations[$key] = [
                    'language' => $language->code,
                    'url' => LaravelLocalization::getURLFromRouteNameTranslated($language->code, 'routes.work-with-us.index')
                ];
                $contactTranslations[$key] = [
                    'language' => $language->code,
                    'url' => LaravelLocalization::getURLFromRouteNameTranslated($language->code, 'routes.contact.index')
                ];
                $labTranslations[$key] = [
                    'language' => $language->code,
                    'url' => LaravelLocalization::getURLFromRouteNameTranslated($language->code, 'routes.lab.index')
                ];
                $outletTranslations[$key] = [
                    'language' => $language->code,
                    'url' => LaravelLocalization::getURLFromRouteNameTranslated($language->code, 'routes.outlet.index')
                ];
                $distributeTranslations[$key] = [
                    'language' => $language->code,
                    'url' => LaravelLocalization::getURLFromRouteNameTranslated($language->code, 'routes.distribute.index')
                ];
                $favoriteTranslations[$key] = [
                    'language' => $language->code,
                    'url' => LaravelLocalization::getURLFromRouteNameTranslated($language->code, 'routes.favorites.index')
                ];
        }

        $sitemap->add(
            URL::to('/'),
            date("Y-m-d H:i:s",filectime($view.'/front/home/index.blade.php')),
            '1.0',
            'monthly',
            [],
            null,
            $homePageTrans
        );
        $sitemap->add(
            LaravelLocalization::getURLFromRouteNameTranslated(App::getLocale(), 'routes.favorites.index'),
            date("Y-m-d H:i:s",filectime($view.'/front/favorites/index.blade.php')),
            '0.9',
            'monthly',
            [],
            null,
            $favoriteTranslations
        );
        $sitemap->add(
            LaravelLocalization::getURLFromRouteNameTranslated(App::getLocale(), 'routes.distribute.index'),
            date("Y-m-d H:i:s",filectime($view.'/front/distribute/index.blade.php')),
            '0.9',
            'monthly',
            [],
            null,
            $distributeTranslations
        );
        $sitemap->add(
            LaravelLocalization::getURLFromRouteNameTranslated(App::getLocale(), 'routes.company.index'),
            date("Y-m-d H:i:s",filectime($view.'/front/business/index.blade.php')),
            '0.9',
            'monthly',
            [],
            null,
            $companyTranslations
        );
        $sitemap->add(
            LaravelLocalization::getURLFromRouteNameTranslated(App::getLocale(), 'routes.lab.index'),
            date("Y-m-d H:i:s",filectime($view.'/front/lab/index.blade.php')),
            '0.9',
            'monthly',
            [],
            null,
            $labTranslations
        );
        $sitemap->add(
            LaravelLocalization::getURLFromRouteNameTranslated(App::getLocale(), 'routes.outlet.index'),
            date("Y-m-d H:i:s",filectime($view.'/front/lab/index.blade.php')),
            '0.9',
            'monthly',
            [],
            null,
            $outletTranslations
        );
        $sitemap->add(
            LaravelLocalization::getURLFromRouteNameTranslated(App::getLocale(), 'routes.applications.index'),
            Aplication::latest()->first()->updated_at,
            '0.9',
            'monthly',
            [],
            null,
            $applicationsTranslations
        );


        $sitemap->add(
            LaravelLocalization::getURLFromRouteNameTranslated(App::getLocale(), 'routes.news.index'),
            News::latest()->first()->updated_at,
            '0.9',
            'monthly',
            [],
            null,
            $newsTranslations
        );

        $sitemap->add(
            LaravelLocalization::getURLFromRouteNameTranslated(App::getLocale(), 'routes.products.index'),
            Product::latest()->first()->updated_at,
            '0.9',
            'monthly',
            [],
            null,
            $productsTranslations
        );
        $sitemap->add(
            LaravelLocalization::getURLFromRouteNameTranslated(App::getLocale(), 'routes.work-with-us.index'),
            JobOffer::latest()->first()->updated_at,
            '0.9',
            'monthly',
            [],
            null,
            $workWithUsTranslations
        );
        $sitemap->add(
            LaravelLocalization::getURLFromRouteNameTranslated(App::getLocale(), 'routes.contact.index'),
            date("Y-m-d H:i:s",filectime($view.'/front/contact/index.blade.php')),
            '0.9',
            'monthly',
            [],
            null,
            $contactTranslations
        );

        //Categorías de productos
        $categories = ProductCategory::where('sup_product_category', null)->get();
        foreach ($categories as $category) {
            $i = 0;
            foreach ($languages as $language) {
                    $translations[$i] = [
                        'language' => $language->code,
                        'url' => LaravelLocalization::getURLFromRouteNameTranslated($language->code, 'routes.products.show', [
                            "productCategory" => $category,
                        ])
                    ];
                $i++;
            }
            $sitemap->add(
                LaravelLocalization::getURLFromRouteNameTranslated(App::getLocale(), 'routes.products.show', [
                    "productCategory" => $category,
                ]),
                $category->updated_at,
                0.8,
                'monthly',
                [],
                null,
                $translations
            );

            //Subcategorías de productos con sus imágenes
            foreach ($category->childrens()->where('active', true)->get() as $child) {
                $i = 0;
                $j = 0;
                $images = [];
                foreach ($languages as $language) {
                        $translations[$i] = [
                            'language' => $language->code,
                            'url' => LaravelLocalization::getURLFromRouteNameTranslated($language->code, 'routes.products.show', [
                                "productCategory" => $child,
                            ])
                        ];
                    $i++;
                }

                if (!empty($child->image)) {
                    $images[$j] = [
                        'url' => asset(Storage::url($child->image))
                    ];
                }
                $sitemap->add(
                    LaravelLocalization::getURLFromRouteNameTranslated(App::getLocale(), 'routes.products.show', [
                        "productCategory" => $child,
                    ]),
                    $child->updated_at,
                    0.8,
                    'monthly',
                    $images,
                    null,
                    $translations
                );
                $j++;
            }
        }

        //Productos y productos outlet
        foreach (Product::where('active', true)->get() as $product) {
            if($product->outlet){
                $route = 'routes.outlet.show';
            } else {
                $route = 'routes.products.showProduct';
            }
            $m = 0;
            $n = 0;
            $imagesProduct = [];
            foreach ($languages as $language) {
                    $translationsProduct[$m] = [
                        'language' => $language->code,
                        'url' => LaravelLocalization::getURLFromRouteNameTranslated($language->code, $route, [
                            "productCategory" => $product->categories->first(),
                            "product" => $product
                        ])
                    ];
                $m++;
            }

            if (!empty($product->primaryImage)) {
                $imagesProduct[$n] = [
                    'url' => asset(Storage::url($product->primaryImage->path))
                ];
                if(!empty($product->primaryImage->alt)){
                    $imagesProduct[$n]['title'] = $product->primaryImage->alt;
                }
                $n++;
            }
            if ($product->galeries->first()) {
                foreach ($product->galeries->first()->images as $image) {
                    $imagesProduct[$n] = [
                        'url' => asset(Storage::url($image->path))
                    ];
                    if(!empty($image->alt)){
                        $imagesProduct[$n]['title'] = $image->alt;
                    }
                    $n++;
                }
            }
            $sitemap->add(
                $product->url,
                $product->updated_at,
                0.7,
                'monthly',
                $imagesProduct,
                null,
                $translationsProduct
            );
        }

        //Categorías de Aplicaciones
        $applicationCategories = ApplicationCategory::where('active', true)->orderBy('order')->get();
        foreach ($applicationCategories as $applicationCategory) {
            $i = 0;
            $images = [];
            foreach ($languages as $language) {
                    if (isset($applicationCategory->lang($language->code)->slug)) {
                        $translations[$i] = [
                        'language' => $language->code,
                        'url' => LaravelLocalization::getURLFromRouteNameTranslated($language->code, 'routes.applications.show', [
                            "applicationCategory" => $applicationCategory->lang($language->code)->slug
                        ])
                    ];
                    }
                $i++;
            }
            if (!empty($applicationCategory->list_image)) {
                $images[0] = [
                    'url' => asset(Storage::url($applicationCategory->list_image))
                ];
                if (!empty($applicationCategory->alt)){
                    $images[0]['title'] = $applicationCategory->alt;
                }
            }
            $sitemap->add(
                LaravelLocalization::getURLFromRouteNameTranslated(App::getLocale(), 'routes.applications.show', [
                    "applicationCategory" => $applicationCategory->lang()->slug
                ]),
                $applicationCategory->updated_at,
                0.8,
                'monthly',
                $images,
                null,
                $translations
            );
        }



        //LAB
        foreach (Lab::all() as $lab) {
            //Productos lab
            if ($lab) {
                $i = 0;
                $translations = [];
                foreach ($languages as $language) {
                        $translations[$i] = [
                            'language' => $language->code,
                            'url' => LaravelLocalization::getURLFromRouteNameTranslated($language->code, 'routes.lab.show_products', [
                                "slug" => $lab->slug
                            ])
                        ];
                    $i++;
                }
                if (!empty($lab->list_image)) {
                    $images[0] = [
                        'url' => asset(Storage::url($lab->list_image))
                    ];
                    if (!empty($lab->alt)){
                        $images[0]['title'] = $lab->alt;
                    }
                }
                $sitemap->add(
                    LaravelLocalization::getURLFromRouteNameTranslated(App::getLocale(), 'routes.lab.show_products', [
                        "slug" => $lab->slug
                    ]),
                    $lab->updated_at,
                    0.8,
                    'monthly',
                    $images,
                    null,
                    $translations
                );
            }
        }

        //Aplicaciones
        foreach (Aplication::where('active', true)->get() as $application) {
            //Categorías de esa aplicación
            foreach ($application->applicationCategories()->where('active', true)->get() as $applicationCategory) {
                $i = 0;
                $translations = [];
                foreach ($languages as $language) {
                        if(isset($applicationCategory->lang($language->code)->slug)){
                                $translations[$i] = [
                                'language' => $language->code,
                                'url' => LaravelLocalization::getURLFromRouteNameTranslated($language->code, 'routes.applications._show', [
                                    "aplication" => $application,
                                    "applicationCategory" => $applicationCategory->lang($language->code)->slug
                                ])
                            ];
                        }
                    $i++;
                }
                if (!empty($application->list_image)) {
                    $images[0] = [
                        'url' => asset(Storage::url($application->list_image)),
                    ];
                    if(!empty($application->alt)){
                        $images[0]['title'] = $application->alt;
                    }
                }
                $sitemap->add(
                    LaravelLocalization::getURLFromRouteNameTranslated(App::getLocale(), 'routes.applications._show', [
                        "aplication" => $application,
                        "applicationCategory" => $applicationCategory->lang(App::getLocale())->slug
                    ]),
                    $application->updated_at,
                    0.8,
                    'monthly',
                    $images,
                    null,
                    $translations
                );
            }
        }


        //Noticias
        foreach (News::where('active', true)->get() as $new) {
            $i = 0;
            $translations = [];
            $images = [];
            foreach ($languages as $language) {
                    $langActive = DB::table('news_langs')->where('news_id', '=', $new->id)->where('language_id', $language->id)->where('active', '=', 1)->first();
                    if ($langActive != null) {
                        $translations[$i] = [
                            'language' => $language->code,
                            'url' => LaravelLocalization::getURLFromRouteNameTranslated(
                                $language->code,
                                'routes.news.show',
                                ["news" => $langActive->slug]
                            )
                        ];
                    }
                $i++;
            }
            if (!empty($new->image)) {
                $images = [[
                    'url' => asset(Storage::url("noticias/" . $new->image)),
                ]];
            }
            $sitemap->add(
                LaravelLocalization::getURLFromRouteNameTranslated(
                    App::getLocale(),
                    'routes.news.show',
                    ["news" => $new->lang()->slug]
                ),
                $new->updated_at,
                0.8,
                'monthly',
                $images,
                null,
                $translations
            );
        }

        // show your sitemap (options: 'xml' (default), 'html', 'txt', 'ror-rss', 'ror-rdf')
        return  $sitemap->render('xml');
    }
}
