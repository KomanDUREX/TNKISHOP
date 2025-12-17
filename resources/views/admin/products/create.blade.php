@extends('admin.layout')

@section('title', 'Додати товар')

@section('admin')
    <div class="admin-page-head">
        <h2>Додати товар</h2>
        <a href="{{ route('admin.products.index') }}" class="btn btn--ghost">Назад</a>
    </div>
    <div class="auth-card">
        <form method="POST" action="{{ route('admin.products.store') }}">
            @csrf
            @if ($errors->any())
                <div class="form-errors">
                    @foreach ($errors->all() as $error)
                        <div>{{ $error }}</div>
                    @endforeach
                </div>
            @endif
            <label><span>Назва</span><input type="text" name="title" value="{{ old('title') }}" required></label>
            <label><span>Опис</span><textarea name="description" rows="3">{{ old('description') }}</textarea></label>
            <label><span>Категорія</span>
                <select name="category_id">
                    <option value="">Без категорії</option>
                    @foreach($categories as $cat)
                        <option value="{{ $cat->id }}" @selected(old('category_id')==$cat->id)>{{ $cat->name }}</option>
                    @endforeach
                </select>
            </label>
            <label><span>Тип</span><input type="text" name="type" value="{{ old('type') }}"></label>
            <label><span>Гра</span><input type="text" name="game" value="{{ old('game') }}"></label>
            <label><span>Бейдж</span><input type="text" name="badge" value="{{ old('badge') }}"></label>
            <label><span>Ціна</span><input type="number" step="0.01" name="price" value="{{ old('price') }}" required></label>
            <label><span>Що входить (кожен рядок окремо)</span><textarea name="includes" rows="3">{{ old('includes') }}</textarea></label>
            <label style="display:flex;align-items:center;gap:0.5rem;color:var(--muted);">
                <input type="checkbox" name="is_active" value="1" @checked(old('is_active', true)) style="width:16px;height:16px;"> Активний
            </label>
            <button class="btn btn--primary" type="submit">Зберегти</button>
        </form>
    </div>
@endsection
