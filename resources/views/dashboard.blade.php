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
                    {{ $ticket->subject }}
                </h3>

                <p>
                    {{ $ticket->message }}
                </p>

                @if($ticket->status === 'open')

                    <span class="open">
                        باز
                    </span>

                @elseif($ticket->status === 'closed')

                    <span class="closed">
                        بسته شده
                    </span>

                @endif

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
