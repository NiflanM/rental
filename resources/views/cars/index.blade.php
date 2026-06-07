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

<div class="blob bg-indigo-400 w-96 h-96 top-0 left-0"></div>
<div class="blob bg-pink-300 w-96 h-96 bottom-0 right-0"></div>

<header class="sticky top-0 z-50 backdrop-blur-xl bg-white/60 border-b border-white/40">
    <div class="max-w-7xl mx-auto px-6 py-5 flex items-center justify-between">
        <div>
            <h1 class="text-3xl font-extrabold tracking-tight text-gray-900">LUXURY GARAGE</h1>
            <p class="text-sm text-gray-500 mt-1">Premium Vehicle Collection</p>
        </div>

        <div class="flex items-center gap-4">
            <a href="{{ route('cars.index') }}" class="btn px-5 py-3 rounded-2xl bg-gradient-to-r from-indigo-500 to-pink-500 text-white font-semibold shadow-xl hover:shadow-2xl">Vehicles</a>
            <a href="{{ route('bookings.index') }}" class="btn px-5 py-3 rounded-2xl bg-gradient-to-r from-indigo-500 to-pink-500 text-white font-semibold shadow-xl hover:shadow-2xl">My Bookings</a>

            @if(auth()->check() && auth()->user()->role === 'admin')
                <a href="{{ route('cars.create') }}" class="btn px-5 py-3 rounded-2xl bg-gradient-to-r from-indigo-500 to-pink-500 text-white font-semibold shadow-xl hover:shadow-2xl">+ Add Vehicle</a>
                <a href="{{ route('dashboard') }}" class="btn px-5 py-3 rounded-2xl bg-gray-900 text-white font-semibold shadow-xl hover:bg-gray-800 transition">Dashboard</a>
            @endif

            <div class="relative group">
                <a href="{{ route('profile.edit') }}" class="flex items-center gap-3 px-4 py-2 rounded-2xl bg-white/60 hover:bg-white/90 shadow transition">
                    <div class="w-9 h-9 rounded-full bg-gradient-to-r from-indigo-500 to-pink-500 flex items-center justify-center text-white font-bold">
                        @if(auth()->check())
<div class="w-9 h-9 rounded-full bg-gradient-to-r from-indigo-500 to-pink-500 flex items-center justify-center text-white font-bold">
    {{ strtoupper(substr(auth()->user()->name,0,1)) }}
</div>
@endif
                    </div>
                </a>

                <div class="absolute right-0 mt-2 w-44 opacity-0 invisible group-hover:opacity-100 group-hover:visible transition-all duration-200">
                    <div class="bg-white/80 backdrop-blur-xl border border-white/40 rounded-2xl shadow-xl overflow-hidden">
                        <a href="{{ route('profile.edit') }}" class="block px-4 py-3 text-sm text-gray-700 hover:bg-indigo-50">👤 My Profile</a>
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button class="w-full text-left px-4 py-3 text-sm text-red-600 hover:bg-red-50">🚪 Logout</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</header>

<section class="relative z-10 max-w-7xl mx-auto px-6 pt-16 pb-12">
    <div class="grid lg:grid-cols-2 gap-12 items-center">
        <div>
            <p class="uppercase tracking-[0.35em] text-indigo-500 text-sm font-semibold mb-4">FUTURISTIC DASHBOARD</p>
            <h1 class="text-6xl md:text-7xl font-extrabold leading-tight text-gray-900">
                Curated <span class="text-transparent bg-clip-text bg-gradient-to-r from-indigo-500 to-pink-500">Luxury</span>
            </h1>
            <p class="text-gray-500 text-lg mt-6 leading-relaxed max-w-xl">Experience a refined vehicle inventory dashboard with premium visuals.</p>

            <div class="flex flex-wrap gap-5 mt-10">
                <div class="glass rounded-3xl px-6 py-5 min-w-[180px]">
                    <p class="text-gray-500 text-sm">Total Vehicles</p>
                    <h2 class="text-4xl font-bold text-gray-900 mt-2">{{ $cars->count() }}</h2>
                </div>
                <div class="glass rounded-3xl px-6 py-5 min-w-[180px]">
                    <p class="text-gray-500 text-sm">Fleet Status</p>
                    <h2 class="text-4xl font-bold text-green-500 mt-2">Active</h2>
                </div>
            </div>
        </div>

        <div class="relative">
            <div class="absolute -inset-4 bg-gradient-to-r from-indigo-400 to-pink-400 opacity-20 blur-3xl rounded-full"></div>
            <div class="glass rounded-[2rem] p-5 relative">
                <img src="https://images.unsplash.com/photo-1492144534655-ae79c964c9d7?q=80&w=1400&auto=format&fit=crop" class="rounded-[1.5rem] h-[360px] w-full object-cover shadow-2xl">
            </div>
        </div>
    </div>
