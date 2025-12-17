@extends('admin.layout')

@section('title', 'Адмін - Dashboard')

@section('admin')
    <div class="admin-grid">
        <div class="stat-card">
            <p class="muted">Товарів</p>
            <p class="stat__value">{{ $stats['products'] }}</p>
        </div>
        <div class="stat-card">
            <p class="muted">Категорій</p>
            <p class="stat__value">{{ $stats['categories'] }}</p>
        </div>
        <div class="stat-card">
            <p class="muted">Фільтрів</p>
            <p class="stat__value">{{ $stats['filters'] }}</p>
        </div>
        <div class="stat-card">
            <p class="muted">Користувачів</p>
            <p class="stat__value">{{ $stats['users'] }}</p>
        </div>
    </div>

    <div class="admin-columns">
        <div class="admin-table-card">
            <div class="admin-table-head">
                <h3>Останні товари</h3>
            </div>
            <table class="table">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Назва</th>
                        <th>Ціна</th>
                        <th>Статус</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($latestProducts as $item)
                        <tr>
                            <td>{{ $item->id }}</td>
                            <td>{{ $item->title }}</td>
                            <td>{{ number_format($item->price, 2, '.', ' ') }}</td>
                            <td>{{ $item->is_active ? 'Активний' : 'Прихований' }}</td>
                        </tr>
                    @empty
                        <tr><td colspan="4" class="muted">Немає даних</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
        <div class="admin-table-card">
            <div class="admin-table-head">
                <h3>Останні користувачі</h3>
            </div>
            <table class="table">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Ім’я</th>
                        <th>Email</th>
                        <th>Дата</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($latestUsers as $user)
                        <tr>
                            <td>{{ $user->id }}</td>
                            <td>{{ $user->name }}</td>
                            <td>{{ $user->email }}</td>
                            <td>{{ optional($user->created_at)->format('d.m.Y') }}</td>
                        </tr>
                    @empty
                        <tr><td colspan="4" class="muted">Немає даних</td></tr>
                    @endforelse
                </tbody>
            </table>
        </div>
    </div>
@endsection
