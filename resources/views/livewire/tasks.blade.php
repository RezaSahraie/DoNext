@section('title','Tasks — DoNext')
<div x-data="{
    filter: 'all',
    showModal: false,
    showEditModal: false,
    search: ''
}" x-on:task-created.window="showModal = false"
    x-on:open-edit-task-modal.window="showEditModal = true" x-on:close-edit-task-modal.window="showEditModal = false"
    class="space-y-6">

    {{-- =========================================================
        PAGE HEADER
    ========================================================== --}}
    <section class="flex flex-col gap-5 md:flex-row md:items-end md:justify-between">

        <div>
            <p class="mb-2 text-sm font-semibold text-indigo-600 dark:text-indigo-400">
                مدیریت کارها
            </p>

            <h2 class="text-3xl font-black tracking-tight sm:text-4xl">
                کارهای من
            </h2>

            <p class="mt-2 max-w-2xl text-sm leading-6 text-slate-500 dark:text-slate-400">
                همه کارهایت را در یک فضای ساده و مرتب مدیریت کن.
            </p>
        </div>

        <button type="button" @click="showModal = true"
            class="inline-flex items-center justify-center gap-2 rounded-2xl bg-indigo-600 px-5 py-3 text-sm font-bold text-white shadow-lg shadow-indigo-500/20 transition hover:-translate-y-0.5 hover:bg-indigo-700">
            <span class="text-lg leading-none">+</span>
            کار جدید
        </button>

    </section>


    {{-- =========================================================
        SEARCH + FILTERS
    ========================================================== --}}
    <section class="rounded-2xl border border-slate-200 bg-white p-4 shadow-sm dark:border-slate-800 dark:bg-slate-900">

        <div class="flex flex-col gap-4 lg:flex-row lg:items-center lg:justify-between">

            {{-- Search --}}
            <div class="relative w-full lg:max-w-md">

                <span
                    class="pointer-events-none absolute inset-y-0 start-0 grid w-11 place-items-center text-slate-400">
                    <svg class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8">
                        <circle cx="11" cy="11" r="7"></circle>
                        <path d="m20 20-4-4" stroke-linecap="round"></path>
                    </svg>
                </span>

                <input wire:model.live.debounce.300ms="search" type="search" placeholder="جستجوی کارها..."
                    class="h-11 w-full rounded-xl border border-slate-200 bg-slate-50 ps-11 pe-4 text-sm outline-none transition placeholder:text-slate-400 focus:border-indigo-400 focus:ring-4 focus:ring-indigo-500/10 dark:border-slate-700 dark:bg-slate-800 dark:focus:border-indigo-500">
            </div>


            {{-- Filters --}}
            <div class="flex flex-wrap gap-2">

                <button type="button" @click="filter = 'all'" wire:click="$set('filter', 'all')"
                    :class="filter === 'all'
                        ?
                        'bg-indigo-600 text-white shadow-sm' :
                        'bg-slate-100 text-slate-600 dark:bg-slate-800 dark:text-slate-300'"
                    class="rounded-xl px-4 py-2 text-xs font-bold transition">
                    همه
                </button>

                <button type="button" @click="filter = 'today'" wire:click="$set('filter', 'today')"
                    :class="filter === 'today'
                        ?
                        'bg-indigo-600 text-white shadow-sm' :
                        'bg-slate-100 text-slate-600 dark:bg-slate-800 dark:text-slate-300'"
                    class="rounded-xl px-4 py-2 text-xs font-bold transition">
                    امروز
                </button>

                <button type="button" @click="filter = 'pending'" wire:click="$set('filter', 'pending')"
                    :class="filter === 'pending'
                        ?
                        'bg-indigo-600 text-white shadow-sm' :
                        'bg-slate-100 text-slate-600 dark:bg-slate-800 dark:text-slate-300'"
                    class="rounded-xl px-4 py-2 text-xs font-bold transition">
                    در انتظار
                </button>

                <button type="button" @click="filter = 'completed'" wire:click="$set('filter', 'completed')"
                    :class="filter === 'completed'
                        ?
                        'bg-indigo-600 text-white shadow-sm' :
                        'bg-slate-100 text-slate-600 dark:bg-slate-800 dark:text-slate-300'"
                    class="rounded-xl px-4 py-2 text-xs font-bold transition">
                    انجام شده
                </button>

            </div>

        </div>

    </section>


    {{-- =========================================================
        TASK LIST
    ========================================================== --}}
    <section
        class="overflow-hidden rounded-2xl border border-slate-200 bg-white shadow-sm dark:border-slate-800 dark:bg-slate-900">

        {{-- List Header --}}
        <div class="flex items-center justify-between border-b border-slate-200 px-5 py-5 dark:border-slate-800">

            <div>
                <h3 class="font-black">
                    لیست کارها
                </h3>

                <p class="mt-1 text-xs text-slate-400">
                    {{ $tasks->count() }} کار در لیست
                </p>
            </div>

            <button type="button"
                class="rounded-xl p-2 text-slate-400 transition hover:bg-slate-100 hover:text-slate-700 dark:hover:bg-slate-800 dark:hover:text-white">
                <svg class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <circle cx="12" cy="5" r="1"></circle>
                    <circle cx="12" cy="12" r="1"></circle>
                    <circle cx="12" cy="19" r="1"></circle>
                </svg>
            </button>

        </div>


        {{-- Tasks --}}
        <div class="divide-y divide-slate-100 dark:divide-slate-800">

            @forelse ($tasks as $task)
                <div
                    class="group relative flex gap-4 px-5 py-5 transition hover:bg-slate-50/80 dark:hover:bg-slate-800/40">

                    {{-- Priority Indicator --}}
                    <div @class([
                        'absolute inset-y-5 start-0 w-1 rounded-e-full',
                        'bg-red-500' => $task->priority === 'high',
                        'bg-amber-500' => $task->priority === 'medium',
                        'bg-emerald-500' => $task->priority === 'low',
                        'bg-slate-300 dark:bg-slate-600' => !$task->priority,
                    ])></div>


                    {{-- Complete --}}
                    <button type="button" wire:click="toggleTask({{ $task->id }})" wire:loading.attr="disabled"
                        wire:target="toggleTask({{ $task->id }})"
                        class="mt-0.5 grid h-6 w-6 shrink-0 place-items-center rounded-full border-2 transition-all duration-200
                        {{ $task->status === 'completed'
                            ? 'border-emerald-500 bg-emerald-500 text-white'
                            : 'border-slate-300 text-transparent hover:border-indigo-500 hover:bg-indigo-500 hover:text-white dark:border-slate-600 dark:hover:border-indigo-400 dark:hover:bg-indigo-500' }}">

                        <svg class="h-3.5 w-3.5 transition-transform duration-200
                            {{ $task->status === 'completed' ? 'scale-100' : 'scale-75' }}"
                            viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3">
                            <path d="m5 12 4 4L19 6" stroke-linecap="round" stroke-linejoin="round" />
                        </svg>

                    </button>


                    {{-- Main Content --}}
                    <div class="min-w-0 flex-1">

                        {{-- Title + Actions --}}
                        <div class="flex items-start justify-between gap-4">

                            <div class="min-w-0">

                                <h4 @class([
                                    'truncate text-sm font-bold',
                                    'text-slate-400 line-through' => $task->status === 'completed',
                                    'text-slate-900 dark:text-white' => $task->status !== 'completed',
                                ])>
                                    {{ $task->title }}
                                </h4>

                            </div>


                            {{-- Actions --}}
                            <div x-data="{ open: false }" class="relative shrink-0">

                                <button type="button" @click="open = !open"
                                    class="rounded-lg p-1.5 text-slate-300 opacity-0 transition group-hover:opacity-100 hover:bg-slate-100 hover:text-slate-600 dark:hover:bg-slate-700 dark:hover:text-slate-200">

                                    <svg class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                        stroke-width="2">
                                        <circle cx="12" cy="5" r="1"></circle>
                                        <circle cx="12" cy="12" r="1"></circle>
                                        <circle cx="12" cy="19" r="1"></circle>
                                    </svg>

                                </button>


                                {{-- Dropdown --}}
                                <div x-show="open" x-cloak x-transition.origin.top.right @click.outside="open = false"
                                    class="absolute end-0 top-full z-30 mt-2 w-36 overflow-hidden rounded-xl border border-slate-200 bg-white p-1 shadow-xl dark:border-slate-700 dark:bg-slate-900">

                                    {{-- Edit --}}
                                    <button type="button" @click="open = false"
                                        wire:click="editTask({{ $task->id }})" wire:loading.attr="disabled"
                                        wire:target="editTask({{ $task->id }})"
                                        class="flex w-full items-center gap-2 rounded-lg px-3 py-2 text-sm font-medium text-slate-600 transition hover:bg-slate-100 dark:text-slate-300 dark:hover:bg-slate-800">

                                        <svg class="h-4 w-4" viewBox="0 0 24 24" fill="none"
                                            stroke="currentColor" stroke-width="2">
                                            <path d="M12 20h9" stroke-linecap="round" />
                                            <path d="M16.5 3.5a2.1 2.1 0 0 1 3 3L8 18l-4 1 1-4 11.5-11.5Z"
                                                stroke-linecap="round" stroke-linejoin="round" />
                                        </svg>

                                        ویرایش

                                    </button>


                                    {{-- Delete --}}
                                    <button type="button"
                                        @click="
                                            open = false;

                                            $dispatch('confirm', {
                                                title: 'حذف کار',
                                                message: 'آیا از حذف این کار مطمئن هستید؟',
                                                taskId: {{ $task->id }}
                                            });
                                        "
                                        class="flex w-full items-center gap-2 rounded-lg px-3 py-2 text-sm font-medium text-rose-600 transition hover:bg-rose-50 dark:text-rose-400 dark:hover:bg-rose-500/10">

                                        <svg class="h-4 w-4" viewBox="0 0 24 24" fill="none"
                                            stroke="currentColor" stroke-width="2">
                                            <path d="M3 6h18" stroke-linecap="round" />
                                            <path d="M8 6V4h8v2" stroke-linecap="round" />
                                            <path d="M19 6l-1 15H6L5 6" stroke-linejoin="round" />
                                        </svg>

                                        حذف

                                    </button>

                                </div>

                            </div>

                        </div>


                        {{-- Description --}}
                        @if ($task->description)
                            <p class="mt-1.5 max-w-3xl text-xs leading-6 text-slate-500 dark:text-slate-400">
                                {{ $task->description }}
                            </p>
                        @endif


                        {{-- Meta --}}
                        <div class="mt-3 flex flex-wrap items-center gap-2.5">

                            {{-- Due Date --}}
                            <span class="inline-flex items-center gap-1.5 text-xs text-slate-400 dark:text-slate-500">

                                <svg class="h-3.5 w-3.5" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                    stroke-width="1.8">
                                    <rect x="3" y="4" width="18" height="17" rx="2" />

                                    <path d="M16 2v4M8 2v4M3 10h18" stroke-linecap="round" />
                                </svg>

                                @if ($task->due_date)
                                    Due date:
                                    {{ $task->due_date->format('Y-m-d') }}
                                @else
                                    بدون تاریخ
                                @endif

                            </span>


                            {{-- Completed At --}}
                            @if ($task->status === 'completed' && $task->completed_at)
                                <span class="text-slate-200 dark:text-slate-700">
                                    •
                                </span>

                                <span
                                    class="inline-flex items-center gap-1.5 text-xs text-slate-400 dark:text-slate-500">

                                    <svg class="h-3.5 w-3.5" viewBox="0 0 24 24" fill="none"
                                        stroke="currentColor" stroke-width="1.8">
                                        <rect x="3" y="4" width="18" height="17" rx="2" />

                                        <path d="M16 2v4M8 2v4M3 10h18" stroke-linecap="round" />
                                    </svg>

                                    Completed at:
                                    {{ $task->completed_at->format('Y-m-d H:i:s') }}

                                </span>
                            @endif


                            {{-- Category --}}
                            @if ($task->category)
                                <span class="text-slate-200 dark:text-slate-700">
                                    •
                                </span>

                                <span
                                    class="inline-flex items-center gap-1.5 rounded-md bg-indigo-50 px-2 py-1 text-[10px] font-bold text-indigo-600 dark:bg-indigo-500/10 dark:text-indigo-400">

                                    <span class="h-1.5 w-1.5 rounded-full bg-indigo-500"></span>

                                    {{ $task->category->name }}

                                </span>
                            @endif


                            {{-- Status --}}
                            @if ($task->status === 'completed')
                                <span class="inline-flex items-center gap-1.5 text-xs font-semibold text-emerald-500">

                                    <span
                                        class="grid h-4 w-4 place-items-center rounded-full bg-emerald-500 text-white">

                                        <svg class="h-2.5 w-2.5" viewBox="0 0 24 24" fill="none"
                                            stroke="currentColor" stroke-width="3">
                                            <path d="m5 12 4 4L19 6" stroke-linecap="round" stroke-linejoin="round" />
                                        </svg>

                                    </span>

                                    انجام شده

                                </span>
                            @else
                                <span class="inline-flex items-center gap-1.5 text-xs font-semibold text-amber-500">

                                    <span class="h-1.5 w-1.5 rounded-full bg-amber-500"></span>

                                    در انتظار

                                </span>
                            @endif


                            {{-- Priority --}}
                            @if ($task->priority === 'high')
                                <span
                                    class="inline-flex items-center gap-1.5 rounded-md border border-red-200 bg-red-50 px-2 py-1 text-[10px] font-bold text-red-600 dark:border-red-500/20 dark:bg-red-500/10 dark:text-red-400">
                                    <span class="h-1.5 w-1.5 rounded-full bg-red-500"></span>
                                    زیاد
                                </span>
                            @elseif ($task->priority === 'medium')
                                <span
                                    class="inline-flex items-center gap-1.5 rounded-md border border-amber-200 bg-amber-50 px-2 py-1 text-[10px] font-bold text-amber-600 dark:border-amber-500/20 dark:bg-amber-500/10 dark:text-amber-400">
                                    <span class="h-1.5 w-1.5 rounded-full bg-amber-500"></span>
                                    متوسط
                                </span>
                            @elseif ($task->priority === 'low')
                                <span
                                    class="inline-flex items-center gap-1.5 rounded-md border border-emerald-200 bg-emerald-50 px-2 py-1 text-[10px] font-bold text-emerald-600 dark:border-emerald-500/20 dark:bg-emerald-500/10 dark:text-emerald-400">
                                    <span class="h-1.5 w-1.5 rounded-full bg-emerald-500"></span>
                                    کم
                                </span>
                            @else
                                <span
                                    class="inline-flex items-center gap-1.5 rounded-md border border-slate-200 bg-slate-100 px-2 py-1 text-[10px] font-bold text-slate-500 dark:border-slate-700 dark:bg-slate-800 dark:text-slate-400">
                                    <span class="h-1.5 w-1.5 rounded-full bg-slate-400"></span>
                                    بدون اولویت
                                </span>
                            @endif

                        </div>

                    </div>

                </div>

            @empty

                {{-- Empty State --}}
                <div class="px-5 py-16 text-center">

                    <div
                        class="mx-auto mb-5 grid h-16 w-16 place-items-center rounded-2xl bg-slate-100 text-slate-400 dark:bg-slate-800 dark:text-slate-500">

                        <svg class="h-7 w-7" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                            stroke-width="1.8">
                            <path d="M9 11l3 3L22 4" stroke-linecap="round" stroke-linejoin="round" />

                            <path d="M21 12v7a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11"
                                stroke-linecap="round" />
                        </svg>

                    </div>

                    <h4 class="font-black text-slate-800 dark:text-white">
                        هنوز کاری نداری
                    </h4>

                    <p class="mx-auto mt-2 max-w-sm text-sm leading-6 text-slate-400">
                        اولین کارت را ایجاد کن تا کارهایت را اینجا مدیریت کنی.
                    </p>

                    <button type="button" @click="showModal = true"
                        class="mt-5 rounded-xl bg-indigo-600 px-5 py-2.5 text-sm font-bold text-white transition hover:bg-indigo-700">
                        ایجاد اولین کار
                    </button>

                </div>
            @endforelse

        </div>

    </section>


    {{-- =========================================================
        CREATE TASK MODAL
    ========================================================== --}}
    <div x-show="showModal" x-cloak class="fixed inset-0 z-[100] grid place-items-center p-4"
        @keydown.escape.window="showModal = false">

        {{-- Backdrop --}}
        <div x-show="showModal" x-transition:enter="transition ease-out duration-200"
            x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100"
            x-transition:leave="transition ease-in duration-150" x-transition:leave-start="opacity-100"
            x-transition:leave-end="opacity-0" class="absolute inset-0 bg-slate-950/50 backdrop-blur-sm"
            @click="showModal = false"></div>


        {{-- Modal --}}
        <div x-show="showModal" x-transition:enter="transition ease-out duration-150"
            x-transition:enter-start="opacity-0 translate-y-4 scale-95"
            x-transition:enter-end="opacity-100 translate-y-0 scale-100"
            x-transition:leave="transition ease-in duration-100"
            x-transition:leave-start="opacity-100 translate-y-0 scale-100"
            x-transition:leave-end="opacity-0 translate-y-4 scale-95" @click.outside="showModal = false"
            class="relative max-h-[90vh] w-full max-w-lg overflow-y-auto rounded-3xl border border-slate-200 bg-white p-6 shadow-2xl dark:border-slate-800 dark:bg-slate-900">

            {{-- Header --}}
            <div class="mb-6 flex items-start justify-between">

                <div>
                    <h3 class="text-xl font-black">
                        ایجاد کار جدید
                    </h3>

                    <p class="mt-1 text-xs text-slate-400">
                        اطلاعات کار جدید را وارد کنید.
                    </p>
                </div>

                <button type="button" @click="showModal = false"
                    class="grid h-9 w-9 place-items-center rounded-xl bg-slate-100 text-slate-500 transition hover:bg-slate-200 dark:bg-slate-800 dark:hover:bg-slate-700">
                    ✕
                </button>

            </div>


            {{-- Form --}}
            <form wire:submit="createTask" class="space-y-5">

                {{-- Title --}}
                <div>

                    <label for="title" class="block text-sm font-bold">
                        عنوان کار
                    </label>

                    <input id="title" type="text" wire:model="title"
                        class="mt-2 h-12 w-full rounded-xl border border-slate-200 bg-white px-4 text-sm outline-none focus:border-indigo-500 focus:ring-4 focus:ring-indigo-500/10 dark:border-slate-700 dark:bg-slate-900 dark:text-white"
                        placeholder="مثلاً یادگیری Livewire">

                    @error('title')
                        <p class="mt-2 text-sm text-red-500">
                            {{ $message }}
                        </p>
                    @enderror

                </div>


                {{-- Description --}}
                <div>

                    <label for="description" class="block text-sm font-bold">
                        توضیحات
                    </label>

                    <textarea id="description" wire:model="description" rows="4"
                        class="mt-2 w-full rounded-xl border border-slate-200 bg-white px-4 py-3 text-sm outline-none focus:border-indigo-500 focus:ring-4 focus:ring-indigo-500/10 dark:border-slate-700 dark:bg-slate-900 dark:text-white"
                        placeholder="توضیحات کار..."></textarea>

                    @error('description')
                        <p class="mt-2 text-sm text-red-500">
                            {{ $message }}
                        </p>
                    @enderror

                </div>


                {{-- Priority --}}
                <div>

                    <label for="priority" class="block text-sm font-bold">
                        اولویت
                    </label>

                    <select id="priority" wire:model="priority"
                        class="mt-2 h-12 w-full rounded-xl border border-slate-200 bg-white px-4 text-sm dark:border-slate-700 dark:bg-slate-900 dark:text-white">
                        <option value="low">
                            کم
                        </option>

                        <option value="medium">
                            متوسط
                        </option>

                        <option value="high">
                            زیاد
                        </option>
                    </select>

                    @error('priority')
                        <p class="mt-2 text-sm text-red-500">
                            {{ $message }}
                        </p>
                    @enderror

                </div>

                {{-- Category --}}
                <div>
                    <label for="category_id" class="block text-sm font-bold">
                        دسته‌بندی
                    </label>

                    <select id="category_id" wire:model="category_id"
                        class="mt-2 h-12 w-full rounded-xl border border-slate-200 bg-white px-4 text-sm dark:border-slate-700 dark:bg-slate-900 dark:text-white">

                        <option value="">بدون دسته‌بندی</option>

                        @foreach ($categories as $category)
                            <option value="{{ $category->id }}">
                                {{ $category->name }}
                            </option>
                        @endforeach
                    </select>

                    @error('category_id')
                        <p class="mt-2 text-sm text-red-500">
                            {{ $message }}
                        </p>
                    @enderror
                </div>

                {{-- Due Date --}}
                <div>

                    <label for="due_date" class="block text-sm font-bold">
                        تاریخ انجام
                    </label>

                    <input id="due_date" type="date" wire:model="due_date"
                        class="mt-2 h-12 w-full rounded-xl border border-slate-200 bg-white px-4 text-sm dark:border-slate-700 dark:bg-slate-900 dark:text-white">

                    @error('due_date')
                        <p class="mt-2 text-sm text-red-500">
                            {{ $message }}
                        </p>
                    @enderror

                </div>


                {{-- Buttons --}}
                <div class="flex gap-3 pt-2">

                    <button type="submit" wire:loading.attr="disabled" wire:target="createTask"
                        class="flex-1 rounded-xl bg-indigo-600 py-3 text-sm font-bold text-white transition hover:bg-indigo-700 disabled:cursor-not-allowed disabled:opacity-60">

                        <span wire:loading.remove wire:target="createTask">
                            ایجاد کار
                        </span>

                        <span wire:loading wire:target="createTask">
                            در حال ایجاد...
                        </span>

                    </button>

                    <button type="button" @click="showModal = false"
                        class="rounded-xl border border-slate-200 px-5 py-3 text-sm font-bold transition hover:bg-slate-50 dark:border-slate-700 dark:hover:bg-slate-800">
                        انصراف
                    </button>

                </div>

            </form>

        </div>

    </div>


    {{-- =========================================================
        EDIT TASK MODAL
    ========================================================== --}}
    <div x-show="showEditModal" x-cloak class="fixed inset-0 z-[110] grid place-items-center p-4"
        @keydown.escape.window="showEditModal = false">

        {{-- Backdrop --}}
        <div x-show="showEditModal" x-transition:enter="transition ease-out duration-200"
            x-transition:enter-start="opacity-0" x-transition:enter-end="opacity-100"
            x-transition:leave="transition ease-in duration-150" x-transition:leave-start="opacity-100"
            x-transition:leave-end="opacity-0" class="absolute inset-0 bg-slate-950/50 backdrop-blur-sm"
            @click="showEditModal = false"></div>


        {{-- Modal --}}
        <div x-show="showEditModal" x-transition:enter="transition ease-out duration-150"
            x-transition:enter-start="opacity-0 translate-y-4 scale-95"
            x-transition:enter-end="opacity-100 translate-y-0 scale-100"
            x-transition:leave="transition ease-in duration-100"
            x-transition:leave-start="opacity-100 translate-y-0 scale-100"
            x-transition:leave-end="opacity-0 translate-y-4 scale-95" @click.outside="showEditModal = false"
            class="relative max-h-[90vh] w-full max-w-lg overflow-y-auto rounded-3xl border border-slate-200 bg-white p-6 shadow-2xl dark:border-slate-800 dark:bg-slate-900">

            {{-- Header --}}
            <div class="mb-6 flex items-start justify-between">

                <div>
                    <h3 class="text-xl font-black">
                        ویرایش کار
                    </h3>

                    <p class="mt-1 text-xs text-slate-400">
                        اطلاعات کار را ویرایش کنید.
                    </p>
                </div>

                <button type="button" @click="showEditModal = false"
                    class="grid h-9 w-9 place-items-center rounded-xl bg-slate-100 text-slate-500 transition hover:bg-slate-200 dark:bg-slate-800 dark:hover:bg-slate-700">
                    ✕
                </button>

            </div>


            {{-- Form --}}
            <form wire:submit="updateTask" class="space-y-5">

                {{-- Title --}}
                <div>

                    <label for="editTitle" class="block text-sm font-bold">
                        عنوان کار
                    </label>

                    <input id="editTitle" type="text" wire:model="editTitle"
                        class="mt-2 h-12 w-full rounded-xl border border-slate-200 bg-white px-4 text-sm outline-none focus:border-indigo-500 focus:ring-4 focus:ring-indigo-500/10 dark:border-slate-700 dark:bg-slate-900 dark:text-white"
                        placeholder="عنوان کار">

                    @error('editTitle')
                        <p class="mt-2 text-sm text-red-500">
                            {{ $message }}
                        </p>
                    @enderror

                </div>


                {{-- Description --}}
                <div>

                    <label for="editDescription" class="block text-sm font-bold">
                        توضیحات
                    </label>

                    <textarea id="editDescription" wire:model="editDescription" rows="4"
                        class="mt-2 w-full rounded-xl border border-slate-200 bg-white px-4 py-3 text-sm outline-none focus:border-indigo-500 focus:ring-4 focus:ring-indigo-500/10 dark:border-slate-700 dark:bg-slate-900 dark:text-white"
                        placeholder="توضیحات کار..."></textarea>

                    @error('editDescription')
                        <p class="mt-2 text-sm text-red-500">
                            {{ $message }}
                        </p>
                    @enderror

                </div>


                {{-- Priority --}}
                <div>

                    <label for="editPriority" class="block text-sm font-bold">
                        اولویت
                    </label>

                    <select id="editPriority" wire:model="editPriority"
                        class="mt-2 h-12 w-full rounded-xl border border-slate-200 bg-white px-4 text-sm dark:border-slate-700 dark:bg-slate-900 dark:text-white">
                        <option value="low">
                            کم
                        </option>

                        <option value="medium">
                            متوسط
                        </option>

                        <option value="high">
                            زیاد
                        </option>
                    </select>

                    @error('editPriority')
                        <p class="mt-2 text-sm text-red-500">
                            {{ $message }}
                        </p>
                    @enderror

                </div>


                {{-- Due Date --}}
                <div>

                    <label for="editDueDate" class="block text-sm font-bold">
                        تاریخ انجام
                    </label>

                    <input id="editDueDate" type="date" wire:model="editDueDate"
                        class="mt-2 h-12 w-full rounded-xl border border-slate-200 bg-white px-4 text-sm dark:border-slate-700 dark:bg-slate-900 dark:text-white">

                    @error('editDueDate')
                        <p class="mt-2 text-sm text-red-500">
                            {{ $message }}
                        </p>
                    @enderror

                </div>


                {{-- Category --}}
                <div>

                    <label for="editCategoryId" class="block text-sm font-bold">
                        دسته‌بندی
                    </label>

                    <select id="editCategoryId" wire:model="editCategoryId"
                        class="mt-2 h-12 w-full rounded-xl border border-slate-200 bg-white px-4 text-sm dark:border-slate-700 dark:bg-slate-900 dark:text-white">

                        <option value="">
                            بدون دسته‌بندی
                        </option>

                        @foreach (\App\Models\Category::where('user_id', auth()->id())->get() as $category)
                            <option value="{{ $category->id }}">
                                {{ $category->name }}
                            </option>
                        @endforeach

                    </select>

                    @error('editCategoryId')
                        <p class="mt-2 text-sm text-red-500">
                            {{ $message }}
                        </p>
                    @enderror

                </div>


                {{-- Buttons --}}
                <div class="flex gap-3 pt-2">

                    <button type="submit" wire:loading.attr="disabled" wire:target="updateTask"
                        class="flex-1 rounded-xl bg-indigo-600 py-3 text-sm font-bold text-white transition hover:bg-indigo-700 disabled:cursor-not-allowed disabled:opacity-60">

                        <span wire:loading.remove wire:target="updateTask">
                            ذخیره تغییرات
                        </span>

                        <span wire:loading wire:target="updateTask">
                            در حال ذخیره...
                        </span>

                    </button>

                    <button type="button" @click="showEditModal = false"
                        class="rounded-xl border border-slate-200 px-5 py-3 text-sm font-bold transition hover:bg-slate-50 dark:border-slate-700 dark:hover:bg-slate-800">
                        انصراف
                    </button>

                </div>

            </form>

        </div>

    </div>

</div>
