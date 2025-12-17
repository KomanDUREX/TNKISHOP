@extends('layouts.app')

@section('content')
    <div class="admin-shell">
        <aside class="admin-sidebar">
            <div class="admin-sidebar__brand">
                <p>Admin</p>
                <a href="{{ route('home') }}" class="btn btn--ghost btn--sm">← Назад на сайт</a>
            </div>
            <nav class="admin-menu">
                <a href="{{ route('admin.dashboard') }}" class="{{ request()->routeIs('admin.dashboard') ? 'is-active' : '' }}">Dashboard</a>
                <a href="{{ route('admin.products.index') }}" class="{{ request()->routeIs('admin.products.*') ? 'is-active' : '' }}">Товари</a>
                <a href="{{ route('admin.categories.index') }}" class="{{ request()->routeIs('admin.categories.*') ? 'is-active' : '' }}">Категорії</a>
                <a href="{{ route('admin.filters.index') }}" class="{{ request()->routeIs('admin.filters.*') ? 'is-active' : '' }}">Фільтри</a>
                <a href="{{ route('admin.users.index') }}" class="{{ request()->routeIs('admin.users.*') ? 'is-active' : '' }}">Користувачі</a>
            </nav>
        </aside>
        <div class="admin-content">
            @if (session('status'))
                <div class="alert alert--success">{{ session('status') }}</div>
            @endif
            @if ($errors->any())
                <div class="alert alert--error">
                    @foreach ($errors->all() as $error)
                        <div>{{ $error }}</div>
                    @endforeach
                </div>
            @endif
            @yield('admin')
        </div>
    </div>
@endsection
