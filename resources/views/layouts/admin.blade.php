<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>@yield('title','Enterprise Admin')</title>

    <script src="https://cdn.tailwindcss.com"></script>

    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">

    <style>
        body{
            font-family:'Inter',sans-serif;
            background:#f6f7fb;
        }

        /* SIDEBAR */
        .sidebar{
            width:280px;
            background:#0b1220;
            color:#94a3b8;
            transition:.3s;
        }

        .sidebar.collapsed{
            width:80px;
        }

        .nav-item{
            display:flex;
            align-items:center;
            gap:12px;
            padding:12px 14px;
            border-radius:12px;
            transition:.2s;
            font-size:14px;
        }

        .nav-item:hover{
            background:#111a2e;
            color:white;
        }

        .active{
            background:linear-gradient(90deg,#6366f1,#8b5cf6);
            color:white;
        }

        /* TOPBAR */
        .topbar{
            background:white;
            border-bottom:1px solid #e5e7eb;
        }
    </style>
</head>

<body>

<div class="flex min-h-screen">

    {{-- SIDEBAR --}}
    <aside id="sidebar" class="sidebar flex flex-col justify-between p-4">

        <div>

            <div class="mb-8 px-2">
                <h1 class="text-white font-bold text-lg">LUXURY GARAGE</h1>
                <p class="text-xs text-slate-400">Enterprise Panel</p>
            </div>

            <nav class="space-y-2">

                <a href="{{ route('dashboard') }}"
                   class="nav-item {{ request()->routeIs('dashboard') ? 'active' : '' }}">
                    📊 Dashboard
                </a>

                <a href="{{ route('cars.index') }}"
                   class="nav-item {{ request()->routeIs('cars.*') ? 'active' : '' }}">
                    🚗 Cars
                </a>

                <a href="{{ route('bookings.index') }}"
                   class="nav-item {{ request()->routeIs('bookings.*') ? 'active' : '' }}">
                    📅 Bookings
                </a>

            </nav>

        </div>

        <div class="text-xs text-slate-500">
            Logged in: {{ auth()->user()->name }}
        </div>

    </aside>

    {{-- MAIN --}}
    <div class="flex-1 flex flex-col">

        {{-- TOPBAR --}}
        <header class="topbar px-6 py-4 flex justify-between items-center">

            <h2 class="text-lg font-semibold">
                @yield('page-title','Dashboard')
            </h2>

        </header>

        {{-- CONTENT --}}
        <main class="p-8">
            @yield('content')
        </main>

    </div>

</div>

</body>
</html>