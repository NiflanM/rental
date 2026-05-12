<!DOCTYPE html>
<html lang="en">
<head>
    <title>Manage Users</title>

    @vite(['resources/css/app.css','resources/js/app.js'])

    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">

    <style>
        body{
            font-family: 'Inter', sans-serif;
            background: #f6f7fb;
        }

        /* TOPBAR */
        .topbar{
            background: white;
            border-bottom: 1px solid #e5e7eb;
            position: sticky;
            top: 0;
            z-index: 50;
        }

        /* MAIN CARD */
        .card{
            background: white;
            border-radius: 18px;
            padding: 20px;
            box-shadow: 0 10px 25px rgba(0,0,0,0.05);
            transition: .3s;
        }

        .card:hover{
            transform: translateY(-3px);
            box-shadow: 0 18px 40px rgba(0,0,0,0.08);
        }

        /* SIDEBAR */
        .sidebar{
            width: 280px;
            background: #0b1220;
            color: #94a3b8;
            transition: .3s;
        }

        .sidebar.collapsed{
            width: 80px;
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
            background: linear-gradient(90deg,#6366f1,#8b5cf6);
            color:white;
            box-shadow: 0 10px 25px rgba(99,102,241,.25);
        }

        .icon{
            width:20px;
            text-align:center;
        }

        .table-row:hover{
            background:#f9fafb;
        }
    </style>
</head>

<body>

<div class="flex min-h-screen">

    {{-- SIDEBAR --}}
    @include('layouts.partials.sidebar')

    {{-- MAIN --}}
    <div class="flex-1 flex flex-col">

        {{-- TOPBAR --}}
        <header class="topbar flex items-center justify-between px-6 py-4">

            <div>
                <h2 class="text-lg font-semibold text-gray-800">
                    User Management
                </h2>

                <p class="text-sm text-gray-500">
                    Manage all registered users
                </p>
            </div>

            <div class="flex items-center gap-4">

                {{-- SEARCH --}}
                <input
                    placeholder="Search users..."
                    class="px-4 py-2 border rounded-xl text-sm w-72 focus:ring-2 focus:ring-indigo-500"
                >

                {{-- PROFILE --}}
                <div class="w-9 h-9 bg-indigo-600 text-white rounded-full flex items-center justify-center font-bold">
                    {{ strtoupper(substr(auth()->user()->name,0,1)) }}
                </div>

            </div>

        </header>

        {{-- CONTENT --}}
        <main class="p-8">

            {{-- ALERTS --}}
            @if(session('success'))
                <div class="mb-6 bg-green-100 text-green-700 px-5 py-4 rounded-xl">
                    {{ session('success') }}
                </div>
            @endif

            @if(session('error'))
                <div class="mb-6 bg-red-100 text-red-700 px-5 py-4 rounded-xl">
                    {{ session('error') }}
                </div>
            @endif

            {{-- USERS TABLE --}}
            <div class="card overflow-hidden">

                <div class="overflow-x-auto">

                    <table class="w-full">

                        <thead class="bg-gray-50 border-b">

                            <tr class="text-left text-sm text-gray-500">

                                <th class="px-6 py-4">User</th>
                                <th class="px-6 py-4">Email</th>
                                <th class="px-6 py-4">Role</th>
                                <th class="px-6 py-4">Joined</th>
                                <th class="px-6 py-4 text-center">Actions</th>

                            </tr>

                        </thead>

                        <tbody>

                            @forelse($users as $user)

                            <tr class="table-row border-b">

                                {{-- USER --}}
                                <td class="px-6 py-5">

                                    <div class="flex items-center gap-3">

                                        <div class="w-11 h-11 rounded-full bg-indigo-600 text-white flex items-center justify-center font-bold">
                                            {{ strtoupper(substr($user->name,0,1)) }}
                                        </div>

                                        <div>
                                            <p class="font-semibold text-gray-800">
                                                {{ $user->name }}
                                            </p>

                                            @if(auth()->id() === $user->id)
                                                <span class="text-xs text-indigo-600">
                                                    You
                                                </span>
                                            @endif
                                        </div>

                                    </div>

                                </td>

                                {{-- EMAIL --}}
                                <td class="px-6 py-5 text-gray-600">
                                    {{ $user->email }}
                                </td>

                                {{-- ROLE --}}
                                <td class="px-6 py-5">

                                    <form method="POST"
                                          action="{{ route('admin.users.role', $user->id) }}">

                                        @csrf
                                        @method('PATCH')

                                        <select
                                            name="role"
                                            onchange="this.form.submit()"
                                            class="px-4 py-2 rounded-xl border">

                                            <option value="user"
                                                {{ $user->role === 'user' ? 'selected' : '' }}>
                                                User
                                            </option>

                                            <option value="admin"
                                                {{ $user->role === 'admin' ? 'selected' : '' }}>
                                                Admin
                                            </option>

                                        </select>

                                    </form>

                                </td>

                                {{-- JOINED --}}
                                <td class="px-6 py-5 text-gray-500 text-sm">
                                    {{ $user->created_at->format('d M Y') }}
                                </td>

                                {{-- ACTIONS --}}
                                <td class="px-6 py-5">

                                    <div class="flex justify-center">

                                        @if(auth()->id() !== $user->id)

                                        <form method="POST"
                                              action="{{ route('admin.users.delete', $user->id) }}"
                                              onsubmit="return confirm('Delete this user?')">

                                            @csrf
                                            @method('DELETE')

                                            <button
                                                class="px-4 py-2 bg-red-500 hover:bg-red-600 text-white rounded-xl transition">

                                                Delete

                                            </button>

                                        </form>

                                        @endif

                                    </div>

                                </td>

                            </tr>

                            @empty

                            <tr>

                                <td colspan="5" class="text-center py-10 text-gray-500">
                                    No users found.
                                </td>

                            </tr>

                            @endforelse

                        </tbody>

                    </table>

                </div>

            </div>

        </main>

    </div>

</div>

{{-- SIDEBAR TOGGLE --}}
<script>
function toggleSidebar() {
    const sidebar = document.getElementById('sidebar');
    sidebar.classList.toggle('collapsed');

    document.querySelectorAll('.sidebar-text').forEach(el => {
        el.classList.toggle('hidden');
    });
}
</script>

</body>
</html>