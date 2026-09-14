<!DOCTYPE html>
<html lang="fa" dir="rtl">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>تیکت‌های من</title>

    <style>
        * {
            box-sizing: border-box;
        }

        body {
            margin: 0;
            background: #f5f5f5;
            font-family: Tahoma, Arial, sans-serif;
            color: #333;
        }

        .page {
            width: 90%;
            max-width: 800px;
            margin: 40px auto;
        }

        .header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 25px;
        }

        .header h1 {
            margin: 0;
            font-size: 24px;
        }

        .new-ticket {
            background: #2563eb;
            color: white;
            text-decoration: none;
            padding: 9px 15px;
            border-radius: 5px;
        }

        .new-ticket:hover {
            background: #1d4ed8;
        }

        .ticket {
            background: white;
            border: 1px solid #ddd;
            border-radius: 6px;
            padding: 20px;
            margin-bottom: 15px;
        }

        .ticket-top {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 15px;
        }

        .ticket-top h3 {
            margin: 0;
            font-size: 18px;
        }

        .status {
            background: #eee;
            padding: 5px 10px;
            border-radius: 4px;
            font-size: 13px;
        }

        .ticket-message {
            line-height: 1.8;
            margin-bottom: 15px;
        }

        .ticket-info {
            display: flex;
            justify-content: space-between;
            align-items: center;
            border-top: 1px solid #eee;
            padding-top: 12px;
        }

        .date {
            color: #777;
            font-size: 13px;
        }

        .show-ticket {
            background: #333;
            color: white;
            text-decoration: none;
            padding: 7px 12px;
            border-radius: 4px;
            font-size: 13px;
        }

        .show-ticket:hover {
            background: #222;
        }

        .empty {
            background: white;
            border: 1px solid #ddd;
            border-radius: 6px;
            padding: 30px;
            text-align: center;
            color: #777;
        }
    </style>
</head>

<body>

<div class="page">

    <div class="header">
        <h1>تیکت‌های من</h1>

        <a href="{{ route('tickets.create') }}" class="new-ticket">
            ثبت تیکت جدید
        </a>
    </div>

    @forelse($tickets as $ticket)

        <div class="ticket">

            <div class="ticket-top">

                <h3>
                    {{ $ticket->subject }}
                </h3>
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

            <div class="ticket-message">
                {{ $ticket->message }}
            </div>

            <div class="ticket-info">

                <span class="date">
{{ \Morilog\Jalali\Jalalian::fromDateTime($ticket->created_at)->format('Y/m/d H:i') }}                </span>

                <a
                    href="{{ route('tickets.show', $ticket) }}"
                    class="show-ticket"
                >
                    مشاهده تیکت
                </a>

            </div>

        </div>

    @empty

        <div class="empty">
            هنوز هیچ تیکتی ثبت نکرده‌اید.
        </div>

    @endforelse

</div>

</body>
</html>
