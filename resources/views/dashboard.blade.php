<!DOCTYPE html>
<html lang="fa" dir="rtl">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>داشبورد</title>

    <style>
        * {
            box-sizing: border-box;
        }

        body {
            margin: 0;
            font-family: Arial, sans-serif;
            background: #f5f5f5;
        }

        .container {
            width: 90%;
            max-width: 1000px;
            margin: 50px auto;
        }

        .header {
            background: #222;
            color: white;
            padding: 25px;
            border-radius: 12px;
        }

        .card {
            margin-top: 20px;
            padding: 25px;
            background: white;
            border-radius: 12px;
        }

        .info {
            margin: 15px 0;
            padding: 15px;
            background: #f5f5f5;
            border-radius: 8px;
        }

        .logout {
            margin-top: 20px;
        }

        .logout button {
            padding: 12px 25px;
            border: none;
            border-radius: 8px;
            background: #d32f2f;
            color: white;
            cursor: pointer;
        }
    </style>
</head>

<body>
@if (session('success'))
    <div style="
        padding: 12px;
        margin-bottom: 20px;
        background-color: #d4edda;
        color: #155724;
        border-radius: 8px;
    ">
        {{ session('success') }}
    </div>
@endif
<div class="container">

    <div class="header">
        <h1>
            داشبورد
        </h1>

        <p>
            به پنل کاربری خوش آمدید.
        </p>
    </div>

    <div class="card">

        <h2>
            اطلاعات کاربر
        </h2>

        <div class="info">
            <strong>نام:</strong>

            {{ $user->name }}
        </div>

        <div class="info">
            <strong>شماره موبایل:</strong>

            {{ $user->phone }}
        </div>

        <div class="info">
            <strong>نقش:</strong>

            {{ $user->role }}
        </div>

    </div>

    <form
        class="logout"
        action="{{ route('auth.logout') }}"
        method="POST"
    >

        @csrf

        <button type="submit">
            خروج
        </button>

    </form>

</div>

</body>
</html>
