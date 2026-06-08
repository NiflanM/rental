<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Luxury Garage</title>

    <script src="https://cdn.tailwindcss.com"></script>

    <link href="https://fonts.googleapis.com/css2?family=Syne:wght=400;600;700;800&family=Inter:wght=400;500;600;700&display=swap" rel="stylesheet">

    <style>
        body{
            font-family: 'Inter', sans-serif;
            background:
                radial-gradient(circle at top left, rgba(99,102,241,0.05), transparent 25%),
                radial-gradient(circle at bottom right, rgba(236,72,153,0.04), transparent 25%),
                linear-gradient(to bottom right,#f8fafc,#ffffff,#f1f5f9);
            overflow-x: hidden;
        }

        h1,h2,h3{
            font-family: 'Syne', sans-serif;
        }

        .glass{
            background: rgba(255,255,255,0.75);
            backdrop-filter: blur(20px);
            border: 1px solid rgba(255,255,255,0.6);
            box-shadow: 0 10px 40px rgba(15,23,42,0.04);
        }

        .car-card {
            transition: all 0.4s cubic-bezier(0.16, 1, 0.3, 1);
        }

        .car-card:hover {
            transform: translateY(-8px);
            box-shadow: 
                0 20px 40px -15px rgba(15, 23, 42, 0.08),
                0 0 0 1px rgba(99, 102, 241, 0.1);
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
            opacity:.12;
            z-index:0;
        }
    </style>
</head>

<body class="relative min-h-screen text-gray-800 bg-slate-50">

<div class="blob bg-indigo-400 w-96 h-96 top-0 left-0"></div>
<div class="blob bg-pink-300 w-96 h-96 bottom-0 right-0"></div>

<header class="sticky top-0 z-50 backdrop-blur-xl bg-white/70 border-b border-slate-200/50">
    <div class="max-w-7xl mx-auto px-6 py-5 flex items-center justify-between">
        <div>
            <h1 class="text-2xl font-extrabold tracking-tight text-gray-900">LUXURY GARAGE</h1>
            <p class="text-xs text-gray-400 font-medium tracking-wide uppercase mt-0.5">Premium Vehicle Collection</p>
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

<section class="relative z-10 max-w-7xl mx-auto px-6 pt-12 pb-8">
    <div class="grid lg:grid-cols-2 gap-12 items-center">
        <div>
            <p class="uppercase tracking-[0.25em] text-indigo-600 text-xs font-bold mb-3">FUTURISTIC DASHBOARD</p>
            <h1 class="text-5xl md:text-6xl font-extrabold leading-tight text-slate-900 tracking-tight">
                Curated <span class="text-transparent bg-clip-text bg-gradient-to-r from-indigo-600 to-pink-600">Luxury</span>
            </h1>
            <p class="text-slate-500 text-base mt-4 leading-relaxed max-w-xl">Experience a refined vehicle inventory dashboard with premium visuals.</p>

            <div class="flex flex-wrap gap-4 mt-8">
                <div class="glass rounded-2xl px-5 py-4 min-w-[160px]">
                    <p class="text-slate-400 text-xs font-semibold uppercase tracking-wider">Total Vehicles</p>
                    <h2 class="text-3xl font-bold text-slate-900 mt-1">{{ $cars->count() }}</h2>
                </div>
                <div class="glass rounded-2xl px-5 py-4 min-w-[160px]">
                    <p class="text-slate-400 text-xs font-semibold uppercase tracking-wider">Fleet Status</p>
                    <h2 class="text-3xl font-bold text-emerald-600 mt-1">Active</h2>
                </div>
            </div>
        </div>

        <div class="relative">
            <div class="absolute -inset-4 bg-gradient-to-r from-indigo-400 to-pink-400 opacity-10 blur-3xl rounded-full"></div>
            <div class="glass rounded-3xl p-4 relative border border-slate-200/40">
                <img src="https://images.unsplash.com/photo-1492144534655-ae79c964c9d7?q=80&w=1400&auto=format&fit=crop" class="rounded-2xl h-[280px] w-full object-cover shadow-sm">
            </div>
        </div>
    </div>
</section>

<main class="relative z-10 max-w-7xl mx-auto px-6 pb-24">
    <div class="flex items-center justify-between mb-8 border-b border-slate-200/60 pb-5">
        <div>
            <h2 class="text-3xl font-bold text-slate-900 tracking-tight">Featured Fleet</h2>
            <p class="text-sm text-slate-400 mt-0.5">Explore premium luxury vehicles ready for your selection</p>
        </div>
    </div>

    <div class="grid sm:grid-cols-2 lg:grid-cols-3 gap-8">
    @forelse($cars as $car)
        <div class="car-card bg-white rounded-2xl border border-slate-200/80 shadow-sm overflow-hidden flex flex-col justify-between relative group/card">
            
            <div>
                <div class="relative overflow-hidden group/slider h-60 w-full bg-slate-50 border-b border-slate-100" id="slider-{{ $car->id }}">
                    <div class="flex h-full w-full transition-transform duration-500 ease-out" id="track-{{ $car->id }}">
                        @if(!empty($car->images) && is_array($car->images))
                            @foreach($car->images as $img)
                                <div class="w-full h-full flex-shrink-0">
                                    <img src="{{ asset('storage/' . $img) }}" class="h-full w-full object-cover transform scale-100 group-hover/slider:scale-102 transition duration-500">
                                </div>
                            @endforeach
                        @else
                            <div class="w-full h-full flex flex-col items-center justify-center bg-slate-50 text-slate-300 gap-1.5">
                                <span class="text-3xl">🚗</span>
                                <span class="text-[10px] font-bold tracking-widest uppercase text-slate-400/70">No Media Files</span>
                            </div>
                        @endif
                    </div>

                    @if(!empty($car->images) && count($car->images) > 1)
                        <button onclick="moveSlider('{{ $car->id }}', -1)" class="absolute left-3 top-1/2 -translate-y-1/2 w-7 h-7 rounded-lg bg-white/90 border border-slate-200/60 shadow-sm flex items-center justify-center text-slate-700 text-xs font-bold opacity-0 group-hover/slider:opacity-100 transition-all duration-200 hover:bg-white z-20">
                            &larr;
                        </button>
                        <button onclick="moveSlider('{{ $car->id }}', 1)" class="absolute right-3 top-1/2 -translate-y-1/2 w-7 h-7 rounded-lg bg-white/90 border border-slate-200/60 shadow-sm flex items-center justify-center text-slate-700 text-xs font-bold opacity-0 group-hover/slider:opacity-100 transition-all duration-200 hover:bg-white z-20">
                            &rarr;
                        </button>

                        <div class="absolute bottom-3 left-1/2 -translate-x-1/2 flex gap-1 z-20 bg-slate-900/10 px-2 py-1 rounded-full backdrop-blur-sm">
                            @foreach($car->images as $index => $img)
                                <span id="dot-{{ $car->id }}-{{ $index }}" class="w-1.5 h-1.5 rounded-full transition-all duration-200 {{ $index === 0 ? 'bg-white scale-110' : 'bg-white/40' }}"></span>
                            @endforeach
                        </div>
                    @endif

                    <div class="absolute top-3 right-3 left-3 flex items-center justify-between z-30 pointer-events-none">
                        <div class="bg-white/90 backdrop-blur-md px-2.5 py-1 rounded-lg shadow-sm text-[11px] font-bold tracking-wide pointer-events-auto border border-slate-200/60">
                            <span class="flex items-center gap-1.5 {{ $car->status === 'available' ? 'text-emerald-600' : 'text-rose-600' }}">
                                <span class="w-1.5 h-1.5 rounded-full {{ $car->status === 'available' ? 'bg-emerald-500 animate-pulse' : 'bg-rose-500' }}"></span>
                                {{ ucfirst($car->status ?? 'available') }}
                            </span>
                        </div>

                        @if(auth()->check() && auth()->user()->role === 'admin')
                        <div class="relative group/menu pointer-events-auto">
                            <button class="bg-white/90 backdrop-blur-md w-7 h-7 rounded-lg shadow-sm flex items-center justify-center text-slate-600 hover:bg-white border border-slate-200/60 font-bold transition">⋮</button>
                            <div class="absolute right-0 mt-1.5 w-44 opacity-0 invisible group-hover/menu:opacity-100 group-hover/menu:visible transition-all duration-200 z-40">
                                <div class="bg-white rounded-xl shadow-lg overflow-hidden border border-slate-200 p-1">
                                    <form action="{{ route('cars.status', $car->id) }}" method="POST">
                                        @csrf @method('PATCH')
                                        <input type="hidden" name="status" value="available">
                                        <button class="w-full text-left px-3 py-2 text-xs font-semibold rounded-lg hover:bg-slate-50 text-emerald-600 transition">Make Available</button>
                                    </form>
                                    <form action="{{ route('cars.status', $car->id) }}" method="POST">
                                        @csrf @method('PATCH')
                                        <input type="hidden" name="status" value="disabled">
                                        <button class="w-full text-left px-3 py-2 text-xs font-semibold rounded-lg hover:bg-slate-50 text-rose-600 transition">Disable Vehicle</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                        @endif
                    </div>
                </div>

                <div class="p-5 space-y-4">
                    <div>
                        <div class="flex items-start justify-between gap-2">
                            <h2 class="text-lg font-bold text-slate-900 tracking-tight truncate group-hover/card:text-indigo-600 transition-colors duration-300">{{ $car->name }}</h2>
                            <span class="text-xs font-bold text-slate-400 bg-slate-100 px-2 py-0.5 rounded-md mt-0.5">{{ $car->year }}</span>
                        </div>
                        <p class="text-[11px] font-bold uppercase text-slate-400 tracking-wider mt-0.5">{{ $car->model }}</p>
                    </div>

                    <div class="flex flex-wrap gap-1.5 pt-0.5">
                        <span class="text-[11px] font-medium text-slate-500 bg-slate-50 border border-slate-200/60 px-2.5 py-1 rounded-md">
                            Premium Fleet
                        </span>
                        <span class="text-[11px] font-medium text-slate-500 bg-slate-50 border border-slate-200/60 px-2.5 py-1 rounded-md truncate max-w-[180px]" title="{{ $car->pickup_address ?? 'Yard unassigned' }}">
                            Location: {{ $car->pickup_address ?? 'Unassigned' }}
                        </span>
                    </div>

                    <div class="border-t border-slate-100 pt-4 flex items-baseline justify-between">
                        <div>
                            <span class="block text-[10px] font-bold uppercase tracking-wider text-slate-400">Daily Rent</span>
                            <span class="text-xl font-extrabold text-slate-900 tracking-tight">LKR {{ number_format($car->rent) }}</span>
                        </div>
                        {{-- <div class="text-right">
                            <span class="block text-[10px] font-medium text-slate-400">Estimated Base</span>
                            <span class="text-xs font-bold text-indigo-600">No Deposit Option</span>
                        </div> --}}
                    </div>
                </div>
            </div>

            <div class="p-5 pt-0 flex gap-2">
                @if(($car->status ?? 'available') === 'available')
                    <a href="{{ route('bookings.create',$car->id) }}" class="flex-1 text-center py-3 rounded-xl bg-slate-900 text-white font-semibold text-xs tracking-wider uppercase hover:bg-slate-800 transition-all duration-300 shadow-sm">Book Vehicle</a>
                @else
                    <button disabled class="flex-1 py-3 rounded-xl bg-slate-100 text-slate-400 text-xs font-bold tracking-wider uppercase border border-slate-200/40 cursor-not-allowed">Unavailable</button>
                @endif

                @if(auth()->check() && auth()->user()->role === 'admin')
                    <a href="{{ route('cars.edit',$car->id) }}" class="w-10 h-10 rounded-xl bg-white hover:bg-slate-50 border border-slate-200 flex items-center justify-center text-slate-600 transition" title="Edit Vehicle">
                        <span class="text-xs">✏️</span>
                    </a>
                    <form action="{{ route('cars.destroy',$car->id) }}" method="POST" class="inline-block">
                        @csrf @method('DELETE')
                        <button onclick="return confirm('Delete this vehicle?')" class="w-10 h-10 rounded-xl bg-white hover:bg-rose-50 border border-slate-200 flex items-center justify-center text-rose-600 transition" title="Remove Vehicle">
                            <span class="text-xs">🗑️</span>
                        </button>
                    </form>
                @endif
            </div>
        </div>
    @empty
        <div class="col-span-full text-center py-16 bg-white rounded-2xl border border-slate-200">
            <div class="text-4xl mb-3">🚗</div>
            <h2 class="text-xl font-bold text-slate-800">No Vehicles Found</h2>
            <p class="text-sm text-slate-400 mt-1">Add your first vehicle listing to begin building the collection</p>
        </div>
    @endforelse
    </div>
</main>

<script>
    const sliderStates = {};

    function moveSlider(carId, direction) {
        const track = document.getElementById(`track-${carId}`);
        if (!track) return;

        const totalSlides = track.children.length;
        if (sliderStates[carId] === undefined) {
            sliderStates[carId] = 0;
        }

        updateDotIndicator(carId, sliderStates[carId], false);

        sliderStates[carId] += direction;
        if (sliderStates[carId] >= totalSlides) {
            sliderStates[carId] = 0;
        } else if (sliderStates[carId] < 0) {
            sliderStates[carId] = totalSlides - 1;
        }

        track.style.transform = `translateX(-${sliderStates[carId] * 100}%)`;
        updateDotIndicator(carId, sliderStates[carId], true);
    }

    function updateDotIndicator(carId, slideIndex, isActive) {
        const dot = document.getElementById(`dot-${carId}-${slideIndex}`);
        if (!dot) return;
        
        if (isActive) {
            dot.classList.remove('bg-white/40');
            dot.classList.add('bg-white', 'scale-110');
        } else {
            dot.classList.remove('bg-white', 'scale-110');
            dot.classList.add('bg-white/40');
        }
    }
</script>
</body>
</html>