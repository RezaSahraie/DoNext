<div class="min-h-screen bg-slate-50 text-slate-900 dark:bg-slate-950 dark:text-white">

    <div class="grid min-h-screen lg:grid-cols-2">

        {{-- Brand side --}}
        <div class="hidden bg-indigo-600 p-12 text-white lg:flex lg:flex-col lg:justify-between">

            <div>
                <span class="text-2xl font-black">
                    DoNext
                </span>
            </div>

            <div>
                <p class="mb-4 text-sm font-bold tracking-widest text-indigo-200">
                    GET THINGS DONE.
                </p>

                <h1 class="max-w-lg text-5xl font-black leading-tight">

                    <span x-show="lang === 'fa'">
                        رمز عبورت را تغییر بده.
                    </span>

                    <span x-show="lang === 'en'">
                        Create a new password.
                    </span>

                </h1>

                <p class="mt-6 max-w-md text-indigo-100">

                    <span x-show="lang === 'fa'">
                        یک رمز عبور جدید و امن برای حساب DoNext خود انتخاب کن.
                    </span>

                    <span x-show="lang === 'en'">
                        Choose a new secure password for your DoNext account.
                    </span>

                </p>
            </div>

            <p class="text-sm text-indigo-200">
                © 2026 DoNext
            </p>

        </div>


        {{-- Form side --}}
        <main class="flex items-center justify-center p-6 sm:p-10">

            <div class="w-full max-w-md">

                {{-- Header --}}
                <div class="mb-10 flex items-center justify-between">

                    <a
                        href="{{ route('login') }}"
                        class="text-2xl font-black tracking-tight">
                        DoNext
                    </a>

                    <button
                        type="button"
                        @click="setLang(lang === 'fa' ? 'en' : 'fa')"
                        class="rounded-xl border border-slate-200 bg-white px-4 py-2 text-xs font-bold transition hover:border-indigo-500 dark:border-slate-700 dark:bg-slate-900">

                        <span x-text="lang === 'fa' ? 'English' : 'فارسی'"></span>

                    </button>

                </div>


                {{-- Title --}}
                <div class="mb-8">

                    <div
                        class="mb-5 flex h-12 w-12 items-center justify-center rounded-2xl bg-indigo-100 text-xl dark:bg-indigo-500/10">
                        🔐
                    </div>

                    <h1 class="text-3xl font-black tracking-tight sm:text-4xl">

                        <span x-show="lang === 'fa'">
                            تغییر رمز عبور
                        </span>

                        <span x-show="lang === 'en'">
                            Reset your password
                        </span>

                    </h1>

                    <p class="mt-3 text-sm leading-6 text-slate-500 dark:text-slate-400">

                        <span x-show="lang === 'fa'">
                            رمز عبور جدید خود را وارد کنید.
                        </span>

                        <span x-show="lang === 'en'">
                            Enter a new password for your account.
                        </span>

                    </p>

                </div>


                {{-- Success --}}
                @if (session()->has('status'))

                    <div
                        class="mb-6 rounded-2xl border border-emerald-200 bg-emerald-50 px-4 py-4 text-sm font-medium text-emerald-700 dark:border-emerald-500/20 dark:bg-emerald-500/10 dark:text-emerald-400">

                        {{ session('status') }}

                    </div>

                @endif


                {{-- Form --}}
                <form
                    wire:submit="resetPassword"
                    class="space-y-5">

                    {{-- Email --}}
                    <div>

                        <label
                            for="email"
                            class="block text-sm font-bold">

                            <span x-show="lang === 'fa'">
                                ایمیل
                            </span>

                            <span x-show="lang === 'en'">
                                Email address
                            </span>

                        </label>

                        <input
                            id="email"
                            type="email"
                            wire:model="email"
                            autocomplete="email"
                            class="mt-2 h-12 w-full rounded-xl border border-slate-200 bg-white px-4 outline-none focus:border-indigo-500 dark:border-slate-700 dark:bg-slate-900">

                        @error('email')
                            <p class="mt-2 text-sm text-red-500">
                                {{ $message }}
                            </p>
                        @enderror

                    </div>


                    {{-- Password --}}
                    <div>

                        <label
                            for="password"
                            class="block text-sm font-bold">

                            <span x-show="lang === 'fa'">
                                رمز عبور جدید
                            </span>

                            <span x-show="lang === 'en'">
                                New password
                            </span>

                        </label>

                        <input
                            id="password"
                            type="password"
                            wire:model="password"
                            autocomplete="new-password"
                            placeholder="••••••••"
                            class="mt-2 h-12 w-full rounded-xl border border-slate-200 bg-white px-4 outline-none focus:border-indigo-500 dark:border-slate-700 dark:bg-slate-900">

                        @error('password')
                            <p class="mt-2 text-sm text-red-500">
                                {{ $message }}
                            </p>
                        @enderror

                    </div>


                    {{-- Confirmation --}}
                    <div>

                        <label
                            for="password_confirmation"
                            class="block text-sm font-bold">

                            <span x-show="lang === 'fa'">
                                تکرار رمز عبور
                            </span>

                            <span x-show="lang === 'en'">
                                Confirm password
                            </span>

                        </label>

                        <input
                            id="password_confirmation"
                            type="password"
                            wire:model="password_confirmation"
                            autocomplete="new-password"
                            placeholder="••••••••"
                            class="mt-2 h-12 w-full rounded-xl border border-slate-200 bg-white px-4 outline-none focus:border-indigo-500 dark:border-slate-700 dark:bg-slate-900">

                    </div>


                    {{-- Submit --}}
                    <button
                        type="submit"
                        wire:loading.attr="disabled"
                        class="w-full rounded-xl bg-indigo-600 py-3.5 text-sm font-bold text-white hover:bg-indigo-700">

                        <span wire:loading.remove>

                            <span x-show="lang === 'fa'">
                                تغییر رمز عبور
                            </span>

                            <span x-show="lang === 'en'">
                                Reset password
                            </span>

                        </span>

                        <span wire:loading>

                            <span x-show="lang === 'fa'">
                                در حال تغییر...
                            </span>

                            <span x-show="lang === 'en'">
                                Resetting...
                            </span>

                        </span>

                    </button>

                </form>


                {{-- Back --}}
                <div class="mt-8 text-center">

                    <a
                        href="{{ route('login') }}"
                        class="font-bold text-indigo-600">

                        <span>
                            ←
                        </span>

                        <span x-show="lang === 'fa'">
                            بازگشت به ورود
                        </span>

                        <span x-show="lang === 'en'">
                            Back to login
                        </span>

                    </a>

                </div>

            </div>

        </main>

    </div>

</div>