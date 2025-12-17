<header class="site-header">
    <div class="container header__inner">
        <div class="brand">
            <svg width="36" height="36" viewBox="0 0 64 64" aria-hidden="true" focusable="false">
                <path d="M8 26h14l6-10h8l6 10h14l-4 14-16 14h-8L12 40z" fill="url(#metal)"></path>
                <circle cx="32" cy="32" r="9" stroke="#fcbf49" stroke-width="3" fill="none"></circle>
                <path d="M32 19v26M19 32h26" stroke="#fcbf49" stroke-width="3" stroke-linecap="round"></path>
                <defs>
                    <linearGradient id="metal" x1="8" y1="16" x2="56" y2="48" gradientUnits="userSpaceOnUse">
                        <stop stop-color="#1e2533" />
                        <stop offset="1" stop-color="#3a4559" />
                    </linearGradient>
                </defs>
            </svg>
            <div>
                <p class="brand__title">Tankist Store</p>
                <p class="brand__subtitle">WoT & WoT Blitz</p>
            </div>
        </div>

        <nav class="site-nav">
            <a href="{{ route('home') }}" class="{{ request()->routeIs('home') ? 'is-active' : '' }}">Головна</a>
            <a href="{{ route('products') }}" class="{{ request()->routeIs('products') ? 'is-active' : '' }}">Товари</a>
            <a href="{{ route('catalog') }}" class="{{ request()->routeIs('catalog') ? 'is-active' : '' }}">Каталог</a>
            <a href="{{ route('favorites') }}" class="{{ request()->routeIs('favorites') ? 'is-active' : '' }}">Улюблені</a>
            <a href="{{ route('cart') }}" class="{{ request()->routeIs('cart') ? 'is-active' : '' }}">Кошик</a>
            <a href="{{ route('about') }}" class="{{ request()->routeIs('about') ? 'is-active' : '' }}">Про нас</a>
            <a href="{{ route('contacts') }}" class="{{ request()->routeIs('contacts') ? 'is-active' : '' }}">Контакти</a>
        </nav>

        <div class="header__actions">
            @guest
                <a class="btn btn--ghost btn--sm" href="{{ route('login') }}">Увійти</a>
                <a class="btn btn--primary btn--sm" href="{{ route('register') }}">Реєстрація</a>
            @else
                @if(auth()->user()->is_admin)
                    <a class="btn btn--ghost btn--sm" href="{{ route('admin.dashboard') }}">Адмін-панель</a>
                @endif
                <a class="btn btn--ghost btn--sm" href="{{ route('profile') }}">Профіль</a>
                <form action="{{ route('logout') }}" method="POST" class="logout-form">
                    @csrf
                    <button type="submit" class="btn btn--primary btn--sm">Вийти</button>
                </form>
            @endguest
        </div>

        <button class="menu-toggle" type="button" aria-label="Меню" data-menu-toggle>
            <span></span>
            <span></span>
            <span></span>
        </button>
    </div>
</header>
