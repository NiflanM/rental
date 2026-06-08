<!DOCTYPE html>
<html lang="en" class="transition duration-500 scroll-smooth">
<head>

<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">

<title>Luxury Garage | Premium Vehicle Rental Marketplace</title>

<script src="https://cdn.tailwindcss.com"></script>

<script src="https://unpkg.com/lucide@latest"></script>

<link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:wght=400;500;600;700;800&family=Syne:wght=700;800&display=swap" rel="stylesheet">

<style>

/* ---------- GLOBAL ---------- */

body{
font-family:'Plus Jakarta Sans',sans-serif;
background:#f8fafc;
overflow-x:hidden;
}

.dark body{
background:#0b0f19;
color:#f8fafc;
}

h1,h2,h3{font-family:'Syne',sans-serif}

/* ---------- ANIMATED BACKGROUND ---------- */

.bg-animate{
position:fixed;
inset:0;
z-index:-1;
background:
radial-gradient(circle at 10% 20%, rgba(99,102,241,0.12),transparent 40%),
radial-gradient(circle at 90% 80%, rgba(236,72,153,0.08),transparent 40%);
animation:moveBg 20s linear infinite;
}

@keyframes moveBg{
0%{transform:translateY(0)}
50%{transform:translateY(-30px)}
100%{transform:translateY(0)}
}

/* ---------- GLASS ---------- */

.glass{
background:rgba(255,255,255,0.8);
backdrop-filter:blur(20px);
border:1px solid rgba(241,245,249,1);
}

.dark .glass{
background:rgba(20,27,45,0.7);
border:1px solid rgba(255,255,255,0.04);
}

/* ---------- SCROLL REVEAL ---------- */

.reveal{
opacity:0;
transform:translateY(30px);
transition:all 0.8s cubic-bezier(0.16, 1, 0.3, 1);
}

.reveal.show{
opacity:1;
transform:none;
}

</style>

</head>

<body class="text-slate-900 dark:text-slate-100 transition-colors duration-300">

<div class="bg-animate"></div>

<div class="bg-indigo-600 text-white text-center py-2 px-4 text-xs font-semibold tracking-wide relative z-50">
    ✨ Fleet Update: New Aston Martin Vanguard & Porsche GT3 RS editions available for reservation parameters now.
</div>

<header class="glass sticky top-0 z-50 border-b border-slate-100 dark:border-slate-800/60">
<div class="max-w-7xl mx-auto px-6 h-20 flex justify-between items-center">

<h1 class="flex items-center gap-2.5 text-slate-900 dark:text-white text-xl font-extrabold tracking-tight">
<div class="w-9 h-9 rounded-xl bg-indigo-600 flex items-center justify-center text-white shadow-md shadow-indigo-600/20">
<i data-lucide="compass" class="w-5 h-5"></i>
</div>
<span>LUXIRA<span class="text-indigo-600 dark:text-indigo-400 font-medium">GARAGE</span></span>
</h1>

<div class="flex gap-8 items-center font-semibold text-[14px]">

<a href="{{ route('cars.index') }}" class="text-indigo-600 dark:text-indigo-400">Explore Fleet</a> 
<a href="#process" class="hover:text-indigo-500 transition">How It Works</a>
<a href="#pricing-guarantee" class="hover:text-indigo-500 transition">Transparency Policy</a>
<a href="{{ route('bookings.index') }}" class="hover:text-indigo-500 transition">Track Booking</a>

<button onclick="toggleTheme()" class="p-2.5 rounded-xl border border-slate-200/60 dark:border-slate-800/80 bg-white dark:bg-slate-900 text-slate-700 dark:text-slate-300 hover:bg-slate-50 transition">
<i data-lucide="moon" class="w-4 h-4 dark:hidden"></i>
<i data-lucide="sun" class="w-4 h-4 hidden dark:block"></i>
</button>

</div>
</div>
</header>

