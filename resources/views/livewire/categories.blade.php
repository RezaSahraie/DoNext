@section('title','Categories — DoNext')
<div
    x-data="{
        showCreateModal: false,
        showDeleteModal: false,
        deleteCategoryId: null,
        deleteCategoryName: '',
    }"
    x-on:category-created.window="showCreateModal = false"
    class="space-y-6"
>

    {{-- =========================================================
        Header
    ========================================================== --}}
    <section
        class="relative overflow-hidden rounded-3xl border border-slate-200 bg-white p-6 shadow-sm dark:border-slate-800 dark:bg-slate-900 sm:p-8">

        {{-- Decorative --}}
        <div
            class="pointer-events-none absolute -left-20 -top-20 h-52 w-52 rounded-full bg-indigo-500/10 blur-3xl">
        </div>

        <div
            class="relative flex flex-col gap-6 sm:flex-row sm:items-center sm:justify-between">

            {{-- Title --}}
            <div class="flex items-start gap-4">

                <div
                    class="grid h-14 w-14 shrink-0 place-items-center rounded-2xl bg-indigo-50 text-indigo-600 dark:bg-indigo-500/10 dark:text-indigo-400">

                    <svg
                        class="h-7 w-7"
                        viewBox="0 0 24 24"
                        fill="none"
                        stroke="currentColor"
                        stroke-width="1.8"
                    >
                        <path
                            d="M3 7a2 2 0 0 1 2-2h5l2 2h7a2 2 0 0 1 2 2v8a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V7Z"
                            stroke-linejoin="round"
                        />
                    </svg>

                </div>

                <div>

                    <p class="text-sm font-bold text-indigo-600 dark:text-indigo-400">
                        مدیریت دسته‌بندی‌ها
                    </p>

                    <h1 class="mt-1 text-2xl font-black tracking-tight sm:text-3xl">
                        دسته‌بندی‌های من
                    </h1>

                    <p class="mt-2 max-w-xl text-sm leading-6 text-slate-500 dark:text-slate-400">
                        کارهایت را با دسته‌بندی‌های مختلف مرتب و منظم نگه دار.
                    </p>

                </div>

            </div>


            {{-- Create button --}}
            <button
                type="button"
                @click="showCreateModal = true"
                class="inline-flex h-12 shrink-0 items-center justify-center gap-2 rounded-2xl bg-indigo-600 px-5 text-sm font-bold text-white shadow-lg shadow-indigo-500/20 transition hover:-translate-y-0.5 hover:bg-indigo-700 active:translate-y-0"
            >

                <svg
                    class="h-5 w-5"
                    viewBox="0 0 24 24"
                    fill="none"
                    stroke="currentColor"
                    stroke-width="2"
                >
                    <path
                        d="M12 5v14M5 12h14"
                        stroke-linecap="round"
                    />
                </svg>

                دسته‌بندی جدید

            </button>

        </div>

    </section>



    {{-- =========================================================
        Categories
    ========================================================== --}}
    <section
        class="overflow-hidden rounded-3xl border border-slate-200 bg-white shadow-sm dark:border-slate-800 dark:bg-slate-900">

        {{-- Section Header --}}
        <div
            class="flex items-center justify-between border-b border-slate-100 px-5 py-5 dark:border-slate-800 sm:px-6">

            <div>

                <h2 class="text-base font-black">
                    دسته‌بندی‌ها
                </h2>

                <p class="mt-1 text-xs text-slate-400">
                    {{ $categories->count() }}
                    دسته‌بندی
                </p>

            </div>

            <div
                class="grid h-9 w-9 place-items-center rounded-xl bg-slate-100 text-slate-500 dark:bg-slate-800 dark:text-slate-400">

                <svg
                    class="h-4 w-4"
                    viewBox="0 0 24 24"
                    fill="none"
                    stroke="currentColor"
                    stroke-width="1.8"
                >
                    <path
                        d="M4 6h16M4 12h16M4 18h16"
                        stroke-linecap="round"
                    />
                </svg>

            </div>

        </div>


        {{-- =====================================================
            Category List
        ====================================================== --}}
        @if ($categories->count())

            <div class="grid gap-4 p-4 sm:grid-cols-2 lg:grid-cols-3">

                @foreach ($categories as $category)

                    <div
                        wire:key="category-{{ $category->id }}"
                        class="group relative overflow-hidden rounded-2xl border border-slate-200 bg-slate-50/70 transition duration-200 hover:-translate-y-0.5 hover:border-slate-300 hover:bg-white hover:shadow-md dark:border-slate-800 dark:bg-slate-800/40 dark:hover:border-slate-700 dark:hover:bg-slate-800"
                    >

                        {{-- Color line --}}
                        <div
                            class="absolute inset-x-0 top-0 h-1"
                            style="background-color: {{ $category->color }}"
                        ></div>


                        {{-- Category clickable content --}}
                        <button
                            type="button"
                            wire:click="selectCategory({{ $category->id }})"
                            class="block w-full text-right"
                        >

                            <div class="p-5">

                                <div class="flex items-start gap-3">

                                    {{-- Icon --}}
                                    <div
                                        class="grid h-12 w-12 shrink-0 place-items-center rounded-2xl"
                                        style="
                                            background-color: {{ $category->color }}18;
                                            color: {{ $category->color }};
                                        "
                                    >

                                        @if ($category->icon === 'folder')

                                            <svg
                                                class="h-6 w-6"
                                                viewBox="0 0 24 24"
                                                fill="none"
                                                stroke="currentColor"
                                                stroke-width="1.8"
                                            >
                                                <path
                                                    d="M3 7a2 2 0 0 1 2-2h5l2 2h7a2 2 0 0 1 2 2v8a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V7Z"
                                                    stroke-linejoin="round"
                                                />
                                            </svg>

                                        @elseif ($category->icon === 'work')

                                            <svg
                                                class="h-6 w-6"
                                                viewBox="0 0 24 24"
                                                fill="none"
                                                stroke="currentColor"
                                                stroke-width="1.8"
                                            >
                                                <rect
                                                    x="3"
                                                    y="7"
                                                    width="18"
                                                    height="13"
                                                    rx="2"
                                                />

                                                <path
                                                    d="M8 7V5a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"
                                                    stroke-linecap="round"
                                                />
                                            </svg>

                                        @elseif ($category->icon === 'study')

                                            <svg
                                                class="h-6 w-6"
                                                viewBox="0 0 24 24"
                                                fill="none"
                                                stroke="currentColor"
                                                stroke-width="1.8"
                                            >
                                                <path
                                                    d="m3 9 9-5 9 5-9 5-9-5Z"
                                                    stroke-linejoin="round"
                                                />

                                                <path
                                                    d="M7 11v5c3 2 7 2 10 0v-5"
                                                    stroke-linecap="round"
                                                />
                                            </svg>

                                        @elseif ($category->icon === 'personal')

                                            <svg
                                                class="h-6 w-6"
                                                viewBox="0 0 24 24"
                                                fill="none"
                                                stroke="currentColor"
                                                stroke-width="1.8"
                                            >
                                                <circle
                                                    cx="12"
                                                    cy="8"
                                                    r="3"
                                                />

                                                <path
                                                    d="M5 20a7 7 0 0 1 14 0"
                                                    stroke-linecap="round"
                                                />
                                            </svg>

                                        @else

                                            <svg
                                                class="h-6 w-6"
                                                viewBox="0 0 24 24"
                                                fill="none"
                                                stroke="currentColor"
                                                stroke-width="1.8"
                                            >
                                                <path
                                                    d="M12 3v18M3 12h18"
                                                    stroke-linecap="round"
                                                />
                                            </svg>

                                        @endif

                                    </div>


                                    {{-- Name + count --}}
                                    <div class="min-w-0 flex-1">

                                        <h3
                                            class="truncate text-sm font-black text-slate-900 dark:text-white"
                                        >
                                            {{ $category->name }}
                                        </h3>

                                        <p class="mt-1 text-xs text-slate-400">

                                            {{ $category->tasks_count }}

                                            کار

                                        </p>

                                    </div>


                                    {{-- Selected indicator --}}
                                    <div
                                        class="grid h-8 w-8 shrink-0 place-items-center rounded-xl transition
                                        {{ $selectedCategoryId === $category->id
                                            ? 'bg-indigo-100 text-indigo-600 dark:bg-indigo-500/10 dark:text-indigo-400'
                                            : 'bg-slate-100 text-slate-400 dark:bg-slate-800' }}"
                                    >

                                        <svg
                                            class="h-4 w-4 transition-transform {{ $selectedCategoryId === $category->id ? 'rotate-180' : '' }}"
                                            viewBox="0 0 24 24"
                                            fill="none"
                                            stroke="currentColor"
                                            stroke-width="2"
                                        >
                                            <path
                                                d="m6 9 6 6 6-6"
                                                stroke-linecap="round"
                                                stroke-linejoin="round"
                                            />
                                        </svg>

                                    </div>

                                </div>


                                {{-- Bottom --}}
                                <div
                                    class="mt-5 flex items-center justify-between border-t border-slate-200/70 pt-4 dark:border-slate-700/70">

                                    <div class="flex items-center gap-2">

                                        <span
                                            class="h-2.5 w-2.5 rounded-full"
                                            style="background-color: {{ $category->color }}"
                                        ></span>

                                        <span class="text-[11px] font-medium text-slate-400">
                                            {{ $category->tasks_count }} کار
                                        </span>

                                    </div>


                                    <span class="text-[11px] font-semibold text-indigo-500">

                                        {{ $selectedCategoryId === $category->id ? 'بستن کارها' : 'مشاهده کارها' }}

                                    </span>

                                </div>

                            </div>

                        </button>


                        {{-- =================================================
                            Category Actions
                        ================================================== --}}
                        <div
                            class="flex items-center gap-2 border-t border-slate-200/70 px-4 py-3 dark:border-slate-700/70">

                            {{-- Edit --}}
                            <button
                                type="button"
                                wire:click="editCategory({{ $category->id }})"
                                class="flex flex-1 items-center justify-center gap-2 rounded-xl px-3 py-2 text-xs font-bold text-slate-500 transition hover:bg-indigo-50 hover:text-indigo-600 dark:text-slate-400 dark:hover:bg-indigo-500/10 dark:hover:text-indigo-400"
                            >

                                <svg
                                    class="h-4 w-4"
                                    viewBox="0 0 24 24"
                                    fill="none"
                                    stroke="currentColor"
                                    stroke-width="1.8"
                                >
                                    <path
                                        d="M12 20h9"
                                        stroke-linecap="round"
                                    />

                                    <path
                                        d="M16.5 3.5a2.12 2.12 0 0 1 3 3L8 18l-4 1 1-4L16.5 3.5Z"
                                        stroke-linejoin="round"
                                    />
                                </svg>

                                ویرایش

                            </button>


                            {{-- Delete --}}
                            <button
                                type="button"
                                @click="
                                    deleteCategoryId = {{ $category->id }};
                                    deleteCategoryName = @js($category->name);
                                    showDeleteModal = true;
                                "
                                class="flex flex-1 items-center justify-center gap-2 rounded-xl px-3 py-2 text-xs font-bold text-rose-500 transition hover:bg-rose-50 dark:hover:bg-rose-500/10"
                            >

                                <svg
                                    class="h-4 w-4"
                                    viewBox="0 0 24 24"
                                    fill="none"
                                    stroke="currentColor"
                                    stroke-width="1.8"
                                >
                                    <path
                                        d="M3 6h18"
                                        stroke-linecap="round"
                                    />

                                    <path
                                        d="M8 6V4h8v2"
                                        stroke-linecap="round"
                                    />

                                    <path
                                        d="M19 6l-1 15H6L5 6"
                                        stroke-linejoin="round"
                                    />

                                </svg>

                                حذف

                            </button>

                        </div>

                    </div>

                @endforeach

            </div>


        @else

            {{-- Empty --}}
            <div class="px-5 py-20 text-center">

                <div
                    class="mx-auto grid h-16 w-16 place-items-center rounded-2xl bg-indigo-50 text-indigo-500 dark:bg-indigo-500/10 dark:text-indigo-400">

                    <svg
                        class="h-7 w-7"
                        viewBox="0 0 24 24"
                        fill="none"
                        stroke="currentColor"
                        stroke-width="1.8"
                    >
                        <path
                            d="M3 7a2 2 0 0 1 2-2h5l2 2h7a2 2 0 0 1 2 2v8a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V7Z"
                            stroke-linejoin="round"
                        />
                    </svg>

                </div>

                <h3 class="mt-5 font-black">
                    هنوز دسته‌بندی‌ای نداری
                </h3>

                <p class="mx-auto mt-2 max-w-sm text-sm leading-6 text-slate-400">
                    اولین دسته‌بندی خودت را ایجاد کن تا کارهایت را بهتر مرتب کنی.
                </p>

                <button
                    type="button"
                    @click="showCreateModal = true"
                    class="mt-6 inline-flex items-center gap-2 rounded-xl bg-indigo-600 px-5 py-2.5 text-sm font-bold text-white transition hover:bg-indigo-700"
                >
                    <span class="text-lg">+</span>
                    ایجاد دسته‌بندی
                </button>

            </div>

        @endif

    </section>


    {{-- =========================================================
        Selected Category Tasks
    ========================================================== --}}
    @if ($selectedCategoryId)

        @php
            $selectedCategory = $categories->firstWhere('id', $selectedCategoryId);
        @endphp

        <section
            class="overflow-hidden rounded-3xl border border-slate-200 bg-white shadow-sm dark:border-slate-800 dark:bg-slate-900"
        >

            {{-- Header --}}
            <div
                class="flex flex-col gap-4 border-b border-slate-100 px-5 py-5 dark:border-slate-800 sm:flex-row sm:items-center sm:justify-between sm:px-6"
            >

                <div class="flex items-center gap-3">

                    <div
                        class="grid h-11 w-11 place-items-center rounded-2xl"
                        style="
                            background-color: {{ $selectedCategory?->color ?? '#6366F1' }}18;
                            color: {{ $selectedCategory?->color ?? '#6366F1' }};
                        "
                    >

                        <svg
                            class="h-5 w-5"
                            viewBox="0 0 24 24"
                            fill="none"
                            stroke="currentColor"
                            stroke-width="1.8"
                        >
                            <path
                                d="M3 7a2 2 0 0 1 2-2h5l2 2h7a2 2 0 0 1 2 2v8a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V7Z"
                                stroke-linejoin="round"
                            />
                        </svg>

                    </div>

                    <div>

                        <p class="text-xs font-semibold text-slate-400">
                            کارهای دسته‌بندی
                        </p>

                        <h2 class="mt-1 text-lg font-black">
                            {{ $selectedCategory?->name }}
                        </h2>

                    </div>

                </div>


                <span
                    class="inline-flex w-fit items-center gap-2 rounded-xl bg-slate-100 px-3 py-2 text-xs font-bold text-slate-500 dark:bg-slate-800 dark:text-slate-300"
                >

                    {{ $categoryTasks->count() }}

                    کار

                </span>

            </div>


            {{-- Tasks --}}
            @if ($categoryTasks->count())

                <div class="divide-y divide-slate-100 dark:divide-slate-800">

                    @foreach ($categoryTasks as $task)

                        <div
                            wire:key="category-task-{{ $task->id }}"
                            class="flex flex-col gap-4 px-5 py-5 transition hover:bg-slate-50 dark:hover:bg-slate-800/40 sm:flex-row sm:items-center sm:px-6"
                        >

                            {{-- Task info --}}
                            <div class="min-w-0 flex-1">

                                <div class="flex items-start gap-3">

                                    {{-- Status dot --}}
                                    <span
                                        class="mt-1.5 h-2.5 w-2.5 shrink-0 rounded-full
                                        {{ $task->status === 'completed'
                                            ? 'bg-emerald-500'
                                            : 'bg-amber-500' }}"
                                    ></span>


                                    <div class="min-w-0">

                                        <h3
                                            class="truncate text-sm font-bold
                                            {{ $task->status === 'completed'
                                                ? 'text-slate-400 line-through'
                                                : 'text-slate-900 dark:text-white' }}"
                                        >
                                            {{ $task->title }}
                                        </h3>


                                        @if ($task->description)

                                            <p
                                                class="mt-1 line-clamp-2 text-xs leading-5 text-slate-400"
                                            >
                                                {{ $task->description }}
                                            </p>

                                        @endif

                                    </div>

                                </div>

                            </div>


                            {{-- Due date --}}
                            <div class="flex items-center gap-2 text-xs text-slate-400">

                                <svg
                                    class="h-4 w-4"
                                    viewBox="0 0 24 24"
                                    fill="none"
                                    stroke="currentColor"
                                    stroke-width="1.8"
                                >
                                    <rect
                                        x="3"
                                        y="4"
                                        width="18"
                                        height="17"
                                        rx="2"
                                    />

                                    <path
                                        d="M16 2v4M8 2v4M3 10h18"
                                        stroke-linecap="round"
                                    />
                                </svg>

                                @if ($task->due_date)

                                    {{ $task->due_date->format('Y-m-d') }}

                                @else

                                    بدون تاریخ

                                @endif

                            </div>


                            {{-- Priority --}}
                            @if ($task->priority === 'high')

                                <span
                                    class="inline-flex w-fit items-center gap-1.5 rounded-lg bg-rose-50 px-2.5 py-1.5 text-[10px] font-black text-rose-600 dark:bg-rose-500/10 dark:text-rose-400"
                                >
                                    <span class="h-1.5 w-1.5 rounded-full bg-rose-500"></span>
                                    زیاد
                                </span>

                            @elseif ($task->priority === 'medium')

                                <span
                                    class="inline-flex w-fit items-center gap-1.5 rounded-lg bg-amber-50 px-2.5 py-1.5 text-[10px] font-black text-amber-600 dark:bg-amber-500/10 dark:text-amber-400"
                                >
                                    <span class="h-1.5 w-1.5 rounded-full bg-amber-500"></span>
                                    متوسط
                                </span>

                            @elseif ($task->priority === 'low')

                                <span
                                    class="inline-flex w-fit items-center gap-1.5 rounded-lg bg-emerald-50 px-2.5 py-1.5 text-[10px] font-black text-emerald-600 dark:bg-emerald-500/10 dark:text-emerald-400"
                                >
                                    <span class="h-1.5 w-1.5 rounded-full bg-emerald-500"></span>
                                    کم
                                </span>

                            @else

                                <span
                                    class="inline-flex w-fit items-center gap-1.5 rounded-lg bg-slate-100 px-2.5 py-1.5 text-[10px] font-black text-slate-500 dark:bg-slate-800 dark:text-slate-400"
                                >
                                    بدون اولویت
                                </span>

                            @endif


                            {{-- Status --}}
                            @if ($task->status === 'completed')

                                <span
                                    class="inline-flex w-fit items-center gap-1.5 text-xs font-bold text-emerald-500"
                                >
                                    <span class="h-1.5 w-1.5 rounded-full bg-emerald-500"></span>
                                    انجام شده
                                </span>

                            @else

                                <span
                                    class="inline-flex w-fit items-center gap-1.5 text-xs font-bold text-amber-500"
                                >
                                    <span class="h-1.5 w-1.5 rounded-full bg-amber-500"></span>
                                    در انتظار
                                </span>

                            @endif

                        </div>

                    @endforeach

                </div>

            @else

                {{-- Empty tasks --}}
                <div class="px-5 py-14 text-center">

                    <div
                        class="mx-auto grid h-14 w-14 place-items-center rounded-2xl bg-slate-100 text-slate-400 dark:bg-slate-800"
                    >

                        <svg
                            class="h-6 w-6"
                            viewBox="0 0 24 24"
                            fill="none"
                            stroke="currentColor"
                            stroke-width="1.8"
                        >
                            <path
                                d="M9 11l3 3L22 4"
                                stroke-linecap="round"
                                stroke-linejoin="round"
                            />

                            <path
                                d="M21 12v7a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h11"
                                stroke-linecap="round"
                            />
                        </svg>

                    </div>

                    <h3 class="mt-4 font-black">
                        هنوز کاری در این دسته‌بندی نیست
                    </h3>

                    <p class="mt-2 text-sm text-slate-400">
                        وقتی کاری به این دسته‌بندی اضافه شود، اینجا نمایش داده می‌شود.
                    </p>

                </div>

            @endif

        </section>

    @endif


    {{-- =========================================================
        Create Category Modal
    ========================================================== --}}
    <div
        x-show="showCreateModal"
        x-cloak
        class="fixed inset-0 z-[100] grid place-items-center overflow-y-auto p-4"
        @keydown.escape.window="showCreateModal = false"
    >

        {{-- Backdrop --}}
        <div
            x-show="showCreateModal"
            x-transition.opacity
            class="absolute inset-0 bg-slate-950/60 backdrop-blur-sm"
            @click="showCreateModal = false"
        ></div>


        {{-- Modal --}}
        <div
            x-show="showCreateModal"
            x-transition:enter="transition duration-200 ease-out"
            x-transition:enter-start="translate-y-4 scale-95 opacity-0"
            x-transition:enter-end="translate-y-0 scale-100 opacity-100"
            x-transition:leave="transition duration-150 ease-in"
            x-transition:leave-start="translate-y-0 scale-100 opacity-100"
            x-transition:leave-end="translate-y-4 scale-95 opacity-0"
            @click.outside="showCreateModal = false"
            class="relative my-8 w-full max-w-xl overflow-hidden rounded-3xl border border-slate-200 bg-white shadow-2xl dark:border-slate-800 dark:bg-slate-900"
        >

            {{-- Header --}}
            <div
                class="border-b border-slate-100 px-6 py-6 dark:border-slate-800"
            >

                <div class="flex items-start justify-between">

                    <div class="flex items-center gap-3">

                        <div
                            class="grid h-11 w-11 place-items-center rounded-2xl bg-indigo-50 text-indigo-600 dark:bg-indigo-500/10 dark:text-indigo-400"
                        >

                            <svg
                                class="h-5 w-5"
                                viewBox="0 0 24 24"
                                fill="none"
                                stroke="currentColor"
                                stroke-width="1.8"
                            >
                                <path
                                    d="M12 5v14M5 12h14"
                                    stroke-linecap="round"
                                />
                            </svg>

                        </div>

                        <div>

                            <h2 class="text-lg font-black">
                                ایجاد دسته‌بندی
                            </h2>

                            <p class="mt-1 text-xs text-slate-400">
                                اطلاعات دسته‌بندی جدید را وارد کن.
                            </p>

                        </div>

                    </div>


                    <button
                        type="button"
                        @click="showCreateModal = false"
                        class="grid h-9 w-9 place-items-center rounded-xl text-slate-400 transition hover:bg-slate-100 hover:text-slate-600 dark:hover:bg-slate-800"
                    >
                        ✕
                    </button>

                </div>

            </div>


            {{-- Form --}}
            <form
                wire:submit="createCategory"
                class="space-y-6 p-6"
            >

                {{-- Name --}}
                <div>

                    <label
                        for="categoryName"
                        class="text-sm font-bold"
                    >
                        نام دسته‌بندی
                    </label>

                    <input
                        id="categoryName"
                        type="text"
                        wire:model="name"
                        class="mt-2 h-12 w-full rounded-xl border border-slate-200 bg-slate-50 px-4 text-sm outline-none transition placeholder:text-slate-400 focus:border-indigo-500 focus:bg-white focus:ring-4 focus:ring-indigo-500/10 dark:border-slate-700 dark:bg-slate-800 dark:focus:bg-slate-900"
                        placeholder="مثلاً دانشگاه"
                    >

                    @error('name')
                        <p class="mt-2 text-xs font-medium text-rose-500">
                            {{ $message }}
                        </p>
                    @enderror

                </div>


                {{-- Color --}}
                <div>

                    <div class="flex items-center justify-between">

                        <label class="text-sm font-bold">
                            رنگ دسته‌بندی
                        </label>

                        <span
                            class="h-5 w-5 rounded-full ring-4 ring-slate-100 dark:ring-slate-800"
                            style="background-color: {{ $color }}"
                        ></span>

                    </div>


                    <div class="mt-3 grid grid-cols-9 gap-2">

                        @foreach ([
                            '#6366F1',
                            '#3B82F6',
                            '#8B5CF6',
                            '#EC4899',
                            '#EF4444',
                            '#F97316',
                            '#F59E0B',
                            '#10B981',
                            '#06B6D4',
                        ] as $categoryColor)

                            <button
                                type="button"
                                wire:click="$set('color', '{{ $categoryColor }}')"
                                class="grid aspect-square place-items-center rounded-xl transition hover:scale-105"
                                style="background-color: {{ $categoryColor }}"
                            >

                                @if ($color === $categoryColor)

                                    <svg
                                        class="h-4 w-4 text-white drop-shadow"
                                        viewBox="0 0 24 24"
                                        fill="none"
                                        stroke="currentColor"
                                        stroke-width="3"
                                    >
                                        <path
                                            d="m5 12 4 4L19 6"
                                            stroke-linecap="round"
                                            stroke-linejoin="round"
                                        />
                                    </svg>

                                @endif

                            </button>

                        @endforeach

                    </div>

                    @error('color')
                        <p class="mt-2 text-xs font-medium text-rose-500">
                            {{ $message }}
                        </p>
                    @enderror

                </div>


                {{-- Icon --}}
                <div>

                    <label class="text-sm font-bold">
                        آیکون
                    </label>

                    <div class="mt-3 grid grid-cols-5 gap-2">

                        @foreach ([
                            'folder' => 'پوشه',
                            'work' => 'کار',
                            'study' => 'تحصیل',
                            'personal' => 'شخصی',
                            'other' => 'سایر',
                        ] as $iconValue => $iconLabel)

                            <button
                                type="button"
                                wire:click="$set('icon', '{{ $iconValue }}')"
                                class="rounded-xl border px-2 py-3 text-center transition
                                {{ $icon === $iconValue
                                    ? 'border-indigo-500 bg-indigo-50 text-indigo-600 dark:border-indigo-500 dark:bg-indigo-500/10 dark:text-indigo-400'
                                    : 'border-slate-200 text-slate-500 hover:border-slate-300 hover:bg-slate-50 dark:border-slate-700 dark:hover:bg-slate-800' }}"
                            >

                                <div
                                    class="mx-auto grid h-8 w-8 place-items-center rounded-lg bg-slate-100 dark:bg-slate-800"
                                >
                                    <span class="text-sm">

                                        @if ($iconValue === 'folder')
                                            📁
                                        @elseif ($iconValue === 'work')
                                            💼
                                        @elseif ($iconValue === 'study')
                                            🎓
                                        @elseif ($iconValue === 'personal')
                                            👤
                                        @else
                                            ✦
                                        @endif

                                    </span>
                                </div>

                                <span class="mt-2 block text-[10px] font-bold">
                                    {{ $iconLabel }}
                                </span>

                            </button>

                        @endforeach

                    </div>

                    @error('icon')
                        <p class="mt-2 text-xs font-medium text-rose-500">
                            {{ $message }}
                        </p>
                    @enderror

                </div>


                {{-- Buttons --}}
                <div
                    class="flex gap-3 border-t border-slate-100 pt-5 dark:border-slate-800"
                >

                    <button
                        type="submit"
                        wire:loading.attr="disabled"
                        wire:target="createCategory"
                        class="flex h-12 flex-1 items-center justify-center rounded-xl bg-indigo-600 px-5 text-sm font-bold text-white transition hover:bg-indigo-700 disabled:cursor-not-allowed disabled:opacity-60"
                    >

                        <span
                            wire:loading.remove
                            wire:target="createCategory"
                        >
                            ایجاد دسته‌بندی
                        </span>

                        <span
                            wire:loading
                            wire:target="createCategory"
                        >
                            در حال ایجاد...
                        </span>

                    </button>


                    <button
                        type="button"
                        @click="showCreateModal = false"
                        class="h-12 rounded-xl border border-slate-200 px-5 text-sm font-bold text-slate-600 dark:border-slate-700 dark:text-slate-300"
                    >
                        انصراف
                    </button>

                </div>

            </form>

        </div>

    </div>


    {{-- =========================================================
        Edit Category Modal
    ========================================================== --}}
    <div
        x-data="{ open: false }"
        x-on:open-edit-category-modal.window="open = true"
        x-on:close-edit-category-modal.window="open = false"
        x-show="open"
        x-cloak
        class="fixed inset-0 z-[110] grid place-items-center overflow-y-auto p-4"
        @keydown.escape.window="open = false"
    >

        {{-- Backdrop --}}
        <div
            x-show="open"
            x-transition.opacity
            class="absolute inset-0 bg-slate-950/60 backdrop-blur-sm"
            @click="open = false"
        ></div>


        {{-- Modal --}}
        <div
            x-show="open"
            x-transition:enter="transition duration-200 ease-out"
            x-transition:enter-start="translate-y-4 scale-95 opacity-0"
            x-transition:enter-end="translate-y-0 scale-100 opacity-100"
            x-transition:leave="transition duration-150 ease-in"
            x-transition:leave-start="translate-y-0 scale-100 opacity-100"
            x-transition:leave-end="translate-y-4 scale-95 opacity-0"
            @click.outside="open = false"
            class="relative my-8 w-full max-w-lg overflow-hidden rounded-3xl border border-slate-200 bg-white shadow-2xl dark:border-slate-800 dark:bg-slate-900"
        >

            {{-- Header --}}
            <div
                class="border-b border-slate-100 px-6 py-6 dark:border-slate-800"
            >

                <div class="flex items-start justify-between">

                    <div>

                        <h2 class="text-xl font-black">
                            ویرایش دسته‌بندی
                        </h2>

                        <p class="mt-1 text-xs text-slate-400">
                            اطلاعات دسته‌بندی را تغییر بده.
                        </p>

                    </div>


                    <button
                        type="button"
                        @click="open = false"
                        class="grid h-9 w-9 place-items-center rounded-xl bg-slate-100 text-slate-500 transition hover:bg-slate-200 dark:bg-slate-800 dark:hover:bg-slate-700"
                    >
                        ✕
                    </button>

                </div>

            </div>


            {{-- Form --}}
            <form
                wire:submit="updateCategory"
                class="space-y-6 p-6"
            >

                {{-- Name --}}
                <div>

                    <label
                        for="editCategoryName"
                        class="block text-sm font-bold"
                    >
                        نام دسته‌بندی
                    </label>

                    <input
                        id="editCategoryName"
                        type="text"
                        wire:model="editName"
                        class="mt-2 h-12 w-full rounded-xl border border-slate-200 bg-slate-50 px-4 text-sm outline-none transition focus:border-indigo-500 focus:bg-white focus:ring-4 focus:ring-indigo-500/10 dark:border-slate-700 dark:bg-slate-800 dark:focus:bg-slate-900"
                        placeholder="مثلاً دانشگاه"
                    >

                    @error('editName')
                        <p class="mt-2 text-xs text-rose-500">
                            {{ $message }}
                        </p>
                    @enderror

                </div>


                {{-- Color --}}
                <div>

                    <label class="block text-sm font-bold">
                        رنگ دسته‌بندی
                    </label>

                    <div class="mt-3 grid grid-cols-9 gap-2">

                        @foreach ([
                            '#6366F1',
                            '#3B82F6',
                            '#8B5CF6',
                            '#EC4899',
                            '#EF4444',
                            '#F97316',
                            '#F59E0B',
                            '#10B981',
                            '#06B6D4',
                        ] as $editColorOption)

                            <button
                                type="button"
                                wire:click="$set('editColor', '{{ $editColorOption }}')"
                                class="grid aspect-square place-items-center rounded-xl transition hover:scale-105"
                                style="background-color: {{ $editColorOption }}"
                            >

                                @if ($editColor === $editColorOption)

                                    <svg
                                        class="h-4 w-4 text-white drop-shadow"
                                        viewBox="0 0 24 24"
                                        fill="none"
                                        stroke="currentColor"
                                        stroke-width="3"
                                    >
                                        <path
                                            d="m5 12 4 4L19 6"
                                            stroke-linecap="round"
                                            stroke-linejoin="round"
                                        />
                                    </svg>

                                @endif

                            </button>

                        @endforeach

                    </div>

                    @error('editColor')
                        <p class="mt-2 text-xs text-rose-500">
                            {{ $message }}
                        </p>
                    @enderror

                </div>


                {{-- Icon --}}
                <div>

                    <label class="block text-sm font-bold">
                        آیکون
                    </label>

                    <div class="mt-3 grid grid-cols-5 gap-2">

                        @foreach ([
                            'folder' => 'پوشه',
                            'work' => 'کار',
                            'study' => 'تحصیل',
                            'personal' => 'شخصی',
                            'other' => 'سایر',
                        ] as $editIconValue => $editIconLabel)

                            <button
                                type="button"
                                wire:click="$set('editIcon', '{{ $editIconValue }}')"
                                class="rounded-xl border px-2 py-3 text-center transition
                                {{ $editIcon === $editIconValue
                                    ? 'border-indigo-500 bg-indigo-50 text-indigo-600 dark:border-indigo-500 dark:bg-indigo-500/10 dark:text-indigo-400'
                                    : 'border-slate-200 text-slate-500 hover:border-slate-300 hover:bg-slate-50 dark:border-slate-700 dark:hover:bg-slate-800' }}"
                            >

                                <div
                                    class="mx-auto grid h-8 w-8 place-items-center rounded-lg bg-slate-100 dark:bg-slate-800"
                                >

                                    @if ($editIconValue === 'folder')
                                        📁
                                    @elseif ($editIconValue === 'work')
                                        💼
                                    @elseif ($editIconValue === 'study')
                                        🎓
                                    @elseif ($editIconValue === 'personal')
                                        👤
                                    @else
                                        ✦
                                    @endif

                                </div>

                                <span class="mt-2 block text-[10px] font-bold">
                                    {{ $editIconLabel }}
                                </span>

                            </button>

                        @endforeach

                    </div>

                    @error('editIcon')
                        <p class="mt-2 text-xs text-rose-500">
                            {{ $message }}
                        </p>
                    @enderror

                </div>


                {{-- Buttons --}}
                <div
                    class="flex gap-3 border-t border-slate-100 pt-5 dark:border-slate-800"
                >

                    <button
                        type="submit"
                        wire:loading.attr="disabled"
                        wire:target="updateCategory"
                        class="flex h-12 flex-1 items-center justify-center rounded-xl bg-indigo-600 px-5 text-sm font-bold text-white transition hover:bg-indigo-700 disabled:cursor-not-allowed disabled:opacity-60"
                    >

                        <span
                            wire:loading.remove
                            wire:target="updateCategory"
                        >
                            ذخیره تغییرات
                        </span>

                        <span
                            wire:loading
                            wire:target="updateCategory"
                        >
                            در حال ذخیره...
                        </span>

                    </button>


                    <button
                        type="button"
                        @click="open = false"
                        class="h-12 rounded-xl border border-slate-200 px-5 text-sm font-bold text-slate-600 dark:border-slate-700 dark:text-slate-300"
                    >
                        انصراف
                    </button>

                </div>

            </form>

        </div>

    </div>


    {{-- =========================================================
        Delete Confirmation Modal
    ========================================================== --}}
    <div
        x-show="showDeleteModal"
        x-cloak
        class="fixed inset-0 z-[120] grid place-items-center p-4"
        @keydown.escape.window="showDeleteModal = false"
    >

        {{-- Backdrop --}}
        <div
            x-show="showDeleteModal"
            x-transition.opacity
            class="absolute inset-0 bg-slate-950/60 backdrop-blur-sm"
            @click="showDeleteModal = false"
        ></div>


        {{-- Modal --}}
        <div
            x-show="showDeleteModal"
            x-transition:enter="transition duration-200 ease-out"
            x-transition:enter-start="translate-y-4 scale-95 opacity-0"
            x-transition:enter-end="translate-y-0 scale-100 opacity-100"
            x-transition:leave="transition duration-150 ease-in"
            x-transition:leave-start="translate-y-0 scale-100 opacity-100"
            x-transition:leave-end="translate-y-4 scale-95 opacity-0"
            @click.outside="showDeleteModal = false"
            class="relative w-full max-w-md overflow-hidden rounded-3xl border border-slate-200 bg-white shadow-2xl dark:border-slate-800 dark:bg-slate-900"
        >

            <div class="p-6">

                {{-- Icon --}}
                <div
                    class="grid h-14 w-14 place-items-center rounded-2xl bg-rose-50 text-rose-500 dark:bg-rose-500/10 dark:text-rose-400"
                >

                    <svg
                        class="h-6 w-6"
                        viewBox="0 0 24 24"
                        fill="none"
                        stroke="currentColor"
                        stroke-width="1.8"
                    >
                        <path
                            d="M3 6h18"
                            stroke-linecap="round"
                        />

                        <path
                            d="M8 6V4h8v2"
                            stroke-linecap="round"
                        />

                        <path
                            d="M19 6l-1 15H6L5 6"
                            stroke-linejoin="round"
                        />
                    </svg>

                </div>


                <h2 class="mt-5 text-lg font-black">
                    حذف دسته‌بندی؟
                </h2>


                <p class="mt-2 text-sm leading-6 text-slate-500 dark:text-slate-400">

                    آیا مطمئنی می‌خواهی دسته‌بندی

                    <span
                        class="font-bold text-slate-900 dark:text-white"
                        x-text="deleteCategoryName"
                    ></span>

                    را حذف کنی؟

                </p>


                <div
                    class="mt-4 rounded-2xl border border-amber-200 bg-amber-50 px-4 py-3 text-xs leading-5 text-amber-700 dark:border-amber-500/20 dark:bg-amber-500/10 dark:text-amber-400"
                >
                    حذف دسته‌بندی ممکن است روی کارهایی که به آن مربوط هستند تأثیر بگذارد.
                </div>


                {{-- Buttons --}}
                <div class="mt-6 flex gap-3">

                    <button
                        type="button"
                        @click="
                            $wire.deleteCategory(deleteCategoryId);
                            showDeleteModal = false;
                        "
                        class="flex h-11 flex-1 items-center justify-center rounded-xl bg-rose-600 px-5 text-sm font-bold text-white transition hover:bg-rose-700"
                    >
                        حذف دسته‌بندی
                    </button>


                    <button
                        type="button"
                        @click="showDeleteModal = false"
                        class="h-11 rounded-xl border border-slate-200 px-5 text-sm font-bold text-slate-600 dark:border-slate-700 dark:text-slate-300"
                    >
                        انصراف
                    </button>

                </div>

            </div>

        </div>

    </div>

</div>