@extends('layouts.main')

@section('page.title', 'Админ панель: Просмотр отзывов')

@section('main.content')

    <x-title>
        {{ __('Отзывы о товаре') }}
        <a href="{{ route('admin.products.show', $product_id) }}">
            {{ App\Models\Product::query()->findOrFail($product_id)->name }}
        </a>
    </x-title>

    @if (!$comments->isEmpty())
        @foreach($comments as $comment)
            <x-comment.item :comment="$comment">
                <div class="float-end ms-3">
                    <x-form action="{{ route('admin.products.comments.delete', ['product' => $product_id, 'comment' => $comment->id]) }}" method="POST">
                        @method('DELETE')
                        <x-button type="submit" color="secondary">
                            {{ __('Удалить') }}
                        </x-button>
                    </x-form>
                </div>
                <div class="float-end">
                    <x-form action="{{ route('admin.products.comments.edit', ['product' => $product_id, 'comment' => $comment->id]) }}" method="GET">
                        <x-button type="submit">
                            {{ __('Отредактировать') }}
                        </x-button>
                    </x-form>
                </div>
            </x-comment.item>
        @endforeach
    @else
        <div class="mb-5">
            {{ __('Отзывов пока нет') }}
        </div>
    @endif

    <x-comment.form action="{{ route('admin.products.comments.store', $product_id) }}" method="POST" :product_id="$product_id">
        <div class="mt-3 text-right">
            <x-button type="submit" class="py-2 px-3" size="sm">
                {{ __('Отправить отзыв') }}
            </x-button>
        </div>
    </x-comment.form>

@endsection