<section class="relative min-h-[95vh] flex items-center justify-center pt-16 pb-24 px-6 overflow-hidden bg-slate-950">
    
    <div class="absolute inset-0 z-0 select-none pointer-events-none">
        <img src="https://images.unsplash.com/photo-1618843479313-40f8afb4b4d8?q=80&w=2000&auto=format&fit=crop" class="w-full h-full object-cover transform scale-105 opacity-35 dark:opacity-25 blur-[2px] brightness-[0.4] contrast-[1.1]" alt="Premium Supercar Backdrop">
        <div class="absolute inset-0 bg-gradient-to-b from-slate-950/40 via-slate-950/20 to-[#f8fafc] dark:to-[#0b0f19]"></div>
        <div class="absolute inset-0 bg-radial-gradient from-transparent to-slate-950/80"></div>
    </div>

    <div class="relative z-10 w-full max-w-7xl mx-auto flex flex-col items-center text-center">
        
        <div class="max-w-4xl mx-auto space-y-6 mb-16 reveal show">
            <span class="inline-flex items-center gap-1.5 px-3 py-1 rounded-full text-xs font-bold bg-indigo-500/10 text-indigo-400 border border-indigo-500/20 backdrop-blur-sm">
                <span class="w-1.5 h-1.5 rounded-full bg-indigo-400 animate-pulse"></span> Premium Rental Marketplace
            </span>

            <h1 class="text-5xl sm:text-7xl font-extrabold tracking-tight text-white leading-[1.1] drop-shadow-md">
                On-Demand Luxury. <br class="hidden sm:inline">No Showroom Lines.
            </h1>

            <p class="text-base sm:text-xl text-slate-300 dark:text-slate-400 font-medium max-w-2xl mx-auto leading-relaxed drop-shadow">
                Instantly book real-time verified supercars, elite track editions, and chauffeured SUVs delivered directly to your location terminal.
            </p>
            
            <div class="pt-4 flex flex-wrap gap-4 justify-center">
                <a href="{{ route('cars.index') }}" class="inline-flex items-center gap-2 bg-indigo-600 hover:bg-indigo-700 text-white font-semibold px-7 py-4 rounded-xl text-sm transition shadow-lg shadow-indigo-600/40 transform hover:-translate-y-0.5 duration-200">
                    Explore Fleet Inventory <i data-lucide="arrow-right" class="w-4 h-4"></i>
                </a>
                @guest
                    <a href="/register" class="inline-flex items-center gap-2 backdrop-blur-md bg-white/10 hover:bg-white/20 text-white border border-white/20 font-semibold px-7 py-4 rounded-xl text-sm transition transform hover:-translate-y-0.5 duration-200">
                        Create Account
                    </a>
                @endguest
            </div>
        </div>

        <form action="{{ route('cars.index') }}" method="GET" class="w-full max-w-6xl mx-auto bg-white dark:bg-slate-900 shadow-[0_30px_70px_rgba(0,0,0,0.3)] rounded-2xl md:rounded-3xl p-6 md:p-8 border border-slate-100 dark:border-slate-800/80 relative z-20 reveal show">
            <div class="grid grid-cols-1 md:grid-cols-12 gap-5 items-end text-left">
                
                <div class="md:col-span-4 space-y-2">
                    <label class="block text-xs font-bold uppercase tracking-wider text-slate-400 dark:text-slate-500">Pick-up Location</label>
                    <div class="relative flex items-center">
                        <i data-lucide="map-pin" class="absolute left-4 text-indigo-500 w-4 h-4 z-10"></i>
                        <input 
                            type="text" 
                            name="location"
                            value="{{ request('location') }}"
                            list="db-pickup-locations" 
                            placeholder="Type or click to select pickup location..." 
                            class="w-full bg-slate-50 dark:bg-slate-950 text-sm pl-11 pr-4 py-4 rounded-xl border border-slate-100 dark:border-slate-800 focus:border-indigo-500 dark:focus:border-indigo-400 transition font-medium outline-none text-slate-800 dark:text-slate-200"
                        >
                        <datalist id="db-pickup-locations">
                            @foreach($locations as $address)
                                <option value="{{ $address }}">
                            @endforeach
                        </datalist>
                    </div>
                </div>

                <div class="sm:col-span-6 md:col-span-3 space-y-2">
                    <label class="block text-xs font-bold uppercase tracking-wider text-slate-400 dark:text-slate-500">Pick-up Date</label>
                    <div class="relative flex items-center">
                        <i data-lucide="calendar" class="absolute left-4 text-slate-400 dark:text-slate-500 w-4 h-4"></i>
                        <input 
                            type="date" 
                            name="pickup_date"
                            value="{{ request('pickup_date') }}"
                            class="w-full bg-slate-50 dark:bg-slate-950 text-sm pl-11 pr-4 py-4 rounded-xl border border-slate-100 dark:border-slate-800 focus:border-indigo-500 dark:focus:border-indigo-400 transition font-medium text-slate-600 dark:text-slate-300 outline-none"
                        >
                    </div>
                </div>

                <div class="sm:col-span-6 md:col-span-3 space-y-2">
                    <label class="block text-xs font-bold uppercase tracking-wider text-slate-400 dark:text-slate-500">Drop-off Date</label>
                    <div class="relative flex items-center">
                        <i data-lucide="calendar-range" class="absolute left-4 text-slate-400 dark:text-slate-500 w-4 h-4"></i>
                        <input 
                            type="date" 
                            name="dropoff_date"
                            value="{{ request('dropoff_date') }}"
                            class="w-full bg-slate-50 dark:bg-slate-950 text-sm pl-11 pr-4 py-4 rounded-xl border border-slate-100 dark:border-slate-800 focus:border-indigo-500 dark:focus:border-indigo-400 transition font-medium text-slate-600 dark:text-slate-300 outline-none"
                        >
                    </div>
                </div>

                <div class="md:col-span-2">
                    <button type="submit" class="w-full h-[54px] bg-indigo-600 hover:bg-indigo-700 text-white font-semibold text-sm rounded-xl transition shadow-lg shadow-indigo-600/20 flex justify-center items-center gap-2 group">
                        Find Match
                        <i data-lucide="chevron-right" class="w-4 h-4 group-hover:translate-x-0.5 transition"></i>
                    </button>
                </div>
            </div>

            <div class="flex flex-wrap items-center gap-3 mt-6 pt-6 border-t border-slate-100 dark:border-slate-800/80 text-xs font-medium text-slate-500 dark:text-slate-400">
                <span class="font-bold text-slate-400 dark:text-slate-500 uppercase tracking-wider">Quick Filters:</span>
                <button type="button" class="px-3 py-1.5 bg-slate-100 dark:bg-slate-800 rounded-lg text-slate-800 dark:text-slate-200 hover:bg-indigo-50 dark:hover:bg-indigo-950/40 transition">Convertibles</button>
                <button type="button" class="px-3 py-1.5 bg-slate-100 dark:bg-slate-800 rounded-lg text-slate-800 dark:text-slate-200 hover:bg-indigo-50 dark:hover:bg-indigo-950/40 transition">Track/Hypercars</button>
                <button type="button" class="px-3 py-1.5 bg-slate-100 dark:bg-slate-800 rounded-lg text-slate-800 dark:text-slate-200 hover:bg-indigo-50 dark:hover:bg-indigo-950/40 transition">Prestige SUVs</button>
                <button type="button" class="px-3 py-1.5 bg-slate-100 dark:bg-slate-800 rounded-lg text-slate-800 dark:text-slate-200 hover:bg-indigo-50 dark:hover:bg-indigo-950/40 transition">Electric Elite</button>
            </div>
        </form>

    </div>
