@extends('layouts.main')

@section('page.title', 'Ошибка: страница не найдена')

@section('main.content')
    <table style="height: 600px; margin: auto;">
        <td class="align-middle text-center">
            <div class="text-center">
                <h2>{{ __('Ошибка 404: Страница не найдена') }}</h2>
            </div>
        </td>
    </table>

@endsection
