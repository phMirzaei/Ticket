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
            min-height: 100vh;
            background: #f4f6f9;
            font-family: Arial, sans-serif;
            color: #222;
        }

        .page {
            width: 100%;
            max-width: 900px;
            margin: 0 auto;
            padding: 50px 20px;
        }

        .header {
            background: white;
            padding: 25px 30px;
            border-radius: 14px;
            margin-bottom: 25px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.06);

            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        .header h1 {
            margin: 0;
            font-size: 26px;
        }

        .new-ticket {
            display: inline-block;
            padding: 11px 18px;
            background: #2563eb;
            color: white;
            text-decoration: none;
            border-radius: 8px;
            font-size: 14px;
        }

        .new-ticket:hover {
            background: #1d4ed8;
        }

        .ticket {
            background: white;
            border-radius: 14px;
            padding: 25px;
            margin-bottom: 18px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.06);
        }

        .ticket-top {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 15px;
        }

        .ticket h3 {
            margin: 0;
            font-size: 20px;
        }

        .ticket-message {
            color: #555;
            line-height: 1.8;
            margin-bottom: 20px;
        }

        .ticket-info {
            display: flex;
            justify-content: space-between;
            align-items: center;
            border-top: 1px solid #eee;
            padding-top: 15px;
        }

        .status {
            padding: 6px 12px;
            background: #e8f1ff;
            color: #2563eb;
            border-radius: 20px;
            font-size: 13px;
        }

        .date {
            color: #888;
            font-size: 13px;
        }

        .empty {
            background: white;
            padding: 50px 20px;
            text-align: center;
            border-radius: 14px;
            box-shadow: 0 4px 15px rgba(0, 0, 0, 0.06);
        }

        .empty p {
            color: #777;
            margin-bottom: 20px;
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

                <span class="status">
                    {{ $ticket->status }}
                </span>
            </div>

            <div class="ticket-message">
                {{ $ticket->message }}
            </div>

            <div class="ticket-info">

                <span class="date">
                    {{ $ticket->created_at->format('Y/m/d H:i') }}
                </span>



            </div>

        </div>

    @empty

        <div class="empty">

            <p>
                هنوز هیچ تیکتی ثبت نکرده‌اید.
            </p>

            <a href="{{ route('tickets.create') }}" class="new-ticket">
                ثبت اولین تیکت
            </a>

        </div>

    @endforelse

</div>

</body>
</html>
