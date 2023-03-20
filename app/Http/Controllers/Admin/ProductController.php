<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Comment;
use Illuminate\Http\Request;

use App\Models\Category;
use App\Models\Product;
use App\Models\Image;

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

        foreach ($validated['images'] as $image_file) {
            $image_name = time() . uniqid() . '.' . $image_file->getClientOriginalExtension();
            $image_url = $image_file->storeAs('images/products', $image_name,'public');

            array_push($images, $image_url);
        }

        $thumbnail = ImageResize::make($validated['images'][0])->resize(250, 250, function ($constraint) {
                return $constraint->aspectRatio();
            });

        $thumbnail_base64 = (string) $thumbnail->encode('data-url');

        Image::query()->create([
            'product_id' => $product->id,
            'alt' => $validated['name'],
            'url' =>  json_encode($images),
            'thumbnail' => $thumbnail_base64
        ]);

        alert(__('Товар добавлен!'));

        return redirect()->route('admin.products.show', $product->id);
    }

    public function show ($product_id)
    {
        $product = Product::query()->findOrFail($product_id);

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

        return view('admin.products.show', compact('product', 'product_rating'));
    }

    public function edit (Product $product)
    {
        $categories = Category::pluck('name')->toArray();

        return view('admin.products.edit', compact('product', 'categories'));
    }

    public function update (Request $request, $product_id)
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

        $product = Product::query()->findOrFail($product_id);

        $product['name'] = $validated['name'];
        $product['price'] = $validated['price'];
        $product['description'] = $validated['description'];
        $product['published'] = $validated['published'] ?? false;
        $product['category_id'] = $validated['category_id'];

        $product->save();

        if ($request->hasFile('images')) {

            $images = Product::find($product_id)->images;

            $images_url = (array) json_decode($images->url);

            foreach ($images_url as $image_url) {
                if(!str_starts_with($image_url, 'http')) {
                    Storage::disk('public')->delete($image_url);
                }
            }

            $images_array = array();

            foreach ($validated['images'] as $image_file) {

                $image_name = time() . uniqid() . '.' . $image_file->getClientOriginalExtension();
                $image_url = $image_file->storeAs('images/products', $image_name, 'public');

                array_push($images_array, $image_url);
            }

            $thumbnail = ImageResize::make($validated['images'][0])->resize(150, 150, function ($constraint) {
                return $constraint->aspectRatio();
            });

            $thumbnail_base64 = (string)$thumbnail->encode('data-url');

            $images->url = json_encode($images_array);
            $images->thumbnail = $thumbnail_base64;

            $images->save();
        }

        alert(__('Изменения сохранены'));

        return redirect()->route('admin.products.show', $product['id']);
    }

    public function delete ($product_id)
    {
        $images = Product::findOrFail($product_id)->images;

        if (!empty($images)) {

            $images_url = (array) json_decode($images->url);

            foreach ($images_url as $image_url) {
                if(!str_starts_with($image_url, 'http')) {
                    Storage::disk('public')->delete($image_url);
                }
            }

            Image::destroy($images->id);
        }

        Product::destroy($product_id);

        alert(__('Товар удалён'));

        return redirect()->route('admin.products');
    }
}
