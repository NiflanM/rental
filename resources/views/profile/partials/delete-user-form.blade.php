<section x-data="{ open: false }" class="space-y-6">
    <button type="button" @click="open = true"
            class="btn w-full bg-red-600 hover:bg-red-700 text-white font-semibold py-3.5 rounded-xl text-xs tracking-wider uppercase shadow-sm transition">
        Delete Account
    </button>

    <!-- Deletion Confirmation Modal -->
    <div x-show="open" x-cloak class="fixed inset-0 z-50 flex items-center justify-center p-4 bg-slate-900/50 backdrop-blur-sm">
        <div @click.away="open = false" class="bg-white rounded-2xl border border-slate-200 shadow-2xl max-w-md w-full p-6 space-y-5">
            <h2 class="text-lg font-bold text-slate-900">
                Are you sure you want to delete your account?
            </h2>
            <p class="text-xs text-slate-500 leading-relaxed">
                Once your account is deleted, all of its resources and data will be permanently deleted. Please enter your password to confirm deletion.
            </p>

            <form method="post" action="{{ route('profile.destroy') }}" class="space-y-4">
                @csrf
                @method('delete')

                <div>
                    <input name="password" type="password"
                           class="w-full border border-slate-200 rounded-xl p-3 text-sm text-slate-800 focus:ring-2 focus:ring-red-500 focus:border-red-500 transition outline-none"
                           placeholder="Enter password to confirm" required />
                    <x-input-error :messages="$errors->userDeletion->get('password')" class="mt-2 text-xs text-red-500" />
                </div>

                <div class="flex justify-end gap-3 pt-2">
                    <button type="button" @click="open = false" class="px-4 py-2.5 rounded-xl bg-slate-100 hover:bg-slate-200 text-slate-700 text-xs font-semibold transition">
                        Cancel
                    </button>
                    <button type="submit" class="px-4 py-2.5 rounded-xl bg-red-600 hover:bg-red-700 text-white text-xs font-semibold transition shadow-sm">
                        Confirm Delete
                    </button>
                </div>
            </form>
        </div>
    </div>
</section>