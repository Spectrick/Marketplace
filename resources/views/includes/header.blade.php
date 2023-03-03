<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <x-container>
        <a href="{{ route('home') }}" class="navbar-brand">
            {{ config('app.name') }}
        </a>
        <button type="button" class="navbar-toggler" data-toggle="collapse" data-target="#navbar-collapse" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbar-collapse">
            <ul class="navbar-nav mr-auto">
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

            <ul class="navbar-nav ml-auto">
                @auth
                    <li class="nav-item">
                        <x-cart-dropdown-menu />
                    </li>
                    <li class="nav-item">
                        <div class="row mx-auto mt-2">
                            <div class="col-xs-6">
                                <img src="{{ Auth::user()->avatar }}" class="img-thumbnail" width="40px" alt="{{ Auth::user()->name }}">
                            </div>
                            <div class="col-xs-6">
                                <a href="{{ route('logout') }}" class="nav-link">
                                    {{ Auth::user()->name }}
                                </a>
                            </div>
                        </div>
                    </li>
                    <li class="nav-item my-auto">
                        <x-form id="logout-form" action="{{ route('logout') }}" method="GET">
                            <x-button type="submit" color="secondary">
                                {{ __('Выйти') }}
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
