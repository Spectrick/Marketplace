@extends('layouts.main')

@section('page.title', $product->title)

@section('main.content')

    <x-title>
        {{ __('Просмотр товара') }}

        <x-slot name="link">
            <a href="{{ route('products') }}">
                {{ __('Назад') }}
            </a>
        </x-slot>
    </x-title>

    <div class="mb-3">
        <h2 class="h4">
            {{ $product->name }}
        </h2>

        @if($images_url)
            <x-gallery :product="$product" :images_url="$images_url" />
        @endif

        <div class="text-light badge bg-primary text-wrap my-2 align-self-start">
            <h6 class="mb-0">
                {{ $product->price }} ₽
            </h6>
        </div>

        <div class="pt-3">
            <h6>
                {{ __('Описание товара:') }}
            </h6>
            <div class="pt-2 mb-3">
                {!! $product->description !!}
            </div>
        </div>

        <x-button-link href="{{ route('cart.add', $product->id) }}" class="text-center" role="button" color="warning">
            {{ __('В корзину') }}
        </x-button-link>
    </div>

@endsection
