<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use App\Models\User;
use Intervention\Image\ImageManagerStatic as ImageResize;

class UserController extends Controller
{
    public function index()
    {
        $user = User::query()->findOrFail(Auth::user()->id);

        return view('user.index', compact('user'));
    }

    public function edit($user_id)
    {
        $user = User::query()->findOrFail($user_id);

        return view('user.edit', compact('user'));
    }

    public function update(Request $request, $user_id)
    {
        $user = User::findOrFail($user_id);

        if ($request->email !== $user->email)
        {
            $validated = $request->validate([
                'email' => ['required', 'string', 'max:50', 'email', 'unique:users'],
            ]);

            $user->email = $validated['email'];
        }

        $validated = $request->validate([
            'name' => ['required', 'string', 'max:50'],
            'avatar' => ['image']
        ]);

        $user->name = $validated['name'];

        if ($request->hasfile('avatar')) {
            $avatar = ImageResize::make($validated['avatar'])->resize(100, 100, function ($constraint) {
                return $constraint->aspectRatio();
            });
            $user->avatar = (string) $avatar->encode('data-url');
        }

        if($request->filled('old_password') or $request->filled('new_password') or $request->filled('new_password_confirmation'))
        {
            $validated = $request->validate([
                'old_password' => ['required', 'string', 'min:7', 'max:50'],
                'new_password' => ['required', 'string', 'min:7', 'max:50', 'confirmed']
            ]);

            if (!Hash::check($request->old_password, $user->password))
            {
                alert(__('Cтарый пароль введён неверно!'), 'danger');
                return back();
            }

            $user->password = bcrypt($validated['new_password']);
        }

        $user->save();

        alert(__('Изменения в учётной записи сохранены!'));

        return redirect()->route('user');
    }
}
