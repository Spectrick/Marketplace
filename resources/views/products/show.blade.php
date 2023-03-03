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
            @foreach($images_url as $image_url)
                @if(str_starts_with($image_url, 'http'))
                    <img src="{{ $image_url }}" alt="{{ $product->name }}" class="img-fluid mb-3">
                @else
                    <img src="{{ '/storage/'.$image_url }}" alt="{{ $product->name }}" class="img-fluid mb-3">
                @endif
            @endforeach
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
            <div class="pt-2">
                {!! $product->description !!}
            </div>
        </div>

        @if (!$product->published)
            <div class="small text-muted">
                {{ __('(Не опубликовано)') }}
            </div>
        @endif
        <x-button-link href="{{ route('cart.add', $product->id) }}" class="text-center" role="button" color="warning">
            {{ __('В корзину') }}
        </x-button-link>
    </div>

@endsection
