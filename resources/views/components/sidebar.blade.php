<aside
    x-data="{ open: false }"
    class="fixed inset-y-0 start-0 z-50 hidden w-72 flex-col border-e border-slate-200 bg-white/90 p-5 backdrop-blur-xl transition-all duration-300 dark:border-slate-800 dark:bg-slate-950/90 lg:flex"
>
    {{-- Logo --}}
    <div class="mb-8 flex items-center justify-between">
        <a
            href="{{ url('/dashboard') }}"
            class="flex items-center gap-3"
        >
            <div
                class="grid h-11 w-11 place-items-center rounded-2xl bg-indigo-600 text-xl font-black text-white shadow-lg shadow-indigo-500/25"
            >
                D
            </div>

            <div>
                <h1 class="text-lg font-black tracking-tight">
                    DoNext
                </h1>

                <p class="text-[11px] font-medium text-slate-400">
                    Get things done.
                </p>
            </div>
        </a>
    </div>

    {{-- Workspace --}}
    <div class="mb-3 px-3">
        <span
            class="text-[11px] font-bold uppercase tracking-widest text-slate-400"
        >
            Workspace
        </span>
    </div>

    {{-- Navigation --}}
    <nav class="space-y-1">

        {{-- Dashboard --}}
        <a
            href="{{ url('/dashboard') }}"
            class="group flex items-center gap-3 rounded-xl px-3 py-3 text-sm font-semibold text-slate-600 transition hover:bg-indigo-50 hover:text-indigo-600 dark:text-slate-300 dark:hover:bg-indigo-500/10 dark:hover:text-indigo-400"
        >
            <span
                class="grid h-9 w-9 place-items-center rounded-lg bg-slate-100 text-base transition group-hover:bg-indigo-100 dark:bg-slate-800 dark:group-hover:bg-indigo-500/20"
            >
                ⌂
            </span>

            <span>Dashboard</span>
        </a>

        {{-- Tasks --}}
        <a
            href="{{ url('/tasks') }}"
            class="group flex items-center gap-3 rounded-xl px-3 py-3 text-sm font-semibold text-slate-600 transition hover:bg-indigo-50 hover:text-indigo-600 dark:text-slate-300 dark:hover:bg-indigo-500/10 dark:hover:text-indigo-400"
        >
            <span
                class="grid h-9 w-9 place-items-center rounded-lg bg-slate-100 text-base transition group-hover:bg-indigo-100 dark:bg-slate-800 dark:group-hover:bg-indigo-500/20"
            >
                ✓
            </span>

            <span>Tasks</span>

            <span
                class="ms-auto rounded-full bg-indigo-100 px-2 py-0.5 text-[10px] font-bold text-indigo-600 dark:bg-indigo-500/20 dark:text-indigo-400"
            >
                12
            </span>
        </a>

        {{-- Calendar --}}
        <a
            href="{{ url('/calendar') }}"
            class="group flex items-center gap-3 rounded-xl px-3 py-3 text-sm font-semibold text-slate-600 transition hover:bg-indigo-50 hover:text-indigo-600 dark:text-slate-300 dark:hover:bg-indigo-500/10 dark:hover:text-indigo-400"
        >
            <span
                class="grid h-9 w-9 place-items-center rounded-lg bg-slate-100 text-base transition group-hover:bg-indigo-100 dark:bg-slate-800 dark:group-hover:bg-indigo-500/20"
            >
                ▣
            </span>

            <span>Calendar</span>
        </a>

        {{-- Categories --}}
        <a
            href="{{ url('/categories') }}"
            class="group flex items-center gap-3 rounded-xl px-3 py-3 text-sm font-semibold text-slate-600 transition hover:bg-indigo-50 hover:text-indigo-600 dark:text-slate-300 dark:hover:bg-indigo-500/10 dark:hover:text-indigo-400"
        >
            <span
                class="grid h-9 w-9 place-items-center rounded-lg bg-slate-100 text-base transition group-hover:bg-indigo-100 dark:bg-slate-800 dark:group-hover:bg-indigo-500/20"
            >
                #
            </span>

            <span>Categories</span>
        </a>

        {{-- Statistics --}}
        <a
            href="{{ url('/statistics') }}"
            class="group flex items-center gap-3 rounded-xl px-3 py-3 text-sm font-semibold text-slate-600 transition hover:bg-indigo-50 hover:text-indigo-600 dark:text-slate-300 dark:hover:bg-indigo-500/10 dark:hover:text-indigo-400"
        >
            <span
                class="grid h-9 w-9 place-items-center rounded-lg bg-slate-100 text-base transition group-hover:bg-indigo-100 dark:bg-slate-800 dark:group-hover:bg-indigo-500/20"
            >
                ◒
            </span>

            <span>Statistics</span>
        </a>

    </nav>

    {{-- Divider --}}
    <div class="my-6 border-t border-slate-200 dark:border-slate-800"></div>

    {{-- Personal --}}
    <div class="mb-3 px-3">
        <span
            class="text-[11px] font-bold uppercase tracking-widest text-slate-400"
        >
            Personal
        </span>
    </div>

    <nav class="space-y-1">

        {{-- Profile --}}
        <a
            href="{{ url('/profile') }}"
            class="group flex items-center gap-3 rounded-xl px-3 py-3 text-sm font-semibold text-slate-600 transition hover:bg-slate-100 hover:text-slate-900 dark:text-slate-300 dark:hover:bg-slate-800 dark:hover:text-white"
        >
            <span
                class="grid h-9 w-9 place-items-center rounded-lg bg-slate-100 dark:bg-slate-800"
            >
                ◎
            </span>

            <span>Profile</span>
        </a>

        {{-- Settings --}}
        <a
            href="{{ url('/settings') }}"
            class="group flex items-center gap-3 rounded-xl px-3 py-3 text-sm font-semibold text-slate-600 transition hover:bg-slate-100 hover:text-slate-900 dark:text-slate-300 dark:hover:bg-slate-800 dark:hover:text-white"
        >
            <span
                class="grid h-9 w-9 place-items-center rounded-lg bg-slate-100 dark:bg-slate-800"
            >
                ⚙
            </span>

            <span>Settings</span>
        </a>

    </nav>

    {{-- Bottom user card --}}
    <div class="mt-auto">

        <div
            class="rounded-2xl border border-slate-200 bg-slate-50 p-3 dark:border-slate-800 dark:bg-slate-900"
        >
            <div class="flex items-center gap-3">

                <div
                    class="grid h-10 w-10 shrink-0 place-items-center rounded-xl bg-indigo-100 font-bold text-indigo-700 dark:bg-indigo-500/20 dark:text-indigo-300"
                >
                    R
                </div>

                <div class="min-w-0">
                    <p class="truncate text-sm font-bold">
                        Reza
                    </p>

                    <p class="truncate text-xs text-slate-400">
                        Free Plan
                    </p>
                </div>

                <button
                    class="ms-auto text-slate-400 transition hover:text-slate-700 dark:hover:text-white"
                >
                    ⋮
                </button>

            </div>
        </div>

    </div>

</aside>