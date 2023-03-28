@extends('layouts.auth')

@section('page.title', __('Учётная запись') . ': ' . $user->name)

@section('auth.content')
    <x-card>
        <x-card-header>
            <x-card-title>
                {{ __('Учётная запись') }}
            </x-card-title>

            <x-slot name="right">
                <a href="{{ route('home') }}">
                    {{ __('Назад') }}
                </a>
            </x-slot>
        </x-card-header>

        <x-card-body>
            <x-form-item>
                <div class="row justify-content-between border-bottom mx-3">
                    <div class="col">
                        {{ __('Имя пользователя')}}:
                    </div>
                    <div class="col">
                        {{ $user->name }}
                    </div>
                </div>
            </x-form-item>

            <x-form-item>
                <div class="row justify-content-between border-bottom mx-3">
                    <div class="col">
                        {{ __('Email пользователя') }}:
                    </div>
                    <div class="col">
                        {{ $user->email }}
                    </div>
                </div>
            </x-form-item>

            <x-form-item>
                <div class="row justify-content-between mx-3">
                    <div class="col my-auto">
                        {{ __('Изображение пользователя') }}:
                    </div>
                    <div class="avatar col text-center">
                        @if($user->avatar)
                            <img src="{{ $user->avatar }}" alt="{{ $user->name }}">
                        @else
                            {{ __('Изображение отсутствует') }}
                        @endif
                    </div>
                </div>
            </x-form-item>

            <div class="text-center">
                <x-button-link href="{{ route('user.edit', $user->id) }}">
                    {{ __('Внести изменения') }}
                </x-button-link>
            </div>

        </x-card-body>
    </x-card>
@endsection
