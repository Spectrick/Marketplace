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
                <div class="col-xs-18 col-sm-6 col-md-3 d-flex align-items-stretch">
                    <x-product.card :product="$product" />
                </div>
            @endforeach
        </div>

        {{ $products->links() }}
    @endif
@endsection

