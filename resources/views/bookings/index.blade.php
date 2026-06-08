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

<div class="absolute w-96 h-96 bg-indigo-400 rounded-full blur-3xl opacity-10 top-0 left-0"></div>
<div class="absolute w-96 h-96 bg-pink-300 rounded-full blur-3xl opacity-10 bottom-0 right-0"></div>
<header class="sticky top-0 z-50 backdrop-blur-xl bg-white/70 border-b border-slate-200/50">
    <div class="max-w-7xl mx-auto px-6 py-5 flex items-center justify-between">
        <div>
            <h1 class="text-2xl font-extrabold tracking-tight text-gray-900">LUXURY GARAGE</h1>
            <p class="text-xs text-gray-400 font-medium tracking-wide uppercase mt-0.5">Premium Vehicle Collection</p>
        </div>

        <div class="flex items-center gap-4">
            <a href="{{ route('cars.index') }}" class="btn px-5 py-2.5 rounded-xl bg-white border border-slate-200 text-slate-700 text-sm font-semibold shadow-sm hover:bg-slate-50">Vehicles</a>
            <a href="{{ route('bookings.index') }}" class="btn px-5 py-2.5 rounded-xl bg-slate-900 text-white text-sm font-semibold shadow-sm hover:bg-slate-800">My Bookings</a>

            @if(auth()->check() && auth()->user()->role === 'admin')
                <a href="{{ route('cars.create') }}" class="btn px-5 py-2.5 rounded-xl bg-gradient-to-r from-indigo-600 to-pink-600 text-white text-sm font-semibold shadow-md hover:brightness-105">+ Add Vehicle</a>
                <a href="{{ route('dashboard') }}" class="btn px-5 py-2.5 rounded-xl bg-slate-100 text-slate-800 text-sm font-semibold hover:bg-slate-200 transition">Dashboard</a>
            @endif

            <div class="relative group">
                <a href="{{ route('profile.edit') }}" class="flex items-center gap-3 px-3 py-2 rounded-xl bg-white border border-slate-200/80 shadow-sm transition">
                    <div class="w-7 h-7 rounded-lg bg-gradient-to-r from-indigo-50 to-pink-50 flex items-center justify-center text-white text-xs font-bold">
                        @if(auth()->check())
                            {{ strtoupper(substr(auth()->user()->name,0,1)) }}
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

