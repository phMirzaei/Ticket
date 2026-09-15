<!DOCTYPE html>

<html lang="fa" dir="rtl">

<head>
    <meta charset="UTF-8">

    <title>داشبورد</title>

    <style>
        body {
            margin: 0;
            font-family: Tahoma, Arial, sans-serif;
            background: #f5f5f5;
        }

        .container {
            width: 900px;
            max-width: 90%;
            margin: 40px auto;
        }
        .meta {
            color: #777;
            font-size: 14px;
            line-height: 2;
        }

        .header {
            background: white;
            padding: 20px;
            border: 1px solid #ddd;
            border-radius: 8px;
            margin-bottom: 20px;
        }

        .header h1 {
            margin: 0 0 10px;
        }

        .header p {
            margin: 0;
            color: #666;
        }

        .button {
            display: inline-block;
            margin-top: 15px;
            padding: 10px 15px;
            background: #2563eb;
            color: white;
            text-decoration: none;
            border-radius: 5px;
        }

        .logout {
            display: inline-block;
            margin-top: 15px;
            margin-right: 10px;
        }

        .logout button {
            padding: 10px 15px;
            background: #dc2626;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        .tickets {
            background: white;
            padding: 20px;
            border: 1px solid #ddd;
            border-radius: 8px;
        }

        .tickets h2 {
            margin-top: 0;
        }

        .ticket {
            padding: 15px 0;
            border-bottom: 1px solid #eee;
        }

        .ticket:last-child {
            border-bottom: none;
        }

        .ticket h3 {
            margin: 0 0 8px;
        }

        .ticket p {
            margin: 5px 0;
            color: #666;
        }

        .open {
            color: #2563eb;
        }

        .closed {
            color: #15803d;
        }

        .status {
            display: inline-block;
            margin-left: 10px;
            padding: 5px 10px;
            border-radius: 5px;
            font-size: 13px;
        }

        .status.open {
            background: #dbeafe;
            color: #1d4ed8;
        }

        .status.answered {
            background: #fef3c7;
            color: #b45309;
        }

        .status.closed {
            background: #dcfce7;
            color: #15803d;
        }

        .show-ticket {
            display: inline-block;
            padding: 7px 12px;
            background: #333;
            color: white;
            text-decoration: none;
            border-radius: 5px;
            font-size: 13px;
        }

        .show-ticket:hover {
            background: #222;
        }
    </style>

</head>

<body>

<div class="container">

    <div class="header">

        <h1>
            سلام {{ $user->name }}
        </h1>

        <p>
            به داشبورد خودت خوش آمدی.
        </p>

        <a href="{{ route('tickets.create') }}" class="button">
            ثبت تیکت جدید
        </a>

        <form action="{{ route('auth.logout') }}" method="POST" class="logout">
            @csrf

            <button type="submit">
                خروج
            </button>
        </form>

    </div>


    <div class="tickets">

        <h2>
            تیکت‌های من
        </h2>

        @forelse($tickets as $ticket)

            <div class="ticket">

                <h3>
                    موضوع:  {{ $ticket->subject }}
                </h3>

                <p>
                    توضیحات:  {{ $ticket->message }}
                </p>
                <div class="meta">
                    تاریخ ثبت:
                    {{ str_replace(
                    ['0','1','2','3','4','5','6','7','8','9'],
                    ['۰','۱','۲','۳','۴','۵','۶','۷','۸','۹'],
                    \Morilog\Jalali\Jalalian::fromDateTime(
                        $ticket->created_at->setTimezone('Asia/Tehran')
                    )->format('Y/m/d H:i')
                    ) }}                </div>
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
                <a
                    href="{{ route('tickets.show', $ticket) }}"
                    class="show-ticket"
                >
                    مشاهده تیکت
                </a>

            </div>

        @empty

            <p>
                هنوز تیکتی ثبت نکرده‌اید.
            </p>

        @endforelse

    </div>

</div>

</body>

</html>
