<!DOCTYPE html>
<html lang="fa" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>ورود</title>

    <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet">

    <style>
        * {
            box-sizing: border-box;
        }

        body {
            margin: 0;
            min-height: 100vh;
            display: flex;
            justify-content: center;
            align-items: center;
            background: linear-gradient(135deg, #2c3136 0%, #4a545e 100%);
            padding: 20px;
        }

        .login-card {
            width: 100%;
            max-width: 420px;
            background: #fff;
            border-radius: 16px;
            box-shadow: 0 20px 50px rgba(0, 0, 0, 0.2);
            padding: 40px 32px;
            position: relative;
            overflow: hidden;
        }

        .login-card::before {
            content: '';
            position: absolute;
            top: 0;
            right: 0;
            left: 0;
            height: 5px;
            background: linear-gradient(90deg, #0dcaf0, #7cb342, #198754);
        }

        .login-logo {
            width: 70px;
            height: 70px;
            margin: 0 auto 20px;
            background: #2c3136;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.8rem;
        }

        .login-title {
            text-align: center;
            font-weight: bold;
            color: #2c3136;
            margin-bottom: 8px;
            font-size: 1.5rem;
        }

        .login-subtitle {
            text-align: center;
            color: #6c757d;
            font-size: 0.9rem;
            margin-bottom: 30px;
            line-height: 1.7;
        }

        .form-label-custom {
            display: block;
            color: #2c3136;
            font-weight: 500;
            margin-bottom: 8px;
            font-size: 0.9rem;
        }

        .form-input-custom {
            width: 100%;
            padding: 13px 16px;
            border: 2px solid #e9ecef;
            border-radius: 10px;
            font-size: 1rem;
            font-family: inherit;
            transition: all 0.2s ease;
            outline: none;
            direction: ltr;
            text-align: left;
        }

        .form-input-custom:focus {
            border-color: #0d6efd;
            box-shadow: 0 0 0 4px rgba(13, 110, 253, 0.1);
        }

        .form-input-custom::placeholder {
            color: #adb5bd;
        }

        .btn-login {
            width: 100%;
            padding: 13px;
            margin-top: 20px;
            background: #2c3136;
            color: #fff;
            border: none;
            border-radius: 10px;
            font-size: 1rem;
            font-family: inherit;
            font-weight: 500;
            cursor: pointer;
            transition: all 0.2s ease;
        }

        .btn-login:hover {
            background: #1a1e22;
            transform: translateY(-2px);
            box-shadow: 0 8px 20px rgba(44, 49, 54, 0.3);
        }

        .btn-login:active {
            transform: translateY(0);
        }

        .alert-error {
            background: #f8d7da;
            color: #842029;
            padding: 12px 16px;
            border-radius: 8px;
            margin-bottom: 20px;
            border-right: 4px solid #dc3545;
            font-size: 0.88rem;
        }

        .alert-success {
            background: #d1e7dd;
            color: #0f5132;
            padding: 12px 16px;
            border-radius: 8px;
            margin-bottom: 20px;
            border-right: 4px solid #198754;
            font-size: 0.88rem;
        }

        .form-error {
            color: #dc3545;
            font-size: 0.82rem;
            margin-top: 6px;
        }

        .login-footer {
            text-align: center;
            margin-top: 25px;
            color: #adb5bd;
            font-size: 0.82rem;
        }

        @media (max-width: 480px) {
            .login-card {
                padding: 30px 22px;
            }

            .login-title {
                font-size: 1.3rem;
            }
        }
    </style>
</head>
<body>

<div class="login-card">

    <div class="login-logo">
        🔐
    </div>

    <h1 class="login-title">
        ورود به پنل
    </h1>

    <p class="login-subtitle">
        برای ورود، شماره موبایل خود را وارد کنید
    </p>

    @if(session('error'))
        <div class="alert-error">
            {{ session('error') }}
        </div>
    @endif

    @if(session('success'))
        <div class="alert-success">
            {{ session('success') }}
        </div>
    @endif

    <form action="{{ route('auth.request-otp') }}" method="POST">
        @csrf

        <label for="phone" class="form-label-custom">
            شماره موبایل
        </label>

        <input
            type="text"
            id="phone"
            name="phone"
            class="form-input-custom"
            placeholder="09123456789"
            value="{{ old('phone') }}"
            maxlength="11"
            autocomplete="off"
            required
        >

        @error('phone')
        <div class="form-error">
            {{ $message }}
        </div>
        @enderror

        <button type="submit" class="btn-login">
            دریافت کد تایید
        </button>

    </form>

    <div class="login-footer">
        با ورود، قوانین و مقررات را می‌پذیرید
    </div>

</div>

<script src="{{ asset('js/bootstrap.bundle.min.js') }}"></script>

</body>
</html>
