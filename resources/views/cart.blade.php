@extends('layouts.app')

@section('title', $title ?? 'Кошик - Tankist Store')
@section('meta', $meta ?? 'Перевірте товари перед оформленням: WoT та WoT Blitz.')

@section('content')
    <section class="section" data-reveal>
        <div class="container section__head">
            <div>
                <p class="eyebrow">Кошик</p>
                <h1>Оформлення замовлення</h1>
                <p class="muted">Перегляньте вибрані товари. Підрахунок суми виконується статично на основі корзини.</p>
            </div>
            <a class="btn btn--ghost" href="{{ route('catalog') }}">Повернутись до каталогу</a>
        </div>

        <div class="container">
            @if (count($products))
                <form method="POST" action="{{ route('cart.checkout') }}" class="cart-list">
                    @csrf
                    @foreach ($products as $product)
                        @php
                            $includes = collect($product['includes'] ?? [])->filter()->map(fn ($item) => mb_convert_encoding((string) $item, 'UTF-8', 'UTF-8'))->values()->all();
                            $includesJson = json_encode($includes, JSON_UNESCAPED_UNICODE);
                        @endphp
                        <div class="cart-item" data-reveal data-product
                             data-id="{{ $product['id'] }}"
                             data-title="{{ $product['title'] }}"
                             data-desc="{{ $product['description'] }}"
                             data-price="{{ number_format($product['price'], 0, '', ' ') }} грн"
                             data-includes="{{ $includesJson }}"
                             data-type="{{ $product['type'] }}"
                             data-game="{{ $product['game'] }}"
                             @if (!empty($product['badge'])) data-badge="{{ $product['badge'] }}" @endif
                             data-cart-action="{{ route('cart.add', $product['id']) }}"
                             data-fav-action="{{ route('favorites.add', $product['id']) }}"
                        >
                            <div class="cart-item__select">
                                <input type="checkbox" name="selected[]" value="{{ $product['id'] }}" checked>
                            </div>
                            <div class="cart-item__info">
                                <p class="cart-item__title">{{ $product['title'] }}</p>
                                <p class="muted">{{ $product['description'] }}</p>
                                <div class="cart-item__controls">
                                    <form action="{{ route('cart.update', $product['id']) }}" method="POST" class="cart-qty-form">
                                        @csrf
                                        <label>К-сть:
                                            <input type="number" name="qty" value="{{ $product['qty'] }}" min="1" max="99">
                                        </label>
                                        <button type="submit" class="btn btn--ghost btn--sm">Оновити</button>
                                    </form>
                                    <button type="button" class="btn btn--ghost btn--sm">Деталі</button>
                                </div>
                            </div>
                            <div class="cart-item__sum">
                                <span>{{ number_format($product['line_total'], 0, '', ' ') }} грн</span>
                                <form action="{{ route('cart.remove', $product['id']) }}" method="POST">
                                    @csrf
                                    <button class="btn btn--ghost btn--danger" type="submit">Видалити</button>
                                </form>
                            </div>
                        </div>
                    @endforeach

                    <div class="checkout" data-reveal>
                        <div>
                            <p class="muted">Загальна сума</p>
                            <p class="price price--xl">{{ number_format($total, 0, '', ' ') }} грн</p>
                        </div>
                        <button type="submit" class="btn btn--primary">Оформити замовлення</button>
                    </div>
                </form>
            @else
                <div class="empty" data-reveal>
                    <p>Кошик порожній. Додайте товари та поверніться.</p>
                    <a class="btn btn--primary" href="{{ route('products') }}">До товарів</a>
                </div>
            @endif
        </div>
    </section>
@endsection
