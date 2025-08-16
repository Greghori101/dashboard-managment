<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Welcome to {{ config('app.name') }}</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background: #f8fafc;
            margin: 0;
            padding: 0;
        }

        .container {
            max-width: 480px;
            margin: 40px auto;
            background: #fff;
            border-radius: 8px;
            box-shadow: 0 2px 8px rgba(0, 0, 0, 0.07);
            padding: 32px 24px;
        }

        h2 {
            color: #2563eb;
            margin-bottom: 16px;
        }

        p {
            color: #555;
            margin-bottom: 24px;
        }

        .footer {
            margin-top: 32px;
            font-size: 13px;
            color: #888;
            text-align: center;
        }
    </style>
</head>

<body>
    <div class="container">
        <h2>Welcome, {{ $user->name }}!</h2>
        <p>Thank you for joining {{ config('app.name') }}. We're excited to have you on board.</p>
        <p>If you have any questions or need help, feel free to reply to this email.</p>
        <div class="footer">
            &copy; {{ date('Y') }} {{ config('app.name') }}
        </div>
    </div>
</body>

</html>
