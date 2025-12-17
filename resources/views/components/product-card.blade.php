@props(['product', 'compact' => false])

@php
    $typeClasses = [
        'account' => 'pill--account',
        'gold' => 'pill--gold',
        'silver' => 'pill--silver',
        'bundle' => 'pill--bundle',
    ];
    $includes = collect($product['includes'] ?? [])->filter()->map(fn ($item) => mb_convert_encoding((string) $item, 'UTF-8', 'UTF-8'))->values()->all();
    $includesJson = json_encode($includes, JSON_UNESCAPED_UNICODE);
@endphp

<article
    class="product-card {{ $compact ? 'product-card--compact' : '' }}"
    data-reveal
    data-product
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
    <div class="product-card__header">
        <div class="product-card__tags">
            <span class="pill pill--type {{ $typeClasses[$product['type']] ?? '' }}">{{ strtoupper($product['type']) }}</span>
            <span class="pill pill--game">{{ $product['game'] === 'blitz' ? 'Blitz' : 'WoT' }}</span>
        </div>
        @if (!empty($product['badge']))
            <span class="pill pill--badge">{{ $product['badge'] }}</span>
        @endif
    </div>

    <div class="product-card__body">
        <p class="product-card__title">{{ $product['title'] }}</p>
        <p class="product-card__desc">{{ $product['description'] }}</p>
        <ul class="product-card__features">
            @foreach ($includes as $item)
                <li>{{ $item }}</li>
            @endforeach
        </ul>
    </div>

    <div class="product-card__footer">
        <div class="product-card__price">
            <p class="price">{{ number_format($product['price'], 0, '', ' ') }} грн</p>
            <p class="muted">Миттєва передача та підтримка</p>
        </div>
        <div class="product-card__actions">
            <form action="{{ route('cart.add', $product['id']) }}" method="POST">
                @csrf
                <button type="submit" class="btn btn--primary">Додати в кошик</button>
            </form>
            <form action="{{ route('favorites.add', $product['id']) }}" method="POST">
                @csrf
                <button type="submit" class="btn btn--ghost" aria-label="Додати в улюблені">
                    <span>В улюблені</span>
                </button>
            </form>
        </div>
    </div>
</article>
