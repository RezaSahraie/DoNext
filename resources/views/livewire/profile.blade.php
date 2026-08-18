<div class="mx-auto max-w-5xl space-y-6">

    {{-- Profile Header --}}
    <section
        class="overflow-hidden rounded-3xl border border-slate-200 bg-white shadow-sm dark:border-slate-800 dark:bg-slate-900">

        <div class="h-36 bg-gradient-to-r from-indigo-600 via-violet-500 to-cyan-400"></div>

        <div class="px-6 pb-6">
            <div class="flex flex-col gap-4 sm:flex-row sm:items-end sm:justify-between">
                {{-- Avatar: first letter of name --}}
                <div
                    class="-mt-14 grid h-28 w-28 place-items-center rounded-3xl border-8 border-white bg-indigo-100 text-4xl font-black text-indigo-700 shadow-xl dark:border-slate-900 dark:bg-indigo-500/20 dark:text-indigo-300">
                    {{ mb_strtoupper(mb_substr($user->name, 0, 1)) }}
                </div>
            </div>

            <h2 class="mt-4 text-2xl font-black">
                {{ $user->name }}
            </h2>

            <p class="mt-1 text-sm text-slate-400">
                {{ $user->email }}
                ·
                عضو از {{ $user->created_at->format('Y-d-m') }}
            </p>
        </div>
    </section>

    <div class="grid gap-6 lg:grid-cols-3">

        {{-- Personal info (read-only for now) --}}
        <section
            class="rounded-2xl border border-slate-200 bg-white p-6 shadow-sm lg:col-span-2 dark:border-slate-800 dark:bg-slate-900">
            <h3 class="font-black">
                اطلاعات شخصی
            </h3>

            <div class="mt-6 grid gap-4 sm:grid-cols-2">
                <div>
                    <p class="text-xs font-bold text-slate-500">نام</p>
                    <p class="mt-2 text-sm font-semibold">{{ $user->name }}</p>
                </div>

                <div>
                    <p class="text-xs font-bold text-slate-500">ایمیل</p>
                    <p class="mt-2 text-sm font-semibold">{{ $user->email }}</p>
                </div>
            </div>
        </section>

        {{-- Activity stats --}}
        <aside
            class="rounded-2xl border border-slate-200 bg-white p-6 shadow-sm dark:border-slate-800 dark:bg-slate-900">
            <h3 class="font-black">
                فعالیت
            </h3>

            <div class="mt-6 space-y-5">
                <div>
                    <p class="text-3xl font-black">{{ $totalTasks }}</p>
                    <p class="text-xs text-slate-400">کل کارها</p>
                </div>

                <div>
                    <p class="text-3xl font-black text-emerald-600 dark:text-emerald-400">
                        {{ $completedTasks }}
                    </p>
                    <p class="text-xs text-slate-400">انجام شده</p>
                </div>

                <div>
                    <p class="text-3xl font-black text-indigo-600 dark:text-indigo-400">
                        {{ $completionRate }}%
                    </p>
                    <p class="text-xs text-slate-400">نرخ تکمیل</p>
                </div>
            </div>
        </aside>

    </div>
</div>