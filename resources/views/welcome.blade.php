<!DOCTYPE html>

<html lang="en" class="transition duration-500 scroll-smooth">
<head>

<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1">

<title>Luxury Garage</title>

<script src="https://cdn.tailwindcss.com"></script>

<script src="https://unpkg.com/lucide@latest"></script>

<link href="https://fonts.googleapis.com/css2?family=Syne:wght@700;800&family=Inter:wght@400;500;600&display=swap" rel="stylesheet">

<style>

/* ---------- GLOBAL ---------- */

body{
font-family:'Inter',sans-serif;
background:#f8fafc;
overflow-x:hidden;
}

.dark body{
background:#020617;
color:white;
}

h1,h2,h3{font-family:'Syne',sans-serif}

/* ---------- ANIMATED BACKGROUND ---------- */

.bg-animate{
position:fixed;
inset:0;
z-index:-1;
background:
radial-gradient(circle at 20% 20%, rgba(99,102,241,.25),transparent 40%),
radial-gradient(circle at 80% 80%, rgba(236,72,153,.2),transparent 40%);
animation:moveBg 20s linear infinite;
}

@keyframes moveBg{
0%{transform:translateY(0)}
50%{transform:translateY(-60px)}
100%{transform:translateY(0)}
}

/* ---------- GLASS ---------- */

.glass{
background:rgba(255,255,255,.7);
backdrop-filter:blur(18px);
border:1px solid rgba(255,255,255,.5);
}

.dark .glass{
background:rgba(15,23,42,.8);
border:1px solid rgba(255,255,255,.08);
}

/* ---------- FLOATING ---------- */

.float{
animation:float 6s ease-in-out infinite;
}
@keyframes float{
0%,100%{transform:translateY(0)}
50%{transform:translateY(-18px)}
}

/* ---------- SCROLL REVEAL ---------- */

.reveal{
opacity:0;
transform:translateY(40px);
transition:.8s ease;
}

.reveal.show{
opacity:1;
transform:none;
}

</style>

</head>

<body class="text-gray-900 dark:text-gray-100 transition">

<div class="bg-animate"></div>

<!-- NAVBAR -->

<header class="glass sticky top-0 z-50">
<div class="max-w-7xl mx-auto px-6 py-4 flex justify-between items-center">

<h1 class="flex items-center gap-2 text-indigo-600 dark:text-indigo-400 text-2xl font-bold">
<i data-lucide="car"></i> Luxury Garage
</h1>

<div class="flex gap-8 items-center font-medium">

<a href="/cars" class="hover:text-indigo-500">Cars</a> <a href="/bookings" class="hover:text-indigo-500">Bookings</a>

<button onclick="toggleTheme()" class="p-2 rounded-xl bg-gray-200 dark:bg-slate-800">
<i data-lucide="moon"></i>
</button>

</div>
</div>
</header>

<!-- HERO -->

<section class="max-w-7xl mx-auto px-6 py-32 grid md:grid-cols-2 gap-12 items-center">

<div class="reveal">

<h1 class="text-6xl font-extrabold leading-tight">
Experience
<span class="text-indigo-600 dark:text-indigo-400">
Luxury Driving
</span>
</h1>

<p class="mt-6 text-lg text-gray-600 dark:text-gray-300">
Premium vehicles. Instant booking. Elite driving experience.
Luxury Garage connects you with world-class cars anytime.
</p>

<div class="mt-10 flex gap-5">

<a href="/cars"
class="bg-indigo-600 hover:bg-indigo-700 text-white px-8 py-4 rounded-2xl flex gap-2 items-center shadow-xl"> <i data-lucide="search"></i> Explore Fleet </a>

<a href="/register"
class="glass px-8 py-4 rounded-2xl">
Create Account </a>

</div>

</div>

<div class="float reveal">
<img src="https://images.unsplash.com/photo-1503376780353-7e6692767b70"
class="rounded-3xl shadow-2xl">
</div>

