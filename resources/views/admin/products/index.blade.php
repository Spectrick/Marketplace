@extends('layouts.main')

@section('page.title', 'Админ панель: Список товаров')

@section('main.content')

    <x-title>
        {{ __('Админ панель: Список товаров') }}

        <x-slot name="right">
            <x-button-link href="{{ route('admin.products.create') }}" size="sm">
                {{ __('Добавить товар') }}
            </x-button-link>
        </x-slot>
    </x-title>

    @include('products.filter')

    @if ($products->isEmpty())
        <div class="text-center">
            {{ __('Товары отсутствуют') }}
        </div>
    @else
        <div class="row">
            @foreach($products as $product)
                <div class="col-xs-16 col-sm-4 col-md-2 d-flex align-items-stretch">
                    <x-product.card :product="$product" />
                </div>
            @endforeach
        </div>

        {{ $products->links() }}
    @endif
@endsection
