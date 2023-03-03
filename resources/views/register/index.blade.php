@extends('layouts.auth')

@section('page.title', 'Регистрация')

@section('auth.content')
    <x-card>
        <x-card-header>
            <x-card-title>
                {{ __('Регистрация') }}
            </x-card-title>

            <x-slot name="right">
                <a href="{{ route('login') }}">
                    {{ __('Вход') }}
                </a>
            </x-slot>
        </x-card-header>

        <x-card-body>
            @include('includes.errors')
            <x-form action="{{ route('register.store') }}" method="POST" enctype="multipart/form-data">
                <x-form-item>
                    <x-label required>{{ __('Имя пользователя') }}</x-label>
                    <x-input name="name" autofocus />
                </x-form-item>

                <x-form-item>
                    <x-label required>{{ __('E-mail') }}</x-label>
                    <x-input type="email" name="email" />
                </x-form-item>

                <x-form-item>
                    <x-label required>{{ __('Пароль') }}</x-label>
                    <x-input type="password" name="password" />
                </x-form-item>

                <x-form-item>
                    <x-label required>{{ __('Введите пароль ещё раз') }}</x-label>
                    <x-input type="password" name="password_confirmation" />
                </x-form-item>

                <x-form-item>
                    <x-label for="avatar" class="col-md-4 col-form-label text-md-end">{{ __('Аватар') }}</x-label>
                    <div class="col-md-6">
                        <x-input id="avatar" type="file" name="avatar" />
                        @error('avatar')
                            <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
                </x-form-item>


                <x-form-item>
                    <x-checkbox name="agreement">
                        {{ __('Я согласен на обработку персональных данных') }}
                    </x-checkbox>
                </x-form-item>

                <div class="text-center">
                    <x-button type="submit">
                        {{ __('Зарегистрироваться') }}
                    </x-button>
                </div>

            </x-form>
        </x-card-body>
    </x-card>
@endsection
