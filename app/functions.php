<?php

use App\Models\User;
use Illuminate\Support\Facades\Route;
use AmrShawky\LaravelCurrency\Facade\Currency;

if (! function_exists('activeLink')) {

    function activeLink (string $name, string $active = 'active'): string
    {
        return Route::is($name) ? $active : '';
    }
}

if (! function_exists('alert')) {

    function alert (string $value, string $type = 'success')
    {
        session()->flash('flash.message', $value);
        session()->flash('flash.type', $type);
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

if (! function_exists('currencyConvert')) {

    function currencyConvert (string $from, string $to, float $amount, int $round)
    {
        $result = Currency::convert()
            ->from($from)
            ->to($to)
            ->amount($amount)
            ->round($round)
            ->get();

        return $result;
    }
}
