@extends('layouts.main')

@section('page.title', 'Админ панель: Просмотр товара')

@section('main.content')

    <x-title>
        {{ __('Просмотр товара') }}

        <x-slot name="right">
            <x-button-link href="{{ route('admin.products.edit', $product->id) }}" size="sm">
                {{ __('Редактировать') }}
            </x-button-link>
        </x-slot>

        <x-slot name="right_2">
            <x-form action="{{ route('admin.products.delete', $product->id) }}" method="post">
                @method('DELETE')
                <x-button type="submit" color="secondary" size="sm">
                    {{ __('Удалить') }}
                </x-button>
            </x-form>
        </x-slot>

        <x-slot name="link">
            <a href="{{ route('admin.products') }}">
                {{ __('Назад') }}
            </a>
        </x-slot>

    </x-title>
    <div class="container" style="max-width: 960px">
        <div class="mb-3">
            <h3 class="fw-bolder">
                {{ $product->name }}
            </h3>

            @if($product->images->url)
                <x-gallery class="text-center" :product="$product" />
            @endif

            <dl class="row mt-3">
                <dt class="col-sm-3">
                    {{ __('Цена') }}:
                </dt>
                <dd class="col-sm-9">
                    <div class="text-light badge bg-primary text-wrap my-2 align-self-start">
                        <h6 class="mb-0">
                            {{ $product->price }} {{ session('currency') }}
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
                    {{ __('Оценка пользователей') }}:
                </dt>
                <dd class="col-sm-9">
                    <x-product.rating class="justify-content-center" :productRating="$productRating" />
                </dd>
                <dt class="col-sm-3">
                    {{ __('Отзывы о товаре') }}:
                </dt>
                <dd class="col-sm-9 text-center">
                    <x-button-link href="{{ route('admin.products.comments', $product->id) }}">
                        {{ __('Посмотреть отзывы') }}
                    </x-button-link>
                </dd>
            </dl>

            @if (!$product->published)
                <div class="small text-muted">
                    {{ __('(Не опубликовано)') }}
                </div>
            @endif

            <x-button-link href="{{ route('cart.add', $product->id) }}" class="text-center" role="button" color="warning">
                {{ __('В корзину') }}
            </x-button-link>
        </div>
    </div>
@endsection
