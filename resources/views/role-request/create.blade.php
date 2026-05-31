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

        .form-card { background: #16213e; border-radius: 12px; padding: 30px; max-width: 600px; }
        .form-card h1 { color: #e94560; margin-bottom: 20px; }
        .form-group { margin-bottom: 20px; }
        .form-group label { display: block; margin-bottom: 8px; color: #a0a0b0; }
        .form-group select, .form-group textarea {
            width: 100%; padding: 12px; background: #0f3460; border: 1px solid #1a1a2e;
            color: #fff; border-radius: 8px; font-size: 14px;
        }
        .btn { background: #e94560; color: #fff; border: none; padding: 12px 30px; border-radius: 8px; cursor: pointer; font-size: 16px; width: 100%; }
        .btn:hover { background: #c23152; }
        .alert { padding: 12px; border-radius: 8px; margin-bottom: 20px; }
        .alert-success { background: #1b5e20; color: #a5d6a7; }
        .alert-danger { background: #8e0000; color: #ef9a9a; }
        .alert-warning { background: #e65100; color: #ffe0b2; }
        .invalid-feedback { color: #ef9a9a; font-size: 13px; margin-top: 5px; }
    </style>

    <div class="admin-wrapper">
        <aside class="sidebar">
            <h2>Пользователь</h2>
            <a href="{{ route('dashboard') }}">Дашборд</a>
            <a href="{{ route('role-request.create') }}" class="active">Запросить роль</a>
            <a href="{{ route('role-request.my-requests') }}">Мои запросы</a>
        </aside>

        <main class="main-content">
            <div class="form-card">
                <h1>Запрос на повышение роли</h1>

                @if(session('success'))
                    <div class="alert alert-success">{{ session('success') }}</div>
                @endif

                @if(session('error'))
                    <div class="alert alert-danger">{{ session('error') }}</div>
                @endif

                @if($hasPendingRequest)
                    <div class="alert alert-warning">
                        У вас уже есть активный запрос на повышение роли. Дождитесь его обработки.
                    </div>
                @else
                    <form action="{{ route('role-request.store') }}" method="POST">
                        @csrf

                        <div class="form-group">
                            <label>Текущая роль: <strong>{{ Auth::user()->role }}</strong></label>
                        </div>

                        <div class="form-group">
                            <label for="requested_role">Желаемая роль:</label>
                            <select name="requested_role" id="requested_role">
                                @foreach($availableRoles as $role)
                                    <option value="{{ $role }}" {{ old('requested_role') == $role ? 'selected' : '' }}>
                                        {{ ucfirst($role) }}
                                    </option>
                                @endforeach
                            </select>
                            @error('requested_role')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <div class="form-group">
                            <label for="reason">Причина повышения роли:</label>
                            <textarea name="reason" id="reason" rows="4"
                                      placeholder="Опишите, почему вы хотите повысить свою роль...">{{ old('reason') }}</textarea>
                            @error('reason')
                            <div class="invalid-feedback">{{ $message }}</div>
                            @enderror
                        </div>

                        <button type="submit" class="btn">Отправить запрос</button>
                    </form>
                @endif
            </div>
        </main>
    </div>
@endsection
