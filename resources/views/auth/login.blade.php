<!DOCTYPE html>
<html lang="fa" dir="rtl">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>ورود</title>

    <style>
        * {
            box-sizing: border-box;
        }

        body {
            margin: 0;
            min-height: 100vh;

            display: flex;
            justify-content: center;
            align-items: center;

            font-family: Arial, sans-serif;

            background: #f5f5f5;
        }

        .container {
            width: 100%;
            max-width: 400px;

            padding: 30px;

            background: white;

            border-radius: 12px;

            box-shadow: 0 5px 20px rgba(0, 0, 0, 0.08);
        }

        h1 {
            margin-bottom: 10px;
        }

        p {
            color: #666;
        }

        label {
            display: block;
            margin-top: 20px;
            margin-bottom: 8px;
        }

        input {
            width: 100%;

            padding: 12px;

            border: 1px solid #ddd;

            border-radius: 8px;

            font-size: 16px;
        }

        button {
            width: 100%;

            margin-top: 20px;

            padding: 12px;

            border: none;

            border-radius: 8px;

            background: #222;

            color: white;

            font-size: 16px;

            cursor: pointer;
        }

        .error {
            margin-top: 15px;

            color: red;
        }

        .success {
            margin-top: 15px;

            color: green;
        }
    </style>
</head>

<body>

<div class="container">

    <h1>ورود</h1>

    <p>
        برای ورود شماره موبایل خود را وارد کنید.
    </p>

    @if(session('error'))
        <div class="error">
            {{ session('error') }}
        </div>
    @endif

    <form action="{{ route('auth.request-otp') }}" method="POST">

        @csrf

        <label for="phone">
            شماره موبایل
        </label>

        <input
            type="text"
            id="phone"
            name="phone"
            placeholder="09123456789"
            value="{{ old('phone') }}"
            maxlength="11"
            required
        >

        @error('phone')
        <div class="error">
            {{ $message }}
        </div>
        @enderror

        <button type="submit">
            دریافت کد
        </button>

    </form>

</div>

</body>
</html>
