<x-form action="{{ route('products') }}" method="GET">
    <div class="row">
        <div class="col-12 col-md-4">
            <div class="mb-3">
                <x-input name="search" value="{{ request('search') }}" placeholder=" {{ __('Поиск') }}" />
            </div>
        </div>

        <div class="col-12 col-md-4">
            <div class="mb-3">
                <x-select name="category_id" value="{{ request('category_id') }}" :options="$categories">
                    <option value="" selected>
                        {{ __('Все товары') }}
                    </option>
                </x-select>
            </div>
        </div>

        <div class="col-12 col-md-4">
            <div class="mb-3">
                <x-button type="submit" class="w-100 mt-0">
                    {{ __('Применить') }}
                </x-button>
            </div>
        </div>
    </div>
</x-form>
