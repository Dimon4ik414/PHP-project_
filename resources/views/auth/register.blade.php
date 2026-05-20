@extends('layouts.app')
@section('content')
    <style>
        * { box-sizing: border-box; margin: 0; padding: 0; font-family: 'Segoe UI', sans-serif; }
        body { background: #1a1a2e; }
        .auth-container {
            max-width: 450px;
            margin: 60px auto;
            background: #16213e;
            padding: 40px;
            border-radius: 20px;
            box-shadow: 0 15px 40px rgba(0, 0, 0, 0.4);
        }
        .auth-container h2 {
            text-align: center;
            color: #fff;
            font-size: 26px;
            margin-bottom: 25px;
        }
        form { display: flex; flex-direction: column; gap: 18px; }
        .mb-3 { display: flex; flex-direction: column; }
        .mb-3 label { color: #a0a0b0; font-size: 13px; margin-bottom: 5px; }
        .mb-3 input {
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
            padding: 14px;
            background: #e94560;
            color: #fff;
            border: none;
            border-radius: 8px;
            font-size: 16px;
            font-weight: bold;
            cursor: pointer;
            transition: 0.2s;
            margin-top: 5px;
        }
        .btn:hover { opacity: 0.9; transform: scale(1.02); }
        .link { text-align: center; margin-top: 18px; font-size: 14px; color: #a0a0b0; }
        .link a { color: #e94560; text-decoration: none; font-weight: bold; }
    </style>

    <div class="auth-container">
        <h2>Регистрация</h2>
        <form method="POST" action="{{ route('register.post') }}">
            @csrf
            <div class="mb-3">
                <label>Имя</label>
                <input type="text" name="name" placeholder="Введите ваше имя" value="{{ old('name') }}">
            </div>
            <div class="mb-3">
                <label>Email</label>
                <input type="email" name="email" placeholder="Введите ваш email" value="{{ old('email') }}">
            </div>
            <div class="mb-3">
                <label>Пароль</label>
                <input type="password" name="password" placeholder="Придумайте пароль">
            </div>
            <div class="mb-3">
                <label>Подтверждение пароля</label>
                <input type="password" name="password_confirmation" placeholder="Повторите пароль">
            </div>
            <button type="submit" class="btn">Зарегистрироваться</button>
        </form>
        <div class="link">
            Уже есть аккаунт? <a href="{{ route('login') }}">Войти</a>
        </div>
    </div>
@endsection
