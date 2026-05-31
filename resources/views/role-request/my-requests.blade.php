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
        .badge-approved { background: #2e7d32; color: #fff; }
        .badge-rejected { background: #c62828; color: #fff; }
        .alert-success { background: #1b5e20; color: #a5d6a7; padding: 12px; border-radius: 8px; margin-bottom: 20px; }
        .btn { padding: 8px 16px; border-radius: 6px; text-decoration: none; font-size: 14px; display: inline-block; margin-bottom: 20px; background: #e94560; color: #fff; }
    </style>

    <div class="admin-wrapper">
        <aside class="sidebar">
            <h2>Пользователь</h2>
            <a href="{{ route('dashboard') }}">Дашборд</a>
            <a href="{{ route('role-request.create') }}">Запросить роль</a>
            <a href="{{ route('role-request.my-requests') }}" class="active">Мои запросы</a>
        </aside>

        <main class="main-content">
            <h1>Мои запросы</h1>
            <p style="color: #a0a0b0; margin-bottom: 20px;">История запросов на повышение роли</p>

            @if(session('success'))
                <div class="alert-success">{{ session('success') }}</div>
            @endif

            <table class="requests-table">
                <thead>
                <tr>
                    <th>ID</th>
                    <th>Запрошенная роль</th>
                    <th>Статус</th>
                    <th>Дата</th>
                    <th>Комментарий</th>
                </tr>
                </thead>
                <tbody>
                @forelse($requests as $req)
                    <tr>
                        <td>#{{ $req->id }}</td>
                        <td>{{ $req->requested_role }}</td>
                        <td>
                        <span class="badge badge-{{ $req->status }}">
                            {{ $req->status === 'pending' ? 'Pending' : ($req->status === 'approved' ? 'Одобрен' : 'Отклонён') }}
                        </span>
                        </td>
                        <td>{{ $req->created_at->format('d.m.Y H:i') }}</td>
                        <td>{{ $req->admin_comment ?? '—' }}</td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="5" style="text-align: center; color: #a0a0b0;">У вас пока нет запросов</td>
                    </tr>
                @endforelse
                </tbody>
            </table>
        </main>
    </div>
@endsection
