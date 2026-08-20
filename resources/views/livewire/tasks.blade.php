@section('title','Tasks — DoNext')
<div x-data="{
    filter: 'all',
    showModal: false,
    showEditModal: false,
    search: ''
}" x-on:task-created.window="showModal = false"
    x-on:open-edit-task-modal.window="showEditModal = true" x-on:close-edit-task-modal.window="showEditModal = false"
    class="space-y-6">

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

    <section class="rounded-2xl border border-slate-200 bg-white p-4 shadow-sm dark:border-slate-800 dark:bg-slate-900">
        <div class="flex flex-col gap-4 lg:flex-row lg:items-center lg:justify-between">
            <div class="relative w-full lg:max-w-md">
                <span class="pointer-events-none absolute inset-y-0 start-0 grid w-11 place-items-center text-slate-400">
                    <svg class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8">
                        <circle cx="11" cy="11" r="7"></circle>
                        <path d="m20 20-4-4" stroke-linecap="round"></path>
                    </svg>
                </span>
                <input wire:model.live.debounce.300ms="search" type="search" placeholder="جستجوی کارها..."
                    class="h-11 w-full rounded-xl border border-slate-200 bg-slate-50 ps-11 pe-4 text-sm outline-none transition placeholder:text-slate-400 focus:border-indigo-400 focus:ring-4 focus:ring-indigo-500/10 dark:border-slate-700 dark:bg-slate-800 dark:focus:border-indigo-500">
            </div>

            <div class="flex flex-wrap gap-2">
                <button type="button" @click="filter = 'all'" wire:click="$set('filter', 'all')"
                    :class="filter === 'all' ? 'bg-indigo-600 text-white shadow-sm' : 'bg-slate-100 text-slate-600 dark:bg-slate-800 dark:text-slate-300'"
                    class="rounded-xl px-4 py-2 text-xs font-bold transition">همه</button>
                <button type="button" @click="filter = 'today'" wire:click="$set('filter', 'today')"
                    :class="filter === 'today' ? 'bg-indigo-600 text-white shadow-sm' : 'bg-slate-100 text-slate-600 dark:bg-slate-800 dark:text-slate-300'"
                    class="rounded-xl px-4 py-2 text-xs font-bold transition">امروز</button>
                <button type="button" @click="filter = 'pending'" wire:click="$set('filter', 'pending')"
                    :class="filter === 'pending' ? 'bg-indigo-600 text-white shadow-sm' : 'bg-slate-100 text-slate-600 dark:bg-slate-800 dark:text-slate-300'"
                    class="rounded-xl px-4 py-2 text-xs font-bold transition">در انتظار</button>
                <button type="button" @click="filter = 'completed'" wire:click="$set('filter', 'completed')"
                    :class="filter === 'completed' ? 'bg-indigo-600 text-white shadow-sm' : 'bg-slate-100 text-slate-600 dark:bg-slate-800 dark:text-slate-300'"
                    class="rounded-xl px-4 py-2 text-xs font-bold transition">انجام شده</button>
            </div>
        </div>
    </section>

    <section class="overflow-hidden rounded-2xl border border-slate-200 bg-white shadow-sm dark:border-slate-800 dark:bg-slate-900">
        <div class="flex items-center justify-between border-b border-slate-200 px-5 py-5 dark:border-slate-800">
            <div>
                <h3 class="font-black">لیست کارها</h3>
                <p class="mt-1 text-xs text-slate-400">{{ $tasks->count() }} کار در لیست</p>
            </div>
        </div>

        <div class="divide-y divide-slate-100 dark:divide-slate-800">
            @forelse ($tasks as $task)
                <div class="group relative flex gap-4 px-5 py-5 transition hover:bg-slate-50/80 dark:hover:bg-slate-800/40">
                    <div @class([
                        'absolute inset-y-5 start-0 w-1 rounded-e-full',
                        'bg-red-500' => $task->priority === 'high',
                        'bg-amber-500' => $task->priority === 'medium',
                        'bg-emerald-500' => $task->priority === 'low',
                        'bg-slate-300 dark:bg-slate-600' => !$task->priority,
                    ])></div>

                    <button type="button" wire:click="toggleTask({{ $task->id }})" wire:loading.attr="disabled"
                        wire:target="toggleTask({{ $task->id }})"
                        class="mt-0.5 grid h-6 w-6 shrink-0 place-items-center rounded-full border-2 transition-all duration-200
                        {{ $task->status === 'completed'
                            ? 'border-emerald-500 bg-emerald-500 text-white'
                            : 'border-slate-300 text-transparent hover:border-indigo-500 hover:bg-indigo-500 hover:text-white dark:border-slate-600 dark:hover:border-indigo-400 dark:hover:bg-indigo-500' }}">
                        <svg class="h-3.5 w-3.5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="3">
                            <path d="m5 12 4 4L19 6" stroke-linecap="round" stroke-linejoin="round" />
                        </svg>
                    </button>

                    <div class="min-w-0 flex-1">
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

                            <div x-data="{ open: false }" class="relative shrink-0">
                                <button type="button" @click="open = !open"
                                    class="rounded-lg p-1.5 text-slate-300 opacity-0 transition group-hover:opacity-100 hover:bg-slate-100 hover:text-slate-600 dark:hover:bg-slate-700 dark:hover:text-slate-200">
                                    <svg class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                                        <circle cx="12" cy="5" r="1"></circle>
                                        <circle cx="12" cy="12" r="1"></circle>
                                        <circle cx="12" cy="19" r="1"></circle>
                                    </svg>
                                </button>

                                <div x-show="open" x-cloak x-transition.origin.top.right @click.outside="open = false"
                                    class="absolute end-0 top-full z-30 mt-2 w-36 overflow-hidden rounded-xl border border-slate-200 bg-white p-1 shadow-xl dark:border-slate-700 dark:bg-slate-900">
                                    <button type="button" @click="open = false" wire:click="editTask({{ $task->id }})"
                                        class="flex w-full items-center gap-2 rounded-lg px-3 py-2 text-sm font-medium text-slate-600 transition hover:bg-slate-100 dark:text-slate-300 dark:hover:bg-slate-800">
                                        ویرایش
                                    </button>
                                    <button type="button"
                                        @click="open = false; $dispatch('confirm', { title: 'حذف کار', message: 'آیا از حذف این کار مطمئن هستید؟', taskId: {{ $task->id }} });"
                                        class="flex w-full items-center gap-2 rounded-lg px-3 py-2 text-sm font-medium text-rose-600 transition hover:bg-rose-50 dark:text-rose-400 dark:hover:bg-rose-500/10">
                                        حذف
                                    </button>
                                </div>
                            </div>
                        </div>

                        @if ($task->description)
                            <p class="mt-1.5 max-w-3xl text-xs leading-6 text-slate-500 dark:text-slate-400">
                                {{ $task->description }}
                            </p>
                        @endif

                        <div class="mt-3 flex flex-wrap items-center gap-2.5">
                            <span class="inline-flex items-center gap-1.5 text-xs text-slate-400 dark:text-slate-500">
                                @if ($task->due_date)
                                    موعد: {{ $task->due_date->format('Y-m-d') }}
                                @else
                                    بدون تاریخ
                                @endif
                            </span>

                            @if ($task->status === 'completed' && $task->completed_at)
                                <span class="text-slate-200 dark:text-slate-700">•</span>
                                <span class="inline-flex items-center gap-1.5 text-xs text-slate-400 dark:text-slate-500">
                                    تکمیل: {{ $task->completed_at->format('Y-m-d H:i') }}
                                </span>
                            @endif

                            @if ($task->category)
                                <span class="text-slate-200 dark:text-slate-700">•</span>
                                <span class="inline-flex items-center gap-1.5 rounded-md bg-indigo-50 px-2 py-1 text-[10px] font-bold text-indigo-600 dark:bg-indigo-500/10 dark:text-indigo-400">
                                    {{ $task->category->name }}
                                </span>
                            @endif

                            @if ($task->status === 'completed')
                                <span class="inline-flex items-center gap-1.5 text-xs font-semibold text-emerald-500">انجام شده</span>
                            @else
                                <span class="inline-flex items-center gap-1.5 text-xs font-semibold text-amber-500">در انتظار</span>
                            @endif

                            @if ($task->priority === 'high')
                                <span class="inline-flex items-center gap-1.5 rounded-md border border-red-200 bg-red-50 px-2 py-1 text-[10px] font-bold text-red-600 dark:border-red-500/20 dark:bg-red-500/10 dark:text-red-400">زیاد</span>
                            @elseif ($task->priority === 'medium')
                                <span class="inline-flex items-center gap-1.5 rounded-md border border-amber-200 bg-amber-50 px-2 py-1 text-[10px] font-bold text-amber-600 dark:border-amber-500/20 dark:bg-amber-500/10 dark:text-amber-400">متوسط</span>
                            @elseif ($task->priority === 'low')
                                <span class="inline-flex items-center gap-1.5 rounded-md border border-emerald-200 bg-emerald-50 px-2 py-1 text-[10px] font-bold text-emerald-600 dark:border-emerald-500/20 dark:bg-emerald-500/10 dark:text-emerald-400">کم</span>
                            @else
                                <span class="inline-flex items-center gap-1.5 rounded-md border border-slate-200 bg-slate-100 px-2 py-1 text-[10px] font-bold text-slate-500 dark:border-slate-700 dark:bg-slate-800 dark:text-slate-400">بدون اولویت</span>
                            @endif
                        </div>
                    </div>
                </div>
            @empty
                <div class="px-5 py-16 text-center">
                    <h4 class="font-black text-slate-800 dark:text-white">هنوز کاری نداری</h4>
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

    {{-- CREATE MODAL --}}
    <div x-show="showModal" x-cloak class="fixed inset-0 z-[100] grid place-items-center p-4" @keydown.escape.window="showModal = false">
        <div class="absolute inset-0 bg-slate-950/50 backdrop-blur-sm" @click="showModal = false"></div>
        <div @click.outside="showModal = false" class="relative max-h-[90vh] w-full max-w-lg overflow-y-auto rounded-3xl border border-slate-200 bg-white p-6 shadow-2xl dark:border-slate-800 dark:bg-slate-900">
            <div class="mb-6 flex items-start justify-between">
                <div>
                    <h3 class="text-xl font-black">ایجاد کار جدید</h3>
                    <p class="mt-1 text-xs text-slate-400">اطلاعات کار جدید را وارد کنید.</p>
                </div>
                <button type="button" @click="showModal = false" class="grid h-9 w-9 place-items-center rounded-xl bg-slate-100 text-slate-500 dark:bg-slate-800">✕</button>
            </div>

            <form wire:submit="createTask" class="space-y-5">
                <div>
                    <label class="block text-sm font-bold">عنوان کار</label>
                    <input type="text" wire:model="title" class="mt-2 h-12 w-full rounded-xl border border-slate-200 bg-white px-4 text-sm dark:border-slate-700 dark:bg-slate-900" placeholder="مثلاً یادگیری Livewire">
                    @error('title') <p class="mt-2 text-sm text-red-500">{{ $message }}</p> @enderror
                </div>
                <div>
                    <label class="block text-sm font-bold">توضیحات</label>
                    <textarea wire:model="description" rows="4" class="mt-2 w-full rounded-xl border border-slate-200 bg-white px-4 py-3 text-sm dark:border-slate-700 dark:bg-slate-900" placeholder="توضیحات کار..."></textarea>
                    @error('description') <p class="mt-2 text-sm text-red-500">{{ $message }}</p> @enderror
                </div>
                <div>
                    <label class="block text-sm font-bold">اولویت</label>
                    <select wire:model="priority" class="mt-2 h-12 w-full rounded-xl border border-slate-200 bg-white px-4 text-sm dark:border-slate-700 dark:bg-slate-900">
                        <option value="low">کم</option>
                        <option value="medium">متوسط</option>
                        <option value="high">زیاد</option>
                    </select>
                </div>
                <div>
                    <label class="block text-sm font-bold">دسته‌بندی</label>
                    <select wire:model="category_id" class="mt-2 h-12 w-full rounded-xl border border-slate-200 bg-white px-4 text-sm dark:border-slate-700 dark:bg-slate-900">
                        <option value="">بدون دسته‌بندی</option>
                        @foreach ($categories as $category)
                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div>
                    <label class="block text-sm font-bold">تاریخ انجام</label>
                    <input type="date" wire:model="due_date" class="mt-2 h-12 w-full rounded-xl border border-slate-200 bg-white px-4 text-sm dark:border-slate-700 dark:bg-slate-900">
                </div>
                <div class="flex gap-3 pt-2">
                    <button type="submit" wire:loading.attr="disabled" class="flex-1 rounded-xl bg-indigo-600 py-3 text-sm font-bold text-white">
                        <span wire:loading.remove wire:target="createTask">ایجاد کار</span>
                        <span wire:loading wire:target="createTask">در حال ایجاد...</span>
                    </button>
                    <button type="button" @click="showModal = false" class="rounded-xl border border-slate-200 px-5 py-3 text-sm font-bold dark:border-slate-700">انصراف</button>
                </div>
            </form>
        </div>
    </div>

    {{-- EDIT MODAL --}}
    <div x-show="showEditModal" x-cloak class="fixed inset-0 z-[110] grid place-items-center p-4" @keydown.escape.window="showEditModal = false">
        <div class="absolute inset-0 bg-slate-950/50 backdrop-blur-sm" @click="showEditModal = false"></div>
        <div @click.outside="showEditModal = false" class="relative max-h-[90vh] w-full max-w-lg overflow-y-auto rounded-3xl border border-slate-200 bg-white p-6 shadow-2xl dark:border-slate-800 dark:bg-slate-900">
            <div class="mb-6 flex items-start justify-between">
                <div>
                    <h3 class="text-xl font-black">ویرایش کار</h3>
                    <p class="mt-1 text-xs text-slate-400">اطلاعات کار را ویرایش کنید.</p>
                </div>
                <button type="button" @click="showEditModal = false" class="grid h-9 w-9 place-items-center rounded-xl bg-slate-100 text-slate-500 dark:bg-slate-800">✕</button>
            </div>

            <form wire:submit="updateTask" class="space-y-5">
                <div>
                    <label class="block text-sm font-bold">عنوان کار</label>
                    <input type="text" wire:model="editTitle" class="mt-2 h-12 w-full rounded-xl border border-slate-200 bg-white px-4 text-sm dark:border-slate-700 dark:bg-slate-900" placeholder="عنوان کار">
                    @error('editTitle') <p class="mt-2 text-sm text-red-500">{{ $message }}</p> @enderror
                </div>
                <div>
                    <label class="block text-sm font-bold">توضیحات</label>
                    <textarea wire:model="editDescription" rows="4" class="mt-2 w-full rounded-xl border border-slate-200 bg-white px-4 py-3 text-sm dark:border-slate-700 dark:bg-slate-900" placeholder="توضیحات کار..."></textarea>
                </div>
                <div>
                    <label class="block text-sm font-bold">اولویت</label>
                    <select wire:model="editPriority" class="mt-2 h-12 w-full rounded-xl border border-slate-200 bg-white px-4 text-sm dark:border-slate-700 dark:bg-slate-900">
                        <option value="low">کم</option>
                        <option value="medium">متوسط</option>
                        <option value="high">زیاد</option>
                    </select>
                </div>
                <div>
                    <label class="block text-sm font-bold">تاریخ انجام</label>
                    <input type="date" wire:model="editDueDate" class="mt-2 h-12 w-full rounded-xl border border-slate-200 bg-white px-4 text-sm dark:border-slate-700 dark:bg-slate-900">
                </div>
                <div>
                    <label class="block text-sm font-bold">دسته‌بندی</label>
                    <select wire:model="editCategoryId" class="mt-2 h-12 w-full rounded-xl border border-slate-200 bg-white px-4 text-sm dark:border-slate-700 dark:bg-slate-900">
                        <option value="">بدون دسته‌بندی</option>
                        @foreach ($categories as $category)
                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="flex gap-3 pt-2">
                    <button type="submit" wire:loading.attr="disabled" class="flex-1 rounded-xl bg-indigo-600 py-3 text-sm font-bold text-white">
                        <span wire:loading.remove wire:target="updateTask">ذخیره تغییرات</span>
                        <span wire:loading wire:target="updateTask">در حال ذخیره...</span>
                    </button>
                    <button type="button" @click="showEditModal = false" class="rounded-xl border border-slate-200 px-5 py-3 text-sm font-bold dark:border-slate-700">انصراف</button>
                </div>
            </form>
        </div>
    </div>
</div>
