@extends('layouts.main')

@section('page.title', 'Marketplace')

@section('main.content')
    <div class="text-center mt-3">
        <h1 class="mb-3">
            {{ __('Добро пожаловать в Marketplace!') }}
        </h1>
        <x-button-link href="{{route('products')}}">
            {{ __('Перейти в каталог') }}
        </x-button-link>
    </div>

    <div class="col-md-4">
        <h2>
            {{ __('') }}
        </h2>
    </div>
    <div class="col-md-4">
        <h2>
            {{ __('') }}
        </h2>
    </div>
    <div class="col-md-4">
        <h2>
            {{ __('') }}
        </h2>
    </div>
@endsection
