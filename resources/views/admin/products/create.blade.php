@extends('layouts.main')

@section('page.title', 'Админ панель: Добавление товара')

@section('main.content')

    <x-title>
        {{ __('Админ панель: Добавление товара') }}

        <x-slot name="link">
            <a href="{{ route('admin.products') }}">
                {{ __('Назад') }}
            </a>
        </x-slot>
    </x-title>

    @include('includes.errors')

    <x-product.form action="{{ route('admin.products.store') }}" method="POST" enctype="multipart/form-data" :categories="$categories">
        <x-button type="submit">
            {{ __('Добавить товар') }}
        </x-button>
    </x-product.form>

@endsection
