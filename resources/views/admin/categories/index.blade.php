@extends('admin.layout')

@section('title', 'Адмін - Категорії')

@section('admin')
    <div class="admin-page-head">
        <h2>Категорії</h2>
        <a href="{{ route('admin.categories.create') }}" class="btn btn--primary">Додати</a>
    </div>
    <div class="admin-table-card">
        <table class="table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Назва</th>
                    <th>Slug</th>
                    <th>Статус</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                @foreach ($categories as $category)
                    <tr>
                        <td>{{ $category->id }}</td>
                        <td>{{ $category->name }}</td>
                        <td>{{ $category->slug }}</td>
                        <td>{{ $category->is_active ? 'Активна' : 'Прихована' }}</td>
                        <td class="table-actions">
                            <a href="{{ route('admin.categories.edit', $category) }}" class="btn btn--ghost btn--sm">Редагувати</a>
                            <form action="{{ route('admin.categories.destroy', $category) }}" method="POST" onsubmit="return confirm('Видалити?')">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn--ghost btn--sm" type="submit">Видалити</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        {{ $categories->links() }}
    </div>
@endsection
