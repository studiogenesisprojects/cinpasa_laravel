<?php

namespace App\Http\View\Composers;

use Illuminate\View\View;
use App\Models\Language;
use Illuminate\Support\Facades\Cache;

class MainComposer
{
    public function compose(View $view)
    {
        $appLanguages = Cache::rememberForever('appLanguages', function () {
            return Language::all();
        });

        $view->with('appLanguages', $appLanguages);
    }
}
