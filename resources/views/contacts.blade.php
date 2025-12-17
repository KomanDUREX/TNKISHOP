@extends('layouts.app')

@section('title', $title ?? 'Контакти — Tankist Store')
@section('meta', $meta ?? 'Зв’яжіться з нами: email, Telegram, Discord. Форма зворотного зв’язку.')

@section('content')
    <section class="section">
        <div class="container narrow">
            <p class="eyebrow">Контакти</p>
            <h1>Підтримка танкістів 24/7</h1>
            <p class="muted">Напишіть нам у зручному каналі або залиште повідомлення через форму.</p>

            <div class="contact-grid">
                <div class="contact-card" data-reveal>
                    <p class="feature__title">Email</p>
                    <p class="muted">support@tankist.store</p>
                </div>
                <div class="contact-card" data-reveal>
                    <p class="feature__title">Telegram</p>
                    <p class="muted">@tankist_support</p>
                </div>
                <div class="contact-card" data-reveal>
                    <p class="feature__title">Discord</p>
                    <p class="muted">tankist.store#7777</p>
                </div>
            </div>

            <form class="contact-form" method="POST" action="{{ route('contact.send') }}" data-reveal>
                @csrf
                <label>
                    <span>Ім’я</span>
                    <input type="text" name="name" value="{{ old('name') }}" required>
                    @error('name')
                        <span class="form-error">{{ $message }}</span>
                    @enderror
                </label>
                <label>
                    <span>Email</span>
                    <input type="email" name="email" value="{{ old('email') }}" required>
                    @error('email')
                        <span class="form-error">{{ $message }}</span>
                    @enderror
                </label>
                <label>
                    <span>Повідомлення</span>
                    <textarea name="message" rows="4" required>{{ old('message') }}</textarea>
                    @error('message')
                        <span class="form-error">{{ $message }}</span>
                    @enderror
                </label>
                <button type="submit" class="btn btn--primary">Надіслати</button>
                @if (session('submitted'))
                    <p class="muted">Дякуємо, ми вже працюємо над вашим запитом.</p>
                @endif
            </form>
        </div>
    </section>
@endsection
