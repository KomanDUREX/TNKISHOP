@extends('layouts.app')

@section('title', $title ?? 'Улюблені товари — Tankist Store')
@section('meta', $meta ?? 'Обране: акаунти, золото та срібло для WoT і Blitz.')

@section('content')
    <section class="section" data-reveal>
        <div class="container section__head">
            <div>
                <p class="eyebrow">Улюблені</p>
                <h1>Ваші обрані позиції</h1>
                <p class="muted">Тут зберігаються товари, додані через кнопку “В улюблені”.</p>
            </div>
            <div class="gap-sm">
                <form action="{{ route('favorites.clear') }}" method="POST">
                    @csrf
                    <button class="btn btn--ghost" type="submit">Очистити список</button>
                </form>
            </div>
        </div>

        <div class="container">
            @if (count($products))
                <div class="cards-grid favorites-grid">
                    @foreach ($products as $product)
                        <div class="favorite-card" data-reveal>
                            @include('components.product-card', ['product' => $product, 'compact' => true])
                            <form action="{{ route('favorites.remove', $product['id']) }}" method="POST" class="favorite-card__remove">
                                @csrf
                                <button class="btn btn--ghost btn--danger" type="submit">Видалити з улюбленого</button>
                            </form>
                        </div>
                    @endforeach
                </div>
            @else
                <div class="empty" data-reveal>
                    <p>Список улюблених порожній. Додайте товари з каталогу.</p>
                    <a class="btn btn--primary" href="{{ route('catalog') }}">Перейти до каталогу</a>
                </div>
            @endif
        </div>
    </section>
@endsection
