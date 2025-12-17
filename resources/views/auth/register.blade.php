@extends('layouts.app')

@section('title', 'Реєстрація - Tankist Store')

@section('content')
    <section class="section">
        <div class="container narrow">
            <div class="auth-card">
                <h1>Реєстрація</h1>
                <p class="muted">Створіть акаунт, щоб зберігати улюблені, оформлювати замовлення та швидше купувати.</p>

                @if ($errors->any())
                    <div class="form-errors">
                        @foreach ($errors->all() as $error)
                            <div>{{ $error }}</div>
                        @endforeach
                    </div>
                @endif

                <form method="POST" action="{{ route('register') }}">
                    @csrf
                    <label>
                        <span>Ім’я</span>
                        <input type="text" name="name" value="{{ old('name') }}" required>
                    </label>
                    <label>
                        <span>Email</span>
                        <input type="email" name="email" value="{{ old('email') }}" required>
                    </label>
                    <label>
                        <span>Пароль</span>
                        <input type="password" name="password" required>
                    </label>
                    <label>
                        <span>Підтвердження пароля</span>
                        <input type="password" name="password_confirmation" required>
                    </label>
                    <div class="auth-footer">
                        <button type="submit" class="btn btn--primary">Створити акаунт</button>
                        <span class="muted">Вже маєте акаунт? <a href="{{ route('login') }}">Увійти</a></span>
                    </div>
                </form>
            </div>
        </div>
    </section>
@endsection
