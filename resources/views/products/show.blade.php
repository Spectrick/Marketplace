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

        <dl class="row mt-3">
            <dt class="col-sm-3">
                {{ __('Цена') }}:
            </dt>
            <dd class="col-sm-9">
                <div class="text-light badge bg-primary text-wrap my-2 align-self-start">
                    <h6 class="mb-0">
                        {{ $product->price }} ₽
                    </h6>
                </div>
            </dd>
            <dt class="col-sm-3">
                {{ __('Категория') }}:
            </dt>
            <dd class="col-sm-9">
                {{ $product->category->name }}
            </dd>
            <dt class="col-sm-3">
                {{ __('Описание товара') }}:
            </dt>
            <dd class="col-sm-9">
                {!! $product->description !!}
            </dd>
            <dt class="col-sm-3">
                {{ __('Отзывы о товаре') }}:
            </dt>
            <dd class="col-sm-9">
                <x-button-link href="{{ route('products.comments', $product->id) }}">
                    {{ __('Посмотреть отзывы') }}
                </x-button-link>
            </dd>
        </dl>

        <x-button-link href="{{ route('cart.add', $product->id) }}" class="text-center" role="button" color="warning">
            {{ __('В корзину') }}
        </x-button-link>
    </div>

@endsection
