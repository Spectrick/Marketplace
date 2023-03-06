<?php

namespace App\Http\Controllers\Product;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\Request;

use App\Models\Product;
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
            ->paginate(12);

        return view('products.index', compact('products', 'categories'));
    }

    public function show ($product_id)
    {
        $product = Product::query()->findOrFail($product_id);

        $images_url = (array) json_decode(Product::find($product_id)->images->url);

        return view('products.show', compact('product', 'images_url'));
    }
}