<main class="relative z-10 max-w-7xl mx-auto px-6 py-12">

    @if(session('success'))
        <div class="mb-6 p-4 rounded-2xl bg-green-50 border border-green-200 text-green-700 font-medium">
            {{ session('success') }}
        </div>
    @endif
    @if(session('error'))
        <div class="mb-6 p-4 rounded-2xl bg-red-50 border border-red-200 text-red-700 font-medium">
            {{ session('error') }}
        </div>
    @endif

    <div class="flex items-center justify-between mb-10">
        <div>
            <h2 class="text-4xl font-bold text-gray-900">
                {{ auth()->user()?->role === 'admin' ? 'All Bookings' : 'My Booking History' }}
            </h2>
            <p class="text-gray-500 mt-2">
                Manage and track all your reservations
            </p>
        </div>
    </div>

    <div class="grid sm:grid-cols-2 lg:grid-cols-3 gap-10">

        @forelse($bookings as $booking)
        <div class="car-card bg-white rounded-3xl shadow-md overflow-hidden group flex flex-col justify-between">
            
            <div>
                <div class="relative overflow-hidden">
                    
                    @php
                        $carImages = $booking->car->images;
                        if (is_string($carImages)) {
                            $carImages = json_decode($carImages, true);
                        }
                    @endphp

                    @if(!empty($carImages) && is_array($carImages) && isset($carImages[0]))
                        <img src="{{ asset('storage/' . $carImages[0]) }}"
                             class="h-60 w-full object-cover group-hover:scale-105 transition duration-700">
                    @else
                        <div class="h-60 w-full bg-slate-100 flex items-center justify-center text-slate-400 font-medium">
                            🚗 No Image Available
                        </div>
                    @endif

                    <div class="absolute top-4 right-4 bg-white/90 backdrop-blur px-3 py-1 rounded-full shadow text-sm">
                        @php
                            $statusColors = [
                                'approved' => 'text-green-600',
                                'hold' => 'text-yellow-600',
                                'pending' => 'text-blue-600',
                                'rejected' => 'text-red-600',
                                'cancelled' => 'text-gray-500',
                            ];

                            $statusDots = [
                                'approved' => 'bg-green-500',
                                'hold' => 'bg-yellow-500',
                                'pending' => 'bg-blue-500',
                                'rejected' => 'bg-red-500',
                                'cancelled' => 'bg-gray-400',
                            ];
                        @endphp <span class="flex items-center gap-2 font-medium {{ $statusColors[$booking->status] ?? 'text-gray-600' }}">
                            <span class="w-2 h-2 rounded-full {{ $booking->status !== 'cancelled' ? 'animate-pulse' : '' }} {{ $statusDots[$booking->status] ?? 'bg-gray-500' }}"></span>
                            {{ ucfirst($booking->status ?? 'pending') }}
                        </span>
                    </div>
                </div>

                <div class="p-6 space-y-5">
                    <div>
                        <h3 class="text-xl font-semibold text-gray-800">
                            {{ $booking->car->name }}
                        </h3>
                        <p class="text-sm text-gray-500">
                            {{ $booking->car->model }}
                        </p>
                    </div>

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

                    @if(auth()->user()?->role === 'admin')
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
                </div>
            </div>

            <div class="p-6 pt-0">
                @php
                    $today = \Carbon\Carbon::today();
                    $bookingStart = \Carbon\Carbon::parse($booking->start_date)->startOfDay();
                    $daysLeft = $today->diffInDays($bookingStart, false);

                    $endDateWithTime = \Carbon\Carbon::parse($booking->end_date)->setTime(21, 0, 0);
                    $showReviewSystem = now()->greaterThanOrEqualTo($endDateWithTime) && $booking->status === 'approved';
                @endphp

                @if(auth()->user()?->role !== 'admin' && !in_array($booking->status, ['cancelled', 'rejected']))

                    @if($showReviewSystem)
                        <div class="rounded-2xl bg-gradient-to-r from-indigo-50 to-pink-50 border border-indigo-100 p-4">
                            
                            @if($booking->is_reviewed)
                                <div class="text-center py-1">
                                    <p class="font-bold text-gray-800 flex items-center justify-center gap-1">
                                        <span>Your Feedback Saved!</span> 
                                        <span class="text-yellow-500">
                                            @for($s = 1; $s <= $booking->rating; $s++) ★ @endfor
                                        </span>
                                    </p>
                                    @if($booking->feedback)
                                        <p class="text-xs text-gray-500 italic mt-2 bg-white/60 p-2 rounded-xl border border-white">
                                            "{{ $booking->feedback }}"
                                        </p>
                                    @endif
                                </div>
                            @else
                                <form action="{{ route('bookings.review', $booking->id) }}" method="POST" class="space-y-3">
                                    @csrf
                                    @method('PATCH')
                                    
                                    <div class="flex items-center justify-between">
                                        <span class="text-xs font-semibold text-gray-700">Rate Your Experience:</span>
                                        
                                        <div class="flex flex-row-reverse justify-end gap-0.5">
                                            @for($i = 5; $i >= 1; $i--)
                                                <input type="radio" id="star{{ $i }}-{{ $booking->id }}" name="rating" value="{{ $i }}" class="peer hidden" required />
                                                <label for="star{{ $i }}-{{ $booking->id }}" class="cursor-pointer text-xl text-gray-300 peer-hover:text-yellow-400 peer-checked:text-yellow-400 transition-colors">★</label>
                                            @endfor
                                        </div>
                                    </div>

                                    <div>
                                        <textarea name="feedback" rows="2" class="w-full text-xs p-3 rounded-xl border border-gray-200 focus:outline-none focus:ring-2 focus:ring-indigo-400" placeholder="Optional: How was the car condition & overall service?"></textarea>
                                    </div>

                                    <button type="submit" class="w-full py-2 rounded-xl bg-gradient-to-r from-indigo-500 to-pink-500 text-white text-xs font-semibold transition shadow hover:opacity-90">
                                        Submit Feedback
                                    </button>
                                </form>
                            @endif
                        </div>

                    @elseif($daysLeft > 0)
                        <div class="flex items-center justify-between gap-4 rounded-2xl bg-gradient-to-r from-indigo-50 to-pink-50 border border-indigo-100 p-4">
                            <div class="flex items-center gap-4">
                                <div class="w-14 h-14 rounded-2xl bg-white shadow flex flex-col justify-center items-center">
                                    <span class="font-bold text-indigo-600 text-lg">{{ $daysLeft }}</span>
                                    <span class="text-[10px] uppercase text-gray-500">Days</span>
                                </div>
                                <div>
                                    <p class="text-sm text-gray-600">
                                        Cancellation Available until
                                        <span class="font-medium">
                                            {{ \Carbon\Carbon::parse($booking->start_date)->subDay()->format('M d') }}
                                        </span>
                                    </p>
                                </div>
                            </div>

                            <form action="{{ route('bookings.cancel', $booking->id) }}" method="POST">
                                @csrf
                                @method('PATCH')
                                <button onclick="return confirm('Cancel booking?')" class="px-5 py-3 rounded-xl bg-red-500 hover:bg-red-600 text-white font-semibold transition">
                                    Cancel
                                </button>
                            </form>
                        </div>

                    @else
                        <div class="flex items-center justify-between rounded-2xl bg-gray-150 bg-gray-100 border border-gray-200 p-4">
                            <div>
                                <p class="font-semibold text-gray-800 text-sm">Trip In Progress 🔒</p>
                                <p class="text-xs text-gray-500 mt-0.5">Feedback container will unlock after 9:00 PM on your end date.</p>
                            </div>
                            <div class="text-xl">🚗</div>
                        </div>
                    @endif
                @endif

                @if(auth()->user()?->role === 'admin')
                <div class="grid grid-cols-3 gap-2">
                    <form action="{{ route('bookings.status', $booking->id) }}" method="POST">
                        @csrf
                        @method('PATCH')
                        <input type="hidden" name="status" value="approved">
                        <button class="w-full py-2.5 rounded-xl bg-green-500 hover:bg-green-600 text-white text-xs font-semibold transition">
                            Approve
                        </button>
                    </form>

                    <form action="{{ route('bookings.status', $booking->id) }}" method="POST">
                        @csrf
                        @method('PATCH')
                        <input type="hidden" name="status" value="hold">
                        <button class="w-full py-2.5 rounded-xl bg-yellow-500 hover:bg-yellow-600 text-white text-xs font-semibold transition">
                            Hold
                        </button>
                    </form>

                    <form action="{{ route('bookings.status', $booking->id) }}" method="POST">
                        @csrf
                        @method('PATCH')
                        <input type="hidden" name="status" value="rejected">
                        <button class="w-full py-2.5 rounded-xl bg-red-500 hover:bg-red-600 text-white text-xs font-semibold transition">
                            Reject
                        </button>
                    </form>
                </div>
                <div class="mt-2">
                    <a href="{{ route('bookings.edit', $booking->id) }}"
                       class="block w-full text-center py-2.5 rounded-xl bg-indigo-500 hover:bg-indigo-600 text-white text-xs font-semibold transition">
                       Edit Booking Parameters
                    </a>
                </div>
                @endif
            </div>

        </div>
        @empty
        <div class="col-span-full text-center py-20">
            <div class="text-6xl mb-4">📅</div>
            <h2 class="text-3xl font-semibold text-gray-800">No Bookings Found</h2>
            <p class="text-gray-500 mt-3">Start booking your dream cars today</p>
        </div>
        @endforelse

    </div>
</main>

</body>
</html>