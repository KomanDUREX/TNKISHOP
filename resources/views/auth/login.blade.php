@extends('layouts.app')

@section('title', 'Увійти - Tankist Store')

@section('content')
    <section class="section">
        <div class="container narrow">
            <div class="auth-card">
                <h1>Увійти</h1>
                <p class="muted">Поверніться у свій акаунт Tankist Store, щоб керувати профілем, кошиком та улюбленими.</p>

                @if ($errors->any())
                    <div class="form-errors">
                        @foreach ($errors->all() as $error)
                            <div>{{ $error }}</div>
                        @endforeach
                    </div>
                @endif

                <form method="POST" action="{{ route('login') }}">
                    @csrf
                    <label>
                        <span>Email</span>
                        <input type="email" name="email" value="{{ old('email') }}" required autofocus>
                    </label>
                    <label>
                        <span>Пароль</span>
                        <input type="password" name="password" required>
                    </label>
                    <label style="display:flex;align-items:center;gap:0.5rem;color:var(--muted);">
                        <input type="checkbox" name="remember" style="width:16px;height:16px;">
                        <span>Запам’ятати мене</span>
                    </label>
                    <div class="auth-footer">
                        <button type="submit" class="btn btn--primary">Увійти</button>
                        <span class="muted">Немає акаунта? <a href="{{ route('register') }}">Зареєструватися</a></span>
                    </div>
                </form>
            </div>
        </div>
    </section>
@endsection
