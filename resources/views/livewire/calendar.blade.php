@php
    $locale = app()->getLocale();
    $isFa = $locale === 'fa';
@endphp

@section('title', $isFa ? 'تقویم — DoNext' : 'Calendar — DoNext')
@section('heading', $isFa ? 'تقویم' : 'Calendar')

<div class="w-full min-w-0" dir="{{ $isFa ? 'rtl' : 'ltr' }}">
    {{-- Calendar toolbar --}}
    <section class="mb-6 rounded-2xl border border-slate-200 bg-white p-4 shadow-sm dark:border-slate-800 dark:bg-slate-900">
        <div class="flex flex-col gap-4 sm:flex-row sm:items-center sm:justify-between">
            <div class="flex flex-wrap items-center gap-2">
                <button
                    type="button"
                    wire:click="previousMonth"
                    wire:loading.attr="disabled"
                    aria-label="{{ $isFa ? 'ماه قبل' : 'Previous month' }}"
                    class="grid h-10 w-10 place-items-center rounded-xl bg-slate-100 text-lg font-bold text-slate-600 transition hover:bg-slate-200 disabled:opacity-50 dark:bg-slate-800 dark:text-slate-300 dark:hover:bg-slate-700"
                >
                    {{ $isFa ? '‹' : '‹' }}
                </button>

                <button
                    type="button"
                    wire:click="nextMonth"
                    wire:loading.attr="disabled"
                    aria-label="{{ $isFa ? 'ماه بعد' : 'Next month' }}"
                    class="grid h-10 w-10 place-items-center rounded-xl bg-slate-100 text-lg font-bold text-slate-600 transition hover:bg-slate-200 disabled:opacity-50 dark:bg-slate-800 dark:text-slate-300 dark:hover:bg-slate-700"
                >
                    {{ $isFa ? '›' : '›' }}
                </button>

                <button
                    type="button"
                    wire:click="goToToday"
                    wire:loading.attr="disabled"
                    class="rounded-xl bg-indigo-50 px-4 py-2.5 text-xs font-bold text-indigo-600 transition hover:bg-indigo-100 dark:bg-indigo-500/10 dark:text-indigo-400 dark:hover:bg-indigo-500/20"
                >
                    {{ $isFa ? 'امروز' : 'Today' }}
                </button>
            </div>

            <div class="min-w-0 text-center sm:text-end">
                <h2 class="truncate text-xl font-black text-slate-900 dark:text-white sm:text-2xl">
                    {{ $monthTitle }}
                </h2>
            </div>
        </div>
    </section>

    {{-- Calendar + selected day --}}
    <div class="grid min-w-0 grid-cols-1 gap-6 xl:grid-cols-4">
        {{-- The calendar must occupy three columns on desktop. --}}
        <section class="min-w-0 overflow-hidden rounded-2xl border border-slate-200 bg-white shadow-sm dark:border-slate-800 dark:bg-slate-900 xl:col-span-3">
            {{-- Keep the calendar grid LTR so columns never reverse or overlap when the app is Persian/RTL. --}}
            <div dir="ltr">
                <div class="grid grid-cols-7 border-b border-slate-200 dark:border-slate-800">
                    @php
                        $weekdays = $isFa
                            ? ['دوشنبه', 'سه‌شنبه', 'چهارشنبه', 'پنجشنبه', 'جمعه', 'شنبه', 'یکشنبه']
                            : ['Monday', 'Tuesday', 'Wednesday', 'Thursday', 'Friday', 'Saturday', 'Sunday'];
                    @endphp

                    @foreach ($weekdays as $weekday)
                        <div class="min-w-0 border-e border-slate-100 px-1 py-3 text-center text-[10px] font-bold text-slate-400 last:border-e-0 sm:px-2 sm:text-xs dark:border-slate-800">
                            {{ $weekday }}
                        </div>
                    @endforeach
                </div>

                <div class="grid grid-cols-7">
                    @foreach ($cells as $cell)
                        @if ($cell === null)
                            <div
                                wire:key="empty-{{ $loop->index }}"
                                class="min-h-24 border-b border-e border-slate-100 bg-slate-50/30 sm:min-h-28 dark:border-slate-800 dark:bg-slate-950/20"
                            ></div>
                        @else
                            <button
                                type="button"
                                wire:key="day-{{ $cell['date'] }}"
                                wire:click="selectDate('{{ $cell['date'] }}')"
                                class="group min-h-24 min-w-0 border-b border-e border-slate-100 p-2 text-start transition hover:bg-slate-50 focus:z-10 focus:outline-none focus:ring-2 focus:ring-inset focus:ring-indigo-500 sm:min-h-28 sm:p-3 dark:border-slate-800 dark:hover:bg-slate-800/50"
                                @class([
                                    'bg-indigo-50/80 dark:bg-indigo-500/10' => $selectedDate === $cell['date'],
                                ])
                            >
                                <div class="flex items-center justify-between gap-1">
                                    <span
                                        @class([
                                            'grid h-7 w-7 shrink-0 place-items-center rounded-lg text-xs font-bold transition',
                                            'bg-indigo-600 text-white shadow-sm shadow-indigo-500/20' => $selectedDate === $cell['date'],
                                            'bg-slate-900 text-white dark:bg-white dark:text-slate-900' => $cell['isToday'] && $selectedDate !== $cell['date'],
                                            'text-slate-500 dark:text-slate-400' => !$cell['isToday'] && $selectedDate !== $cell['date'],
                                        ])
                                    >
                                        {{ $cell['day'] }}
                                    </span>

                                    @if ($cell['tasks']->count() > 0)
                                        <span class="h-1.5 w-1.5 shrink-0 rounded-full bg-indigo-500"></span>
                                    @endif
                                </div>

                                <div class="mt-2 space-y-1">
                                    @foreach ($cell['tasks']->take(3) as $task)
                                        <div
                                            @class([
                                                'truncate rounded-md px-1.5 py-1 text-[9px] font-bold leading-4 sm:text-[10px]',
                                                'bg-emerald-50 text-emerald-600 dark:bg-emerald-500/10 dark:text-emerald-400' => $task->status === 'completed',
                                                'bg-rose-50 text-rose-600 dark:bg-rose-500/10 dark:text-rose-400' => $task->status !== 'completed' && $task->priority === 'high',
                                                'bg-amber-50 text-amber-600 dark:bg-amber-500/10 dark:text-amber-400' => $task->status !== 'completed' && $task->priority === 'medium',
                                                'bg-indigo-50 text-indigo-600 dark:bg-indigo-500/10 dark:text-indigo-400' => $task->status !== 'completed' && $task->priority === 'low',
                                            ])
                                        >
                                            {{ $task->title }}
                                        </div>
                                    @endforeach

                                    @if ($cell['tasks']->count() > 3)
                                        <p class="px-1 text-[9px] font-bold text-slate-400 sm:text-[10px]">
                                            +{{ $cell['tasks']->count() - 3 }}
                                        </p>
                                    @endif
                                </div>
                            </button>
                        @endif
                    @endforeach
                </div>
            </div>
        </section>

        {{-- Selected day sidebar --}}
        <aside
            dir="{{ $isFa ? 'rtl' : 'ltr' }}"
            class="min-w-0 rounded-2xl border border-slate-200 bg-white p-5 shadow-sm dark:border-slate-800 dark:bg-slate-900 xl:col-span-1"
        >
            <div class="mb-5 border-b border-slate-100 pb-4 dark:border-slate-800">
                <p class="text-xs font-bold text-indigo-600 dark:text-indigo-400">
                    {{ $selectedDate ? \Carbon\Carbon::parse($selectedDate)->locale($locale)->translatedFormat('l, d F Y') : '—' }}
                </p>
                <h3 class="mt-1 text-xl font-black text-slate-900 dark:text-white">
                    {{ $isFa ? 'برنامه روز' : 'Day schedule' }}
                </h3>
            </div>

            <div class="space-y-3">
                @forelse ($selectedTasks as $task)
                    <div class="rounded-2xl border border-slate-200 p-4 dark:border-slate-800">
                        <div class="flex items-start gap-3">
                            <button
                                type="button"
                                wire:click="toggleTask({{ $task->id }})"
                                wire:loading.attr="disabled"
                                wire:target="toggleTask({{ $task->id }})"
                                aria-label="{{ $task->status === 'completed' ? ($isFa ? 'بازگرداندن کار' : 'Mark as pending') : ($isFa ? 'تکمیل کار' : 'Mark as completed') }}"
                                class="mt-0.5 grid h-6 w-6 shrink-0 place-items-center rounded-full border-2 transition disabled:opacity-50 {{ $task->status === 'completed' ? 'border-emerald-500 bg-emerald-500 text-white' : 'border-slate-300 text-transparent hover:border-indigo-500 hover:bg-indigo-500 hover:text-white dark:border-slate-600' }}"
                            >
                                ✓
                            </button>

                            <div class="min-w-0 flex-1">
                                <div class="flex items-center justify-between gap-2">
                                    <span class="text-xs font-bold text-slate-400">
                                        {{ $task->due_date?->format('H:i') ?? '—' }}
                                    </span>

                                    @if ($task->priority === 'high')
                                        <span class="shrink-0 rounded-full bg-rose-50 px-2 py-1 text-[10px] font-bold text-rose-600 dark:bg-rose-500/10 dark:text-rose-400">{{ $isFa ? 'زیاد' : 'High' }}</span>
                                    @elseif ($task->priority === 'medium')
                                        <span class="shrink-0 rounded-full bg-amber-50 px-2 py-1 text-[10px] font-bold text-amber-600 dark:bg-amber-500/10 dark:text-amber-400">{{ $isFa ? 'متوسط' : 'Medium' }}</span>
                                    @else
                                        <span class="shrink-0 rounded-full bg-emerald-50 px-2 py-1 text-[10px] font-bold text-emerald-600 dark:bg-emerald-500/10 dark:text-emerald-400">{{ $isFa ? 'کم' : 'Low' }}</span>
                                    @endif
                                </div>

                                <h4 @class([
                                    'mt-2 break-words text-sm font-black',
                                    'text-slate-900 dark:text-white' => $task->status !== 'completed',
                                    'text-slate-400 line-through' => $task->status === 'completed',
                                ])>
                                    {{ $task->title }}
                                </h4>

                                <p class="mt-1 truncate text-xs text-slate-400">
                                    {{ $task->category?->name ?? ($isFa ? 'بدون دسته' : 'No category') }}
                                </p>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="rounded-2xl border border-dashed border-slate-200 px-4 py-8 text-center dark:border-slate-700">
                        <p class="text-sm font-bold text-slate-600 dark:text-slate-300">
                            {{ $isFa ? 'کاری برای این روز نیست' : 'No tasks for this day' }}
                        </p>
                        <p class="mt-1 text-xs text-slate-400">
                            {{ $isFa ? 'یک کار با این تاریخ موعد بساز' : 'Create a task with this due date.' }}
                        </p>
                    </div>
                @endforelse

                @if ($selectedDate)
                    <form wire:submit="createTaskForSelectedDay" class="mt-5 space-y-3 border-t border-slate-100 pt-5 dark:border-slate-800">
                        <p class="text-xs font-bold text-slate-500 dark:text-slate-400">
                            {{ $isFa ? 'کار جدید برای این روز' : 'New task for this day' }}
                        </p>

                        <input
                            type="text"
                            wire:model="quickTitle"
                            placeholder="{{ $isFa ? 'عنوان کار...' : 'Task title...' }}"
                            dir="{{ $isFa ? 'rtl' : 'ltr' }}"
                            class="h-11 w-full rounded-xl border border-slate-200 bg-slate-50 px-3 text-sm text-slate-900 outline-none placeholder:text-slate-400 focus:border-indigo-500 focus:ring-2 focus:ring-indigo-500/20 dark:border-slate-700 dark:bg-slate-800 dark:text-white dark:placeholder:text-slate-500"
                        >
                        @error('quickTitle')
                            <p class="text-xs text-red-500">{{ $message }}</p>
                        @enderror

                        <textarea
                            wire:model="quickDescription"
                            rows="3"
                            placeholder="{{ $isFa ? 'توضیحات کار...' : 'Task description...' }}"
                            dir="{{ $isFa ? 'rtl' : 'ltr' }}"
                            class="w-full resize-none rounded-xl border border-slate-200 bg-slate-50 px-3 py-2.5 text-sm text-slate-900 outline-none placeholder:text-slate-400 focus:border-indigo-500 focus:ring-2 focus:ring-indigo-500/20 dark:border-slate-700 dark:bg-slate-800 dark:text-white dark:placeholder:text-slate-500"
                        ></textarea>
                        @error('quickDescription')
                            <p class="text-xs text-red-500">{{ $message }}</p>
                        @enderror

                        <select
                            wire:model="quickPriority"
                            aria-label="{{ $isFa ? 'اولویت' : 'Priority' }}"
                            class="h-11 w-full rounded-xl border border-slate-200 bg-slate-50 px-3 text-sm text-slate-900 outline-none focus:border-indigo-500 dark:border-slate-700 dark:bg-slate-800 dark:text-white"
                        >
                            <option value="low">{{ $isFa ? 'کم' : 'Low' }}</option>
                            <option value="medium">{{ $isFa ? 'متوسط' : 'Medium' }}</option>
                            <option value="high">{{ $isFa ? 'زیاد' : 'High' }}</option>
                        </select>

                        <button
                            type="submit"
                            wire:loading.attr="disabled"
                            wire:target="createTaskForSelectedDay"
                            class="w-full rounded-xl bg-indigo-600 py-2.5 text-sm font-bold text-white transition hover:bg-indigo-700 disabled:opacity-60"
                        >
                            <span wire:loading.remove wire:target="createTaskForSelectedDay">
                                {{ $isFa ? 'افزودن کار' : 'Add task' }}
                            </span>
                            <span wire:loading wire:target="createTaskForSelectedDay">
                                {{ $isFa ? 'در حال افزودن...' : 'Adding...' }}
                            </span>
                        </button>
                    </form>
                @endif
            </div>
        </aside>
    </div>
</div>
