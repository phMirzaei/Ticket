<!DOCTYPE html>
<html lang="fa" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>لیست کاربران</title>

    <link href="{{ asset('css/bootstrap.min.css') }}" rel="stylesheet">

    <style>
        body {
            background-color: #f4f6f9;
            overflow-x: hidden;
            margin: 0;
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

        .section-title {
            font-weight: bold;
            margin-bottom: 20px;
            color: #2c3136;
        }

        .users-table-card {
            background: #fff;
            border-radius: 12px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.04);
            padding: 20px;
            overflow-x: auto;
        }

        .users-table {
            width: 100%;
            border-collapse: separate;
            border-spacing: 0;
        }

        .users-table thead th {
            background-color: #f8f9fa;
            color: #495057;
            font-weight: bold;
            font-size: 0.9rem;
            padding: 14px 16px;
            text-align: right;
            border-bottom: 2px solid #e9ecef;
        }

        .users-table thead th:first-child {
            border-top-right-radius: 8px;
        }

        .users-table thead th:last-child {
            border-top-left-radius: 8px;
        }

        .users-table tbody td {
            padding: 14px 16px;
            border-bottom: 1px solid #f1f3f5;
            font-size: 0.9rem;
            color: #2c3136;
            text-align: right;
            vertical-align: middle;
        }

        .users-table tbody tr {
            transition: background-color 0.2s ease;
        }

        .users-table tbody tr:hover {
            background-color: #f8f9fa;
        }

        .users-table tbody tr:last-child td {
            border-bottom: none;
        }

        .user-avatar {
            width: 38px;
            height: 38px;
            border-radius: 50%;
            background-color: #0d6efd;
            color: #fff;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            font-weight: bold;
            font-size: 0.95rem;
            margin-left: 10px;
            vertical-align: middle;
        }

        .user-name {
            display: inline-block;
            vertical-align: middle;
            font-weight: 500;
        }

        .user-phone {
            direction: ltr;
            display: inline-block;
            font-weight: 500;
            color: #495057;
            letter-spacing: 0.5px;
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

            .users-table thead th,
            .users-table tbody td {
                padding: 10px 8px;
                font-size: 0.82rem;
            }

            .user-avatar {
                width: 32px;
                height: 32px;
                font-size: 0.8rem;
                margin-left: 6px;
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
                <a href="{{ route('support.dashboard') }}">🏠 داشبورد</a>
                <a href="{{ route('support.tickets.index') }}">🎫 تیکت‌ها</a>
                <a href="{{ route('support.users') }}" class="active">👥 کاربران</a>
                <a href="#">⚙️ تنظیمات</a>

                <form action="{{ route('auth.logout') }}" method="POST">
                    @csrf
                    <button type="submit">🚪 خروج</button>
                </form>
            </nav>
        </div>

        <main class="col-md-9 col-lg-10 p-4">

            <div class="top-navbar">
                <h4>لیست کاربران</h4>
                <span class="user-count">تعداد کل: {{ $users->count() }}</span>
            </div>

            <h5 class="section-title">همه کاربران</h5>

            <div class="users-table-card">
                @if($users->count() > 0)
                    <table class="users-table">
                        <thead>
                        <tr>
                            <th style="width: 60px;">#</th>
                            <th>نام کاربر</th>
                            <th>شماره تلفن</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($users as $index => $user)
                            <tr>
                                <td>{{ $index + 1 }}</td>
                                <td>
                                    <div class="user-avatar">
                                        {{ mb_substr($user->name, 0, 1) }}
                                    </div>
                                    <span class="user-name">{{ $user->name }}</span>
                                </td>
                                <td>
                                        <span class="user-phone">
                                            {{ $user->phone ?? 'ثبت نشده' }}
                                        </span>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                @else
                    <div class="alert alert-info text-center mb-0">
                        هنوز هیچ کاربری ثبت نشده است.
                    </div>
                @endif
            </div>

        </main>
    </div>
</div>

<script src="{{ asset('js/bootstrap.bundle.min.js') }}"></script>

</body>
</html>
