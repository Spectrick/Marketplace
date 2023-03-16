<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Models\Comment;

class CommentController extends Controller
{
    public function index($product_id)
    {
        $comments = Comment::where('product_id', $product_id)->get();

        return view('admin.products.comments.index', compact('comments', 'product_id'));
    }

    public function store(Request $request, $product_id)
    {
        $validated = $request->validate([
            'message' => ['required','string','max:1000'],
            'rating' => ['integer','max:5'],
        ]);

        $comment = Comment::query()->create([
            'product_id' => $product_id,
            'user_id' => Auth::user()->id,
            'message' => $validated['message'],
            'rating' => $validated['rating'] ?? 0,
        ]);

        $comment->save();

        alert(__('Спасибо за отзыв!'), 'info');

        return redirect()->back();
    }

    public function edit($product_id, $comment_id)
    {
        $comment = Comment::query()->findOrFail($comment_id);

        return view('admin.products.comments.edit', compact('product_id', 'comment'));
    }

    public function update(Request $request, $product_id, $comment_id)
    {
        $validated = $request->validate([
            'message' => ['required','string','max:1000'],
            'rating' => ['integer','max:5'],
        ]);

        $comment = Comment::query()->findOrFail($comment_id);

        $comment['product_id'] = $product_id;
        $comment['user_id'] = Auth::user()->id;
        $comment['message'] = $validated['message'];
        $comment['rating'] = $validated['rating'] ?? 0;

        alert(__('Отзыв изменён'), 'info');

        $comment->save();

        return redirect()->back();
    }

    public function delete($product_id, $comment_id)
    {
        Comment::destroy($comment_id);

        alert(__('Комментарий удалён'), 'dark');

        return redirect()->back();
    }
}
