<?php

namespace App\Http\Controllers\Product;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Models\Comment;

class CommentController extends Controller
{
    public function index($productId)
    {
        $comments = Comment::where('product_id', $productId)->get();

        return view('products.comments.index', compact('comments', 'product_id'));
    }

    public function store(Request $request, $productId)
    {
        $validated = $request->validate([
            'message' => ['required','string','max:1000'],
            'rating' => ['integer','max:5'],
        ]);

        $comment = Comment::query()->create([
            'product_id' => $productId,
            'user_id' => Auth::user()->id,
            'message' => $validated['message'],
            'rating' => $validated['rating'] ?? 0,
        ]);

        $comment->save();

        alert(__('Спасибо за отзыв!'), 'info');

        return redirect()->back();
    }
}
