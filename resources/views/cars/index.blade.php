<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Luxury Garage</title>

    <!-- Tailwind -->
    <script src="https://cdn.tailwindcss.com"></script>

    <!-- Fonts -->
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

        h1,h2,h3{
            font-family: 'Syne', sans-serif;
        }

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

        .car-card img{
            transition: transform .7s ease;
        }

        .car-card:hover img{
            transform: scale(1.08);
        }

        .btn{
            transition:all .3s ease;
        }

        .btn:hover{
            transform:translateY(-2px);
        }

        .blob{
            position:absolute;
            border-radius:9999px;
            filter:blur(80px);
            opacity:.15;
            z-index:0;
        }

    </style>
</head>

<body class="relative min-h-screen text-gray-800">

<!-- Decorative Blobs -->
<div class="blob bg-indigo-400 w-96 h-96 top-0 left-0"></div>
<div class="blob bg-pink-300 w-96 h-96 bottom-0 right-0"></div>

<!-- Navbar -->
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

<!-- Hero -->
<section class="relative z-10 max-w-7xl mx-auto px-6 pt-16 pb-12">

    <div class="grid lg:grid-cols-2 gap-12 items-center">

        <!-- Left -->
        <div>

            <p class="uppercase tracking-[0.35em] text-indigo-500 text-sm font-semibold mb-4">
                FUTURISTIC DASHBOARD
            </p>

            <h1 class="text-6xl md:text-7xl font-extrabold leading-tight text-gray-900">

                Curated

                <span class="text-transparent bg-clip-text bg-gradient-to-r from-indigo-500 to-pink-500">
                    Luxury
                </span>

            </h1>

            <p class="text-gray-500 text-lg mt-6 leading-relaxed max-w-xl">

                Experience a refined vehicle inventory dashboard with premium visuals.

            </p>

            <!-- Stats -->
            <div class="flex flex-wrap gap-5 mt-10">

                <div class="glass rounded-3xl px-6 py-5 min-w-[180px]">

                    <p class="text-gray-500 text-sm">
                        Total Vehicles
                    </p>

                    <h2 class="text-4xl font-bold text-gray-900 mt-2">
                        {{ $cars->count() }}
                    </h2>

                </div>

                <div class="glass rounded-3xl px-6 py-5 min-w-[180px]">

                    <p class="text-gray-500 text-sm">
                        Fleet Status
                    </p>

                    <h2 class="text-4xl font-bold text-green-500 mt-2">
                        Active
                    </h2>

                </div>

            </div>

        </div>

        <!-- Hero Image -->
        <div class="relative">

            <div class="absolute -inset-4 bg-gradient-to-r from-indigo-400 to-pink-400 opacity-20 blur-3xl rounded-full"></div>

            <div class="glass rounded-[2rem] p-5 relative">

                <img src="https://images.unsplash.com/photo-1492144534655-ae79c964c9d7?q=80&w=1400&auto=format&fit=crop"
                     class="rounded-[1.5rem] h-[360px] w-full object-cover shadow-2xl">

            </div>

        </div>

    </div>

</section>

<!-- Cars Section -->
<main class="relative z-10 max-w-7xl mx-auto px-6 pb-24">
    
    <!-- Header -->
    <div class="flex items-center justify-between mb-10">

        <div>

            <h2 class="text-4xl font-bold text-gray-900">
                Featured Fleet
            </h2>

            <p class="text-gray-500 mt-2">
                Explore premium luxury vehicles
            </p>

        </div>

    </div>

<!-- Cars Grid -->
<div class="grid sm:grid-cols-2 lg:grid-cols-3 gap-10">

@forelse($cars as $car)

