<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bookings - Luxury Garage</title>

    <script src="https://cdn.tailwindcss.com"></script>

    <link href="https://fonts.googleapis.com/css2?family=Syne:wght@400;600;700;800&family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">

    <style>
        body{
            font-family: 'Inter', sans-serif;
            background:
                radial-gradient(circle at top left, rgba(99,102,241,0.12), transparent 22%),
                radial-gradient(circle at bottom right, rgba(236,72,153,0.10), transparent 22%),
                linear-gradient(to bottom right,#f8fafc,#ffffff,#eef2ff);
            overflow-x: hidden;
        }

        h1,h2,h3{ font-family: 'Syne', sans-serif; }

        .glass{
            background: rgba(255,255,255,0.70);
            backdrop-filter: blur(18px);
            border: 1px solid rgba(255,255,255,0.5);
            box-shadow: 0 10px 40px rgba(15,23,42,0.07);
        }

        .car-card{
            transition: all .45s cubic-bezier(.17,.67,.35,1.3);
        }

        .car-card:hover{
            transform: translateY(-12px);
            box-shadow:
                0 30px 50px rgba(99,102,241,.12),
                0 12px 30px rgba(236,72,153,.08);
        }
    </style>
</head>

<body class="relative min-h-screen text-gray-800">

<!-- BACKGROUND -->
<div class="absolute w-96 h-96 bg-indigo-400 rounded-full blur-3xl opacity-10 top-0 left-0"></div>
<div class="absolute w-96 h-96 bg-pink-300 rounded-full blur-3xl opacity-10 bottom-0 right-0"></div>
<header class="sticky top-0 z-50 backdrop-blur-xl bg-white/60 border-b border-white/40">

    <div class="max-w-7xl mx-auto px-6 py-5 flex items-center justify-between">

        <!-- Logo -->
        <div>

            <h1 class="text-3xl font-extrabold tracking-tight text-gray-900">
                LUXURY GARAGE
            </h1>

            <p class="text-sm text-gray-500 mt-1">
                Premium Vehicle Collection
            </p>

        </div>

        <!-- RIGHT SIDE ACTIONS -->
        <div class="flex items-center gap-4">

            <a href="{{ route('cars.index') }}"
               class="btn px-5 py-3 rounded-2xl bg-gradient-to-r from-indigo-500 to-pink-500 text-white font-semibold shadow-xl hover:shadow-2xl">

               Vehicles

            </a>

            <a href="{{ route('bookings.index') }}"
               class="btn px-5 py-3 rounded-2xl bg-gradient-to-r from-indigo-500 to-pink-500 text-white font-semibold shadow-xl hover:shadow-2xl">

                My Bookings

            </a>

            @if(auth()->user()->role === 'admin')

            <a href="{{ route('cars.create') }}"
               class="btn px-5 py-3 rounded-2xl bg-gradient-to-r from-indigo-500 to-pink-500 text-white font-semibold shadow-xl hover:shadow-2xl">

                + Add Vehicle

            </a>
             <!-- DASHBOARD BUTTON (NEW) -->
            <a href="{{ route('dashboard') }}"
               class="btn px-5 py-3 rounded-2xl bg-gray-900 text-white font-semibold shadow-xl hover:bg-gray-800 transition">

                Dashboard

            </a>


            @endif

            <!-- PROFILE -->
            <div class="relative group">

                <a href="{{ route('profile.edit') }}"
                   class="flex items-center gap-3 px-4 py-2 rounded-2xl bg-white/60 hover:bg-white/90 shadow transition">

                    <div class="w-9 h-9 rounded-full bg-gradient-to-r from-indigo-500 to-pink-500 flex items-center justify-center text-white font-bold">
                        {{ strtoupper(substr(auth()->user()->name,0,1)) }}
                    </div>
                </a>

                <!-- DROPDOWN -->
                <div class="absolute right-0 mt-2 w-44 opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all duration-200">

                    <div class="bg-white/80 backdrop-blur-xl border border-white/40 rounded-2xl shadow-xl overflow-hidden">

                        <a href="{{ route('profile.edit') }}"
                           class="block px-4 py-3 text-sm text-gray-700 hover:bg-indigo-50">

                            👤 My Profile

                        </a>

                        <form method="POST" action="{{ route('logout') }}">
                            @csrf

                            <button class="w-full text-left px-4 py-3 text-sm text-red-600 hover:bg-red-50">

                                🚪 Logout

                            </button>
                        </form>

                    </div>

                </div>

            </div>

        </div>

    </div>

</header>


<main class="relative z-10 max-w-7xl mx-auto px-6 py-12">

    <!-- HEADER (same style as cars page) -->
    <div class="flex items-center justify-between mb-10">

        <div>
            <h2 class="text-4xl font-bold text-gray-900">
                {{ auth()->user()->role === 'admin' ? 'All Bookings' : 'My Booking History' }}
            </h2>

            <p class="text-gray-500 mt-2">
                Manage and track all your reservations
            </p>
        </div>

    </div>

    <!-- GRID -->
    <div class="grid sm:grid-cols-2 lg:grid-cols-3 gap-10">

        @forelse($bookings as $booking)

        <div class="car-card bg-white rounded-3xl shadow-md overflow-hidden group">

            <!-- IMAGE -->
            <div class="relative overflow-hidden">

                <img src="{{ asset('storage/' . $booking->car->image) }}"
                     class="h-60 w-full object-cover group-hover:scale-105 transition duration-700">

                <!-- STATUS -->
                <!-- STATUS -->
<div class="absolute top-4 right-4 bg-white/90 backdrop-blur px-3 py-1 rounded-full shadow text-sm">

    @php
        $statusColors = [
            'approved' => 'text-green-600',
            'hold' => 'text-yellow-600',
            'pending' => 'text-blue-600',
            'rejected' => 'text-red-600',
        ];

        $statusDots = [
            'approved' => 'bg-green-500',
            'hold' => 'bg-yellow-500',
            'pending' => 'bg-blue-500',
            'rejected' => 'bg-red-500',
        ];
    @endphp

    <span class="flex items-center gap-2 font-medium
        {{ $statusColors[$booking->status] ?? 'text-gray-600' }}">

        <span class="w-2 h-2 rounded-full animate-pulse
            {{ $statusDots[$booking->status] ?? 'bg-gray-500' }}">
        </span>

        {{ ucfirst($booking->status ?? 'pending') }}

    </span>

</div>
            </div>

            <!-- CONTENT -->
            <div class="p-6 space-y-5">

                <!-- CAR INFO -->
                <div>
                    <h3 class="text-xl font-semibold text-gray-800">
                        {{ $booking->car->name }}
                    </h3>

                    <p class="text-sm text-gray-500">
                        {{ $booking->car->model }}
                    </p>
                </div>

                <!-- DATE INFO -->
                <div class="grid grid-cols-2 gap-4">

                    <div class="bg-gray-50 rounded-xl p-4 text-center">
                        <p class="text-xs text-gray-400">Start</p>
                        <p class="font-medium text-gray-800 mt-1">
                            {{ $booking->start_date }}
                        </p>
                    </div>

                    <div class="bg-gray-50 rounded-xl p-4 text-center">
                        <p class="text-xs text-gray-400">End</p>
                        <p class="font-medium text-gray-800 mt-1">
                            {{ $booking->end_date }}
                        </p>
                    </div>

                </div>

                <!-- PRICE (MATCH CAR STYLE) -->
                <div class="bg-gradient-to-r from-indigo-50 to-pink-50 rounded-2xl p-5 flex items-center justify-between">

                    <div>
                        <p class="text-sm text-gray-500">Total Price</p>
                        <h3 class="text-2xl font-medium text-gray-900">
                            LKR {{ number_format($booking->total_price) }}
                        </h3>
                    </div>

                    <div class="text-indigo-500 text-sm font-medium">
                        {{ $booking->total_days }} days
                    </div>

                </div>

                <!-- ADMIN INFO -->
                @if(auth()->user()->role === 'admin')
                <div class="bg-gray-50 rounded-xl p-4 text-sm text-center">

                    <p class="text-xs text-gray-400">Booked By</p>
                    <p class="font-semibold text-gray-800">
                        {{ $booking->customer_name }}
                    </p>
                    <p class="text-xs text-gray-500">
                        {{ $booking->email }}
                    </p>

                </div>
                @endif
                <!-- ADMIN ACTION BUTTONS -->
@if(auth()->user()->role === 'admin')

<div class="grid grid-cols-3 gap-3">

    <!-- APPROVE -->
    <form action="{{ route('bookings.status', $booking->id) }}" method="POST">
        @csrf
        @method('PATCH')

        <input type="hidden" name="status" value="approved">

        <button
            class="w-full py-3 rounded-xl
            bg-green-500 hover:bg-green-600
            text-white text-sm font-semibold transition">

            Approve
        </button>
    </form>

    <!-- HOLD -->
    <form action="{{ route('bookings.status', $booking->id) }}" method="POST">
        @csrf
        @method('PATCH')

        <input type="hidden" name="status" value="hold">

        <button
            class="w-full py-3 rounded-xl
            bg-yellow-500 hover:bg-yellow-600
            text-white text-sm font-semibold transition">

            Hold
        </button>
    </form>

    <!-- REJECT -->
    <form action="{{ route('bookings.status', $booking->id) }}" method="POST">
        @csrf
        @method('PATCH')

        <input type="hidden" name="status" value="rejected">

        <button
            class="w-full py-3 rounded-xl
            bg-red-500 hover:bg-red-600
            text-white text-sm font-semibold transition">

            Reject
        </button>
    </form>

</div>

@endif
            </div>

        </div>

        @empty

        <div class="col-span-full text-center py-20">

            <div class="text-6xl mb-4">📅</div>

            <h2 class="text-3xl font-semibold text-gray-800">
                No Bookings Found
            </h2>

            <p class="text-gray-500 mt-3">
                Start booking your dream cars today
            </p>

        </div>

        @endforelse

    </div>

</main>

</body>
</html>