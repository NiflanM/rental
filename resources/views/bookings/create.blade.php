<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="UTF-8">
<meta name="viewport" content="width=device-width, initial-scale=1.0">

<title>Vehicle Booking</title>

<script src="https://cdn.tailwindcss.com"></script>

<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">

<link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&family=Plus+Jakarta+Sans:wght@600;700&display=swap" rel="stylesheet">

<style>
body{
font-family:'Inter',sans-serif;
background:#f8fafc;
}

.title{
font-family:'Plus Jakarta Sans',sans-serif;
}

.glass{
background:white;
border-radius:24px;
box-shadow:0 20px 45px rgba(0,0,0,.06);
}

.input{
width:100%;
padding:14px 16px;
border-radius:12px;
background:#f9fafb;
border:1px solid #e5e7eb;
transition:.25s;
}

.input:focus{
outline:none;
border-color:#6366f1;
box-shadow:0 0 0 3px rgba(99,102,241,.15);
}

.fade{
animation:fade .4s ease;
}

@keyframes fade{
from{
opacity:0;
transform:translateY(10px)
}
to{
opacity:1;
transform:translateY(0)
}
}
</style>

</head>

<body class="min-h-screen">

<div class="max-w-7xl mx-auto px-6 py-14">

<h1 class="title text-4xl font-bold mb-12">
Complete Your Booking
</h1>

<div class="grid lg:grid-cols-12 gap-10">

<!-- ================= CAR SUMMARY ================= -->
<div class="lg:col-span-5">

<div class="glass overflow-hidden sticky top-10 fade">

<img
src="{{ asset('storage/'.$car->image) }}"
class="w-full h-[320px] object-cover">

<div class="p-6 space-y-3">

<h2 class="title text-2xl font-bold">
{{ $car->name }}
</h2>

<p class="text-gray-500">
{{ $car->model }} • {{ $car->year }}
</p>

<div class="flex justify-between items-center mt-4">

<div>
<p class="text-xs text-gray-400 uppercase tracking-wider">
Daily Rent
</p>

<p class="text-2xl font-bold text-indigo-600">
LKR {{ number_format($car->rent) }}
</p>
</div>

<span class="bg-green-100 text-green-600 text-xs px-3 py-1 rounded-full">
Available
</span>

</div>

</div>

</div>

</div>

<!-- ================= BOOKING FORM ================= -->
<div class="lg:col-span-7">

<div class="glass p-10 fade">

<!-- ERROR MESSAGE -->
@if ($errors->any())
<div class="mb-6 bg-red-100 border border-red-300 text-red-700 px-4 py-3 rounded-xl">
<ul class="list-disc pl-5">
@foreach ($errors->all() as $error)
<li>{{ $error }}</li>
@endforeach
</ul>
</div>
@endif

<form action="{{ route('bookings.store') }}" method="POST" class="space-y-8">

@csrf

<input type="hidden" name="car_id" value="{{ $car->id }}">

<!-- CUSTOMER -->
<div>

<h2 class="title text-xl font-semibold mb-5">
Customer Information
</h2>

<div class="grid md:grid-cols-2 gap-5">

<input
name="customer_name"
placeholder="Full Name"
class="input"
required
value="{{ old('customer_name') }}">

<input
name="phone"
placeholder="Phone Number"
class="input"
required
value="{{ old('phone') }}">

<input
name="email"
type="email"
placeholder="Email Address"
class="input md:col-span-2"
required
value="{{ old('email') }}">

</div>

</div>

<!-- DATES -->
<div>

<h2 class="title text-xl font-semibold mb-5">
Booking Dates
</h2>

<div class="grid md:grid-cols-2 gap-5">

<div>

<label class="text-sm text-gray-500">
Pick-up Date
</label>

<input
type="text"
id="start"
name="start_date"
class="input mt-1"
required
autocomplete="off"
value="{{ old('start_date') }}">

</div>

<div>

<label class="text-sm text-gray-500">
Return Date
</label>

<input
type="text"
id="end"
name="end_date"
class="input mt-1"
required
autocomplete="off"
value="{{ old('end_date') }}">

</div>

</div>

</div>

<!-- BOOKING SUMMARY -->
<div class="bg-gray-50 border rounded-2xl p-6 space-y-4">

<h3 class="title font-semibold text-lg">
Booking Summary
</h3>

<div class="flex justify-between text-sm text-gray-600">
<span>Daily Price</span>
<span>LKR {{ number_format($car->rent) }}</span>
</div>

<div class="flex justify-between text-sm text-gray-600">
<span>Total Days</span>
<span id="days">0</span>
</div>

<hr>

<div class="flex justify-between text-xl font-bold text-indigo-600">
<span>Total Amount</span>
<span>LKR <span id="total">0</span></span>
</div>

</div>

<!-- NOTES -->
<div>

<label class="text-sm text-gray-500">
Additional Notes
</label>

<textarea
name="notes"
rows="4"
placeholder="Special requests, delivery location, etc..."
class="input mt-1">{{ old('notes') }}</textarea>

</div>

<!-- BUTTON -->
<button
type="submit"
class="w-full py-4 rounded-xl
bg-gradient-to-r from-indigo-600 to-purple-600
hover:from-indigo-700 hover:to-purple-700
text-white font-semibold text-lg
shadow-lg transition duration-300">

Confirm Booking

</button>

</form>

</div>

</div>

</div>

</div>

<!-- FLATPICKR -->
<script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>

<script>

const rent = {{ $car->rent }};

const bookedRanges = @json($bookedDates);

const total = document.getElementById('total');
const daysText = document.getElementById('days');

const disabledDates = [];

// CONVERT BOOKED RANGES INTO INDIVIDUAL DISABLED DATES
bookedRanges.forEach(range => {

    let current = new Date(range.start_date);
    let end = new Date(range.end_date);

    while(current <= end){

        disabledDates.push(
            current.toISOString().split('T')[0]
        );

        current.setDate(current.getDate() + 1);
    }
});

// START DATE PICKER
flatpickr("#start", {

    minDate: "today",

    disable: disabledDates,

    dateFormat: "Y-m-d",

    onChange: calculate
});

// END DATE PICKER
flatpickr("#end", {

    minDate: "today",

    disable: disabledDates,

    dateFormat: "Y-m-d",

    onChange: calculate
});

// CALCULATE TOTAL
function calculate(){

    const start = document.getElementById('start').value;
    const end = document.getElementById('end').value;

    if(start && end){

        const s = new Date(start);
        const e = new Date(end);

        const diff = Math.ceil((e - s)/(1000*60*60*24)) + 1;

        if(diff > 0){

            daysText.innerText = diff;

            total.innerText =
                (diff * rent).toLocaleString();
        }
    }
}

</script>

</body>
</html>