</section>

<section class="max-w-7xl mx-auto px-6 py-20">
    <div class="flex flex-col sm:flex-row sm:items-end justify-between mb-12 reveal">
        <div>
            <p class="text-xs font-bold text-indigo-600 dark:text-indigo-400 uppercase tracking-widest">Just Added</p>
            <h2 class="text-4xl font-black tracking-tight mt-1">Latest Arrivals</h2>
        </div>
        <p class="text-sm font-semibold text-slate-400 mt-2 sm:mt-0 flex items-center gap-2 bg-slate-100 dark:bg-slate-900 px-3 py-1.5 rounded-xl border border-slate-200/30 dark:border-slate-800/60">
            <span class="w-2 h-2 rounded-full bg-emerald-500 inline-block animate-pulse"></span> Live Availability Matrix
        </p>
    </div>

    <div class="grid md:grid-cols-2 lg:grid-cols-3 gap-8">
    @forelse($cars->take(3) as $car)
        <div class="group bg-white dark:bg-slate-900 rounded-3xl overflow-hidden border border-slate-100 dark:border-slate-800/80 hover:border-indigo-500/30 dark:hover:border-indigo-400/30 hover:shadow-[0_20px_50px_rgba(99,102,241,0.06)] dark:hover:shadow-[0_20px_50px_rgba(0,0,0,0.3)] transition-all duration-500 flex flex-col justify-between reveal">
            
            <div>
                <div class="relative h-60 bg-slate-50 dark:bg-slate-950 overflow-hidden group/slider" id="slider-{{ $car->id }}">
                    <div class="flex h-full w-full transition-transform duration-700 cubic-bezier(0.16, 1, 0.3, 1)" id="track-{{ $car->id }}">
                        @if(!empty($car->images) && is_array($car->images))
                            @foreach($car->images as $img)
                                <div class="w-full h-full flex-shrink-0">
                                   <img src="/storage/{{ $img }}" class="w-full h-full object-cover transform scale-100 group-hover:scale-[1.04] transition-transform duration-700 ease-out">
                                </div>
                            @endforeach
                        @else
                            <div class="w-full h-full flex flex-col items-center justify-center bg-slate-50 dark:bg-slate-950 text-slate-400 gap-2">
                                <i data-lucide="image-off" class="w-6 h-6 stroke-[1.5]"></i>
                                <span class="text-[11px] font-bold tracking-wide uppercase">No Images Configured</span>
                            </div>
                        @endif
                    </div>

                    @if(!empty($car->images) && count($car->images) > 1)
                        <button type="button" onclick="moveSlider('{{ $car->id }}', -1)" class="absolute left-4 top-1/2 -translate-y-1/2 w-8 h-8 rounded-full bg-white/90 dark:bg-slate-900/90 backdrop-blur shadow-sm flex items-center justify-center text-slate-800 dark:text-white opacity-0 group-hover/slider:opacity-100 transition-opacity duration-300 z-20 hover:bg-indigo-600 hover:text-white dark:hover:bg-indigo-500">
                            <i data-lucide="chevron-left" class="w-4 h-4"></i>
                        </button>
                        <button type="button" onclick="moveSlider('{{ $car->id }}', 1)" class="absolute right-4 top-1/2 -translate-y-1/2 w-8 h-8 rounded-full bg-white/90 dark:bg-slate-900/90 backdrop-blur shadow-sm flex items-center justify-center text-slate-800 dark:text-white opacity-0 group-hover/slider:opacity-100 transition-opacity duration-300 z-20 hover:bg-indigo-600 hover:text-white dark:hover:bg-indigo-500">
                            <i data-lucide="chevron-right" class="w-4 h-4"></i>
                        </button>

                        <div class="absolute bottom-4 left-1/2 -translate-x-1/2 flex gap-1.5 z-20 bg-slate-950/40 px-2.5 py-1.5 rounded-full backdrop-blur-md">
                            @foreach($car->images as $index => $img)
                                <span id="dot-{{ $car->id }}-{{ $index }}" class="w-1.5 h-1.5 rounded-full transition-all duration-300 {{ $index === 0 ? 'bg-white scale-125' : 'bg-white/40' }}"></span>
                            @endforeach
                        </div>
                    @endif

                    <div class="absolute top-4 left-4 right-4 flex items-center justify-between z-30 pointer-events-none">
                        <div class="bg-white/95 dark:bg-slate-900/95 backdrop-blur shadow-sm px-3 py-1 rounded-xl text-[10px] font-extrabold tracking-wider uppercase pointer-events-auto">
                            <span class="flex items-center gap-1.5 {{ ($car->status ?? 'available') === 'available' ? 'text-emerald-600 dark:text-emerald-400' : 'text-rose-600 dark:text-rose-400' }}">
                                <span class="w-1.5 h-1.5 rounded-full {{ ($car->status ?? 'available') === 'available' ? 'bg-emerald-500 animate-ping' : 'bg-rose-500' }}"></span>
                                {{ $car->status ?? 'available' }}
                            </span>
                        </div>
                        <div class="bg-slate-900/90 dark:bg-white/95 backdrop-blur px-2.5 py-1 rounded-xl text-[10px] font-black text-white dark:text-slate-900 tracking-wider">
                            {{ $car->year }}
                        </div>
                    </div>
                </div>

                <div class="p-6 space-y-5">
                    <div class="flex justify-between items-start gap-4">
                        <div class="space-y-1 max-w-[65%]">
                            <h3 class="font-bold text-xl text-slate-900 dark:text-white tracking-tight truncate" title="{{ $car->name }}">{{ $car->name }}</h3>
                            <p class="text-xs text-slate-400 font-semibold uppercase tracking-wider truncate">{{ $car->model }}</p>
                        </div>
                        <div class="text-right flex-shrink-0">
                            <span class="text-xl font-black text-indigo-600 dark:text-indigo-400 tracking-tight">LKR {{ number_format($car->rent) }}</span>
                            <span class="text-[10px] text-slate-400 dark:text-slate-500 block font-bold uppercase tracking-wider mt-0.5">/ day rate</span>
                        </div>
                    </div>

                    @if($car->pickup_address)
                    <div class="flex items-center gap-2 text-xs font-semibold text-slate-500 dark:text-slate-400 bg-slate-50 dark:bg-slate-950/40 px-3 py-2.5 rounded-xl border border-slate-100 dark:border-slate-800/40">
                        <i data-lucide="map-pin" class="w-4 h-4 text-indigo-500 flex-shrink-0"></i>
                        <span class="truncate">Location: {{ $car->pickup_address }}</span>
                    </div>
                    @endif
                </div>
            </div>

            <div class="p-6 pt-0">
                @if(($car->status ?? 'available') === 'available')
                    @auth
                        <a href="{{ route('bookings.create', $car->id) }}" class="flex items-center justify-center gap-2 w-full bg-slate-900 hover:bg-indigo-600 dark:bg-slate-800 dark:hover:bg-indigo-600 text-white font-bold py-3.5 rounded-xl text-xs tracking-widest uppercase transition duration-300 shadow-sm">
                            Book Now <i data-lucide="arrow-right" class="w-3.5 h-3.5"></i>
                        </a>
                    @else
                        <a href="{{ route('login') }}" class="flex items-center justify-center gap-2 w-full bg-slate-900 hover:bg-indigo-600 dark:bg-slate-800 dark:hover:bg-indigo-600 text-white font-bold py-3.5 rounded-xl text-xs tracking-widest uppercase transition duration-300 shadow-sm">
                            Book Now <i data-lucide="arrow-right" class="w-3.5 h-3.5"></i>
                        </a>
                    @endauth
                @else
                    <button disabled class="flex items-center justify-center gap-2 w-full bg-slate-100 dark:bg-slate-800 text-slate-400 dark:text-slate-500 font-bold py-3.5 rounded-xl text-xs tracking-widest uppercase cursor-not-allowed border border-slate-200/20">
                        <i data-lucide="lock" class="w-3.5 h-3.5"></i> Allocation Hold
                    </button>
                @endif
            </div>
        </div>
    @empty
        <div class="col-span-full text-center py-16 bg-white dark:bg-slate-900 rounded-3xl border border-slate-100 dark:border-slate-800">
            <div class="w-12 h-12 rounded-full bg-slate-50 dark:bg-slate-950 flex items-center justify-center mx-auto mb-3 text-slate-400">
                <i data-lucide="refresh-cw" class="w-5 h-5 animate-spin"></i>
            </div>
            <h3 class="text-sm font-bold text-slate-400 uppercase tracking-wider">Inventory Matrix Syncing...</h3>
        </div>
    @endforelse
    </div>
