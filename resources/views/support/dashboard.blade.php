<!DOCTYPE html>
<html lang="fa" dir="rtl">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>داشبورد پشتیبانی</title>

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
            width: 1100px;
            max-width: 92%;
            margin: 40px auto;
        }

        .header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 30px;
        }

        .header h1 {
            margin: 0;
            font-size: 25px;
        }

        .logout button {
            background: #dc2626;
            color: white;
            border: none;
            padding: 10px 18px;
            border-radius: 6px;
            cursor: pointer;
        }

        .stats {
            display: grid;
            grid-template-columns: repeat(3, 1fr);
            gap: 20px;
            margin-bottom: 30px;
        }

        .stat {
            background: white;
            border: 1px solid #ddd;
            border-radius: 10px;
            padding: 25px;
        }

        .stat-title {
            color: #777;
            margin-bottom: 12px;
        }

        .stat-number {
            font-size: 28px;
            font-weight: bold;
        }

        .tickets {
            background: white;
            border: 1px solid #ddd;
            border-radius: 10px;
            padding: 30px;
        }

        .tickets h2 {
            margin-top: 0;
            margin-bottom: 25px;
        }

        .ticket {
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 20px;

            padding: 20px 0;
            border-bottom: 1px solid #eee;
        }

        .ticket:last-child {
            border-bottom: none;
        }

        .ticket-info {
            flex: 1;
        }

        .ticket-subject {
            font-size: 17px;
            font-weight: bold;
            margin-bottom: 8px;
        }

        .ticket-user {
            color: #777;
            font-size: 14px;
            line-height: 1.8;
        }

        .ticket-status {
            padding: 7px 12px;
            border-radius: 5px;
            font-size: 13px;
            white-space: nowrap;
        }

        .open {
            background: #dbeafe;
            color: #1d4ed8;
        }

        .closed {
            background: #dcfce7;
            color: #15803d;
        }

        .show-btn {
            display: inline-block;
            background: #2563eb;
            color: white;
            text-decoration: none;
            padding: 9px 15px;
            border-radius: 6px;
            font-size: 13px;
            white-space: nowrap;
        }

        .show-btn:hover {
            background: #1d4ed8;
        }

        .empty {
            text-align: center;
            color: #777;
            padding: 40px 0;
        }

        @media (max-width: 700px) {
            .stats {
                grid-template-columns: 1fr;
            }

            .ticket {
                flex-direction: column;
                align-items: flex-start;
            }

            .header {
                gap: 15px;
                align-items: flex-start;
            }
        }
    </style>
</head>

<body>

<div class="container">

    <div class="header">
        <h1>
            داشبورد پشتیبانی
        </h1>

        <form action="{{ route('auth.logout') }}" method="POST" class="logout">
            @csrf

            <button type="submit">
                خروج
            </button>
        </form>
    </div>

    <div class="stats">

        <div class="stat">
            <div class="stat-title">
                کل تیکت‌ها
            </div>

            <div class="stat-number">
                {{ $tickets->count() }}
            </div>
        </div>

        <div class="stat">
            <div class="stat-title">
                تیکت‌های باز
            </div>

            <div class="stat-number">
                {{ $tickets->where('status', 'open')->count() }}
            </div>
        </div>

        <div class="stat">
            <div class="stat-title">
                تیکت‌های بسته
            </div>

            <div class="stat-number">
                {{ $tickets->where('status', 'closed')->count() }}
            </div>
        </div>

    </div>

    <div class="tickets">

        <h2>
            تیکت‌ها
        </h2>

        @forelse($tickets as $ticket)

            <div class="ticket">

                <div class="ticket-info">

                    <div class="ticket-subject">
                        {{ $ticket->subject }}
                    </div>

                    <div class="ticket-user">
                        کاربر: {{ $ticket->user->name }}

                        <br>

                        تاریخ:
                        {{ $ticket->created_at->format('Y/m/d H:i') }}
                    </div>

                </div>

                @if($ticket->status === 'open')

                    <span class="ticket-status open">
                        باز
                    </span>

                @elseif($ticket->status === 'closed')

                    <span class="ticket-status closed">
                        بسته شده
                    </span>

                @endif

                <a href="{{ route('support.tickets.show', $ticket) }}" class="show-btn">
                    مشاهده تیکت
                </a>

            </div>

        @empty

            <div class="empty">
                هنوز هیچ تیکتی ثبت نشده است.
            </div>

        @endforelse

    </div>

</div>

</body>

</html>
