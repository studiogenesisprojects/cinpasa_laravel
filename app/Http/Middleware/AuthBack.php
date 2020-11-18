<?php

namespace App\Http\Middleware;

use Closure;
use Route;


use Log;

class AuthBack
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        try {

            if (auth()->guard('users')->guest()) {

                $request->session()->put('url.intended', url()->current());

                return redirect()->route('Back\LoginController@index');
            } else {

            }


            return $next($request);
        } catch (\Exception $e) {
            Log::error('*********************************************************************************************');
            Log::error('Error: ' . $e->getMessage() . ' ******* In ' . Route::currentRouteAction());
            Log::error('Line:' . $e->getLine());
            Log::error('File: ' . $e->getFile());
            Log::error('*********************************************************************************************');
            return redirect()->action('Back\LoginController@index');
        }
    }
}
