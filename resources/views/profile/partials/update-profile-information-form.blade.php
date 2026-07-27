<section>
    <form id="send-verification" method="post" action="{{ route('verification.send') }}">
        @csrf
    </form>

    <form method="post" action="{{ route('profile.update') }}" class="space-y-5">
        @csrf
        @method('patch')

        <div>
            <label for="name" class="block text-xs font-bold uppercase tracking-wider text-slate-600 mb-2">
                Full Name
            </label>
            <input id="name" name="name" type="text"
                   class="w-full border border-slate-200 rounded-xl p-3 text-sm text-slate-800 focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition outline-none"
                   value="{{ old('name', $user->name) }}" required autofocus autocomplete="name" />
            <x-input-error class="mt-2 text-xs text-red-500" :messages="$errors->get('name')" />
        </div>

        <div>
            <label for="email" class="block text-xs font-bold uppercase tracking-wider text-slate-600 mb-2">
                Email Address
            </label>
            <input id="email" name="email" type="email"
                   class="w-full border border-slate-200 rounded-xl p-3 text-sm text-slate-800 focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition outline-none"
                   value="{{ old('email', $user->email) }}" required autocomplete="username" />
            <x-input-error class="mt-2 text-xs text-red-500" :messages="$errors->get('email')" />
        </div>

        <button type="submit"
                class="btn w-full bg-slate-900 hover:bg-slate-800 text-white font-semibold py-3.5 rounded-xl text-xs tracking-wider uppercase shadow-sm transition">
            Save Changes
        </button>

        @if (session('status') === 'profile-updated')
            <p x-data="{ show: true }" x-show="show" x-transition x-init="setTimeout(() => show = false, 3000)"
               class="text-xs text-emerald-600 text-center font-bold">
                ✓ Profile saved successfully.
            </p>
        @endif
    </form>
</section>