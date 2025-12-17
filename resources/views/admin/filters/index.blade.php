@extends('admin.layout')

@section('title', 'Адмін - Фільтри')

@section('admin')
    <div class="admin-page-head">
        <h2>Фільтри</h2>
        <a href="{{ route('admin.filters.create') }}" class="btn btn--primary">Додати</a>
    </div>
    <div class="admin-table-card">
        <table class="table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Група</th>
                    <th>Назва</th>
                    <th>Slug</th>
                    <th>Порядок</th>
                    <th>Статус</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                @foreach ($filters as $filter)
                    <tr>
                        <td>{{ $filter->id }}</td>
                        <td>{{ $filter->group }}</td>
                        <td>{{ $filter->name }}</td>
                        <td>{{ $filter->slug }}</td>
                        <td>{{ $filter->sort_order }}</td>
                        <td>{{ $filter->is_active ? 'Активний' : 'Вимкнений' }}</td>
                        <td class="table-actions">
                            <a href="{{ route('admin.filters.edit', $filter) }}" class="btn btn--ghost btn--sm">Редагувати</a>
                            <form action="{{ route('admin.filters.destroy', $filter) }}" method="POST" onsubmit="return confirm('Видалити?')">
                                @csrf
                                @method('DELETE')
                                <button class="btn btn--ghost btn--sm" type="submit">Видалити</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        {{ $filters->links() }}
    </div>
@endsection
