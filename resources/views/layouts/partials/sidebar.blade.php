<aside
    id="sidebar"
    class="sidebar relative flex flex-col justify-between
    bg-gradient-to-b from-[#0f172a] via-[#111827] to-[#020617]
    border-r border-slate-800/70
    shadow-2xl
    min-h-screen
    p-5
    transition-all duration-300">

    {{-- GLOW EFFECT --}}
    <div class="absolute top-0 left-0 w-full h-40 bg-indigo-500/10 blur-3xl pointer-events-none"></div>

    <div class="relative z-10">

        {{-- LOGO --}}
        <div class="flex items-center justify-between mb-10">

            <div class="flex items-center gap-3">

                {{-- LOGO ICON --}}
                <div class="w-12 h-12 rounded-2xl bg-gradient-to-br from-indigo-500 to-violet-600
                    flex items-center justify-center
                    shadow-lg shadow-indigo-500/30">

                    <span class="text-white text-xl">
                        🚘
                    </span>

                </div>

                {{-- TEXT --}}
                <div class="sidebar-text transition-all duration-300">

                    <h1 class="text-white font-bold text-lg tracking-wide">
                        LUXURY
                    </h1>

                    <p class="text-xs text-slate-400 tracking-[0.25em] uppercase">
                        Garage System
                    </p>

                </div>

            </div>

            {{-- TOGGLE --}}
            <button
                onclick="toggleSidebar()"
                class="w-10 h-10 rounded-xl
                bg-white/5 hover:bg-white/10
                border border-white/5
                text-slate-300 hover:text-white
                transition flex items-center justify-center">

                ☰

            </button>

        </div>

        {{-- SECTION TITLE --}}
        <div class="sidebar-text text-[11px] uppercase tracking-[0.2em] text-slate-500 mb-4 px-3">
            Main Menu
        </div>

        {{-- NAVIGATION --}}
        <nav class="space-y-2">

            {{-- DASHBOARD --}}
            {{-- <a href="{{ route('dashboard') }}"
               class="nav-item group
               {{ request()->routeIs('dashboard') ? 'active' : '' }}">

                <div class="icon-wrapper">
                    📊
                </div>

                <span class="sidebar-text font-medium">
                    Dashboard
                </span>

            </a> --}}

            {{-- VEHICLES --}}
            <a href="{{ route('cars.index') }}"
               class="nav-item group
               {{ request()->routeIs('cars.*') ? 'active' : '' }}">

                <div class="icon-wrapper">
                    🚗
                </div>

                <span class="sidebar-text font-medium">
                    Vehicles
                </span>

            </a>

            {{-- BOOKINGS --}}
            <a href="{{ route('bookings.index') }}"
               class="nav-item group
               {{ request()->routeIs('bookings.*') ? 'active' : '' }}">

                <div class="icon-wrapper">
                    📅
                </div>

                <span class="sidebar-text font-medium">
                    Bookings
                </span>

            </a>

            {{-- USERS --}}
            <a href="{{ route('admin.users.index') }}"
               class="nav-item group
               {{ request()->routeIs('admin.users.*') ? 'active' : '' }}">

                <div class="icon-wrapper">
                    👥
                </div>

                <span class="sidebar-text font-medium">
                    Users
                </span>

            </a>

            {{-- PAYMENTS --}}
            <a href="#"
               class="nav-item group">

                <div class="icon-wrapper">
                    💳
                </div>

                <span class="sidebar-text font-medium">
                    Payments
                </span>

            </a>

        </nav>

    </div>

    {{-- USER PROFILE --}}
    <div class="relative z-10 mt-8">

        <div class="border border-white/5 bg-white/5 backdrop-blur-xl
            rounded-2xl p-4">

            <div class="flex items-center gap-3">

                {{-- AVATAR --}}
                <div class="w-12 h-12 rounded-2xl
                    bg-gradient-to-br from-indigo-500 to-pink-500
                    flex items-center justify-center
                    text-white font-bold text-lg
                    shadow-lg shadow-indigo-500/20">

                    {{ strtoupper(substr(auth()->user()->name,0,1)) }}

                </div>

                {{-- USER INFO --}}
                <div class="sidebar-text">

                    <p class="text-sm font-semibold text-white">
                        {{ auth()->user()->name }}
                    </p>

                    <p class="text-xs text-slate-400 capitalize">
                        {{ auth()->user()->role }}
                    </p>

                </div>

            </div>

            {{-- LOGOUT --}}
            <form method="POST" action="{{ route('logout') }}" class="mt-4">
                @csrf

                <button
                    class="w-full py-2.5 rounded-xl
                    bg-red-500/10 hover:bg-red-500
                    text-red-400 hover:text-white
                    text-sm font-medium
                    transition-all duration-300">

                    Logout

                </button>

            </form>

        </div>

    </div>

</aside>

<style>
.sidebar{
    width: 290px;
}

.sidebar.collapsed{
    width: 95px;
}

.nav-item{
    display:flex;
    align-items:center;
    gap:14px;
    padding:14px;
    border-radius:18px;
    color:#94a3b8;
    transition:all .25s ease;
    position:relative;
    overflow:hidden;
}

.nav-item:hover{
    background:rgba(255,255,255,0.06);
    color:white;
    transform:translateX(4px);
}

.nav-item.active{
    background:linear-gradient(135deg,#6366f1,#8b5cf6);
    color:white;
    box-shadow:
        0 10px 30px rgba(99,102,241,.35);
}

.icon-wrapper{
    width:42px;
    height:42px;
    min-width:42px;
    border-radius:14px;
    background:rgba(255,255,255,0.06);
    display:flex;
    align-items:center;
    justify-content:center;
    font-size:18px;
    transition:.25s;
}

.nav-item:hover .icon-wrapper{
    background:rgba(255,255,255,0.12);
}

.active .icon-wrapper{
    background:rgba(255,255,255,0.18);
}

.sidebar.collapsed .sidebar-text{
    display:none;
}

.sidebar.collapsed .nav-item{
    justify-content:center;
}

.sidebar.collapsed .icon-wrapper{
    margin:0;
}
</style>