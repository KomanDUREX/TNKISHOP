@extends('admin.layout')

@section('title', 'Редагувати категорію')

@section('admin')
    <div class="admin-page-head">
        <h2>Редагувати категорію</h2>
        <a href="{{ route('admin.categories.index') }}" class="btn btn--ghost">Назад</a>
    </div>
    <div class="auth-card">
        <form method="POST" action="{{ route('admin.categories.update', $category) }}">
            @csrf
            @method('PUT')
            @if ($errors->any())
                <div class="form-errors">
                    @foreach ($errors->all() as $error)
                        <div>{{ $error }}</div>
                    @endforeach
                </div>
            @endif
            <label><span>Назва</span><input type="text" name="name" value="{{ old('name', $category->name) }}" required></label>
            <label><span>Slug</span><input type="text" name="slug" value="{{ old('slug', $category->slug) }}"></label>
            <label style="display:flex;align-items:center;gap:0.5rem;color:var(--muted);">
                <input type="checkbox" name="is_active" value="1" @checked(old('is_active', $category->is_active)) style="width:16px;height:16px;"> Активна
            </label>
            <button class="btn btn--primary" type="submit">Зберегти</button>
        </form>
    </div>
@endsection
