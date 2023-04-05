@props(['product' => null])
<x-card>
    <a href="{{ (isAdmin(Auth::user()) ? route('admin.products.show', $product->id) : route('products.show', $product->id)) }}">
        <img src="{{ $product->images()->value('thumbnail') }}" class="w-100" alt="{{ $product->name }}">
    </a>
    <div class="card-body d-flex justify-content-end flex-column pt-1">
        <div class="text-light badge bg-primary text-wrap my-2 align-self-start">
            <h6 class="mb-0">
                {{ $product->price }} {{ session('currency') }}
            </h6>
        </div>
        <h6 class="card-title text-truncate">
            <a href="{{ (isAdmin(Auth::user()) ? route('admin.products.show', $product->id) : route('products.show', $product->id)) }}">
                {{ $product->name }}
            </a>
        </h6>
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
