@extends('layouts.app')

@section('content')
    <style>
        * { box-sizing: border-box; margin: 0; padding: 0; font-family: 'Segoe UI', sans-serif; }
        body { background: #1a1a2e; }
        .admin-wrapper { display: flex; min-height: 100vh; }
        .sidebar { width: 250px; background: #16213e; color: #fff; padding: 30px 20px; }
        .sidebar h2 { font-size: 20px; margin-bottom: 30px; color: #e94560; }
        .sidebar a { display: block; color: #a0a0b0; text-decoration: none; padding: 10px 12px; border-radius: 8px; margin-bottom: 5px; transition: 0.2s; }
        .sidebar a:hover, .sidebar a.active { background: #e94560; color: #fff; }
        .main-content { flex: 1; padding: 40px; color: #fff; }

        .requests-table { width: 100%; border-collapse: collapse; margin-top: 20px; background: #16213e; border-radius: 12px; overflow: hidden; }
        .requests-table th { background: #0f3460; padding: 15px; text-align: left; font-weight: 600; }
        .requests-table td { padding: 15px; border-bottom: 1px solid #1a1a2e; }
        .requests-table tr:hover { background: rgba(233, 69, 96, 0.1); }
        .badge { display: inline-block; padding: 5px 12px; border-radius: 20px; font-size: 12px; font-weight: 600; }
        .badge-pending { background: #ffc107; color: #000; }
        .btn { padding: 8px 16px; border-radius: 6px; text-decoration: none; font-size: 14px; transition: 0.2s; display: inline-block; }
        .btn-view { background: #e94560; color: #fff; }
        .btn-view:hover { background: #c23152; }
        .alert-success { background: #1b5e20; color: #a5d6a7; padding: 12px; border-radius: 8px; margin-bottom: 20px; }
        .pagination { margin-top: 20px; }
        .pagination span { color: #a0a0b0; margin: 0 5px; }
    </style>

    <div class="admin-wrapper">
        <aside class="sidebar">
            <h2>Админ-панель</h2>
            <a href="{{ route('admin.dashboard') }}">Дашборд</a>
            <a href="{{ route('admin.role-requests.index') }}" class="active">Запросы ролей</a>
            <a href="#пустышка">Пользователи</a>
            <a href="#пустышка">Комментарии</a>
        </aside>

        <main class="main-content">
            <h1>Запросы на изменение роли</h1>
            <p class="subtitle" style="color: #a0a0b0; margin-bottom: 10px;">Ожидающие рассмотрения</p>

            @if(session('success'))
                <div class="alert-success">{{ session('success') }}</div>
            @endif

            <table class="requests-table">
                <thead>
                <tr>
                    <th>ID</th>
                    <th>Пользователь</th>
                    <th>Запрошенная роль</th>
                    <th>Дата</th>
                    <th>Статус</th>
                    <th>Действия</th>
                </tr>
                </thead>
                <tbody>
                @forelse($requests as $req)
                    <tr>
                        <td>#{{ $req->id }}</td>
                        <td>{{ $req->user->name ?? '—' }}</td>
                        <td>{{ $req->requested_role ?? '—' }}</td>
                        <td>{{ $req->created_at->format('d.m.Y H:i') }}</td>
                        <td><span class="badge badge-pending">Pending</span></td>
                        <td>
                            <a href="{{ route('admin.role-requests.show', $req->id) }}" class="btn btn-view">Просмотр</a>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" style="text-align: center; color: #a0a0b0;">Нет ожидающих запросов</td>
                    </tr>
                @endforelse
                </tbody>
            </table>

            <div class="pagination">
                {{ $requests->links() }}
            </div>
        </main>
    </div>
@endsection