</section>

<section id="process" class="max-w-7xl mx-auto px-6 py-24 border-t border-slate-100 dark:border-slate-800/50">
    <div class="text-center max-w-2xl mx-auto space-y-3 mb-16 reveal">
        <p class="text-xs font-bold text-indigo-600 dark:text-indigo-400 uppercase tracking-widest">How It Works</p>
        <h2 class="text-4xl font-bold tracking-tight">Our Seamless Rental Process</h2>
        <p class="text-sm text-slate-500 dark:text-slate-400">Go from browsing to driving in three fully transparent steps managed entirely inside your account dashboard.</p>
    </div>
    
    <div class="grid md:grid-cols-3 gap-10 relative">
        <div class="glass p-10 rounded-3xl text-center reveal relative hover:scale-105 transition duration-300">
            <div class="absolute -top-5 left-1/2 -translate-x-1/2 w-10 h-10 rounded-full bg-indigo-600 text-white text-xs font-extrabold flex items-center justify-center shadow-lg border-4 border-white dark:border-slate-900">
                1
            </div>
            <div class="w-14 h-14 rounded-2xl bg-indigo-50 dark:bg-indigo-950/60 text-indigo-600 dark:text-indigo-400 flex items-center justify-center mx-auto mb-6 mt-2">
                <i data-lucide="sliders" class="w-6 h-6"></i>
            </div>
            <h3 class="text-xl font-bold text-slate-900 dark:text-white">Filter & Select</h3>
            <p class="text-slate-500 dark:text-slate-400 mt-2 text-sm leading-relaxed">
                Input your preferred pickup point and driving dates above to screen live availability parameters across our premium garage network.
            </p>
        </div>

        <div class="glass p-10 rounded-3xl text-center reveal relative hover:scale-105 transition duration-300">
            <div class="absolute -top-5 left-1/2 -translate-x-1/2 w-10 h-10 rounded-full bg-indigo-600 text-white text-xs font-extrabold flex items-center justify-center shadow-lg border-4 border-white dark:border-slate-900">
                2
            </div>
            <div class="w-14 h-14 rounded-2xl bg-indigo-50 dark:bg-indigo-950/60 text-indigo-600 dark:text-indigo-400 flex items-center justify-center mx-auto mb-6 mt-2">
                <i data-lucide="calendar-check" class="w-6 h-6"></i>
            </div>
            <h3 class="text-xl font-bold text-slate-900 dark:text-white">Instant Request</h3>
            <p class="text-slate-500 dark:text-slate-400 mt-2 text-sm leading-relaxed">
                Confirm your booking form details instantly. The system calculates pricing structures and places a pending hold on your vehicle allocation.
            </p>
        </div>

        <div class="glass p-10 rounded-3xl text-center reveal relative hover:scale-105 transition duration-300">
            <div class="absolute -top-5 left-1/2 -translate-x-1/2 w-10 h-10 rounded-full bg-indigo-600 text-white text-xs font-extrabold flex items-center justify-center shadow-lg border-4 border-white dark:border-slate-900">
                3
            </div>
            <div class="w-14 h-14 rounded-2xl bg-indigo-50 dark:bg-indigo-950/60 text-indigo-600 dark:text-indigo-400 flex items-center justify-center mx-auto mb-6 mt-2">
                <i data-lucide="key-round" class="w-6 h-6"></i>
            </div>
            <h3 class="text-xl font-bold text-slate-900 dark:text-white">Admin Approval</h3>
            <p class="text-slate-500 dark:text-slate-400 mt-2 text-sm leading-relaxed">
                Our operations matrix updates your status terminal to approved. Arrive at the yard or await delivery to assume custody of the keys.
            </p>
        </div>
    </div>
