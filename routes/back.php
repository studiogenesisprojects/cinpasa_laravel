<?php

// RUTAS DE TRADUCCIONES
Route::group([
    'prefix' => 'traducciones',
], function () {
    Route::get('/', 'Back\Traslator\TraslatorController@index')->name('traducciones');
    Route::post('/', 'Back\Traslator\TraslatorController@index')->name('traducciones');
    Route::get('/{slug}', ['as' => 'update-traduccion', 'uses' => 'Back\Traslator\TraslatorController@update']);
    Route::post('/{slug}', ['as' => 'update-traduccion', 'uses' => 'Back\Traslator\TraslatorController@handleTraducciones']);
});

Route::get('/traducciones-new/{slug?}', ['as' => 'update-traduccion', 'uses' => 'Back\Traslator\TraslatorController@newTranslate']);
Route::post('/traducciones-new/{slug?}', ['as' => 'update-traduccion', 'uses' => 'Back\Traslator\TraslatorController@handleUpdateCreate']);
Route::get('/traducciones-delete/{slug}', ['as' => 'update-traduccion', 'uses' => 'Back\Traslator\TraslatorController@delete']);

//RUTAS DE CLIENTES
Route::prefix('/clientes')->group(function () {
    Route::get('/', 'Back\Customers\CustomersController@index')->name('customers')
        ->middleware('access.client');
    Route::get('/create', 'Back\Customers\CustomersController@create')->name('createCustomer')
        ->middleware('access.client');
    Route::post('/store', 'Back\Customers\CustomersController@store')->name('storeCustomer')
        ->middleware('access.client');
    Route::get('/update/{id?}', 'Back\Customers\CustomersController@edit')->name('updateCustomer')
        ->middleware('access.client');
    Route::post('/update/{id?}', 'Back\Customers\CustomersController@update')->name('handleUpdateCustomer')
        ->middleware('access.client');
    Route::delete('/delete/{id}', 'Back\Customers\CustomersController@destroy')->name('deleteCustomer')
        ->middleware('access.client');
});

//RUTAS DE CATEGORIAS DE GALERIA
Route::prefix('/galerias')->group(function () {
    Route::get('/', 'Back\Galery\GaleryController@index')->name('galery');
    Route::post('/', 'Back\Galery\GaleryController@index')->name('galery');

    Route::prefix('/galeria')->group(function () {
        Route::get('/update/{id?}', 'Back\Galery\GaleryController@update')->name('updateGalery');
        Route::post('/update/{id?}', 'Back\Galery\GaleryController@handleUpdate')->name('handleUpdateGalery');
        Route::get('/delete/{id}', 'Back\Galery\GaleryController@delete')->name('deleteGalery');
        Route::get('/{galeria_id}/eliminar-imagen/{id}', 'Back\Galery\GaleryController@deleteImage')->name('deleteGaleryImage');
        Route::get('/{galeria_id}/editar-imagen/{id}', 'Back\Galery\GaleryController@editImage')->name('editImage');
        Route::get('/{Galery_id}/aumentar-posicion/{imagen_id}', 'Back\Galery\GaleryController@disminuirPosicion')->name('aumentarPosicion');
        Route::get('/{galeria_id}/bajar-posicion/{imagen_id}', 'Back\Galery\GaleryController@aumentarPosicion')->name('disminuirPosicion');
        Route::post('/{galeria_id}/editar-imagen/{id}', 'Back\Galery\GaleryController@handleUpdateImage')->name('handleUpdateImage');
    });
});

// Rutas referentes a los diferentes apartados de noticias
Route::group(['prefix' => 'news'], function () {
    Route::view('/', 'back.news.index-v2')->name('news-index');
    Route::post('/', 'NewsController@store');
    Route::post('images', "NewsController@storeImage");
    Route::get('fetch', 'NewsController@index');
    Route::post('relateds', "NewsController@addNewsRelations");
    Route::delete('relateds/{newsId}/{relationId}', "NewsController@removeNewsRelation");
    Route::delete('/{id}', 'NewsController@destroy');
    Route::patch('/{id}', 'NewsController@update');
    Route::resource('writers', 'WriterController');
    Route::resource('tags', 'NewsTagController');
    Route::resource('categories', 'NewsCategoryController');
});

//LAB
Route::group([
    "prefix" => "lab",
    "middleware" => ['access.client']
], function () {
    Route::get('/', "Back\Lab\LabController@index")->name('lab');
    Route::get('/create', "Back\Lab\LabController@create")->name('lab.create');
    Route::post('/save', "Back\Lab\LabController@store")->name('lab.store');
    Route::get('/edit/{lab}', "Back\Lab\LabController@edit")->name('lab.edit');
    Route::any('/update', "Back\Lab\LabController@update")->name('lab.update');
    Route::get('/delete/{id}', "Back\Lab\LabController@destroy")->name('lab.destroy');
});

