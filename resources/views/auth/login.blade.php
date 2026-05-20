@extends('layouts.app')
@section('content')
    <style>
        * { box-sizing: border-box; margin: 0; padding: 0; font-family: 'Segoe UI', sans-serif; }
        body { background: #1a1a2e; }
        .auth-container {
            max-width: 420px;
            margin: 80px auto;
            background: #16213e;
            padding: 40px 35px;
            border-radius: 20px;
            box-shadow: 0 15px 40px rgba(0, 0, 0, 0.4);
        }
        .auth-container h2 {
            text-align: center;
            color: #fff;
            font-size: 26px;
            margin-bottom: 25px;
        }
        .mb-3 { margin-bottom: 18px; }
        .mb-3 label { display: block; color: #a0a0b0; font-size: 13px; margin-bottom: 5px; }
        .mb-3 input {
            width: 100%;
            padding: 10px 14px;
            border: 1px solid #0f3460;
            border-radius: 8px;
            font-size: 15px;
            background: #1a1a2e;
            color: #fff;
        }
        .mb-3 input:focus { border-color: #e94560; outline: none; }
        .btn {
            width: 100%;
            padding: 12px;
            background: #e94560;
            color: #fff;
            border: none;
            border-radius: 8px;
            font-size: 16px;
            font-weight: bold;
            cursor: pointer;
            transition: 0.2s;
        }
        .btn:hover { opacity: 0.9; transform: scale(1.02); }
        .link { text-align: center; margin-top: 18px; font-size: 14px; color: #a0a0b0; }
        .link a { color: #e94560; text-decoration: none; font-weight: bold; }
    </style>

    <div class="auth-container">
        <h2>Вход</h2>
        <form method="POST" action="{{ route('login.post') }}">
            @csrf
            <div class="mb-3">
                <label>Email</label>
                <input type="email" name="email" placeholder="Введите email" value="{{ old('email') }}">
            </div>
            <div class="mb-3">
                <label>Пароль</label>
                <input type="password" name="password" placeholder="Введите пароль">
            </div>
            <button type="submit" class="btn">Войти</button>
        </form>
        <div class="link">
            Нет аккаунта? <a href="{{ route('register') }}">Зарегистрироваться</a>
        </div>
    </div>
@endsection
