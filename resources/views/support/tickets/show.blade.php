<!DOCTYPE html>
<html lang="fa" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>مشاهده تیکت</title>

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

        .top-navbar .ticket-info {
            color: #6c757d;
            font-size: 0.9rem;
        }

        .main-card {
            background: #fff;
            border-radius: 12px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.04);
            padding: 25px;
            margin-bottom: 25px;
        }

        .ticket-subject {
            font-size: 1.3rem;
            font-weight: bold;
            color: #2c3136;
            margin-bottom: 15px;
        }

        .ticket-meta {
            color: #6c757d;
            font-size: 0.88rem;
            line-height: 1.9;
            margin-bottom: 15px;
        }

        .badge-status {
            padding: 6px 14px;
            border-radius: 6px;
            font-size: 0.82rem;
            font-weight: normal;
            display: inline-block;
        }

        .status.open {
            background-color: #cfe2ff;
            color: #084298;
        }

        .status.answered {
            background-color: #e2f0d9;
            color: #385723;
        }

        .status.closed {
            background-color: #d1e7dd;
            color: #0f5132;
        }

        .section-title {
            font-weight: bold;
            color: #2c3136;
            margin: 25px 0 15px;
            font-size: 1rem;
            padding-bottom: 8px;
            border-bottom: 2px solid #f1f3f5;
        }

        .original-message {
            background: #f8f9fa;
            padding: 18px;
            border-radius: 8px;
            border-right: 4px solid #0d6efd;
            line-height: 1.9;
            color: #2c3136;
            font-size: 0.92rem;
            white-space: pre-wrap;
        }

        .message-item {
            background: #f8f9fa;
            padding: 16px;
            border-radius: 8px;
            margin-bottom: 12px;
            border-right: 4px solid #adb5bd;
        }

        .message-item.support-message {
            background: #e7f1ff;
            border-right-color: #0d6efd;
        }

        .message-user {
            font-weight: bold;
            color: #2c3136;
            margin-bottom: 8px;
            font-size: 0.92rem;
            display: flex;
            align-items: center;
            gap: 8px;
        }

        .message-text {
            line-height: 1.9;
            color: #495057;
            font-size: 0.9rem;
            white-space: pre-wrap;
        }

        .message-date {
            display: block;
            margin-top: 10px;
            color: #adb5bd;
            font-size: 0.75rem;
        }

        .reply-form {
            background: #f8f9fa;
            padding: 20px;
            border-radius: 10px;
            margin-top: 20px;
        }

        .reply-form textarea {
            width: 100%;
            min-height: 130px;
            padding: 12px;
            border: 1px solid #dee2e6;
            border-radius: 8px;
            font-family: inherit;
            font-size: 0.9rem;
            resize: vertical;
            outline: none;
            transition: border-color 0.2s ease;
        }

        .reply-form textarea:focus {
            border-color: #0d6efd;
            box-shadow: 0 0 0 3px rgba(13, 110, 253, 0.1);
        }

        .btn-submit {
            padding: 9px 22px;
            border: none;
            border-radius: 8px;
            background: #0d6efd;
            color: #fff;
            cursor: pointer;
            font-size: 0.9rem;
            transition: background 0.2s ease;
        }

        .btn-submit:hover {
            background: #0b5ed7;
        }

        .btn-close-ticket {
            padding: 9px 22px;
            border: none;
            border-radius: 8px;
            background: #dc3545;
            color: #fff;
            cursor: pointer;
            font-size: 0.9rem;
            transition: background 0.2s ease;
        }

        .btn-close-ticket:hover {
            background: #bb2d3b;
        }

        .closed-notice {
            background: #f1f3f5;
            color: #6c757d;
            padding: 15px;
            border-radius: 8px;
            text-align: center;
            margin-top: 20px;
            font-size: 0.9rem;
        }

        .alert-success {
            background: #d1e7dd;
            color: #0f5132;
            padding: 12px 18px;
            border-radius: 8px;
            margin-bottom: 20px;
            border-right: 4px solid #198754;
        }

        .alert-error {
            background: #f8d7da;
            color: #842029;
            padding: 12px 18px;
            border-radius: 8px;
            margin-bottom: 20px;
            border-right: 4px solid #dc3545;
        }

        .back-link {
            display: inline-flex;
            align-items: center;
            gap: 6px;
            color: #6c757d;
            text-decoration: none;
            font-size: 0.88rem;
            margin-bottom: 15px;
            transition: color 0.2s ease;
        }

        .back-link:hover {
            color: #0d6efd;
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

            .main-card {
                padding: 18px;
            }

            .ticket-subject {
                font-size: 1.1rem;
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
                <a href="{{ route('support.tickets.index') }}" class="active">🎫 تیکت‌ها</a>
                <a href="{{ route('support.users') }}">👥 کاربران</a>

                <form action="{{ route('auth.logout') }}" method="POST">
                    @csrf
                    <button type="submit">🚪 خروج</button>
                </form>
            </nav>
        </div>

        <main class="col-md-9 col-lg-10 p-4">

            <div class="top-navbar">
                <h4>مشاهده تیکت</h4>
                <span class="ticket-info">شناسه: #{{ $ticket->id }}</span>
            </div>

            <a href="{{ route('support.tickets.index') }}" class="back-link">
                ← بازگشت به لیست تیکت‌ها
            </a>

            @if(session('success'))
                <div class="alert-success">
                    {{ session('success') }}
                </div>
            @endif

            @if($errors->any())
                <div class="alert-error">
                    {{ $errors->first() }}
                </div>
            @endif

            <div class="main-card">

                <div class="ticket-subject">
                    موضوع: {{ $ticket->subject }}
                </div>

                @php
                    $status = match ($ticket->status) {
                        'open' => 'در انتظار پاسخ',
                        'answered' => 'پاسخ داده شده',
                        'closed' => 'بسته شده',
                        default => $ticket->status,
                    };
                @endphp

                <div class="ticket-meta">
                    کاربر: {{ $ticket->user->name }} <br>
                    تاریخ ثبت:
                    {{ str_replace(
                        ['0','1','2','3','4','5','6','7','8','9'],
                        ['۰','۱','۲','۳','۴','۵','۶','۷','۸','۹'],
                        \Morilog\Jalali\Jalalian::fromDateTime($ticket->created_at)->format('Y/m/d H:i')
                    ) }}
                </div>

                <span class="badge-status status {{ $ticket->status }}">
                    وضعیت: {{ $status }}
                </span>

                <div class="section-title">متن تیکت</div>

                <div class="original-message">
                    {{ $ticket->message }}
                </div>

                <div class="section-title">گفتگو</div>

                @forelse($ticket->messages as $message)

                    <div class="message-item {{ $message->user->role == 'support' ? 'support-message' : '' }}">

                        <div class="message-user">
                            @if($message->user->role == 'support')
                                🎧 پشتیبان
                            @else
                                👤 {{ $message->user->name }}
                            @endif
                        </div>

                        <div class="message-text">
                            {{ $message->message }}
                        </div>

                        <small class="message-date">
                            {{ str_replace(
                                ['0','1','2','3','4','5','6','7','8','9'],
                                ['۰','۱','۲','۳','۴','۵','۶','۷','۸','۹'],
                                \Morilog\Jalali\Jalalian::fromDateTime(
                                    $message->created_at->setTimezone('Asia/Tehran')
                                )->format('Y/m/d H:i')
                            ) }}
                        </small>

                    </div>

                @empty

                    <div class="message-item">
                        <div class="message-text text-muted">
                            هنوز پیامی ارسال نشده است.
                        </div>
                    </div>

                @endforelse

                @if($ticket->status !== 'closed')

                    <div class="reply-form">

                        <div class="section-title mt-0">ارسال پاسخ</div>

                        <form action="{{ route('support.tickets.messages.store', $ticket) }}" method="POST">
                            @csrf

                            <textarea
                                name="message"
                                placeholder="پاسخ خود را بنویسید..."
                                required
                            ></textarea>

                            <div class="d-flex gap-2 mt-3 flex-wrap">
                                <button type="submit" class="btn-submit">
                                    ارسال پاسخ
                                </button>
                            </div>
                        </form>

                    </div>

                @else

                    <div class="closed-notice">
                        این تیکت بسته شده است و امکان ارسال پاسخ وجود ندارد.
                    </div>

                @endif

            </div>

        </main>
    </div>
</div>

<script src="{{ asset('js/bootstrap.bundle.min.js') }}"></script>

</body>
</html>
