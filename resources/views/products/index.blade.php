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
                <div class="col-xs-16 col-sm-4 col-md-2 d-flex align-items-stretch">
                    <x-product.card :product="$product" />
                </div>
            @endforeach
        </div>

        {{ $products->links() }}
    @endif
@endsection

