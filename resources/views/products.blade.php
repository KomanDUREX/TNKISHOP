@extends('layouts.app')

@section('title', $title ?? 'Товари — Tankist Store')
@section('meta', $meta ?? 'Каталог акаунтів, золота та срібла World of Tanks і Blitz.')

@section('content')
    <section class="section">
        <div class="container section__head">
            <div>
                <p class="eyebrow">Усі товари</p>
                <h1>Акаунти, золото та срібло</h1>
                <p class="muted">Мінімум 6 карток з реальними параметрами. Обирайте, додавайте в кошик або в улюблені.</p>
            </div>
            <a class="btn btn--primary" href="{{ route('cart') }}">Перейти в кошик</a>
        </div>
        <div class="container cards-grid">
            @foreach ($products as $product)
                @include('components.product-card', ['product' => $product])
            @endforeach
        </div>
        <div class="container" style="margin-top:1rem;">
            @if ($products instanceof \Illuminate\Pagination\AbstractPaginator)
                {{ $products->links() }}
            @endif
        </div>
    </section>
@endsection
