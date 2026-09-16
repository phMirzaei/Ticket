<!doctype html>
<html lang="fa" dir="rtl">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>اضافه کردن پشتیبان</title>

    <style>
        body {
            margin: 0;
            padding: 40px;
            font-family: Tahoma, Arial, sans-serif;
            background: #f5f5f5;
        }

        .container {
            max-width: 500px;
            margin: 50px auto;
            background: white;
            padding: 30px;
            border-radius: 10px;
        }

        h1 {
            margin-bottom: 25px;
        }

        .user-info {
            margin-bottom: 25px;
        }

        .user-info div {
            margin-bottom: 12px;
        }

        button {
            padding: 10px 18px;
            border: none;
            border-radius: 6px;
            background: #16a34a;
            color: white;
            cursor: pointer;
        }

        button:hover {
            background: #15803d;
        }

        a {
            display: inline-block;
            margin-right: 10px;
            color: #555;
            text-decoration: none;
        }
    </style>
</head>

<body>

<div class="container">

    <h1>اضافه کردن پشتیبان</h1>

    <div class="user-info">

        <div>
            <strong>نام:</strong>
            {{ $user->name }}
        </div>

        <div>
            <strong>شماره:</strong>
            {{ $user->phone }}
        </div>

            <div>
                @php
                    $role = match ($user->role) {
                        'support' => 'پشتیبان',
                        'admin' => 'مدیر',
                        'customer' => 'مشتری',
                        default => $user->role,
                    };
                @endphp
            </div>

            <strong {{$user->role}}>
                نقش فعلی:
            </strong>
        <span>{{ $role }}</span>

    </div>

    <form action="{{ route('admin.add.store', $user) }}" method="POST">
        @csrf

        <button type="submit">
            تبدیل به پشتیبان
        </button>
    </form>

    <a href="{{ route('admin.dashboard') }}">
        بازگشت
    </a>

</div>

</body>

</html>
