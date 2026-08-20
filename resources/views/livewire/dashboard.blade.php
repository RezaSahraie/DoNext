<div class="space-y-6">
    {{-- Welcome --}}
    <section
        class="relative overflow-hidden rounded-3xl bg-gradient-to-br from-indigo-600 via-violet-600 to-indigo-800 p-6 text-white shadow-xl shadow-indigo-500/10 sm:p-8">
        <div class="relative z-10 max-w-2xl">
            <span class="inline-flex rounded-full bg-white/10 px-3 py-1 text-xs font-bold ring-1 ring-white/15">
                {{ now()->format('l, M d, Y') }}
            </span>

            <h2 class="mt-4 text-3xl font-black tracking-tight sm:text-4xl">
                عصر بخیر، {{ $user->name }} 👋
            </h2>

            <p class="mt-3 max-w-xl text-sm leading-7 text-indigo-100">
                امروز هم یک قدم دیگر به هدف‌هایت نزدیک شو. کارهای مهمت را انجام بده و روزت را با موفقیت تمام کن.
            </p>

            <a href="{{ url('/tasks') }}"
                class="mt-6 inline-flex items-center gap-2 rounded-xl bg-white px-5 py-3 text-sm font-black text-indigo-700 shadow-lg transition hover:-translate-y-0.5">
                <span class="text-lg">+</span>
                <span>کار جدید</span>
            </a>
        </div>

        <div class="absolute -end-12 -top-20 h-64 w-64 rounded-full bg-white/10 blur-2xl"></div>
        <div class="absolute -bottom-24 end-24 h-48 w-48 rounded-full bg-cyan-300/10 blur-3xl"></div>
    </section>

    {{-- Stats --}}
    <section class="w-full gap-4"
        style="display: grid; grid-template-columns: repeat(4, minmax(0, 1fr)); width: 100%;">

        <div class="rounded-2xl border border-slate-200 bg-white p-5 shadow-sm dark:border-slate-800 dark:bg-slate-900"
            style="min-width: 0;">
            <div class="mb-4 flex items-center justify-between">
                <div
                    class="grid h-11 w-11 place-items-center rounded-xl bg-indigo-50 text-indigo-600 dark:bg-indigo-500/10 dark:text-indigo-400">
                    ✓
                </div>
                <span
                    class="rounded-full bg-slate-100 px-2.5 py-1 text-[10px] font-bold text-slate-500 dark:bg-slate-800">
                    همه
                </span>
            </div>
            <p class="text-sm font-medium text-slate-500 dark:text-slate-400">کل کارها</p>
            <p class="mt-1 text-3xl font-black text-slate-900 dark:text-white">{{ $totalTasks }}</p>
        </div>

        <div class="rounded-2xl border border-slate-200 bg-white p-5 shadow-sm dark:border-slate-800 dark:bg-slate-900"
            style="min-width: 0;">
            <div class="mb-4 flex items-center justify-between">
                <div
                    class="grid h-11 w-11 place-items-center rounded-xl bg-emerald-50 text-emerald-600 dark:bg-emerald-500/10 dark:text-emerald-400">
                    ✓
                </div>
                <span
                    class="rounded-full bg-emerald-50 px-2.5 py-1 text-[10px] font-bold text-emerald-600 dark:bg-emerald-500/10 dark:text-emerald-400">
                    انجام شده
                </span>
            </div>
            <p class="text-sm font-medium text-slate-500 dark:text-slate-400">انجام شده</p>
            <p class="mt-1 text-3xl font-black text-emerald-600 dark:text-emerald-400">{{ $completedTasks }}</p>
        </div>

        <div class="rounded-2xl border border-slate-200 bg-white p-5 shadow-sm dark:border-slate-800 dark:bg-slate-900"
            style="min-width: 0;">
            <div class="mb-4 flex items-center justify-between">
                <div
                    class="grid h-11 w-11 place-items-center rounded-xl bg-amber-50 text-amber-600 dark:bg-amber-500/10 dark:text-amber-400">
                    ◷
                </div>
                <span
                    class="rounded-full bg-amber-50 px-2.5 py-1 text-[10px] font-bold text-amber-600 dark:bg-amber-500/10 dark:text-amber-400">
                    امروز
                </span>
            </div>
            <p class="text-sm font-medium text-slate-500 dark:text-slate-400">کارهای امروز</p>
            <p class="mt-1 text-3xl font-black text-amber-600 dark:text-amber-400">{{ $todayTasks }}</p>
        </div>

        <div class="rounded-2xl border border-slate-200 bg-white p-5 shadow-sm dark:border-slate-800 dark:bg-slate-900"
            style="min-width: 0;">
            <div class="mb-4 flex items-center justify-between">
                <div
                    class="grid h-11 w-11 place-items-center rounded-xl bg-violet-50 text-violet-600 dark:bg-violet-500/10 dark:text-violet-400">
                    ◒
                </div>
                <span
                    class="rounded-full bg-violet-50 px-2.5 py-1 text-[10px] font-bold text-violet-600 dark:bg-violet-500/10 dark:text-violet-400">
                    نرخ
                </span>
            </div>
            <p class="text-sm font-medium text-slate-500 dark:text-slate-400">نرخ تکمیل</p>
            <p class="mt-1 text-3xl font-black text-violet-600 dark:text-violet-400">
                {{ number_format($completionRate, 2) }}%
            </p>
        </div>
    </section>

    <div class="grid gap-6 xl:grid-cols-3">
        {{-- Today's tasks --}}
        <section
            class="overflow-hidden rounded-2xl border border-slate-200 bg-white shadow-sm xl:col-span-2 dark:border-slate-800 dark:bg-slate-900">

            <div class="flex items-center justify-between border-b border-slate-100 px-5 py-5 dark:border-slate-800">
                <div>
                    <h3 class="font-black">کارهای امروز</h3>
                    <p class="mt-1 text-xs text-slate-400">
                        {{ $todayRemaining }} کار باقی مانده
                    </p>
                </div>

                <a href="{{ url('/tasks') }}" class="text-xs font-bold text-indigo-600 dark:text-indigo-400">
                    مشاهده همه ←
                </a>
            </div>

            <div class="divide-y divide-slate-100 dark:divide-slate-800">
                @forelse ($todaysTaskList as $task)
                    <div class="flex items-center gap-4 px-5 py-4 transition hover:bg-slate-50 dark:hover:bg-slate-800/50">
                        <div
                            class="grid h-6 w-6 shrink-0 place-items-center rounded-full border-2
                            {{ $task->status === 'completed'
                                ? 'border-emerald-500 bg-emerald-500 text-white'
                                : 'border-slate-300 text-transparent dark:border-slate-600' }}">
                            ✓
                        </div>

                        <div class="min-w-0 flex-1">
                            <h4 @class([
                                'truncate text-sm font-bold',
                                'text-slate-400 line-through' => $task->status === 'completed',
                                'text-slate-900 dark:text-white' => $task->status !== 'completed',
                            ])>
                                {{ $task->title }}
                            </h4>

                            <p class="mt-1 text-xs text-slate-400">
                                @if ($task->due_date)
                                    {{ $task->due_date }}
                                @else
                                    —
                                @endif

                                @if ($task->category)
                                    · {{ $task->category->name }}
                                @endif
                            </p>
                        </div>

                        @if ($task->priority === 'high')
                            <span
                                class="hidden rounded-full bg-rose-50 px-2.5 py-1 text-[10px] font-bold text-rose-600 dark:bg-rose-500/10 dark:text-rose-400 sm:block">
                                زیاد
                            </span>
                        @elseif ($task->priority === 'medium')
                            <span
                                class="hidden rounded-full bg-amber-50 px-2.5 py-1 text-[10px] font-bold text-amber-600 dark:bg-amber-500/10 dark:text-amber-400 sm:block">
                                متوسط
                            </span>
                        @else
                            <span
                                class="hidden rounded-full bg-emerald-50 px-2.5 py-1 text-[10px] font-bold text-emerald-600 dark:bg-emerald-500/10 dark:text-emerald-400 sm:block">
                                کم
                            </span>
                        @endif
                    </div>
                @empty
                    <div class="px-5 py-10 text-center">
                        <p class="text-sm font-bold text-slate-700 dark:text-slate-200">
                            کاری برای امروز نداری
                        </p>
                        <p class="mt-1 text-xs text-slate-400">
                            یک کار با تاریخ امروز بساز
                        </p>
                        <a href="{{ url('/tasks') }}"
                            class="mt-4 inline-flex rounded-xl bg-indigo-600 px-4 py-2 text-xs font-bold text-white hover:bg-indigo-700">
                            رفتن به کارها
                        </a>
                    </div>
                @endforelse
            </div>
        </section>

        {{-- Weekly progress --}}
        <section
            class="rounded-2xl border border-slate-200 bg-white p-5 shadow-sm dark:border-slate-800 dark:bg-slate-900">
            <div class="flex items-start justify-between">
                <div>
                    <h3 class="font-black">پیشرفت هفتگی</h3>
                    <p class="mt-1 text-xs text-slate-400">عملکرد این هفته</p>
                </div>

                <span
                    class="rounded-full bg-emerald-50 px-2.5 py-1 text-xs font-bold text-emerald-600 dark:bg-emerald-500/10 dark:text-emerald-400">
                    {{ $weeklyRate }}%
                </span>
            </div>

            <div class="my-7 flex items-center gap-5">
                <div class="relative grid h-32 w-32 shrink-0 place-items-center rounded-full"
                    style="background: conic-gradient(#4f46e5 0 {{ $weeklyRate }}%, #e2e8f0 {{ $weeklyRate }}% 100%)">
                    <div class="grid h-24 w-24 place-items-center rounded-full bg-white dark:bg-slate-900">
                        <span class="text-2xl font-black">{{ $weeklyRate }}%</span>
                    </div>
                </div>

                <div>
                    <p class="text-sm font-bold">
                        {{ $weeklyCompleted }} از {{ $weeklyTotal }} کار
                    </p>
                    <p class="mt-2 text-xs leading-5 text-slate-400">
                        بر اساس کارهای دارای موعد در این هفته
                    </p>
                </div>
            </div>

            <div class="flex h-24 items-end gap-2">
                @foreach ($weeklyBars as $index => $count)
                    @php
                        $height = (int) round(($count / $maxBar) * 100);
                        $labels = ['ش', 'ی', 'د', 'س', 'چ', 'پ', 'ج'];
                    @endphp

                    <div class="flex h-full flex-1 flex-col justify-end gap-2">
                        <div class="rounded-t-lg bg-indigo-500/70"
                            style="height: {{ max($height, $count > 0 ? 8 : 4) }}%"></div>
                        <span class="text-center text-[9px] text-slate-400">
                            {{ $labels[$index] }}
                        </span>
                    </div>
                @endforeach
            </div>
        </section>
    </div>

    {{-- Upcoming --}}
    <section
        class="rounded-2xl border border-slate-200 bg-white p-5 shadow-sm dark:border-slate-800 dark:bg-slate-900">
        <div class="mb-5 flex items-center justify-between">
            <div>
                <h3 class="font-black">کارهای پیش رو</h3>
                <p class="mt-1 text-xs text-slate-400">برنامه روزهای آینده</p>
            </div>

            <a href="{{ url('/calendar') }}" class="text-xs font-bold text-indigo-600 dark:text-indigo-400">
                تقویم ←
            </a>
        </div>

        <div class="grid gap-3 md:grid-cols-3">
            @forelse ($upcomingTasks as $task)
                <div
                    class="rounded-2xl border border-slate-100 bg-slate-50 p-4 dark:border-slate-800 dark:bg-slate-800/50">
                    <div class="flex items-center justify-between gap-2">
                        <span class="text-xs font-bold text-indigo-600 dark:text-indigo-400">
                            {{ $task->due_date->format('Y-m-d') }}
                        </span>
                        <span class="text-[10px] text-slate-400">
                            {{ $task->due_date->diffForHumans() }}
                        </span>
                    </div>

                    <h4 class="mt-3 truncate text-sm font-bold text-slate-900 dark:text-white">
                        {{ $task->title }}
                    </h4>

                    @if ($task->category)
                        <p class="mt-1 truncate text-xs text-slate-400">
                            {{ $task->category->name }}
                        </p>
                    @endif
                </div>
            @empty
                <div
                    class="md:col-span-3 rounded-2xl border border-dashed border-slate-200 px-4 py-8 text-center dark:border-slate-700">
                    <p class="text-sm font-bold text-slate-700 dark:text-slate-200">
                        کار پیش‌رویی نداری
                    </p>
                    <p class="mt-1 text-xs text-slate-400">
                        برای روزهای بعد یک کار با تاریخ بساز
                    </p>
                </div>
            @endforelse
        </div>
    </section>
</div>
