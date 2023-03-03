<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Validation\Rule;
use Illuminate\Validation\Rules\Password;

class ValidationController extends Controller
{
    public function store(Request $request)
    {
        $validated = $request->validate([
            'first_name' => ['required', 'string', 'max:50'],
            'last_name' => ['nullable', 'string', 'max:50'],
            'gender' => ['nullable', 'string', 'in:male,female'],
            'password' => ['required', 'string', 'min:7', 'confirmed'],
            'password_confirmation' => ['required', 'string', 'min:7', 'confirmed'],
            'email' => ['required', 'string', 'max:50', 'email', 'exists:users'],
            'avatar' => ['nullable', 'file', 'image', 'max:2048'],
        ]);
    }
}
