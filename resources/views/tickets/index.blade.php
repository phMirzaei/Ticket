<!DOCTYPE html>
<html lang="fa" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>تیکت‌های من</title>

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
            max-width: 900px;
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

        .page-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 25px;
            flex-wrap: wrap;
            gap: 15px;
        }

        .page-title {
            margin: 0;
            font-size: 1.4rem;
            font-weight: bold;
            color: #2c3136;
        }

        .page-title .count {
            color: #6c757d;
            font-size: 0.85rem;
            font-weight: normal;
            margin-right: 10px;
        }

        .btn-new-ticket {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            padding: 11px 22px;
            background: #2c3136;
            color: #fff;
            text-decoration: none;
            border-radius: 10px;
            font-size: 0.9rem;
            font-weight: 500;
            transition: all 0.2s ease;
        }

        .btn-new-ticket:hover {
            background: #1a1e22;
            transform: translateY(-2px);
            box-shadow: 0 6px 15px rgba(44, 49, 54, 0.3);
            color: #fff;
        }

        .ticket-card {
            background: #fff;
            border-radius: 12px;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.04);
            padding: 20px 22px;
            margin-bottom: 14px;
            border-right: 4px solid #0d6efd;
            transition: all 0.2s ease;
        }

        .ticket-card:hover {
            box-shadow: 0 6px 18px rgba(0, 0, 0, 0.08);
            transform: translateX(-3px);
        }

        .ticket-card.status-open {
            border-right-color: #0dcaf0;
        }

        .ticket-card.status-answered {
            border-right-color: #7cb342;
        }

        .ticket-card.status-closed {
            border-right-color: #198754;
            opacity: 0.85;
        }

        .ticket-card.status-closed:hover {
            opacity: 1;
        }

        .ticket-top {
            display: flex;
            justify-content: space-between;
            align-items: flex-start;
            margin-bottom: 12px;
            gap: 12px;
            flex-wrap: wrap;
        }

        .ticket-subject {
            margin: 0;
            font-size: 1.05rem;
            font-weight: bold;
            color: #2c3136;
        }

        .badge-status {
            padding: 5px 12px;
            border-radius: 6px;
            font-size: 0.78rem;
            font-weight: normal;
            display: inline-block;
            white-space: nowrap;
        }

        .badge-status.open {
            background-color: #cfe2ff;
            color: #084298;
        }

        .badge-status.answered {
            background-color: #e2f0d9;
            color: #385723;
        }

        .badge-status.closed {
            background-color: #d1e7dd;
            color: #0f5132;
        }

        .ticket-message {
            color: #6c757d;
            font-size: 0.9rem;
            line-height: 1.8;
            margin-bottom: 15px;
            display: -webkit-box;
            -webkit-line-clamp: 2;
            -webkit-box-orient: vertical;
            overflow: hidden;
        }

        .ticket-footer {
            display: flex;
            justify-content: space-between;
            align-items: center;
            border-top: 1px solid #f1f3f5;
            padding-top: 14px;
            gap: 12px;
            flex-wrap: wrap;
        }

        .ticket-date {
            color: #adb5bd;
            font-size: 0.8rem;
            display: inline-flex;
            align-items: center;
            gap: 6px;
        }

        .btn-show {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            padding: 8px 18px;
            background: #2c3136;
            color: #fff;
            text-decoration: none;
            border-radius: 8px;
            font-size: 0.83rem;
            transition: all 0.2s ease;
        }

        .btn-show:hover {
            background: #1a1e22;
            color: #fff;
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
            margin-bottom: 25px;
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

            .page-title {
                font-size: 1.15rem;
            }

            .ticket-card {
                padding: 16px 18px;
            }

            .ticket-footer {
                flex-direction: column;
                align-items: flex-start;
            }

            .btn-show {
                width: 100%;
                justify-content: center;
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

    <div class="page-header">
        <h1 class="page-title">
            🎫 تیکت‌های من
            <span class="count">({{ $tickets->count() }} تیکت)</span>
        </h1>

        <a href="{{ route('tickets.create') }}" class="btn-new-ticket">
            ✏️ ثبت تیکت جدید
        </a>
    </div>

    @forelse($tickets as $ticket)

        @php
            $status = match ($ticket->status) {
                'open' => 'در انتظار پاسخ',
                'answered' => 'پاسخ داده شده',
                'closed' => 'بسته شده',
                default => $ticket->status,
            };
        @endphp

        <div class="ticket-card status-{{ $ticket->status }}">

            <div class="ticket-top">
                <h3 class="ticket-subject">
                    {{ $ticket->subject }}
                </h3>

                <span class="badge-status {{ $ticket->status }}">
                    {{ $status }}
                </span>
            </div>

            <div class="ticket-message">
                {{ $ticket->message }}
            </div>

            <div class="ticket-footer">
                <span class="ticket-date">
                    📅
                    {{ str_replace(
                        ['0','1','2','3','4','5','6','7','8','9'],
                        ['۰','۱','۲','۳','۴','۵','۶','۷','۸','۹'],
                        \Morilog\Jalali\Jalalian::fromDateTime(
                            $ticket->created_at->setTimezone('Asia/Tehran')
                        )->format('Y/m/d H:i')
                    ) }}
                </span>

                <a href="{{ route('tickets.show', $ticket) }}" class="btn-show">
                    مشاهده تیکت ←
                </a>
            </div>

        </div>

    @empty

        <div class="empty-state">
            <div class="empty-icon">📭</div>
            <h3>هنوز تیکتی ثبت نکرده‌اید</h3>
            <p>اگه سوال یا مشکلی دارید، اولین تیکت خودتون رو ثبت کنید</p>

            <a href="{{ route('tickets.create') }}" class="btn-new-ticket">
                ✏️ ثبت اولین تیکت
            </a>
        </div>

    @endforelse

</div>

<script src="{{ asset('js/bootstrap.bundle.min.js') }}"></script>

</body>
</html>
