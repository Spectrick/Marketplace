@props(['color' => 'primary', 'size' => ''])

<a {{ $attributes }}>
    <x-button color="{{ $color }}" size="{{ $size }}">
        {{ $slot }}
    </x-button>
</a>
