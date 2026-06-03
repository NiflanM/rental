<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register</title>

    <style>
        * {
            margin: 0;
            padding: 0;
            box-sizing: border-box;
            font-family: Inter, system-ui, Arial;
        }

        body {
            height: 100vh;
            display: flex;
            align-items: center;
            justify-content: center;
            overflow: hidden;
            background: #0b1020;
        }

        /* background glow */
        .bg {
            position: absolute;
            inset: 0;
            background:
                radial-gradient(circle at 20% 20%, rgba(99,102,241,0.35), transparent 40%),
                radial-gradient(circle at 80% 30%, rgba(236,72,153,0.25), transparent 40%),
                radial-gradient(circle at 50% 80%, rgba(34,211,238,0.18), transparent 45%);
            filter: blur(20px);
        }

        .blob {
            position: absolute;
            width: 420px;
            height: 420px;
            border-radius: 50%;
            filter: blur(80px);
            opacity: 0.4;
            animation: float 10s infinite ease-in-out;
        }

        .b1 { background: #6366f1; top: -120px; left: -120px; }
        .b2 { background: #ec4899; bottom: -120px; right: -120px; }

        @keyframes float {
            0%,100% { transform: translateY(0); }
            50% { transform: translateY(30px); }
        }

        /* card */
        .card {
            width: 450px;
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
            margin-top: 6px;
            font-size: 13px;
            color: rgba(255,255,255,0.6);
        }

        label {
            display: block;
            margin-top: 16px;
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
            margin-top: 14px;
            font-size: 12px;
            color: rgba(255,255,255,0.6);
        }

        .row a {
            color: #a78bfa;
            text-decoration: none;
        }

        button {
            width: 100%;
            margin-top: 20px;
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

        .error {
            color: #fb7185;
            font-size: 11px;
            margin-top: 4px;
        }

        .footer {
            text-align: center;
            margin-top: 18px;
            font-size: 12px;
            color: rgba(255,255,255,0.5);
        }

        .footer a {
            color: #a78bfa;
            font-weight: 600;
            text-decoration: none;
        }

        .title-gradient {
            background: linear-gradient(90deg, #6366f1, #a855f7, #ec4899);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
        }
    </style>
</head>

<body>

<div class="bg"></div>
<div class="blob b1"></div>
<div class="blob b2"></div>

<div class="card">

    <div class="title title-gradient">Create Account</div>
    <div class="subtitle">Join the luxury experience 🚗</div>

    <form method="POST" action="{{ route('register') }}">
        @csrf

        <!-- NAME -->
        <label>Name</label>
        <input type="text" name="name" value="{{ old('name') }}" required autofocus>
        @error('name')
            <div class="error">{{ $message }}</div>
        @enderror

        <!-- EMAIL -->
        <label>Email</label>
        <input type="email" name="email" value="{{ old('email') }}" required>
        @error('email')
            <div class="error">{{ $message }}</div>
        @enderror

        <!-- PASSWORD -->
        <label>Password</label>
        <input type="password" name="password" required>
        @error('password')
            <div class="error">{{ $message }}</div>
        @enderror

        <!-- CONFIRM -->
        <label>Confirm Password</label>
        <input type="password" name="password_confirmation" required>

        <button type="submit">Create Account</button>
    </form>

    <div class="footer">
        Already have an account?
        <a href="{{ route('login') }}">Sign in</a>
    </div>

</div>

</body>
</html>