@extends('layouts.main')

@section('page.title', 'Админ панель: Редактирование товара')

@section('main.content')

    <x-title>
        {{ __('Редактирование товара') }}

        <x-slot name="link">
            <a href="{{ route('admin.products.show', $product->id) }}">
                {{ __('Назад') }}
            </a>
        </x-slot>
        <x-slot name="right">
            <x-form action="{{ route('admin.products.delete', $product->id) }}" method="post">
                @method('DELETE')
                <x-button type="submit" color="secondary">
                    {{ __('Удалить') }}
                </x-button>
            </x-form>
        </x-slot>
    </x-title>

    @include('includes.errors')

    <x-product.form action="{{ route('admin.products.update', $product->id) }}" method="put"
                    enctype="multipart/form-data" :product="$product" :categories="$categories">
        <x-button type="submit">
            {{ __('Сохранить') }}
        </x-button>
    </x-product.form>

@endsection
