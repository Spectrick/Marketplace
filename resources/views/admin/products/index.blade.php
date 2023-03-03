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
        {{ __('Товары отсутствуют') }}
    @else
        <div class="row">
            @foreach($products as $product)
{{--                <div class="col-xs-18 col-sm-6 col-md-3">--}}
                    <div class="col-xs-18 col-sm-6 col-md-3 d-flex align-items-stretch">
                    <x-product.card prefix="admin." :product="$product" />
                </div>
            @endforeach
        </div>

        {{ $products->links() }}
    @endif
@endsection