</section>

<section class="max-w-6xl mx-auto px-6 py-16">
<div class="grid md:grid-cols-4 gap-8 text-center">
@foreach(['Luxury Cars','Happy Customers','Support','Secure Booking'] as $stat)
<div class="glass p-8 rounded-3xl">
<h3 class="text-4xl font-extrabold text-indigo-600 dark:text-indigo-400">500+</h3>
<p class="text-slate-400 text-xs font-semibold uppercase tracking-widest mt-1">{{ $stat }}</p>
</div>
@endforeach
</div>
</section>

<section id="pricing-guarantee" class="max-w-7xl mx-auto px-6 py-24 border-t border-slate-100 dark:border-slate-800/50">
    <div class="text-center max-w-2xl mx-auto space-y-3 mb-16 reveal">
        <p class="text-xs font-bold text-indigo-600 dark:text-indigo-400 uppercase tracking-widest">Pricing Integrity</p>
        <h2 class="text-4xl font-bold tracking-tight">Transparent Pricing Policy</h2>
        <p class="text-sm text-slate-500 dark:text-slate-400">We believe in absolute clarity. What you see is exactly what you pay, with zero surprises at the pickup terminal.</p>
    </div>
    
    <div class="grid md:grid-cols-2 gap-10">
        <div class="bg-white dark:bg-slate-900/60 p-10 rounded-3xl border border-slate-100 dark:border-slate-800/80 flex gap-6 items-start reveal hover:shadow-lg transition duration-300">
            <div class="w-12 h-12 rounded-xl bg-emerald-50 dark:bg-emerald-950/40 text-emerald-600 dark:text-emerald-400 flex items-center justify-center flex-shrink-0">
                <i data-lucide="shield-check" class="w-6 h-6"></i>
            </div>
            <div class="space-y-2 text-left">
                <h3 class="text-xl font-bold text-slate-900 dark:text-white">Absolute Zero Hidden Fees</h3>
                <p class="text-xs text-slate-500 dark:text-slate-400 leading-relaxed">
                    We maintain a strict honest-pricing mandate. There are no sudden platform service inflation metrics, hidden processing margins, or unannounced handoff surcharges waiting for you when you arrive to receive the keys.
                </p>
            </div>
        </div>

        <div class="bg-white dark:bg-slate-900/60 p-10 rounded-3xl border border-slate-100 dark:border-slate-800/80 flex gap-6 items-start reveal hover:shadow-lg transition duration-300">
            <div class="w-12 h-12 rounded-xl bg-indigo-50 dark:bg-indigo-950/40 text-indigo-600 dark:text-indigo-400 flex items-center justify-center flex-shrink-0">
                <i data-lucide="receipt" class="w-6 h-6"></i>
            </div>
            <div class="space-y-2 text-left">
                <h3 class="text-xl font-bold text-slate-900 dark:text-white">Clearly Indicated Line Items</h3>
                <p class="text-xs text-slate-500 dark:text-slate-400 leading-relaxed">
                    If your selected configuration requires variable parameters—such as mandatory security deposit holds, excess mileage limits, or owner-specified refueling guidelines—every single charge item will be explicitly listed itemized directly on the booking checkout terminal screen.
                </p>
            </div>
        </div>
    </div>
