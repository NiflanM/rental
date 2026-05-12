<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Vehicle</title>

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
            overflow-x:hidden;
        }

        h1,h2,h3{
            font-family:'Syne', sans-serif;
        }

        /* Floating Glow */
        .glow{
            position:absolute;
            width:400px;
            height:400px;
            border-radius:9999px;
            filter:blur(100px);
            opacity:.18;
            z-index:0;
            animation:float 8s ease-in-out infinite;
        }

        .glow1{
            background:#818cf8;
            top:-100px;
            left:-100px;
        }

        .glow2{
            background:#f472b6;
            right:-100px;
            bottom:-100px;
            animation-delay:2s;
        }

        @keyframes float{
            0%,100%{
                transform:translateY(0px);
            }
            50%{
                transform:translateY(-20px);
            }
        }

        /* Glassmorphism */
        .glass{
            background:rgba(255,255,255,0.70);
            backdrop-filter:blur(20px);
            border:1px solid rgba(255,255,255,0.5);
            box-shadow:0 10px 40px rgba(15,23,42,0.08);
        }

        /* Inputs */
        .input{
            width:100%;
            border:none;
            background:rgba(255,255,255,0.65);
            padding:16px 18px;
            border-radius:18px;
            outline:none;
            transition:all .3s ease;
            box-shadow:
                inset 0 1px 2px rgba(0,0,0,0.04);
        }

        .input:focus{
            transform:translateY(-2px);
            box-shadow:
                0 0 0 4px rgba(99,102,241,.12),
                0 10px 20px rgba(99,102,241,.08);
        }

        /* Buttons */
        .btn{
            transition:all .3s ease;
        }

        .btn:hover{
            transform:translateY(-3px);
        }

        /* Card hover */
        .preview-card{
            transition:all .4s ease;
        }

        .preview-card:hover{
            transform:translateY(-6px);
            box-shadow:
                0 20px 40px rgba(99,102,241,.10);
        }

    </style>

</head>

