@props(['prefix' => null, 'product' => null])
<x-card>
    <img src="{{ $product->images()->value('thumbnail') }}" alt="{{ $product->name }}">
    <div class="card-body d-flex justify-content-end flex-column pt-1">
        <div class="text-light badge bg-primary text-wrap my-2 align-self-start">
            <h6 class="mb-0">
                {{ $product->price }} ₽
            </h6>
        </div>
        <h5 class="card-title mb-0">
            <a href="{{ route($prefix.'products.show', $product->id) }}">
                {{ $product->name }}
            </a>
        </h5>
        {{--<p class="card-text">
            {!! $product->description !!}
        </p>--}}
        @if (!$product->published)
            <div class="small text-muted">
                {{ __('(Не опубликовано)') }}
            </div>
        @endif
        <x-button-link href="{{ route('cart.add', $product->id) }}" class="text-center text-decoration-none" role="button" color="warning" size="block">
            {{ __('В корзину') }}
        </x-button-link>
    </div>
</x-card>
