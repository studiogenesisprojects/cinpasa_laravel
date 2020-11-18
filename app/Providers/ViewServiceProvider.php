<?php

namespace App\Providers;

use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class ViewServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        //
    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        View::composer(
            [
                'front.common.partials.header',
                'front.products.show',
                'front.products.index',
            ],
            'App\Http\View\Composers\HeaderComposer'
        );

        //View composer para el buscador
        View::composer('front.common.partials.searcher', 'App\Http\View\Composers\SearcherComposer');
        //View composer para el footer
        View::composer('front.common.partials.footer', 'App\Http\View\Composers\FooterComposer');
    }
}
