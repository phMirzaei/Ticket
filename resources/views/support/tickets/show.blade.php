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
        }

        .container {
            width: 90%;
            max-width: 800px;
            margin: 40px auto;
        }

        .back {
            display: inline-block;
            margin-bottom: 20px;
            text-decoration: none;
            color: #2563eb;
        }

        .card {
            background: white;
            padding: 25px;
            border-radius: 8px;
        }

        .subject {
            font-size: 22px;
            font-weight: bold;
            margin-bottom: 10px;
        }

        .meta {
            color: #777;
            margin-bottom: 15px;
            line-height: 2;
        }

        .status {
            display: inline-block;
            padding: 5px 10px;
            border-radius: 5px;
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

        .title {
            font-weight: bold;
            margin: 25px 0 10px;
        }

        .original-message,
        .message {
            padding: 15px;
            background: #f5f5f5;
            border-radius: 5px;
            margin-bottom: 10px;
        }

        .message-user {
            font-weight: bold;
            margin-bottom: 8px;
        }

        .message-text {
            line-height: 2;
        }

        .message-date {
            display: block;
            margin-top: 8px;
            color: #777;
            font-size: 12px;
        }

        .reply-form {
            margin-top: 25px;
        }

        textarea {
            width: 100%;
            height: 120px;
            padding: 10px;
            box-sizing: border-box;
            margin-top: 10px;
            font-family: inherit;
            resize: vertical;
        }

        button {
            margin-top: 10px;
            padding: 10px 20px;
            border: none;
            border-radius: 5px;
            background: #2563eb;
            color: white;
            cursor: pointer;
            font-family: inherit;
        }

        button:hover {
            background: #1d4ed8;
        }

        .close-button {
            background: #dc2626;
            margin-right: 10px;
        }

        .close-button:hover {
            background: #b91c1c;
        }

        .success {
            margin-bottom: 15px;
            padding: 10px;
            background: #dcfce7;
            color: #15803d;
            border-radius: 5px;
        }

        .error {
            margin-bottom: 15px;
            padding: 10px;
            background: #fee2e2;
            color: #b91c1c;
            border-radius: 5px;
        }

        .closed-message {
            margin-top: 20px;
            padding: 12px;
            background: #f5f5f5;
            color: #777;
            border-radius: 5px;
            text-align: center;
        }
    </style>
</head>

<body>

<div class="container">

    <a href="{{ route('support.dashboard') }}" class="back">
        ← بازگشت به داشبورد
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
              موضوع:  {{ $ticket->subject }}
            </div>

            <div class="meta">
                کاربر: {{ $ticket->user->name }}

                <br>

                تاریخ ثبت:
                {{ \Morilog\Jalali\Jalalian::fromDateTime($ticket->created_at)->format('Y/m/d H:i') }}
            </div>
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


        <div class="title">
            متن تیکت
        </div>

        <div class="original-message">
            {{ $ticket->message }}
        </div>


        <div class="title">
            گفتگو
        </div>

        <div class="messages">

            @forelse($ticket->messages as $message)

                <div class="message">

                    <div class="message-user">
                        {{ $message->user->name }}
                    </div>

                    <div class="message-text">
                        {{ $message->message }}
                    </div>

                    <small class="message-date">
                        {{ \Morilog\Jalali\Jalalian::fromDateTime($ticket->created_at)->format('Y/m/d H:i') }}
                    </small>

                </div>

            @empty

                <div class="message">
                    هنوز پیامی ارسال نشده است.
                </div>

            @endforelse

        </div>


        @if($ticket->status !== 'closed')

            <div class="reply-form">

                <div class="title">
                    ارسال پاسخ
                </div>

                <form
                    action="{{ route('support.tickets.messages.store', $ticket) }}"
                    method="POST"
                >
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


                <form
                    action="{{ route('support.tickets.close', $ticket) }}"
                    method="POST"
                >
                    @csrf

                    <button type="submit" class="close-button">
                        بستن تیکت
                    </button>
                </form>

            </div>

        @else

            <div class="closed-message">
                این تیکت بسته شده است و امکان ارسال پاسخ وجود ندارد.
            </div>

        @endif

    </div>

</div>

</body>

</html>
