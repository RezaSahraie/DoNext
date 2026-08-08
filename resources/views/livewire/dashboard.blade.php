<div>

    {{-- Welcome Section --}}
    <div class="mb-8 flex flex-col justify-between gap-5 md:flex-row md:items-end">

        <div>
            <p class="mb-2 text-sm font-semibold text-indigo-600 dark:text-indigo-400">
                شنبه، ۱۸ مرداد ۱۴۰۵
            </p>

            <h2 class="text-3xl font-black tracking-tight text-slate-900 dark:text-white sm:text-4xl">
                عصر بخیر، رضا 👋
            </h2>

            <p class="mt-2 max-w-xl text-sm leading-6 text-slate-500 dark:text-slate-400">
                امروز هم یک قدم دیگر به هدف‌هایت نزدیک شو.
                کارهای مهمت را انجام بده و روزت را با موفقیت تمام کن.
            </p>
        </div>

        <button
            class="inline-flex items-center justify-center gap-2 rounded-2xl bg-indigo-600 px-5 py-3 text-sm font-bold text-white shadow-lg shadow-indigo-500/20 transition hover:-translate-y-0.5 hover:bg-indigo-700"
        >
            <span class="text-lg">+</span>
            کار جدید
        </button>

    </div>


    {{-- Statistics --}}
    <div class="mb-8 grid grid-cols-1 gap-4 sm:grid-cols-2 xl:grid-cols-4">

        {{-- Total Tasks --}}
        <div
            class="group rounded-2xl border border-slate-200 bg-white p-5 shadow-sm transition hover:-translate-y-1 hover:shadow-lg dark:border-slate-800 dark:bg-slate-900"
        >
            <div class="mb-5 flex items-start justify-between">

                <div
                    class="grid h-11 w-11 place-items-center rounded-xl bg-indigo-50 text-xl text-indigo-600 dark:bg-indigo-500/10 dark:text-indigo-400"
                >
                    ✓
                </div>

                <span
                    class="rounded-full bg-emerald-50 px-2.5 py-1 text-xs font-bold text-emerald-600 dark:bg-emerald-500/10 dark:text-emerald-400"
                >
                    +12%
                </span>

            </div>

            <p class="text-sm font-medium text-slate-500 dark:text-slate-400">
                کل کارها
            </p>

            <h3 class="mt-1 text-3xl font-black">
                24
            </h3>

        </div>


        {{-- Completed --}}
        <div
            class="group rounded-2xl border border-slate-200 bg-white p-5 shadow-sm transition hover:-translate-y-1 hover:shadow-lg dark:border-slate-800 dark:bg-slate-900"
        >

            <div class="mb-5 flex items-start justify-between">

                <div
                    class="grid h-11 w-11 place-items-center rounded-xl bg-emerald-50 text-xl text-emerald-600 dark:bg-emerald-500/10 dark:text-emerald-400"
                >
                    ✓
                </div>

                <span
                    class="rounded-full bg-emerald-50 px-2.5 py-1 text-xs font-bold text-emerald-600 dark:bg-emerald-500/10 dark:text-emerald-400"
                >
                    +8%
                </span>

            </div>

            <p class="text-sm font-medium text-slate-500 dark:text-slate-400">
                انجام شده
            </p>

            <h3 class="mt-1 text-3xl font-black">
                16
            </h3>

        </div>


        {{-- Today --}}
        <div
            class="group rounded-2xl border border-slate-200 bg-white p-5 shadow-sm transition hover:-translate-y-1 hover:shadow-lg dark:border-slate-800 dark:bg-slate-900"
        >

            <div class="mb-5 flex items-start justify-between">

                <div
                    class="grid h-11 w-11 place-items-center rounded-xl bg-amber-50 text-xl text-amber-600 dark:bg-amber-500/10 dark:text-amber-400"
                >
                    ◷
                </div>

                <span
                    class="rounded-full bg-amber-50 px-2.5 py-1 text-xs font-bold text-amber-600 dark:bg-amber-500/10 dark:text-amber-400"
                >
                    امروز
                </span>

            </div>

            <p class="text-sm font-medium text-slate-500 dark:text-slate-400">
                کارهای امروز
            </p>

            <h3 class="mt-1 text-3xl font-black">
                8
            </h3>

        </div>


        {{-- Completion --}}
        <div
            class="group rounded-2xl border border-slate-200 bg-white p-5 shadow-sm transition hover:-translate-y-1 hover:shadow-lg dark:border-slate-800 dark:bg-slate-900"
        >

            <div class="mb-5 flex items-start justify-between">

                <div
                    class="grid h-11 w-11 place-items-center rounded-xl bg-violet-50 text-xl text-violet-600 dark:bg-violet-500/10 dark:text-violet-400"
                >
                    ◒
                </div>

                <span
                    class="rounded-full bg-violet-50 px-2.5 py-1 text-xs font-bold text-violet-600 dark:bg-violet-500/10 dark:text-violet-400"
                >
                    این هفته
                </span>

            </div>

            <p class="text-sm font-medium text-slate-500 dark:text-slate-400">
                نرخ تکمیل
            </p>

            <h3 class="mt-1 text-3xl font-black">
                67%
            </h3>

        </div>

    </div>


    {{-- Main Grid --}}
    <div class="grid grid-cols-1 gap-6 xl:grid-cols-3">


        {{-- Today's Tasks --}}
        <section
            class="overflow-hidden rounded-2xl border border-slate-200 bg-white shadow-sm dark:border-slate-800 dark:bg-slate-900 xl:col-span-2"
        >

            {{-- Header --}}
            <div class="flex items-center justify-between border-b border-slate-200 px-5 py-5 dark:border-slate-800">

                <div>
                    <h3 class="font-black">
                        کارهای امروز
                    </h3>

                    <p class="mt-1 text-xs text-slate-400">
                        ۳ کار باقی مانده
                    </p>
                </div>

                <a
                    href="{{ url('/tasks') }}"
                    class="text-xs font-bold text-indigo-600 hover:text-indigo-700 dark:text-indigo-400"
                >
                    مشاهده همه
                </a>

            </div>


            {{-- Tasks --}}
            <div class="divide-y divide-slate-100 dark:divide-slate-800">

                {{-- Task 1 --}}
                <div
                    class="group flex items-center gap-4 px-5 py-4 transition hover:bg-slate-50 dark:hover:bg-slate-800/50"
                >

                    <button
                        class="grid h-6 w-6 shrink-0 place-items-center rounded-full border-2 border-slate-300 text-transparent transition hover:border-indigo-500 hover:bg-indigo-500 hover:text-white dark:border-slate-600"
                    >
                        ✓
                    </button>

                    <div class="min-w-0 flex-1">

                        <h4 class="truncate text-sm font-bold">
                            تکمیل پروژه Laravel
                        </h4>

                        <div class="mt-1 flex items-center gap-2 text-xs text-slate-400">

                            <span>
                                امروز
                            </span>

                            <span>•</span>

                            <span>
                                ۱۸:۰۰
                            </span>

                        </div>

                    </div>

                    <span
                        class="hidden rounded-full bg-rose-50 px-2.5 py-1 text-[10px] font-bold text-rose-600 dark:bg-rose-500/10 dark:text-rose-400 sm:block"
                    >
                        زیاد
                    </span>

                    <button
                        class="text-slate-300 transition hover:text-slate-600 dark:hover:text-slate-200"
                    >
                        ⋮
                    </button>

                </div>


                {{-- Task 2 --}}
                <div
                    class="group flex items-center gap-4 px-5 py-4 transition hover:bg-slate-50 dark:hover:bg-slate-800/50"
                >

                    <button
                        class="grid h-6 w-6 shrink-0 place-items-center rounded-full border-2 border-slate-300 text-transparent transition hover:border-indigo-500 hover:bg-indigo-500 hover:text-white dark:border-slate-600"
                    >
                        ✓
                    </button>

                    <div class="min-w-0 flex-1">

                        <h4 class="truncate text-sm font-bold">
                            مطالعه Livewire
                        </h4>

                        <div class="mt-1 flex items-center gap-2 text-xs text-slate-400">

                            <span>
                                امروز
                            </span>

                            <span>•</span>

                            <span>
                                ۲۰:۰۰
                            </span>

                        </div>

                    </div>

                    <span
                        class="hidden rounded-full bg-amber-50 px-2.5 py-1 text-[10px] font-bold text-amber-600 dark:bg-amber-500/10 dark:text-amber-400 sm:block"
                    >
                        متوسط
                    </span>

                    <button
                        class="text-slate-300 transition hover:text-slate-600 dark:hover:text-slate-200"
                    >
                        ⋮
                    </button>

                </div>


                {{-- Task 3 --}}
                <div
                    class="group flex items-center gap-4 px-5 py-4 transition hover:bg-slate-50 dark:hover:bg-slate-800/50"
                >

                    <button
                        class="grid h-6 w-6 shrink-0 place-items-center rounded-full border-2 border-slate-300 text-transparent transition hover:border-indigo-500 hover:bg-indigo-500 hover:text-white dark:border-slate-600"
                    >
                        ✓
                    </button>

                    <div class="min-w-0 flex-1">

                        <h4 class="truncate text-sm font-bold">
                            طراحی داشبورد DoNext
                        </h4>

                        <div class="mt-1 flex items-center gap-2 text-xs text-slate-400">

                            <span>
                                فردا
                            </span>

                            <span>•</span>

                            <span>
                                ۱۰:۰۰
                            </span>

                        </div>

                    </div>

                    <span
                        class="hidden rounded-full bg-emerald-50 px-2.5 py-1 text-[10px] font-bold text-emerald-600 dark:bg-emerald-500/10 dark:text-emerald-400 sm:block"
                    >
                        کم
                    </span>

                    <button
                        class="text-slate-300 transition hover:text-slate-600 dark:hover:text-slate-200"
                    >
                        ⋮
                    </button>

                </div>

            </div>

        </section>


        {{-- Weekly Progress --}}
        <section
            class="rounded-2xl border border-slate-200 bg-white p-5 shadow-sm dark:border-slate-800 dark:bg-slate-900"
        >

            <div class="mb-6 flex items-start justify-between">

                <div>
                    <h3 class="font-black">
                        پیشرفت هفتگی
                    </h3>

                    <p class="mt-1 text-xs text-slate-400">
                        عملکرد این هفته
                    </p>
                </div>

                <span
                    class="rounded-full bg-indigo-50 px-2.5 py-1 text-xs font-bold text-indigo-600 dark:bg-indigo-500/10 dark:text-indigo-400"
                >
                    +18%
                </span>

            </div>


            {{-- Progress --}}
            <div class="mb-6">

                <div class="mb-2 flex items-end justify-between">

                    <span class="text-3xl font-black">
                        67%
                    </span>

                    <span class="text-xs text-slate-400">
                        16 از 24
                    </span>

                </div>

                <div class="h-2 overflow-hidden rounded-full bg-slate-100 dark:bg-slate-800">

                    <div
                        class="h-full w-[67%] rounded-full bg-indigo-600"
                    ></div>

                </div>

            </div>


            {{-- Mini chart --}}
            <div class="flex h-32 items-end justify-between gap-2">

                <div class="flex h-full flex-1 flex-col justify-end gap-2">
                    <div class="h-[45%] rounded-t-lg bg-indigo-100 dark:bg-indigo-500/20"></div>
                    <span class="text-center text-[10px] text-slate-400">ش</span>
                </div>

                <div class="flex h-full flex-1 flex-col justify-end gap-2">
                    <div class="h-[65%] rounded-t-lg bg-indigo-200 dark:bg-indigo-500/30"></div>
                    <span class="text-center text-[10px] text-slate-400">ی</span>
                </div>

                <div class="flex h-full flex-1 flex-col justify-end gap-2">
                    <div class="h-[80%] rounded-t-lg bg-indigo-300 dark:bg-indigo-500/40"></div>
                    <span class="text-center text-[10px] text-slate-400">د</span>
                </div>

                <div class="flex h-full flex-1 flex-col justify-end gap-2">
                    <div class="h-[55%] rounded-t-lg bg-indigo-200 dark:bg-indigo-500/30"></div>
                    <span class="text-center text-[10px] text-slate-400">س</span>
                </div>

                <div class="flex h-full flex-1 flex-col justify-end gap-2">
                    <div class="h-[90%] rounded-t-lg bg-indigo-400 dark:bg-indigo-500/50"></div>
                    <span class="text-center text-[10px] text-slate-400">چ</span>
                </div>

                <div class="flex h-full flex-1 flex-col justify-end gap-2">
                    <div class="h-[70%] rounded-t-lg bg-indigo-300 dark:bg-indigo-500/40"></div>
                    <span class="text-center text-[10px] text-slate-400">پ</span>
                </div>

                <div class="flex h-full flex-1 flex-col justify-end gap-2">
                    <div class="h-[35%] rounded-t-lg bg-indigo-100 dark:bg-indigo-500/20"></div>
                    <span class="text-center text-[10px] text-slate-400">ج</span>
                </div>

            </div>

        </section>

    </div>


    {{-- Upcoming --}}
    <section
        class="mt-6 rounded-2xl border border-slate-200 bg-white shadow-sm dark:border-slate-800 dark:bg-slate-900"
    >

        <div class="flex items-center justify-between border-b border-slate-200 px-5 py-5 dark:border-slate-800">

            <div>
                <h3 class="font-black">
                    کارهای آینده
                </h3>

                <p class="mt-1 text-xs text-slate-400">
                    برنامه روزهای آینده
                </p>
            </div>

            <a
                href="{{ url('/calendar') }}"
                class="text-xs font-bold text-indigo-600 hover:text-indigo-700 dark:text-indigo-400"
            >
                تقویم
            </a>

        </div>


        <div class="grid grid-cols-1 divide-y divide-slate-100 dark:divide-slate-800 md:grid-cols-3 md:divide-x md:divide-y-0 md:dark:divide-slate-800">

            {{-- Upcoming 1 --}}
            <div class="p-5">

                <div class="mb-4 flex items-center gap-3">

                    <div
                        class="grid h-11 w-11 place-items-center rounded-xl bg-indigo-50 text-xs font-black text-indigo-600 dark:bg-indigo-500/10 dark:text-indigo-400"
                    >
                        ۰۸
                    </div>

                    <div>
                        <p class="text-xs text-slate-400">
                            مرداد
                        </p>

                        <p class="text-sm font-bold">
                            امروز
                        </p>
                    </div>

                </div>

                <h4 class="text-sm font-bold">
                    تکمیل پروژه DoNext
                </h4>

                <p class="mt-1 text-xs text-slate-400">
                    ۱۸:۰۰
                </p>

            </div>


            {{-- Upcoming 2 --}}
            <div class="p-5">

                <div class="mb-4 flex items-center gap-3">

                    <div
                        class="grid h-11 w-11 place-items-center rounded-xl bg-violet-50 text-xs font-black text-violet-600 dark:bg-violet-500/10 dark:text-violet-400"
                    >
                        ۰۹
                    </div>

                    <div>
                        <p class="text-xs text-slate-400">
                            مرداد
                        </p>

                        <p class="text-sm font-bold">
                            فردا
                        </p>
                    </div>

                </div>

                <h4 class="text-sm font-bold">
                    مطالعه Laravel
                </h4>

                <p class="mt-1 text-xs text-slate-400">
                    ۱۰:۰۰
                </p>

            </div>


            {{-- Upcoming 3 --}}
            <div class="p-5">

                <div class="mb-4 flex items-center gap-3">

                    <div
                        class="grid h-11 w-11 place-items-center rounded-xl bg-emerald-50 text-xs font-black text-emerald-600 dark:bg-emerald-500/10 dark:text-emerald-400"
                    >
                        ۱۰
                    </div>

                    <div>
                        <p class="text-xs text-slate-400">
                            مرداد
                        </p>

                        <p class="text-sm font-bold">
                            دو روز دیگر
                        </p>
                    </div>

                </div>

                <h4 class="text-sm font-bold">
                    طراحی صفحه Tasks
                </h4>

                <p class="mt-1 text-xs text-slate-400">
                    ۱۴:۳۰
                </p>

            </div>

        </div>

    </section>

</div>