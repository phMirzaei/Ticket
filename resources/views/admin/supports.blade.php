<!DOCTYPE html>
<html lang="fa" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>پشتیبان‌ها</title>

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

        .top-navbar .support-count {
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

        .alert-success {
            background: #d1e7dd;
            color: #0f5132;
            padding: 12px 18px;
            border-radius: 8px;
            margin-bottom: 20px;
            border-right: 4px solid #198754;
            font-size: 0.9rem;
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

        .support-card {
            background: #fff;
            border-radius: 12px;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.04);
            padding: 18px 20px;
            margin-bottom: 12px;
            border-right: 4px solid #198754;
            transition: all 0.2s ease;
        }

        .support-card:hover {
            box-shadow: 0 6px 18px rgba(0, 0, 0, 0.08);
        }

        .support-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            flex-wrap: wrap;
            gap: 12px;
        }

        .support-info {
            display: flex;
            align-items: center;
            gap: 14px;
        }

        .support-avatar {
            width: 50px;
            height: 50px;
            border-radius: 50%;
            background: #198754;
            color: #fff;
            display: flex;
            align-items: center;
            justify-content: center;
            font-weight: bold;
            font-size: 1.2rem;
            flex-shrink: 0;
        }

        .support-name {
            font-weight: bold;
            color: #2c3136;
            font-size: 1rem;
            margin-bottom: 4px;
        }

        .support-phone {
            color: #6c757d;
            font-size: 0.85rem;
            direction: ltr;
            display: inline-block;
        }

        .badge-role {
            padding: 6px 14px;
            border-radius: 6px;
            font-size: 0.78rem;
            font-weight: normal;
            background-color: #e2f0d9;
            color: #385723;
            display: inline-block;
            white-space: nowrap;
        }

        .support-actions {
            display: flex;
            justify-content: flex-end;
            align-items: center;
            gap: 8px;
            border-top: 1px solid #f1f3f5;
            padding-top: 14px;
            margin-top: 14px;
        }

        .btn-change-role {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            padding: 8px 18px;
            background: #ffc107;
            color: #2c3136;
            border: none;
            border-radius: 8px;
            font-size: 0.82rem;
            font-family: inherit;
            font-weight: 500;
            cursor: pointer;
            transition: all 0.2s ease;
        }

        .btn-change-role:hover {
            background: #e0a800;
            transform: translateY(-2px);
            box-shadow: 0 6px 15px rgba(255, 193, 7, 0.4);
        }

        .empty-state {
            background: #fff;
            border-radius: 12px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.04);
            padding: 60px 30px;
            text-align: center;
        }

        .empty-state .empty-icon {
            font-size: 3.5rem;
            margin-bottom: 20px;
            opacity: 0.5;
        }

        .empty-state h3 {
            color: #2c3136;
            font-size: 1.1rem;
            margin-bottom: 10px;
        }

        .empty-state p {
            color: #6c757d;
            font-size: 0.9rem;
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

            .support-card {
                padding: 15px;
            }

            .support-info {
                gap: 10px;
            }

            .support-avatar {
                width: 42px;
                height: 42px;
                font-size: 1rem;
            }

            .support-header {
                flex-direction: column;
                align-items: flex-start;
            }

            .support-actions {
                justify-content: flex-start;
                width: 100%;
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
                <a href="{{ route('admin.supports') }}" class="active">🎧 پشتیبان‌ها</a>

                <form action="{{ route('auth.logout') }}" method="POST">
                    @csrf
                    <button type="submit">🚪 خروج</button>
                </form>
            </nav>
        </div>

        <main class="col-md-9 col-lg-10 p-4">

            <div class="top-navbar">
                <h4>لیست پشتیبان‌ها</h4>
                <span class="support-count">تعداد کل: {{ $supports->count() }}</span>
            </div>

            <a href="{{ route('admin.dashboard') }}" class="back-link">
                ← بازگشت به داشبورد
            </a>

            @if(session('success'))
                <div class="alert-success">
                    {{ session('success') }}
                </div>
            @endif

            <div class="stat-card">
                <div class="stat-icon">🎧</div>
                <div class="stat-title">تعداد پشتیبان‌ها</div>
                <div class="stat-number">{{ $supports->count() }}</div>
            </div>

            <div class="page-header">
                <h5>🎧 همه پشتیبان‌ها</h5>
            </div>

            @forelse($supports as $support)

                <div class="support-card">

                    <div class="support-header">

                        <div class="support-info">
                            <div class="support-avatar">
                                {{ mb_substr($support->name, 0, 1) }}
                            </div>

                            <div>
                                <div class="support-name">{{ $support->name }}</div>
                                <div class="support-phone">{{ $support->phone ?? 'ثبت نشده' }}</div>
                            </div>
                        </div>

                        <span class="badge-role">🎧 پشتیبان</span>

                    </div>

                    <div class="support-actions">
                        <form action="{{ route('admin.delete.support', $support) }}" method="POST" onsubmit="return confirm('آیا از تبدیل این پشتیبان به مشتری مطمئن هستید؟');">
                            @csrf
                            @method('PUT')
                            <button type="submit" class="btn-change-role">
                                👤 تبدیل به مشتری
                            </button>
                        </form>
                    </div>

                </div>

            @empty

                <div class="empty-state">
                    <div class="empty-icon">📭</div>
                    <h3>هنوز پشتیبانی وجود ندارد</h3>
                    <p>از داشبورد می‌توانید کاربران را به پشتیبان تبدیل کنید</p>
                </div>

            @endforelse

        </main>
    </div>
</div>

<script src="{{ asset('js/bootstrap.bundle.min.js') }}"></script>

</body>
</html>
