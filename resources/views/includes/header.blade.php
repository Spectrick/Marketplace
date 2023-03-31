<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <x-container>
        <a href="{{ route('home') }}" class="navbar-brand">
            {{ config('app.name') }}
        </a>
        <button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#navbar-collapse" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbar-collapse">
            <ul class="navbar-nav me-auto">
                <li class="nav-item">
                    <a href="{{ route('home') }}" class="nav-link {{ activeLink('home') }}">
                        {{ __('Главная') }}
                    </a>
                </li>

                <li class="nav-item">
                    <a href="{{ (isAdmin(Auth::user())) ? route('admin.products') : route('products') }}" class="nav-link {{ activeLink('admin.products') }}">
                        {{ __('Товары') }}
                    </a>
                </li>
            </ul>

            <ul class="navbar-nav ms-auto">
                @auth
                    <li class="nav-item my-auto">
                        <x-cart-dropdown-menu />
                    </li>
                    <li class="nav-item my-auto">
                        <div class="row mx-auto">
                            <div class="inline-block">
                                @if(Auth::user()->avatar)
                                    <img src="{{ Auth::user()->avatar }}" class="img-thumbnail" alt="{{ Auth::user()->name }}" style="height:38px">
                                @endif
                                <a href="{{ route('user') }}">
                                    {{ Auth::user()->name }}
                                </a>
                            </div>
                        </div>
                    </li>
                    <li class="nav-item my-auto">
                        <x-form id="logout-form" action="{{ route('logout') }}" method="GET">
                            <x-button class="border pb-1 pe-2" type="submit" color="light">
                                <i class="fa fa-sign-out" style="font-size:22px"></i>
                            </x-button>
                        </x-form>
                    </li>
                @else
                    <li class="nav-item">
                        <a href="{{ route('register') }}" class="nav-link {{ activeLink('register') }}">
                            {{ __('Регистрация') }}
                        </a>
                    </li>

                    <li class="nav-item">
                        <a href="{{ route('login') }}" class="nav-link {{ activeLink('login') }}">
                            {{ __('Вход') }}
                        </a>
                    </li>
                @endauth
            </ul>
        </div>
    </x-container>
</nav>
