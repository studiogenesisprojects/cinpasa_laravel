<?php
/*
|--------------------------------------------------------------------------
| Detect Active Route
|--------------------------------------------------------------------------
|
| Compare given route with current route and return output if they match.
| Very useful for navigation, marking if the link is active.
|
*/
function isActiveRoute($route, $params = [], $output = "bg-danger")
{
    if (route($route, $params) == preg_replace('/&page=(\d+)/', '', url()->full())) {
        return $output;
    }
}

/**
 * Comprobar si la ruta actual es la activa
 * @param  [string]  $controller [nombre del controllador de la ruta]
 * @return string             [si existe devuelve active]
 */
function isActiveRouteController($controller)
{
    if (strpos(Route::currentRouteAction(), $controller) !== false) {
        return 'active';
    } else {
        return '';
    }
}

/**
 * Comprobar si la ruta actual es la activa
 * @param  [array]  $controller [nombre del controllador de la ruta]
 * @return string             [si existe devuelve active]
 */
function isActiveRouteControllerArray($controllers, $output = 'active')
{
    $existe = false;
    $activo = '';
    $i = 0;
    while (!$existe && $i < count($controllers)) {
        if (strpos(Route::currentRouteAction(), $controllers[$i]) !== false) {
            $existe = true;
            $activo = $output;
        }
        $i++;
    }

    return $activo;
}

/*
|--------------------------------------------------------------------------
| Detect Active Routes
|--------------------------------------------------------------------------
|
| Compare given routes with current route and return output if they match.
| Very useful for navigation, marking if the link is active.
|
*/

function areActiveRoutes(array $routes, $output = "bg-danger")
{
    foreach ($routes as $route) {
        if (Route::currentRouteName() == $route) return $output;
    }
}

function changeLocale()
{
    if (!empty($_SERVER['HTTP_HOST'])) {
        switch ($_SERVER['HTTP_HOST']) {
            case config('i18n.dominio'):
            case config('APP_HOST'):
                //          case "escoletalapoma.com":
                // case "escoletalapoma.es":
                // case "escoletalapoma.cat":
                // case "lapoma.studiogenesis.es":
                // Buscamos el idioma en la BBDD
                $idioma = App\Models\Language::Where('code', '=', Request::segment(1))->first();

                // Configuramos el locale
                $idioma ? app()->setLocale($idioma->code) : app()->setLocale(config("app.lang_default_code"));
                break;
        }
    }
}

function currentLocal($locale)
{
    if (!empty($locale)) {
        // Buscamos el idioma en la BBDD
        $idioma = App\Models\Language::Where('code', '=', strtolower($locale))->first();

        // Configuramos el locale
        $idioma ? $locale = $idioma->id : $locale = config("app.lang_default");
    }

    return $locale;
}

/**
 * Borrar un archivo
 * @param  string $name Nombre del archivo
 * @param  string $path Ruta del archivo
 * @param  boolean $type Donde se ubica, 0 (storage) - 1 (public)
 */
function deleteFile($name, $path, $type)
{
    if (!empty($name)) {
        if ($type) {
            $path = public_path() . DIRECTORY_SEPARATOR . 'uploads' . DIRECTORY_SEPARATOR . config('app.ruta_uploads.' . $path) . DIRECTORY_SEPARATOR;
        } else {
            $path = storage_path('app') . DIRECTORY_SEPARATOR . $path . DIRECTORY_SEPARATOR;
        }
        $file = $path . $name;
        if (\File::exists($file)) {
            \File::delete($file);
        }
    }
}