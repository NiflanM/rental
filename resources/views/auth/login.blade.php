<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>

    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: Inter, system-ui, Arial;
        }

        body {
            height: 100vh;
            overflow: hidden;
            display: flex;
            align-items: center;
            justify-content: center;
            background: #0b1020;
        }

        /* background */
        .bg {
            position: absolute;
            inset: 0;
            background:
                radial-gradient(circle at 20% 20%, rgba(99,102,241,0.35), transparent 40%),
                radial-gradient(circle at 80% 30%, rgba(236,72,153,0.25), transparent 40%),
                radial-gradient(circle at 50% 80%, rgba(34,211,238,0.18), transparent 45%);
            filter: blur(20px);
        }

        /* blobs */
        .blob {
            position: absolute;
            width: 400px;
            height: 400px;
            border-radius: 50%;
            filter: blur(80px);
            opacity: 0.4;
            animation: float 10s infinite ease-in-out;
        }

        .b1 { background: #6366f1; top: -120px; left: -120px; }
        .b2 { background: #ec4899; bottom: -120px; right: -120px; animation-delay: 2s; }

        @keyframes float {
            0%,100% { transform: translateY(0); }
            50% { transform: translateY(30px); }
        }

        /* card */
        .card {
            position: relative;
            width: 420px;
            padding: 40px;
            border-radius: 18px;
            background: rgba(255,255,255,0.06);
            border: 1px solid rgba(255,255,255,0.08);
            backdrop-filter: blur(20px);
            box-shadow: 0 30px 80px rgba(0,0,0,0.5);
            z-index: 10;
        }

        .title {
            font-size: 28px;
            font-weight: 700;
            color: white;
        }

        .subtitle {
            margin-top: 8px;
            font-size: 13px;
            color: rgba(255,255,255,0.6);
        }

        label {
            display: block;
            margin-top: 18px;
            font-size: 13px;
            color: rgba(255,255,255,0.7);
        }

        input {
            width: 100%;
            margin-top: 6px;
            padding: 12px 14px;
            border-radius: 10px;
            border: 1px solid rgba(255,255,255,0.1);
            background: rgba(255,255,255,0.05);
            color: white;
            outline: none;
        }

        input:focus {
            border-color: #6366f1;
            background: rgba(255,255,255,0.08);
        }

        .row {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-top: 14px;
            font-size: 12px;
            color: rgba(255,255,255,0.6);
        }

        .row a {
            color: #818cf8;
            text-decoration: none;
        }

        button {
            width: 100%;
            margin-top: 22px;
            padding: 12px;
            border: none;
            border-radius: 10px;
            font-weight: 600;
            color: white;
            background: linear-gradient(90deg, #6366f1, #a855f7, #ec4899);
            cursor: pointer;
            transition: 0.2s;
        }

        button:hover {
            transform: scale(1.03);
        }

        .footer {
            text-align: center;
            margin-top: 18px;
            font-size: 12px;
            color: rgba(255,255,255,0.5);
        }

        .footer a {
            color: #a78bfa;
            text-decoration: none;
            font-weight: 600;
        }

        .error {
            color: #fb7185;
            font-size: 11px;
            margin-top: 4px;
        }

        .status {
            color: #34d399;
            font-size: 12px;
            margin-bottom: 10px;
        }
    </style>
</head>

<body>

<div class="bg"></div>
<div class="blob b1"></div>
<div class="blob b2"></div>

<div class="card">

    <div class="title">Welcome Back</div>
    <div class="subtitle">Sign in to your dashboard</div>

    @if (session('status'))
        <div class="status">{{ session('status') }}</div>
    @endif

    <form method="POST" action="{{ route('login') }}">
        @csrf

        <!-- EMAIL -->
        <label>Email</label>
        <input type="email" name="email" value="{{ old('email') }}" required autofocus>

        @error('email')
            <div class="error">{{ $message }}</div>
        @enderror

        <!-- PASSWORD -->
        <label>Password</label>
        <input type="password" name="password" required>

        @error('password')
            <div class="error">{{ $message }}</div>
        @enderror

        <!-- OPTIONS -->
        <div class="row">

            <!-- FIXED REMEMBER ME -->
            <label style="display:flex; align-items:center; gap:8px; cursor:pointer;">
                <input type="checkbox" name="remember"
                    style="width:16px; height:16px; margin:0;">
                <span>Remember me</span>
            </label>

            @if (Route::has('password.request'))
                <a href="{{ route('password.request') }}">
                    Forgot password?
                </a>
            @endif

        </div>

        <!-- BUTTON -->
        <button type="submit">Sign In</button>
    </form>

    <div class="footer">
        Don’t have an account?
        <a href="{{ route('register') }}">Create one</a>
    </div>

</div>

</body>
</html>