</section>

<section class="max-w-5xl mx-auto px-6 pb-32">
<div class="bg-slate-900 dark:bg-slate-900/60 rounded-[2.5rem] p-16 text-center reveal border border-slate-800 relative overflow-hidden shadow-xl">
<div class="relative z-10 space-y-4 max-w-xl mx-auto">
<h2 class="text-4xl font-bold text-white tracking-tight">Ready To Drive Luxury?</h2>
<p class="text-sm text-slate-400 leading-relaxed">Verification maps directly via biometric driver validation parameters. Finalize your credentials to choose your pick-up window details instantly.</p>
<div class="pt-4">
    @guest
        <a href="/register" class="inline-flex items-center gap-2 bg-indigo-600 hover:bg-indigo-700 text-white font-semibold text-xs tracking-wider uppercase px-8 py-3.5 rounded-xl transition shadow-md shadow-indigo-600/10"><i data-lucide="rocket" class="w-4 h-4"></i> Get Started </a>
    @else
        <a href="{{ route('cars.index') }}" class="inline-flex items-center gap-2 bg-indigo-600 hover:bg-indigo-700 text-white font-semibold text-xs tracking-wider uppercase px-8 py-3.5 rounded-xl transition shadow-md shadow-indigo-600/10"><i data-lucide="car" class="w-4 h-4"></i> View Fleet Dashboard </a>
    @endguest
