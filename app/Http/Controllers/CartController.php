<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;

class CartController extends Controller
{

    public function cart()
    {
        return view('cart.index');
    }

    public function addToCart($id)
    {
        $product = Product::findOrFail($id);

        if (session('currency') !== 'RUB') {
            $product->price = currencyConvert('RUB', session('currency'), $product->price, 2);
        }

        $cart = session()->get('cart', []);

        if (isset($cart[$id])) {
            $cart[$id]['quantity']++;
        }
        else {
            $cart[$id] = [
                "name" => $product->name,
                "quantity" => 1,
                "price" => $product->price,
                "image" => $product->images->thumbnail
            ];
        }

        session()->put('cart', $cart);

        alert(__('Товар добавлен в корзину'));

        return redirect()->back()->with('success', 'Товар добавлен в корзину');
    }

    public function update(Request $request)
    {
        if ($request->id && $request->quantity) {

            $cart = session()->get('cart');
            $cart[$request->id]["quantity"] = $request->quantity;
            session()->put('cart', $cart);
            alert(__('Количество товара обновлено'));
        }
    }

    public function remove(Request $request)
    {
        if ($request->id) {
            $cart = session()->get('cart');
            if(isset($cart[$request->id])) {
                unset($cart[$request->id]);
                session()->put('cart', $cart);
            }
            alert(__('Товар удалён из корзины'), 'dark');
        }
    }
}
