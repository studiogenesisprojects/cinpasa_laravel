<?php

namespace App\Http\Controllers\Back;

use App\Http\Requests\LoginRequest;
use App\Http\Controllers\Controller;
use Log;

use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function index()
    {
        if (Auth::guard('users')->check()) {
            return redirect()->route('dashboardIndex');
        }
        $inspire = Inspiring::quote();
        return view('back.login.index', compact('inspire'));
    }

    /**
     * @param LoginRequest $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function handleLogin(LoginRequest $request)
    {

        // Remember login user back
        if ($request->has('remember') && $request->input('remember') == '1') {
            $remember = true;
        } else {
            $remember = false;
        }

        // Login user system
        if (auth()->attempt([
            'email' => $request->email,
            'password' => $request->password,
            'active' => true
        ], $remember)) {
            return redirect()->route('dashboardIndex');
        } else {
            return redirect()->action('Back\LoginController@index')->with('error_login', "Usuario o contraseña incorrectos.");
        }
    }

    /**
     * @return \Illuminate\Http\RedirectResponse
     */
    public function logout()
    {
        auth()->logout();
        return redirect()->action('Back\LoginController@index');
    }
}
