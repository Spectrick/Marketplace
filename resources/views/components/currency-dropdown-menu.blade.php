<div class="col-lg-12 col-sm-12 col-12 main-section">
    <div class="dropdown">
        <x-button data-bs-toggle="dropdown" color="success">
            <i class="fa fa-money" aria-hidden="true"></i>
            {{ App\Models\Currency::query()->where('id', session('currency'))->value('name') }}
        </x-button>
        <div class="dropdown-menu pb-2">
            <div class="row">
                <div class="col-lg-12 col-sm-12 col-12 text-center">
                    <div class="mb-2">
                        {{ __('Выберите тип валюты') }}:
                    </div>
                    <x-form action="{{ route('currency.change') }}" method="POST">
                        <x-select name="currency" value="{{ request('currency') }}" class="text-center">
                            @foreach(App\Models\Currency::query()->select('id', 'name')->get() as $currency)
                                <option value="{{ $currency->id }}" {{ (session('currency') == $currency->id ? 'selected' : '') }}>
                                    {{ $currency->name . ' [' . $currency->id . ']' }}
                                </option>
                            @endforeach
                        </x-select>
                        <x-button type="submit" color="success" size="block" class="mt-4 mb-0">
                            {{ __('Изменить') }}
                        </x-button>
                    </x-form>
                </div>
            </div>
        </div>
    </div>
</div>
