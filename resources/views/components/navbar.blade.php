<header x-data="{ mobileMenu: false, searchOpen: false, notificationsOpen: false, userMenuOpen: false }"
    class="sticky top-0 z-40 border-b border-slate-200/80 bg-white/85 backdrop-blur-xl dark:border-slate-800/80 dark:bg-slate-950/85">
    <div class="flex h-20 items-center justify-between px-4 sm:px-6 lg:px-8">
        <div class="flex items-center gap-3"><button @click="mobileMenu=!mobileMenu"
                class="grid h-10 w-10 place-items-center rounded-xl border border-slate-200 text-slate-600 hover:bg-slate-100 dark:border-slate-700 dark:text-slate-300 lg:hidden"><span
                    x-text="mobileMenu ? '✕' : '☰'"></span></button>
            <div>
                <p class="hidden text-xs font-medium text-slate-400 sm:block">{{ now()->format('l, M d, Y') }} · امروز
                </p>
                <h1 class="text-lg font-black tracking-tight">@yield('heading', 'Dashboard / داشبورد')</h1>
            </div>
        </div>
        <div class="flex items-center gap-2"><button @click="searchOpen=!searchOpen"
                class="hidden h-10 items-center gap-2 rounded-xl border border-slate-200 bg-white px-3 text-sm font-medium text-slate-500 hover:border-indigo-300 hover:text-indigo-600 dark:border-slate-700 dark:bg-slate-900 dark:text-slate-400 sm:flex">⌕
                <span>Search / جستجو</span><kbd
                    class="rounded-md bg-slate-100 px-1.5 py-0.5 text-[10px] dark:bg-slate-800">/</kbd></button><button
                @click="darkMode=!darkMode"
                class="grid h-10 w-10 place-items-center rounded-xl border border-slate-200 text-slate-600 hover:bg-slate-100 dark:border-slate-700 dark:text-slate-300 dark:hover:bg-slate-800"
                aria-label="Theme"><span x-show="!darkMode">☾</span><span x-show="darkMode">☀</span></button><button
                @click="language=language==='fa'?'en':'fa'"
                class="hidden h-10 min-w-12 rounded-xl border border-slate-200 px-3 text-xs font-bold text-slate-600 hover:bg-slate-100 dark:border-slate-700 dark:text-slate-300 sm:block"><span
                    x-text="language==='fa'?'EN':'FA'"></span></button><button
                @click="notificationsOpen=!notificationsOpen"
                class="relative grid h-10 w-10 place-items-center rounded-xl border border-slate-200 text-slate-600 hover:bg-slate-100 dark:border-slate-700 dark:text-slate-300 dark:hover:bg-slate-800"
                aria-label="Notifications">♢<span
                    class="absolute end-2 top-2 h-2 w-2 rounded-full bg-indigo-500 ring-2 ring-white dark:ring-slate-950"></span></button>
            <div class="relative" @click.outside="userMenuOpen=false"><button @click="userMenuOpen=!userMenuOpen"
                    type="button"
                    class="ms-1 flex items-center gap-2 rounded-xl p-1 hover:bg-slate-100 dark:hover:bg-slate-800"
                    :aria-expanded="userMenuOpen">
                    <div
                        class="grid h-9 w-9 place-items-center rounded-xl bg-gradient-to-br from-indigo-500 to-violet-600 text-sm font-black text-white">
                        R</div>
                    <div class="hidden text-start sm:block">
                        <p class="text-xs font-bold">Reza</p>
                        <p class="text-[10px] text-slate-400">Free Plan / پلن رایگان</p>
                    </div><span class="hidden text-xs text-slate-400 sm:block"
                        :class="userMenuOpen ? 'rotate-180' : ''">⌄</span>
                </button>
                <div x-show="userMenuOpen" x-cloak x-transition
                    class="absolute end-0 top-14 z-50 w-56 overflow-hidden rounded-2xl border border-slate-200 bg-white p-2 shadow-2xl dark:border-slate-800 dark:bg-slate-900">
                    <a href="{{ url('/profile') }}" @click="userMenuOpen=false"
                        class="flex items-center gap-3 rounded-xl px-3 py-2.5 text-sm font-bold hover:bg-slate-50 dark:hover:bg-slate-800">◎
                        <span>Profile / پروفایل</span></a>
                    <div class="my-1 border-t border-slate-100 dark:border-slate-800"></div>
                    <form method="POST" action="{{ route('logout') }}">
                        @csrf
                        <button type="submit"
                            class="flex w-full items-center gap-3 rounded-xl px-3 py-2.5 text-sm font-bold text-red-600 hover:bg-red-50 dark:text-red-400 dark:hover:bg-red-500/10">
                            ↪
                            <span>Logout / خروج</span>
                        </button>
                    </form>
                </div>
            </div>
        </div>
    </div>
    <div x-show="searchOpen" x-cloak x-transition class="border-t border-slate-200 px-4 py-3 dark:border-slate-800">
        <input autofocus placeholder="Search tasks / جستجوی کارها..."
            class="h-11 w-full rounded-xl border border-slate-200 bg-slate-50 px-4 text-sm outline-none focus:border-indigo-500 dark:border-slate-700 dark:bg-slate-900">
    </div>
    <div x-show="notificationsOpen" x-cloak @click.outside="notificationsOpen=false" x-transition
        class="absolute end-4 top-16 w-80 rounded-2xl border border-slate-200 bg-white p-3 shadow-2xl dark:border-slate-800 dark:bg-slate-900">
        <div class="flex items-center justify-between px-2 py-2"><b class="text-sm">Notifications / اعلان‌ها</b><span
                class="text-[10px] text-indigo-600">3 new / ۳ جدید</span></div>
        <div class="space-y-1">
            <div class="rounded-xl p-3 hover:bg-slate-50 dark:hover:bg-slate-800">
                <p class="text-xs font-bold">موعد یک کار نزدیک است</p>
                <p class="mt-1 text-[10px] text-slate-400">۲ ساعت دیگر</p>
            </div>
            <div class="rounded-xl p-3 hover:bg-slate-50 dark:hover:bg-slate-800">
                <p class="text-xs font-bold">۳ کار امروز تکمیل شد 🎉</p>
                <p class="mt-1 text-[10px] text-slate-400">امروز</p>
            </div>
        </div>
    </div>
    <div x-show="mobileMenu" x-cloak x-transition
        class="border-t border-slate-200 bg-white px-4 py-4 dark:border-slate-800 dark:bg-slate-950 lg:hidden">
        <nav class="grid gap-1 sm:grid-cols-2">
            @foreach ([['/dashboard', '⌂', 'Dashboard', 'داشبورد'], ['/tasks', '✓', 'Tasks', 'کارها'], ['/calendar', '▣', 'Calendar', 'تقویم'], ['/categories', '#', 'Categories', 'دسته‌بندی‌ها'], ['/profile', '◎', 'Profile', 'پروفایل']] as $item)
                <a @click="mobileMenu=false" href="{{ url($item[0]) }}"
                    class="rounded-xl px-4 py-3 text-sm font-bold hover:bg-indigo-50 dark:hover:bg-indigo-500/10">{{ $item[1] }}
                    &nbsp; {{ $item[2] }} <span class="text-[10px] text-slate-400">{{ $item[3] }}</span></a>
            @endforeach
        </nav>
    </div>
</header>
