@props(['product' => null, 'categories' => []])

<div class="container" style="max-width: 960px">
    <x-form {{ $attributes }}>

        <x-form-item>
            <x-label required>
                {{ __('Название товара') }}
            </x-label>
            <x-input name="name" value="{{ $product->name ?? '' }}" autofocus />
        </x-form-item>

        <x-form-item>
            <x-label required>
                {{ __('Цена товара') }}
            </x-label>
            <x-input name="price" value="{{ $product->price ?? '' }}" />
        </x-form-item>

        <x-form-item>
            <x-label required>
                {{ __('Описание товара') }}
            </x-label>
            <x-trix name="description" value="{{ $product->description ?? '' }}" />
        </x-form-item>

        <x-form-item>
            <x-label required>
                {{ __('Категория товара') }}
            </x-label>
            <x-select name="category_id" value="{{ $product->category->id ?? '' }}" :options="$categories" />
        </x-form-item>

        <x-form-item>
            <x-label required for="images[]">
                {{ __('Изображения') }}
            </x-label>
            <x-input type="file" name="images[]" multiple />
        </x-form-item>

        @if($product)
            <x-gallery class="text-center" :product="$product" />
        @endif

        <x-form-item>
            <x-checkbox name="published">
                {{ __('Опубликовать') }}
            </x-checkbox>
        </x-form-item>

        {{ $slot }}

    </x-form>
</div>
