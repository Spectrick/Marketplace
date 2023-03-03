<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Http\Request;
use App\Models\User;
use Intervention\Image\ImageManagerStatic as ImageResize;

class RegisterController extends Controller
{
    public function index ()
    {
        return view('register.index');
    }

    public function store (Request $request)
    {

        $validated = $request->validate([
            'name' => ['required', 'string', 'max:50'],
            'email' => ['required', 'string', 'max:50', 'email', 'unique:users'],
            'password' => ['required', 'string', 'min:7', 'max:50', 'confirmed'],
            'avatar' => ['image'],
            'agreement' => ['accepted'],
        ]);


        if(request()->hasfile('avatar')) {
            $avatar = ImageResize::make($validated['avatar'])->resize(100, 100, function ($constraint) {
                return $constraint->aspectRatio();
            });
            $avatar_base64 = (string) $avatar->encode('data-url');
        }

        $user = User::query()->create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => bcrypt($validated['password']),
            'avatar' => $avatar_base64 ?? null,
        ]);

        $user->save();

        Auth::login($user);

        alert(__('Регистрация прошла успешно!'));

        return redirect()->route('home');
    }
}
