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

        .detail-card { background: #16213e; border-radius: 12px; padding: 30px; margin-bottom: 30px; }
        .detail-card h2 { color: #e94560; margin-bottom: 20px; }
        .info-row { display: flex; margin-bottom: 12px; }
        .info-label { width: 150px; color: #a0a0b0; }
        .info-value { flex: 1; }
        .user-link { color: #e94560; text-decoration: none; }
        .user-link:hover { text-decoration: underline; }

        .action-buttons { display: flex; gap: 15px; margin-top: 25px; }
        .btn-approve { background: #2e7d32; color: #fff; border: none; padding: 12px 30px; border-radius: 8px; cursor: pointer; font-size: 15px; }
        .btn-approve:hover { background: #1b5e20; }
        .btn-reject { background: #c62828; color: #fff; border: none; padding: 12px 30px; border-radius: 8px; cursor: pointer; font-size: 15px; }
        .btn-reject:hover { background: #8e0000; }

        .comments-section { margin-top: 30px; }
        .comments-section h3 { color: #e94560; margin-bottom: 15px; }
        .comment { background: #0f3460; padding: 15px; border-radius: 8px; margin-bottom: 10px; }
        .comment-author { font-weight: 600; margin-bottom: 5px; }
        .comment-date { color: #a0a0b0; font-size: 12px; }
        .comment-body { margin-top: 8px; }

        .comment-form { margin-top: 20px; }
        .comment-form textarea { width: 100%; background: #0f3460; border: 1px solid #16213e; color: #fff; padding: 12px; border-radius: 8px; min-height: 100px; resize: vertical; }
        .comment-form button { background: #e94560; color: #fff; border: none; padding: 10px 25px; border-radius: 8px; margin-top: 10px; cursor: pointer; }
        .comment-form button:hover { background: #c23152; }
        .back-link { color: #a0a0b0; text-decoration: none; display: inline-block; margin-bottom: 20px; }
        .back-link:hover { color: #fff; }
        .alert-success { background: #1b5e20; color: #a5d6a7; padding: 12px; border-radius: 8px; margin-bottom: 20px; }
        .alert-error { background: #8e0000; color: #ef9a9a; padding: 12px; border-radius: 8px; margin-bottom: 20px; }
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
            <a href="{{ route('admin.role-requests.index') }}" class="back-link">← Назад к списку</a>
            <h1>Запрос #{{ $roleRequest->id }}</h1>

            @if(session('success'))
                <div class="alert-success">{{ session('success') }}</div>
            @endif
            @if(session('error'))
                <div class="alert-error">{{ session('error') }}</div>
            @endif

            <!-- Детали запроса -->
            <div class="detail-card">
                <h2>Информация о запросе</h2>
                <div class="info-row">
                    <div class="info-label">Пользователь:</div>
                    <div class="info-value">
                        <a href="{{ route('admin.users.profile', $roleRequest->user->id) }}" class="user-link">
                            {{ $roleRequest->user->name ?? '—' }}
                        </a>
                    </div>
                </div>
                <div class="info-row">
                    <div class="info-label">Текущая роль:</div>
                    <div class="info-value">{{ $roleRequest->user->role ?? '—' }}</div>
                </div>
                <div class="info-row">
                    <div class="info-label">Запрошенная роль:</div>
                    <div class="info-value">{{ $roleRequest->requested_role ?? '—' }}</div>
                </div>
                <div class="info-row">
                    <div class="info-label">Статус:</div>
                    <div class="info-value">{{ $roleRequest->status }}</div>
                </div>
                <div class="info-row">
                    <div class="info-label">Причина:</div>
                    <div class="info-value">{{ $roleRequest->reason ?? 'Не указана' }}</div>
                </div>
                <div class="info-row">
                    <div class="info-label">Дата:</div>
                    <div class="info-value">{{ $roleRequest->created_at->format('d.m.Y H:i') }}</div>
                </div>

                @if($roleRequest->status === 'pending')
                    <div class="action-buttons">
                        <form action="{{ route('admin.role-requests.process', $roleRequest->id) }}" method="POST" style="display: inline;">
                            @csrf
                            <input type="hidden" name="action" value="approved">
                            <button type="submit" class="btn-approve">Одобрить</button>
                        </form>
                        <form action="{{ route('admin.role-requests.process', $roleRequest->id) }}" method="POST" style="display: inline;">
                            @csrf
                            <input type="hidden" name="action" value="rejected">
                            <button type="submit" class="btn-reject">Отклонить</button>
                        </form>
                    </div>
                @endif
            </div>

            <div class="comments-section">
                <h3>Комментарии ({{ $roleRequest->comments->count() }})</h3>

                @forelse($roleRequest->comments as $comment)
                    <div class="comment">
                        <div class="comment-author">{{ $comment->user->name ?? 'Администратор' }}</div>
                        <div class="comment-date">{{ $comment->created_at->format('d.m.Y в H:i') }}</div>
                        <div class="comment-body">{{ $comment->comment }}</div>
                    </div>
                @empty
                    <p style="color: #a0a0b0;">Комментариев пока нет</p>
                @endforelse


                <div class="comment-form">
                    <form action="{{ route('admin.role-requests.comment', $roleRequest->id) }}" method="POST">
                        @csrf
                        <textarea name="body" placeholder="Напишите комментарий для пользователя..."></textarea>
                        <button type="submit">Отправить</button>
                    </form>
                </div>
            </div>
        </main>
    </div>
@endsection
