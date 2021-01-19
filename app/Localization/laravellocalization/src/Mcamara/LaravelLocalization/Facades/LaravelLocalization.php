<?php

namespace App\Localization\laravellocalization\src\Mcamara\LaravelLocalization\Facades;

use Illuminate\Support\Facades\Facade;

class LaravelLocalization extends Facade
{
    /**
     * Get the registered name of the component.
     *
     * @return string
     */
    protected static function getFacadeAccessor()
    {
        return 'laravellocalization';
    }
}
