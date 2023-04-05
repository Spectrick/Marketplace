<?php

namespace App\Http\Controllers;

use App\Models\Currency;
use App\Models\Product;
use Illuminate\Http\Request;

class CurrencyController extends Controller
{
    public function change (Request $request)
    {
        $cart = session()->get('cart', []);

        foreach ($cart as $id => $details) {
            $price = Product::query()->where('id', $id)->value('price');
            $cart[$id]['price'] = currencyConvert('RUB', session('currency'), $price, 2);
            session()->put('cart', $cart);
        }
        return back();
    }
}
