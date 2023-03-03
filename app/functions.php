<?php

use Illuminate\Support\Facades\Route;
use App\Models\User;

if (! function_exists('activeLink')) {

    function activeLink (string $name, string $active = 'active'): string
    {
        return Route::is($name) ? $active : '';
    }
}

if (! function_exists('alert')) {

    function alert (string $value, string $type = 'success')
    {
        session([
            'alert' => $value,
            'type' => $type,
        ]);
    }
}

if (! function_exists('isAdmin')) {

    function isAdmin ($user)
    {
        if (($user) && $user->admin == true) {
            return true;
        }

        return false;
    }
}

