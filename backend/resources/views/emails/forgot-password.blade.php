<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Reset Your Password</title>
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
            color: #222;
            margin-bottom: 16px;
        }

        p {
            color: #555;
            margin-bottom: 24px;
        }

        .reset-link {
            display: inline-block;
            background: #2563eb;
            color: #fff;
            text-decoration: none;
            padding: 12px 24px;
            border-radius: 6px;
            font-weight: 600;
            transition: background 0.2s;
        }

        .reset-link:hover {
            background: #1d4ed8;
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
        <h2>Forgot Your Password?</h2>
        <p>We received a request to reset your password. Click the button below to set a new password:</p>
        <a href="{{ $url }}" class="reset-link">Reset Password</a>
        <p>If you did not request a password reset, please ignore this email.</p>
        <div class="footer">
            &copy; {{ date('Y') }} {{ config('app.name') }}
        </div>
    </div>
</body>

</html>