//PRODUCTOS
Route::group([
    "prefix" => "productos",
    "middleware" => ['access.client']
], function () {
    Route::get('categorias/{id}', "Back\Products\CategoryController@destroy");
    Route::get('categorias/toggle-active/{id}', "Back\Products\CategoryController@toggleActive");
    Route::post('categorias/change-order/{id}', "Back\Products\CategoryController@changeOrder");

    //CATEGORIAS DE PRODUCTOS
    Route::resource('categorias', 'Back\Products\CategoryController');
    Route::get('categorias-padre/create', 'Back\Products\CategoryController@createFather')->name('product.category-father.create');
    Route::get('categorias-padre/{id}/edit', 'Back\Products\CategoryController@editFather')->name('product.category-father.edit');

    Route::delete('images/{id}', 'Back\Products\ProductController@deleteImage');
    Route::get('download-excel', 'Back\Products\ProductController@downloadExcel');
    Route::get('download-excel-apps', 'Back\Products\ProductController@downloadExcelApps');


    //ETIQUETAS DE PRODUCTOS
    Route::prefix('/etiquetas')->group(function () {
        Route::get('/', 'Back\Products\LabelController@index')->name('labelIndex');
        Route::get('/update/{id?}', 'Back\Products\LabelController@update')->name('labelUpdate');
        Route::post('/handleupdate/{id?}', 'Back\Products\LabelController@handleUpdate')->name('labelHandleUpdate');
        Route::delete('/delete/{id}', 'Back\Products\LabelController@delete')->name('labelDelete');
    });

    //TIPOS DE PRODUCTOS
    Route::prefix('/tipos')->group(function () {
        Route::get('/', 'Back\Products\TypeController@index')->name('typeIndex');
        Route::get('/update/{id?}', 'Back\Products\TypeController@update')->name('typeUpdate');
        Route::post('/handleupdate/{id?}', 'Back\Products\TypeController@handleUpdate')->name('typeHandleUpdate');
        Route::delete('/delete/{id}', 'Back\Products\TypeController@delete')->name('typeDelete');
    });

    //FORMAS DE PRODUCTOS
    Route::prefix('/formas')->group(function () {
        Route::get('/', 'Back\Products\FormController@index')->name('formIndex');
        Route::get('/update/{id?}', 'Back\Products\FormController@update')->name('formUpdate');
        Route::post('/handleupdate/{id?}', 'Back\Products\FormController@handleUpdate')->name('formHandleUpdate');
        Route::delete('/delete/{id}', 'Back\Products\FormController@delete')->name('formDelete');
    });

    //TRENZADO DE PRODUCTOS
    Route::prefix('/trenzados')->group(function () {
        Route::get('/', 'Back\Products\BraidedController@index')->name('braidedIndex');
        Route::get('/update/{id?}', 'Back\Products\BraidedController@update')->name('braidedUpdate');
        Route::post('/handleupdate/{id?}', 'Back\Products\BraidedController@handleUpdate')->name('braidedHandleUpdate');
        Route::delete('/delete/{id}', 'Back\Products\BraidedController@delete')->name('braidedDelete');
    });

    //COLORES DE PRODUCTOS
    Route::resource('colores', 'Back\Products\ColorController');

    Route::resource('categorias-colores', 'Back\Products\ColorCategoryController');
    Route::resource('tonalidades-colores', 'Back\Products\ColorShadesController');

    // REFERENCIAS
    Route::resource('referencias', 'Back\Products\ProductReferenceController');

    // Logos Eco
    Route::resource('eco', 'Back\EcoController');
    Route::delete('eco/delete-image/{id}', 'Back\EcoController@deleteImage')->name('eco.delete-image');
});

Route::post('/productos/ordenar', 'Back\Products\ProductController@order');
Route::resource('/productos', 'Back\Products\ProductController')->middleware('access.client');

Route::resource('aplicaciones', 'Back\Aplication\AplicationController');
Route::get('aplicaciones/toggle-active/{id}', "Back\Aplication\AplicationController@toggleActive");
Route::post('aplicaciones/change-order/{id}', "Back\Aplication\AplicationController@changeOrder");

Route::get('delete-app/{id}', 'Back\Aplication\AplicationController@destroy')->name('aplicacions.destroy');

Route::resource('categorias-aplicaciones', 'Back\Aplication\ApplicationCategoryController');
Route::get('categorias-aplicaciones/toggle-active/{id}', "Back\Aplication\ApplicationCategoryController@toggleActive");
Route::post('categorias-aplicaciones/change-order/{id}', "Back\Aplication\ApplicationCategoryController@changeOrder");

