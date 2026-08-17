<div x-data="{ showCreateModal: false }" x-on:category-created.window="showCreateModal = false" class="space-y-8">

    {{-- =========================================================
        Header
    ========================================================== --}}
    <section
        class="relative overflow-hidden rounded-3xl border border-slate-200 bg-white p-6 shadow-sm dark:border-slate-800 dark:bg-slate-900 sm:p-8">

        {{-- Decorative background --}}
        <div class="pointer-events-none absolute -left-20 -top-20 h-48 w-48 rounded-full bg-indigo-500/10 blur-3xl">
        </div>

        <div class="relative flex flex-col gap-6 sm:flex-row sm:items-center sm:justify-between">

            <div class="flex items-start gap-4">

                {{-- Icon --}}
                <div
                    class="grid h-14 w-14 shrink-0 place-items-center rounded-2xl bg-indigo-50 text-indigo-600 dark:bg-indigo-500/10 dark:text-indigo-400">
                    <svg class="h-7 w-7" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8">
                        <path d="M3 7a2 2 0 0 1 2-2h5l2 2h7a2 2 0 0 1 2 2v8a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V7Z"
                            stroke-linejoin="round" />
                    </svg>
                </div>

                <div>
                    <p class="text-sm font-bold text-indigo-600 dark:text-indigo-400">
                        مدیریت دسته‌بندی‌ها
                    </p>

                    <h2 class="mt-1 text-2xl font-black tracking-tight sm:text-3xl">
                        دسته‌بندی‌های من
                    </h2>

                    <p class="mt-2 max-w-xl text-sm leading-6 text-slate-500 dark:text-slate-400">
                        کارهایت را با دسته‌بندی‌های مختلف مرتب و منظم نگه دار.
                    </p>
                </div>

            </div>

            {{-- Create --}}
            <button type="button" @click="showCreateModal = true"
                class="inline-flex h-12 shrink-0 items-center justify-center gap-2 rounded-2xl bg-indigo-600 px-5 text-sm font-bold text-white shadow-lg shadow-indigo-500/20 transition hover:-translate-y-0.5 hover:bg-indigo-700 active:translate-y-0">
                <svg class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2">
                    <path d="M12 5v14M5 12h14" stroke-linecap="round" />
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
                <h3 class="text-base font-black">
                    Categories
                </h3>

                <p class="mt-1 text-xs text-slate-400">
                    {{ $categories->count() }}
                    دسته‌بندی
                </p>
            </div>



        </div>


        @if ($categories->count())

            <div class="grid gap-3 p-4 sm:grid-cols-2 lg:grid-cols-3">

                @foreach ($categories as $category)
                    <div
                        class="group relative overflow-hidden rounded-2xl border border-slate-200 bg-slate-50/70 p-4 transition duration-200 hover:-translate-y-0.5 hover:border-slate-300 hover:bg-white hover:shadow-md dark:border-slate-800 dark:bg-slate-800/40 dark:hover:border-slate-700 dark:hover:bg-slate-800">

                        {{-- Color accent --}}
                        <div class="absolute inset-x-0 top-0 h-1" style="background-color: {{ $category->color }}">
                        </div>


                        <div class="flex items-start gap-3">

                            {{-- Icon --}}
                            <div class="grid h-11 w-11 shrink-0 place-items-center rounded-xl"
                                style="
                                    background-color: {{ $category->color }}18;
                                    color: {{ $category->color }};
                                ">

                                @if ($category->icon === 'folder')
                                    <svg class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                        stroke-width="1.8">
                                        <path
                                            d="M3 7a2 2 0 0 1 2-2h5l2 2h7a2 2 0 0 1 2 2v8a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V7Z"
                                            stroke-linejoin="round" />
                                    </svg>
                                @elseif ($category->icon === 'work')
                                    <svg class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                        stroke-width="1.8">
                                        <rect x="3" y="7" width="18" height="13" rx="2" />
                                        <path d="M8 7V5a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2" stroke-linecap="round" />
                                    </svg>
                                @elseif ($category->icon === 'study')
                                    <svg class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                        stroke-width="1.8">
                                        <path d="m3 9 9-5 9 5-9 5-9-5Z" stroke-linejoin="round" />
                                        <path d="M7 11v5c3 2 7 2 10 0v-5" stroke-linecap="round" />
                                    </svg>
                                @elseif ($category->icon === 'personal')
                                    <svg class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                        stroke-width="1.8">
                                        <circle cx="12" cy="8" r="3" />
                                        <path d="M5 20a7 7 0 0 1 14 0" stroke-linecap="round" />
                                    </svg>
                                @else
                                    <svg class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                        stroke-width="1.8">
                                        <path d="M12 3v18M3 12h18" stroke-linecap="round" />
                                    </svg>
                                @endif

                            </div>


                            {{-- Info --}}
                            <div class="min-w-0 flex-1">

                                <h4 class="truncate text-sm font-black text-slate-900 dark:text-white">
                                    {{ $category->name }}
                                </h4>

                                <p class="mt-1 text-xs text-slate-400">
                                    {{ $category->tasks_count }}
                                    کار
                                </p>

                            </div>




                        </div>


                        {{-- Bottom --}}
                        <div
                            class="mt-4 flex items-center justify-between border-t border-slate-200/70 pt-3 dark:border-slate-700/70">
                            <span class="text-[10px] font-medium text-slate-400">
                                {{ $category->tasks_count }} کار
                            </span>

                        </div>

                    </div>
                @endforeach

            </div>
        @else
            {{-- Empty --}}
            <div class="px-5 py-20 text-center">

                <div
                    class="mx-auto grid h-16 w-16 place-items-center rounded-2xl bg-indigo-50 text-indigo-500 dark:bg-indigo-500/10 dark:text-indigo-400">
                    <svg class="h-7 w-7" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="1.8">
                        <path d="M3 7a2 2 0 0 1 2-2h5l2 2h7a2 2 0 0 1 2 2v8a2 2 0 0 1-2 2H5a2 2 0 0 1-2-2V7Z"
                            stroke-linejoin="round" />
                    </svg>
                </div>

                <h4 class="mt-5 font-black">
                    هنوز دسته‌بندی‌ای نداری
                </h4>

                <p class="mx-auto mt-2 max-w-sm text-sm leading-6 text-slate-400">
                    اولین دسته‌بندی خودت را ایجاد کن تا کارهایت را بهتر مرتب کنی.
                </p>

                <button type="button" @click="showCreateModal = true"
                    class="mt-6 inline-flex items-center gap-2 rounded-xl bg-indigo-600 px-5 py-2.5 text-sm font-bold text-white transition hover:bg-indigo-700">
                    <span class="text-lg">+</span>
                    ایجاد دسته‌بندی
                </button>

            </div>

        @endif

    </section>


    {{-- =========================================================
        Create Modal
    ========================================================== --}}
    <div x-show="showCreateModal" x-cloak class="fixed inset-0 z-[100] grid place-items-center overflow-y-auto p-4"
        @keydown.escape.window="showCreateModal = false">

        {{-- Backdrop --}}
        <div x-show="showCreateModal" x-transition.opacity class="absolute inset-0 bg-slate-950/60 backdrop-blur-sm"
            @click="showCreateModal = false"></div>


        {{-- Modal --}}
        <div x-show="showCreateModal" x-transition:enter="transition duration-200 ease-out"
            x-transition:enter-start="translate-y-4 scale-95 opacity-0"
            x-transition:enter-end="translate-y-0 scale-100 opacity-100"
            x-transition:leave="transition duration-150 ease-in"
            x-transition:leave-start="translate-y-0 scale-100 opacity-100"
            x-transition:leave-end="translate-y-4 scale-95 opacity-0" @click.outside="showCreateModal = false"
            class="relative my-8 w-full max-w-xl overflow-hidden rounded-3xl border border-slate-200 bg-white shadow-2xl dark:border-slate-800 dark:bg-slate-900">

            {{-- Modal Header --}}
            <div class="relative overflow-hidden border-b border-slate-100 px-6 py-6 dark:border-slate-800">

                <div
                    class="pointer-events-none absolute -right-10 -top-16 h-40 w-40 rounded-full bg-indigo-500/10 blur-3xl">
                </div>

                <div class="relative flex items-start justify-between">

                    <div class="flex items-center gap-3">

                        <div
                            class="grid h-11 w-11 place-items-center rounded-2xl bg-indigo-50 text-indigo-600 dark:bg-indigo-500/10 dark:text-indigo-400">
                            <svg class="h-5 w-5" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                                stroke-width="1.8">
                                <path d="M12 5v14M5 12h14" stroke-linecap="round" />
                            </svg>
                        </div>

                        <div>
                            <h3 class="text-lg font-black">
                                ایجاد دسته‌بندی
                            </h3>

                            <p class="mt-1 text-xs text-slate-400">
                                اطلاعات دسته‌بندی جدید را وارد کن.
                            </p>
                        </div>

                    </div>

                    <button type="button" @click="showCreateModal = false"
                        class="grid h-9 w-9 place-items-center rounded-xl text-slate-400 transition hover:bg-slate-100 hover:text-slate-600 dark:hover:bg-slate-800 dark:hover:text-slate-200">
                        <svg class="h-4 w-4" viewBox="0 0 24 24" fill="none" stroke="currentColor"
                            stroke-width="2">
                            <path d="M6 6l12 12M18 6 6 18" stroke-linecap="round" />
                        </svg>
                    </button>

                </div>

            </div>


            {{-- Form --}}
            <form wire:submit="createCategory" class="space-y-6 p-6">

                {{-- Name --}}
                <div>

                    <label for="categoryName" class="text-sm font-bold">
                        نام دسته‌بندی
                    </label>

                    <div class="relative mt-2">

                        <input id="categoryName" type="text" wire:model="name"
                            class="h-12 w-full rounded-xl border border-slate-200 bg-slate-50 px-4 text-sm outline-none transition placeholder:text-slate-400 focus:border-indigo-500 focus:bg-white focus:ring-4 focus:ring-indigo-500/10 dark:border-slate-700 dark:bg-slate-800 dark:focus:bg-slate-900"
                            placeholder="مثلاً دانشگاه">

                    </div>

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

                        <span class="h-5 w-5 rounded-full ring-4 ring-slate-100 dark:ring-slate-800"
                            style="background-color: {{ $color }}"></span>

                    </div>

                    <div class="mt-3 grid grid-cols-9 gap-2">

                        @foreach (['#6366F1', '#3B82F6', '#8B5CF6', '#EC4899', '#EF4444', '#F97316', '#F59E0B', '#10B981', '#06B6D4'] as $categoryColor)
                            <button type="button" wire:click="$set('color', '{{ $categoryColor }}')"
                                class="group relative grid aspect-square place-items-center rounded-xl transition hover:scale-105"
                                style="background-color: {{ $categoryColor }}">

                                @if ($color === $categoryColor)
                                    <svg class="h-4 w-4 text-white drop-shadow" viewBox="0 0 24 24" fill="none"
                                        stroke="currentColor" stroke-width="3">
                                        <path d="m5 12 4 4L19 6" stroke-linecap="round" stroke-linejoin="round" />
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
                            <button type="button" wire:click="$set('icon', '{{ $iconValue }}')"
                                class="rounded-xl border px-2 py-3 text-center transition
                                    {{ $icon === $iconValue
                                        ? 'border-indigo-500 bg-indigo-50 text-indigo-600 dark:border-indigo-500 dark:bg-indigo-500/10 dark:text-indigo-400'
                                        : 'border-slate-200 text-slate-500 hover:border-slate-300 hover:bg-slate-50 dark:border-slate-700 dark:hover:bg-slate-800' }}">

                                <div
                                    class="mx-auto grid h-8 w-8 place-items-center rounded-lg bg-slate-100 dark:bg-slate-800">
                                    <span class="text-xs">
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


                {{-- Actions --}}
                <div class="flex gap-3 border-t border-slate-100 pt-5 dark:border-slate-800">

                    <button type="submit" wire:loading.attr="disabled" wire:target="createCategory"
                        class="flex h-12 flex-1 items-center justify-center rounded-xl bg-indigo-600 px-5 text-sm font-bold text-white shadow-lg shadow-indigo-500/10 transition hover:bg-indigo-700 disabled:cursor-not-allowed disabled:opacity-60">

                        <span wire:loading.remove wire:target="createCategory">
                            ایجاد دسته‌بندی
                        </span>

                        <span wire:loading wire:target="createCategory">
                            در حال ایجاد...
                        </span>

                    </button>

                    <button type="button" @click="showCreateModal = false"
                        class="h-12 rounded-xl border border-slate-200 px-5 text-sm font-bold text-slate-600 transition hover:bg-slate-50 dark:border-slate-700 dark:text-slate-300 dark:hover:bg-slate-800">
                        انصراف
                    </button>

                </div>

            </form>

        </div>

    </div>

</div>
