<?php

use Illuminate\Database\Eloquent\Model;
use App\Localization\laravellocalization\src\Mcamara\LaravelLocalization\Interfaces\LocalizedUrlRoutable;

class ModelWithTranslatableRoutes extends Model implements LocalizedUrlRoutable
{
    public function getLocalizedRouteKey($locale)
    {
        if($locale == 'es'){
            return 'empresa';
        }

        return 'company';
    }
}
