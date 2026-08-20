@section('title', 'Categories — DoNext')
@section('heading', 'Categories / دسته‌بندی‌ها')

<div x-data="{
    lang: localStorage.getItem('language') || 'fa',
    createOpen: false,
    editOpen: false,
    deleteOpen: false,
    deleteId: null,
    deleteName: '',
    sync() {
        this.lang = localStorage.getItem('language') || 'fa';
    }
}" x-init="window.addEventListener('donext-language-changed', () => sync())" class="space-y-6">

    <section class="rounded-3xl border border-slate-200 bg-white p-6 shadow-sm dark:border-slate-800 dark:bg-slate-900 sm:p-8">
        <div class="flex flex-col gap-6 sm:flex-row sm:items-center sm:justify-between">
            <div>
                <p class="text-sm font-bold text-indigo-600 dark:text-indigo-400">
                    <span x-show="lang === 'fa'">مدیریت دسته‌بندی‌ها</span>
                    <span x-show="lang === 'en'">Category management</span>
                </p>
                <h1 class="mt-1 text-2xl font-black sm:text-3xl">
                    <span x-show="lang === 'fa'">دسته‌بندی‌های من</span>
                    <span x-show="lang === 'en'">My categories</span>
                </h1>
                <p class="mt-2 text-sm text-slate-500 dark:text-slate-400">
                    <span x-show="lang === 'fa'">کارهایت را با دسته‌بندی‌های مختلف مرتب و منظم نگه دار.</span>
                    <span x-show="lang === 'en'">Keep your tasks organized with different categories.</span>
                </p>
            </div>
            <button type="button" @click="createOpen = true" class="inline-flex h-12 items-center justify-center gap-2 rounded-2xl bg-indigo-600 px-5 text-sm font-bold text-white hover:bg-indigo-700">
                + <span x-show="lang === 'fa'">دسته‌بندی جدید</span><span x-show="lang === 'en'">New Category</span>
            </button>
        </div>
    </section>

    <section class="overflow-hidden rounded-3xl border border-slate-200 bg-white shadow-sm dark:border-slate-800 dark:bg-slate-900">
        <div class="border-b border-slate-100 px-5 py-5 dark:border-slate-800">
            <h2 class="font-black"><span x-show="lang === 'fa'">دسته‌بندی‌ها</span><span x-show="lang === 'en'">Categories</span></h2>
            <p class="mt-1 text-xs text-slate-400">{{ $categories->count() }} <span x-show="lang === 'fa'">دسته‌بندی</span><span x-show="lang === 'en'">categories</span></p>
        </div>

        @if ($categories->count())
            <div class="grid gap-4 p-4 sm:grid-cols-2 lg:grid-cols-3">
                @foreach ($categories as $category)
                    <div wire:key="category-{{ $category->id }}" class="overflow-hidden rounded-2xl border border-slate-200 dark:border-slate-800">
                        <div class="h-1" style="background-color: {{ $category->color }}"></div>
                        <button type="button" wire:click="selectCategory({{ $category->id }})" class="block w-full p-5 text-start hover:bg-slate-50 dark:hover:bg-slate-800/50">
                            <div class="flex items-start gap-3">
                                <div class="grid h-11 w-11 shrink-0 place-items-center rounded-xl" style="background-color: {{ $category->color }}18; color: {{ $category->color }}">
                                    @if ($category->icon === 'folder') 📁 @elseif ($category->icon === 'work') 💼 @elseif ($category->icon === 'study') 🎓 @elseif ($category->icon === 'personal') 👤 @else ✦ @endif
                                </div>
                                <div class="min-w-0 flex-1">
                                    <h3 class="truncate text-sm font-black">{{ $category->name }}</h3>
                                    <p class="mt-1 text-xs text-slate-400">{{ $category->tasks_count }} <span x-show="lang === 'fa'">کار</span><span x-show="lang === 'en'">tasks</span></p>
                                </div>
                                <span>{{ $selectedCategoryId === $category->id ? '⌃' : '⌄' }}</span>
                            </div>
                            <div class="mt-4 flex items-center justify-between border-t border-slate-100 pt-3 dark:border-slate-800">
                                <span class="text-[11px] text-slate-400">{{ $category->tasks_count }} <span x-show="lang === 'fa'">کار</span><span x-show="lang === 'en'">tasks</span></span>
                                <span class="text-[11px] font-bold text-indigo-500">
                                    <span x-show="lang === 'fa'">{{ $selectedCategoryId === $category->id ? 'بستن کارها' : 'مشاهده کارها' }}</span>
                                    <span x-show="lang === 'en'">{{ $selectedCategoryId === $category->id ? 'Hide tasks' : 'View tasks' }}</span>
                                </span>
                            </div>
                        </button>
                        <div class="flex gap-2 border-t border-slate-100 p-3 dark:border-slate-800">
                            <button type="button" wire:click="editCategory({{ $category->id }})" class="flex-1 rounded-xl px-3 py-2 text-xs font-bold hover:bg-indigo-50 dark:hover:bg-indigo-500/10"><span x-show="lang === 'fa'">ویرایش</span><span x-show="lang === 'en'">Edit</span></button>
                            <button type="button" @click="deleteId={{ $category->id }}; deleteName=@js($category->name); deleteOpen=true" class="flex-1 rounded-xl px-3 py-2 text-xs font-bold text-rose-500 hover:bg-rose-50 dark:hover:bg-rose-500/10"><span x-show="lang === 'fa'">حذف</span><span x-show="lang === 'en'">Delete</span></button>
                        </div>
                    </div>
                @endforeach
            </div>
        @else
            <div class="px-5 py-16 text-center">
                <h3 class="font-black"><span x-show="lang === 'fa'">هنوز دسته‌بندی‌ای نداری</span><span x-show="lang === 'en'">You have no categories yet</span></h3>
                <p class="mt-2 text-sm text-slate-400"><span x-show="lang === 'fa'">اولین دسته‌بندی خودت را ایجاد کن تا کارهایت را بهتر مرتب کنی.</span><span x-show="lang === 'en'">Create your first category to organize your tasks better.</span></p>
                <button type="button" @click="createOpen=true" class="mt-5 rounded-xl bg-indigo-600 px-5 py-2.5 text-sm font-bold text-white"><span x-show="lang === 'fa'">ایجاد دسته‌بندی</span><span x-show="lang === 'en'">Create category</span></button>
            </div>
        @endif
    </section>

    @if ($selectedCategoryId)
        @php($selectedCategory = $categories->firstWhere('id', $selectedCategoryId))
        <section class="overflow-hidden rounded-3xl border border-slate-200 bg-white shadow-sm dark:border-slate-800 dark:bg-slate-900">
            <div class="flex items-center justify-between border-b border-slate-100 px-5 py-5 dark:border-slate-800">
                <div>
                    <p class="text-xs font-semibold text-slate-400"><span x-show="lang === 'fa'">کارهای دسته‌بندی</span><span x-show="lang === 'en'">Category tasks</span></p>
                    <h2 class="mt-1 font-black">{{ $selectedCategory?->name }}</h2>
                </div>
                <span class="rounded-xl bg-slate-100 px-3 py-2 text-xs font-bold dark:bg-slate-800">{{ $categoryTasks->count() }} <span x-show="lang === 'fa'">کار</span><span x-show="lang === 'en'">tasks</span></span>
            </div>
            @if ($categoryTasks->count())
                <div class="divide-y divide-slate-100 dark:divide-slate-800">
                    @foreach ($categoryTasks as $task)
                        <div wire:key="category-task-{{ $task->id }}" class="flex flex-col gap-3 px-5 py-4 sm:flex-row sm:items-center">
                            <div class="min-w-0 flex-1">
                                <h3 class="truncate text-sm font-bold {{ $task->status === 'completed' ? 'text-slate-400 line-through' : '' }}">{{ $task->title }}</h3>
                                @if ($task->description)<p class="mt-1 text-xs text-slate-400">{{ $task->description }}</p>@endif
                            </div>
                            <span class="text-xs text-slate-400">
                                @if ($task->due_date){{ $task->due_date->format('Y-m-d') }}@else<span x-show="lang === 'fa'">بدون تاریخ</span><span x-show="lang === 'en'">No date</span>@endif
                            </span>
                            @if ($task->priority === 'high')<span class="text-[10px] font-black text-rose-500"><span x-show="lang === 'fa'">زیاد</span><span x-show="lang === 'en'">High</span></span>
                            @elseif ($task->priority === 'medium')<span class="text-[10px] font-black text-amber-500"><span x-show="lang === 'fa'">متوسط</span><span x-show="lang === 'en'">Medium</span></span>
                            @elseif ($task->priority === 'low')<span class="text-[10px] font-black text-emerald-500"><span x-show="lang === 'fa'">کم</span><span x-show="lang === 'en'">Low</span></span>@endif
                            <span class="text-xs font-bold {{ $task->status === 'completed' ? 'text-emerald-500' : 'text-amber-500' }}"><span x-show="lang === 'fa'">{{ $task->status === 'completed' ? 'انجام شده' : 'در انتظار' }}</span><span x-show="lang === 'en'">{{ $task->status === 'completed' ? 'Completed' : 'Pending' }}</span></span>
                        </div>
                    @endforeach
                </div>
            @else
                <div class="px-5 py-12 text-center">
                    <h3 class="font-black"><span x-show="lang === 'fa'">هنوز کاری در این دسته‌بندی نیست</span><span x-show="lang === 'en'">No tasks in this category yet</span></h3>
                    <p class="mt-2 text-sm text-slate-400"><span x-show="lang === 'fa'">وقتی کاری به این دسته‌بندی اضافه شود، اینجا نمایش داده می‌شود.</span><span x-show="lang === 'en'">Tasks added to this category will appear here.</span></p>
                </div>
            @endif
        </section>
    @endif

    {{-- Create modal --}}
    <div x-show="createOpen" x-cloak class="fixed inset-0 z-[100] grid place-items-center bg-slate-950/60 p-4" @keydown.escape.window="createOpen=false">
        <div @click.outside="createOpen=false" class="w-full max-w-xl rounded-3xl bg-white shadow-2xl dark:bg-slate-900">
            <div class="border-b border-slate-100 p-6 dark:border-slate-800"><h2 class="font-black"><span x-show="lang === 'fa'">ایجاد دسته‌بندی</span><span x-show="lang === 'en'">Create category</span></h2><p class="mt-1 text-xs text-slate-400"><span x-show="lang === 'fa'">اطلاعات دسته‌بندی جدید را وارد کن.</span><span x-show="lang === 'en'">Enter the new category details.</span></p></div>
            <form wire:submit="createCategory" class="space-y-5 p-6">
                <div><label class="text-sm font-bold"><span x-show="lang === 'fa'">نام دسته‌بندی</span><span x-show="lang === 'en'">Category name</span></label><input type="text" wire:model="name" x-bind:placeholder="lang === 'fa' ? 'مثلاً دانشگاه' : 'e.g. University'" class="mt-2 h-12 w-full rounded-xl border bg-slate-50 px-4 text-sm dark:border-slate-700 dark:bg-slate-800"></div>
                @error('name')<p class="text-xs text-rose-500">{{ $message }}</p>@enderror
                <div><label class="text-sm font-bold"><span x-show="lang === 'fa'">رنگ دسته‌بندی</span><span x-show="lang === 'en'">Category color</span></label><div class="mt-3 grid grid-cols-9 gap-2">@foreach($colorOptions as $c)<button type="button" wire:click="$set('color','{{ $c }}')" class="aspect-square rounded-xl" style="background-color:{{ $c }}">@if($color===$c)✓@endif</button>@endforeach</div></div>
                <div><label class="text-sm font-bold"><span x-show="lang === 'fa'">آیکون</span><span x-show="lang === 'en'">Icon</span></label><div class="mt-3 grid grid-cols-5 gap-2">@foreach(['folder'=>['📁','پوشه','Folder'],'work'=>['💼','کار','Work'],'study'=>['🎓','تحصیل','Study'],'personal'=>['👤','شخصی','Personal'],'other'=>['✦','سایر','Other']] as $v=>$i)<button type="button" wire:click="$set('icon','{{ $v }}')" class="rounded-xl border p-3 text-center {{ $icon===$v ? 'border-indigo-500 bg-indigo-50' : 'border-slate-200' }}"><span>{{ $i[0] }}</span><span class="mt-1 block text-[10px] font-bold"><span x-show="lang === 'fa'">{{ $i[1] }}</span><span x-show="lang === 'en'">{{ $i[2] }}</span></span></button>@endforeach</div></div>
                <div class="flex gap-3 border-t pt-5 dark:border-slate-800"><button type="submit" class="flex-1 rounded-xl bg-indigo-600 py-3 text-sm font-bold text-white"><span wire:loading.remove wire:target="createCategory"><span x-show="lang === 'fa'">ایجاد دسته‌بندی</span><span x-show="lang === 'en'">Create category</span></span><span wire:loading wire:target="createCategory">...</span></button><button type="button" @click="createOpen=false" class="rounded-xl border px-5 text-sm font-bold"><span x-show="lang === 'fa'">انصراف</span><span x-show="lang === 'en'">Cancel</span></button></div>
            </form>
        </div>
    </div>

    {{-- Edit modal --}}
    <div x-show="editOpen" x-cloak class="fixed inset-0 z-[110] grid place-items-center bg-slate-950/60 p-4" @keydown.escape.window="editOpen=false" x-on:open-edit-category-modal.window="editOpen=true" x-on:close-edit-category-modal.window="editOpen=false">
        <div @click.outside="editOpen=false" class="w-full max-w-xl rounded-3xl bg-white shadow-2xl dark:bg-slate-900">
            <div class="border-b border-slate-100 p-6 dark:border-slate-800"><h2 class="font-black"><span x-show="lang === 'fa'">ویرایش دسته‌بندی</span><span x-show="lang === 'en'">Edit category</span></h2><p class="mt-1 text-xs text-slate-400"><span x-show="lang === 'fa'">اطلاعات دسته‌بندی را تغییر بده.</span><span x-show="lang === 'en'">Update the category details.</span></p></div>
            <form wire:submit="updateCategory" class="space-y-5 p-6">
                <div><label class="text-sm font-bold"><span x-show="lang === 'fa'">نام دسته‌بندی</span><span x-show="lang === 'en'">Category name</span></label><input type="text" wire:model="editName" x-bind:placeholder="lang === 'fa' ? 'مثلاً دانشگاه' : 'e.g. University'" class="mt-2 h-12 w-full rounded-xl border bg-slate-50 px-4 text-sm dark:border-slate-700 dark:bg-slate-800"></div>
                @error('editName')<p class="text-xs text-rose-500">{{ $message }}</p>@enderror
                <div><label class="text-sm font-bold"><span x-show="lang === 'fa'">رنگ دسته‌بندی</span><span x-show="lang === 'en'">Category color</span></label><div class="mt-3 grid grid-cols-9 gap-2">@foreach($colorOptions as $c)<button type="button" wire:click="$set('editColor','{{ $c }}')" class="aspect-square rounded-xl" style="background-color:{{ $c }}">@if($editColor===$c)✓@endif</button>@endforeach</div></div>
                <div><label class="text-sm font-bold"><span x-show="lang === 'fa'">آیکون</span><span x-show="lang === 'en'">Icon</span></label><div class="mt-3 grid grid-cols-5 gap-2">@foreach(['folder'=>['📁','پوشه','Folder'],'work'=>['💼','کار','Work'],'study'=>['🎓','تحصیل','Study'],'personal'=>['👤','شخصی','Personal'],'other'=>['✦','سایر','Other']] as $v=>$i)<button type="button" wire:click="$set('editIcon','{{ $v }}')" class="rounded-xl border p-3 text-center {{ $editIcon===$v ? 'border-indigo-500 bg-indigo-50' : 'border-slate-200' }}"><span>{{ $i[0] }}</span><span class="mt-1 block text-[10px] font-bold"><span x-show="lang === 'fa'">{{ $i[1] }}</span><span x-show="lang === 'en'">{{ $i[2] }}</span></span></button>@endforeach</div></div>
                <div class="flex gap-3 border-t pt-5 dark:border-slate-800"><button type="submit" class="flex-1 rounded-xl bg-indigo-600 py-3 text-sm font-bold text-white"><span wire:loading.remove wire:target="updateCategory"><span x-show="lang === 'fa'">ذخیره تغییرات</span><span x-show="lang === 'en'">Save changes</span></span><span wire:loading wire:target="updateCategory">...</span></button><button type="button" @click="editOpen=false" class="rounded-xl border px-5 text-sm font-bold"><span x-show="lang === 'fa'">انصراف</span><span x-show="lang === 'en'">Cancel</span></button></div>
            </form>
        </div>
    </div>

    {{-- Delete modal --}}
    <div x-show="deleteOpen" x-cloak class="fixed inset-0 z-[120] grid place-items-center bg-slate-950/60 p-4">
        <div @click.outside="deleteOpen=false" class="w-full max-w-md rounded-3xl bg-white p-6 shadow-2xl dark:bg-slate-900">
            <h2 class="text-lg font-black"><span x-show="lang === 'fa'">حذف دسته‌بندی؟</span><span x-show="lang === 'en'">Delete category?</span></h2>
            <p class="mt-2 text-sm text-slate-500"><span x-show="lang === 'fa'">آیا مطمئنی می‌خواهی دسته‌بندی</span><span x-show="lang === 'en'">Are you sure you want to delete</span> <strong x-text="deleteName"></strong> <span x-show="lang === 'fa'">را حذف کنی؟</span><span x-show="lang === 'en'">?</span></p>
            <div class="mt-6 flex gap-3"><button type="button" @click="$wire.deleteCategory(deleteId); deleteOpen=false" class="flex-1 rounded-xl bg-rose-600 py-3 text-sm font-bold text-white"><span x-show="lang === 'fa'">حذف دسته‌بندی</span><span x-show="lang === 'en'">Delete category</span></button><button type="button" @click="deleteOpen=false" class="rounded-xl border px-5 text-sm font-bold"><span x-show="lang === 'fa'">انصراف</span><span x-show="lang === 'en'">Cancel</span></button></div>
        </div>
    </div>
</div>
