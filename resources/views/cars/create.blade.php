<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>Add Vehicle</title>

<script src="https://cdn.tailwindcss.com"></script>

<link href="https://fonts.googleapis.com/css2?family=Syne:wght@400;600;700;800&family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">

<style>

body{
    font-family:'Inter',sans-serif;
    background:
        radial-gradient(circle at top left, rgba(99,102,241,0.12), transparent 22%),
        radial-gradient(circle at bottom right, rgba(236,72,153,0.10), transparent 22%),
        linear-gradient(to bottom right,#f8fafc,#ffffff,#eef2ff);
}

h1,h2,h3{
    font-family:'Syne',sans-serif;
}

.glow{
    position:absolute;
    width:400px;
    height:400px;
    border-radius:9999px;
    filter:blur(100px);
    opacity:.18;
    animation:float 8s ease-in-out infinite;
}

.glow1{background:#818cf8;top:-100px;left:-100px;}
.glow2{background:#f472b6;right:-100px;bottom:-100px;animation-delay:2s;}

@keyframes float{
0%,100%{transform:translateY(0);}
50%{transform:translateY(-20px);}
}

.glass{
    background:rgba(255,255,255,0.7);
    backdrop-filter:blur(20px);
    border:1px solid rgba(255,255,255,.5);
    box-shadow:0 10px 40px rgba(15,23,42,.08);
}

.input{
    width:100%;
    border:none;
    background:rgba(255,255,255,.65);
    padding:16px 18px;
    border-radius:18px;
    outline:none;
    transition:.3s;
}

.input:focus{
    transform:translateY(-2px);
    box-shadow:0 0 0 4px rgba(99,102,241,.12);
}

.btn{transition:.3s;}
.btn:hover{transform:translateY(-3px);}

</style>
</head>

<body class="min-h-screen relative text-gray-800">

<div class="glow glow1"></div>
<div class="glow glow2"></div>

<div class="relative z-10 max-w-7xl mx-auto px-6 py-14">

<!-- HEADER -->
<div class="flex flex-col lg:flex-row justify-between items-start lg:items-center gap-6 mb-12">

<div>
<p class="uppercase tracking-[0.35em] text-indigo-500 text-sm font-semibold mb-3">
Vehicle Management
</p>

<h1 class="text-5xl font-extrabold text-gray-900">
Add Vehicle
</h1>

<p class="text-gray-500 text-lg mt-3">
Create a premium vehicle listing
</p>
</div>

<a href="{{ route('cars.index') }}"
class="btn px-7 py-3 rounded-2xl bg-white text-gray-700 font-semibold shadow-lg hover:shadow-xl">
← Back to Inventory
</a>

</div>

@if ($errors->any())
<div class="mb-8 bg-red-50 border border-red-200 text-red-600 rounded-3xl p-6 shadow-lg">
<ul class="list-disc ml-6">
@foreach ($errors->all() as $error)
<li>{{ $error }}</li>
@endforeach
</ul>
</div>
@endif

<div class="grid lg:grid-cols-12 gap-10">

<!-- LEFT PREVIEW -->
<div class="lg:col-span-5">

<div class="glass rounded-[2.5rem] p-6 sticky top-10">

<div class="relative overflow-hidden rounded-[2rem]">

<img id="previewImg"
src="https://images.unsplash.com/photo-1492144534655-ae79c964c9d7"
class="w-full h-[420px] object-cover">

<div class="absolute inset-0 bg-gradient-to-t from-black/40 to-transparent"></div>

<div class="absolute bottom-5 left-5 bg-white/80 backdrop-blur-xl px-5 py-3 rounded-2xl shadow-xl">

<p class="text-xs text-gray-500 uppercase tracking-widest">
Daily Rent
</p>

<h2 class="text-3xl font-bold text-gray-900">
LKR <span id="pRent">0</span>
</h2>

</div>

</div>

<div class="mt-8">

<h2 class="text-4xl font-bold" id="pName">
Car Name
</h2>

<p class="text-gray-500 text-lg mt-2" id="pModel">
Model
</p>

<div class="grid grid-cols-2 gap-5 mt-8">

<div class="bg-white/60 rounded-2xl p-5">
<p class="text-gray-500 text-sm">Year</p>
<h3 class="text-2xl font-bold mt-2" id="pYear">----</h3>
</div>

<div class="bg-white/60 rounded-2xl p-5">
<p class="text-gray-500 text-sm">Status</p>
<h3 class="text-2xl font-bold text-green-500 mt-2">
New
</h3>
</div>

</div>

</div>

</div>
</div>

<!-- FORM -->
<div class="lg:col-span-7">

<div class="glass rounded-[2.5rem] p-8 lg:p-10">

<form action="{{ route('cars.store') }}"
method="POST"
enctype="multipart/form-data"
class="space-y-8">

@csrf

<input type="text"
name="name"
placeholder="Car Name"
class="input"
oninput="pName.innerText=this.value||'Car Name'">

<div class="grid md:grid-cols-2 gap-6">

<input type="text"
name="model"
placeholder="Model"
class="input"
oninput="pModel.innerText=this.value||'Model'">

<input type="number"
name="year"
placeholder="Year"
class="input"
oninput="pYear.innerText=this.value||'----'">

</div>

<input type="text"
name="rent"
placeholder="Rent Per Day"
class="input"
oninput="pRent.innerText=this.value||'0'">

<textarea name="description"
rows="5"
class="input"
placeholder="Description"></textarea>

<input type="file"
name="image"
accept="image/*"
class="input"
onchange="previewImage(event)">

<div class="flex gap-4 pt-4">

<a href="{{ route('cars.index') }}"
class="btn flex-1 text-center bg-gray-200 py-4 rounded-2xl hover:bg-gray-300">
Cancel
</a>

<button type="submit"
class="btn flex-1 bg-gradient-to-r from-indigo-500 to-pink-500 text-white py-4 rounded-2xl shadow-xl">
Save Vehicle
</button>

</div>

</form>

</div>
</div>

</div>
</div>

<script>

function previewImage(event){
const reader=new FileReader();
reader.onload=function(){
document.getElementById('previewImg').src=reader.result;
}
if(event.target.files[0]){
reader.readAsDataURL(event.target.files[0]);
}
}

</script>

</body>
</html>