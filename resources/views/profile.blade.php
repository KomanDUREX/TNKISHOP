@extends('layouts.app')

@section('title', 'Профіль - Tankist Store')

@section('content')
    <section class="section">
        <div class="container narrow auth-grid">
            <div class="auth-card">
                <h1>Профіль</h1>
                <p class="muted">Керуйте своїми даними та контактом для замовлень.</p>
                <p class="muted">Дата реєстрації: <strong>{{ optional($user->created_at)->format('d.m.Y') }}</strong></p>

                @if ($errors->updateProfile?->any())
                    <div class="form-errors">
                        @foreach ($errors->updateProfile->all() as $error)
                            <div>{{ $error }}</div>
                        @endforeach
                    </div>
                @endif

                <form method="POST" action="{{ route('profile.update') }}">
                    @csrf
                    @method('PUT')
                    <label>
                        <span>Ім’я</span>
                        <input type="text" name="name" value="{{ old('name', $user->name) }}" required>
                    </label>
                    <label>
                        <span>Email</span>
                        <input type="email" name="email" value="{{ old('email', $user->email) }}" required>
                    </label>
                    <div class="auth-footer">
                        <button type="submit" class="btn btn--primary">Оновити профіль</button>
                    </div>
                </form>
            </div>

            <div class="auth-card">
                <h2>Змінити пароль</h2>
                <p class="muted">Надійний пароль захищає ваші покупки.</p>

                @if ($errors->updatePassword?->any())
                    <div class="form-errors">
                        @foreach ($errors->updatePassword->all() as $error)
                            <div>{{ $error }}</div>
                        @endforeach
                    </div>
                @endif

                <form method="POST" action="{{ route('profile.password') }}">
                    @csrf
                    @method('PUT')
                    <label>
                        <span>Поточний пароль</span>
                        <input type="password" name="current_password" required>
                    </label>
                    <label>
                        <span>Новий пароль</span>
                        <input type="password" name="password" required>
                    </label>
                    <label>
                        <span>Підтвердження пароля</span>
                        <input type="password" name="password_confirmation" required>
                    </label>
                    <div class="auth-footer">
                        <button type="submit" class="btn btn--primary">Оновити пароль</button>
                    </div>
                </form>
            </div>
        </div>
    </section>
@endsection
