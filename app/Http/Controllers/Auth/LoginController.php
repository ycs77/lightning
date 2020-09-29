<?php

namespace App\Http\Controllers\Auth;

use App\Demo\Demo;
use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Http\Request;
use Inertia\Inertia;

class LoginController extends Controller
{
    use AuthenticatesUsers {
        login as userLogin;
    }

    protected $redirectTo = RouteServiceProvider::HOME;

    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    public function showLoginForm()
    {
        return Inertia::render('Auth/Login');
    }

    public function login(Request $request)
    {
        $this->demoBlock($request);

        return $this->userLogin($request);
    }

    protected function demoBlock(Request $request)
    {
        $canBlock = $request->input($this->username()) !== env('LIGHTNING_DEMO_USERNAME') ||
            ! $this->guard()->validate($this->credentials($request));

        return Demo::block($canBlock, fn ($message) => [$this->username() => $message]);
    }

    protected function attemptLogin(Request $request)
    {
        return $this->guard()->attempt(
            $this->credentials($request), $request->input('remember')
        );
    }
}
