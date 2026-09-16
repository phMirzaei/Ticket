<!DOCTYPE html>
<html lang="fa" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>تکمیل اطلاعات</title>

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

        .profile-card {
            width: 100%;
            max-width: 420px;
            background: #fff;
            border-radius: 16px;
            box-shadow: 0 20px 50px rgba(0, 0, 0, 0.2);
            padding: 40px 32px;
            position: relative;
            overflow: hidden;
        }

        .profile-card::before {
            content: '';
            position: absolute;
            top: 0;
            right: 0;
            left: 0;
            height: 5px;
            background: linear-gradient(90deg, #0dcaf0, #7cb342, #198754);
        }

        .profile-logo {
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

        .profile-title {
            text-align: center;
            font-weight: bold;
            color: #2c3136;
            margin-bottom: 8px;
            font-size: 1.5rem;
        }

        .profile-subtitle {
            text-align: center;
            color: #6c757d;
            font-size: 0.9rem;
            margin-bottom: 30px;
            line-height: 1.9;
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
            color: #2c3136;
        }

        .form-input-custom:focus {
            border-color: #0d6efd;
            box-shadow: 0 0 0 4px rgba(13, 110, 253, 0.1);
        }

        .form-input-custom::placeholder {
            color: #adb5bd;
        }

        .btn-submit {
            width: 100%;
            padding: 13px;
            margin-top: 25px;
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

        .btn-submit:hover {
            background: #1a1e22;
            transform: translateY(-2px);
            box-shadow: 0 8px 20px rgba(44, 49, 54, 0.3);
        }

        .btn-submit:active {
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

        .form-error {
            color: #dc3545;
            font-size: 0.82rem;
            margin-top: 6px;
        }

        .profile-footer {
            text-align: center;
            margin-top: 25px;
            color: #adb5bd;
            font-size: 0.82rem;
        }

        @media (max-width: 480px) {
            .profile-card {
                padding: 30px 22px;
            }

            .profile-title {
                font-size: 1.3rem;
            }
        }
    </style>
</head>
<body>

<div class="profile-card">

    <div class="profile-logo">
        👤
    </div>

    <h1 class="profile-title">
        تکمیل اطلاعات
    </h1>

    <p class="profile-subtitle">
        برای ادامه، نام خود را وارد کنید
    </p>

    @if(session('error'))
        <div class="alert-error">
            {{ session('error') }}
        </div>
    @endif

    <form action="{{ route('profile.name') }}" method="POST">
        @csrf

        <label for="name" class="form-label-custom">
            نام و نام خانوادگی
        </label>

        <input
            type="text"
            id="name"
            name="name"
            class="form-input-custom"
            placeholder="مثلاً: علی رضایی"
            value="{{ old('name') }}"
            maxlength="100"
            autocomplete="off"
            required
        >

        @error('name')
        <div class="form-error">
            {{ $message }}
        </div>
        @enderror

        <button type="submit" class="btn-submit">
            ادامه
        </button>

    </form>

    <div class="profile-footer">
        اطلاعات شما نزد ما محفوظ است 🔒
    </div>

</div>

<script src="{{ asset('js/bootstrap.bundle.min.js') }}"></script>

</body>
</html>
