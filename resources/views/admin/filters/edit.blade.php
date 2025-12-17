@extends('admin.layout')

@section('title', 'Редагувати фільтр')

@section('admin')
    <div class="admin-page-head">
        <h2>Редагувати фільтр</h2>
        <a href="{{ route('admin.filters.index') }}" class="btn btn--ghost">Назад</a>
    </div>
    <div class="auth-card">
        <form method="POST" action="{{ route('admin.filters.update', $filter) }}">
            @csrf
            @method('PUT')
            @if ($errors->any())
                <div class="form-errors">
                    @foreach ($errors->all() as $error)
                        <div>{{ $error }}</div>
                    @endforeach
                </div>
            @endif
            <label><span>Група (type/game/...)</span><input type="text" name="group" value="{{ old('group', $filter->group) }}" required></label>
            <label><span>Назва</span><input type="text" name="name" value="{{ old('name', $filter->name) }}" required></label>
            <label><span>Slug</span><input type="text" name="slug" value="{{ old('slug', $filter->slug) }}" placeholder="Авто"></label>
            <label><span>Порядок</span><input type="number" name="sort_order" value="{{ old('sort_order', $filter->sort_order) }}"></label>
            <label style="display:flex;align-items:center;gap:0.5rem;color:var(--muted);">
                <input type="checkbox" name="is_active" value="1" @checked(old('is_active', $filter->is_active)) style="width:16px;height:16px;"> Активний
            </label>
            <button class="btn btn--primary" type="submit">Зберегти</button>
        </form>
    </div>
@endsection
