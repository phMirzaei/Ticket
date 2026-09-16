<!DOCTYPE html>
<html lang="fa" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>اضافه کردن پشتیبان</title>

    <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet">

    <style>
        body {
            background-color: #f4f6f9;
            overflow-x: hidden;
            margin: 0;
            min-height: 100vh;
        }

        .sidebar {
            min-height: 100vh;
            background-color: #2c3136;
            color: #fff;
            padding: 25px 15px;
            position: sticky;
            top: 0;
            height: 100vh;
            overflow-y: auto;
        }

        .sidebar .brand {
            text-align: center;
            font-weight: bold;
            font-size: 1.2rem;
            margin-bottom: 30px;
            color: #fff;
        }

        .sidebar a {
            color: #b8bfc6;
            text-decoration: none;
            display: flex;
            align-items: center;
            gap: 10px;
            padding: 12px 15px;
            border-radius: 8px;
            margin-bottom: 5px;
            transition: all 0.3s ease;
            font-size: 0.95rem;
        }

        .sidebar a:hover,
        .sidebar a.active {
            background-color: #3d444b;
            color: #fff;
        }

        .sidebar form button {
            color: #ff6b6b;
            background: none;
            border: none;
            width: 100%;
            text-align: right;
            display: flex;
            align-items: center;
            gap: 10px;
            padding: 12px 15px;
            border-radius: 8px;
            margin-top: 20px;
            border-top: 1px solid #444;
            padding-top: 20px;
            font-family: inherit;
            font-size: 0.95rem;
            transition: all 0.3s ease;
            cursor: pointer;
        }

        .sidebar form button:hover {
            background-color: #3d444b;
            color: #ff8787;
        }

        .top-navbar {
            background-color: #fff;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.05);
            padding: 15px 25px;
            margin-bottom: 25px;
            border-radius: 10px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .top-navbar h4 {
            margin: 0;
            font-weight: bold;
            color: #2c3136;
        }

        .top-navbar .welcome {
            color: #6c757d;
            font-size: 0.9rem;
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
            max-width: 600px;
            margin: 0 auto;
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
            background: #198754;
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            font-size: 1.8rem;
            color: #fff;
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

        .user-info-box {
            background: #f8f9fa;
            border-radius: 12px;
            padding: 22px;
            margin-bottom: 25px;
            border-right: 4px solid #0d6efd;
        }

        .user-info-row {
            display: flex;
            justify-content: space-between;
            align-items: center;
            padding: 10px 0;
            border-bottom: 1px solid #e9ecef;
        }

        .user-info-row:last-child {
            border-bottom: none;
        }

        .user-info-label {
            color: #6c757d;
            font-size: 0.88rem;
        }

        .user-info-value {
            color: #2c3136;
            font-weight: 500;
            font-size: 0.92rem;
        }

        .user-info-value.phone {
            direction: ltr;
            display: inline-block;
        }

        .badge-role {
            padding: 5px 12px;
            border-radius: 6px;
            font-size: 0.78rem;
            font-weight: normal;
            display: inline-block;
        }

        .badge-role.customer {
            background-color: #cfe2ff;
            color: #084298;
        }

        .badge-role.support {
            background-color: #e2f0d9;
            color: #385723;
        }

        .badge-role.admin {
            background-color: #f8d7da;
            color: #842029;
        }

        .btn-submit {
            width: 100%;
            padding: 14px;
            background: #198754;
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
            background: #146c43;
            transform: translateY(-2px);
            box-shadow: 0 8px 20px rgba(25, 135, 84, 0.3);
        }

        .form-footer {
            text-align: center;
            margin-top: 20px;
            color: #adb5bd;
            font-size: 0.8rem;
        }

        @media (max-width: 768px) {
            .sidebar {
                position: fixed;
                right: -100%;
                width: 250px;
                z-index: 1000;
                transition: right 0.3s ease;
            }

            .sidebar.show {
                right: 0;
            }

            .form-card {
                padding: 25px 20px;
            }

            .form-title {
                font-size: 1.2rem;
            }

            .user-info-row {
                flex-direction: column;
                align-items: flex-start;
                gap: 4px;
            }
        }
    </style>
</head>
<body>

<div class="container-fluid">
    <div class="row g-0">

        <div class="col-md-3 col-lg-2 sidebar" id="sidebarMenu">
            <div class="brand">پنل مدیریت</div>
            <nav>
                <a href="{{ route('admin.dashboard') }}">🏠 داشبورد</a>
                <a href="{{ route('admin.supports') }}">🎧 پشتیبان‌ها</a>

                <form action="{{ route('auth.logout') }}" method="POST">
                    @csrf
                    <button type="submit">🚪 خروج</button>
                </form>
            </nav>
        </div>

        <main class="col-md-9 col-lg-10 p-4">

            <div class="top-navbar">
                <h4>اضافه کردن پشتیبان</h4>
                <span class="welcome">خوش آمدید، مدیر 👋</span>
            </div>

            <a href="{{ route('admin.dashboard') }}" class="back-link">
                ← بازگشت به داشبورد
            </a>

            <div class="form-card">

                <div class="form-header">
                    <div class="form-icon">🎧</div>
                    <h1 class="form-title">تبدیل کاربر به پشتیبان</h1>
                    <p class="form-subtitle">با این کار، کاربر به تیم پشتیبانی اضافه می‌شود</p>
                </div>

                @php
                    $role = match ($user->role) {
                        'support' => 'پشتیبان',
                        'admin' => 'مدیر',
                        'customer' => 'مشتری',
                        default => $user->role,
                    };
                @endphp

                <div class="user-info-box">

                    <div class="user-info-row">
                        <span class="user-info-label">نام کاربر</span>
                        <span class="user-info-value">{{ $user->name }}</span>
                    </div>

                    <div class="user-info-row">
                        <span class="user-info-label">شماره تماس</span>
                        <span class="user-info-value phone">{{ $user->phone ?? 'ثبت نشده' }}</span>
                    </div>

                    <div class="user-info-row">
                        <span class="user-info-label">نقش فعلی</span>
                        <span class="badge-role {{ $user->role }}">{{ $role }}</span>
                    </div>

                </div>

                <form action="{{ route('admin.add.store', $user) }}" method="POST">
                    @csrf

                    <button type="submit" class="btn-submit">
                        ➕ تبدیل به پشتیبان
                    </button>
                </form>

                <div class="form-footer">
                    پس از تبدیل، کاربر به پنل پشتیبانی دسترسی خواهد داشت
                </div>

            </div>

        </main>
    </div>
</div>

<script src="{{ asset('js/bootstrap.bundle.min.js') }}"></script>

</body>
</html>
