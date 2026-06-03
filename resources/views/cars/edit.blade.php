<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Vehicle</title>

    <script src="https://cdn.tailwindcss.com"></script>

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

        h1,h2,h3{ font-family:'Syne', sans-serif; }

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
        .glow1{ background:#818cf8; top:-100px; left:-100px; }
        .glow2{ background:#f472b6; right:-100px; bottom:-100px; animation-delay:2s; }

        @keyframes float{
            0%,100%{ transform:translateY(0px); }
            50%{ transform:translateY(-20px); }
        }

        .glass{
            background:rgba(255,255,255,0.70);
            backdrop-filter:blur(20px);
            border:1px solid rgba(255,255,255,0.5);
            box-shadow:0 10px 40px rgba(15,23,42,0.08);
        }

        .input{
            width:100%;
            border:none;
            background:rgba(255,255,255,0.65);
            padding:16px 18px;
            border-radius:18px;
            outline:none;
            transition:all .3s ease;
            box-shadow: inset 0 1px 2px rgba(0,0,0,0.04);
        }
        .input:focus{
            transform:translateY(-2px);
            box-shadow:
                0 0 0 4px rgba(99,102,241,.12),
                0 10px 20px rgba(99,102,241,.08);
        }

        .btn{ transition:all .3s ease; }
        .btn:hover{ transform:translateY(-3px); }

        .preview-card{ transition:all .4s ease; }
        .preview-card:hover{
            transform:translateY(-6px);
            box-shadow: 0 20px 40px rgba(99,102,241,.10);
        }
    </style>
</head>

<body class="min-h-screen relative text-gray-800">

    <div class="glow glow1"></div>
    <div class="glow glow2"></div>

    <div class="relative z-10 max-w-7xl mx-auto px-6 py-14">

        <div class="flex flex-col lg:flex-row justify-between items-start lg:items-center gap-6 mb-12">
            <div>
                <p class="uppercase tracking-[0.35em] text-indigo-500 text-sm font-semibold mb-3">Vehicle Management</p>
                <h1 class="text-5xl font-extrabold text-gray-900">Edit Vehicle</h1>
                <p class="text-gray-500 text-lg mt-3">Update your premium vehicle information and media slider pack</p>
            </div>
            <a href="{{ route('cars.index') }}" class="btn px-7 py-3 rounded-2xl bg-white text-gray-700 font-semibold shadow-lg hover:shadow-xl">← Back to Inventory</a>
        </div>

        @if ($errors->any())
            <div class="mb-8 bg-red-50 border border-red-200 text-red-600 rounded-3xl p-6 shadow-lg">
                <h2 class="font-bold text-lg mb-3">Please fix the following issues:</h2>
                <ul class="list-disc ml-6 space-y-2">
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif

        <div class="grid lg:grid-cols-12 gap-10">

            <div class="lg:col-span-5">
                <div class="glass rounded-[2.5rem] p-6 sticky top-10 preview-card">
                    <p class="text-xs font-semibold uppercase tracking-widest text-indigo-500 mb-3">Live Card Preview</p>

                    <div class="relative overflow-hidden rounded-[2rem] bg-gray-900 h-[280px]">
                        @if(!empty($car->images) && is_array($car->images))
                            <img id="previewImg" src="{{ asset('storage/' . $car->images[0]) }}" class="w-full h-full object-cover opacity-80">
                        @else
                            <img id="previewImg" src="https://images.unsplash.com/photo-1492144534655-ae79c964c9d7" class="w-full h-full object-cover opacity-80">
                        @endif
                        <div class="absolute inset-0 bg-gradient-to-t from-black/60 to-transparent"></div>

                        <div class="absolute bottom-5 left-5 bg-white/90 backdrop-blur-xl px-5 py-3 rounded-2xl shadow-xl">
                            <p class="text-gray-500 text-xs uppercase tracking-widest">Daily Rent</p>
                            <h2 class="text-2xl font-bold text-gray-900 mt-1">LKR <span id="pRent">{{ number_format($car->rent) }}</span></h2>
                        </div>
                    </div>

                    <div class="mt-4">
                        <p class="text-xs font-medium text-gray-400 uppercase tracking-wider mb-2">Active Images Slider Queue (<span id="queueCount">0</span>)</p>
                        <div id="previewGalleryGrid" class="grid grid-cols-4 gap-2 min-h-[60px] p-2 rounded-xl bg-white/40 border border-dashed border-gray-300">
                            </div>
                    </div>

                    <div class="mt-6 space-y-4">
                        <div class="flex items-start justify-between">
                            <div class="w-full">
                                <h2 class="text-3xl font-bold text-gray-900 truncate" id="pName">{{ $car->name }}</h2>
                                <p class="text-gray-500 text-md mt-1" id="pModel">{{ $car->model }}</p>
                            </div>
                            <div class="w-3 h-3 rounded-full bg-green-400 animate-pulse mt-3 flex-shrink-0"></div>
                        </div>

                        <div class="flex items-center gap-2 bg-indigo-50/60 border border-indigo-100 text-indigo-700 px-4 py-2.5 rounded-xl text-sm">
                            <span class="text-base flex-shrink-0">📍</span>
                            <span id="pAddress" class="font-medium truncate {{ !$car->pickup_address ? 'italic' : '' }}">
                                {{ $car->pickup_address ?? 'No Pickup Address Entered' }}
                            </span>
                        </div>

                        <div class="grid grid-cols-2 gap-4">
                            <div class="bg-white/60 rounded-2xl p-4">
                                <p class="text-gray-500 text-xs">Year</p>
                                <h3 class="text-xl font-bold text-gray-900 mt-1" id="pYear">{{ $car->year }}</h3>
                            </div>
                            <div class="bg-white/60 rounded-2xl p-4">
                                <p class="text-gray-500 text-xs">Status</p>
                                <h3 class="text-xl font-bold text-green-500 mt-1">Active</h3>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="lg:col-span-7">
                <div class="glass rounded-[2.5rem] p-8 lg:p-10">
                    <form id="vehicleForm" action="{{ route('cars.update', $car->id) }}" method="POST" enctype="multipart/form-data" class="space-y-8">
                        @csrf
                        @method('PUT')

                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-3">Car Name</label>
                            <input type="text" name="name" value="{{ $car->name }}" class="input" oninput="document.getElementById('pName').innerText=this.value||'Car Name'">
                        </div>

                        <div class="grid md:grid-cols-2 gap-6">
                            <div>
                                <label class="block text-sm font-semibold text-gray-700 mb-3">Model</label>
                                <input type="text" name="model" value="{{ $car->model }}" class="input" oninput="document.getElementById('pModel').innerText=this.value||'Model'">
                            </div>
                            <div>
                                <label class="block text-sm font-semibold text-gray-700 mb-3">Year</label>
                                <input type="number" name="year" value="{{ $car->year }}" class="input" oninput="document.getElementById('pYear').innerText=this.value||'----'">
                            </div>
                        </div>

                        <div class="grid md:grid-cols-2 gap-6">
                            <div>
                                <label class="block text-sm font-semibold text-gray-700 mb-3">Rent Per Day (LKR)</label>
                                <input type="text" name="rent" value="{{ $car->rent }}" class="input" oninput="document.getElementById('pRent').innerText=Number(this.value).toLocaleString()||'0'">
                            </div>
                            <div>
                                <label class="block text-sm font-semibold text-gray-700 mb-3">Vehicle Pickup Address</label>
                                <input type="text" name="pickup_address" value="{{ $car->pickup_address }}" placeholder="E.g., No 45, Colombo Rd, Galle" class="input" oninput="document.getElementById('pAddress').innerText=this.value||'No Pickup Address Entered'; if(this.value){document.getElementById('pAddress').classList.remove('italic')}else{document.getElementById('pAddress').classList.add('italic')}">
                            </div>
                        </div>

                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-3">Description</label>
                            <textarea name="description" rows="5" class="input resize-none">{{ $car->description }}</textarea>
                        </div>

                        <div>
                            <label class="block text-sm font-semibold text-gray-700 mb-3">Reconfigure Image Slider Pack (Add One by One)</label>
                            <div class="relative bg-white/50 border-2 border-dashed border-indigo-200 hover:border-indigo-400 transition rounded-2xl p-6 text-center">
                                <input type="file" id="imageInputSelector" accept="image/*" class="absolute inset-0 opacity-0 cursor-pointer w-full h-full" onchange="handleSingleFileAddition(event)">
                                <div class="space-y-1 pointer-events-none">
                                    <span class="text-3xl block">➕</span>
                                    <p class="text-indigo-600 font-medium text-sm">Click here to attach a new photo</p>
                                    <p class="text-gray-400 text-xs font-normal">Re-adding items overrides old photos securely upon submission</p>
                                </div>
                            </div>
                        </div>

                        <input type="file" name="images[]" id="hiddenFormFilesField" class="hidden" multiple>

                        <div class="flex flex-col sm:flex-row gap-4 pt-4">
                            <a href="{{ route('cars.index') }}" class="btn flex-1 text-center py-4 rounded-2xl bg-gray-200 text-gray-700 font-semibold hover:bg-gray-300">Cancel</a>
                            <button type="submit" class="btn flex-1 py-4 rounded-2xl bg-gradient-to-r from-indigo-500 to-pink-500 text-white font-semibold shadow-xl hover:shadow-2xl">Update Vehicle</button>
                        </div>
                    </form>
                </div>
            </div>

        </div>
    </div>

<script>
    let imageStorageArray = [];

    window.addEventListener('DOMContentLoaded', () => {
        @if(!empty($car->images) && is_array($car->images))
            @foreach($car->images as $path)
                imageStorageArray.push({
                    isExisting: true,
                    pathUrl: "{{ asset('storage/' . $path) }}",
                    rawPathValue: "{{ $path }}"
                });
            @endforeach
        @endif
        renderQueuePreviews();
    });

    function handleSingleFileAddition(event) {
        const file = event.target.files[0];
        if (!file) return;

        imageStorageArray.push({
            isExisting: false,
            fileInstance: file
        });
        
        synchronizeFormFileInput();
        renderQueuePreviews();
        event.target.value = '';
    }

    function removeFileFromQueue(indexToRemove) {
        imageStorageArray.splice(indexToRemove, 1);
        synchronizeFormFileInput();
        renderQueuePreviews();
    }

    function synchronizeFormFileInput() {
        const hiddenInput = document.getElementById('hiddenFormFilesField');
        const dataTransfer = new DataTransfer();
        
        imageStorageArray.forEach(item => {
            if (!item.isExisting) {
                dataTransfer.items.add(item.fileInstance);
            }
        });
        
        hiddenInput.files = dataTransfer.files;
    }

    function renderQueuePreviews() {
        const grid = document.getElementById('previewGalleryGrid');
        const mainCover = document.getElementById('previewImg');
        const badgeCounter = document.getElementById('queueCount');
        
        grid.innerHTML = '';
        badgeCounter.innerText = imageStorageArray.length;

        if (imageStorageArray.length === 0) {
            mainCover.src = "https://images.unsplash.com/photo-1492144534655-ae79c964c9d7";
            return;
        }

        imageStorageArray.forEach((item, index) => {
            const wrap = document.createElement('div');
            wrap.className = "relative group/thumb rounded-lg overflow-hidden h-12 bg-gray-100 aspect-square border border-white/60 shadow-sm";
            
            const img = document.createElement('img');
            img.className = "w-full h-full object-cover";
            
            const removeBtn = document.createElement('button');
            removeBtn.type = "button";
            removeBtn.innerHTML = "✕";
            removeBtn.className = "absolute inset-0 bg-red-600/80 text-white flex items-center justify-center text-xs font-bold opacity-0 group-hover/thumb:opacity-100 transition-opacity duration-150 cursor-pointer";
            removeBtn.onclick = function() {
                removeFileFromQueue(index);
            };

            if (item.isExisting) {
                img.src = item.pathUrl;
                
                const trackingInput = document.createElement('input');
                trackingInput.type = "hidden";
                trackingInput.name = "old_images[]";
                trackingInput.value = item.rawPathValue;
                wrap.appendChild(trackingInput);
                
                if (index === 0) mainCover.src = item.pathUrl;
                
                wrap.appendChild(img);
                wrap.appendChild(removeBtn);
                grid.appendChild(wrap);
            } else {
                const reader = new FileReader();
                reader.onload = function() {
                    img.src = reader.result;
                    if (index === 0) mainCover.src = reader.result;
                    
                    wrap.appendChild(img);
                    wrap.appendChild(removeBtn);
                    grid.appendChild(wrap);
                }
                reader.readAsDataURL(item.fileInstance);
            }
        });
    }
</script>
</body>
</html>