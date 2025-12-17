@extends('layouts.app')

@section('title', $title ?? 'Про нас — Tankist Store')
@section('meta', $meta ?? 'Довіра, швидкість та підтримка — наші принципи для гравців WoT і Blitz.')

@section('content')
    <section class="section">
        <div class="container narrow">
            <p class="eyebrow">Про нас</p>
            <h1>Tankist Store — магазин, створений гравцями</h1>
            <p class="lead">Ми — команда ентузіастів World of Tanks і WoT Blitz. Наша мета — спростити шлях до топової техніки та комфортної гри: підібрати акаунт, швидко доставити золото чи срібло, захистити угоду.</p>

            <div class="bullet-grid">
                <div data-reveal>
                    <p class="feature__title">Що робимо</p>
                    <ul class="muted">
                        <li>Готуємо акаунти з перевіреними даними та історією.</li>
                        <li>Поповнюємо золото/срібло офіційними каналами.</li>
                        <li>Допомагаємо з підбором танків і екіпажів під рейтинги.</li>
                    </ul>
                </div>
                <div data-reveal>
                    <p class="feature__title">Гарантії</p>
                    <ul class="muted">
                        <li>Прозорі чеки та скріншоти передачі.</li>
                        <li>Супровід менеджера і чат підтримки 24/7.</li>
                        <li>Конфіденційність даних і дотримання правил ігор.</li>
                    </ul>
                </div>
            </div>

            <div class="callout" data-reveal>
                <p class="feature__title">Для кого сайт</p>
                <p class="muted">Для гравців, які хочуть швидше отримати топову техніку, вийти в рейтинг або зібрати колекцію преміум танків без ризику бану.</p>
            </div>
        </div>
    </section>
@endsection
