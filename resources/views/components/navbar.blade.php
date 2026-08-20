<header x-data="{ mobileMenu: false, notificationsOpen: false, userMenuOpen: false }"
    class="sticky top-0 z-40 border-b border-slate-200/80 bg-white/85 backdrop-blur-xl dark:border-slate-800/80 dark:bg-slate-950/85">
    <div class="flex h-20 items-center justify-between px-4 sm:px-6 lg:px-8">
        <div class="flex items-center gap-3">
            <button type="button" @click="mobileMenu = !mobileMenu"
                class="grid h-10 w-10 place-items-center rounded-xl border border-slate-200 text-slate-600 hover:bg-slate-100 dark:border-slate-700 dark:text-slate-300 lg:hidden">
                <span x-text="mobileMenu ? '✕' : '☰'"></span>
            </button>
            <div>
                <p class="hidden text-xs font-medium text-slate-400 sm:block">
                    {{ now()->format('l, M d, Y') }} · امروز
                </p>
                <h1 class="text-lg font-black tracking-tight">@yield('heading', 'DoNext')</h1>
            </div>
        </div>

        <div class="flex items-center gap-2">
            {{-- Theme toggle (plain JS, works with Livewire) --}}
            <button type="button" onclick="window.DoNextToggleTheme()"
                class="grid h-10 w-10 place-items-center rounded-xl border border-slate-200 text-slate-600 hover:bg-slate-100 dark:border-slate-700 dark:text-slate-300 dark:hover:bg-slate-800"
                aria-label="Theme">
                <span class="dark:hidden">☾</span>
                <span class="hidden dark:inline">☀</span>
            </button>

            {{-- Language toggle --}}
            <button type="button" onclick="window.DoNextToggleLanguage()" data-lang-toggle
                class="hidden h-10 min-w-12 rounded-xl border border-slate-200 px-3 text-xs font-bold text-slate-600 hover:bg-slate-100 dark:border-slate-700 dark:text-slate-300 sm:block"
                aria-label="Language">
                EN
            </button>

            <button type="button" @click="notificationsOpen = !notificationsOpen"
                class="relative grid h-10 w-10 place-items-center rounded-xl border border-slate-200 text-slate-600 hover:bg-slate-100 dark:border-slate-700 dark:text-slate-300 dark:hover:bg-slate-800"
                aria-label="Notifications">
                ♢
                <span
                    class="absolute end-2 top-2 h-2 w-2 rounded-full bg-indigo-500 ring-2 ring-white dark:ring-slate-950"></span>
            </button>

            <div class="relative" @click.outside="userMenuOpen = false">
                <button type="button" @click="userMenuOpen = !userMenuOpen"
                    class="ms-1 flex items-center gap-2 rounded-xl p-1 hover:bg-slate-100 dark:hover:bg-slate-800"
                    :aria-expanded="userMenuOpen">
                    <div
                        class="grid h-9 w-9 place-items-center rounded-xl bg-gradient-to-br from-indigo-500 to-violet-600 text-sm font-black text-white">
                        {{ mb_strtoupper(mb_substr(auth()->user()->name ?? 'U', 0, 1)) }}
                    </div>
                    <div class="hidden text-start sm:block">
                        <p class="text-xs font-bold">{{ auth()->user()->name ?? 'User' }}</p>
                    </div>
                    <span class="hidden text-xs text-slate-400 sm:block"
                        :class="userMenuOpen ? 'rotate-180' : ''">⌄</span>
                </button>

                <div x-show="userMenuOpen" x-cloak x-transition
                    class="absolute end-0 top-14 z-50 w-56 overflow-hidden rounded-2xl border border-slate-200 bg-white p-2 shadow-2xl dark:border-slate-800 dark:bg-slate-900">
                    <a href="{{ url('/profile') }}" @click="userMenuOpen = false"
                        class="flex items-center gap-3 rounded-xl px-3 py-2.5 text-sm font-bold hover:bg-slate-50 dark:hover:bg-slate-800">
                        ◎ <span>پروفایل</span>
                    </a>
                    <div class="my-1 border-t border-slate-100 dark:border-slate-800"></div>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit"
                            class="flex w-full items-center gap-3 rounded-xl px-3 py-2.5 text-sm font-bold text-red-600 hover:bg-red-50 dark:text-red-400 dark:hover:bg-red-500/10">
                            ↪ <span>خروج</span>
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>

    <div x-show="mobileMenu" x-cloak x-transition
        class="border-t border-slate-200 bg-white px-4 py-4 dark:border-slate-800 dark:bg-slate-950 lg:hidden">
        <nav class="grid gap-1 sm:grid-cols-2">
            @foreach ([
                ['/dashboard', '⌂', 'Dashboard', 'داشبورد'],
                ['/tasks', '✓', 'Tasks', 'کارها'],
                ['/calendar', '▣', 'Calendar', 'تقویم'],
                ['/categories', '#', 'Categories', 'دسته‌بندی‌ها'],
                ['/profile', '◎', 'Profile', 'پروفایل'],
            ] as $item)
                <a @click="mobileMenu = false" href="{{ url($item[0]) }}"
                    class="rounded-xl px-4 py-3 text-sm font-bold hover:bg-indigo-50 dark:hover:bg-indigo-500/10">
                    {{ $item[1] }}&nbsp; {{ $item[2] }}
                    <span class="text-[10px] text-slate-400">{{ $item[3] }}</span>
                </a>
            @endforeach
        </nav>
    </div>
</header>