<body class="min-h-screen relative text-gray-800">

    <!-- Background -->
    <div class="glow glow1"></div>
    <div class="glow glow2"></div>

    <!-- Page -->
    <div class="relative z-10 max-w-7xl mx-auto px-6 py-14">

        <!-- Header -->
        <div class="flex flex-col lg:flex-row justify-between items-start lg:items-center gap-6 mb-12">

            <div>

                <p class="uppercase tracking-[0.35em] text-indigo-500 text-sm font-semibold mb-3">
                    Vehicle Management
                </p>

                <h1 class="text-5xl font-extrabold text-gray-900">
                    Edit Vehicle
                </h1>

                <p class="text-gray-500 text-lg mt-3">
                    Update your premium vehicle information and media
                </p>

            </div>

            <a href="{{ route('cars.index') }}"
               class="btn px-7 py-3 rounded-2xl bg-white text-gray-700 font-semibold shadow-lg hover:shadow-xl">

                ← Back to Inventory

            </a>

        </div>

        <!-- Validation -->
        @if ($errors->any())

            <div class="mb-8 bg-red-50 border border-red-200 text-red-600 rounded-3xl p-6 shadow-lg">

                <h2 class="font-bold text-lg mb-3">
                    Please fix the following issues:
                </h2>

                <ul class="list-disc ml-6 space-y-2">

                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach

                </ul>

            </div>

        @endif

        <!-- Layout -->
        <div class="grid lg:grid-cols-12 gap-10">

            <!-- LEFT PREVIEW -->
            <div class="lg:col-span-5">

                <div class="glass rounded-[2.5rem] p-6 sticky top-10 preview-card">

                    <!-- Image -->
                    <div class="relative overflow-hidden rounded-[2rem]">

                        <img src="{{ asset('storage/' . $car->image) }}"
                             class="w-full h-[420px] object-cover">

                        <!-- Overlay -->
                        <div class="absolute inset-0 bg-gradient-to-t from-black/50 via-black/10 to-transparent"></div>

                        <!-- Price -->
                        <div class="absolute bottom-5 left-5">

                            <div class="bg-white/80 backdrop-blur-xl px-5 py-3 rounded-2xl shadow-xl">

                                <p class="text-gray-500 text-xs uppercase tracking-widest">
                                    Daily Rent
                                </p>

                                <h2 class="text-3xl font-bold text-gray-900 mt-1">
                                    LKR {{ number_format($car->rent) }}
                                </h2>

                            </div>

                        </div>

                    </div>

                    <!-- Car Info -->
                    <div class="mt-8">

                        <div class="flex items-start justify-between">

                            <div>

                                <h2 class="text-4xl font-bold text-gray-900">
                                    {{ $car->name }}
                                </h2>

                                <p class="text-gray-500 text-lg mt-2">
                                    {{ $car->model }}
                                </p>

                            </div>

                            <div class="w-3 h-3 rounded-full bg-green-400 animate-pulse mt-3"></div>

                        </div>

                        <!-- Specs -->
                        <div class="grid grid-cols-2 gap-5 mt-8">

                            <div class="bg-white/60 rounded-2xl p-5">

                                <p class="text-gray-500 text-sm">
                                    Year
                                </p>

                                <h3 class="text-2xl font-bold text-gray-900 mt-2">
                                    {{ $car->year }}
                                </h3>

                            </div>

                            <div class="bg-white/60 rounded-2xl p-5">

                                <p class="text-gray-500 text-sm">
                                    Status
                                </p>

                                <h3 class="text-2xl font-bold text-green-500 mt-2">
                                    Active
                                </h3>

                            </div>

                        </div>

                    </div>

                </div>

            </div>

            <!-- RIGHT FORM -->
            <div class="lg:col-span-7">

                <div class="glass rounded-[2.5rem] p-8 lg:p-10">

                    <form action="{{ route('cars.update', $car->id) }}"
                          method="POST"
                          enctype="multipart/form-data"
                          class="space-y-8">

                        @csrf
                        @method('PUT')

                        <!-- Name -->
                        <div>

                            <label class="block text-sm font-semibold text-gray-700 mb-3">
                                Car Name
                            </label>

                            <input type="text"
                                   name="name"
                                   value="{{ $car->name }}"
                                   class="input">

                        </div>

                        <!-- Grid -->
                        <div class="grid md:grid-cols-2 gap-6">

                            <!-- Model -->
                            <div>

                                <label class="block text-sm font-semibold text-gray-700 mb-3">
                                    Model
                                </label>

                                <input type="text"
                                       name="model"
                                       value="{{ $car->model }}"
                                       class="input">

                            </div>

                            <!-- Year -->
                            <div>

                                <label class="block text-sm font-semibold text-gray-700 mb-3">
                                    Year
                                </label>

                                <input type="number"
                                       name="year"
                                       value="{{ $car->year }}"
                                       class="input">

                            </div>

                        </div>

                        <!-- Rent -->
                        <div>

                            <label class="block text-sm font-semibold text-gray-700 mb-3">
                                Rent Per Day (LKR)
                            </label>

                            <input type="text"
                                   name="rent"
                                   value="{{ $car->rent }}"
                                   class="input">

                        </div>

                        <!-- Description -->
                        <div>

                            <label class="block text-sm font-semibold text-gray-700 mb-3">
                                Description
                            </label>

                            <textarea name="description"
                                      rows="6"
                                      class="input resize-none">{{ $car->description }}</textarea>

                        </div>

                        <!-- Upload -->
                        <div>

                            <label class="block text-sm font-semibold text-gray-700 mb-4">
                                Change Vehicle Image
                            </label>

                            <div class="border-2 border-dashed border-indigo-200 rounded-[2rem] p-10 bg-white/50 text-center hover:border-indigo-400 transition">

                                <div class="text-5xl mb-4">
                                    📸
                                </div>

                                <h3 class="text-xl font-bold text-gray-800">
                                    Upload New Image
                                </h3>

                                <p class="text-gray-500 mt-2 mb-5">
                                    Drag and drop or browse from device
                                </p>

                                <input type="file"
                                       name="image"
                                       class="block w-full text-sm text-gray-600
                                       file:mr-4 file:py-3 file:px-6
                                       file:rounded-2xl file:border-0
                                       file:text-sm file:font-semibold
                                       file:bg-gradient-to-r
                                       file:from-indigo-500
                                       file:to-purple-500
                                       file:text-white
                                       hover:file:opacity-90">

                            </div>

                        </div>

                        <!-- Buttons -->
                        <div class="flex flex-col sm:flex-row gap-4 pt-4">

                            <a href="{{ route('cars.index') }}"
                               class="btn flex-1 text-center py-4 rounded-2xl bg-gray-200 text-gray-700 font-semibold hover:bg-gray-300">

                                Cancel

                            </a>

                            <button type="submit"
                                    class="btn flex-1 py-4 rounded-2xl bg-gradient-to-r from-indigo-500 to-pink-500 text-white font-semibold shadow-xl hover:shadow-2xl">

                                Update Vehicle

                            </button>

                        </div>

                    </form>

                </div>

            </div>

        </div>

    </div>

</body>
</html>