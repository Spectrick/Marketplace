<div class="col-lg-12 col-sm-12 col-12 main-section">
    <div class="dropdown">
        <x-button data-bs-toggle="dropdown" color="warning">
            <i class="fa fa-shopping-cart" aria-hidden="true"></i> {{ __('Корзина') }}
            <span class="badge text-bg-danger">
                {{ count((array) session('cart')) }}
            </span>
        </x-button>
        <div class="dropdown-menu">
            <div class="row total-header-section">
                <div class="col-lg-6 col-sm-6 col-6">
                    <i class="fa fa-shopping-cart" aria-hidden="true"></i>
                    <span class="badge text-bg-danger">
                        {{ count((array) session('cart')) }}
                    </span>
                </div>
                @php
                    $total = 0
                @endphp
                @foreach((array) session('cart') as $id => $details)
                    @php
                        $total += $details['price'] * $details['quantity']
                    @endphp
                @endforeach
                <div class="col-lg-6 col-sm-6 col-6 total-section text-right">
                    <p>{{ __('Всего') }}:
                        <span class="text-info">
                            {{ $total }} {{ session('currency') }}
                        </span>
                    </p>
                </div>
            </div>
            @if(session('cart'))
                @foreach(session('cart') as $id => $details)
                    <div class="row cart-detail">
                        <div class="col-lg-4 col-sm-4 col-4 cart-detail-img">
                            <img src="{{ $details['image'] }}" />
                        </div>
                        <div class="col-lg-8 col-sm-8 col-8 cart-detail-product">
                            <p>
                                {{ $details['name'] }}
                            </p>
                            <span class="price text-info">
                                {{ $details['price'] }} {{ session('currency') }}
                            </span>
                            <span class="count">
                                {{ __('Количество') }}: {{ $details['quantity'] }}
                            </span>
                        </div>
                    </div>
                @endforeach
            @endif
            <div class="row">
                <div class="col-lg-12 col-sm-12 col-12 text-center checkout">
                    <x-button-link href="{{ route('cart') }}" color="warning" size="block">
                        {{ __('Перейти к корзине') }}
                    </x-button-link>
                </div>
            </div>
        </div>
    </div>
</div>