Route::post('aplicaciones/ordenar', 'Back\Aplication\AplicationController@order');


Route::group([
    'prefix' => 'materiales',
    'middleware' => 'access.client'
], function () {
    Route::get('/', 'Back\Materials\MaterialsController@index')->name('materialIndex');
    Route::post('/', 'Back\Materials\MaterialsController@index')->name('materialIndex');
    Route::get('/update/{id?}', 'Back\Materials\MaterialsController@update')->name('materialUpdate');
    Route::post('/handleupdate/{id?}', 'Back\Materials\MaterialsController@handleUpdate')->name('materialHandleUpdate');
    Route::get('/delete/{id}', 'Back\Materials\MaterialsController@delete')->name('materialDelete');
    Route::get('toggle-active/{id}', "Back\Materials\MaterialsController@toggleActive");
    Route::post('change-order/{id}', "Back\Materials\MaterialsController@changeOrder");

    Route::resource('categorias', 'Back\Materials\MaterialCategoryController', [
        'as' => 'material'
    ]);
    Route::get('categorias/toggle-active/{id}', "Back\Materials\MaterialCategoryController@toggleActive");
    Route::post('categorias/change-order/{id}', "Back\Materials\MaterialCategoryController@changeOrder");
});

//acabados
Route::resource('acabados/colores-acabados', 'Back\Finished\FinishedColorController');
Route::resource('acabados/tamanos', 'Back\Finished\FinishedSizeController');
Route::resource('acabados/materiales-acabados', 'Back\Finished\FinishedMaterialController');
Route::resource('acabados/posiciones', 'Back\Finished\FinishedPositionController');
Route::resource('acabados', 'Back\Finished\FinishedController');
Route::delete('acabados/delete-image/{id}/{image}', 'Back\Finished\FinishedController@deleteImage')->name('finished.delete-image');
Route::get('acabados/delete/{id}', 'Back\Finished\FinishedController@destroy')->name('acabados.destroy');


//OFERTAS DE TRABAJO
Route::resource('ofertas-trabajo/inscritos', 'Back\JobOffers\JobOfferInscriptionController');
Route::resource('ofertas-trabajo/cvs', 'Back\JobOffers\JobOfferResumeController');
Route::resource('ofertas-trabajo', 'Back\JobOffers\JobOfferController');

//CONFIGURACIÓN
Route::post('configuracion/usuarios/toggle', 'Back\User\UserController@toggle')->name('toggleUsers');
Route::resource('configuracion/usuarios', 'Back\User\UserController');
Route::resource('configuracion/roles', 'Back\User\RoleController');

//DASHBOARD CONTROLLER
Route::get('/escritorio', 'Back\Dashboard\DashboardController@index')->name('dashboardIndex');
Route::get('/escritorio/cvpdf/{id}', 'Back\Dashboard\DashboardController@downloadcv')->name('downloadCV');

//HOME CONTROLLER
Route::get('/inicio', 'Back\Home\HomeController@index')->name('homeIndex');
Route::post('/inicio/actualizar', 'Back\Home\HomeController@update')->name('homeUpdate');

//LOGOUT
Route::get('/logout', 'Back\LoginController@logout')->name('logout');

Route::post('/acabados/galery', 'Back\EndingGaleryController@handle');
Route::delete('/acabados/galery/{id}', 'Back\EndingGaleryController@destroy');

Route::post('/productos/galery', 'Back\Products\ProductController@handleGalery');
Route::delete('/productos/galery/{id}', 'Back\Products\ProductController@deleteGalery');
Route::get('/productos/delete/{id}', 'Back\Products\ProductController@destroy')->name('products.destroy');

Route::resource('peticiones', 'Back\Petitions\PetitionController');
Route::get('excel/peticiones', 'Back\Petitions\PetitionController@excel')->name('petitionsExcel');

Route::view('carousels', 'back.carousel.index')->name('carousels.index');

Route::group(['prefix' => 'carousel'], function () {
    Route::delete('/delete-slide/{id}', 'Back\Carousel\CarouselController@deleteSlide');
    Route::resource('/', 'Back\Carousel\CarouselController');
    Route::delete('/{id}', 'Back\Carousel\CarouselController@destroy');
    Route::patch('/{id}', 'Back\Carousel\CarouselController@update');
    Route::get('toggle-active/{id}', 'Back\Carousel\CarouselController@toggleActive');
    Route::get('toggle-main/{id}', 'Back\Carousel\CarouselController@toggleMain');
    Route::get('fetch-sections', 'Back\Carousel\CarouselController@fetchSections');
    Route::post('slide-image/{id}', 'Back\Carousel\CarouselController@updateSlideImage');
});
Route::post('home-aplications/sync', 'ApplicationHomeController@sync');