</section>

<!-- FEATURES -->

<section class="max-w-7xl mx-auto px-6 py-24">

<h2 class="text-4xl font-bold text-center mb-16 reveal">
Why Choose Luxury Garage
</h2>

<div class="grid md:grid-cols-3 gap-10">

@foreach([
['shield','Secure Booking'],
['zap','Instant Approval'],
['sparkles','Premium Cars']
] as $f)

<div class="glass p-10 rounded-3xl text-center reveal hover:scale-105 transition">
<i data-lucide="{{$f[0]}}" class="mx-auto text-indigo-600 dark:text-indigo-400"></i>
<h3 class="mt-4 text-xl font-semibold">{{$f[1]}}</h3>
<p class="text-gray-600 dark:text-gray-300 mt-2">
Experience seamless luxury rentals designed for modern drivers.
</p>
</div>

@endforeach

</div>
</section>

<!-- STATS -->

<section class="max-w-6xl mx-auto px-6 py-16">
<div class="grid md:grid-cols-4 gap-8 text-center">

@foreach(['Luxury Cars','Happy Customers','Support','Secure Booking'] as $stat)

<div class="glass p-8 rounded-3xl">
<h3 class="text-3xl font-bold text-indigo-600 dark:text-indigo-400">
500+
</h3>
<p class="text-gray-600 dark:text-gray-300">
{{ $stat }}
</p>
</div>

@endforeach

</div>
</section>

<!-- PRICING PREVIEW -->

<section class="max-w-6xl mx-auto px-6 py-24">

<h2 class="text-4xl font-bold text-center mb-14 reveal">
Flexible Pricing
</h2>

<div class="grid md:grid-cols-3 gap-10">

@foreach(['Basic','Premium','Elite'] as $plan)

<div class="glass p-10 rounded-3xl text-center reveal hover:scale-105 transition">

<h3 class="text-2xl font-bold">{{$plan}}</h3>
<p class="text-4xl font-bold mt-4 text-indigo-600 dark:text-indigo-400">
$199
</p>

<ul class="mt-6 space-y-2 text-gray-600 dark:text-gray-300">
<li>Luxury Vehicles</li>
<li>Insurance Included</li>
<li>24/7 Support</li>
</ul>

<a href="/register"
class="mt-8 inline-block bg-indigo-600 text-white px-8 py-3 rounded-xl">
Start Now </a>

</div>

@endforeach

</div>
</section>

<!-- CTA -->

<section class="max-w-5xl mx-auto px-6 pb-32">
<div class="glass rounded-3xl p-16 text-center reveal">

<h2 class="text-5xl font-bold">
Ready To Drive Luxury?
</h2>

<p class="mt-6 text-gray-600 dark:text-gray-300">
Join thousands enjoying premium vehicles worldwide.
</p>

<a href="/register"
class="mt-10 inline-flex items-center gap-2 bg-indigo-600 hover:bg-indigo-700 text-white px-12 py-4 rounded-2xl shadow-xl"> <i data-lucide="rocket"></i> Get Started </a>

</div>
</section>

<!-- FOOTER -->

<footer class="glass text-center py-10 text-gray-600 dark:text-gray-400">
© {{ date('Y') }} Luxury Garage
</footer>

<script>

/* THEME */
function toggleTheme(){
document.documentElement.classList.toggle('dark');
localStorage.theme =
document.documentElement.classList.contains('dark') ? 'dark':'light';
}
if(localStorage.theme==='dark'){
document.documentElement.classList.add('dark');
}

/* ICONS */
lucide.createIcons();

/* SCROLL ANIMATION */
const reveals=document.querySelectorAll('.reveal');
window.addEventListener('scroll',()=>{
reveals.forEach(el=>{
const top=el.getBoundingClientRect().top;
if(top<window.innerHeight-80){
el.classList.add('show');
}
});
});

</script>

</body>
</html>
