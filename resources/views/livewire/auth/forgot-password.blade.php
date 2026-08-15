<div
    x-data="{
        lang: localStorage.getItem('donext-lang') || 'fa',

        setLang(value) {
            this.lang = value;
            localStorage.setItem('donext-lang', value);
        }
    }"
    :lang="lang"
    :dir="lang === 'fa' ? 'rtl' : 'ltr'"
>
    <div class="grid min-h-screen lg:grid-cols-2">

        {{-- Left / Brand Section --}}
        <div
            class="hidden bg-indigo-600 p-12 text-white lg:flex lg:flex-col lg:justify-between"
        >
            <div>
                <a href="{{ url('/') }}" class="text-2xl font-black">
                    DoNext
                </a>
            </div>

            <div>
                <p class="mb-4 text-sm font-bold tracking-widest text-indigo-200">
                    GET THINGS DONE.
                </p>

                <h1 class="max-w-lg text-5xl font-black leading-tight">
                    <span x-show="lang === 'fa'">
                        دوباره وارد شو،
                        <br>
                        ادامه بده.
                    </span>

                    <span x-show="lang === 'en'">
                        Get back in,
                        <br>
                        keep moving.
                    </span>
                </h1>

                <p class="mt-6 max-w-md text-base leading-7 text-indigo-100">
                    <span x-show="lang === 'fa'">
                        رمز عبورت را فراموش کردی؟
                        نگران نباش. یک لینک امن برای تغییر رمز عبور برایت ارسال می‌کنیم.
                    </span>

                    <span x-show="lang === 'en'">
                        Forgot your password?
                        Don't worry. We'll send you a secure link to reset it.
                    </span>
                </p>
            </div>

            <p class="text-sm text-indigo-200">
                © 2026 DoNext
            </p>
        </div>


        {{-- Form Section --}}
        <main
            class="flex min-h-screen items-center justify-center bg-slate-950 px-6 py-12 text-white"
        >
            <div class="w-full max-w-md">

                {{-- Header --}}
                <div class="mb-8 flex items-center justify-between">

                    <a
                        href="{{ url('/') }}"
                        class="text-2xl font-black tracking-tight"
                    >
                        DoNext
                    </a>

                    <button
                        type="button"
                        @click="setLang(lang === 'fa' ? 'en' : 'fa')"
                        class="rounded-xl border border-slate-700 bg-slate-900 px-4 py-2 text-xs font-bold transition hover:border-indigo-500"
                    >
                        <span x-text="lang === 'fa' ? 'English' : 'فارسی'"></span>
                    </button>

                </div>


                {{-- Title --}}
                <div class="mb-8">

                    <div
                        class="mb-5 flex h-14 w-14 items-center justify-center rounded-2xl bg-indigo-600/15 text-2xl"
                    >
                        🔐
                    </div>

                    <h1 class="text-3xl font-black tracking-tight">
                        <span x-show="lang === 'fa'">
                            فراموشی رمز عبور
                        </span>

                        <span x-show="lang === 'en'">
                            Forgot password?
                        </span>
                    </h1>

                    <p class="mt-3 text-sm leading-6 text-slate-400">
                        <span x-show="lang === 'fa'">
                            ایمیل حساب خود را وارد کن تا لینک تغییر رمز عبور برایت ارسال شود.
                        </span>

                        <span x-show="lang === 'en'">
                            Enter your email and we'll send you a password reset link.
                        </span>
                    </p>

                </div>


                {{-- Success Message --}}
                @if (session()->has('status'))

                    <div
                        class="mb-6 rounded-2xl border border-emerald-500/20 bg-emerald-500/10 p-4 text-sm leading-6 text-emerald-400"
                    >
                        <div class="flex items-start gap-3">

                            <span class="mt-0.5 text-base">
                                ✓
                            </span>

                            <div>
                                <span x-show="lang === 'fa'">
                                    لینک بازیابی رمز عبور برای ایمیل شما ارسال شد.
                                </span>

                                <span x-show="lang === 'en'">
                                    We have emailed your password reset link.
                                </span>
                            </div>

                        </div>
                    </div>

                @endif


                {{-- Form --}}
                <form
                    wire:submit="sendResetLink"
                    class="space-y-5"
                >

                    {{-- Email --}}
                    <div>

                        <label
                            for="email"
                            class="block text-sm font-bold"
                        >
                            <span x-show="lang === 'fa'">
                                ایمیل
                            </span>

                            <span x-show="lang === 'en'">
                                Email
                            </span>
                        </label>

                        <input
                            id="email"
                            type="email"
                            wire:model="email"
                            autocomplete="email"
                            placeholder="you@example.com"
                            class="mt-2 h-12 w-full rounded-xl border border-slate-200 bg-white px-4 outline-none focus:border-indigo-500 dark:border-slate-700 dark:bg-slate-900"
                        >

                        @error('email')
                            <p class="mt-2 text-sm text-red-400">
                                {{ $message }}
                            </p>
                        @enderror

                    </div>


                    {{-- Submit --}}
                    <button
                        type="submit"
                        wire:loading.attr="disabled"
                        class="w-full rounded-xl bg-indigo-600 py-3.5 text-sm font-bold text-white hover:bg-indigo-700"
                    >

                        <span wire:loading.remove>
                            <span x-show="lang === 'fa'">
                                ارسال لینک بازیابی
                            </span>

                            <span x-show="lang === 'en'">
                                Send reset link
                            </span>
                        </span>

                        <span wire:loading>
                            <span x-show="lang === 'fa'">
                                در حال ارسال...
                            </span>

                            <span x-show="lang === 'en'">
                                Sending...
                            </span>
                        </span>

                    </button>

                </form>


                {{-- Back to Login --}}
                <div class="mt-8 text-center">

                    <a
                        href="{{ route('login') }}"
                        class="font-bold text-indigo-600"
                    >

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