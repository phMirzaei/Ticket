<!DOCTYPE html>
<html lang="fa" dir="rtl">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>تایید کد</title>

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

        input {
            width: 100%;

            padding: 14px;

            margin-top: 20px;

            border: 1px solid #ddd;

            border-radius: 8px;

            font-size: 22px;

            text-align: center;

            letter-spacing: 6px;
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

    <h1>
        تایید شماره
    </h1>

    <p>
        کد ارسال شده به شماره
        <strong>{{ $phone }}</strong>
        را وارد کنید.
    </p>

    @if(isset($code))
        <p class="success">
            کد تست:
            <strong>{{ $code }}</strong>
        </p>
    @endif

    @if(session('error'))
        <div class="error">
            {{ session('error') }}
        </div>
    @endif

    <form action="{{ route('auth.verify-otp') }}" method="POST">

        @csrf

        <input
            type="hidden"
            name="phone"
            value="{{ $phone }}"
        >

        <input
            type="text"
            name="code"
            placeholder="----"
            maxlength="4"
            inputmode="numeric"
            required
        >

        @error('code')
        <div class="error">
            {{ $message }}
        </div>
        @enderror

        <button type="submit">
            تایید کد
        </button>

    </form>

</div>

</body>
</html>
