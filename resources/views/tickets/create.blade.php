<!DOCTYPE html>
<html lang="fa" dir="rtl">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <title>ثبت تیکت</title>

    <style>
        * {
            box-sizing: border-box;
        }

        body {
            margin: 0;
            font-family: Arial, sans-serif;
            background-color: #f5f5f5;

            display: flex;
            justify-content: center;
            align-items: center;

            min-height: 100vh;
        }

        .ticket-box {
            width: 500px;
            background-color: white;
            padding: 30px;
            border-radius: 12px;
            box-shadow: 0 5px 20px rgba(0, 0, 0, 0.08);
        }

        .ticket-box h1 {
            margin-top: 0;
            margin-bottom: 25px;
            text-align: center;
        }

        .form-group {
            margin-bottom: 20px;
        }

        .form-group label {
            display: block;
            margin-bottom: 8px;
            font-weight: bold;
        }

        .form-group input,
        .form-group textarea {
            width: 100%;
            padding: 12px;
            border: 1px solid #ddd;
            border-radius: 8px;
            font-size: 15px;
            font-family: inherit;
            outline: none;
        }

        .form-group input:focus,
        .form-group textarea:focus {
            border-color: #333;
        }

        .form-group textarea {
            min-height: 180px;
            resize: vertical;
        }

        .submit-button {
            width: 100%;
            padding: 13px;
            border: none;
            border-radius: 8px;
            background-color: #222;
            color: white;
            font-size: 16px;
            cursor: pointer;
        }

        .submit-button:hover {
            opacity: 0.9;
        }

        .errors {
            margin-bottom: 20px;
            padding: 10px;
            background-color: #ffe5e5;
            border-radius: 8px;
        }

        .errors p {
            margin: 5px 0;
        }
    </style>
</head>

<body>

<div class="ticket-box">

    <h1>ثبت تیکت</h1>

    @if ($errors->any())
        <div class="errors">
            @foreach ($errors->all() as $error)
                <p>{{ $error }}</p>
            @endforeach
        </div>
    @endif

    <form action="{{ route('tickets.store') }}" method="POST">

        @csrf

        <div class="form-group">

            <label for="subject">
                موضوع تیکت
            </label>

            <input
                type="text"
                id="subject"
                name="subject"
                value="{{ old('subject') }}"
                placeholder="موضوع تیکت را وارد کنید"
            >

        </div>

        <div class="form-group">

            <label for="message">
                متن تیکت
            </label>

            <textarea
                id="message"
                name="message"
                placeholder="مشکل یا درخواست خود را بنویسید..."
            >{{ old('message') }}</textarea>

        </div>

        <button
            type="submit"
            class="submit-button"
        >
            ثبت تیکت
        </button>

    </form>

</div>

</body>

</html>
