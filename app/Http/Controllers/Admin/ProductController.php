<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Models\Product;
use App\Models\Category;
use App\Models\Image;
use App\Models\Comment;

use Illuminate\Contracts\Database\Eloquent\Builder;
use Illuminate\Support\Facades\Storage;
use Intervention\Image\ImageManagerStatic as ImageResize;

class ProductController extends Controller
{
    public function index (Request $request)
    {
        $categories = Category::pluck('name')->toArray();

        $validated = $request->validate([
           'search' => ['nullable', 'string', 'max:50'],
           'category_id' => ['nullable', 'integer'],
           'currency' => ['string'],
        ]);

        $products = Product::query()
            ->when(
                $validated['category_id'] ?? null,
                function (Builder $query, int $categoryId) {
                    $query
                        ->where('category_id', $categoryId);
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
            $exchangeRate = currencyConvert('RUB', session('currency'), 1, 8);

            foreach ($products as $product) {
                $product->price = round($product->price * $exchangeRate, 2);
            }
        }

        return view('admin.products.index', compact('products', 'categories'));
    }

    public function create ()
    {
        $categories = Category::pluck('name')->toArray();

        return view('admin.products.create', compact('categories'));
    }

    public function store (Request $request)
    {
        $validated = $request->validate([
            'name' => ['required','string','max:100'],
            'price' => ['required', 'numeric', 'min:2'],
            'description' => ['required','string','max:1000'],
            'published' => ['nullable','boolean'],
            'category_id' => ['integer'],
            'images' => ['required','array'],
            'images.*' => ['required','image','mimes:jpeg,png,jpg,gif,svg','max:2048'],
        ]);

        $product = Product::query()->create([
            'name' => $validated['name'],
            'description' => $validated['description'],
            'price' => $validated['price'],
            'published' => $validated['published'] ?? false,
            'category_id' => $validated['category_id'],
        ]);

        $images = array();

        foreach ($validated['images'] as $imageFile) {
            $imageName = time() . uniqid() . '.' . $imageFile->getClientOriginalExtension();
            $imageUrl = $imageFile->storeAs('images/products', $imageName,'public');

            array_push($images, $imageUrl);
        }

        $thumbnail = ImageResize::make($validated['images'][0])->resize(250, 250, function ($constraint) {
                return $constraint->aspectRatio();
            });

        $thumbnailBase64 = (string) $thumbnail->encode('data-url');

        Image::query()->create([
            'product_id' => $product->id,
            'alt' => $validated['name'],
            'url' =>  json_encode($images),
            'thumbnail' => $thumbnailBase64
        ]);

        alert(__('Товар добавлен!'));

        return redirect()->route('admin.products.show', $product->id);
    }

    public function show ($productId)
    {
        $product = Product::query()->findOrFail($productId);

        if (session('currency') !== 'RUB') {
            $product['price'] = currencyConvert('RUB', session('currency'), $product['price'], 2);
        }

        $ratings = Comment::query()->where('product_id', $productId)
            ->groupBy('rating')
            ->selectRaw('rating, count(*) as count, count(*) / (select count(*) from comments where product_id = ?) * 100 as percentage', [$productId])
            ->get();

        $productRating['avg'] = round(Comment::query()->where('product_id', $productId)->avg('rating'), 2);

        $productRating['total'] = $ratings->sum('count');

        foreach ($ratings as $rating) {
            $productRating[$rating->rating]['count'] = $rating->count;
            $productRating[$rating->rating]['percentage'] = round($rating->percentage, 1);
        }

        return view('admin.products.show', compact('product', 'productRating'));
    }

    public function edit (Product $product)
    {
        $categories = Category::pluck('name')->toArray();

        return view('admin.products.edit', compact('product', 'categories'));
    }

    public function update (Request $request, $productId)
    {
        $validated = $request->validate([
            'name' => ['required','string','max:100'],
            'price' => ['required', 'numeric', 'min:2'],
            'description' => ['required','string','max:1000'],
            'published' => ['nullable','boolean'],
            'category_id' => ['integer'],
            'images' => ['array'],
            'images.*' => ['image','mimes:jpeg,png,jpg,gif,svg','max:2048'],
        ]);

        $product = Product::query()->findOrFail($productId);

        $product['name'] = $validated['name'];
        $product['price'] = $validated['price'];
        $product['description'] = $validated['description'];
        $product['published'] = $validated['published'] ?? false;
        $product['category_id'] = $validated['category_id'];

        $product->save();

        if ($request->hasFile('images')) {

            $images = Product::find($productId)->images;

            $imagesUrl = (array) json_decode($images->url);

            foreach ($imagesUrl as $imageUrl) {
                if(!str_starts_with($imageUrl, 'http')) {
                    Storage::disk('public')->delete($imageUrl);
                }
            }

            $imagesArray = array();

            foreach ($validated['images'] as $imageFile) {

                $imageName = time() . uniqid() . '.' . $imageFile->getClientOriginalExtension();
                $imageUrl = $imageFile->storeAs('images/products', $imageName, 'public');

                array_push($imagesArray, $imageUrl);
            }

            $thumbnail = ImageResize::make($validated['images'][0])->resize(150, 150, function ($constraint) {
                return $constraint->aspectRatio();
            });

            $thumbnailBase64 = (string)$thumbnail->encode('data-url');

            $images->url = json_encode($imagesArray);
            $images->thumbnail = $thumbnailBase64;

            $images->save();
        }

        alert(__('Изменения сохранены'));

        return redirect()->route('admin.products.show', $product['id']);
    }

    public function delete ($productId)
    {
        $images = Product::findOrFail($productId)->images;

        if (!empty($images)) {

            $imagesUrl = (array) json_decode($images->url);

            foreach ($imagesUrl as $imageUrl) {
                if(!str_starts_with($imageUrl, 'http')) {
                    Storage::disk('public')->delete($imageUrl);
                }
            }

            Image::destroy($images->id);
        }

        Product::destroy($productId);

        alert(__('Товар удалён'));

        return redirect()->route('admin.products');
    }
}