</div>
</div>
</div>
</section>

<footer class="bg-white dark:bg-[#080b12] border-t border-slate-100 dark:border-slate-900 text-xs text-slate-400 py-10 transition-colors">
<div class="max-w-7xl mx-auto px-6 flex flex-col md:flex-row justify-between items-center gap-6">
    <div class="flex items-center gap-2 font-bold text-slate-800 dark:text-white">
        <div class="w-6 h-6 rounded-md bg-indigo-600 flex items-center justify-center text-white text-[10px]">LG</div>
        <span>LUXIRA GARAGE</span>
    </div>
    <div class="flex flex-wrap justify-center gap-6 font-medium">
        <a href="#" class="hover:text-indigo-500 transition">Rental Parameters</a>
        <a href="#" class="hover:text-indigo-500 transition">Liability Insurance Policy</a>
        <a href="#" class="hover:text-indigo-500 transition">Corporate Accounts</a>
    </div>
    <div>© {{ date('Y') }} Luxira Garage Network Inc. All Rights Reserved.</div>
</div>
</footer>

<script>
/* THEME MANAGEMENT */
function toggleTheme(){
document.documentElement.classList.toggle('dark');
localStorage.theme = document.documentElement.classList.contains('dark') ? 'dark':'light';
}
if(localStorage.theme==='dark'){
document.documentElement.classList.add('dark');
}

/* RENDERING ICONS */
lucide.createIcons();

/* VISIBILITY SCROLL REVEAL ENGINE */
const reveals=document.querySelectorAll('.reveal');
window.addEventListener('scroll',()=>{
reveals.forEach(el=>{
const top=el.getBoundingClientRect().top;
if(top<window.innerHeight-80){
el.classList.add('show');
}
});
});

document.addEventListener('DOMContentLoaded', () => {
    reveals.forEach(el => {
        const top = el.getBoundingClientRect().top;
        if(top < window.innerHeight) el.classList.add('show');
    });
});

/* MULTI-IMAGE CAROUSEL TRACKER */
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
        dot.classList.remove('bg-white/50');
        dot.classList.add('bg-white', 'scale-125');
    } else {
        dot.classList.remove('bg-white', 'scale-125');
        dot.classList.add('bg-white/50');
    }
}
</script>
</body>
</html>