<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

use App\Models\Comment;

class CommentController extends Controller
{
    public function index($productId)
    {
        $comments = Comment::where('product_id', $productId)->get();

        return view('admin.products.comments.index', compact('comments', 'productId'));
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

    public function edit($productId, $commentId)
    {
        $comment = Comment::query()->findOrFail($commentId);

        return view('admin.products.comments.edit', compact('productId', 'comment'));
    }

    public function update(Request $request, $productId, $commentId)
    {
        $validated = $request->validate([
            'message' => ['required','string','max:1000'],
            'rating' => ['integer','max:5'],
        ]);

        $comment = Comment::query()->findOrFail($commentId);

        $comment['product_id'] = $productId;
        $comment['user_id'] = Auth::user()->id;
        $comment['message'] = $validated['message'];
        $comment['rating'] = $validated['rating'] ?? 0;

        alert(__('Отзыв изменён'), 'info');

        $comment->save();

        return redirect()->back();
    }

    public function delete($comment_id)
    {
        Comment::destroy($comment_id);

        alert(__('Комментарий удалён'), 'dark');

        return redirect()->back();
    }
}
