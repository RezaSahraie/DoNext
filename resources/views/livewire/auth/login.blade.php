<div>
    <div class="grid min-h-screen lg:grid-cols-2">

        {{-- Left promotional section --}}
        <div class="hidden bg-indigo-600 p-12 text-white lg:flex lg:flex-col lg:justify-between">

            <div class="text-2xl font-black">
                DoNext
            </div>

            <div>
                <p class="mb-4 text-sm font-bold text-indigo-200">
                    GET THINGS DONE.
                </p>

                <h1 class="max-w-lg text-5xl font-black leading-tight">
                    <span x-show="lang === 'fa'">
                        تمرکز کن، انجام بده، جلو برو.
                    </span>

                    <span x-show="lang === 'en'">
                        Focus. Get it done. Move forward.
                    </span>
                </h1>

                <p class="mt-6 max-w-md text-indigo-100">
                    <span x-show="lang === 'fa'">
                        همه کارهای روزانه‌ات را در یک فضای ساده و زیبا مدیریت کن.
                    </span>

                    <span x-show="lang === 'en'">
                        Manage all your daily tasks in one simple and beautiful
                        workspace.
                    </span>
                </p>
            </div>

            <p class="text-sm text-indigo-200">
                © 2026 DoNext
            </p>
        </div>

        {{-- Login section --}}
        <main class="flex items-center justify-center p-6">
            <div class="w-full max-w-md">

                {{-- Header --}}
                <div class="mb-6 flex items-center justify-between">

                    <span class="text-2xl font-black">
                        DoNext
                    </span>

                    <button type="button" @click="setLang(lang === 'fa' ? 'en' : 'fa')"
                        class="rounded-xl border border-slate-200 bg-white px-3 py-2 text-xs font-bold transition hover:border-indigo-500 dark:border-slate-700 dark:bg-slate-900">
                        <span x-text="lang === 'fa' ? 'English' : 'فارسی'"></span>
                    </button>

                </div>

                {{-- Title --}}
                <div class="mb-8">

                    <h2 class="text-3xl font-black">

                        <span x-show="lang === 'fa'">
                            خوش آمدی 👋
                        </span>

                        <span x-show="lang === 'en'">
                            Welcome back 👋
                        </span>

                    </h2>

                    <p class="mt-2 text-sm text-slate-400">

                        <span x-show="lang === 'fa'">
                            برای ادامه وارد حساب خود شوید.
                        </span>

                        <span x-show="lang === 'en'">
                            Sign in to continue to your account.
                        </span>

                    </p>

                </div>

                {{-- Login form --}}
                <form wire:submit="login" class="space-y-5">

                    {{-- Email --}}
                    <label class="block text-sm font-bold">

                        <span x-show="lang === 'fa'">
                            ایمیل
                        </span>

                        <span x-show="lang === 'en'">
                            Email
                        </span>

                        <input type="email" name="email" wire:model="email" autocomplete="email"
                            placeholder="you@example.com"
                            class="mt-2 h-12 w-full rounded-xl border border-slate-200 bg-white px-4 outline-none focus:border-indigo-500 dark:border-slate-700 dark:bg-slate-900">

                    </label>

                    @error('email')
                        <p class="mt-1 text-sm text-red-500">
                            {{ $message }}
                        </p>
                    @enderror

                    {{-- Password --}}
                    <label class="block text-sm font-bold">

                        <span x-show="lang === 'fa'">
                            رمز عبور
                        </span>

                        <span x-show="lang === 'en'">
                            Password
                        </span>

                        <input type="password" name="password" wire:model="password" autocomplete="current-password"
                            placeholder="••••••••"
                            class="mt-2 h-12 w-full rounded-xl border border-slate-200 bg-white px-4 outline-none focus:border-indigo-500 dark:border-slate-700 dark:bg-slate-900">

                    </label>

                    @error('password')
                        <p class="mt-1 text-sm text-red-500">
                            {{ $message }}
                        </p>
                    @enderror

                    {{-- Remember me + forgot password --}}
                    <div class="flex items-center justify-between text-xs">

                        <label class="flex items-center gap-2">

                            <input type="checkbox" name="remember" wire:model="remember" class="accent-indigo-600">

                            <span x-show="lang === 'fa'">
                                مرا به خاطر بسپار
                            </span>

                            <span x-show="lang === 'en'">
                                Remember me
                            </span>

                        </label>

                        {{-- Forgot password will be implemented later --}}
                        <a href="{{ route('password.request') }}" class="font-bold text-indigo-600">
                            <span x-show="lang === 'fa'">
                                فراموشی رمز عبور؟
                            </span>

                            <span x-show="lang === 'en'">
                                Forgot password?
                            </span>
                        </a>

                    </div>

                    {{-- Submit --}}
                    <button type="submit"
                        class="w-full rounded-xl bg-indigo-600 py-3.5 text-sm font-bold text-white hover:bg-indigo-700">
                        <span x-show="lang === 'fa'">
                            ورود
                        </span>

                        <span x-show="lang === 'en'">
                            Login
                        </span>
                    </button>

                </form>

                {{-- Register link --}}
                <p class="mt-8 text-center text-sm text-slate-400">

                    <span x-show="lang === 'fa'">
                        حساب نداری؟
                    </span>

                    <span x-show="lang === 'en'">
                        Don't have an account?
                    </span>

                    <a href="{{ route('register') }}" class="font-bold text-indigo-600">
                        <span x-show="lang === 'fa'">
                            ثبت‌نام کن
                        </span>

                        <span x-show="lang === 'en'">
                            Register
                        </span>
                    </a>

                </p>

            </div>
        </main>

    </div>
</div>
