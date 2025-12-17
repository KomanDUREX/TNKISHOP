@extends('admin.layout')

@section('title', 'Адмін - Товари')

@section('admin')
    <div class="admin-page-head">
        <h2>Товари</h2>
        <a href="{{ route('admin.products.create') }}" class="btn btn--primary">Додати товар</a>
    </div>

    <div class="admin-table-card">
        <table class="table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Назва</th>
                    <th>Ціна</th>
                    <th>Категорія</th>
                    <th>Тип</th>
                    <th>Гра</th>
                    <th>Статус</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                @foreach ($products as $product)
                    <tr>
                        <td>{{ $product->id }}</td>
                        <td>{{ $product->title }}</td>
                        <td>{{ number_format($product->price, 2, '.', ' ') }}</td>
                        <td>{{ $product->category?->name ?? '-' }}</td>
                        <td>{{ $product->type ?? '-' }}</td>
                        <td>{{ $product->game ?? '-' }}</td>
                        <td>{{ $product->is_active ? 'Активний' : 'Прихований' }}</td>
                        <td class="table-actions">
                            <a href="{{ route('admin.products.edit', $product) }}" class="btn btn--ghost btn--sm">Редагувати</a>
                            <form action="{{ route('admin.products.destroy', $product) }}" method="POST" onsubmit="return confirm('Видалити?')">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="btn btn--ghost btn--sm">Видалити</button>
                            </form>
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        {{ $products->links() }}
    </div>
@endsection
