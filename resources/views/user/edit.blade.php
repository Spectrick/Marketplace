@extends('layouts.auth')

@section('page.title', 'Учётная запись')

@section('auth.content')
    <x-card>
        <x-card-header>
            <x-card-title>
                {{ __('Учётная запись') }}
            </x-card-title>

            <x-slot name="right">
                <a href="{{ route('user') }}">
                    {{ __('Назад') }}
                </a>
            </x-slot>
        </x-card-header>

        <x-card-body>
            @include('includes.errors')
            <x-form action="{{ route('user.update', $user->id) }}" method="put" enctype="multipart/form-data">
                <x-form-item>
                    <x-label>{{ __('Имя пользователя') }}</x-label>
                    <x-input name="name" value="{{ $user->name ?? '' }}" autofocus />
                </x-form-item>

                <x-form-item>
                    <x-label>{{ __('E-mail') }}</x-label>
                    <x-input type="email" name="email" value="{{ $user->email ?? '' }}" />
                </x-form-item>

                <x-form-item>
                    <div class="input-group">
                        <label class="input-group-text" for="avatar">{{ __('Изображение пользователя') }}</label>
                        <input type="file" class="form-control" id="avatar" name="avatar" />
                    </div>
                    @error('avatar')
                        <span class="invalid-feedback" role="alert">
                            <strong>{{ $message }}</strong>
                        </span>
                    @enderror
                    <div class="avatar col text-center mt-3">
                        @if($user->avatar)
                            <img src="{{ $user->avatar }}" alt="{{ $user->name }}">
                        @else
                            {{ __('Изображение отсутствует') }}
                        @endif
                    </div>
                </x-form-item>

                <x-form-item>
                    <x-label>{{ __('Старый пароль') }}</x-label>
                    <x-input type="password" name="old_password" />
                </x-form-item>

                <x-form-item>
                    <x-label>{{ __('Новый пароль') }}</x-label>
                    <x-input type="password" name="new_password" />
                </x-form-item>

                <x-form-item>
                    <x-label>{{ __('Введите новый пароль ещё раз') }}</x-label>
                    <x-input type="password" name="new_password_confirmation" />
                </x-form-item>

                <div class="text-center">
                    <x-button type="submit">
                        {{ __('Сохранить изменения') }}
                    </x-button>
                </div>

            </x-form>
        </x-card-body>
    </x-card>
@endsection
