<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Requests\Auth\LoginRepuest;
use App\Http\Requests\Auth\AuthService;
use App\Services\AuthService;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Support\Facades\View;

class AuthController extends Controller
{
    private AuthService $authService;

    public function __construct(AuthService $authService)
    {
        $this->authService = $authService;
    }

    public function  showRegister()
    {
        return View::make('auth.register');

    }

    public function  showLogin()
    {
        return View::make('auth.login');
    }

    public function login(Request $request)
    {
        $data =$request->validate([
            'email'=>['required'],
            'password'=>['required']
        ]);
        if(Auth::attempt($data)) {
            $request->session()->regenerate();
            return Request::route('dashboard');
        }
    }

}


