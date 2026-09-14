<!doctype html>
<html lang="fa" dir="rtl">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>پشتیبان‌ها</title>

    <style>
        body {
            margin: 0;
            padding: 40px;
            font-family: Tahoma, Arial, sans-serif;
            background: #f5f5f5;
        }

        a {
            display: inline-block;
            padding: 10px 16px;
            margin-bottom: 25px;
            background: #2563eb;
            color: white;
            text-decoration: none;
            border-radius: 6px;
        }

        a:hover {
            background: #1d4ed8;
        }

        .support {
            background: white;
            padding: 18px;
            margin-bottom: 12px;
            border-radius: 8px;
        }

        .support-name {
            font-size: 18px;
            font-weight: bold;
            margin-bottom: 8px;
        }

        .support-phone {
            color: #666;
        }

        .empty {
            background: white;
            padding: 20px;
            border-radius: 8px;
            color: #666;
        }
    </style>
</head>

<body>

<a href="{{ route('admin.dashboard') }}">
    بازگشت به داشبورد
</a>

@forelse($supports as $support)

    <div class="support">

        <div class="support-name">
            {{ $support->name }}
        </div>

        <div class="support-phone">
            {{ $support->phone }}
        </div>

    </div>

@empty

    <div class="empty">
        هنوز پشتیبانی وجود ندارد.
    </div>

@endforelse

</body>

</html>
