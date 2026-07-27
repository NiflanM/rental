<section>
    <form method="post" action="{{ route('password.update') }}" class="space-y-5">
        @csrf
        @method('put')

        <div>
            <label for="update_password_current_password" class="block text-xs font-bold uppercase tracking-wider text-slate-600 mb-2">
                Current Password
            </label>
            <input id="update_password_current_password" name="current_password" type="password"
                   class="w-full border border-slate-200 rounded-xl p-3 text-sm text-slate-800 focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition outline-none"
                   autocomplete="current-password" />
            <x-input-error :messages="$errors->updatePassword->get('current_password')" class="mt-2 text-xs text-red-500" />
        </div>

        <div>
            <label for="update_password_password" class="block text-xs font-bold uppercase tracking-wider text-slate-600 mb-2">
                New Password
            </label>
            <input id="update_password_password" name="password" type="password"
                   class="w-full border border-slate-200 rounded-xl p-3 text-sm text-slate-800 focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition outline-none"
                   autocomplete="new-password" />
            <x-input-error :messages="$errors->updatePassword->get('password')" class="mt-2 text-xs text-red-500" />
        </div>

        <div>
            <label for="update_password_password_confirmation" class="block text-xs font-bold uppercase tracking-wider text-slate-600 mb-2">
                Confirm Password
            </label>
            <input id="update_password_password_confirmation" name="password_confirmation" type="password"
                   class="w-full border border-slate-200 rounded-xl p-3 text-sm text-slate-800 focus:ring-2 focus:ring-indigo-500 focus:border-indigo-500 transition outline-none"
                   autocomplete="new-password" />
            <x-input-error :messages="$errors->updatePassword->get('password_confirmation')" class="mt-2 text-xs text-red-500" />
        </div>

        <button type="submit"
                class="btn w-full bg-slate-900 hover:bg-slate-800 text-white font-semibold py-3.5 rounded-xl text-xs tracking-wider uppercase shadow-sm transition">
            Update Password
        </button>

        @if (session('status') === 'password-updated')
            <p x-data="{ show: true }" x-show="show" x-transition x-init="setTimeout(() => show = false, 3000)"
               class="text-xs text-emerald-600 text-center font-bold">
                ✓ Password updated.
            </p>
        @endif
    </form>
</section>