<!DOCTYPE html>
<html lang="fa" dir="rtl">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>مشاهده تیکت</title>

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

        .alert-success {
            background: #d1e7dd;
            color: #0f5132;
            padding: 12px 18px;
            border-radius: 8px;
            margin-bottom: 20px;
            border-right: 4px solid #198754;
            font-size: 0.9rem;
        }

        .alert-error {
            background: #f8d7da;
            color: #842029;
            padding: 12px 18px;
            border-radius: 8px;
            margin-bottom: 20px;
            border-right: 4px solid #dc3545;
            font-size: 0.9rem;
        }

        .main-card {
            background: #fff;
            border-radius: 12px;
            box-shadow: 0 4px 10px rgba(0, 0, 0, 0.04);
            padding: 25px;
            margin-bottom: 25px;
        }

        .ticket-header {
            border-bottom: 2px solid #f1f3f5;
            padding-bottom: 20px;
            margin-bottom: 25px;
        }

        .ticket-subject {
            font-size: 1.3rem;
            font-weight: bold;
            color: #2c3136;
            margin-bottom: 12px;
        }

        .ticket-meta {
            color: #6c757d;
            font-size: 0.85rem;
            line-height: 1.9;
            margin-bottom: 12px;
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

        .section-title:first-of-type {
            margin-top: 0;
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

        .empty-messages {
            text-align: center;
            padding: 30px 20px;
            color: #adb5bd;
            font-size: 0.9rem;
            background: #f8f9fa;
            border-radius: 8px;
        }

        .reply-form {
            background: #f8f9fa;
            padding: 20px;
            border-radius: 10px;
            margin-top: 25px;
            border-top: 2px solid #f1f3f5;
        }

        .reply-form textarea {
            width: 100%;
            min-height: 130px;
            padding: 14px;
            border: 2px solid #e9ecef;
            border-radius: 10px;
            font-family: inherit;
            font-size: 0.9rem;
            resize: vertical;
            outline: none;
            transition: border-color 0.2s ease;
            color: #2c3136;
            line-height: 1.8;
        }

        .reply-form textarea:focus {
            border-color: #0d6efd;
            box-shadow: 0 0 0 4px rgba(13, 110, 253, 0.1);
        }

        .reply-form textarea::placeholder {
            color: #adb5bd;
        }

        .btn-reply {
            padding: 11px 26px;
            border: none;
            border-radius: 10px;
            background: #2c3136;
            color: #fff;
            cursor: pointer;
            font-size: 0.9rem;
            font-family: inherit;
            font-weight: 500;
            margin-top: 12px;
            transition: all 0.2s ease;
        }

        .btn-reply:hover {
            background: #1a1e22;
            transform: translateY(-2px);
            box-shadow: 0 6px 15px rgba(44, 49, 54, 0.3);
        }

        .closed-notice {
            background: #f1f3f5;
            color: #6c757d;
            padding: 18px;
            border-radius: 10px;
            text-align: center;
            margin-top: 25px;
            font-size: 0.9rem;
            border-right: 4px solid #adb5bd;
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

    <a href="{{ route('tickets.index') }}" class="back-link">
        ← بازگشت به تیکت‌های من
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

        <div class="ticket-header">

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
                تاریخ ثبت:
                {{ str_replace(
                    ['0','1','2','3','4','5','6','7','8','9'],
                    ['۰','۱','۲','۳','۴','۵','۶','۷','۸','۹'],
                    \Morilog\Jalali\Jalalian::fromDateTime(
                        $ticket->created_at->setTimezone('Asia/Tehran')
                    )->format('Y/m/d H:i')
                ) }}
            </div>

            <span class="badge-status status {{ $ticket->status }}">
                وضعیت: {{ $status }}
            </span>

        </div>

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

            <div class="empty-messages">
                💬 هنوز پاسخی برای این تیکت ثبت نشده است.
            </div>

        @endforelse

        @if($ticket->status !== 'closed')

            <div class="reply-form">

                <div class="section-title mt-0" style="border: none; padding: 0; margin-bottom: 15px;">
                    ارسال پاسخ
                </div>

                <form action="{{ route('tickets.reply', $ticket) }}" method="POST">
                    @csrf

                    <textarea
                        name="message"
                        placeholder="پاسخ خود را بنویسید..."
                        required
                    ></textarea>

                    <button type="submit" class="btn-reply">
                        ارسال پاسخ
                    </button>
                </form>

            </div>

        @else

            <div class="closed-notice">
                🔒 این تیکت بسته شده است و امکان ارسال پاسخ وجود ندارد.
            </div>

        @endif

    </div>

</div>

<script src="{{ asset('js/bootstrap.bundle.min.js') }}"></script>

</body>
</html>
