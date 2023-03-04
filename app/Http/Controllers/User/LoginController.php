<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class LoginController extends Controller
{
    public function index ()
    {
        return view('login.index');
    }

    public function store (Request $request)
    {
        $credentials = $request->validate([
            'email' => ['required', 'email'],
            'password' => ['required'],
        ]);

        $remember = $request->has('remember');

        if (Auth::attempt($credentials, $remember)) {
            $request->session()->regenerate();

            alert(__('Добро пожаловать!'));

            return redirect()->intended('/');
        }

        return back()->withErrors([
            'email' => __('Пользователь с такими данными не найден!'),
        ])->onlyInput('email');
    }

    public function logout (Request $request)
    {
        Auth::logout();

        $request->session()->invalidate();

        $request->session()->regenerateToken();

        alert(__('Вы вышли из учётной записи'), 'secondary');

        return redirect('/');

    }
}
