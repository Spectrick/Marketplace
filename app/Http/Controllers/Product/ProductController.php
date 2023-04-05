<?php

namespace App\Http\Controllers\Product;

use App\Http\Controllers\Controller;

use App\Models\Category;
use App\Models\Comment;
use App\Models\Product;

use Illuminate\Http\Request;
use Illuminate\Contracts\Database\Eloquent\Builder;


class ProductController extends Controller
{
    public function index (Request $request)
    {
        $categories = Category::pluck('name')->toArray();

        $validated = $request->validate([
            'search' => ['nullable', 'string', 'max:50'],
            'category_id' => ['nullable', 'integer'],
        ]);

        $products = Product::query()
            ->when(
                $validated['category_id'] ?? null,
                function (Builder $query, int $category_id) {
                    $query
                        ->where('category_id', $category_id);
                })
            ->when(
                $validated['search'] ?? null,
                function (Builder $query, string $search) {
                    $query
                        ->where('name', 'like', "%{$search}%");
                })
            ->latest('id')
            ->paginate(24);

        if (session('currency') !== 'RUB') {
            $exchange_rate = currencyConvert('RUB', session('currency'), 1, 8);

            foreach ($products as $product) {
                $product->price = round($product->price * $exchange_rate, 2);
            }
        }

        return view('products.index', compact('products', 'categories'));
    }

    public function show ($product_id)
    {
        $product = Product::query()->findOrFail($product_id);

        if (session('currency') !== 'RUB') {
            $product['price'] = currencyConvert('RUB', session('currency'), $product['price'], 2);
        }

        $ratings = Comment::where('product_id', $product_id)
            ->groupBy('rating')
            ->selectRaw('rating, count(*) as count, count(*) / (select count(*) from comments where product_id = ?) * 100 as percentage', [$product_id])
            ->get();

        $product_rating['avg'] = round(Comment::query()->where('product_id', $product_id)->avg('rating'), 2);

        $product_rating['total'] = $ratings->sum('count');

        foreach ($ratings as $rating) {
            $product_rating[$rating->rating]['count'] = $rating->count;
            $product_rating[$rating->rating]['percentage'] = round($rating->percentage, 1);
        }

        return view('products.show', compact('product', 'product_rating'));
    }
}
