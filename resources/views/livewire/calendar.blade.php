@php
    $locale = app()->getLocale();
    $isFa = $locale === 'fa';
@endphp

@section('title', $isFa ? 'تقویم — DoNext' : 'Calendar — DoNext')
@section('heading', $isFa ? 'تقویم' : 'Calendar')

<div class="space-y-6" dir="{{ $isFa ? 'rtl' : 'ltr' }}">
    <section class="flex flex-col gap-5 md:flex-row md:items-end md:justify-between">
        <div>
            <p class="mb-2 text-sm font-semibold text-indigo-600 dark:text-indigo-400">
                {{ $isFa ? 'برنامه‌ریزی روزها' : 'Plan your days' }}
            </p>
            <h2 class="text-3xl font-black tracking-tight sm:text-4xl">
                {{ $isFa ? 'تقویم' : 'Calendar' }}
            </h2>
            <p class="mt-2 max-w-2xl text-sm leading-6 text-slate-500 dark:text-slate-400">
                {{ $isFa ? 'کارهای دارای موعد را روی تقویم ببین و مدیریت کن.' : 'View and manage your tasks with due dates on the calendar.' }}
            </p>
        </div>

        <a href="{{ route('tasks') }}" class="inline-flex items-center justify-center gap-2 rounded-2xl bg-indigo-600 px-5 py-3 text-sm font-bold text-white shadow-lg shadow-indigo-500/20 transition hover:bg-indigo-700">
            <span class="text-lg">+</span>
            <span>{{ $isFa ? 'کار جدید' : 'New Task' }}</span>
        </a>
    </section>

    <section class="rounded-2xl border border-slate-200 bg-white p-4 shadow-sm dark:border-slate-800 dark:bg-slate-900">
        <div class="flex flex-col gap-4 lg:flex-row lg:items-center lg:justify-between">
            <div class="flex flex-wrap items-center gap-2">
                <button type="button" wire:click="previousMonth" aria-label="{{ $isFa ? 'ماه قبل' : 'Previous month' }}" class="grid h-10 w-10 place-items-center rounded-xl bg-slate-100 text-slate-600 hover:bg-slate-200 dark:bg-slate-800 dark:text-slate-300">‹</button>
                <button type="button" wire:click="nextMonth" aria-label="{{ $isFa ? 'ماه بعد' : 'Next month' }}" class="grid h-10 w-10 place-items-center rounded-xl bg-slate-100 text-slate-600 hover:bg-slate-200 dark:bg-slate-800 dark:text-slate-300">›</button>
                <button type="button" wire:click="goToToday" class="rounded-xl bg-indigo-50 px-4 py-2.5 text-xs font-bold text-indigo-600 dark:bg-indigo-500/10 dark:text-indigo-400">
                    {{ $isFa ? 'امروز' : 'Today' }}
                </button>
                <h3 class="ms-2 text-lg font-black">{{ $monthTitle }}</h3>
            </div>
        </div>
    </section>

    <div class="grid grid-cols-1 gap-6 xl:grid-cols-4">
        <section class="overflow-hidden rounded-2xl border border-slate-200 bg-white shadow-sm dark:border-slate-800 dark:bg-slate-900">
            <div class="grid grid-cols-7 border-b border-slate-200 dark:border-slate-800">
                @foreach ($isFa ? ['دوشنبه','سه‌شنبه','چهارشنبه','پنجشنبه','جمعه','شنبه','یکشنبه'] : ['Monday','Tuesday','Wednesday','Thursday','Friday','Saturday','Sunday'] as $weekday)
                    <div class="py-3 text-center text-[11px] font-bold text-slate-400">{{ $weekday }}</div>
                @endforeach
            </div>

            <div class="grid grid-cols-7">
                @foreach ($cells as $cell)
                    @if ($cell === null)
                        <div class="min-h-28 border-b border-e border-slate-100 dark:border-slate-800"></div>
                    @else
                        <button type="button" wire:click="selectDate('{{ $cell['date'] }}')" @class(['group min-h-28 border-b border-e border-slate-100 p-2 text-start transition hover:bg-slate-50 dark:border-slate-800 dark:hover:bg-slate-800/50','bg-indigo-50 ring-2 ring-inset ring-indigo-500 dark:bg-indigo-500/10' => $selectedDate === $cell['date']])>
                            <span @class(['grid h-7 w-7 place-items-center rounded-lg text-xs font-bold','bg-indigo-600 text-white' => $selectedDate === $cell['date'],'bg-slate-900 text-white dark:bg-white dark:text-slate-900' => $cell['isToday'] && $selectedDate !== $cell['date'],'text-slate-500 dark:text-slate-400' => !$cell['isToday'] && $selectedDate !== $cell['date']])>{{ $cell['day'] }}</span>
                            <div class="mt-2 space-y-1">
                                @foreach ($cell['tasks']->take(3) as $task)
                                    <div @class(['truncate rounded-lg px-2 py-1 text-[10px] font-bold','bg-emerald-50 text-emerald-600 dark:bg-emerald-500/10 dark:text-emerald-400' => $task->status === 'completed','bg-rose-50 text-rose-600 dark:bg-rose-500/10 dark:text-rose-400' => $task->status !== 'completed' && $task->priority === 'high','bg-amber-50 text-amber-600 dark:bg-amber-500/10 dark:text-amber-400' => $task->status !== 'completed' && $task->priority === 'medium','bg-indigo-50 text-indigo-600 dark:bg-indigo-500/10 dark:text-indigo-400' => $task->status !== 'completed' && $task->priority === 'low'])>{{ $task->title }}</div>
                                @endforeach
                                @if ($cell['tasks']->count() > 3)
                                    <p class="px-1 text-[10px] font-bold text-slate-400">+{{ $cell['tasks']->count() - 3 }}</p>
                                @endif
                            </div>
                        </button>
                    @endif
                @endforeach
            </div>
        </section>

        <aside class="rounded-2xl border border-slate-200 bg-white p-5 shadow-sm dark:border-slate-800 dark:bg-slate-900">
            <div class="mb-5">
                <p class="text-xs font-bold text-indigo-600 dark:text-indigo-400">
                    {{ $selectedDate ? \Carbon\Carbon::parse($selectedDate)->locale($locale)->translatedFormat('l, d F Y') : '—' }}
                </p>
                <h3 class="mt-1 text-xl font-black">{{ $isFa ? 'برنامه روز' : 'Day plan' }}</h3>
            </div>

            <div class="space-y-3">
                @forelse ($selectedTasks as $task)
                    <div class="rounded-2xl border border-slate-200 p-4 dark:border-slate-800">
                        <div class="flex items-start gap-3">
                            <button type="button" wire:click="toggleTask({{ $task->id }})" wire:loading.attr="disabled" class="mt-0.5 grid h-6 w-6 shrink-0 place-items-center rounded-full border-2 transition {{ $task->status === 'completed' ? 'border-emerald-500 bg-emerald-500 text-white' : 'border-slate-300 text-transparent hover:border-indigo-500 hover:bg-indigo-500 hover:text-white dark:border-slate-600' }}">✓</button>
                            <div class="min-w-0 flex-1">
                                <div class="flex items-center justify-between gap-2">
                                    <span class="text-xs font-bold text-slate-400">{{ $task->due_date?->format('H:i') ?? '—' }}</span>
                                    @if ($task->priority === 'high')
                                        <span class="rounded-full bg-rose-50 px-2 py-1 text-[10px] font-bold text-rose-600 dark:bg-rose-500/10 dark:text-rose-400">{{ $isFa ? 'زیاد' : 'High' }}</span>
                                    @elseif ($task->priority === 'medium')
                                        <span class="rounded-full bg-amber-50 px-2 py-1 text-[10px] font-bold text-amber-600 dark:bg-amber-500/10 dark:text-amber-400">{{ $isFa ? 'متوسط' : 'Medium' }}</span>
                                    @else
                                        <span class="rounded-full bg-emerald-50 px-2 py-1 text-[10px] font-bold text-emerald-600 dark:bg-emerald-500/10 dark:text-emerald-400">{{ $isFa ? 'کم' : 'Low' }}</span>
                                    @endif
                                </div>
                                <h4 @class(['mt-2 text-sm font-black','text-slate-400 line-through' => $task->status === 'completed'])>{{ $task->title }}</h4>
                                <p class="mt-1 text-xs text-slate-400">
                                    @if ($task->category)
                                        {{ $task->category->name }}
                                    @else
                                        {{ $isFa ? 'بدون دسته' : 'No category' }}
                                    @endif
                                </p>
                            </div>
                        </div>
                    </div>
                @empty
                    <div class="rounded-2xl border border-dashed border-slate-200 px-4 py-8 text-center dark:border-slate-700">
                        <p class="text-sm font-bold text-slate-600 dark:text-slate-300">{{ $isFa ? 'کاری برای این روز نیست' : 'No tasks for this day' }}</p>
                        <p class="mt-1 text-xs text-slate-400">{{ $isFa ? 'یک کار با این تاریخ موعد بساز' : 'Create a task with this due date.' }}</p>
                    </div>
                @endforelse

                @if ($selectedDate)
                    <form wire:submit="createTaskForSelectedDay" class="mt-5 space-y-3 border-t border-slate-100 pt-5 dark:border-slate-800">
                        <p class="text-xs font-bold text-slate-500">{{ $isFa ? 'کار جدید برای این روز' : 'New task for this day' }}</p>

                        <input
                            type="text"
                            wire:model="quickTitle"
                            placeholder="{{ $isFa ? 'عنوان کار...' : 'Task title...' }}"
                            dir="{{ $isFa ? 'rtl' : 'ltr' }}"
                            class="h-11 w-full rounded-xl border border-slate-200 bg-slate-50 px-3 text-sm text-slate-900 outline-none placeholder:text-slate-400 focus:border-indigo-500 focus:ring-2 focus:ring-indigo-500/20 dark:border-slate-700 dark:bg-slate-800 dark:text-white dark:placeholder:text-slate-500"
                        >
                        @error('quickTitle')<p class="text-sm text-red-500">{{ $message }}</p>@enderror

                        <textarea
                            wire:model="quickDescription"
                            rows="3"
                            placeholder="{{ $isFa ? 'توضیحات کار...' : 'Task description...' }}"
                            dir="{{ $isFa ? 'rtl' : 'ltr' }}"
                            class="w-full resize-none rounded-xl border border-slate-200 bg-slate-50 px-3 py-2.5 text-sm text-slate-900 outline-none placeholder:text-slate-400 focus:border-indigo-500 focus:ring-2 focus:ring-indigo-500/20 dark:border-slate-700 dark:bg-slate-800 dark:text-white dark:placeholder:text-slate-500"
                        ></textarea>
                        @error('quickDescription')<p class="text-sm text-red-500">{{ $message }}</p>@enderror

                        <select wire:model="quickPriority" class="h-11 w-full rounded-xl border border-slate-200 bg-slate-50 px-3 text-sm text-slate-900 outline-none focus:border-indigo-500 dark:border-slate-700 dark:bg-slate-800 dark:text-white">
                            <option value="low">{{ $isFa ? 'کم' : 'Low' }}</option>
                            <option value="medium">{{ $isFa ? 'متوسط' : 'Medium' }}</option>
                            <option value="high">{{ $isFa ? 'زیاد' : 'High' }}</option>
                        </select>

                        <button type="submit" wire:loading.attr="disabled" wire:target="createTaskForSelectedDay" class="w-full rounded-xl bg-indigo-600 py-2.5 text-sm font-bold text-white transition hover:bg-indigo-700 disabled:opacity-60">
                            <span wire:loading.remove wire:target="createTaskForSelectedDay">{{ $isFa ? 'افزودن کار' : 'Add task' }}</span>
                            <span wire:loading wire:target="createTaskForSelectedDay">{{ $isFa ? 'در حال افزودن...' : 'Adding...' }}</span>
                        </button>
                    </form>
                @endif
            </div>
        </aside>
    </div>
</div>
