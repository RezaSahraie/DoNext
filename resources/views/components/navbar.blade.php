<header
    x-data="{ mobileMenu: false }"
    class="sticky top-0 z-40 border-b border-slate-200/80 bg-white/80 backdrop-blur-xl dark:border-slate-800/80 dark:bg-slate-950/80"
>
    <div class="flex h-20 items-center justify-between px-4 sm:px-6 lg:px-8">

        {{-- Left / Mobile --}}
        <div class="flex items-center gap-3">

            {{-- Mobile Menu --}}
            <button
                @click="mobileMenu = !mobileMenu"
                class="grid h-10 w-10 place-items-center rounded-xl border border-slate-200 text-slate-600 transition hover:bg-slate-100 dark:border-slate-700 dark:text-slate-300 dark:hover:bg-slate-800 lg:hidden"
            >
                <span x-show="!mobileMenu">☰</span>
                <span x-show="mobileMenu">✕</span>
            </button>

            {{-- Page Information --}}
            <div>
                <p class="hidden text-xs font-medium text-slate-400 sm:block">
                    {{ now()->format('l, M d, Y') }}
                </p>

                <h1 class="text-lg font-black tracking-tight text-slate-900 dark:text-white">
                    @yield('heading', 'Dashboard')
                </h1>
            </div>

        </div>

        {{-- Right Actions --}}
        <div class="flex items-center gap-2">

            {{-- Search --}}
            <button
                class="hidden h-10 items-center gap-2 rounded-xl border border-slate-200 bg-white px-3 text-sm font-medium text-slate-500 transition hover:border-indigo-300 hover:text-indigo-600 dark:border-slate-700 dark:bg-slate-900 dark:text-slate-400 dark:hover:border-indigo-500 dark:hover:text-indigo-400 sm:flex"
            >
                <span>⌕</span>
                <span>Search</span>

                <kbd
                    class="rounded-md bg-slate-100 px-1.5 py-0.5 text-[10px] font-bold text-slate-400 dark:bg-slate-800"
                >
                    /
                </kbd>
            </button>

            {{-- Mobile Search --}}
            <button
                class="grid h-10 w-10 place-items-center rounded-xl border border-slate-200 text-slate-600 transition hover:bg-slate-100 dark:border-slate-700 dark:text-slate-300 dark:hover:bg-slate-800 sm:hidden"
            >
                ⌕
            </button>

            {{-- Theme --}}
            <button
                @click="darkMode = !darkMode; localStorage.setItem('theme', darkMode ? 'dark' : 'light')"
                class="grid h-10 w-10 place-items-center rounded-xl border border-slate-200 text-slate-600 transition hover:bg-slate-100 dark:border-slate-700 dark:text-slate-300 dark:hover:bg-slate-800"
                title="Toggle theme"
            >
                <span x-show="!darkMode">☾</span>
                <span x-show="darkMode">☀</span>
            </button>

            {{-- Language --}}
            <button
                @click="language = language === 'fa' ? 'en' : 'fa'"
                class="hidden h-10 rounded-xl border border-slate-200 px-3 text-xs font-bold text-slate-600 transition hover:bg-slate-100 dark:border-slate-700 dark:text-slate-300 dark:hover:bg-slate-800 sm:block"
            >
                <span x-show="language === 'fa'">EN</span>
                <span x-show="language === 'en'">FA</span>
            </button>

            {{-- Notification --}}
            <button
                class="relative grid h-10 w-10 place-items-center rounded-xl border border-slate-200 text-slate-600 transition hover:bg-slate-100 dark:border-slate-700 dark:text-slate-300 dark:hover:bg-slate-800"
            >
                ♢

                <span
                    class="absolute end-2 top-2 h-2 w-2 rounded-full bg-indigo-500 ring-2 ring-white dark:ring-slate-950"
                ></span>
            </button>

            {{-- Profile --}}
            <a
                href="{{ url('/profile') }}"
                class="ms-1 flex items-center gap-2 rounded-xl p-1 transition hover:bg-slate-100 dark:hover:bg-slate-800"
            >
                <div
                    class="grid h-9 w-9 place-items-center rounded-xl bg-gradient-to-br from-indigo-500 to-violet-600 text-sm font-black text-white shadow-lg shadow-indigo-500/20"
                >
                    R
                </div>

                <div class="hidden text-start sm:block">
                    <p class="text-xs font-bold text-slate-900 dark:text-white">
                        Reza
                    </p>

                    <p class="text-[10px] text-slate-400">
                        Free Plan
                    </p>
                </div>
            </a>

        </div>

    </div>

    {{-- Mobile Navigation --}}
    <div
        x-show="mobileMenu"
        x-transition
        @click.outside="mobileMenu = false"
        class="border-t border-slate-200 bg-white px-4 py-4 dark:border-slate-800 dark:bg-slate-950 lg:hidden"
    >

        <nav class="space-y-1">

            <a
                href="{{ url('/dashboard') }}"
                class="flex items-center gap-3 rounded-xl px-4 py-3 text-sm font-semibold text-slate-700 hover:bg-indigo-50 hover:text-indigo-600 dark:text-slate-300 dark:hover:bg-indigo-500/10 dark:hover:text-indigo-400"
            >
                <span>⌂</span>
                Dashboard
            </a>

            <a
                href="{{ url('/tasks') }}"
                class="flex items-center gap-3 rounded-xl px-4 py-3 text-sm font-semibold text-slate-700 hover:bg-indigo-50 hover:text-indigo-600 dark:text-slate-300 dark:hover:bg-indigo-500/10 dark:hover:text-indigo-400"
            >
                <span>✓</span>
                Tasks
            </a>

            <a
                href="{{ url('/calendar') }}"
                class="flex items-center gap-3 rounded-xl px-4 py-3 text-sm font-semibold text-slate-700 hover:bg-indigo-50 hover:text-indigo-600 dark:text-slate-300 dark:hover:bg-indigo-500/10 dark:hover:text-indigo-400"
            >
                <span>▣</span>
                Calendar
            </a>

            <a
                href="{{ url('/categories') }}"
                class="flex items-center gap-3 rounded-xl px-4 py-3 text-sm font-semibold text-slate-700 hover:bg-indigo-50 hover:text-indigo-600 dark:text-slate-300 dark:hover:bg-indigo-500/10 dark:hover:text-indigo-400"
            >
                <span>#</span>
                Categories
            </a>

            <a
                href="{{ url('/statistics') }}"
                class="flex items-center gap-3 rounded-xl px-4 py-3 text-sm font-semibold text-slate-700 hover:bg-indigo-50 hover:text-indigo-600 dark:text-slate-300 dark:hover:bg-indigo-500/10 dark:hover:text-indigo-400"
            >
                <span>◒</span>
                Statistics
            </a>

            <div class="my-3 border-t border-slate-200 dark:border-slate-800"></div>

            <a
                href="{{ url('/profile') }}"
                class="flex items-center gap-3 rounded-xl px-4 py-3 text-sm font-semibold text-slate-700 hover:bg-slate-100 dark:text-slate-300 dark:hover:bg-slate-800"
            >
                <span>◎</span>
                Profile
            </a>

            <a
                href="{{ url('/settings') }}"
                class="flex items-center gap-3 rounded-xl px-4 py-3 text-sm font-semibold text-slate-700 hover:bg-slate-100 dark:text-slate-300 dark:hover:bg-slate-800"
            >
                <span>⚙</span>
                Settings
            </a>

        </nav>

    </div>
</header>