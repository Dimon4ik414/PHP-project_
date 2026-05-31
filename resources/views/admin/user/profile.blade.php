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

        .user-card { background: #16213e; border-radius: 12px; padding: 30px; margin-bottom: 30px; }
        .user-card h2 { color: #e94560; margin-bottom: 15px; }
        .info-row { display: flex; margin-bottom: 10px; }
        .info-label { width: 120px; color: #a0a0b0; }

        .requests-table { width: 100%; border-collapse: collapse; margin-top: 20px; background: #16213e; border-radius: 12px; overflow: hidden; }
        .requests-table th { background: #0f3460; padding: 15px; text-align: left; }
        .requests-table td { padding: 15px; border-bottom: 1px solid #1a1a2e; }
        .badge { display: inline-block; padding: 4px 10px; border-radius: 20px; font-size: 11px; font-weight: 600; }
        .badge-approved { background: #2e7d32; color: #fff; }
        .badge-rejected { background: #c62828; color: #fff; }
        .badge-pending { background: #ffc107; color: #000; }
        .btn-view { background: #e94560; color: #fff; padding: 6px 14px; border-radius: 6px; text-decoration: none; font-size: 13px; }
        .btn-view:hover { background: #c23152; }
        .back-link { color: #a0a0b0; text-decoration: none; display: inline-block; margin-bottom: 20px; }
        .back-link:hover { color: #fff; }
    </style>

    <div class="admin-wrapper">
        <aside class="sidebar">
            <h2>Админ-панель</h2>
            <a href="{{ route('admin.dashboard') }}">Дашборд</a>
            <a href="{{ route('admin.requests.index') }}">Запросы ролей</a>
            <a href="#пустышка" class="active">Пользователи</a>
            <a href="#пустышка">Комментарии</a>
        </aside>

        <main class="main-content">
            <a href="javascript:history.back()" class="back-link">← Назад</a>
            <h1>Профиль пользователя</h1>

            <!-- Карточка пользователя -->
            <div class="user-card">
                <h2>{{ $user->name }}</h2>
                <div class="info-row">
                    <div class="info-label">Email:</div>
                    <div>{{ $user->email }}</div>
                </div>
                <div class="info-row">
                    <div class="info-label">Роль:</div>
                    <div>{{ $user->role ?? 'Не назначена' }}</div>
                </div>
                <div class="info-row">
                    <div class="info-label">Зарегистрирован:</div>
                    <div>{{ $user->created_at->format('d.m.Y') }}</div>
                </div>
                <div class="info-row">
                    <div class="info-label">Всего запросов:</div>
                    <div>{{ $user->roleRequests->count() }}</div>
                </div>
            </div>

            <h3 style="color: #e94560; margin-bottom: 10px;">История запросов</h3>
            <table class="requests-table">
                <thead>
                <tr>
                    <th>ID</th>
                    <th>Запрошенная роль</th>
                    <th>Статус</th>
                    <th>Дата</th>
                    <th>Комментарии</th>
                    <th>Действия</th>
                </tr>
                </thead>
                <tbody>
                @forelse($user->roleRequests as $req)
                    <tr>
                        <td>#{{ $req->id }}</td>
                        <td>{{ $req->requested_role ?? '—' }}</td>
                        <td>
                        <span class="badge badge-{{ $req->status }}">
                            {{ $req->status }}
                        </span>
                        </td>
                        <td>{{ $req->created_at->format('d.m.Y') }}</td>
                        <td>{{ $req->comments->count() }}</td>
                        <td>
                            <a href="{{ route('admin.requests.show', $req->id) }}" class="btn-view">Просмотр</a>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="6" style="text-align: center; color: #a0a0b0;">У пользователя нет запросов</td>
                    </tr>
                @endforelse
                </tbody>
            </table>
        </main>
    </div>
@endsection
