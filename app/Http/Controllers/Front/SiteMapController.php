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
            if (App::getLocale() != $language->code) {
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
                // $endingsTranslations[$key] = [
                //     'language' => $language->code,
                //     'url' => LaravelLocalization::getURLFromRouteNameTranslated($language->code, 'routes.endings.index')
                // ];
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
        // $sitemap->add(
        //     LaravelLocalization::getURLFromRouteNameTranslated(App::getLocale(), 'routes.endings.index'),
        //     Finished::latest()->first()->updated_at,
        //     '0.9',
        //     'monthly',
        //     [],
        //     null,
        //     $endingsTranslations
        // );


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
                if (App::getLocale() != $language->code) {
                    $translations[$i] = [
                        'language' => $language->code,
                        'url' => LaravelLocalization::getURLFromRouteNameTranslated($language->code, 'routes.products.show', [
                            "productCategory" => $category,
                        ])
                    ];
                }
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
                    if (App::getLocale() != $language->code) {
                        $translations[$i] = [
                            'language' => $language->code,
                            'url' => LaravelLocalization::getURLFromRouteNameTranslated($language->code, 'routes.products.show', [
                                "productCategory" => $child,
                            ])
                        ];
                    }
                    $i++;
                }

                if (!empty($child->image)) {
                    $images[$j] = [
                        'url' => Storage::url($child->image),
                        'title' => $child->lang()->seo_title,
                        'caption' => $child->lang()->seo_description,
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
                if (App::getLocale() != $language->code) {
                    $translationsProduct[$m] = [
                        'language' => $language->code,
                        'url' => LaravelLocalization::getURLFromRouteNameTranslated($language->code, $route, [
                            "productCategory" => $product->categories->first(),
                            "product" => $product
                        ])
                    ];
                }
                $m++;
            }

            if (!empty($product->primaryImage)) {
                $imagesProduct[$n] = [
                    'url' => Storage::url($product->primaryImage->path),
                    'title' => (!empty($product->primaryImage->alt)) ? $product->primaryImage->alt : $product->lang()->seo_title,
                    'caption' => $product->lang()->seo_description,
                ];
                $n++;
            }
            if ($product->galeries->first()) {
                foreach ($product->galeries->first()->images as $image) {
                    $imagesProduct[$n] = [
                        'url' => Storage::url($image->path),
                        'title' => (!empty($image->alt)) ? $image->alt : $product->lang()->seo_title,
                        'caption' => $product->lang()->seo_description,
                    ];
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
                if (App::getLocale() != $language->code) {
                    if (isset($applicationCategory->lang($language->code)->slug)) {
                        $translations[$i] = [
                        'language' => $language->code,
                        'url' => LaravelLocalization::getURLFromRouteNameTranslated($language->code, 'routes.applications.show', [
                            "applicationCategory" => $applicationCategory->lang($language->code)->slug
                        ])
                    ];
                    }
                }
                $i++;
            }
            if (!empty($applicationCategory->list_image)) {
                $images[0] = [
                    'url' => Storage::url($applicationCategory->list_image),
                    'title' => (!empty($applicationCategory->alt)) ? $applicationCategory->alt : $applicationCategory->lang()->seo_title,
                    'caption' => $applicationCategory->lang()->seo_description,
                ];
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
                    if (App::getLocale() != $language->code) {
                        $translations[$i] = [
                            'language' => $language->code,
                            'url' => LaravelLocalization::getURLFromRouteNameTranslated($language->code, 'routes.lab.show_products', [
                                "slug" => $lab->slug
                            ])
                        ];
                    }
                    $i++;
                }
                if (!empty($lab->list_image)) {
                    $images[0] = [
                        'url' => Storage::url($lab->list_image),
                        'title' => (!empty($lab->alt)) ? $lab->alt : $lab->lang()->seo_title,
                        'caption' => $lab->lang()->seo_description,
                    ];
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
                    if (App::getLocale() != $language->code) {
                        if(isset($applicationCategory->lang($language->code)->slug)){
                                $translations[$i] = [
                                'language' => $language->code,
                                'url' => LaravelLocalization::getURLFromRouteNameTranslated($language->code, 'routes.applications._show', [
                                    "aplication" => $application,
                                    "applicationCategory" => $applicationCategory->lang($language->code)->slug
                                ])
                            ];
                        }
                    }
                    $i++;
                }
                if (!empty($application->list_image)) {
                    $images[0] = [
                        'url' => Storage::url($application->list_image),
                        'title' => (!empty($application->alt)) ? $application->alt : $application->lang()->seo_title,
                        'caption' => $application->lang()->seo_description,
                    ];
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

        //Acabados
        // foreach (Finished::where("active", 1)->orderBy('order')->get() as $finished) {
        //     $i = 0;
        //     $translations = [];
        //     $images = [];

        //     foreach ($languages as $language) {
        //         if (App::getLocale() !== $language->code) {
        //             $lang = DB::table('finisheds_langs')->where('finished_id', '=', $finished->id)->where('language_id', $language->id)->first();
        //             $translations[$i] = [
        //                 'language' => $language->code,
        //                 'url' => LaravelLocalization::getURLFromRouteNameTranslated(
        //                     $language->code,
        //                     'routes.endings.show',
        //                     ["finished" => $lang->slug]
        //                 )
        //             ];
        //             // $translations[$i] = [
        //             //     'language' => $language->code,
        //             //     'url' => $finished->url
        //             // ];
        //         }
        //         $i++;
        //     }
        //     if (!empty($finished->list_image)) {
        //         $images[$i] = [
        //             'url' => Storage::url($finished->list_image),
        //             'title' => (!empty($finished->alt)) ? $finished->alt : $finished->lang()->seo_title,
        //             'caption' => $finished->lang()->seo_description,
        //         ];
        //         $i++;
        //     }
        //     if (!empty($finished->section_image)) {
        //         $images[$i] = [
        //             'url' => Storage::url($finished->section_image),
        //             'title' => (!empty($finished->alt)) ? $finished->alt : $finished->lang()->seo_title,
        //             'caption' => $finished->lang()->seo_description,
        //         ];
        //         $i++;
        //     }
        //     if ($finished->galery) {
        //         foreach ($finished->galery->images as $image) {
        //             $images[$i] = [
        //                 'url' => Storage::url($image->image),
        //                 'title' => (!empty($finished->alt)) ? $finished->alt : $finished->lang()->seo_title,
        //                 'caption' => $finished->lang()->seo_description,
        //             ];
        //             $i++;
        //         }
        //     }
        //     $sitemap->add($finished->url, $finished->updated_at, 0.8, 'monthly', $images, null, $translations);
        // }

        //Categorías de materiales
        // foreach (MaterialCategory::where('active', true)->get() as $category) {
        //     foreach ($category->materials as $material) {
        //         if ($material->products->count() > 0) {
        //             $i = 0;
        //             $translations = [];
        //             foreach ($languages as $language) {
        //                 if (App::getLocale() != $language->code) {
        //                     $translations[$i] = [
        //                         'language' => $language->code,
        //                         'url' => LaravelLocalization::getURLFromRouteNameTranslated($language->code, 'routes.materials.show', [
        //                             "material" => $material
        //                         ])
        //                     ];
        //                 }
        //                 $i++;
        //             }
        //             $sitemap->add(
        //                 LaravelLocalization::getURLFromRouteNameTranslated(App::getLocale(), 'routes.materials.show', [
        //                     "material" => $material
        //                 ]),
        //                 $material->updated_at,
        //                 0.8,
        //                 'monthly',
        //                 [],
        //                 null,
        //                 $translations
        //             );
        //         }
        //     }
        // }


        //Noticias
        foreach (News::where('active', true)->get() as $new) {
            $i = 0;
            $translations = [];
            $images = [];
            foreach ($languages as $language) {
                if (App::getLocale() != $language->code) {
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
                }
                $i++;
            }
            if (!empty($new->image)) {
                $images = [[
                    'url' => Storage::url("noticias/" . $new->image),
                    'title' => $new->title,
                    'caption' => $new->description,
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
