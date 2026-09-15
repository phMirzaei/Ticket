<!DOCTYPE html>
<html lang="fa" dir="rtl">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>مشاهده تیکت</title>

    <style>
        * {
            box-sizing: border-box;
        }

        body {
            margin: 0;
            font-family: Tahoma, Arial, sans-serif;
            background: #f5f5f5;
            color: #333;
        }

        .container {
            width: 90%;
            max-width: 900px;
            margin: 40px auto;
        }

        .back {
            display: inline-block;
            margin-bottom: 20px;
            color: #2563eb;
            text-decoration: none;
        }

        .card {
            background: white;
            padding: 25px;
            border: 1px solid #ddd;
            border-radius: 6px;
        }

        .header {
            border-bottom: 1px solid #ddd;
            padding-bottom: 20px;
            margin-bottom: 20px;
        }

        .subject {
            font-size: 22px;
            font-weight: bold;
            margin-bottom: 10px;
        }

        .meta {
            color: #777;
            font-size: 14px;
            line-height: 2;
        }

        .status {
            display: inline-block;
            margin-top: 10px;
            padding: 5px 10px;
            border-radius: 4px;
            font-size: 13px;
        }

        .open {
            background: #dbeafe;
            color: #1d4ed8;
        }

        .answered {
            background: #fef3c7;
            color: #b45309;
        }

        .closed {
            background: #dcfce7;
            color: #15803d;
        }

        .message-title {
            font-weight: bold;
            margin: 25px 0 10px;
        }

        .original-message {
            background: #f8f8f8;
            border: 1px solid #ddd;
            border-radius: 5px;
            padding: 15px;
            line-height: 2;
            white-space: pre-wrap;
        }

        .messages {
            display: flex;
            flex-direction: column;
            gap: 12px;
        }

        .message {
            background: #f8f8f8;
            border: 1px solid #ddd;
            border-radius: 5px;
            padding: 15px;
        }

        .message-user {
            font-weight: bold;
            margin-bottom: 8px;
        }

        .message-text {
            line-height: 2;
            white-space: pre-wrap;
        }

        .message-date {
            display: block;
            margin-top: 8px;
            color: #888;
            font-size: 12px;
        }

        .reply-form {
            margin-top: 25px;
            border-top: 1px solid #ddd;
            padding-top: 20px;
        }

        .reply-form textarea {
            width: 100%;
            min-height: 120px;
            padding: 12px;
            border: 1px solid #ccc;
            border-radius: 5px;
            resize: vertical;
            font-family: inherit;
            font-size: 14px;
        }

        .reply-form button {
            margin-top: 10px;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            background: #2563eb;
            color: white;
            cursor: pointer;
            font-family: inherit;
        }

        .reply-form button:hover {
            background: #1d4ed8;
        }

        .success {
            margin-bottom: 20px;
            padding: 10px 15px;
            border-radius: 5px;
            background: #dcfce7;
            color: #15803d;
        }

        .error {
            margin-bottom: 20px;
            padding: 10px 15px;
            border-radius: 5px;
            background: #fee2e2;
            color: #b91c1c;
        }
    </style>
</head>

<body>

<div class="container">

    <a href="{{ route('tickets.index') }}" class="back">
        ← بازگشت به تیکت‌های من
    </a>

    @if(session('success'))
        <div class="success">
            {{ session('success') }}
        </div>
    @endif

    @if($errors->any())
        <div class="error">
            {{ $errors->first() }}
        </div>
    @endif

    <div class="card">

        <div class="header">

            <div class="subject">
               موضوع: {{ $ticket->subject }}
            </div>

            <div class="meta">
                تاریخ ثبت:
                {{ str_replace(
                ['0','1','2','3','4','5','6','7','8','9'],
                ['۰','۱','۲','۳','۴','۵','۶','۷','۸','۹'],
                \Morilog\Jalali\Jalalian::fromDateTime(
                    $ticket->created_at->setTimezone('Asia/Tehran')
                )->format('Y/m/d H:i')
                ) }}            </div>
            @php
                $status = match ($ticket->status) {
                    'open' => 'در انتظار پاسخ',
                    'answered' => 'پاسخ داده شده',
                    'closed' => 'بسته شده',
                    default => $ticket->status,
                };
            @endphp

            <span class="status {{ $ticket->status }}">
                   وضعیت :   {{ $status }}
                </span>

        </div>

        <div class="message-title">
            متن تیکت
        </div>

        <div class="original-message">
            {{ $ticket->message }}
        </div>

        <div class="message-title">
            گفتگو
        </div>

        <div class="messages">

            @forelse($ticket->messages as $message)

                <div class="message">

                    <div class="message-user">

                        @if($message->user->role =='support')
                           پشتیبان
                        @else
                            {{ $message->user->name }}
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

                <div class="message">
                    هنوز پاسخی برای این تیکت ثبت نشده است.
                </div>

            @endforelse

        </div>

        @if($ticket->status !== 'closed')

            <div class="reply-form">

                <div class="message-title">
                    ارسال پاسخ
                </div>

                <form action="{{ route('tickets.reply', $ticket) }}" method="POST">

                    @csrf

                    <textarea
                        name="message"
                        placeholder="پاسخ خود را بنویسید..."
                        required
                    ></textarea>

                    <button type="submit">
                        ارسال پاسخ
                    </button>

                </form>
            </div>

        @endif

    </div>

</div>

</body>

</html>
