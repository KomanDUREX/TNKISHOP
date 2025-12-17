@extends('layouts.app')

@section('title', $title ?? 'Каталог — фільтрація WoT / Blitz')
@section('meta', $meta ?? 'Фільтруйте акаунти та валюту для World of Tanks і Blitz за типом, грою та ціною.')

@section('content')
    <section class="section">
        <div class="container section__head">
            <div>
                <p class="eyebrow">Каталог</p>
                <h1>Фільтруй і знаходь своє</h1>
                <p class="muted">Тип товару, гра та максимальна ціна — фільтрація на рівні контролера.</p>
            </div>
            <a class="btn btn--ghost" href="{{ route('products') }}">Усі товари</a>
        </div>

        <div class="container filter-panel" data-reveal>
            <form method="GET" action="{{ route('catalog') }}" class="filters">
                <label>
                    <span>Тип товару</span>
                    <select name="type">
                        <option value="">Усі</option>
                        @foreach ($typeFilters ?? [] as $filter)
                            <option value="{{ $filter->slug }}" @selected(($filters['type'] ?? '') === $filter->slug)>{{ $filter->name }}</option>
                        @endforeach
                    </select>
                </label>
                <label>
                    <span>Гра</span>
                    <select name="game">
                        <option value="">Усі</option>
                        @foreach ($gameFilters ?? [] as $filter)
                            <option value="{{ $filter->slug }}" @selected(($filters['game'] ?? '') === $filter->slug)>{{ $filter->name }}</option>
                        @endforeach
                    </select>
                </label>
                <label>
                    <span>Макс. ціна (₴)</span>
                    <input type="number" name="price" value="{{ $filters['price'] ?? '' }}" placeholder="Наприклад, 2000">
                </label>
                <button type="submit" class="btn btn--primary">Застосувати</button>
            </form>
            <div class="filter__result">
                <p class="muted">Знайдено: <strong>{{ $products->total() }}</strong> позицій</p>
                <a href="{{ route('catalog') }}" class="btn btn--ghost">Скинути</a>
            </div>
        </div>

        <div class="container cards-grid">
            @forelse ($products as $product)
                @include('components.product-card', ['product' => $product, 'compact' => true])
            @empty
                <div class="empty" data-reveal>
                    <p>За вибраними фільтрами немає товарів. Спробуйте змінити умови.</p>
                    <a class="btn btn--ghost" href="{{ route('products') }}">Перейти до всіх товарів</a>
                </div>
            @endforelse
        </div>
        <div class="container" style="margin-top:1rem;">
            @if ($products instanceof \Illuminate\Pagination\AbstractPaginator)
                {{ $products->links() }}
            @endif
        </div>
    </section>
@endsection
