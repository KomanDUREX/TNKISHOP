@extends('admin.layout')

@section('title', 'Адмін - Користувачі')

@section('admin')
    <div class="admin-page-head">
        <h2>Користувачі</h2>
    </div>
    <div class="admin-table-card">
        <table class="table">
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Ім’я</th>
                    <th>Email</th>
                    <th>Адмін</th>
                    <th>Статус</th>
                    <th>Дата</th>
                    <th></th>
                </tr>
            </thead>
            <tbody>
                @foreach ($users as $user)
                    <tr>
                        <td>{{ $user->id }}</td>
                        <td>{{ $user->name }}</td>
                        <td>{{ $user->email }}</td>
                        <td>{{ $user->is_admin ? 'Так' : 'Ні' }}</td>
                        <td>{{ $user->is_active ? 'Активний' : 'Деактивований' }}</td>
                        <td>{{ optional($user->created_at)->format('d.m.Y') }}</td>
                        <td class="table-actions">
                            @if(!$user->is_admin)
                                <form action="{{ route('admin.users.update', $user) }}" method="POST">
                                    @csrf
                                    @method('PUT')
                                    <button type="submit" class="btn btn--ghost btn--sm">{{ $user->is_active ? 'Деактивувати' : 'Активувати' }}</button>
                                </form>
                            @else
                                <span class="muted">Адмін</span>
                            @endif
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
        {{ $users->links() }}
    </div>
@endsection
