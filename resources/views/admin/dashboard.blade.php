<!doctype html>
<html lang="fa" dir="rtl">

<head>
    <meta charset="UTF-8">

    <title>داشبورد ادمین</title>

    <style>
        body {
            margin: 0;
            padding: 40px;
            font-family: Tahoma, Arial, sans-serif;
            background: #f5f5f5;
        }

        div {
            margin-bottom: 20px;
        }

        h1 {
            margin-bottom: 20px;
        }

        a {
            display: inline-block;
            padding: 10px 15px;
            margin-left: 10px;
            background: #2563eb;
            color: white;
            text-decoration: none;
            border-radius: 5px;
        }

        a:hover {
            background: #1d4ed8;
        }

        button {
            padding: 10px 15px;
            background: #dc2626;
            color: white;
            border: none;
            border-radius: 5px;
            cursor: pointer;
        }

        button:hover {
            background: #b91c1c;
        }

        .user {
            background: white;
            padding: 15px;
            border-radius: 8px;
            margin-bottom: 10px;
        }

        .user a {
            background: #16a34a;
            margin-top: 10px;
        }

        .user a:hover {
            background: #15803d;
        }
    </style>
</head>

<body>

<div>
    <h1>داشبورد ادمین</h1>

    <form action="{{ route('auth.logout') }}" method="post">
        @csrf

        <button type="submit">
            خروج
        </button>
    </form>
</div>

<div>
    تعداد کاربران
</div>

<div>
    {{ $users->count() }}
</div>

<div>

    <h2>
        کاربران
    </h2>

    @forelse($users as $user)

        <div class="user">

            <div>
                {{ $user->name }}
            </div>

            <div>
                {{ $user->number }}
            </div>

            <div>
                نقش: {{ $user->role }}
            </div>

            @if($user->role === 'customer')
                <a href="{{ route('admin.add', $user) }}">
                    اضافه کردن به پشتیبان‌ها
                </a>
            @elseif($user->role === 'support')

                <div>
                    پشتیبان
                </div>

            @elseif($user->role === 'admin')

                <div>
                    ادمین
                </div>

            @endif

        </div>

    @empty

        <div>
            هنوز هیچ کاربری وجود ندارد.
        </div>

    @endforelse

</div>

<div>
    <a href="{{ route('admin.supports') }}">
        مشاهده پشتیبان‌ها
    </a>
</div>

</body>

</html>
