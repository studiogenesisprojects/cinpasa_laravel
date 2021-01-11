<?php

namespace App\Providers;

use App\Http\View\Composers\HeaderComposer;
use Illuminate\Support\ServiceProvider;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\Validator;
use Illuminate\Pagination\Paginator;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap any application services.
     *
     * @return void
     */
    public function boot()
    {
        Schema::defaultStringLength(191);
        Validator::extend(
            'recaptcha',
            'App\\Validators\\ReCaptcha@validate'
        );
        view()->composer('*', HeaderComposer::class);
        Paginator::useBootstrap();
    }
}
