<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Profile | Luxury Garage</title>

    <script src="https://cdn.tailwindcss.com"></script>
    <script defer src="https://cdn.jsdelivr.net/npm/alpinejs@3.x.x/dist/cdn.min.js"></script>

    <link href="https://fonts.googleapis.com/css2?family=Syne:wght=400;600;700;800&family=Inter:wght=400;500;600;700&display=swap" rel="stylesheet">

    <style>
        body {
            font-family: 'Inter', sans-serif;
            background:
                radial-gradient(circle at top left, rgba(99,102,241,0.05), transparent 25%),
                radial-gradient(circle at bottom right, rgba(236,72,153,0.04), transparent 25%),
                linear-gradient(to bottom right,#f8fafc,#ffffff,#f1f5f9);
            overflow-x: hidden;
        }

        h1, h2, h3, h4 {
            font-family: 'Syne', sans-serif;
        }

        .glass {
            background: rgba(255,255,255,0.85);
            backdrop-filter: blur(20px);
            border: 1px solid rgba(255,255,255,0.7);
            box-shadow: 0 10px 40px rgba(15,23,42,0.04);
        }

        .btn {
            transition: all .3s ease;
        }

        .btn:hover {
            transform: translateY(-2px);
        }

        .blob {
            position: absolute;
            border-radius: 9999px;
            filter: blur(80px);
            opacity: .12;
            z-index: 0;
        }
    </style>
</head>

<body class="relative min-h-screen text-gray-800 bg-slate-50">

<!-- Background Accents -->
<div class="blob bg-indigo-400 w-96 h-96 top-0 left-0"></div>
<div class="blob bg-pink-300 w-96 h-96 bottom-0 right-0"></div>

<!-- Top Navigation Bar -->
<header class="sticky top-0 z-50 backdrop-blur-xl bg-white/70 border-b border-slate-200/50">
    <div class="max-w-7xl mx-auto px-6 py-5 flex items-center justify-between">
        <div>
            <h1 class="text-2xl font-extrabold tracking-tight text-gray-900">LUXURY GARAGE</h1>
            <p class="text-xs text-gray-400 font-medium tracking-wide uppercase mt-0.5">Account Management</p>
        </div>

        <div class="flex items-center gap-4">
            <a href="{{ route('cars.index') }}" class="btn px-5 py-2.5 rounded-xl bg-slate-900 text-white text-sm font-semibold shadow-sm hover:bg-slate-800">Vehicles</a>
            <a href="{{ route('bookings.index') }}" class="btn px-5 py-2.5 rounded-xl bg-white border border-slate-200 text-slate-700 text-sm font-semibold shadow-sm hover:bg-slate-50">My Bookings</a>

            @if(auth()->check() && auth()->user()->role === 'admin')
                <a href="{{ route('cars.create') }}" class="btn px-5 py-2.5 rounded-xl bg-gradient-to-r from-indigo-600 to-pink-600 text-white text-sm font-semibold shadow-md hover:brightness-105">+ Add Vehicle</a>
                <a href="{{ route('dashboard') }}" class="btn px-5 py-2.5 rounded-xl bg-slate-100 text-slate-800 text-sm font-semibold hover:bg-slate-200 transition">Dashboard</a>
            @endif

            <div class="relative group">
                <a href="{{ route('profile.edit') }}" class="flex items-center gap-3 px-3 py-2 rounded-xl bg-white border border-slate-200/80 shadow-sm transition">
                    <div class="w-7 h-7 rounded-lg bg-gradient-to-r from-indigo-500 to-pink-500 flex items-center justify-center text-white text-xs font-bold">
                        @if(auth()->check())
                            {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
                        @else
                            U
                        @endif
                    </div>
                </a>

                <div class="absolute right-0 mt-2 w-44 opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all duration-200 z-50">
                    <div class="bg-white border border-slate-200 rounded-xl shadow-xl overflow-hidden">
                        <a href="{{ route('profile.edit') }}" class="block px-4 py-2.5 text-sm text-gray-700 hover:bg-slate-50">👤 My Profile</a>
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button class="w-full text-left px-4 py-2.5 text-sm text-red-600 hover:bg-red-50">🚪 Logout</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</header>

<!-- Main Page Content -->
<main class="relative z-10 max-w-7xl mx-auto px-6 py-12 space-y-8">

    <!-- Header Banner / Hero Overview -->
    <div class="glass rounded-3xl p-6 md:p-8 border border-slate-200/80 shadow-sm relative overflow-hidden">
        <div class="flex flex-col sm:flex-row items-center gap-6">
            <div class="w-20 h-20 rounded-2xl bg-gradient-to-br from-indigo-500 to-pink-500 flex items-center justify-center text-white font-extrabold text-3xl shadow-lg shadow-indigo-500/20">
                {{ strtoupper(substr(auth()->user()->name, 0, 1)) }}
            </div>

            <div class="text-center sm:text-left space-y-1">
                <div class="flex items-center justify-center sm:justify-start gap-3 flex-wrap">
                    <h1 class="text-2xl font-bold text-slate-900 tracking-tight">
                        {{ auth()->user()->name }}
                    </h1>
                    <span class="px-3 py-1 text-[11px] font-bold uppercase tracking-wider bg-indigo-50 text-indigo-600 border border-indigo-200/60 rounded-lg">
                        {{ auth()->user()->role ?? 'Member' }}
                    </span>
                </div>
                <p class="text-sm text-slate-500 font-medium">
                    {{ auth()->user()->email }}
                </p>
                <p class="text-xs text-slate-400 pt-1">
                    🗓️ Account created {{ auth()->user()->created_at->format('M Y') }}
                </p>
            </div>
        </div>
    </div>

    <!-- Forms Layout Grid -->
    <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">

        <!-- 1. Profile Information -->
        <div class="bg-white rounded-2xl border border-slate-200/80 shadow-sm p-6 md:p-8 space-y-6">
            <div class="border-b border-slate-100 pb-4">
                <h2 class="text-xl font-bold text-slate-900 tracking-tight flex items-center gap-2">
                    <span>👤</span> Profile Details
                </h2>
                <p class="text-xs text-slate-400 mt-1">
                    Update your personal account details and email address
                </p>
            </div>

            @include('profile.partials.update-profile-information-form')
        </div>

        <!-- 2. Security & Password -->
        <div class="bg-white rounded-2xl border border-slate-200/80 shadow-sm p-6 md:p-8 space-y-6">
            <div class="border-b border-slate-100 pb-4">
                <h2 class="text-xl font-bold text-slate-900 tracking-tight flex items-center gap-2">
                    <span>🔒</span> Password & Security
                </h2>
                <p class="text-xs text-slate-400 mt-1">
                    Ensure your account is protected with a strong password
                </p>
            </div>

            @include('profile.partials.update-password-form')
        </div>

        <!-- 3. Danger Zone -->
        <div class="lg:col-span-2 bg-red-50/40 rounded-2xl border border-red-100 shadow-sm p-6 md:p-8 space-y-6">
            <div class="border-b border-red-100/80 pb-4">
                <h2 class="text-xl font-bold text-red-600 tracking-tight flex items-center gap-2">
                    <span>⚠️</span> Danger Zone
                </h2>
                <p class="text-xs text-slate-500 mt-1">
                    Permanently delete your account and remove all personal information from the system
                </p>
            </div>

            @include('profile.partials.delete-user-form')
        </div>

    </div>

</main>

</body>
</html>