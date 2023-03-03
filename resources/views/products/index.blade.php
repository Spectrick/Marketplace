@extends('layouts.main')

@section('page.title', 'Товары')

@section('main.content')

    <x-title>
        {{ __('Список товаров') }}
    </x-title>

    @include('products.filter')

    @if ($products->isEmpty())
        {{ __('Товары отсутствуют') }}

    @else
        <div class="row">
            @foreach($products as $product)
                <div class="col-12 col-md-4">
                    <x-product.card :product="$product" />
                </div>
            @endforeach
        </div>

        {{ $products->links() }}
    @endif
@endsection

