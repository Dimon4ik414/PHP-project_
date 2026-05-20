@extends('layouts.app')
@section('content')
    <style>
        * { box-sizing: border-box; margin: 0; padding: 0; font-family: 'Segoe UI', sans-serif; }
        body { background: #1a1a2e; }
        .user-wrapper { display: flex; min-height: 100vh; }
        .sidebar {
            width: 250px;
            background: #16213e;
            color: #fff;
            padding: 30px 20px;
        }
        .sidebar h2 { font-size: 20px; margin-bottom: 30px; color: #e94560; }
        .sidebar a {
            display: block;
            color: #a0a0b0;
            text-decoration: none;
            padding: 10px 12px;
            border-radius: 8px;
            margin-bottom: 5px;
            transition: 0.2s;
        }
        .sidebar a:hover, .sidebar a.active { background: #e94560; color: #fff; }
        .main-content { flex: 1; padding: 40px; color: #fff; }
        .main-content h1 { font-size: 28px; margin-bottom: 5px; }
        .main-content .subtitle { color: #a0a0b0; margin-bottom: 30px; }
        .cards { display: flex; gap: 20px; flex-wrap: wrap; margin-bottom: 30px; }
        .card {
            background: #16213e;
            padding: 25px;
            border-radius: 12px;
            flex: 1;
            min-width: 180px;
            text-align: center;
        }
        .card h3 { font-size: 36px; color: #e94560; margin-bottom: 5px; }
        .card p { color: #a0a0b0; font-size: 14px; }
        .section-title { font-size: 20px; margin-bottom: 15px; color: #e94560; }
        .btn-grid { display: flex; gap: 15px; flex-wrap: wrap; margin-bottom: 30px; }
        .btn-dash {
            padding: 14px 24px;
            background: #16213e;
            color: #fff;
            text-decoration: none;
            border-radius: 10px;
            border: 1px solid #0f3460;
            transition: 0.2s;
            display: flex;
            align-items: center;
            gap: 10px;
        }
        .btn-dash:hover { border-color: #e94560; background: #1a1a3e; }
        .btn-dash .icon { font-size: 20px; }
        .logout-btn { margin-top: 20px; }
        .logout-btn button {
            background: transparent;
            color: #e94560;
            border: 2px solid #e94560;
            padding: 12px 28px;
            border-radius: 8px;
            font-size: 15px;
            cursor: pointer;
            transition: 0.2s;
        }
        .logout-btn button:hover { background: #e94560; color: #fff; }
    </style>

    <div class="user-wrapper">
        <aside class="sidebar">
            <h2>Панель</h2>
            <a href="{{ route('dashboard') }}" class="active">Дашборд</a>
            <a href="{{ route('comments.index') }}">Комментарии</a>
            <a href="{{ route('categories.index') }}">Категории</a>
            <a href="{{ route('role-request.create') }}">Запросить роль</a>
            <a href="{{ route('role-request.my-requests') }}">Мои запросы</a>
        </aside>

        <main class="main-content">
            <h1>Добро пожаловать, {{ Auth::user()->name }}!</h1>
            <p class="subtitle">Ваша текущая роль: <strong>{{ Auth::user()->role }}</strong></p>

            <div class="cards">
                <div class="card">
                    <h3>{{ Auth::user()->role }}</h3>
                    <p>Текущая роль</p>
                </div>
                <div class="card">
                    <h3>{{ \App\Models\RoleRequest::where('user_id', Auth::id())->count() }}</h3>
                    <p>Всего запросов</p>
                </div>
                <div class="card">
                    <h3>{{ \App\Models\RoleRequest::where('user_id', Auth::id())->where('status', 'pending')->count() }}</h3>
                    <p>На рассмотрении</p>
                </div>
            </div>

            <h3 class="section-title">Действия</h3>
            <div class="btn-grid">
                <a href="{{ route('comments.index') }}" class="btn-dash">
                    <span class="icon">#</span> Комментарии
                </a>
                <a href="{{ route('categories.index') }}" class="btn-dash">
                    <span class="icon">#</span> Категории
                </a>
                <a href="{{ route('role-request.create') }}" class="btn-dash">
                    <span class="icon">#</span> Запросить повышение роли
                </a>
                <a href="{{ route('role-request.my-requests') }}" class="btn-dash">
                    <span class="icon">#</span> История запросов
                </a>
            </div>

            <div class="logout-btn">
                <form action="{{ route('logout') }}" method="POST">
                    @csrf
                    <button type="submit">Выйти</button>
                </form>
            </div>
        </main>
    </div>
@endsection