<div class="car-card bg-white rounded-3xl shadow-md hover:shadow-2xl transition-all duration-500 overflow-hidden group">

    <!-- IMAGE -->
    <div class="relative overflow-hidden">

        <img src="{{ asset('storage/' . $car->image) }}"
             class="h-60 w-full object-cover group-hover:scale-105 transition duration-700">

        <!-- STATUS + MENU -->
        <div class="absolute top-4 right-4 flex items-center gap-2">

            <!-- STATUS -->
            <div class="bg-white/90 backdrop-blur px-3 py-1 rounded-full shadow text-sm">

                <span class="flex items-center gap-2 font-medium
                    {{ $car->status === 'available'
                        ? 'text-green-600'
                        : 'text-red-600' }}">

                    <span class="w-2 h-2 rounded-full animate-pulse
                        {{ $car->status === 'available'
                            ? 'bg-green-500'
                            : 'bg-red-500' }}">
                    </span>

                    {{ ucfirst($car->status) }}

                </span>

            </div>

            <!-- ADMIN MENU -->
            @if(auth()->user()->role === 'admin')

            <div class="relative group/menu">

                <!-- BUTTON -->
                <button class="bg-white/90 backdrop-blur w-10 h-10 rounded-full shadow flex items-center justify-center hover:bg-white transition">

                    ⋮

                </button>

                <!-- DROPDOWN -->
                <div class="absolute right-0 mt-2 w-48 opacity-0 invisible
                            group-hover/menu:opacity-100
                            group-hover/menu:visible
                            transition-all duration-200 z-50">

                    <div class="bg-white rounded-2xl shadow-xl overflow-hidden border">

                        <!-- AVAILABLE -->
                        <form action="{{ route('cars.status', $car->id) }}"
                              method="POST">

                            @csrf
                            @method('PATCH')

                            <input type="hidden"
                                   name="status"
                                   value="available">

                            <button
                                class="w-full text-left px-4 py-3 text-sm
                                hover:bg-green-50 text-green-600">

                                ✅ Make Available

                            </button>

                        </form>

                        <!-- DISABLE -->
                        <form action="{{ route('cars.status', $car->id) }}"
                              method="POST">

                            @csrf
                            @method('PATCH')

                            <input type="hidden"
                                   name="status"
                                   value="disabled">

                            <button
                                class="w-full text-left px-4 py-3 text-sm
                                hover:bg-red-50 text-red-600">

                                🚫 Disable Vehicle

                            </button>

                        </form>

                    </div>

                </div>

            </div>

            @endif

        </div>

    </div>

    <!-- CONTENT -->
    <div class="p-6 space-y-6">

        <!-- TITLE -->
        <div>

            <h2 class="text-xl font-semibold text-gray-800">
                {{ $car->name }}
            </h2>

            <p class="text-gray-500 text-sm">
                {{ $car->model }}
            </p>

        </div>

        <!-- PRICE -->
        <div class="bg-gradient-to-r from-indigo-50 to-pink-50 rounded-2xl p-5 flex items-center justify-between">

            <div>

                <p class="text-sm text-gray-500">
                    Daily Rent
                </p>

                <h3 class="text-2xl font-medium text-gray-900">
                    LKR {{ number_format($car->rent) }}
                </h3>

            </div>

            <div class="text-indigo-500 text-sm font-medium">
                / day
            </div>

        </div>

        <!-- INFO -->
        <div class="grid grid-cols-2 gap-4 text-sm">

            <div class="bg-gray-50 rounded-xl p-4 text-center">

                <p class="text-gray-400">
                    Year
                </p>

                <p class="font-medium text-gray-800 mt-1">
                    {{ $car->year }}
                </p>

            </div>

            <div class="bg-gray-50 rounded-xl p-4 text-center">

                <p class="text-gray-400">
                    Type
                </p>

                <p class="font-medium text-gray-800 mt-1">
                    Luxury
                </p>

            </div>

        </div>

        <!-- ACTIONS -->
        <div class="flex gap-3 pt-2">

            @if($car->status === 'available')

            <a href="{{ route('bookings.create',$car->id) }}"
               class="flex-1 text-center py-3 rounded-xl
               bg-gradient-to-r from-indigo-600 to-purple-600
               text-white font-semibold
               hover:scale-[1.03] transition">

                Book Now

            </a>

            @else

            <button
                disabled
                class="flex-1 py-3 rounded-xl
                bg-gray-300 text-gray-500 cursor-not-allowed">

                Vehicle Disabled

            </button>

            @endif

            @if(auth()->user()->role === 'admin')

            <a href="{{ route('cars.edit',$car->id) }}"
               class="px-4 py-3 rounded-xl bg-gray-100
               hover:bg-gray-200 transition">

                ✏️

            </a>

            <form action="{{ route('cars.destroy',$car->id) }}"
                  method="POST">

                @csrf
                @method('DELETE')

                <button
                    onclick="return confirm('Delete this vehicle?')"
                    class="px-4 py-3 rounded-xl bg-red-50
                    hover:bg-red-100 text-red-600 transition">

                    🗑️

                </button>

            </form>

            @endif

        </div>

    </div>

</div>

@empty

<div class="col-span-full text-center py-20">

    <div class="text-6xl mb-4">
        🚗
    </div>

    <h2 class="text-3xl font-semibold text-gray-800">
        No Vehicles Found
    </h2>

    <p class="text-gray-500 mt-3">
        Add your first vehicle to begin
    </p>

</div>

@endforelse

</div>

</main>

</body>
</html>