<!DOCTYPE html>
<html lang="fa" dir="rtl">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>مشاهده تیکت</title>

    <style>
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
            border-radius: 8px;
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
            margin-top: 15px;
            padding: 6px 10px;
            border-radius: 5px;
            font-size: 13px;
        }

        .open {
            background: #dbeafe;
            color: #1d4ed8;
        }

        .closed {
            background: #dcfce7;
            color: #15803d;
        }

        .message-title {
            font-weight: bold;
            margin-bottom: 10px;
        }

        .message {
            background: #f8f8f8;
            border: 1px solid #ddd;
            border-radius: 5px;
            padding: 15px;
            line-height: 2;
            min-height: 150px;
            white-space: pre-wrap;
        }
    </style>
</head>

<body>

<div class="container">

    <a href="{{ route('support.dashboard') }}" class="back">
        ← بازگشت به داشبورد
    </a>

    <div class="card">

        <div class="header">

            <div class="subject">
                {{ $ticket->subject }}
            </div>

            <div class="meta">
                کاربر: {{ $ticket->user->name }}

                <br>

                تاریخ ثبت:
                {{ $ticket->created_at->format('Y/m/d H:i') }}
            </div>

            @if($ticket->status === 'open')

                <span class="status open">
                    باز
                </span>

            @elseif($ticket->status === 'closed')

                <span class="status closed">
                    بسته شده
                </span>

            @endif

        </div>

        <div class="message-title">
            متن تیکت
        </div>

        <div class="message">
            {{ $ticket->message }}
        </div>

    </div>

</div>

</body>

</html>
