<!DOCTYPE html>
<html lang="fa" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>ثبت تیکت جدید</title>

    <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet">

    <style>
        * {
            box-sizing: border-box;
        }

        body {
            background-color: #f4f6f9;
            overflow-x: hidden;
            margin: 0;
            min-height: 100vh;
        }

        .user-navbar {
            background: #fff;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.05);
            padding: 15px 30px;
            display: flex;
            justify-content: space-between;
            align-items: center;
            position: sticky;
            top: 0;
            z-index: 100;
        }

        .user-navbar .brand {
            font-weight: bold;
            font-size: 1.1rem;
            color: #2c3136;
            text-decoration: none;
        }

        .user-navbar .user-info {
            display: flex;
            align-items: center;
            gap: 15px;
        }

        .user-avatar {
            width: 42px;
            height: 42px;
            border-radius: 50%;
            background: #0d6efd;
            color: #fff;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: bold;
            font-size: 1.1rem;
        }

        .user-name {
            color: #2c3136;
            font-weight: 500;
            font-size: 0.92rem;
        }

        .btn-logout {
            background: none;
            border: 1px solid #dc3545;
            color: #dc3545;
            padding: 7px 15px;
            border-radius: 8px;
            font-family: inherit;
            font-size: 0.85rem;
            cursor: pointer;
            transition: all 0.2s ease;
        }

        .btn-logout:hover {
            background: #dc3545;
            color: #fff;
        }

        .main-container {
            max-width: 700px;
            margin: 0 auto;
            padding: 30px 20px;
        }

        .back-link {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            color: #6c757d;
            text-decoration: none;
            font-size: 0.88rem;
            margin-bottom: 20px;
            transition: color 0.2s ease;
        }

        .back-link:hover {
            color: #0d6efd;
        }

        .form-card {
            background: #fff;
            border-radius: 16px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.05);
            padding: 35px 30px;
            position: relative;
            overflow: hidden;
        }

        .form-card::before {
            content: '';
            position: absolute;
            top: 0;
            right: 0;
            left: 0;
            height: 5px;
            background: linear-gradient(90deg, #0dcaf0, #7cb342, #198754);
        }

        .form-header {
            text-align: center;
            margin-bottom: 30px;
        }

        .form-icon {
            width: 70px;
            height: 70px;
            margin: 0 auto 18px;
            background: #2c3136;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.8rem;
        }

        .form-title {
            font-weight: bold;
            color: #2c3136;
            margin-bottom: 6px;
            font-size: 1.4rem;
        }

        .form-subtitle {
            color: #6c757d;
            font-size: 0.88rem;
            margin: 0;
            line-height: 1.8;
        }

        .alert-error {
            background: #f8d7da;
            color: #842029;
            padding: 14px 18px;
            border-radius: 10px;
            margin-bottom: 22px;
            border-right: 4px solid #dc3545;
            font-size: 0.88rem;
        }

        .alert-error p {
            margin: 0;
            line-height: 1.8;
        }

        .alert-error p + p {
            margin-top: 6px;
        }

        .form-label-custom {
            display: block;
            color: #2c3136;
            font-weight: 500;
            margin-bottom: 8px;
            font-size: 0.9rem;
        }

        .form-input-custom,
        .form-textarea-custom {
            width: 100%;
            padding: 13px 16px;
            border: 2px solid #e9ecef;
            border-radius: 10px;
            font-size: 0.95rem;
            font-family: inherit;
            transition: all 0.2s ease;
            outline: none;
            color: #2c3136;
            line-height: 1.8;
        }

        .form-input-custom:focus,
        .form-textarea-custom:focus {
            border-color: #0d6efd;
            box-shadow: 0 0 0 4px rgba(13, 110, 253, 0.1);
        }

        .form-input-custom::placeholder,
        .form-textarea-custom::placeholder {
            color: #adb5bd;
        }

        .form-textarea-custom {
            min-height: 180px;
            resize: vertical;
        }

        .form-group {
            margin-bottom: 22px;
        }

        .btn-submit {
            width: 100%;
            padding: 14px;
            background: #2c3136;
            color: #fff;
            border: none;
            border-radius: 10px;
            font-size: 1rem;
            font-family: inherit;
            font-weight: 500;
            cursor: pointer;
            transition: all 0.2s ease;
            display: flex;
            align-items: center;
            justify-content: center;
            gap: 8px;
        }

        .btn-submit:hover {
            background: #1a1e22;
            transform: translateY(-2px);
            box-shadow: 0 8px 20px rgba(44, 49, 54, 0.3);
        }

        .btn-submit:active {
            transform: translateY(0);
        }

        .form-footer {
            text-align: center;
            margin-top: 20px;
            color: #adb5bd;
            font-size: 0.8rem;
        }

        @media (max-width: 768px) {
            .user-navbar {
                padding: 12px 15px;
            }

            .user-navbar .brand {
                font-size: 0.95rem;
            }

            .user-name {
                display: none;
            }

            .form-card {
                padding: 25px 20px;
            }

            .form-title {
                font-size: 1.2rem;
            }
        }
    </style>
</head>
<body>

<nav class="user-navbar">
    <a href="{{ route('tickets.index') }}" class="brand">
        🎫 پشتیبانی آنلاین
    </a>

    <div class="user-info">
        <div class="user-avatar">
            {{ mb_substr(auth()->user()->name, 0, 1) }}
        </div>
        <span class="user-name">{{ auth()->user()->name }}</span>

        <form action="{{ route('auth.logout') }}" method="POST">
            @csrf
            <button type="submit" class="btn-logout">
                خروج
            </button>
        </form>
    </div>
</nav>

<div class="main-container">

    <a href="{{ route('dashboard') }}" class="back-link">
        ← بازگشت به داشبورد
    </a>

    <div class="form-card">

        <div class="form-header">
            <div class="form-icon">✏️</div>
            <h1 class="form-title">ثبت تیکت جدید</h1>
            <p class="form-subtitle">مشکل یا درخواست خود را با تیم پشتیبانی در میان بگذارید</p>
        </div>

        @if ($errors->any())
            <div class="alert-error">
                @foreach ($errors->all() as $error)
                    <p>{{ $error }}</p>
                @endforeach
            </div>
        @endif

        <form action="{{ route('tickets.store') }}" method="POST">
            @csrf

            <div class="form-group">
                <label for="subject" class="form-label-custom">
                    موضوع تیکت
                </label>

                <input
                    type="text"
                    id="subject"
                    name="subject"
                    class="form-input-custom"
                    value="{{ old('subject') }}"
                    placeholder="موضوع تیکت را وارد کنید"
                    maxlength="255"
                    required
                >
            </div>

            <div class="form-group">
                <label for="message" class="form-label-custom">
                    متن تیکت
                </label>

                <textarea
                    id="message"
                    name="message"
                    class="form-textarea-custom"
                    placeholder="مشکل یا درخواست خود را با جزئیات بنویسید..."
                    required
                >{{ old('message') }}</textarea>
            </div>

            <button type="submit" class="btn-submit">
                📨 ثبت تیکت
            </button>

        </form>

        <div class="form-footer">
            پس از ثبت، تیم پشتیبانی در اسرع وقت پاسخ می‌دهد
        </div>

    </div>

</div>

<script src="{{ asset('js/bootstrap.bundle.min.js') }}"></script>

</body>
</html>
