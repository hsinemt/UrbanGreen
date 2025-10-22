<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Verify Your Email - {{ config('app.name') }}</title>

    <!-- Add your CSS files here -->
    <link rel="stylesheet" href="{{ asset('frontOffice/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('frontOffice/css/style.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <style>
        .verify-email-container {
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            padding: 20px;
        }

        .verify-email-card {
            background: white;
            border-radius: 20px;
            box-shadow: 0 20px 60px rgba(0,0,0,0.3);
            padding: 50px;
            max-width: 600px;
            width: 100%;
            text-align: center;
        }

        .verify-icon {
            width: 100px;
            height: 100px;
            margin: 0 auto 30px;
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
        }

        .verify-icon i {
            font-size: 50px;
            color: white;
        }

        .verify-email-card h2 {
            color: #333;
            margin-bottom: 20px;
            font-size: 28px;
            font-weight: 600;
        }

        .verify-email-card p {
            color: #666;
            font-size: 16px;
            line-height: 1.6;
            margin-bottom: 30px;
        }

        .alert {
            padding: 15px 20px;
            border-radius: 10px;
            margin-bottom: 20px;
        }

        .alert-success {
            background-color: #d4edda;
            border: 1px solid #c3e6cb;
            color: #155724;
        }

        .alert-warning {
            background-color: #fff3cd;
            border: 1px solid #ffeaa7;
            color: #856404;
        }

        .btn-verify {
            background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
            color: white;
            padding: 15px 40px;
            border: none;
            border-radius: 50px;
            font-size: 16px;
            font-weight: 600;
            cursor: pointer;
            transition: all 0.3s ease;
            display: inline-flex;
            align-items: center;
            gap: 10px;
        }

        .btn-verify:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 20px rgba(102, 126, 234, 0.4);
            color: white;
            text-decoration: none;
        }

        .back-link {
            display: inline-block;
            margin-top: 20px;
            color: #667eea;
            text-decoration: none;
            font-weight: 500;
        }

        .back-link:hover {
            color: #764ba2;
            text-decoration: underline;
        }
    </style>
</head>
<body>
<div class="verify-email-container">
    <div class="verify-email-card">
        <div class="verify-icon">
            <i class="fas fa-envelope-open-text"></i>
        </div>

        <h2>Verify Your Email Address</h2>

        @if (session('resent'))
            <div class="alert alert-success">
                <i class="fas fa-check-circle"></i>
                A fresh verification link has been sent to your email address.
            </div>
        @endif

        @if (session('success'))
            <div class="alert alert-success">
                <i class="fas fa-check-circle"></i>
                {{ session('success') }}
            </div>
        @endif

        @if (session('warning'))
            <div class="alert alert-warning">
                <i class="fas fa-exclamation-triangle"></i>
                {{ session('warning') }}
            </div>
        @endif

        <p>
            Before proceeding, please check your email for a verification link.
            <br><br>
            If you didn't receive the email, click the button below to request another.
        </p>

        <form method="POST" action="{{ route('verification.resend') }}" style="display: inline;">
            @csrf
            <button type="submit" class="btn-verify">
                <i class="fas fa-paper-plane"></i>
                Resend Verification Email
            </button>
        </form>

        <div style="margin-top: 30px;">
            <a href="{{ route('home') }}" class="back-link">
                <i class="fas fa-arrow-left"></i> Back to Home
            </a>
        </div>
    </div>
</div>

<!-- Add your JS files here if needed -->
<script src="{{ asset('frontOffice/js/jquery-3.6.0.min.js') }}"></script>
<script src="{{ asset('frontOffice/js/bootstrap.bundle.min.js') }}"></script>
</body>
</html>
