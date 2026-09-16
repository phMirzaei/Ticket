<!DOCTYPE html>
<html lang="fa" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>تایید کد</title>

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

        .otp-card {
            width: 100%;
            max-width: 420px;
            background: #fff;
            border-radius: 16px;
            box-shadow: 0 20px 50px rgba(0, 0, 0, 0.2);
            padding: 40px 32px;
            position: relative;
            overflow: hidden;
        }

        .otp-card::before {
            content: '';
            position: absolute;
            top: 0;
            right: 0;
            left: 0;
            height: 5px;
            background: linear-gradient(90deg, #0dcaf0, #7cb342, #198754);
        }

        .otp-logo {
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

        .otp-title {
            text-align: center;
            font-weight: bold;
            color: #2c3136;
            margin-bottom: 8px;
            font-size: 1.5rem;
        }

        .otp-subtitle {
            text-align: center;
            color: #6c757d;
            font-size: 0.9rem;
            margin-bottom: 30px;
            line-height: 1.9;
        }

        .otp-subtitle strong {
            color: #2c3136;
            direction: ltr;
            display: inline-block;
            font-weight: bold;
            letter-spacing: 0.5px;
        }

        .code-input {
            width: 100%;
            padding: 16px;
            border: 2px solid #e9ecef;
            border-radius: 12px;
            font-size: 1.8rem;
            font-family: inherit;
            font-weight: bold;
            text-align: center;
            letter-spacing: 12px;
            direction: ltr;
            transition: all 0.2s ease;
            outline: none;
            color: #2c3136;
        }

        .code-input:focus {
            border-color: #0d6efd;
            box-shadow: 0 0 0 4px rgba(13, 110, 253, 0.1);
        }

        .code-input::placeholder {
            color: #ced4da;
            letter-spacing: 12px;
        }

        .btn-verify {
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

        .btn-verify:hover {
            background: #1a1e22;
            transform: translateY(-2px);
            box-shadow: 0 8px 20px rgba(44, 49, 54, 0.3);
        }

        .btn-verify:active {
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

        .alert-error p {
            margin: 0;
        }

        .alert-error p + p {
            margin-top: 6px;
        }

        .alert-success {
            background: #d1e7dd;
            color: #0f5132;
            padding: 12px 16px;
            border-radius: 8px;
            margin-bottom: 20px;
            border-right: 4px solid #198754;
            font-size: 0.88rem;
            text-align: center;
        }

        .alert-success strong {
            direction: ltr;
            display: inline-block;
            font-size: 1.1rem;
            letter-spacing: 4px;
        }

        .form-error {
            color: #dc3545;
            font-size: 0.82rem;
            margin-top: 6px;
        }

        .otp-footer {
            text-align: center;
            margin-top: 25px;
            color: #adb5bd;
            font-size: 0.82rem;
        }

        .otp-footer a {
            color: #0d6efd;
            text-decoration: none;
        }

        .otp-footer a:hover {
            text-decoration: underline;
        }

        @media (max-width: 480px) {
            .otp-card {
                padding: 30px 22px;
            }

            .otp-title {
                font-size: 1.3rem;
            }

            .code-input {
                font-size: 1.5rem;
                letter-spacing: 8px;
            }
        }
    </style>
</head>
<body>

<div class="otp-card">

    <div class="otp-logo">
        📱
    </div>

    <h1 class="otp-title">
        تایید شماره
    </h1>

    <p class="otp-subtitle">
        کد ارسال شده به شماره
        <strong>{{ $phone }}</strong>
        را وارد کنید
    </p>

    @if ($errors->any())
        <div class="alert-error">
            @foreach ($errors->all() as $error)
                <p>{{ $error }}</p>
            @endforeach
        </div>
    @endif

    @if(isset($code))
        <div class="alert-success">
            کد تست: <strong>{{ $code }}</strong>
        </div>
    @endif

    @if(session('error'))
        <div class="alert-error">
            {{ session('error') }}
        </div>
    @endif

    <form action="{{ route('auth.verify-otp') }}" method="POST">
        @csrf

        <input
            type="hidden"
            name="phone"
            value="{{ $phone }}"
        >

        <input
            type="text"
            name="code"
            class="code-input"
            placeholder="----"
            maxlength="4"
            inputmode="numeric"
            autocomplete="off"
            required
        >

        @error('code')
        <div class="form-error">
            {{ $message }}
        </div>
        @enderror

        <button type="submit" class="btn-verify">
            تایید کد
        </button>

    </form>

    <div class="otp-footer">
        کد را دریافت نکردید؟
        <a href="{{ route('auth.login') }}">ارسال مجدد</a>
    </div>

</div>

<script src="{{ asset('js/bootstrap.bundle.min.js') }}"></script>

</body>
</html>