</section>

<main class="relative z-10 max-w-7xl mx-auto px-6 pb-24">
    <div class="flex items-center justify-between mb-10">
        <div>
            <h2 class="text-4xl font-bold text-gray-900">Featured Fleet</h2>
            <p class="text-gray-500 mt-2">Explore premium luxury vehicles</p>
        </div>
    </div>

    <div class="grid sm:grid-cols-2 lg:grid-cols-3 gap-10">
    @forelse($cars as $car)
        <div class="car-card bg-white/70 backdrop-blur-md rounded-[2.25rem] border border-white/60 shadow-lg hover:shadow-2xl overflow-hidden flex flex-col justify-between">
            
            <div>
                <div class="relative overflow-hidden group/slider h-64 w-full bg-slate-100 border-b border-slate-100" id="slider-{{ $car->id }}">
                    <div class="flex h-full w-full transition-transform duration-500 ease-out" id="track-{{ $car->id }}">
                        @if(!empty($car->images) && is_array($car->images))
                            @foreach($car->images as $img)
                                <div class="w-full h-full flex-shrink-0">
                                    <img src="{{ asset('storage/' . $img) }}" class="h-full w-full object-cover transform scale-100 group-hover/slider:scale-105 transition duration-700">
                                </div>
                            @endforeach
                        @else
                            <div class="w-full h-full flex flex-col items-center justify-center bg-slate-100 text-slate-400 gap-1.5">
                                <span class="text-2xl">🚗</span>
                                <span class="text-xs font-semibold tracking-wider uppercase opacity-60">No Media Files</span>
                            </div>
                        @endif
                    </div>

                    @if(!empty($car->images) && count($car->images) > 1)
                        <button onclick="moveSlider('{{ $car->id }}', -1)" class="absolute left-4 top-1/2 -translate-y-1/2 w-8 h-8 rounded-full bg-white/80 backdrop-blur shadow-md flex items-center justify-center text-gray-800 text-xs font-bold opacity-0 group-hover/slider:opacity-100 transition-all duration-300 hover:bg-white z-20">
                            &larr;
                        </button>
                        <button onclick="moveSlider('{{ $car->id }}', 1)" class="absolute right-4 top-1/2 -translate-y-1/2 w-8 h-8 rounded-full bg-white/80 backdrop-blur shadow-md flex items-center justify-center text-gray-800 text-xs font-bold opacity-0 group-hover/slider:opacity-100 transition-all duration-300 hover:bg-white z-20">
                            &rarr;
                        </button>

                        <div class="absolute bottom-4 left-1/2 -translate-x-1/2 flex gap-1.5 z-20 bg-black/10 px-2.5 py-1.5 rounded-full backdrop-blur-md">
                            @foreach($car->images as $index => $img)
                                <span id="dot-{{ $car->id }}-{{ $index }}" class="w-1.5 h-1.5 rounded-full transition-all duration-300 {{ $index === 0 ? 'bg-white scale-125' : 'bg-white/40' }}"></span>
                            @endforeach
                        </div>
                    @endif

                    <div class="absolute top-4 right-4 left-4 flex items-center justify-between z-30 pointer-events-none">
                        <div class="bg-white/90 backdrop-blur-md px-3 py-1.5 rounded-xl shadow-sm text-xs font-semibold tracking-wide pointer-events-auto border border-white/40">
                            <span class="flex items-center gap-2 {{ $car->status === 'available' ? 'text-emerald-600' : 'text-rose-600' }}">
                                <span class="w-1.5 h-1.5 rounded-full {{ $car->status === 'available' ? 'bg-emerald-500 animate-pulse' : 'bg-rose-500' }}"></span>
                                {{ ucfirst($car->status ?? 'available') }}
                            </span>
                        </div>

                        @if(auth()->check() && auth()->user()->role === 'admin')
                        <div class="relative group/menu pointer-events-auto">
                            <button class="bg-white/90 backdrop-blur-md w-9 h-9 rounded-xl shadow-sm flex items-center justify-center text-gray-700 hover:bg-white border border-white/40 font-bold transition">⋮</button>
                            <div class="absolute right-0 mt-2 w-48 opacity-0 invisible group-hover/menu:opacity-100 group-hover/menu:visible transition-all duration-200 z-30">
                                <div class="bg-white/90 backdrop-blur-xl rounded-2xl shadow-xl overflow-hidden border border-slate-100 p-1">
                                    <form action="{{ route('cars.status', $car->id) }}" method="POST">
                                        @csrf @method('PATCH')
                                        <input type="hidden" name="status" value="available">
                                        <button class="w-full text-left px-4 py-2.5 text-sm font-medium rounded-xl hover:bg-emerald-50 text-emerald-600 transition">Make Available</button>
                                    </form>
                                    <form action="{{ route('cars.status', $car->id) }}" method="POST">
                                        @csrf @method('PATCH')
                                        <input type="hidden" name="status" value="disabled">
                                        <button class="w-full text-left px-4 py-2.5 text-sm font-medium rounded-xl hover:bg-rose-50 text-rose-600 transition">Disable Vehicle</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                        @endif
                    </div>
                </div>

                <div class="p-6 space-y-5">
                    <div>
                        <h2 class="text-2xl font-bold text-gray-900 tracking-tight truncate">{{ $car->name }}</h2>
                        <p class="text-xs font-semibold uppercase text-indigo-500 tracking-widest mt-0.5">{{ $car->model }}</p>
                        
                        <div class="mt-4 flex items-center gap-2 text-xs font-medium text-gray-500 bg-slate-50 border border-slate-100 px-3 py-2 rounded-xl">
                            <span class="text-base flex-shrink-0">📍</span>
                            <span class="truncate">
                                <strong>Pickup:</strong> {{ $car->pickup_address ?? 'Yard unassigned' }}
                            </span>
                        </div>
                    </div>

                    <div class="grid grid-cols-2 gap-3 text-xs">
                        <div class="bg-slate-50 border border-slate-100 rounded-xl p-3 flex flex-col justify-center">
                            <p class="text-gray-400 font-medium">Production Year</p>
                            <p class="font-bold text-gray-800 mt-0.5">{{ $car->year }}</p>
                        </div>
                        <div class="bg-slate-50 border border-slate-100 rounded-xl p-3 flex flex-col justify-center">
                            <p class="text-gray-400 font-medium">Classification</p>
                            <p class="font-bold text-gray-800 mt-0.5">Premium Fleet</p>
                        </div>
                    </div>

                    <div class="bg-gradient-to-r from-indigo-50/70 to-pink-50/70 border border-indigo-100/40 rounded-2xl p-4 flex items-center justify-between">
                        <div>
                            <p class="text-xs font-bold uppercase tracking-wider text-gray-400">Daily Hold Rate</p>
                            <h3 class="text-2xl font-black text-transparent bg-clip-text bg-gradient-to-r from-indigo-600 to-pink-600 tracking-tight mt-0.5">LKR {{ number_format($car->rent) }}</h3>
                        </div>
                        <div class="text-slate-400 text-xs font-bold uppercase tracking-wider">/ day</div>
                    </div>
                </div>
            </div>

            <div class="p-6 pt-0 flex gap-2.5">
                @if(($car->status ?? 'available') === 'available')
                    <a href="{{ route('bookings.create',$car->id) }}" class="flex-1 text-center py-3.5 rounded-xl bg-gradient-to-r from-indigo-500 to-pink-500 text-white font-bold text-xs tracking-wider uppercase shadow-md hover:shadow-lg hover:brightness-105 transition-all duration-300">Book Now</a>
                @else
                    <button disabled class="flex-1 py-3.5 rounded-xl bg-slate-100 text-slate-400 text-xs font-bold tracking-wider uppercase border border-slate-200/50 cursor-not-allowed">Vehicle Disabled</button>
                @endif

                @if(auth()->check() && auth()->user()->role === 'admin')
                    <a href="{{ route('cars.edit',$car->id) }}" class="w-12 h-11 rounded-xl bg-slate-50 hover:bg-slate-100 border border-slate-200/60 flex items-center justify-center transition duration-200" title="Edit Vehicle">
                        <span class="text-sm">✏️</span>
                    </a>
                    <form action="{{ route('cars.destroy',$car->id) }}" method="POST" class="inline-block">
                        @csrf @method('DELETE')
                        <button onclick="return confirm('Delete this vehicle?')" class="w-12 h-11 rounded-xl bg-rose-50 hover:bg-rose-100 border border-rose-200/40 flex items-center justify-center text-rose-600 transition duration-200" title="Remove Vehicle">
                            <span class="text-sm">🗑️</span>
                        </button>
                    </form>
                @endif
            </div>
        </div>
    @empty
        <div class="col-span-full text-center py-20 bg-white/50 backdrop-blur rounded-[2rem] border border-white/60">
            <div class="text-6xl mb-4">🚗</div>
            <h2 class="text-3xl font-semibold text-gray-800">No Vehicles Found</h2>
            <p class="text-gray-500 mt-3">Add your first vehicle to begin</p>
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
            dot.classList.add('bg-white', 'scale-125');
        } else {
            dot.classList.remove('bg-white', 'scale-125');
            dot.classList.add('bg-white/40');
        }
    }
</script>
</body>
</html>