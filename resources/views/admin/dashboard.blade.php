<!DOCTYPE html>
<html lang="fa" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>داشبورد ادمین</title>

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

        .top-navbar .user-count {
            color: #6c757d;
            font-size: 0.9rem;
        }

        .page-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 20px;
            flex-wrap: wrap;
            gap: 12px;
        }

        .page-header h5 {
            margin: 0;
            font-weight: bold;
            color: #2c3136;
            font-size: 1.15rem;
        }

        .btn-supports {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            padding: 9px 18px;
            background: #2c3136;
            color: #fff;
            text-decoration: none;
            border-radius: 8px;
            font-size: 0.85rem;
            transition: all 0.2s ease;
        }

        .btn-supports:hover {
            background: #1a1e22;
            color: #fff;
            transform: translateY(-2px);
        }

        .stat-card {
            background: #fff;
            border-radius: 12px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.04);
            padding: 22px;
            text-align: center;
            margin-bottom: 25px;
            transition: transform 0.2s ease;
        }

        .stat-card:hover {
            transform: translateY(-4px);
            box-shadow: 0 6px 15px rgba(0, 0, 0, 0.08);
        }

        .stat-card .stat-icon {
            font-size: 2rem;
            margin-bottom: 10px;
        }

        .stat-card .stat-title {
            color: #6c757d;
            font-size: 0.85rem;
            margin-bottom: 10px;
        }

        .stat-card .stat-number {
            font-size: 2rem;
            font-weight: bold;
            color: #2c3136;
            margin: 0;
        }

        .user-card {
            background: #fff;
            border-radius: 12px;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.04);
            padding: 18px 20px;
            margin-bottom: 12px;
            transition: all 0.2s ease;
        }

        .user-card:hover {
            box-shadow: 0 6px 18px rgba(0, 0, 0, 0.08);
        }

        .user-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 12px;
            flex-wrap: wrap;
            gap: 10px;
        }

        .user-info {
            display: flex;
            align-items: center;
            gap: 12px;
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
            font-size: 1rem;
            flex-shrink: 0;
        }

        .user-name {
            font-weight: bold;
            color: #2c3136;
            font-size: 0.95rem;
        }

        .user-phone {
            color: #6c757d;
            font-size: 0.82rem;
            direction: ltr;
            display: inline-block;
        }

        .badge-role {
            padding: 5px 12px;
            border-radius: 6px;
            font-size: 0.78rem;
            font-weight: normal;
            display: inline-block;
            white-space: nowrap;
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

        .user-actions {
            display: flex;
            justify-content: flex-end;
            gap: 8px;
            border-top: 1px solid #f1f3f5;
            padding-top: 12px;
            margin-top: 12px;
        }

        .btn-add-support {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            padding: 8px 16px;
            background: #198754;
            color: #fff;
            text-decoration: none;
            border-radius: 8px;
            font-size: 0.82rem;
            transition: all 0.2s ease;
        }

        .btn-add-support:hover {
            background: #146c43;
            color: #fff;
        }

        .empty-state {
            background: #fff;
            border-radius: 12px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.04);
            padding: 50px 30px;
            text-align: center;
        }

        .empty-state .empty-icon {
            font-size: 3rem;
            margin-bottom: 15px;
            opacity: 0.5;
        }

        .empty-state p {
            color: #6c757d;
            margin: 0;
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

            .user-card {
                padding: 15px;
            }

            .user-header {
                flex-direction: column;
                align-items: flex-start;
            }

            .user-actions {
                justify-content: flex-start;
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
                <a href="{{ route('admin.dashboard') }}" class="active">🏠 داشبورد</a>
                <a href="{{ route('admin.supports') }}">🎧 پشتیبان‌ها</a>
                <form action="{{ route('auth.logout') }}" method="POST">
                    @csrf
                    <button type="submit">🚪 خروج</button>
                </form>
            </nav>
        </div>

        <main class="col-md-9 col-lg-10 p-4">

            <div class="top-navbar">
                <h4>داشبورد ادمین</h4>
                <span class="user-count">خوش آمدید، مدیر 👋</span>
            </div>

            <div class="stat-card">
                <div class="stat-icon">👥</div>
                <div class="stat-title">تعداد کل کاربران</div>
                <div class="stat-number">{{ $users->count() }}</div>
            </div>

            <div class="page-header">
                <h5>👥 لیست کاربران</h5>

                <a href="{{ route('admin.supports') }}" class="btn-supports">
                    🎧 مشاهده پشتیبان‌ها
                </a>
            </div>

            @forelse($users as $user)

                @php
                    $role = match ($user->role) {
                        'support' => 'پشتیبان',
                        'admin' => 'مدیر',
                        'customer' => 'مشتری',
                        default => $user->role,
                    };
                @endphp

                <div class="user-card">

                    <div class="user-header">

                        <div class="user-info">
                            <div class="user-avatar">
                                {{ mb_substr($user->name, 0, 1) }}
                            </div>

                            <div>
                                <div class="user-name">{{ $user->name }}</div>
                                <div class="user-phone">{{ $user->phone ?? 'ثبت نشده' }}</div>
                            </div>
                        </div>

                        <span class="badge-role {{ $user->role }}">
                            {{ $role }}
                        </span>

                    </div>

                    @if($user->role === 'customer')
                        <div class="user-actions">
                            <a href="{{ route('admin.add', $user) }}" class="btn-add-support">
                                ➕ اضافه کردن به پشتیبان‌ها
                            </a>
                        </div>
                    @endif

                </div>

            @empty

                <div class="empty-state">
                    <div class="empty-icon">📭</div>
                    <p>هنوز هیچ کاربری وجود ندارد.</p>
                </div>

            @endforelse

        </main>
    </div>
</div>

<script src="{{ asset('js/bootstrap.bundle.min.js') }}"></script>

</body>
</html>
