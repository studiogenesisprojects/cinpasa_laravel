<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

include 'redirects.php';

//Redirects a QR
Route::redirect('/productos/cordon-elastico/cordones-elasticos-en-espiral-para-salvaorejas/informacion-salvaorejas',
 'https://youtu.be/W_kAHYXLC2s', 302);

 Route::redirect('/productes/cordo-elastic/cordons-elastics-en-espiral-per-salvaorelles/informacio-salvaorelles',
 'https://youtu.be/W_kAHYXLC2s', 302);

 Route::redirect('it/prodotti/corda-elastica/lacci-elastici-in-spirale-per-salva-orecchie/informazione-salva-orecchie',
'https://youtu.be/mlep_wL2uWU', 302);

Route::group([
    'prefix' => LaravelLocalization::setLocale(),
    'middleware' => ['localizationRedirect', 'localeViewPath', 'localize']
],  function () {

    Route::get('/', 'Front\HomeController@index')->name('Home');
    Route::get('/proves-script', 'ChangeReferences@execute')->name('proves-script');

    /**
     * Páginas estáticas
     */

    //301 redirects de la web vieja
    Route::get(LaravelLocalization::transRoute('routes.redirects.index'), 'Front\RedirectController@index');
    Route::get(LaravelLocalization::transRoute('routes.redirects.show'), 'Front\RedirectController@show');
    Route::get(LaravelLocalization::transRoute('routes.redirects.applications'), 'Front\RedirectController@applications');
    Route::get(LaravelLocalization::transRoute('routes.redirects.pcategories'), 'Front\RedirectController@pCategories');

    Route::view(LaravelLocalization::transRoute('routes.politic_pages.leagal_warning'), 'front.static.legalWarning');
    Route::view(LaravelLocalization::transRoute('routes.politic_pages.politic_privacy'), 'front.static.privacyPolicy');
    Route::view(LaravelLocalization::transRoute('routes.politic_pages.coockie_privacy'), 'front.static.cookiePolicy');

    Route::get(LaravelLocalization::transRoute('routes.company.100_block'), 'Front\Block100Controller@index');
    Route::get(LaravelLocalization::transRoute('routes.company.index'), 'Front\CompanyController@index');
    Route::get(LaravelLocalization::transRoute('routes.ecology.index'), 'Front\EcologyController@index');
    // /**
    //  * Controlador de contacto
    //  */
    Route::get(LaravelLocalization::transRoute('routes.contact.index'), 'Front\ContactFormController@index');
    Route::get(LaravelLocalization::transRoute('routes.contact.stored'), 'Front\ContactFormController@stored');
    Route::post(LaravelLocalization::transRoute('routes.contact.store'), 'Front\PetitionController@store')->name('contact.store');
    /**
     * Productos
     */
    //no mover de aqui, sino no funciona
    Route::get(LaravelLocalization::transRoute('routes.products.searchProducts'), 'Front\ProductController@search')->name('searcher');
    Route::get('get-search-results/{locale}', 'Front\ProductController@getSearchResults');

    Route::get(LaravelLocalization::transRoute('routes.products.showProductRe'), 'Front\ProductController@showProductRedirect');
    Route::get(LaravelLocalization::transRoute('routes.products.index'), 'Front\ProductController@index')->name('product-index');
    Route::get(LaravelLocalization::transRoute('routes.products.show'), 'Front\ProductController@show');
    Route::get(LaravelLocalization::transRoute('routes.products.showProduct'), 'Front\ProductController@showProduct');

    /**
     * Aplicaciones
     */
    Route::get(LaravelLocalization::transRoute('routes.applications.index'), 'Front\ApplicationController@index');
    Route::get(LaravelLocalization::transRoute('routes.applications.show'), 'Front\ApplicationController@show');
    Route::get(LaravelLocalization::transRoute('routes.applications._show'), 'Front\ApplicationController@_show');

    /**
     * Materiales
     */
    Route::get(LaravelLocalization::transRoute('routes.materials.index'), 'Front\MaterialController@index');
    Route::get(LaravelLocalization::transRoute('routes.materials.show'), 'Front\MaterialController@show');

    /**
     * Acabados
     */
    Route::get(LaravelLocalization::transRoute('routes.endings.index'), 'Front\EndingController@index');
    Route::get(LaravelLocalization::transRoute('routes.endings.show'), 'Front\EndingController@show');
    Route::get(LaravelLocalization::transRoute('routes.endings.old_web'), 'Front\EndingController@show');

    /**
     * Trabaja con nosotros
     */
    Route::get(LaravelLocalization::transRoute('routes.work-with-us.index'), 'Front\WorkWithUsController@index');
    Route::get(LaravelLocalization::transRoute('routes.work-with-us.stored'), 'Front\WorkWithUsController@stored');
    Route::get(LaravelLocalization::transRoute('routes.work-with-us.show'), 'Front\WorkWithUsController@show');

    /**
     * Colores
     */
    Route::get(LaravelLocalization::transRoute('routes.colors.index'), 'Front\ColorController@index');
    Route::get(LaravelLocalization::transRoute('routes.colors.show'), 'Front\ColorController@show');

    /**
     * Noticias
     */
    Route::get(LaravelLocalization::transRoute('routes.news.categories'), 'Front\NewsController@showCategory');
    Route::get(LaravelLocalization::transRoute('routes.news.tags'), 'Front\NewsController@showTag');
    Route::get(LaravelLocalization::transRoute('routes.news.index'), 'Front\NewsController@index');
    Route::get(LaravelLocalization::transRoute('routes.news.show'), 'Front\NewsController@show');

    /**
     * Favoritos
     */
    Route::get(LaravelLocalization::transRoute('routes.favorites.index'), 'Front\FavoriteController@index');
    Route::get(LaravelLocalization::transRoute('routes.favorites.info'), 'Front\FavoriteController@info');
    Route::get(LaravelLocalization::transRoute('routes.favorites.stored'), 'Front\FavoriteController@stored');

    /**
     * Distribuir
     */
    Route::get(LaravelLocalization::transRoute('routes.distribute.index'), 'Front\DistributeController@index');

    /**
     * Outlet
     */
    Route::get(LaravelLocalization::transRoute('routes.outlet.index'), 'Front\OutletController@index');
    Route::get('/outlet', 'Front\OutletController@index')->name('outlet');

    /**
     * LAB
     */
    Route::get(LaravelLocalization::transRoute('routes.lab.index'), 'Front\LabController@index');
    Route::get(LaravelLocalization::transRoute('routes.lab.show_products'), 'Front\LabController@showProducts');


    Route::post('fav', 'Front\FavoriteController@fav');
    Route::post('search', 'Front\ProductController@filter');
    //searchers
    Route::post('endings/search', 'Front\EndingController@search');


    //lazy loading
    Route::get('endings/lazy/{fromId}/{locale}', 'Front\EndingController@lazy');
    Route::get('news/lazy/{locale}', 'Front\NewsController@lazy');
    Route::get('materials/lazy/{fromId}/{locale}', 'Front\MaterialController@lazy');
    Route::get('products/lazy/{category}/{locale}', 'Front\ProductController@lazy');

    //conseguir url de un producto
    Route::get('getProductUrl/{id}/{locale}', 'Front\ProductController@getProductUrl');
});

Route::get('/login', 'Back\LoginController@index');
Route::post('/handlelogin', 'Back\LoginController@handleLogin');
Route::get('/colors/ajax/{colorID}/{productColorCategoryId}', 'Front\ColorController@ajaxColor');

Route::get('/get-image-{image}', 'Back\Carousel\CarouselController@getImage')->name('carousel.getImage');
Route::get('/get-news-image-{image}', 'Back\Carousel\CarouselController@getNewsImage')->name('carousel.getNewsImage');

//Peticiones
Route::post('work-with-us', 'Front\WorkWithUsController@store')->name('work-with-us');
Route::get('materials/{locale}', 'Front\MaterialController@fetch');
Route::get('categories/{sup}/{locale}', 'Front\ProductController@fetchCategories');
Route::get('eco-page-url/{locale}', 'Front\EcologyController@getPageUrl');
