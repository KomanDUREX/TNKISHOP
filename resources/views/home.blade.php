@extends('layouts.app')

@section('title', $title ?? 'Tankist Store - WoT & Blitz')
@section('meta', $meta ?? 'Магазин акаунтів, золота та срібла для World of Tanks і WoT Blitz.')

@section('content')
    <section class="hero" data-reveal>
        <div class="container hero__grid">
            <div>
                <p class="eyebrow">Онлайн-магазин для танкістів</p>
                <h1>Акаунти, золото та срібло для World of Tanks Blitz і WoT</h1>
                <p class="lead">Отримайте готові акаунти з топовою технікою або поповніть баланс за 15 хвилин. Гарантія безпеки та миттєва підтримка.</p>
                <div class="hero__actions">
                    <a class="btn btn--primary" href="{{ route('products') }}">Перейти до товарів</a>
                    <a class="btn btn--ghost" href="{{ route('catalog') }}">Відкрити каталог</a>
                </div>
                <div class="hero__stats">
                    <div>
                        <p class="stat__value">24/7</p>
                        <p class="muted">Підтримка</p>
                    </div>
                    <div>
                        <p class="stat__value">15 хв</p>
                        <p class="muted">Швидкість передачі</p>
                    </div>
                    <div>
                        <p class="stat__value">100%</p>
                        <p class="muted">Безпека угод</p>
                    </div>
                </div>
            </div>
            <div class="hero__panel" data-reveal>
                <div class="radar" aria-hidden="true">
                    <div class="radar__grid"></div>
                    <div class="radar__sweep"></div>
                    <div class="radar__blips">
                        <div class="radar__blip" style="--x: 72%; --y: 32%; --delay: 0s; --angle: -8deg;"></div>
                        <div class="radar__blip" style="--x: 32%; --y: 24%; --delay: 1.1s; --angle: 18deg;"></div>
                        <div class="radar__blip" style="--x: 58%; --y: 66%; --delay: 2.4s; --angle: -22deg;"></div>
                        <div class="radar__blip" style="--x: 26%; --y: 64%; --delay: 3.6s; --angle: -45deg;"></div>
                        <div class="radar__blip" style="--x: 50%; --y: 42%; --delay: 4.8s; --angle: 12deg;"></div>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="section">
        <div class="container section__head">
            <div>
                <p class="eyebrow">Популярне</p>
                <h2>Топ пропозиції тижня</h2>
                <p class="muted">Відбираємо найсвіжіші акаунти та вигідні пакети золота/срібла для WoT і WoT Blitz.</p>
            </div>
            <a class="btn btn--ghost" href="{{ route('products') }}">Дивитись усі</a>
        </div>
        <div class="container cards-grid cards-grid--home">
            @foreach ($products as $product)
                @include('components.product-card', ['product' => $product])
            @endforeach
        </div>
    </section>

    <section class="section section--striped">
        <div class="container feature-grid">
            <div class="feature" data-reveal>
                <div class="feature__icon">🛡️</div>
                <p class="feature__title">Підбір під ваш стиль</p>
                <p class="muted">Підбираємо акаунти та пакети валюти під турніри, рейтинги чи фан-гру.</p>
            </div>
            <div class="feature" data-reveal>
                <div class="feature__icon">✅</div>
                <p class="feature__title">Гарантії безпеки</p>
                <p class="muted">Передача через офіційні механіки, прозорі чеки, супровід менеджера.</p>
            </div>
            <div class="feature" data-reveal>
                <div class="feature__icon">⚡</div>
                <p class="feature__title">Швидка доставка</p>
                <p class="muted">Миттєві поповнення золота та срібла, акаунти з готовим екіпажем.</p>
            </div>
        </div>
    </section>
@endsection
