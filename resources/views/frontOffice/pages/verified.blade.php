<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Email Verified - {{ config('app.name') }}</title>

    <!-- Add your CSS files here -->
    <link rel="stylesheet" href="{{ asset('frontOffice/css/bootstrap.min.css') }}">
    <link rel="stylesheet" href="{{ asset('frontOffice/css/style.css') }}">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.0/css/all.min.css">

    <style>
        .verified-container {
            min-height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            background: linear-gradient(135deg, #11998e 0%, #38ef7d 100%);
            padding: 20px;
        }

        .verified-card {
            background: white;
            border-radius: 20px;
            box-shadow: 0 20px 60px rgba(0,0,0,0.3);
            padding: 50px;
            max-width: 600px;
            width: 100%;
            text-align: center;
            animation: slideUp 0.5s ease-out;
        }

        @keyframes slideUp {
            from {
                opacity: 0;
                transform: translateY(30px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .success-icon {
            width: 120px;
            height: 120px;
            margin: 0 auto 30px;
            background: linear-gradient(135deg, #11998e 0%, #38ef7d 100%);
            border-radius: 50%;
            display: flex;
            align-items: center;
            justify-content: center;
            animation: scaleIn 0.5s ease-out 0.2s both;
        }

        @keyframes scaleIn {
            from {
                transform: scale(0);
            }
            to {
                transform: scale(1);
            }
        }

        .success-icon i {
            font-size: 60px;
            color: white;
        }

        .verified-card h2 {
            color: #333;
            margin-bottom: 20px;
            font-size: 32px;
            font-weight: 600;
        }

        .verified-card p {
            color: #666;
            font-size: 18px;
            line-height: 1.6;
            margin-bottom: 30px;
        }

        .btn-home {
            background: linear-gradient(135deg, #11998e 0%, #38ef7d 100%);
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
            text-decoration: none;
        }

        .btn-home:hover {
            transform: translateY(-2px);
            box-shadow: 0 10px 20px rgba(17, 153, 142, 0.4);
            color: white;
            text-decoration: none;
        }

        .checkmark {
            animation: drawCheck 0.5s ease-out 0.4s both;
        }

        @keyframes drawCheck {
            from {
                stroke-dashoffset: 100;
            }
            to {
                stroke-dashoffset: 0;
            }
        }
    </style>
</head>
<body>
<div class="verified-container">
    <div class="verified-card">
        <div class="success-icon">
            <i class="fas fa-check-circle"></i>
        </div>

        <h2>Email Verified Successfully!</h2>

        <p>
            Your email has been verified. You can now access all features of your account.
            <br><br>
            Thank you for joining our environmental community!
        </p>

        <a href="{{ route('home') }}" class="btn-home">
            <i class="fas fa-home"></i>
            Go to Home
        </a>

        <div style="margin-top: 20px;">
            <a href="{{ route('user.profile') }}" style="color: #11998e; text-decoration: none; font-weight: 500;">
                Or visit your profile <i class="fas fa-arrow-right"></i>
            </a>
        </div>
    </div>
</div>

<!-- Add your JS files here if needed -->
<script src="{{ asset('frontOffice/js/jquery-3.6.0.min.js') }}"></script>
<script src="{{ asset('frontOffice/js/bootstrap.bundle.min.js') }}"></script>

<!-- Auto redirect after 5 seconds -->
<script>
    setTimeout(function() {
        window.location.href = "{{ route('home') }}";
    }, 5000);
</script>
</body>
</html>
