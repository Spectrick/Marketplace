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
                    <x-label required>{{ __('Имя пользователя') }}</x-label>
                    <x-input name="name" value="{{ $user->name ?? '' }}" autofocus />
                </x-form-item>

                <x-form-item>
                    <x-label required>{{ __('E-mail') }}</x-label>
                    <x-input type="email" name="email" value="{{ $user->email ?? '' }}" />
                </x-form-item>

                <x-form-item>
                    <x-label for="avatar" class="col-md-4 col-form-label text-md-end">{{ __('Изображение пользователя') }}</x-label>
                    <div class="col-md-6">
                        <x-input id="avatar" type="file" name="avatar" />
                        @error('avatar')
                        <span class="invalid-feedback" role="alert">
                                <strong>{{ $message }}</strong>
                            </span>
                        @enderror
                    </div>
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
