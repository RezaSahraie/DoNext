<main class="flex min-h-screen items-center justify-center p-6">

    <div class="w-full max-w-md">

        {{-- Header --}}
        <div class="mb-6 flex items-center justify-between">

            <a href="{{ url('/dashboard') }}" class="text-2xl font-black">
                DoNext
            </a>

            <button type="button" @click="setLang(lang === 'fa' ? 'en' : 'fa')"
                class="rounded-xl border border-slate-200 bg-white px-3 py-2 text-xs font-bold transition hover:border-indigo-500 dark:border-slate-700 dark:bg-slate-900">
                <span x-text="lang === 'fa' ? 'English' : 'فارسی'"></span>
            </button>

        </div>

        {{-- Title --}}
        <div class="mt-10">

            <h1 class="text-3xl font-black">

                <span x-show="lang === 'fa'">
                    ساخت حساب
                </span>

                <span x-show="lang === 'en'">
                    Create an account
                </span>

            </h1>

            <p class="mt-2 text-sm text-slate-400">

                <span x-show="lang === 'fa'">
                    در چند ثانیه فضای کاری خودت را بساز.
                </span>

                <span x-show="lang === 'en'">
                    Create your workspace in just a few seconds.
                </span>

            </p>

        </div>

        {{-- Registration Form --}}
        <form wire:submit="register" class="mt-8 space-y-4">

            @csrf
            {{-- Name --}}
            <label class="block text-sm font-bold">

                <span x-show="lang === 'fa'">
                    نام
                </span>

                <span x-show="lang === 'en'">
                    Name
                </span>

                <input type="text" name="name" wire:model="name" autocomplete="name"
                    class="mt-2 h-12 w-full rounded-xl border border-slate-200 bg-white px-4 dark:border-slate-700 dark:bg-slate-900"
                    placeholder="Your name">

            </label>

            @error('name')
                <p class="mt-1 text-sm text-red-500">
                    {{ $message }}
                </p>
            @enderror


            {{-- Email --}}
            <label class="block text-sm font-bold">

                <span x-show="lang === 'fa'">
                    ایمیل
                </span>

                <span x-show="lang === 'en'">
                    Email
                </span>

                <input type="email" name="email" wire:model="email" autocomplete="email"
                    class="mt-2 h-12 w-full rounded-xl border border-slate-200 bg-white px-4 dark:border-slate-700 dark:bg-slate-900"
                    placeholder="you@example.com">

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

                <input type="password" name="password" wire:model="password" autocomplete="new-password"
                    class="mt-2 h-12 w-full rounded-xl border border-slate-200 bg-white px-4 dark:border-slate-700 dark:bg-slate-900"
                    placeholder="••••••••">

            </label>

            @error('password')
                <p class="mt-1 text-sm text-red-500">
                    {{ $message }}
                </p>
            @enderror


            {{-- Confirm Password --}}
            <label class="block text-sm font-bold">

                <span x-show="lang === 'fa'">
                    تکرار رمز عبور
                </span>

                <span x-show="lang === 'en'">
                    Confirm password
                </span>

                <input type="password" name="password_confirmation" wire:model="password_confirmation"
                    autocomplete="new-password"
                    class="mt-2 h-12 w-full rounded-xl border border-slate-200 bg-white px-4 dark:border-slate-700 dark:bg-slate-900"
                    placeholder="••••••••">

            </label>


            {{-- Submit --}}
            <button type="submit"
                class="w-full rounded-xl bg-indigo-600 py-3.5 text-sm font-bold text-white hover:bg-indigo-700">

                <span x-show="lang === 'fa'">
                    ساخت حساب
                </span>

                <span x-show="lang === 'en'">
                    Create account
                </span>

            </button>

        </form>


        {{-- Login Link --}}
        <p class="mt-8 text-center text-sm text-slate-400">

            <span x-show="lang === 'fa'">
                قبلاً حساب ساخته‌ای؟
            </span>

            <span x-show="lang === 'en'">
                Already have an account?
            </span>

            <a href="{{ url('/login') }}" class="font-bold text-indigo-600">
                <span x-show="lang === 'fa'">
                    ورود
                </span>

                <span x-show="lang === 'en'">
                    Login
                </span>
            </a>

        </p>

    </div>

</main>
